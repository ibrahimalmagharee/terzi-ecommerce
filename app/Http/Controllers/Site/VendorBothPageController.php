<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProfilePhotoRequest;
use App\Http\Requests\Dashboard\VendorRequest;
use App\Http\Requests\Site\ChangePasswordRequest;
use App\Http\Requests\Site\ContactVendorRequest;
use App\Http\Requests\Site\HeaderPhotoRequest;
use App\Http\Requests\Site\VendorAccountRequest;
use App\Http\Resources\DesignResource;
use App\Http\Resources\FabricResource;
use App\Mail\ContactFormMail;
use App\Models\AboutVendor;
use App\Models\ContactVendor;
use App\Models\Design;
use App\Models\Fabric;
use App\Models\Image;
use App\Models\LogoVendor;
use App\Models\SocialMediaLink;
use App\Models\Vendor;
use App\Models\VendorHeaderCover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use DB;

class VendorBothPageController extends Controller
{

    public function about()
    {
        $social_media_link = SocialMediaLink::get();
        $vendor = Auth::user();
        $logo = LogoVendor::where('vendor_id' , $vendor->id)->first();
        $data = [];
        $data['about_vendor'] = AboutVendor::get();

        if ($vendor->type_activity == 'الاثنين معا') {
            return view('site.vendor.both.about', compact('vendor', 'data', 'social_media_link', 'logo'));


        }else {
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    public function getProfileBoth()
    {
        $social_media_link = SocialMediaLink::get();
        $user_id = Auth::guard('vendor')->user()->id;
        $logo = LogoVendor::where('vendor_id' , $user_id)->first();
        $vendor = Vendor::find($user_id);

        if (!$vendor) {
            $notification = array(
                'message' => 'هذا التاجر غير موجود',
                'alert-type' => 'error'
            );

            return redirect()->route('vendor.aboutBoth')->with($notification);

        } elseif ($vendor->id != $user_id){
            $notification = array(
                'message' => 'انت غير مسجل دخول في النظام',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);

        }

        if ($vendor->type_activity == 'الاثنين معا') {
            $designs = Design::all();
            DesignResource::collection($designs);
            $fabrics = Fabric::all();
            FabricResource::collection($fabrics);
            return view('site.vendor.both.companyProfile', compact('vendor', 'designs','fabrics', 'social_media_link', 'logo'));

        }else {
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    public function editAccountBoth ()
    {
        $user_id = Auth::guard('vendor')->user()->id;
        $vendor = Vendor::find($user_id);
        return response()->json($vendor);
    }

    public function updateAccountBoth (VendorAccountRequest $request)
    {
        $vendor = Vendor::find($request->id);

        $notification = array(
            'message' => 'هذا التاجر غير موجود',
            'alert-type' => 'error'
        );
        if (!$vendor)
            return redirect()->route('vendor.aboutBoth')->with($notification);

        $vendor->where('id', $request->id)->update([
            'name' => $request->name,
            'location' => $request->location,
            'commercial_registration_No' => $request->commercial_registration_No,
            'mobile_No' => $request->mobile_No,
            'national_Id' => $request->national_Id,
            'email' => $request->email,
        ]);

        return response()->json([
            'status' => true,
            'vendor' =>$request->name,
            'msg' => 'تم تحديث الحساب بنجاح'
        ]);
    }

    public function saveProfilePhotoBoth(ProfilePhotoRequest $request, $vendor_id)
    {
        $vendor = Vendor::find($vendor_id);

        if ($request->has('photo')) {
            $image_path = public_path('assets/images/vendors/profile/') . $vendor->image->photo;
            if ($vendor->image->photo != 'user-profile.png') {
                unlink($image_path);
            }
            $filePath = uploadImage('profile', $request->photo);
            $image = Image::where('imageable_id',$vendor->id)->where('imageable_type','App\Models\Vendor')->update([
                'photo' => $filePath
            ]);
        }


        return response()->json([
            'status' => true,
            'photo' => $vendor->getPhoto($filePath),
            'msg' => 'تم تحديث صورة الملف الشخصي بنجاح'
        ]);


    }

    public function saveProfileHeaderCoverBoth(HeaderPhotoRequest $request, $vendor_id)
    {
        $vendor = Vendor::find($vendor_id);

        if ($request->has('header_photo')) {
            $image_path = public_path('assets/images/vendors/headerCover/') . $vendor->headerCover->photo;
            if ($vendor->headerCover->photo != 'companyprofile1.png') {
                unlink($image_path);
            }
            $filePath = uploadImage('headerCover', $request->header_photo);
            $header_cover = VendorHeaderCover::where('vendor_id', $vendor->id)->update([
                'photo' => $filePath
            ]);
        }


        return response()->json([
            'status' => true,
            'photo' => $vendor->getPhotoHeaderCover($filePath),
            'msg' => 'تم تحديث صورة الخلفية بنجاح'
        ]);



    }

    public function getContactUsBoth()
    {
        $social_media_link = SocialMediaLink::get();
        $user_id = Auth::guard('vendor')->user()->id;
        $logo = LogoVendor::where('vendor_id' , $user_id)->first();
        $vendor = Vendor::find($user_id);

        if (!$vendor) {
            $notification = array(
                'message' => 'هذا التاجر غير موجود',
                'alert-type' => 'error'
            );

            return redirect()->route('vendor.aboutBoth')->with($notification);

        } elseif ($vendor->id != $user_id){
            $notification = array(
                'message' => 'انت غير مسجل دخول في النظام',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);

        }

        if ($vendor->type_activity == 'الاثنين معا') {
            return view('site.vendor.both.contactVendor',compact('vendor', 'social_media_link', 'logo'));

        }else {
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    public function saveContactUsBoth(ContactVendorRequest $request) {
        DB::beginTransaction();
        $contact = ContactVendor::create([
            'vendor_id' => $request->vendor_id,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address_request' => $request->address_request,
            'message' => $request->message,
        ]);

        $contact->save();

        //Mail::to('ibrahimalmagree@gmail.com')->send(new ContactFormMail($contact));

        DB::commit();

        $notification = array(
            'message' => 'تم ارسال الرسالة بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.contactUsBoth')->with($notification);

    }

    public function getSearchPageBoth()
    {
        $social_media_link = SocialMediaLink::get();
        $user_id = Auth::guard('vendor')->user()->id;
        $logo = LogoVendor::where('vendor_id' , $user_id)->first();
        $vendor = Vendor::find($user_id);

        if (!$vendor) {
            $notification = array(
                'message' => 'هذا التاجر غير موجود',
                'alert-type' => 'error'
            );

            return redirect()->route('vendor.aboutBoth')->with($notification);

        }
        elseif ($vendor->id != $user_id) {
            $notification = array(
                'message' => 'انت غير مسجل دخول في النظام',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);

        }

        if ($vendor->type_activity == 'الاثنين معا') {

            return view('site.vendor.both.search', compact('vendor', 'social_media_link', 'logo'));

        } else {
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function getSearchBoth(Request $request)
    {
        $user_id = Auth::guard('vendor')->user()->id;
        $vendor = Vendor::find($user_id);
        $search = $request->input('search');

        $designs = Design::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->get();
        DesignResource::collection($designs);

        $fabrics = Fabric::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->get();
        FabricResource::collection($fabrics);

        return view('site.vendor.both._productSearch', compact('designs', 'fabrics', 'search','vendor'));

    }

    public function changePasswordBoth ()
    {
        $social_media_link = SocialMediaLink::get();
        $user_id = Auth::guard('vendor')->user()->id;
        $logo = LogoVendor::where('vendor_id' , $user_id)->first();
        $vendor = Vendor::find($user_id);

        if (!$vendor) {
            $notification = array(
                'message' => 'هذا التاجر غير موجود',
                'alert-type' => 'error'
            );

            return redirect()->route('vendor.aboutBoth')->with($notification);

        }
        elseif ($vendor->id != $user_id) {
            $notification = array(
                'message' => 'انت غير مسجل دخول في النظام',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);

        }

        if ($vendor->type_activity == 'الاثنين معا') {

            return view('site.vendor.both.changePassword', compact('vendor', 'social_media_link', 'logo'));

        } else {
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    public function updatePasswordBoth (ChangePasswordRequest $request)
    {
        $vendor = Auth::guard('vendor')->user();

        if (Hash::check($request->input('old_password'), $vendor->password)) {
            $vendor = Vendor::where('id', $vendor->id)->update([
                'password' =>  bcrypt($request->password)
            ]);

            $notification = array(
                'message' => 'تم تغيير كلمة المرور بنجاح',
                'alert-type' => 'success'
            );
            return redirect()->route('vendor.profileBoth')->with($notification);

        } else {
            $notification = array(
                'message' => 'كلمة المرور القديمة غير صحيحة ',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }
}
