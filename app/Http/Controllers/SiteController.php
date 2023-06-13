<?php

namespace App\Http\Controllers;

use App\Actions\Appeal\CreateAppealAction;
use App\Actions\TrafficLights\LoadFromCSVAction;
use App\Dto\Action\Appeal\CreateAppealActionDto;
use App\Models\TrafficLights;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class SiteController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function main(Request $request, LoadFromCSVAction $loadFromCSVAction)
    {
        if (!TrafficLights::query()->count()) {
            $loadFromCSVAction();
        }

        $traffic_lights = Cache::remember('traffic_lights', 3000, function () {
            return TrafficLights::all()->toArray();
        });

        return view('welcome')->with([
            'traffic_lights' => $traffic_lights
        ]);
    }
}
