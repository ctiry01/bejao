<?php

namespace App\Helpers;

class DistanceHelper
{
    const GOOGLE_MAPS_API_URL = 'https://maps.google.com/maps/api/geocode/';

    public static function distanceBetweenAdress($addressFrom, $addressTo) {
        //Change address format
        $formattedAddrFrom = str_replace(' ','+',$addressFrom);
        $formattedAddrTo = str_replace(' ','+',$addressTo);

        //Send request and receive json data
        $geocodeFrom = file_get_contents(self::GOOGLE_MAPS_API_URL.'json?address='.$formattedAddrFrom.'&sensor=false&key='.env('GOOGLE_API_KEY'));
        $outputFrom = json_decode($geocodeFrom);
        $geocodeTo = file_get_contents(self::GOOGLE_MAPS_API_URL.'json?address='.$formattedAddrTo.'&sensor=false&key='.env('GOOGLE_API_KEY'));
        $outputTo = json_decode($geocodeTo);


        //Get latitude and longitude from geo data
        $latitudeFrom = $outputFrom->results[0]->geometry->location->lat;
        $longitudeFrom = $outputFrom->results[0]->geometry->location->lng;
        $latitudeTo = $outputTo->results[0]->geometry->location->lat;
        $longitudeTo = $outputTo->results[0]->geometry->location->lng;

        //Calculate distance from latitude and longitude
        $theta = $longitudeFrom - $longitudeTo;
        $dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;

        return round(($miles * 1.609344), 2);
    }
}
