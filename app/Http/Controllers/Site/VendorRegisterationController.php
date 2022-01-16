<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LoginRequest;
use App\Http\Requests\Dashboard\VendorRequest;
use App\Models\Image;
use App\Models\Logo;
use App\Models\Vendor;
use App\Models\VendorHeaderCover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class VendorRegisterationController extends Controller
{
    public function login()
    {
        $logo = Logo::first();
        return view('site.vendor.loginVendor', compact('logo'));
    }

    public function checkLoginVendor(LoginRequest $request)
    {
        if (auth()->guard('vendor')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){

            $notification = array(
                'message' => 'تم تسجيل دخولك بنجاح',
                'alert-type' => 'success'
            );
            if (Auth::guard('vendor')->user()->type_activity == 'تفصيل'){

                return redirect()->route('vendor.aboutDesign')->with($notification);

            } elseif (Auth::guard('vendor')->user()->type_activity == 'أقمشة'){

                return redirect()->route('vendor.aboutFabric')->with($notification);

            } elseif (Auth::guard('vendor')->user()->type_activity == 'الاثنين معا'){

                return redirect()->route('vendor.aboutBoth');

            }
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
        return view('site.vendor.registerVendor', compact('logo'));
    }

    public function registerVendor(VendorRequest $request)
    {
        DB::beginTransaction();
        $vendor = Vendor::create([
            'name' => $request->name,
            'location' => $request->location,
            'commercial_registration_No' => $request->commercial_registration_No,
            'mobile_No' => $request->mobile_No,
            'national_Id' => $request->national_Id,
            'email' => $request->email,
            'type_activity' => $request->type_activity,
            'password' => bcrypt($request->password),

        ]);

        $vendor->save();

        $header_cover = VendorHeaderCover::create([
            'vendor_id' => $vendor->id,
            'photo' => 'companyprofile1.png'
        ]);

        $header_cover->save();


        $image = Image::create([
            'photo' => 'user-profile.png'
        ]);
        $vendor->image()->save($image);
        DB::commit();

        $notification = array(
            'message' => 'تم تسجيلك كتاجر في المتجر',
            'alert-type' => 'success'
        );

        return redirect() -> route('vendor.login.page')->with($notification);
    }

    public function logout()
    {
        $guard = $this->getGuard();
        $guard->logout();

        $notification = array(
            'message' => 'تم تسجيل الخروج بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.login.page')->with($notification);
    }

    private function getGuard()
    {
        return auth('vendor');
    }
}
