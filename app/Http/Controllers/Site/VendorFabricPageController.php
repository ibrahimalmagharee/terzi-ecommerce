<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ChangePasswordRequest;
use App\Http\Requests\Site\FabricRequest;
use App\Http\Requests\Dashboard\ProfilePhotoRequest;
use App\Http\Requests\Dashboard\VendorRequest;
use App\Http\Requests\Site\ContactVendorRequest;
use App\Http\Requests\Site\HeaderPhotoRequest;
use App\Http\Requests\Site\VendorAccountRequest;
use App\Http\Resources\DesignResource;
use App\Http\Resources\FabricResource;
use App\Mail\ContactFormMail;
use App\Models\AboutVendor;
use App\Models\Category;
use App\Models\Color;
use App\Models\ContactVendor;
use App\Models\Design;
use App\Models\Fabric;
use App\Models\Image;
use App\Models\LogoVendor;
use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\SocialMediaLink;
use App\Models\Vendor;
use App\Models\VendorHeaderCover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class VendorFabricPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('vendor-fabric');
    }

    public function about()
    {
        $social_media_link = SocialMediaLink::get();
        $vendor = Auth::user();
        $logo = LogoVendor::where('vendor_id' , $vendor->id)->first();
        $data = [];
        $data['about_vendor'] = AboutVendor::get();

        if ($vendor->type_activity == 'أقمشة') {

            return view('site.vendor.fabric.about', compact('vendor', 'data', 'social_media_link', 'logo'));

        }else{
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }



    }


    public function getProfileFabric()
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

            return redirect()->route('vendor.aboutFabric')->with($notification);
        }elseif ($vendor->id != $user_id){
            $notification = array(
                'message' => 'انت غير مسجل دخول في النظام',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        if ($vendor->type_activity == 'أقمشة') {
            $fabrics = Fabric::all();
            FabricResource::collection($fabrics);

            return view('site.vendor.fabric.companyProfile', compact('vendor', 'fabrics', 'social_media_link', 'logo'));

        }else{
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    public function viewProductsFabric()
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

            return redirect()->back()->with($notification);

        } elseif ($vendor->id != $user_id){

                $notification = array(
                    'message' => 'انت غير مسجل دخول في النظام',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);


        }

        if ($vendor->type_activity == 'أقمشة')
        {
            $fabrics = Fabric::all();
            FabricResource::collection($fabrics);

            return view('site.vendor.fabric.viewProducts', compact('vendor', 'fabrics', 'social_media_link', 'logo'));



        } elseif ($vendor->type_activity == 'الاثنين معا')
        {
            $fabrics = Fabric::all();
            FabricResource::collection($fabrics);

            return view('site.vendor.both.viewProductsFabric', compact('vendor', 'fabrics', 'social_media_link', 'logo'));

        } elseif ($vendor->type_activity == 'تفصيل')
        {
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    public function editAccountFabric ()
    {
        $user_id = Auth::guard('vendor')->user()->id;
        $vendor = Vendor::find($user_id);
        return response()->json($vendor);
    }

    public function updateAccountFabric(VendorAccountRequest $request)
    {
        $vendor = Vendor::find($request->id);

        $notification = array(
            'message' => 'هذا التاجر غير موجود',
            'alert-type' => 'error'
        );
        if (!$vendor)
            return redirect()->route('vendor.aboutFabric')->with($notification);

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


    public function addProductFabric()
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

            return redirect()->back()->with($notification);

        } elseif ($vendor->id != $user_id){

            $notification = array(
                'message' => 'انت غير مسجل دخول في النظام',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);


        }

        if ($vendor->type_activity == 'أقمشة'){

            $data = [];
            $data['colors'] = Color::select('id', 'color')->get();
            $data['categories'] = Category::active()->select('id', 'name')->where('parent_id', 2)->get();

            return view('site.vendor.fabric.addProduct', compact('vendor', 'data', 'social_media_link', 'logo'));

        } elseif ($vendor->type_activity == 'الاثنين معا'){

            $data = [];
            $data['colors'] = Color::select('id', 'color')->get();
            $data['categories'] = Category::active()->select('id', 'name')->where('parent_id', 2)->get();

            return view('site.vendor.both.addProductFabric', compact('vendor', 'data', 'social_media_link', 'logo'));

        } elseif ($vendor->type_activity == 'تفصيل') {

            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }


    }

    public function saveProductFabric(FabricRequest $request)
    {
        $vendor = Vendor::find($request->vendor_id);

        DB::beginTransaction();
        $fabric = Fabric::create([
            'name' => $request->name,
            'description' => $request->description,
            'vendor_id' => $request->vendor_id,
        ]);

        $filePath = "";
        if ($request->has('images') && count($request->images) > 0) {
            foreach ($request->images as $photo) {
                $filePath = uploadImage('fabrics', $photo);
                $image = Image::create([
                    'photo' => $filePath
                ]);
                $fabric->images()->save($image);
            }
        }



        $product = Product::create([
            'category_id' => $request->category_id,
            'price' => $request->price,
            'offer' => $request->offer,
            'vendor_id' => $request->vendor_id,
        ]);
        $fabric->product()->save($product);

        $fabric->colors()->attach($request->colors);

        DB::commit();

        if ($vendor->type_activity == 'أقمشة') {
            $notification = array(
                'message' => 'تم اضافة المنتج بنجاح',
                'alert-type' => 'success'
            );

            return redirect()->route('vendor.profileFabric')->with($notification);

        } elseif ($vendor->type_activity == 'الاثنين معا') {
            $notification = array(
                'message' => 'تم اضافة المنتج بنجاح',
                'alert-type' => 'success'
            );

            return redirect()->route('vendor.profileBoth')->with($notification);
        }


    }

    public function saveProfilePhotoFabric(ProfilePhotoRequest $request, $vendor_id)
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

    public function saveProfileHeaderCoverFabric(HeaderPhotoRequest $request, $vendor_id)
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

    public function editProductFabric($id)
    {
        $social_media_link = SocialMediaLink::get();
        $user = Auth::guard('vendor')->user();
        $logo = LogoVendor::where('vendor_id' , $user->id)->first();
        $fabric = Fabric::find($id);

        if (!$fabric) {
            $notification = array(
                'message' => 'هذا المنتج غير موجود',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        } elseif ($fabric->product->vendor->id != $user->id){

            $notification = array(
                'message' => 'هذا المنتج ليس متاح لديك',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);

        }

        if ($user->type_activity == 'أقمشة'){

            $data = [];
            $data['vendors'] = Vendor::select('id', 'name')->get();
            $data['colors'] = Color::select('id', 'color')->get();
            $data['categories'] = Category::active()->select('id', 'name')->where('parent_id', 2)->get();

            $fabric_colors = collect();
            foreach ($fabric->colors as $colors){
                $fabric_colors []= $colors;

            }

            return view('site.vendor.fabric.editProduct', compact('fabric', 'data', 'fabric_colors', 'social_media_link', 'logo'));

        } elseif ($user->type_activity == 'الاثنين معا') {

            $data = [];
            $data['vendors'] = Vendor::select('id', 'name')->get();
            $data['colors'] = Color::select('id', 'color')->get();
            $data['categories'] = Category::active()->select('id', 'name')->where('parent_id', 2)->get();

            $fabric_colors = collect();
            foreach ($fabric->colors as $colors){
                $fabric_colors []= $colors;

            }
            return view('site.vendor.fabric.editProduct', compact('fabric', 'data','fabric_colors', 'social_media_link', 'logo'));

        } elseif ($user->type_activity == 'تفصيل') {

            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    public function updateProductFabric(FabricRequest $request, $id)
    {
        $vendor = Vendor::find($request->vendor_id);

        $fabric = Fabric::find($id);

        $notification = array(
            'message' => 'هذا المنتج غير موجود',
            'alert-type' => 'error'
        );

        if (!$fabric)
            return redirect()->route('vendor.profileFabric')->with($notification);

        DB::beginTransaction();
        $fabric->where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'vendor_id' => $request->vendor_id,
        ]);

        $filePath = "";
        if ($request->has('images') && count($request->images) > 0) {
            foreach ($fabric->images as $img){
                $image_path = public_path('assets/images/products/fabrics/') . $img->photo;
                unlink($image_path);
                $img->delete();
            }

            foreach ($request->images as $photo) {
                $filePath = uploadImage('fabrics', $photo);
                $image = Image::where('imageable_id', $fabric->id)->where('imageable_type','App\Models\Fabric')->create([
                    'photo' => $filePath
                ]);
                $fabric->images()->save($image);
            }
        }



        $product = Product::where('productable_id', $fabric->id)->where('productable_type','App\Models\Fabric')->update([
            'category_id' => $request->category_id,
            'price' => $request->price,
            'offer' => $request->offer,
            'vendor_id' => $request->vendor_id,
        ]);

        $fabric->colors()->sync($request->colors);

        DB::commit();

        if ($vendor->type_activity == 'أقمشة') {
            $notification = array(
                'message' => 'تم تحديث المنتج بنجاح',
                'alert-type' => 'success'
            );

            return redirect()->route('vendor.profileFabric')->with($notification);

        } elseif ($vendor->type_activity == 'الاثنين معا') {
            $notification = array(
                'message' => 'تم تحديث المنتج بنجاح',
                'alert-type' => 'success'
            );

            return redirect()->route('vendor.profileBoth')->with($notification);
        }

    }

    public function getContactUsFabric()
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

            return redirect()->route('vendor.aboutFabric')->with($notification);

        } elseif ($vendor->id != $user_id){
            $notification = array(
                'message' => 'انت غير مسجل دخول في النظام',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);

        }

        if ($vendor->type_activity == 'أقمشة') {

            return view('site.vendor.fabric.contactVendor',compact('vendor', 'social_media_link', 'logo'));

        }else{
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }


    }

    public function saveContactUsFabric(ContactVendorRequest $request) {
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

        return redirect()->route('vendor.contactUsFabric')->with($notification);

    }

    public function viewFabricProductDetails($fabric_id)
    {
        $social_media_link = SocialMediaLink::get();
        $vendor = Auth::guard('vendor')->user();
        $vendor_id = $vendor->id;
        $logo = LogoVendor::where('vendor_id' , $vendor_id)->first();

        $fabric = Fabric::where('vendor_id', $vendor_id)->find($fabric_id);


        if (!$fabric){
            $notification = array(
                'message' => 'هذا المنتج غير موجود',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        if ($vendor->type_activity == 'أقمشة') {
            $fabric_categories_ids =  $fabric -> product->category_id;
            $fabrics_related = Fabric::with('product')->when($fabric_categories_ids, function ($query) use ($fabric_categories_ids){
                $query->whereHas('product', function ($query) use ($fabric_categories_ids){
                    $query->where('category_id', $fabric_categories_ids);
                });
            })->when($vendor_id, function ($query) use ($vendor_id){
                $query->whereHas('product', function ($q) use ($vendor_id){
                    $q->where('vendor_id', $vendor_id);
                });
            })-> limit(6) -> latest() ->get();

            FabricResource::collection($fabrics_related);

            return view('site.vendor.fabric.productDetails', compact('fabric','fabrics_related', 'social_media_link', 'logo'));
        } elseif ($vendor->type_activity == 'الاثنين معا') {
            $fabric_categories_ids =  $fabric -> product->category_id;
            $fabrics_related = Fabric::with('product')->when($fabric_categories_ids, function ($query) use ($fabric_categories_ids){
                $query->whereHas('product', function ($query) use ($fabric_categories_ids){
                    $query->where('category_id', $fabric_categories_ids);
                });
            })->when($vendor_id, function ($query) use ($vendor_id){
                $query->whereHas('product', function ($q) use ($vendor_id){
                    $q->where('vendor_id', $vendor_id);
                });
            })-> limit(6) -> latest() ->get();

            FabricResource::collection($fabrics_related);

            return view('site.vendor.both.fabricProductDetails', compact('fabric','fabrics_related', 'social_media_link', 'logo'));
        } else {
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }



    }

    public function getSearchPageFabric()
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

            return redirect()->route('vendor.aboutFabric')->with($notification);

        }
        elseif ($vendor->id != $user_id) {
            $notification = array(
                'message' => 'انت غير مسجل دخول في النظام',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);

        }

        if ($vendor->type_activity == 'أقمشة') {

            return view('site.vendor.fabric.search', compact('vendor', 'social_media_link', 'logo'));

        } else {
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function getSearchFabric(Request $request)
    {
        $user_id = Auth::guard('vendor')->user()->id;
        $vendor = Vendor::find($user_id);
        $search = $request->input('search');
        $fabrics = Fabric::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->get();
        FabricResource::collection($fabrics);

        return view('site.vendor.fabric._productSearch', compact('fabrics','search','vendor'));

    }

    public function changePasswordFabric ()
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

            return redirect()->route('vendor.aboutFabric')->with($notification);

        }
        elseif ($vendor->id != $user_id) {
            $notification = array(
                'message' => 'انت غير مسجل دخول في النظام',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);

        }

        if ($vendor->type_activity == 'أقمشة') {

            return view('site.vendor.fabric.changePassword', compact('vendor', 'social_media_link', 'logo'));

        } else {
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    public function updatePasswordFabric (ChangePasswordRequest $request)
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
            return redirect()->route('vendor.profileFabric')->with($notification);

        } else {
            $notification = array(
                'message' => 'كلمة المرور القديمة غير صحيحة ',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    public function purseFabric(Request $request)
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

            return redirect()->route('vendor.aboutFabric')->with($notification);

        } elseif ($vendor->id != $user_id) {
            $notification = array(
                'message' => 'انت غير مسجل دخول في النظام',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);

        }

        if ($vendor->type_activity == 'أقمشة') {
            $data = [];
            $data['vendors'] = Vendor::select('id', 'name')->get();
            $data['categories'] = Category::active()->select('id', 'name')->where('parent_id', 2)->get();
            $purchases = Purchase::get();

            $product_id = [];

            foreach ($purchases as $purchase) {
                array_push($product_id, $purchase->product_id);
            }

            $products = Product::whereIn('id', $product_id)->get();

            $fabric_id = [];
            foreach ($products as $product) {

                if ($product->productable_type == 'App\Models\Fabric') {
                    array_push($fabric_id, $product->productable_id);
                }
            }

            $fabrics = Fabric::whereIn('id', $fabric_id)->get();

            $purchases_fabric = [];
            foreach ($purchases as $purchase) {
                foreach ($products as $product) {
                    if ($product->productable_type == 'App\Models\Fabric') {
                        if ($product->id == $purchase->product_id) {
                            if ($product->vendor_id == $vendor->id) {
                                array_push($purchases_fabric, $purchase);
                            }

                        }

                    }
                }
            }

            $total_price = 0;

            foreach ($purchases_fabric as $purchase) {
                foreach ($products as $product) {
                    foreach ($fabrics as $fabric) {
                        if ($fabric->id == $product->productable_id) {
                            if ($product->productable_type == 'App\Models\Fabric') {
                                if ($purchase->product_id == $product->id) {
                                    $total_price += $fabric->product->price * $purchase->quantity;

                                }
                            }
                        }
                    }
                }

            }


            if ($request->ajax()) {

                return DataTables::of($purchases_fabric)
                    ->addIndexColumn()
                    ->addColumn('order_id', function ($row) {
                        $purchases = Purchase::get();
                        $orders = Order::get();

                        $user_id = Auth::guard('vendor')->user()->id;
                        $vendor = Vendor::find($user_id);

                        $product_id = [];

                        foreach ($purchases as $purchase) {
                            array_push($product_id, $purchase->product_id);
                        }

                        $products = Product::whereIn('id', $product_id)->get();

                        $fabric_id = [];
                        foreach ($products as $product) {

                            if ($product->productable_type == 'App\Models\Fabric') {
                                array_push($fabric_id, $product->productable_id);
                            }
                        }

                        $fabrics = Fabric::whereIn('id', $fabric_id)->get();
                        $purchases_fabric = [];
                        foreach ($purchases as $purchase) {
                            foreach ($products as $product) {
                                if ($product->productable_type == 'App\Models\Fabric') {
                                    if ($product->id == $purchase->product_id) {
                                        if ($product->vendor_id == $vendor->id) {
                                            array_push($purchases_fabric, $purchase);
                                        }

                                    }

                                }
                            }
                        }
                        foreach ($purchases_fabric as $purchase) {
                            foreach ($products as $product) {
                                foreach ($fabrics as $fabric) {
                                    if ($fabric->id == $product->productable_id) {
                                        if ($product->productable_type == 'App\Models\Fabric') {
                                            if ($row->product_id == $product->id) {
                                                return $row->order_id;

                                            }
                                        }
                                    }
                                }
                            }

                        }
                    })
                    ->addColumn('customer', function ($row) {
                        return $row->customer->name;
                    })
                    ->addColumn('product_name', function ($row) {
                        $purchases = Purchase::get();
                        $user_id = Auth::guard('vendor')->user()->id;
                        $vendor = Vendor::find($user_id);

                        $product_id = [];

                        foreach ($purchases as $purchase) {
                            array_push($product_id, $purchase->product_id);
                        }

                        $products = Product::whereIn('id', $product_id)->get();

                        $fabric_id = [];
                        foreach ($products as $product) {

                            if ($product->productable_type == 'App\Models\Fabric') {
                                array_push($fabric_id, $product->productable_id);
                            }
                        }

                        $fabrics = Fabric::whereIn('id', $fabric_id)->get();
                        $purchases_fabric = [];
                        foreach ($purchases as $purchase) {
                            foreach ($products as $product) {
                                if ($product->productable_type == 'App\Models\Fabric') {
                                    if ($product->id == $purchase->product_id) {
                                        if ($product->vendor_id == $vendor->id) {
                                            array_push($purchases_fabric, $purchase);
                                        }

                                    }

                                }
                            }
                        }
                        foreach ($purchases_fabric as $purchase) {
                            foreach ($products as $product) {
                                foreach ($fabrics as $fabric) {
                                    if ($fabric->id == $product->productable_id) {
                                        if ($product->productable_type == 'App\Models\Fabric') {
                                            if ($row->product_id == $product->id) {
                                                return $fabric->name;

                                            }
                                        }
                                    }
                                }
                            }

                        }

                    })
                    ->addColumn('category', function ($row) {
                        $purchases = Purchase::get();
                        $user_id = Auth::guard('vendor')->user()->id;
                        $vendor = Vendor::find($user_id);

                        $product_id = [];

                        foreach ($purchases as $purchase) {
                            array_push($product_id, $purchase->product_id);
                        }

                        $products = Product::whereIn('id', $product_id)->get();

                        $fabric_id = [];
                        foreach ($products as $product) {

                            if ($product->productable_type == 'App\Models\Fabric') {
                                array_push($fabric_id, $product->productable_id);
                            }
                        }

                        $fabrics = Fabric::whereIn('id', $fabric_id)->get();
                        $purchases_fabric = [];
                        foreach ($purchases as $purchase) {
                            foreach ($products as $product) {
                                if ($product->productable_type == 'App\Models\Fabric') {
                                    if ($product->id == $purchase->product_id) {
                                        if ($product->vendor_id == $vendor->id) {
                                            array_push($purchases_fabric, $purchase);
                                        }

                                    }

                                }
                            }
                        }
                        foreach ($purchases_fabric as $purchase) {
                            foreach ($products as $product) {
                                foreach ($fabrics as $fabric) {
                                    if ($fabric->id == $product->productable_id) {
                                        if ($product->productable_type == 'App\Models\Fabric') {
                                            if ($row->product_id == $product->id) {
                                                return $fabric->product->category->name;

                                            }
                                        }
                                    }
                                }
                            }

                        }
                    })
                    ->addColumn('created_at', function ($row) {
                        return $row->created_at;
                    })
                    ->addColumn('price', function ($row) {
                        $purchases = Purchase::get();
                        $user_id = Auth::guard('vendor')->user()->id;
                        $vendor = Vendor::find($user_id);

                        $product_id = [];

                        foreach ($purchases as $purchase) {
                            array_push($product_id, $purchase->product_id);
                        }

                        $products = Product::whereIn('id', $product_id)->get();

                        $fabric_id = [];
                        foreach ($products as $product) {

                            if ($product->productable_type == 'App\Models\Fabric') {
                                array_push($fabric_id, $product->productable_id);
                            }
                        }

                        $fabrics = Fabric::whereIn('id', $fabric_id)->get();
                        $purchases_fabric = [];
                        foreach ($purchases as $purchase) {
                            foreach ($products as $product) {
                                if ($product->productable_type == 'App\Models\Fabric') {
                                    if ($product->id == $purchase->product_id) {
                                        if ($product->vendor_id == $vendor->id) {
                                            array_push($purchases_fabric, $purchase);
                                        }

                                    }

                                }
                            }
                        }
                        foreach ($purchases_fabric as $purchase) {
                            foreach ($products as $product) {
                                foreach ($fabrics as $fabric) {
                                    if ($fabric->id == $product->productable_id) {
                                        if ($product->productable_type == 'App\Models\Fabric') {
                                            if ($row->product_id == $product->id) {
                                                if ($fabric->product->offer != '') {
                                                    return $fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer);
                                                } else {
                                                    return $fabric->product->price;
                                                }

                                            }
                                        }
                                    }
                                }
                            }

                        }
                    })
                    ->addColumn('number_of_meters', function ($row) {
                        return $row->number_of_meters;
                    })

                    ->addColumn('quantity', function ($row) {
                        return $row->quantity;
                    })

                    ->addColumn('total_price', function ($row) {
                        $purchases = Purchase::get();
                        $user_id = Auth::guard('vendor')->user()->id;
                        $vendor = Vendor::find($user_id);

                        $product_id = [];

                        foreach ($purchases as $purchase) {
                            array_push($product_id, $purchase->product_id);
                        }

                        $products = Product::whereIn('id', $product_id)->get();

                        $fabric_id = [];
                        foreach ($products as $product) {

                            if ($product->productable_type == 'App\Models\Fabric') {
                                array_push($fabric_id, $product->productable_id);
                            }
                        }

                        $fabrics = Fabric::whereIn('id', $fabric_id)->get();
                        $purchases_fabric = [];
                        foreach ($purchases as $purchase) {
                            foreach ($products as $product) {
                                if ($product->productable_type == 'App\Models\Fabric') {
                                    if ($product->id == $purchase->product_id) {
                                        if ($product->vendor_id == $vendor->id) {
                                            array_push($purchases_fabric, $purchase);
                                        }

                                    }

                                }
                            }
                        }
                        foreach ($purchases_fabric as $purchase) {
                            foreach ($products as $product) {
                                foreach ($fabrics as $fabric) {
                                    if ($fabric->id == $product->productable_id) {
                                        if ($product->productable_type == 'App\Models\Fabric') {
                                            if ($row->product_id == $product->id) {
                                                if ($fabric->product->offer != '') {
                                                    return ($fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)) * $row->quantity + ($fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)) * $row->number_of_meters;
                                                } else {
                                                    return ($fabric->product->price * $row->quantity) + ($fabric->product->price * $row->number_of_meters);
                                                }

                                            }
                                        }
                                    }
                                }
                            }

                        }
                    })
                    ->rawColumns(['price'])
                    ->make(true);

            }




            return view('site.vendor.fabric.purse', compact('vendor', 'social_media_link', 'logo'));

        } elseif ($vendor->type_activity == 'الاثنين معا') {
            $data = [];
            $data['vendors'] = Vendor::select('id', 'name')->get();
            $data['categories'] = Category::active()->select('id', 'name')->where('parent_id', 2)->get();
            $purchases = Purchase::get();

            $product_id = [];

            foreach ($purchases as $purchase) {
                array_push($product_id, $purchase->product_id);
            }

            $products = Product::whereIn('id', $product_id)->get();

            $fabric_id = [];
            foreach ($products as $product) {

                if ($product->productable_type == 'App\Models\Fabric') {
                    array_push($fabric_id, $product->productable_id);
                }
            }

            $fabrics = Fabric::whereIn('id', $fabric_id)->get();

            $purchases_fabric = [];
            foreach ($purchases as $purchase) {
                foreach ($products as $product) {
                    if ($product->productable_type == 'App\Models\Fabric') {
                        if ($product->id == $purchase->product_id) {
                            if ($product->vendor_id == $vendor->id) {
                                array_push($purchases_fabric, $purchase);
                            }

                        }

                    }
                }
            }

            $total_price = 0;

            foreach ($purchases_fabric as $purchase) {
                foreach ($products as $product) {
                    foreach ($fabrics as $fabric) {
                        if ($fabric->id == $product->productable_id) {
                            if ($product->productable_type == 'App\Models\Fabric') {
                                if ($purchase->product_id == $product->id) {
                                    $total_price += $fabric->product->price * $purchase->quantity;

                                }
                            }
                        }
                    }
                }

            }


            if ($request->ajax()) {

                return DataTables::of($purchases_fabric)
                    ->addIndexColumn()
                    ->addColumn('order_id', function ($row) {
                        $purchases = Purchase::get();
                        $orders = Order::get();

                        $user_id = Auth::guard('vendor')->user()->id;
                        $vendor = Vendor::find($user_id);

                        $product_id = [];

                        foreach ($purchases as $purchase) {
                            array_push($product_id, $purchase->product_id);
                        }

                        $products = Product::whereIn('id', $product_id)->get();

                        $fabric_id = [];
                        foreach ($products as $product) {

                            if ($product->productable_type == 'App\Models\Fabric') {
                                array_push($fabric_id, $product->productable_id);
                            }
                        }

                        $fabrics = Fabric::whereIn('id', $fabric_id)->get();
                        $purchases_fabric = [];
                        foreach ($purchases as $purchase) {
                            foreach ($products as $product) {
                                if ($product->productable_type == 'App\Models\Fabric') {
                                    if ($product->id == $purchase->product_id) {
                                        if ($product->vendor_id == $vendor->id) {
                                            array_push($purchases_fabric, $purchase);
                                        }

                                    }

                                }
                            }
                        }
                        foreach ($purchases_fabric as $purchase) {
                            foreach ($products as $product) {
                                foreach ($fabrics as $fabric) {
                                    if ($fabric->id == $product->productable_id) {
                                        if ($product->productable_type == 'App\Models\Fabric') {
                                            if ($row->product_id == $product->id) {
                                                return $row->order_id;

                                            }
                                        }
                                    }
                                }
                            }

                        }
                    })
                    ->addColumn('customer', function ($row) {
                        return $row->customer->name;
                    })
                    ->addColumn('product_name', function ($row) {
                        $purchases = Purchase::get();
                        $user_id = Auth::guard('vendor')->user()->id;
                        $vendor = Vendor::find($user_id);

                        $product_id = [];

                        foreach ($purchases as $purchase) {
                            array_push($product_id, $purchase->product_id);
                        }

                        $products = Product::whereIn('id', $product_id)->get();

                        $fabric_id = [];
                        foreach ($products as $product) {

                            if ($product->productable_type == 'App\Models\Fabric') {
                                array_push($fabric_id, $product->productable_id);
                            }
                        }

                        $fabrics = Fabric::whereIn('id', $fabric_id)->get();
                        $purchases_fabric = [];
                        foreach ($purchases as $purchase) {
                            foreach ($products as $product) {
                                if ($product->productable_type == 'App\Models\Fabric') {
                                    if ($product->id == $purchase->product_id) {
                                        if ($product->vendor_id == $vendor->id) {
                                            array_push($purchases_fabric, $purchase);
                                        }

                                    }

                                }
                            }
                        }
                        foreach ($purchases_fabric as $purchase) {
                            foreach ($products as $product) {
                                foreach ($fabrics as $fabric) {
                                    if ($fabric->id == $product->productable_id) {
                                        if ($product->productable_type == 'App\Models\Fabric') {
                                            if ($row->product_id == $product->id) {
                                                return $fabric->name;

                                            }
                                        }
                                    }
                                }
                            }

                        }

                    })
                    ->addColumn('category', function ($row) {
                        $purchases = Purchase::get();
                        $user_id = Auth::guard('vendor')->user()->id;
                        $vendor = Vendor::find($user_id);

                        $product_id = [];

                        foreach ($purchases as $purchase) {
                            array_push($product_id, $purchase->product_id);
                        }

                        $products = Product::whereIn('id', $product_id)->get();

                        $fabric_id = [];
                        foreach ($products as $product) {

                            if ($product->productable_type == 'App\Models\Fabric') {
                                array_push($fabric_id, $product->productable_id);
                            }
                        }

                        $fabrics = Fabric::whereIn('id', $fabric_id)->get();
                        $purchases_fabric = [];
                        foreach ($purchases as $purchase) {
                            foreach ($products as $product) {
                                if ($product->productable_type == 'App\Models\Fabric') {
                                    if ($product->id == $purchase->product_id) {
                                        if ($product->vendor_id == $vendor->id) {
                                            array_push($purchases_fabric, $purchase);
                                        }

                                    }

                                }
                            }
                        }
                        foreach ($purchases_fabric as $purchase) {
                            foreach ($products as $product) {
                                foreach ($fabrics as $fabric) {
                                    if ($fabric->id == $product->productable_id) {
                                        if ($product->productable_type == 'App\Models\Fabric') {
                                            if ($row->product_id == $product->id) {
                                                return $fabric->product->category->name;

                                            }
                                        }
                                    }
                                }
                            }

                        }
                    })
                    ->addColumn('created_at', function ($row) {
                        return $row->created_at;
                    })
                    ->addColumn('price', function ($row) {
                        $purchases = Purchase::get();
                        $user_id = Auth::guard('vendor')->user()->id;
                        $vendor = Vendor::find($user_id);

                        $product_id = [];

                        foreach ($purchases as $purchase) {
                            array_push($product_id, $purchase->product_id);
                        }

                        $products = Product::whereIn('id', $product_id)->get();

                        $fabric_id = [];
                        foreach ($products as $product) {

                            if ($product->productable_type == 'App\Models\Fabric') {
                                array_push($fabric_id, $product->productable_id);
                            }
                        }

                        $fabrics = Fabric::whereIn('id', $fabric_id)->get();
                        $purchases_fabric = [];
                        foreach ($purchases as $purchase) {
                            foreach ($products as $product) {
                                if ($product->productable_type == 'App\Models\Fabric') {
                                    if ($product->id == $purchase->product_id) {
                                        if ($product->vendor_id == $vendor->id) {
                                            array_push($purchases_fabric, $purchase);
                                        }

                                    }

                                }
                            }
                        }
                        foreach ($purchases_fabric as $purchase) {
                            foreach ($products as $product) {
                                foreach ($fabrics as $fabric) {
                                    if ($fabric->id == $product->productable_id) {
                                        if ($product->productable_type == 'App\Models\Fabric') {
                                            if ($row->product_id == $product->id) {
                                                if ($fabric->product->offer != '') {
                                                    return $fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer);
                                                } else {
                                                    return $fabric->product->price;
                                                }


                                            }
                                        }
                                    }
                                }
                            }

                        }
                    })
                    ->addColumn('number_of_meters', function ($row) {
                        return $row->number_of_meters;
                    })
                    ->addColumn('quantity', function ($row) {
                        return $row->quantity;
                    })
                    ->addColumn('total_price', function ($row) {
                        $purchases = Purchase::get();
                        $user_id = Auth::guard('vendor')->user()->id;
                        $vendor = Vendor::find($user_id);

                        $product_id = [];

                        foreach ($purchases as $purchase) {
                            array_push($product_id, $purchase->product_id);
                        }

                        $products = Product::whereIn('id', $product_id)->get();

                        $fabric_id = [];
                        foreach ($products as $product) {

                            if ($product->productable_type == 'App\Models\Fabric') {
                                array_push($fabric_id, $product->productable_id);
                            }
                        }

                        $fabrics = Fabric::whereIn('id', $fabric_id)->get();
                        $purchases_fabric = [];
                        foreach ($purchases as $purchase) {
                            foreach ($products as $product) {
                                if ($product->productable_type == 'App\Models\Fabric') {
                                    if ($product->id == $purchase->product_id) {
                                        if ($product->vendor_id == $vendor->id) {
                                            array_push($purchases_fabric, $purchase);
                                        }

                                    }

                                }
                            }
                        }
                        foreach ($purchases_fabric as $purchase) {
                            foreach ($products as $product) {
                                foreach ($fabrics as $fabric) {
                                    if ($fabric->id == $product->productable_id) {
                                        if ($product->productable_type == 'App\Models\Fabric') {
                                            if ($row->product_id == $product->id) {
                                                if ($fabric->product->offer != '') {
                                                    return ($fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)) * $row->quantity + ($fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)) * $row->number_of_meters;
                                                } else {
                                                    return ($fabric->product->price * $row->quantity) + ($fabric->product->price * $row->number_of_meters);
                                                }


                                            }
                                        }
                                    }
                                }
                            }

                        }
                    })
                    ->rawColumns(['price'])
                    ->make(true);

            }

            return view('site.vendor.both.purseFabric', compact('vendor', 'social_media_link', 'logo'));

        } else {
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
