<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\DesignResource;
use App\Models\Category;
use App\Models\Design;
use App\Models\Logo;
use App\Models\Offer;
use App\Models\Product;
use App\Models\SocialMediaLink;
use App\Models\Type;
use Illuminate\Http\Request;

class CustomerDesignPagesController extends Controller
{
    public function viewDesignProduct()
    {
        $types = Type::get();
        $categories = Category::where('parent_id', 1)->get();
        $social_media_link = SocialMediaLink::get();

        $logo = Logo::first();
        $status = 1;
        $product_max_price = Product::max('price');
         $designs = Design::when($status, function ($query) use ($status){
            return $query->whereHas('product', function ($query) use ($status){
                $query->where('status', $status);
            });
        })->get();
         DesignResource::collection($designs);

         $latest_designs = Design::when($status, function ($query) use ($status){
             return $query->whereHas('product', function ($query) use ($status){
                 $query->where('status', $status);
             });
         })->get()->sortByDesc('created_at')->take(2);
        DesignResource::collection($latest_designs);

        if (auth('customer')->user()) {
            $basket_products = auth('customer')->user()
                ->basketProduct()
                ->get();

            return view('site.customer.designsProduct', compact('designs','types','categories','latest_designs', 'product_max_price', 'basket_products', 'social_media_link','logo'));

        } else{
            return view('site.customer.designsProduct', compact('designs','types','categories','latest_designs', 'product_max_price', 'social_media_link', 'logo'));

        }
    }


    public function viewDesignProductFilter(Request $request)
    {
        $input_type_id = $request->input('types');
        if($request->input('types'))
            $input_type_id =array_map('intval',$input_type_id);
        else $input_type_id=[];

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
        $designs = Design::with('product')->when($status, function ($query) use ($status){
            return $query->whereHas('product', function ($query) use ($status){
                $query->where('status', $status);
            });
        })->when(count($input_type_id)>0 , function ($query) use ($input_type_id){
            return $query->whereIn('type_id',$input_type_id);

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

        DesignResource::collection($designs);

        return view('site.customer._designsProductFillter', compact('designs'));

    }

    public function viewDesignProductDetails($design_id)
    {
        $design = Design::with('product')->find($design_id);

        $logo = Logo::first();
        $social_media_link = SocialMediaLink::get();
       // dd($design->images);
        if (!$design){
            $notification = array(
                'message' => 'هذا المنتج غير موجود',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        $design_categories_id =  $design -> product->category_id;
        $status = 1;
        $designs_related = Design::with('product')->when($status, function ($query) use ($status){
            return $query->whereHas('product', function ($query) use ($status){
                $query->where('status', $status);
            });
        })->when($design_categories_id, function ($query) use ($design_categories_id){
            $query->whereHas('product', function ($query) use ($design_categories_id){
                $query->where('category_id', $design_categories_id);
            });
        })-> limit(6) -> latest() ->get();

        DesignResource::collection($designs_related);

        if (auth('customer')->user()) {
            $basket_products = auth('customer')->user()
                ->basketProduct()
                ->get();

            return view('site.customer.designsProductDetails', compact('design','designs_related', 'basket_products', 'social_media_link', 'logo'));

        } else{
            return view('site.customer.designsProductDetails', compact('design','designs_related', 'social_media_link', 'logo'));

        }

    }
}
