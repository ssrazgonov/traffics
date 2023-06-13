<?php

namespace App\Http\Controllers;

use App\Actions\Appeal\CreateAppealAction;
use App\Actions\Appeal\GetAppealAction;
use App\Actions\Appeal\GetAppealsAction;
use App\Actions\TrafficLights\LoadFromCSVAction;
use App\Dto\Action\Appeal\CreateAppealActionDto;
use App\Enums\AppealStatus;
use App\Enums\TypeOfCrash;
use App\Models\TrafficLights;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class AppealController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

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

        $createAppealAction($dto);

        return redirect()->back()->with([
            'success_appeal_create' => true,
        ]);
    }

    function getInBacklog(GetAppealsAction $getAppealsAction)
    {
        $appeals = $getAppealsAction(AppealStatus::IN_WORK);

        return view('admin.appeals_backlog')->with([
            'appeals' => $appeals
        ]);
    }

    function getInWorks(GetAppealsAction $getAppealsAction)
    {
        $appeals = $getAppealsAction(AppealStatus::IN_WORK, auth()->user()?->id);

        return view('admin.appeals_works')->with([
            'appeals' => $appeals
        ]);
    }
    function edit($id, GetAppealAction $getAppealAction)
    {
        $appeal = $getAppealAction($id);

        $enginners = User::query()->where('role_id', '2')->get();

        return view('admin.appeals_edit')->with([
            'appeal' => $appeal,
            'engineers' => $enginners,
            'statuses' => AppealStatus::cases(),
            'type_of_crash' => TypeOfCrash::cases(),
        ]);
    }

    function view($id, GetAppealAction $getAppealAction)
    {
        $appeal = $getAppealAction($id);

        return view('admin.appeals_view')->with([
            'appeal' => $appeal
        ]);
    }


}
