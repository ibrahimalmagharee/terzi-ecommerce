<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Design;
use App\Models\Fabric;
use App\Models\Logo;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\SocialMediaLink;
use Illuminate\Http\Request;

class MyPurchasesController extends Controller
{
    public function getMyPurchases()
    {
        if ( !auth('customer')->user()) {
            $notification = array(
                'message' => 'انت غير مسجل دخول في النظام',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $logo = Logo::first();
        $social_media_link = SocialMediaLink::get();

        $customer_id = auth('customer')->user()->id;
        $proceeds = Purchase::where('customer_id', $customer_id)->get();

        $product_id = [];

        foreach ($proceeds as $proceed) {
            array_push($product_id, $proceed->product_id);
        }

        $products = Product::whereIn('id', $product_id)->get();

        $design_id = [];
        $fabric_id = [];
        foreach ($products as $product) {

            if ($product->productable_type == 'App\Models\Design') {
                array_push($design_id, $product->productable_id);
            } else {
                array_push($fabric_id, $product->productable_id);
            }
        }

        $designs = Design::whereIn('id', $design_id)->get();
        $fabrics = Fabric::whereIn('id', $fabric_id)->get();


        if (auth('customer')->user()) {
            $basket_products = auth('customer')->user()
                ->basketProduct()
                ->get();

            return view('site.customer.myPurchases', compact('proceeds', 'products', 'designs', 'fabrics', 'basket_products', 'social_media_link', 'logo'));
        } else{
            return view('site.customer.myPurchases', compact('proceeds', 'products', 'designs', 'fabrics', 'social_media_link', 'logo'));
        }


    }
}
