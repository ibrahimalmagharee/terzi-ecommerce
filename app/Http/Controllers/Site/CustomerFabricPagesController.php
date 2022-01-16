<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\FabricResource;
use App\Models\Category;
use App\Models\Color;
use App\Models\Fabric;
use App\Models\Logo;
use App\Models\Offer;
use App\Models\Proceed;
use App\Models\Product;
use App\Models\SocialMediaLink;
use Illuminate\Http\Request;

class CustomerFabricPagesController extends Controller
{
    public function viewFabricProduct()
    {
        $logo = Logo::first();
        $social_media_link = SocialMediaLink::get();
        $product_max_price = Product::max('price');
        $colors = Color::get();
        $categories = Category::where('parent_id', 2)->get();
        $status = 1;
        $fabrics = Fabric::with('product','colors')->when($status, function ($query) use ($status){
            return $query->whereHas('product', function ($query) use ($status){
                $query->where('status', $status);
            });
        })->get();
        FabricResource::collection($fabrics);

        $latest_fabrics = Fabric::with('product','images')->when($status, function ($query) use ($status){
            return $query->whereHas('product', function ($query) use ($status){
                $query->where('status', $status);
            });
        })->get()->sortByDesc('created_at')->take(2);
        FabricResource::collection($latest_fabrics);

        if (auth('customer')->user()) {
            $basket_products = auth('customer')->user()
                ->basketProduct()
                ->get();

            return view('site.customer.fabricsProduct', compact('fabrics','colors','categories','latest_fabrics', 'product_max_price', 'basket_products', 'social_media_link', 'logo'));

        } else{
            return view('site.customer.fabricsProduct', compact('fabrics','colors','categories','latest_fabrics', 'product_max_price', 'social_media_link', 'logo'));

        }

    }


    public function viewFabricProductFilter(Request $request)
    {

        $input_color_id = $request->input('colors');
        if ($request->input('colors'))
            $input_color_id = array_map('intval',$input_color_id);
        else $input_color_id = [];

        $input_category_id = $request->input('categories');
        if ($request->input('categories'))
            $input_category_id = array_map('intval',$input_category_id);
        else $input_category_id = [];

        $input_offers = $request->input('offers');
        if ($request->input('offers'))
            $input_offers = array_map('intval', $input_offers);
        else $input_offers = [];

        $min_price =intval($request->min_val);
        $max_price = intval($request->max_val);
        $product_max_price = Product::max('price');

        if ($request->min_val >= 0 && $request->max_val <= $product_max_price){
            $min_price = intval($request->min_val);
            $max_price =  intval($request->max_val);
        }else{
            $min_price = 0;
            $max_price = $product_max_price;
        }

        $status = 1;
        $fabrics = Fabric::with('product','colors')->when($status, function ($query) use ($status){
            return $query->whereHas('product', function ($query) use ($status){
                $query->where('status', $status);
            });
        })->when(count($input_color_id)>0, function ($query) use ($input_color_id){
            return $query->whereHas('colors', function ($query) use ($input_color_id){
                $query->whereIn('color_id', $input_color_id);
            });

        })->when(count($input_category_id)>0, function ($query) use ($input_category_id){
            return $query->whereHas('product', function ($query) use ($input_category_id){
                $query->whereIn('category_id', $input_category_id);
            });
        })->when(count($input_offers)>0 , function ($query) use ($input_offers){
            return $query->whereHas('product', function ($query) use ($input_offers){
                $query->where('offer', '!=', '');
            });
        })->when($min_price >= 0 && $max_price <= $product_max_price , function ($query) use ($request){
            return $query->whereHas('product', function ($query) use ($request){
                $query->where('price', '>', $request->min_val)->where('price', '<=', $request->max_val);
            });
        })->get();


        FabricResource::collection($fabrics);

        return view('site.customer._fabricsProductFillter', compact('fabrics'));

    }

    public function viewFabricProductDetails($fabric_id)
    {
        $fabric = Fabric::find($fabric_id);
        $social_media_link = SocialMediaLink::get();
        $logo = Logo::first();

        if (!$fabric){
            $notification = array(
                'message' => 'هذا المنتج غير موجود',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        $status = 1;
         $fabric_categories_ids =  $fabric -> product->category_id;
         $fabrics_related = Fabric::with('product')->when($status, function ($query) use ($status){
             return $query->whereHas('product', function ($query) use ($status){
                 $query->where('status', $status);
             });
         })->when($fabric_categories_ids, function ($query) use ($fabric_categories_ids){
             $query->whereHas('product', function ($query) use ($fabric_categories_ids){
                $query->where('category_id', $fabric_categories_ids);
            });
        })-> limit(6) -> latest() ->get();

        FabricResource::collection($fabrics_related);

        if (auth('customer')->user()) {
            $basket_products = auth('customer')->user()
                ->basketProduct()
                ->get();

            return view('site.customer.fabricsProductDetails', compact('fabric','fabrics_related', 'basket_products', 'social_media_link', 'logo'));
        } else{
            return view('site.customer.fabricsProductDetails', compact('fabric','fabrics_related', 'social_media_link', 'logo'));
        }



    }
}
