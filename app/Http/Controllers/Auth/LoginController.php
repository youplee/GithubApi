<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Token;
use App\Courtier;
use App\Licence;

use Carbon\Carbon;

use Validator;
use Illuminate\Support\Facades\Config;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function connexion(Request $request){

        if (Auth::attempt(['username' => $request->name, 'password' => $request->password])) {

            $user       = User::where('username',$request->name)->first();
            Auth::login($user);
            return redirect('home');

        }else{
 
             return redirect('login')->with('wrongPass', Config::get('errorsMsg.errors.wrong_password'));

        }
    }

    public function logout(){

        Auth::logout();
        return redirect('login');
           
    }


}
