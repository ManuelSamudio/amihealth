<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use App\ActivationService;

class LoginController extends Controller
{

    use AuthenticatesUsers;


    protected $redirectTo = '/';
    protected $activationService;
    protected $maxAttempts = 5;
    protected $decayMinutes = 2;

    public function __construct(ActivationService $activationService){

        $this->middleware('guest', ['except' => 'logout']);

        $this->activationService = $activationService;
    }

    public function activateUser($token){

      if($user = $this->activationService->activateUser($token)){

          return redirect('/email-confirmed');
      }

      return redirect('/');
    }

    public function email_confirmed(){

            return view('patient.emailconfirmed');
    }


}
