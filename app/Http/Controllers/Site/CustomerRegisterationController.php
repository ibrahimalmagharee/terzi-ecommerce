<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CustomerRequest;
use App\Http\Requests\Dashboard\LoginRequest;
use App\Models\Customer;
use App\Models\Logo;
use Illuminate\Http\Request;

class CustomerRegisterationController extends Controller
{
    public function login()
    {
        $logo = Logo::first();
        return view('site.customer.loginCustomer', compact('logo'));
    }

    public function checkLoginCustomer(LoginRequest $request)
    {
        if (auth()->guard('customer')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){

            $notification = array(
                'message' => 'تم تسجيل دخولك بنجاح',
                'alert-type' => 'success'
            );
            return redirect()->route('index')->with($notification);
        }

        $notification = array(
            'message' => 'هناك خطأ بالبيانات يرجى التحقق',
            'alert-type' => 'error'
        );

        return redirect() -> back()->with($notification);
    }

    public function register()
    {
        $logo = Logo::first();
        return view('site.customer.registerCustomer', compact('logo'));
    }

    public function registerCustomer(CustomerRequest $request)
    {
        if($request->has('terms_conditions')){
            $customer = Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $customer->save();


            $notification = array(
                'message' => 'تم اضافتك كعميل في االمتجر',
                'alert-type' => 'success'
            );

            return redirect() -> route('customer.login.page')->with($notification);

        }else{
            $notification = array(
                'message' => 'فشلت عملية اضافة العميل',
                'alert-type' => 'error'
            );
            return redirect() -> back()->with($notification);
        }
    }

    public function logout()
    {
        if (! auth('customer')->user()){
            $notification = array(
                'message' => 'انت غير مسجل دخول في النظام',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $guard = $this->getGuard();
        $guard->logout();

        $notification = array(
            'message' => 'تم تسجيل الخروج بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('customer.login.page')->with($notification);
    }

    private function getGuard()
    {
        return auth('customer');
    }
}
