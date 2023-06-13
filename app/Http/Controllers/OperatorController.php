<?php

namespace App\Http\Controllers;

use App\Actions\Appeal\CreateAppealAction;
use App\Actions\TrafficLights\LoadFromCSVAction;
use App\Dto\Action\Appeal\CreateAppealActionDto;
use App\Enums\AppealStatus;
use App\Enums\TypeOfCrash;
use App\Models\Appeal;
use App\Models\AppealLog;
use App\Models\TrafficLights;
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
        return view('admin.operator.index');
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

        $appeal = Appeal::query()->findOrFail($request->id);

        $appealOldStatus = $appeal->status;
        $appealOldTypeOfCrash = $appeal->type_of_crash;

        $logText = '';

        if ($request->status) {
            $appeal->status = AppealStatus::from($request->status);

            if ($appeal->status !== $appealOldStatus) {
                $logText .= 'Оператор поменял статус заявки c ' . $appealOldStatus->title() . ' на ' . $appeal->status->title() . '\r';
            }
        }

        if ($request->type_of_crash) {
            $appeal->type_of_crash = TypeOfCrash::from($request->type_of_crash);

            if ($appeal->type_of_crash !== $appealOldTypeOfCrash) {
                $logText .= 'Оператор поменял тип неисправности с ' . $appealOldTypeOfCrash->title() . ' на ' . $appeal->type_of_crash->title() . '\r';
            }
        }

        if ($request->comment) {
            $appeal->comment = $request->comment;
        }

        if ($request->responsible) {
            if ($appeal->engineer_id !== $request->responsible) {
                $logText .= 'Оператор поменял инженера '  . ' на ' . $appeal->type_of_crash->title() . '\r';
            }
            $appeal->engineer_id = $request->responsible;
        }

        $appeal->save();

        AppealLog::query()->create([
            'appeal_id' => $appeal->id,
            'log_text' => $logText,
        ]);

        return redirect()->back();
    }
}
