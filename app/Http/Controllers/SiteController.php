<?php

namespace App\Http\Controllers;

use App\Actions\Appeal\CreateAppealAction;
use App\Actions\TrafficLights\LoadFromCSVAction;
use App\Dto\Action\Appeal\CreateAppealActionDto;
use App\Models\TrafficLight;
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
        if (!TrafficLight::query()->count()) {
            $loadFromCSVAction();
        }

        $traffic_lights = TrafficLight::with('appeals')->get()->each(function ($traffic) {

            if (count($traffic->appeals) > 0) {
                $traffic->status = 'not_working';
            }
        })->toArray();

        return view('welcome')->with([
            'traffic_lights' => $traffic_lights,
            'trafficId' => $request->id
        ]);
    }
}
