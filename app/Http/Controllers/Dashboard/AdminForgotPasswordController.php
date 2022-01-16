<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LoginRequest;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Mail;
use Illuminate\Support\Facades\Auth;
use DB;

class AdminForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        return view('admin.auth.email');
    }

    public function broker()
    {
        return Password::broker('admins');
    }

    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:admins,email'],
            [
                'email.required' => 'يرجى ادخال الايميل للتحقق',
                'email.email' => 'صيغة الايميل المدخل غير صحيحة',
                'email.exists' => 'هذا الايميل غير مسجل به. يرجى التحقق من الايميل المدخل',
            ]);

    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('admin.auth.sendEmail', ['token' => $token], function($message) use($request){
            $message->from('wasfy@roowad.com', 'ترزي');
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'تم ارسال ايميل يمكنك مراجعة بريدك الالكتروني !');
    }
}
