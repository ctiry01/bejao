<?php

namespace App\Service;

use Dflydev\DotAccessData\Data;

class MatchService
{
    const VEHICLE_CONSUMPTION = 'consumption';
    const VEHICLE_SEATS = 'seats';
    const VEHICLE_ID = 'id';

    public function searchVehicles()
    {
        $vehicles = [
            [
                self::VEHICLE_CONSUMPTION => 5,
                self::VEHICLE_SEATS => 4,
                self::VEHICLE_ID => 1
            ],
            [
                self::VEHICLE_CONSUMPTION => 6,
                self::VEHICLE_SEATS => 4,
                self::VEHICLE_ID => 2
            ],
            [
                self::VEHICLE_CONSUMPTION => 7,
                self::VEHICLE_SEATS => 8,
                self::VEHICLE_ID => 3
            ],
            [
                self::VEHICLE_CONSUMPTION => 13,
                self::VEHICLE_SEATS => 12,
                self::VEHICLE_ID => 4
            ]
        ];

        $bufferVehicle = [];

        $vehiclesCopy = $vehicles;

        function loopAndGetValues($arrayVehicles, &$bufferVehicle, $consumption, $seats, $id)
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

        for ($i = 0; $i < count($vehiclesCopy); $i++) {
            loopAndGetValues(
                $vehicles,
                $bufferVehicle,
                self::VEHICLE_CONSUMPTION,
                self::VEHICLE_SEATS,
                self::VEHICLE_ID
            );

            array_shift($vehicles);
        }

        $bufferVehicle = array_map("unserialize", array_unique(array_map("serialize", $bufferVehicle)));

        $bufferVehicle = array_values($bufferVehicle);

        uasort($bufferVehicle, function ($a, $b) {
            return strnatcmp($a[self::VEHICLE_CONSUMPTION], $b[self::VEHICLE_CONSUMPTION]); // or other function/code
        });
        $bufferVehicle = array_values($bufferVehicle);

        dd($bufferVehicle);

    }
}
