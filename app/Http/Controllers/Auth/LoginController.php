<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirect($service)
    {
        return Socialite::driver($service)->redirect();
    }

    public function callback($service)
    {
         $user = Socialite::driver($service)->user();


        $this->_registerOrLoginUser($user);

        // Return home after login
        $notification = array(
            'message' => 'تم تسجيل دخولك بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->route('index')->with($notification);
    }

    protected function _registerOrLoginUser($data)
    {
        $user = Customer::where('email', '=', $data->email)->first();
        if (!$user) {
            $user = new Customer();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->service_id = $data->id;
            $user->save();
        }

        Auth::guard('customer')->login($user);
    }

}
