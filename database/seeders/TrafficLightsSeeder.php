<?php

namespace Database\Seeders;

use App\Models\TrafficLight;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TrafficLightsSeeder extends Seeder
{
    public function run()
    {
        TrafficLight::all()->each(function ($traffic) {
            $qrCode = QrCode::format('png')
                ->size(500)
                ->generate(
                    config('app.url').'?id='. $traffic->id,
                );

            Storage::put('/public/traffic_lights/' . $traffic->id . '.png', $qrCode);

            $traffic->qr_code = $traffic->id . '.png';
            $traffic->save();
        });
    }
}
