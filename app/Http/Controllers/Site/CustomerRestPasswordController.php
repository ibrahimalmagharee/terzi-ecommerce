<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CustomerRestPasswordController extends Controller
{
    use ResetsPasswords;
    protected $redirectTo = RouteServiceProvider::CUSTOMERLOGIN;

    public function showResetForm(Request $request, $token = null)
    {
        $logo = Logo::first();
        return view('site.customer.reset', compact('logo'))->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function broker()
    {
        return Password::broker('customers');
    }

    public function guard()
    {
        return Auth::guard('customer');
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email|exists:customers,email',
            'password' => 'required|confirmed|min:4|max:6',
        ];
    }

    protected function validationErrorMessages()
    {
        return [
            'email.required' => 'يرجى ادخال البريد الالكتروني',
            'email.email' => 'يرجى التحقق من صيعة البريد الالكتروني المدخل',
            'email.exists' => 'هذا الايميل غير مسجل به. يرجى التحقق من الايميل المدخل',
            'password.required' => 'يرجى ادخال كلمة المرور',
            'password.min' => 'كلمة المرور يجب ان لا تقل عن 4 أحرف',
            'password.max' => 'كلمة المرور يجب ان لا تزيد عن 6 احرف',
            'password.confirmed' => 'كلمة المرور غير متطابقة يرجى التأكد منها',
        ];
    }

    protected function resetPassword($user, $password)
    {
        $this->setUserPassword($user, $password);

        $user->save();

        event(new PasswordReset($user));

        $this->guard()->login($user);
    }

}



