<?php

namespace App\Http\Controllers;

use App\Actions\Appeal\CreateAppealAction;
use App\Actions\TrafficLights\LoadFromCSVAction;
use App\Dto\Action\Appeal\CreateAppealActionDto;
use App\Enums\AppealStatus;
use App\Enums\Roles;
use App\Models\Appeal;
use App\Models\AppealLog;
use App\Models\TrafficLight;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class EngineerController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $users = User::query()->where('role_id', 2)->get();

        return view('admin.engineers')->with([
            'engineers' => $users
        ]);
    }


    public function edit()
    {
        return view('admin.engineer.edit');
    }

    public function sendToOperator(Request $request, $id)
    {
        $appeal = Appeal::query()->findOrFail($id);

        $appeal->engineer_comment = $request->comment;

        $images = $request->file('images');

        $imagesToSave = "";

        foreach ($images ?? [] as $image) {
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $imagesToSave .= '/images/' . $imageName . ',';
        }

        $appeal->status = AppealStatus::Awaiting;
        $appeal->engineer_files = $imagesToSave;

        $appeal->save();

        AppealLog::query()->create([
            'appeal_id' => $id,
            'status' => $appeal->status->value,
            'log_text' => 'Инженер отправил заявку на проверку'
        ]);

        return redirect()->back();
    }
}
