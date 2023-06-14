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

class TrafficLightController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        return view('admin.traffic_light.index');
    }

    public function view()
    {
        return view('admin.traffic_light.view');
    }

    public function edit()
    {
        return view('admin.traffic_light.edit');
    }
}
