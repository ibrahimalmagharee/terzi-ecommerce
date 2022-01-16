<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class VendorRestPasswordController extends Controller
{
    use ResetsPasswords;
    protected $redirectTo = RouteServiceProvider::VENDORSOON;

    public function showResetForm(Request $request, $token = null)
    {
        $logo = Logo::first();
        return view('site.vendor.reset', compact('logo'))->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function broker()
    {
        return Password::broker('vendors');
    }

    public function guard()
    {
        return Auth::guard('vendor');
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email|exists:vendors,email',
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
