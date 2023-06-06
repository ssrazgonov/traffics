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

class Controller extends BaseController
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

    public function dashboard(Request $request)
    {
        return view('admin.index');
    }

    public function createAppeal(Request $request, CreateAppealAction $createAppealAction)
    {
        $request->validate([
            'traffic_light_id' => ['required'],
            'type_of_crash' => ['required'],
            'comment' => ['sometimes', 'string']
        ]);

        $dto = new CreateAppealActionDto();

        $dto->trafficLightId = $request->traffic_light_id;
        $dto->typeOfCrash= $request->type_of_crash;
        $dto->comment = $request->comment;

        $actionResult = $createAppealAction($dto);

        return redirect()->back()->with([
            'success_appeal_create' => true,
        ]);
    }

    function getBacklog()
    {
        return view('admin.appeals_backlog');
    }

    function getWorker()
    {
        return view('admin.appeals_worker');
    }
    function edit($id)
    {
        return view('admin.appeals_edit')->with([
            'id' => $id
        ]);
    }

    function view()
    {
        return view('admin.appeals_view');
    }


}
