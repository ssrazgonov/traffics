<?php

namespace App\Http\Controllers;

use App\Actions\Appeal\CreateAppealAction;
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
use Illuminate\Support\Facades\Cache;

class OperatorController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $users = User::query()->where('role_id', 1)->get();

        return view('admin.operators')->with([
            'operators' => $users
        ]);
    }

    public function view()
    {
        return view('admin.operator.view');
    }

    public function edit()
    {
        return view('admin.operator.edit');
    }
    public function saveAppeal(Request $request)
    {
        $request->validate([
            'id' => ['required'],
            'status' => ['sometimes', 'string'],
            'responsible' => ['sometimes', 'exists:users,id'],
            'type_of_crash' => ['sometimes', 'string'],
            'comment' => ['sometimes', 'string']
        ]);

        $appeal = Appeal::query()->with('engineer')->findOrFail($request->id);

        $appealOldStatus = $appeal->status;
        $appealOldTypeOfCrash = $appeal->type_of_crash;

        $logText = '    ';

        if ($request->status) {
            $appeal->status = AppealStatus::from($request->status);

            if ($appeal->status != $appealOldStatus) {
                $logText .= 'Оператор поменял статус заявки c ' . $appealOldStatus->title() . ' на ' . $appeal->status->title();
            }
        }

        if ($request->type_of_crash) {
            $appeal->type_of_crash = TypeOfCrash::from($request->type_of_crash);

            if ($appeal->type_of_crash !== $appealOldTypeOfCrash) {
                $logText .= 'Оператор поменял тип неисправности с ' . $appealOldTypeOfCrash->title() . ' на ' . $appeal->type_of_crash->title();
            }
        }

        if ($request->comment) {
            $appeal->comment = $request->comment;
        }

        if ($request->responsible) {
            if ($appeal->engineer_id != $request->responsible) {
                $appeal->engineer_id = $request->responsible;
                $eng = User::findOrFail($request->responsible);
                $logText .= 'Оператор поменял инженера '  . ' на ' . $eng?->name;
            }
        }

        $dirty = count($appeal->getDirty());

        $appeal->save();

        if ($dirty) {
            AppealLog::query()->create([
                'appeal_id' => $appeal->id,
                'log_text' => $logText,
                'status' => $appeal->status
            ]);
        }



        return redirect()->back();
    }

    public function sendToEngineer(Request $request, $id)
    {
        $appeal = Appeal::query()->findOrFail($id);

        $appeal->operator_comment = $request->comment;
        $appeal->status = AppealStatus::Returned;

        $appeal->save();

        AppealLog::query()->create([
            'appeal_id' => $id,
            'status' => $appeal->status->value,
            'operator_comment' => $request->comment,
            'log_text' => 'Оператор отправил заявку на доработку'
        ]);

        return redirect()->back();
    }

    public function close(Request $request, $id)
    {
        $appeal = Appeal::query()->findOrFail($id);

        $appeal->operator_comment = $request->comment;

        $appeal->status = AppealStatus::CLOSED;

        $appeal->save();

        AppealLog::query()->create([
            'appeal_id' => $id,
            'status' => $appeal->status->value,
            'log_text' => 'Оператор закрыл заявку',
            'operator_comment' => $request->comment,
        ]);

        $traffic = TrafficLight::query()->findOrFail($appeal->traffic_light_id);

        $appeals = Appeal::query()->where('traffic_light_id', $appeal->traffic_light_id)->whereNotIn('status', [
            AppealStatus::CLOSED, AppealStatus::REJECTED
        ])->count();

        if (!$appeals) {
            $traffic->status = 'working';
            $traffic->save();
        }

        return redirect()->back();
    }
}
