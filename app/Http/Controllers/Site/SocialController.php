<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Vendor;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
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
        $user = Socialite::driver($service)->stateless()->user();

        $this->_registerOrLoginUser($user);

        // Return home after login
        return redirect()->route('about.vendor');
    }

    protected function _registerOrLoginUser($data)
    {
        $user = Vendor::where('email', '=', $data->email)->first();
        if (!$user) {
            $user = new Vendor();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->service_id = $data->id;
            $user->save();
        }

        Auth::guard('vendor')->login($user);
    }
}
