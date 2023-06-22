<?php

namespace App\Http\Controllers;

use App\Actions\Appeal\CreateAppealAction;
use App\Actions\Appeal\GetAppealAction;
use App\Actions\Appeal\GetAppealsAction;
use App\Actions\TrafficLights\LoadFromCSVAction;
use App\Dto\Action\Appeal\CreateAppealActionDto;
use App\Enums\AppealStatus;
use App\Enums\TypeOfCrash;
use App\Models\Appeal;
use App\Models\AppealLog;
use App\Models\TrafficLight;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
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
        $dto->file = $request->comment_file;

        $createAppealAction($dto);

        return redirect()->back()->with([
            'success_appeal_create' => true,
            'feedback' => $request->email ?? false,
        ]);
    }

    function getInBacklog(GetAppealsAction $getAppealsAction)
    {
        $appeals = $getAppealsAction(AppealStatus::NOT_PROCESSED);

        return view('admin.appeals_backlog')->with([
            'appeals' => $appeals
        ]);
    }

    function getInWorks(GetAppealsAction $getAppealsAction)
    {
        if (auth()->user()->role_id == 1) {
            $appeals = $getAppealsAction(AppealStatus::IN_WORK, auth()->user()->id, null);
        } else {
            $appeals = $getAppealsAction(AppealStatus::IN_WORK, null, auth()->user()->id);
        }


        return view('admin.appeals_works')->with([
            'appeals' => $appeals
        ]);
    }
    function edit($id, GetAppealAction $getAppealAction)
    {
        $appeal = $getAppealAction($id);

        $enginners = User::query()->where('role_id', '2')->get();
        $logs = AppealLog::query()->where('appeal_id', $appeal->id)->get();

        return view('admin.appeals_edit')->with([
            'appeal' => $appeal,
            'engineers' => $enginners,
            'statuses' => AppealStatus::cases(),
            'type_of_crash' => TypeOfCrash::cases(),
            'logs' => $logs
        ]);
    }

    function view($id, GetAppealAction $getAppealAction)
    {
        $appeal = $getAppealAction($id);
        $logs = AppealLog::query()->where('appeal_id', $appeal->id)->get();

        return view('admin.appeals_view')->with([
            'appeal' => $appeal,
            'isOperator' => auth()->user()?->role_id == 1,
            'isEngineer' => auth()->user()?->role_id == 2 || $appeal->engineer_id == auth()->user()?->id,
            'logs' => $logs
        ]);
    }

    public function getInAwaiting(GetAppealsAction $getAppealsAction)
    {
        if (auth()->user()->role_id == 1) {
            $appeals = $getAppealsAction(AppealStatus::Awaiting, auth()->user()->id, null);
        } else {
            $appeals = $getAppealsAction(AppealStatus::Awaiting, null, auth()->user()->id);
        }


        return view('admin.appeals_awaiting')->with([
            'appeals' => $appeals
        ]);
    }

    public function getInClose(GetAppealsAction $getAppealsAction)
    {
        $appeals = $getAppealsAction(AppealStatus::CLOSED, null, auth()->user()->id);

        return view('admin.appeals_awaiting')->with([
            'appeals' => $appeals
        ]);
    }

    public function getReturned(GetAppealsAction $getAppealsAction)
    {
        $appeals = $getAppealsAction(AppealStatus::Returned, null, auth()->user()->id);

        return view('admin.appeals_awaiting')->with([
            'appeals' => $appeals
        ]);
    }

    public function toWork($id)
    {
        if (!auth()) {
            return redirect()->back();
        }

        $appeal = Appeal::findOrFail($id);

        $appeal->operator_id = auth()->id();

        $appeal->status = AppealStatus::IN_WORK->value;

        $appeal->save();

        AppealLog::query()->create([
            'appeal_id' => $appeal->id,
            'log_text' => 'Оператор поменял статус заявки c ' . AppealStatus::NOT_PROCESSED->title() . ' на ' . AppealStatus::IN_WORK->title() . '<br>',
            'status' => $appeal->status
        ]);
        return redirect(route('appeals.view', $appeal->id));
    }
}
