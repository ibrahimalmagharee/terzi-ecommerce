<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Design;
use App\Models\Fabric;
use App\Models\Logo;
use App\Models\Product;
use App\Models\SocialMediaLink;
use Illuminate\Http\Request;

class ProductWishlistController extends Controller
{
    public function index()
    {
        if (! auth('customer')->user()){
            $notification = array(
                'message' => 'انت غير مسجل دخول في النظام',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $logo = Logo::first();
        $social_media_link = SocialMediaLink::get();

        $products = auth('customer')->user()->wishlistProduct()->get();
        $design_id = [];
        $fabric_id = [];
        foreach ($products as $product){

            if ($product->productable_type == 'App\Models\Design'){
                array_push($design_id, $product->productable_id);
            }else{
                array_push($fabric_id, $product->productable_id);
            }
        }

          $designs = Design::whereIn('id',$design_id )->get();
          $fabrics = Fabric::whereIn('id',$fabric_id )->get();


        if (auth('customer')->user()) {
            $basket_products = auth('customer')->user()
                ->basketProduct()
                ->get();

            return view('site.customer.wishlist', compact('designs','fabrics', 'basket_products', 'social_media_link', 'logo'));
        } else{
            return view('site.customer.wishlist', compact('designs','fabrics', 'social_media_link', 'logo'));
        }

    }

    public function saveProductWishlist()
    {

        if (! auth('customer')->user()->wishlistHasProduct(request('product_id'))) {
            auth('customer')->user()->wishlistProduct()->attach(request('product_id'));
            return response() -> json([
                'status' => true ,
                'wished' => true,
                'msg' => 'تم اضافة المنتج الي مفضلتك'
            ]);
        }
        return response() -> json([
            'status' => false ,
            'wished' => false,
            'msg' => 'هذا المنتج تمت اضافته من قبل'
        ]);
    }

    public function destroy()
    {
        auth('customer')->user()->wishlistProduct()->detach(request('product_id'));
        return response() -> json([
            'status' => true ,
            'wished' => true,
            'msg' => 'تم حذف المنتج من مفضلتك'
        ]);
    }
}
