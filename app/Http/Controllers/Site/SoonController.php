<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\DesignResource;
use App\Models\Category;
use App\Models\Design;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Type;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoonController extends Controller
{
    public function soon()
{
    return view('site.landingPage.soon');
}

public function viewProduct()
{
    $types = Type::get();
     $categories = Category::where('parent_id', 1)->get();
     $offers = Offer::where('id', 1)->get();

      $designs = Design::with('product')->get();
      DesignResource::collection($designs);



    return view('site.customer.viewProduct', compact('designs','types','categories','offers'));
}
    public static function search($request,$children=null)
    {
        return Product::when($request->search, function ($query) use ($request,$children) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        })->when($request->brand , function ($query) use ($request,$children){
            return $query->where('brand_id',$request->brand);
        })->when($request->category , function ($query) use ($request,$children){
            if($children == null)
                return $query->where('category_id',$request->category);
            else{
                return $query->whereIn('category_id',$children);
            }
        })->orderBy('id','desc')->paginate($request->paginate);
    }
public function viewProductFilter (Request $request)
{


    $input_type_id = $request->input('types');
    if($request->input('types'))
     $input_type_id =array_map('intval',$input_type_id);
    else $input_type_id=[];

    $category_id = $request->input('categories');
    if ($request->input('categories'))
        $category_id = array_map('intval',$category_id);
    else $category_id = [];

    $offers = $request->input('offers');
    if ($request->input('offers'))
        $offers = array_map('intval', $offers);
    else $offers = [];

    if ($request->ajax()){



        $designs = Design::with('product')->when(count($input_type_id)>0 , function ($query) use ($input_type_id){
                return $query->whereIn('type_id',$input_type_id);

            })->when(count($category_id)>0, function ($query) use ($category_id){
                return $query->whereHas('product', function ($query) use ($category_id){
                    $query->whereIn('category_id', $category_id);
                });
})->when(count($offers)>0 , function ($query) use ($offers){
            return $query->whereHas('product', function ($query) use ($offers){
                $query->where('offer_id', '!=', 1);
            });
        })->get();



            //})->
        DesignResource::collection($designs);

            $output = '';
                foreach ($designs as $design){
                    $output .= '

                            <div class="card mb-3 rounded-cust-prod shadow-cust width-cust" style="width: 100%">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img class="img-product rounded-cust-prod-right" style="width: 373px; height: 313px;"
                                             src="'.$design->getPhoto($design->image->photo).'" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body text-right p-5">
                                            <div class="row">
                                                <div class="col pr-4">
                                                    <h5 class="card-title">'.$design->name.'</h5>
                                                </div>
                                                <div class="col text-left">
                                                    <p class="MontserratArabicLightPure">4  اشتريا هذا المنتج</p>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-10 pl-5">
                                                    <p class="card-text">
                                                        '.$design->description.'
                                                    </p>
                                                    <br>
                                                    <small class="MontserratArabicLightPure">'.$design->product->offer->name.'</small>
                                                </div>
                                                <div class="col pt-5 pr-4">
                                                    <a class="MontserratArabicLightPure" href="">المزيد</a>
                                                </div>
                                            </div>
                                            <div class="row mt-5">
                                                <p class="card-text pr-3">'.$design->product->price. '  ر.س  </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        ';

                }

        }

    return Response($output);
}



}
