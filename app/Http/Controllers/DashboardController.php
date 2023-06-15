<?php

namespace App\Http\Controllers;

use App\Actions\Appeal\CreateAppealAction;
use App\Actions\TrafficLights\LoadFromCSVAction;
use App\Dto\Action\Appeal\CreateAppealActionDto;
use App\Enums\AppealStatus;
use App\Models\Appeal;
use App\Models\TrafficLight;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class DashboardController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function dashboard(Request $request)
    {
        $appeals = Appeal::query()->count();

        $appealsInWork = Appeal::query()->where('status', AppealStatus::IN_WORK)->count();

        $appealsInWorkProc = $appealsInWork * 100 / $appeals;

        $appealsComplete = Appeal::query()->where('status', AppealStatus::CLOSED)->count();

        $appealsCompleteProc = $appealsComplete * 100 / $appeals;

        $appealsNotProcessed = Appeal::query()->where('status', AppealStatus::NOT_PROCESSED)->count();

        $appealsNotProcessedProc = $appealsNotProcessed * 100 / $appeals;


        $tf = TrafficLight::query()->count();

        $tfW = TrafficLight::query()->where('status', 'working')->count();
        $tfWProc = $tfW * 100 / $tf;
        $tfNW = TrafficLight::query()->where('status', 'not_working')->count();
        $tfNWProc = $tfNW * 100 / $tf;


        return view('admin.index')->with(compact(
            'appeals',
            'appealsInWork',
            'appealsInWorkProc',
            'appealsComplete',
            'appealsCompleteProc',
            'appealsNotProcessed',
            'appealsNotProcessedProc',
            'tf',
            'tfW',
            'tfWProc',
            'tfNW',
            'tfNWProc',
            )
        );
    }

}
