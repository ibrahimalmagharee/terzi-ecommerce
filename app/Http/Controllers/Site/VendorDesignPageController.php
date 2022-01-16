<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ChangePasswordRequest;
use App\Http\Requests\Site\DesignRequest;
use App\Http\Requests\Dashboard\ProfilePhotoRequest;
use App\Http\Requests\Dashboard\VendorRequest;
use App\Http\Requests\Site\ContactVendorRequest;
use App\Http\Requests\Site\HeaderPhotoRequest;
use App\Http\Requests\Site\VendorAccountRequest;
use App\Http\Resources\DesignResource;
use App\Mail\ContactFormMail;
use App\Models\AboutVendor;
use App\Models\Category;
use App\Models\ContactVendor;
use App\Models\Design;
use App\Models\Image;
use App\Models\LogoVendor;
use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\SocialMediaLink;
use App\Models\Type;
use App\Models\Vendor;
use App\Models\VendorHeaderCover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class VendorDesignPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('vendor-design');
    }

    public function about()
    {

        $social_media_link = SocialMediaLink::get();
        $vendor = Auth::user();
        $logo = LogoVendor::where('vendor_id' , $vendor->id)->first();
        $data = [];
        $data['about_vendor'] = AboutVendor::get();

        if ($vendor->type_activity == 'تفصيل') {
            return view('site.vendor.design.about', compact('vendor', 'data', 'social_media_link', 'logo'));

        } else {
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    public function getProfileDesign()
    {
        $social_media_link = SocialMediaLink::get();
        $user_id = Auth::guard('vendor')->user()->id;
        $logo = LogoVendor::where('vendor_id' , $user_id)->first();
        $vendor = Vendor::with('headerCover')->find($user_id);
        if (!$vendor) {
            $notification = array(
                'message' => 'هذا التاجر غير موجود',
                'alert-type' => 'error'
            );

            return redirect()->route('vendor.aboutDesign')->with($notification);

        } elseif ($vendor->id != $user_id) {
            $notification = array(
                'message' => 'انت غير مسجل دخول في النظام',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);

        }

        if ($vendor->type_activity == 'تفصيل') {
            $designs = Design::all();
            DesignResource::collection($designs);
            return view('site.vendor.design.companyProfile', compact('vendor', 'designs', 'social_media_link', 'logo'));
        } else {
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    public function viewProductsDesign()
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

        } elseif ($vendor->id != $user_id) {

            $notification = array(
                'message' => 'انت غير مسجل دخول في النظام',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);


        }

        if ($vendor->type_activity == 'تفصيل') {
            $designs = Design::all();
            DesignResource::collection($designs);

            return view('site.vendor.design.viewProducts', compact('vendor', 'designs', 'social_media_link', 'logo'));

        } elseif ($vendor->type_activity == 'الاثنين معا') {
            $designs = Design::all();
            DesignResource::collection($designs);


            return view('site.vendor.both.viewProductsDesign', compact('vendor', 'designs', 'social_media_link', 'logo'));

        } elseif ($vendor->type_activity == 'أقمشة') {
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    public function editAccountDesign()
    {
        $user_id = Auth::guard('vendor')->user()->id;
        $vendor = Vendor::find($user_id);
        return response()->json($vendor);
    }


    public function updateAccountDesign(VendorAccountRequest $request)
    {
        $vendor = Vendor::find($request->id);

        $notification = array(
            'message' => 'هذا التاجر غير موجود',
            'alert-type' => 'error'
        );
        if (!$vendor)
            return redirect()->route('vendor.aboutDesign')->with($notification);

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
            'vendor' => $request->name,
            'msg' => 'تم تحديث الحساب بنجاح'
        ]);
    }

    public function addProductDesign()
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

        } elseif ($vendor->id != $user_id) {

            $notification = array(
                'message' => 'انت غير مسجل دخول في النظام',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);


        }
        if ($vendor->type_activity == 'تفصيل') {

            $data = [];
            $data['types'] = Type::select('id', 'name')->get();
            $data['categories'] = Category::active()->select('id', 'name')->where('parent_id', 1)->get();

            return view('site.vendor.design.addProduct', compact('vendor', 'data', 'social_media_link', 'logo'));


        } elseif ($vendor->type_activity == 'الاثنين معا') {

            $data = [];
            $data['types'] = Type::select('id', 'name')->get();
            $data['categories'] = Category::active()->select('id', 'name')->where('parent_id', 1)->get();

            return view('site.vendor.both.addProductDesign', compact('vendor', 'data', 'social_media_link', 'logo'));


        } elseif ($vendor->type_activity == 'أقمشة') {
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    public function saveProductDesign(DesignRequest $request)
    {
        $vendor = Vendor::find($request->vendor_id);

        DB::beginTransaction();
        $design = Design::create([
            'name' => $request->name,
            'type_id' => $request->type_id,
            'description' => $request->description,
            'vendor_id' => $request->vendor_id,

        ]);

        $filePath = "";
        if ($request->has('images') && count($request->images) > 0) {
            foreach ($request->images as $photo) {
                $filePath = uploadImage('designs', $photo);
                $image = Image::create([
                    'photo' => $filePath
                ]);
                $design->images()->save($image);

            }
        }


        $product = Product::create([
            'category_id' => $request->category_id,
            'price' => $request->price,
            'offer' => $request->offer,
            'vendor_id' => $request->vendor_id,
        ]);
        $design->product()->save($product);


        DB::commit();

        if ($vendor->type_activity == 'تفصيل') {
            $notification = array(
                'message' => 'تم اضافة المنتج بنجاح',
                'alert-type' => 'success'
            );

            return redirect()->route('vendor.profileDesign')->with($notification);

        } elseif ($vendor->type_activity == 'الاثنين معا') {
            $notification = array(
                'message' => 'تم اضافة المنتج بنجاح',
                'alert-type' => 'success'
            );

            return redirect()->route('vendor.profileBoth')->with($notification);
        }

    }


    public function saveProfilePhotoDesign(ProfilePhotoRequest $request, $vendor_id)
    {
        $vendor = Vendor::find($vendor_id);

        if ($request->has('photo')) {
            $image_path = public_path('assets/images/vendors/profile/') . $vendor->image->photo;
            if ($vendor->image->photo != 'user-profile.png') {
                unlink($image_path);
            }
            $filePath = uploadImage('profile', $request->photo);
            $image = Image::where('imageable_id', $vendor->id)->where('imageable_type', 'App\Models\Vendor')->update([
                'photo' => $filePath
            ]);
        }


        return response()->json([
            'status' => true,
            'photo' => $vendor->getPhoto($filePath),
            'msg' => 'تم تحديث صورة الملف الشخصي بنجاح'
        ]);



    }

    public function saveProfileHeaderCoverDesign(HeaderPhotoRequest $request, $vendor_id)
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

    public function editProductDesign($id)
    {
        $social_media_link = SocialMediaLink::get();
        $user = Auth::guard('vendor')->user();
        $logo = LogoVendor::where('vendor_id' , $user->id)->first();
        $design = Design::find($id);

        if (!$design) {
            $notification = array(
                'message' => 'هذا المنتج غير موجود',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);

        } elseif ($design->product->vendor->id != $user->id) {
            $notification = array(
                'message' => 'هذا المنتج ليس متاح لديك ',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);

        }

        if ($user->type_activity == 'تفصيل') {

            $data = [];
            $data['vendors'] = Vendor::select('id', 'name')->get();
            $data['types'] = Type::select('id', 'name')->get();
            $data['categories'] = Category::active()->select('id', 'name')->where('parent_id', 1)->get();

            return view('site.vendor.design.editProduct', compact('design', 'data', 'social_media_link', 'logo'));


        } elseif ($user->type_activity == 'الاثنين معا') {

            $data = [];
            $data['vendors'] = Vendor::select('id', 'name')->get();
            $data['types'] = Type::select('id', 'name')->get();
            $data['categories'] = Category::active()->select('id', 'name')->where('parent_id', 1)->get();

            return view('site.vendor.both.editProductDesign', compact('design', 'data','social_media_link', 'logo'));


        } elseif ($user->type_activity == 'أقمشة') {
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    public function updateProductDesign(DesignRequest $request, $id)
    {
        $vendor = Vendor::find($request->vendor_id);

        $design = Design::find($id);

        $notification = array(
            'message' => 'هذا المنتج غير موجود',
            'alert-type' => 'error'
        );

        if (!$design)
            return redirect()->route('vendor.profileDesign')->with($notification);

        DB::beginTransaction();
        $design->where('id', $id)->update([
            'name' => $request->name,
            'type_id' => $request->type_id,
            'description' => $request->description,
        ]);


        $filePath = "";
        if ($request->has('images') && count($request->images) > 0) {
            foreach ($design->images as $img) {
                $image_path = public_path('assets/images/products/designs/') . $img->photo;
                unlink($image_path);
                $img->delete();
            }

            foreach ($request->images as $photo) {
                $filePath = uploadImage('designs', $photo);
                $image = Image::where('imageable_id', $design->id)->where('imageable_type', 'App\Models\Design')->create([
                    'photo' => $filePath
                ]);
                $design->images()->save($image);
            }
        }


        $product = Product::where('productable_id', $design->id)->where('productable_type', 'App\Models\Design')->update([
            'category_id' => $request->category_id,
            'price' => $request->price,
            'offer' => $request->offer,
            'vendor_id' => $request->vendor_id,
        ]);

        DB::commit();

        if ($vendor->type_activity == 'تفصيل') {
            $notification = array(
                'message' => 'تم تحديث المنتج بنجاح',
                'alert-type' => 'success'
            );

            return redirect()->route('vendor.profileDesign')->with($notification);

        } elseif ($vendor->type_activity == 'الاثنين معا') {
            $notification = array(
                'message' => 'تم تحديث المنتج بنجاح',
                'alert-type' => 'success'
            );

            return redirect()->route('vendor.profileBoth')->with($notification);
        }

    }

    public function getContactUsDesign()
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

            return redirect()->route('vendor.aboutDesign')->with($notification);

        } elseif ($vendor->id != $user_id) {
            $notification = array(
                'message' => 'انت غير مسجل دخول في النظام',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);

        }

        if ($vendor->type_activity == 'تفصيل') {
            return view('site.vendor.design.contactVendor', compact('vendor', 'social_media_link', 'logo'));

        } else {
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }


    }

    public function saveContactUsDesign(ContactVendorRequest $request)
    {
        DB::beginTransaction();
        $contact = ContactVendor::create([
            'vendor_id' => $request->vendor_id,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address_request' => $request->address_request,
            'message' => $request->message,
        ]);

        $contact->save();


        // Mail::to('ibrahimalmagree@gmail.com')->send(new ContactFormMail($contact));

        DB::commit();

        $notification = array(
            'message' => 'تم ارسال الرسالة بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.contactUsDesign')->with($notification);

    }

    public function viewDesignProductDetails($design_id)
    {
        $social_media_link = SocialMediaLink::get();
        $vendor = Auth::guard('vendor')->user();
        $vendor_id = $vendor->id;
        $logo = LogoVendor::where('vendor_id' , $vendor_id)->first();
        $design = Design::where('vendor_id', $vendor_id)->with('product')->find($design_id);


        // dd($design->images);
        if (!$design) {
            $notification = array(
                'message' => 'هذا المنتج غير موجود',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        if ($vendor->type_activity == 'تفصيل') {
            $design_categories_id = $design->product->category_id;
            $designs_related = Design::with('product')->when($design_categories_id, function ($query) use ($design_categories_id) {
                $query->whereHas('product', function ($query) use ($design_categories_id) {
                    $query->where('category_id', $design_categories_id);
                });
            })->when($vendor_id, function ($query) use ($vendor_id) {
                $query->whereHas('product', function ($q) use ($vendor_id) {
                    $q->where('vendor_id', $vendor_id);
                });
            })->limit(6)->latest()->get();

            DesignResource::collection($designs_related);

            return view('site.vendor.design.productDetails', compact('design', 'designs_related', 'social_media_link', 'logo'));
        } elseif ($vendor->type_activity == 'الاثنين معا') {
            $design_categories_id = $design->product->category_id;
            $designs_related = Design::with('product')->when($design_categories_id, function ($query) use ($design_categories_id) {
                $query->whereHas('product', function ($query) use ($design_categories_id) {
                    $query->where('category_id', $design_categories_id);
                });
            })->when($vendor_id, function ($query) use ($vendor_id) {
                $query->whereHas('product', function ($q) use ($vendor_id) {
                    $q->where('vendor_id', $vendor_id);
                });
            })->limit(6)->latest()->get();

            DesignResource::collection($designs_related);

            return view('site.vendor.both.designProductDetails', compact('design', 'designs_related', 'social_media_link', 'logo'));
        } else {
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }


    }

    public function getSearchPageDesign()
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

            return redirect()->route('vendor.aboutDesign')->with($notification);

        } elseif ($vendor->id != $user_id) {
            $notification = array(
                'message' => 'انت غير مسجل دخول في النظام',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);

        }

        if ($vendor->type_activity == 'تفصيل') {

            return view('site.vendor.design.search', compact('vendor', 'social_media_link', 'logo'));

        } else {
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function getSearchDesign(Request $request)
    {
        $user_id = Auth::guard('vendor')->user()->id;
        $logo = LogoVendor::where('vendor_id' , $user_id)->first();
        $vendor = Vendor::find($user_id);
        $search = $request->input('search');

        $designs = Design::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->get();
        DesignResource::collection($designs);

        return view('site.vendor.design._productSearch', compact('designs','search','vendor'));

    }

    public function changePasswordDesign()
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

            return redirect()->route('vendor.aboutDesign')->with($notification);

        } elseif ($vendor->id != $user_id) {
            $notification = array(
                'message' => 'انت غير مسجل دخول في النظام',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);

        }

        if ($vendor->type_activity == 'تفصيل') {

            return view('site.vendor.design.changePassword', compact('vendor', 'social_media_link', 'logo'));

        } else {
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    public function updatePasswordDesign(ChangePasswordRequest $request)
    {
        $vendor = Auth::guard('vendor')->user();

        if (Hash::check($request->input('old_password'), $vendor->password)) {
            $vendor = Vendor::where('id', $vendor->id)->update([
                'password' => bcrypt($request->password)
            ]);

            $notification = array(
                'message' => 'تم تغيير كلمة المرور بنجاح',
                'alert-type' => 'success'
            );
            return redirect()->route('vendor.profileDesign')->with($notification);

        } else {
            $notification = array(
                'message' => 'كلمة المرور القديمة غير صحيحة ',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    public function purseDesign(Request $request)
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

            return redirect()->route('vendor.aboutDesign')->with($notification);

        } elseif ($vendor->id != $user_id) {
            $notification = array(
                'message' => 'انت غير مسجل دخول في النظام',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);

        }

        if ($vendor->type_activity == 'تفصيل') {
            $data = [];
            $data['vendors'] = Vendor::select('id', 'name')->get();
            $data['categories'] = Category::active()->select('id', 'name')->where('parent_id', 1)->get();


            $purchases = Purchase::get();

            $product_id = [];

            foreach ($purchases as $purchase) {
                array_push($product_id, $purchase->product_id);
            }

            $products = Product::whereIn('id', $product_id)->get();

            $design_id = [];
            foreach ($products as $product) {

                if ($product->productable_type == 'App\Models\Design') {
                    array_push($design_id, $product->productable_id);
                }
            }

            $designs = Design::whereIn('id', $design_id)->get();

            $purchases_design = [];
            foreach ($purchases as $purchase) {
                foreach ($products as $product) {
                    if ($product->productable_type == 'App\Models\Design') {
                        if ($product->id == $purchase->product_id) {
                            if ($product->vendor_id == $vendor->id) {
                                array_push($purchases_design, $purchase);
                            }
                        }

                    }
                }
            }

            $total_price = 0;

            foreach ($purchases_design as $purchase) {
                foreach ($products as $product) {
                    foreach ($designs as $design) {
                        if ($design->id == $product->productable_id) {
                            if ($product->productable_type == 'App\Models\Design') {
                                if ($purchase->product_id == $product->id) {
                                    $total_price += $design->product->price * $purchase->quantity;

                                }
                            }
                        }
                    }
                }

            }


            if ($request->ajax()) {

                return DataTables::of($purchases_design)
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

                        $design_id = [];
                        foreach ($products as $product) {

                            if ($product->productable_type == 'App\Models\Design') {
                                array_push($design_id, $product->productable_id);
                            }
                        }
                        $designs = Design::whereIn('id', $design_id)->get();
                        $purchases_design = [];
                        foreach ($purchases as $purchase) {
                            foreach ($products as $product) {
                                if ($product->productable_type == 'App\Models\Design') {
                                    if ($product->id == $purchase->product_id) {
                                        if ($product->vendor_id == $vendor->id) {
                                            array_push($purchases_design, $purchase);
                                        }
                                    }

                                }


                            }
                        }
                        foreach ($purchases_design as $purchase) {
                            foreach ($products as $product) {
                                foreach ($designs as $design) {
                                    foreach ($orders as $order) {
                                        if ($design->id == $product->productable_id) {
                                            if ($product->productable_type == 'App\Models\Design') {
                                                if ($row->product_id == $product->id) {
                                                    if ($order->id == $row->order_id) {
                                                        return $row->order_id;
                                                    }
                                                }
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

                        $design_id = [];
                        foreach ($products as $product) {

                            if ($product->productable_type == 'App\Models\Design') {
                                array_push($design_id, $product->productable_id);
                            }
                        }
                        $designs = Design::whereIn('id', $design_id)->get();
                        $purchases_design = [];
                        foreach ($purchases as $purchase) {
                            foreach ($products as $product) {
                                if ($product->productable_type == 'App\Models\Design') {
                                    if ($product->id == $purchase->product_id) {
                                        if ($product->vendor_id == $vendor->id) {
                                            array_push($purchases_design, $purchase);
                                        }
                                    }

                                }


                            }
                        }
                        foreach ($purchases_design as $purchase) {
                            foreach ($products as $product) {
                                foreach ($designs as $design) {
                                    if ($design->id == $product->productable_id) {
                                        if ($product->productable_type == 'App\Models\Design') {
                                            if ($row->product_id == $product->id) {
                                                return $design->name;

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

                        $design_id = [];
                        foreach ($products as $product) {

                            if ($product->productable_type == 'App\Models\Design') {
                                array_push($design_id, $product->productable_id);
                            }
                        }
                        $designs = Design::whereIn('id', $design_id)->get();
                        $purchases_design = [];
                        foreach ($purchases as $purchase) {
                            foreach ($products as $product) {
                                if ($product->productable_type == 'App\Models\Design') {
                                    if ($product->id == $purchase->product_id) {
                                        if ($product->vendor_id == $vendor->id) {
                                            array_push($purchases_design, $purchase);
                                        }
                                    }

                                }


                            }
                        }
                        foreach ($purchases_design as $purchase) {
                            foreach ($products as $product) {
                                foreach ($designs as $design) {
                                    if ($design->id == $product->productable_id) {
                                        if ($product->productable_type == 'App\Models\Design') {
                                            if ($row->product_id == $product->id) {
                                                return $design->product->category->name;

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

                        $design_id = [];
                        foreach ($products as $product) {

                            if ($product->productable_type == 'App\Models\Design') {
                                array_push($design_id, $product->productable_id);
                            }
                        }
                        $designs = Design::whereIn('id', $design_id)->get();
                        $purchases_design = [];
                        foreach ($purchases as $purchase) {
                            foreach ($products as $product) {
                                if ($product->productable_type == 'App\Models\Design') {
                                    if ($product->id == $purchase->product_id) {
                                        if ($product->vendor_id == $vendor->id) {
                                            array_push($purchases_design, $purchase);
                                        }
                                    }

                                }


                            }
                        }
                        foreach ($purchases_design as $purchase) {
                            foreach ($products as $product) {
                                foreach ($designs as $design) {
                                    if ($design->id == $product->productable_id) {
                                        if ($product->productable_type == 'App\Models\Design') {
                                            if ($row->product_id == $product->id) {
                                                if ($design->product->offer != '') {
                                                    return $design->product->price - (($design->product->price / 100) * $design->product->offer);
                                                } else {
                                                    return $design->product->price;
                                                }
                                            }
                                        }
                                    }
                                }
                            }

                        }
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

                        $design_id = [];
                        foreach ($products as $product) {

                            if ($product->productable_type == 'App\Models\Design') {
                                array_push($design_id, $product->productable_id);
                            }
                        }
                        $designs = Design::whereIn('id', $design_id)->get();
                        $purchases_design = [];
                        foreach ($purchases as $purchase) {
                            foreach ($products as $product) {
                                if ($product->productable_type == 'App\Models\Design') {
                                    if ($product->id == $purchase->product_id) {
                                        if ($product->vendor_id == $vendor->id) {
                                            array_push($purchases_design, $purchase);
                                        }
                                    }

                                }


                            }
                        }
                        foreach ($purchases_design as $purchase) {
                            foreach ($products as $product) {
                                foreach ($designs as $design) {
                                    if ($design->id == $product->productable_id) {
                                        if ($product->productable_type == 'App\Models\Design') {
                                            if ($row->product_id == $product->id) {
                                                if ($design->product->offer != '') {
                                                    return ($design->product->price - (($design->product->price / 100) * $design->product->offer)) * $row->quantity;
                                                } else {
                                                    return $design->product->price * $row->quantity;
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

            return view('site.vendor.design.purse', compact('vendor', 'social_media_link', 'logo'));

        } elseif ($vendor->type_activity == 'الاثنين معا') {
            $data = [];
            $data['vendors'] = Vendor::select('id', 'name')->get();
            $data['categories'] = Category::active()->select('id', 'name')->where('parent_id', 1)->get();


            $purchases = Purchase::get();

            $product_id = [];

            foreach ($purchases as $purchase) {
                array_push($product_id, $purchase->product_id);
            }

            $products = Product::whereIn('id', $product_id)->get();

            $design_id = [];
            foreach ($products as $product) {

                if ($product->productable_type == 'App\Models\Design') {
                    array_push($design_id, $product->productable_id);
                }
            }

            $designs = Design::whereIn('id', $design_id)->get();

            $purchases_design = [];
            foreach ($purchases as $purchase) {
                foreach ($products as $product) {
                    if ($product->productable_type == 'App\Models\Design') {
                        if ($product->id == $purchase->product_id) {
                            if ($product->vendor_id == $vendor->id) {
                                array_push($purchases_design, $purchase);
                            }
                        }

                    }
                }
            }

            $total_price = 0;

            foreach ($purchases_design as $purchase) {
                foreach ($products as $product) {
                    foreach ($designs as $design) {
                        if ($design->id == $product->productable_id) {
                            if ($product->productable_type == 'App\Models\Design') {
                                if ($purchase->product_id == $product->id) {
                                    $total_price += $design->product->price * $purchase->quantity;

                                }
                            }
                        }
                    }
                }

            }


            if ($request->ajax()) {

                return DataTables::of($purchases_design)
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

                        $design_id = [];
                        foreach ($products as $product) {

                            if ($product->productable_type == 'App\Models\Design') {
                                array_push($design_id, $product->productable_id);
                            }
                        }
                        $designs = Design::whereIn('id', $design_id)->get();
                        $purchases_design = [];
                        foreach ($purchases as $purchase) {
                            foreach ($products as $product) {
                                if ($product->productable_type == 'App\Models\Design') {
                                    if ($product->id == $purchase->product_id) {
                                        if ($product->vendor_id == $vendor->id) {
                                            array_push($purchases_design, $purchase);
                                        }
                                    }

                                }


                            }
                        }
                        foreach ($purchases_design as $purchase) {
                            foreach ($products as $product) {
                                foreach ($designs as $design) {
                                    foreach ($orders as $order) {
                                        if ($design->id == $product->productable_id) {
                                            if ($product->productable_type == 'App\Models\Design') {
                                                if ($row->product_id == $product->id) {
                                                    if ($order->id == $row->order_id) {
                                                        return $row->order_id;
                                                    }
                                                }
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

                        $design_id = [];
                        foreach ($products as $product) {

                            if ($product->productable_type == 'App\Models\Design') {
                                array_push($design_id, $product->productable_id);
                            }
                        }
                        $designs = Design::whereIn('id', $design_id)->get();
                        $purchases_design = [];
                        foreach ($purchases as $purchase) {
                            foreach ($products as $product) {
                                if ($product->productable_type == 'App\Models\Design') {
                                    if ($product->id == $purchase->product_id) {
                                        if ($product->vendor_id == $vendor->id) {
                                            array_push($purchases_design, $purchase);
                                        }
                                    }

                                }


                            }
                        }
                        foreach ($purchases_design as $purchase) {
                            foreach ($products as $product) {
                                foreach ($designs as $design) {
                                    if ($design->id == $product->productable_id) {
                                        if ($product->productable_type == 'App\Models\Design') {
                                            if ($row->product_id == $product->id) {
                                                return $design->name;

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

                        $design_id = [];
                        foreach ($products as $product) {

                            if ($product->productable_type == 'App\Models\Design') {
                                array_push($design_id, $product->productable_id);
                            }
                        }
                        $designs = Design::whereIn('id', $design_id)->get();
                        $purchases_design = [];
                        foreach ($purchases as $purchase) {
                            foreach ($products as $product) {
                                if ($product->productable_type == 'App\Models\Design') {
                                    if ($product->id == $purchase->product_id) {
                                        if ($product->vendor_id == $vendor->id) {
                                            array_push($purchases_design, $purchase);
                                        }
                                    }

                                }


                            }
                        }
                        foreach ($purchases_design as $purchase) {
                            foreach ($products as $product) {
                                foreach ($designs as $design) {
                                    if ($design->id == $product->productable_id) {
                                        if ($product->productable_type == 'App\Models\Design') {
                                            if ($row->product_id == $product->id) {
                                                return $design->product->category->name;

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

                        $design_id = [];
                        foreach ($products as $product) {

                            if ($product->productable_type == 'App\Models\Design') {
                                array_push($design_id, $product->productable_id);
                            }
                        }
                        $designs = Design::whereIn('id', $design_id)->get();
                        $purchases_design = [];
                        foreach ($purchases as $purchase) {
                            foreach ($products as $product) {
                                if ($product->productable_type == 'App\Models\Design') {
                                    if ($product->id == $purchase->product_id) {
                                        if ($product->vendor_id == $vendor->id) {
                                            array_push($purchases_design, $purchase);
                                        }
                                    }

                                }


                            }
                        }
                        foreach ($purchases_design as $purchase) {
                            foreach ($products as $product) {
                                foreach ($designs as $design) {
                                    if ($design->id == $product->productable_id) {
                                        if ($product->productable_type == 'App\Models\Design') {
                                            if ($row->product_id == $product->id) {
                                                if ($design->product->offer != '') {
                                                    return $design->product->price - (($design->product->price / 100) * $design->product->offer);
                                                } else {
                                                    return $design->product->price;
                                                }


                                            }
                                        }
                                    }
                                }
                            }

                        }
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

                        $design_id = [];
                        foreach ($products as $product) {

                            if ($product->productable_type == 'App\Models\Design') {
                                array_push($design_id, $product->productable_id);
                            }
                        }
                        $designs = Design::whereIn('id', $design_id)->get();
                        $purchases_design = [];
                        foreach ($purchases as $purchase) {
                            foreach ($products as $product) {
                                if ($product->productable_type == 'App\Models\Design') {
                                    if ($product->id == $purchase->product_id) {
                                        if ($product->vendor_id == $vendor->id) {
                                            array_push($purchases_design, $purchase);
                                        }
                                    }

                                }


                            }
                        }
                        foreach ($purchases_design as $purchase) {
                            foreach ($products as $product) {
                                foreach ($designs as $design) {
                                    if ($design->id == $product->productable_id) {
                                        if ($product->productable_type == 'App\Models\Design') {
                                            if ($row->product_id == $product->id) {
                                                if ($design->product->offer != '') {
                                                    return ($design->product->price - (($design->product->price / 100) * $design->product->offer)) * $row->quantity;
                                                } else {
                                                    return $design->product->price * $row->quantity;
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

            return view('site.vendor.both.purseDesign', compact('vendor', 'social_media_link', 'logo'));

        } else {
            $notification = array(
                'message' => 'انت غير مصرح للك بالدخول لهذه الصفحة',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

}
