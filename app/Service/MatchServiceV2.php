<?php

namespace App\Service;

class MatchServiceV2
{
    const VEHICLE_CONSUMPTION = 'consumption';
    const VEHICLE_CONSUMPTION_BY_SEAT = 'consumptionBySeat';
    const VEHICLE_SEATS = 'seats';
    const VEHICLE_ID = 'id';

    public function searchVehicles($allTripUsers)
    {
        $vehicles = [];

        $vehicles = $this->getVehicles($allTripUsers, $vehicles);

        $remainingSeats = count($allTripUsers);

        $vehiclesSelected = [];

        $remainingCars = $vehicles;

        while ($remainingSeats > 0) {
            $carsRemainingWithConsumption = $this->sortBySeatsAndConsumption($remainingCars, $remainingSeats);

            $vehiclesSelected[] = $carsRemainingWithConsumption[0];
            $remainingSeats -= $carsRemainingWithConsumption[0][self::VEHICLE_SEATS];

            $remainingCars = array_splice($remainingCars, 1);
        }

        return $vehiclesSelected;
    }

    private function sortBySeatsAndConsumption($cars, $seats): array
    {
        $buffer = [];

        foreach ($cars as $car) {
            $car[self::VEHICLE_CONSUMPTION_BY_SEAT] = $car[self::VEHICLE_CONSUMPTION] / min($seats, $car[self::VEHICLE_SEATS]);
            $buffer[] = $car;
        }

        usort($buffer, function ($a, $b) {
            return $a[self::VEHICLE_CONSUMPTION_BY_SEAT] > $b[self::VEHICLE_CONSUMPTION_BY_SEAT] ? 1 : -1;
        });

        return array_values($buffer);
    }

    /**
     * @param $allTripUsers
     * @param array $vehicles
     * @return array
     */
    private function getVehicles($allTripUsers, array $vehicles): array
    {
        foreach ($allTripUsers as $user) {
            if ($user->vehicle) {
                $vehicles [] = [
                    self::VEHICLE_CONSUMPTION => $user->vehicle->fuel_consumption,
                    self::VEHICLE_CONSUMPTION_BY_SEAT => null,
                    self::VEHICLE_SEATS => $user->vehicle->seats,
                    self::VEHICLE_ID => $user->vehicle->id
                ];
            }
        }
        return $vehicles;
    }
}
