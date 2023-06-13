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

class AuthController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

   public function loginPage(Request $request)
   {
       return view('admin.login');
   }

    public function login(Request $request)
    {
        return redirect('dashboard');
    }
}
