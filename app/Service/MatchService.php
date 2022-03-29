<?php

namespace App\Service;

class MatchService
{
    const VEHICLE_CONSUMPTION = 'consumption';
    const VEHICLE_SEATS = 'seats';
    const VEHICLE_ID = 'id';

    public function searchVehicles($allTripUsers)
    {
        $vehicles = [];
        $bufferVehicle = [];

        $vehicles = $this->getVehicles($allTripUsers, $vehicles);

        $vehiclesCopy = $vehicles;

        list($bufferVehicle) = $this->checkConvinationsInEachFirstPosition($vehiclesCopy, $vehicles, $bufferVehicle);

        $bufferVehicle = array_map("unserialize", array_unique(array_map("serialize", $bufferVehicle)));

        $bufferVehicle = $this->setIndexInArray($bufferVehicle);

        uasort($bufferVehicle, function ($a, $b) {
            return strnatcmp($a[self::VEHICLE_CONSUMPTION], $b[self::VEHICLE_CONSUMPTION]);
        });

        $bufferVehicle = $this->setIndexInArray($bufferVehicle);

        foreach ($bufferVehicle as $vehicle) {
            if ($vehicle['seats'] >= count($allTripUsers)) {
                return $vehicle;
            }
        }

        return null;
    }

    private function checkCases($arrayVehicles, &$bufferVehicle, $consumption, $seats, $id)
    {
        for ($i = 0; $i < count($arrayVehicles); $i++) {

            $buffer [] = [
                $consumption => $arrayVehicles[$i][$consumption],
                $seats => $arrayVehicles[$i][$seats],
                $id => $arrayVehicles[$i][$id]
            ];

            if ($i === count($arrayVehicles) - 1) {
                $bufferArrayIdVehicles = [];
                foreach ($buffer as $elem) {
                    $bufferArrayIdVehicles [] = $elem['id'];
                }

                $bufferVehicle [] = [
                    $consumption => array_sum(array_column($buffer, $consumption)),
                    $seats => array_sum(array_column($buffer, $seats)),
                    $id => $bufferArrayIdVehicles
                ];

                if ($arrayVehicles[0][$id] !== $arrayVehicles[count($arrayVehicles) - 1][$id]) {
                    $bufferArrayIdVehicles = [];
                    $bufferArrayIdVehicles [] = $arrayVehicles[0][$id];
                    $bufferArrayIdVehicles [] = $arrayVehicles[count($arrayVehicles) - 1][$id];

                    $bufferVehicle [] = [
                        $consumption => $arrayVehicles[0][$consumption] + $arrayVehicles[count($arrayVehicles) - 1][$consumption],
                        $seats => $arrayVehicles[0][$seats] + $arrayVehicles[count($arrayVehicles) - 1][$seats],
                        $id => $bufferArrayIdVehicles
                    ];
                }

                unset($arrayVehicles[count($arrayVehicles) - 1]);
                $buffer = [];

                $i = -1;
            }
        }
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
                    self::VEHICLE_SEATS => $user->vehicle->seats,
                    self::VEHICLE_ID => $user->vehicle->id
                ];
            }
        }
        return $vehicles;
    }

    /**
     * @param array $vehiclesCopy
     * @param array $vehicles
     * @param array $bufferVehicle
     * @return array
     */
    private function checkConvinationsInEachFirstPosition(array $vehiclesCopy, array $vehicles, array $bufferVehicle): array
    {
        for ($i = 0; $i < count($vehiclesCopy); $i++) {
            self::checkCases(
                $vehicles,
                $bufferVehicle,
                self::VEHICLE_CONSUMPTION,
                self::VEHICLE_SEATS,
                self::VEHICLE_ID
            );
            array_shift($vehicles);
        }
        return array($bufferVehicle, $vehicles);
    }

    /**
     * @param array $bufferVehicle
     * @return array
     */
    private function setIndexInArray(array $bufferVehicle): array
    {
        return array_values($bufferVehicle);
    }
}
