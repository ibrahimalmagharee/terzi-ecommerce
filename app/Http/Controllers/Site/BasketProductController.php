<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SizeRequest;
use App\Models\BasketProduct;
use App\Models\Category;
use App\Models\Design;
use App\Models\Fabric;
use App\Models\Logo;
use App\Models\Product;
use App\Models\Size;
use App\Models\SocialMediaLink;
use Illuminate\Http\Request;
use DB;

class BasketProductController extends Controller
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
        $sizes = Size::where('customer_id', auth('customer')->user()->id)->get();
        $categories = Category::active()->select('id','name')->where('parent_id', 2)->get();

          $basket_products = auth('customer')->user()
            ->basketProduct()
            ->get();
        $product_id = [];

        foreach ($basket_products as $basket_product){
            array_push($product_id, $basket_product->product_id);
        }

        $products= Product::whereIn('id',$product_id)->get();
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

         $total_price = 0;
         $total_price_fabric = null;
         foreach ($designs as $design){
             foreach ($products as $product){
                 foreach ($basket_products as $basket_product){
                     if ($product->id == $basket_product->product_id){
                         if ($product->productable_type == 'App\Models\Design'){
                             if ($design->id == $product->productable_id){
                                 if ($design->product->offer != ''){
                                     $total_price += ($design->product->price - (($design->product->price / 100) * $design->product->offer)) * $basket_product->quantity;

                                 } else {
                                     $total_price += $design->product->price * $basket_product->quantity;
                                 }
                             }
                         }

                     }
                 }
             }
         }

        foreach ($fabrics as $fabric){
            foreach ($products as $product){
                foreach ($basket_products as $basket_product){
                    if ($product->id == $basket_product->product_id){
                        if ($product->productable_type == 'App\Models\Fabric'){
                            if ($fabric->id == $product->productable_id){
                                if ($fabric->product->offer != ''){
                                    $total_price += ($fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)) * $basket_product->quantity;

                                } else {
                                    $total_price += $fabric->product->price * $basket_product->quantity;
                                }
                            }
                        }

                    }
                }
            }
        }


        return view('site.customer.basket1', compact('basket_products','products','designs','fabrics','total_price','sizes','categories', 'social_media_link', 'logo'));
    }

    public function saveProductBasket()
    {
        if (!request('quantity')){
            $quantity = 1;
        }else{
            $quantity = request('quantity');

        }

        if (! auth('customer')->user()->basketHasProduct(request('product_id'))) {
            BasketProduct::create([
               'product_id' => request('product_id'),
               'customer_id' => auth('customer')->user()->id,
                'quantity' => $quantity,
                'status' => 0,
            ]);

            $basket_products = auth('customer')->user()
                ->basketProduct()
                ->get();
            return response() -> json([
                'status' => true ,
                'cart_products_count' => count($basket_products),
                'msg' => 'تم اضافة المنتج الي السلة'
            ]);
        }
        return response() -> json([
            'status' => false ,
            'msg' => 'هذا المنتج تمت اضافته من قبل'
        ]);
    }

    public function updateStatus(Request $request)
    {
        $customer_id = auth('customer')->user()->id;

        $status = $request->status;
        if ($request->status == 0){
            $status = 1;
        }elseif ($request->status == 1) {
            $status = 0;
        }

         $basket_product = BasketProduct::where('customer_id',$customer_id)->where('product_id',request('product_id'))->first();
        $product = Product::where('id', request('product_id'))->first();
        $product_type = $product->productable_type;

        if ($basket_product->size_id == '') {
            return response() -> json([
                'status' => false ,
                'product_status' => $status ,
                'product_type' =>  $product_type,
                'msg' => 'يجب اختيار مقاس لهذا المنتج'
            ]);
        } else {
            $basket_product->update(['status' => $status]);
            return response() -> json([
                'status' => true ,
                'product_status' => $status ,
                'product_type' => $product_type ,
                'msg' => 'تم تحديث حالة المنتج'
            ]);
        }




    }

    public function updateSize (Request $request)
    {
        $customer_id = auth('customer')->user()->id;
        $size = Size::where('id', $request->size_id)->where('customer_id', $customer_id)->first();

        $size->products()->syncWithoutDetaching($request->product_id);

        $basket_product = BasketProduct::where('customer_id',$customer_id)->where('product_id', $request->product_id)
            ->update(['size_id' => $request->size_id]);

        return response() -> json([
            'status' => true ,
            'msg' => 'تم تحديد مقاس هذا المنتج'
        ]);
    }

    public function addSize(SizeRequest $request)
    {
        DB::beginTransaction();
        $size = Size::create([
            'customer_id' => $request->customer_id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'chest_circumference' => $request->chest_circumference,
            'waistline' => $request->waistline,
            'buttock_circumference' => $request->buttock_circumference,
            'length_by_chest' => $request->length_by_chest,
            'chest_length' => $request->chest_length,
            'shoulder_length' => $request->shoulder_length,
            'back_view' => $request->back_view,
            'neck_length' => $request->neck_length,
            'neck_width' => $request->neck_width,
            'neck_circumference' => $request->neck_circumference,
            'distance_between_breasts' => $request->distance_between_breasts,
            'arm_length' => $request->arm_length,
            'arm_circumference' => $request->arm_circumference,
            'armpit_length' => $request->armpit_length,
        ]);

        $size->save();
        if ($request->product_id){

            $size->products()->attach($request->product_id);

            $basket_product = BasketProduct::where('customer_id',$request->customer_id)->where('product_id', $request->product_id)
                ->update(['size_id' => $size->id]);
        }


        DB::commit();

        return response()->json([
            'status' => true,
            'size_id' => $size->id,
            'size_name' => $size->name,
            'msg' => 'تم اضافة المقاس بنجاح'
        ]);
    }

    public function destroy()
    {
         $customer_id = auth('customer')->user()->id;
         $basket_product = BasketProduct::where('customer_id',$customer_id)->where('product_id',request('product_id'))->delete();

        $basket_products = auth('customer')->user()
            ->basketProduct()
            ->get();
        $product_id = [];

        foreach ($basket_products as $basket_product){
            array_push($product_id, $basket_product->product_id);
        }

        $products= Product::whereIn('id',$product_id)->get();
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

        $total_price = 0;
        $total_price_fabric = null;
        foreach ($designs as $design){
            foreach ($products as $product){
                foreach ($basket_products as $basket_product){
                    if ($product->id == $basket_product->product_id){
                        if ($product->productable_type == 'App\Models\Design'){
                            if ($design->id == $product->productable_id){
                                if ($design->product->offer != ''){
                                    $total_price += ($design->product->price - (($design->product->price / 100) * $design->product->offer)) * $basket_product->quantity;

                                } else {
                                    $total_price += $design->product->price * $basket_product->quantity;
                                }
                            }
                        }

                    }
                }
            }
        }

        foreach ($fabrics as $fabric){
            foreach ($products as $product){
                foreach ($basket_products as $basket_product){
                    if ($product->id == $basket_product->product_id){
                        if ($product->productable_type == 'App\Models\Fabric'){
                            if ($fabric->id == $product->productable_id){
                                if ($fabric->product->offer != ''){
                                    $total_price += ($fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)) * $basket_product->quantity;

                                } else {
                                    $total_price += $fabric->product->price * $basket_product->quantity;
                                }
                            }
                        }

                    }
                }
            }
        }

        return response() -> json([
            'status' => true ,
            'total_price' => $total_price,
            'cart_products_count' => count($basket_products),
            'msg' => 'تم حذف المنتج من السلة'
        ]);
    }
}
