<?php

namespace App\Service;

class MatchService
{
    public function searchVehicles($vehicles, $origin = null, $destination = null)
    {
        $bufferVehicles = [];

        if ($origin && $destination) {
            foreach ($vehicles as $vehicle) {
                if (count($vehicle->user->journeys) > 0) {
                    foreach ($vehicle->user->journeys as $journey) {
                        if (strtolower($journey->origin_address) == strtolower($origin) && strtolower($journey->destination_address) == strtolower($destination)) {
                            $bufferVehicles [] = $vehicle->serializeWithUser();
                        }
                    }
                }
            }
            return $bufferVehicles;
        }

        if ($origin) {
            foreach ($vehicles as $vehicle) {
                if (count($vehicle->user->journeys) > 0) {
                    foreach ($vehicle->user->journeys as $journey) {
                        if (strtolower($journey->origin_address) == strtolower($origin)) {
                            $bufferVehicles [] = $vehicle->serializeWithUser();
                        }
                    }
                }
            }
            return $bufferVehicles;
        }

        foreach ($vehicles as $vehicle) {
            if (count($vehicle->user->journeys) > 0) {
                $bufferVehicles [] = $vehicle->serializeWithUser();
            }
        }
        return $bufferVehicles;
    }
}
