<?php

namespace App\Actions\TrafficLights;

use App\Models\TrafficLights;

class LoadFromCSVAction
{
    public function __invoke()
    {
        $csvFile = __DIR__ . '/../../../resources/traffic_lights.csv';

        $traffic_lights = readCSV($csvFile,array('delimiter' => ','));

        $skipFirstRow = true;

        foreach ($traffic_lights as $traffic_light) {
            if ($skipFirstRow) {
                $skipFirstRow = false;
                continue;
            }

            if (!is_array($traffic_light)) {
                continue;
            }

            $coordinates = json_decode($traffic_light[2]);

            $location_x = $coordinates[1];
            $location_y = $coordinates[0];

            $address = json_decode($traffic_light[1])?->name ?? '';

            TrafficLights::query()->updateOrCreate([
                'address' => $address,
            ], [
                'location_x' => $location_x,
                'location_y' => $location_y,
                'address' => $address,
            ]);
        }
    }
}
