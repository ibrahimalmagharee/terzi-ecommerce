<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\BasketProduct;
use App\Models\Coupon;
use App\Models\Design;
use App\Models\Fabric;
use App\Models\Logo;
use App\Models\Order;
use App\Models\Product;
use App\Models\SocialMediaLink;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stripe;
use DB;

class CartController extends Controller
{
    public function getCartPage ()
    {
        if (!auth('customer')->user()) {
            $notification = array(
                'message' => 'انت غير مسجل دخول في النظام',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $logo = Logo::first();
        $social_media_link = SocialMediaLink::get();

        $basket_products = auth('customer')->user()
            ->basketProduct()->where('status', 1)->where('size_id', '!=' , null)
            ->get();
        $product_id = [];

        foreach ($basket_products as $basket_product) {
            array_push($product_id, $basket_product->product_id);
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
                                    $total_price += (($fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)) * $basket_product->quantity) + ($fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)) * $basket_product->number_of_meters;

                                } else {
                                    $total_price += ($fabric->product->price * $basket_product->quantity) + ($fabric->product->price * $basket_product->number_of_meters);
                                }
                            }
                        }

                    }
                }
            }
        }
        return view('site.customer.cart', compact('basket_products', 'products', 'designs', 'fabrics', 'total_price', 'social_media_link','logo'));
    }

    public function getTestPayment ()
    {
        return view('site.customer.TestPayment');
    }

    public function shipping(Request $request)
    {
        $email = 'tarzyclub@gmail.com';
        $password = 'bd230ac5';

        $token = "eyJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoxLCJleHAiOjQ3NTc0ODQ5ODd9.ftia2RD_CCyPOXY9mk_RpXkxWm9zIfcz9dLmu-xadpw";



        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://staging.barqfleet.com/api/v1/merchants/distance?lat1=24.428124&lng1=46.531092&lat2=24.821738&lng2=46.420330',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $distance = curl_exec($curl);

        curl_close($curl);

//        $curl = curl_init();
//
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => 'https://staging.barqfleet.com‏/api/v1/merchants/cities/active_cities',
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => '',
//            CURLOPT_MAXREDIRS => 10,
//            CURLOPT_TIMEOUT => 0,
//            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST => 'GET',
//            CURLOPT_HTTPHEADER => array(
//                'Authorization:'.$token
//            ),
//        ));
//
//        $response_cities = curl_exec($curl);
//           $cities = json_decode((string)$response_cities, true);
//
//        $city_id =[];
//        foreach ($cities as  $city){
//            array_push($city_id,  $city['id']);
//        }
//
//        curl_close($curl);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://9363-2400-adc5-172-9b00-7518-cbfa-fde0-e61a.ngrok.io/api/v1/merchants/hubs/update_hub',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS =>'{
                  "code": "MerchantHub_UID",
                  "city_id": 1,
                  "manager": "Sathish Kumar",
                  "mobile": "966544299942",
                  "phone": "020000001",
                  "latitude": 26.39222,
                  "longitude": 49.97778,
                  "is_active": true,
                  "opening_time": "10:00:00",
                  "closing_time": "23:59:00",
                  "start_day": 0,
                  "end_day": 4
                }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: '.$token
            ),
        ));

       echo $response = curl_exec($curl);

        curl_close($curl);
      //  return $response;

//        $curl = curl_init();
//
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => 'https://live.barqfleet.com/api/v1/merchants/orders',
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => '',
//            CURLOPT_MAXREDIRS => 10,
//            CURLOPT_TIMEOUT => 0,
//            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST => 'POST',
//            CURLOPT_POSTFIELDS =>'{
//                "payment_type" : 0,
//                "shipment_type" : 0,
//                "hub_id": 1,
//                "hub_code": "MerchantUID",
//                "merchant_order_id" : "202007010415",
//                "invoice_total": "899",
//                "customer_details" : {
//                    "first_name" : "Mohamad",
//                    "last_name" : "Kaakati",
//                    "country" : "Saudi Arabia",
//                    "city" : "Riyadh",
//                    "mobile" : "966544299942",
//                    "address": "Al Olaya St, Next to Faisaliah Tower"
//                },
//                "products" : [{
//                    "sku" : "GD2180",
//                    "serial_no" : "APL16252417283-TR",
//                    "name" : "iPhone XS - 128gb Space Gray",
//                    "color" : "",
//                    "brand" : "",
//                    "price" : 548.95,
//                    "weight_kg" : 1.73,
//                    "qty" : 2
//                },{
//                    "sku" : "AP881",
//                    "serial_no" : "APL9864192366373",
//                    "name" : "Apple AirPods",
//                    "color" : "",
//                    "brand" : "",
//                    "price" : 199.95,
//                    "weight_kg" : 0.25,
//                    "qty" : 1
//                }],
//                "destination": {
//                    "latitude": 24.71,
//                    "longitude": 46.70
//                }
//            }',
//            CURLOPT_HTTPHEADER => array(
//                'Content-Type: application/json',
//                'Authorization: '.$token
//            ),
//        ));
//
//        $response1 = curl_exec($curl);
//
//        return $response1;
//
//        curl_close($curl);



    }

    public function payment(Request $request)
    {
        $customer = auth('customer')->user();

        $tax = 0.15 * $request->amount;

        $amount = $tax + $request->amount;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.tap.company/v2/authorize",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"amount\":$amount,\"currency\":\"KWD\",\"threeDSecure\":true,\"save_card\":false,\"description\":\"authorize description\",
            \"statement_descriptor\":\"sample\",\"metadata\":{\"udf1\":\"test\"},\"reference\":{\"transaction\":\"txn_0001\",\"order\":\"ord_0001\"},
            \"receipt\":{\"email\":false,\"sms\":true},\"customer\":{\"first_name\":\"$customer->name\",\"middle_name\":\"$customer->name\",\"last_name\":\"$customer->name\",
            \"email\":\"$customer->email\",\"phone\":{\"country_code\":\"965\",\"number\":\"50000000\"}},\"source\":{\"id\":\"$request->token\"},
            \"auto\":{\"type\":\"VOID\",\"time\":100},\"post\":{\"url\":\"http://your_website.com/posturl\"},\"redirect\":{\"url\":\"http://your_website.com/returnurl\"}}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer ".env('TAP_SK'),
                "content-type: application/json"
            ),
        ));

        $response_authorize = curl_exec($curl);
        $err = curl_error($curl);

        $authorize = json_decode((string)$response_authorize, true);
        $authorize_id = $authorize['id'];

        curl_close($curl);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.tap.company/v2/charges",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"amount\":$amount,\"currency\":\"KWD\",\"threeDSecure\":true,\"save_card\":false,\"description\":\"charge Description\",
            \"statement_descriptor\":\"Sample\",\"metadata\":{\"udf1\":\"test 1\",\"udf2\":\"test 2\"},\"reference\":{\"transaction\":\"txn_0001\",\"order\":\"ord_0001\"},
            \"receipt\":{\"email\":false,\"sms\":true},\"customer\":{\"first_name\":\"$customer->name\",\"middle_name\":\"$customer->name\",\"last_name\":\"$customer->name\",\"email\":\"$customer->email\",
            \"phone\":{\"country_code\":\"965\",\"number\":\"50000000\"}},\"merchant\":{\"id\":\"9714011\",\"username\":\"ad1a3e@tap\",\"password\":\"ad1a3e@q8\",\"api_key\":\"93tap97\"},\"source\":{\"id\":\"src_kw.knet\"},\"post\":{\"url\":\"http://your_website.com/post_url\"},\"redirect\":{\"url\":\"http://localhost/terzi-ecommerce/redirect_url?tap_id=$authorize_id\"}}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer ".env('TAP_SK'),
                "content-type: application/json"
            ),
        ));

        $response_charge = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);


          $json = json_decode((string)$response_charge, true);
          $transaction = $json['transaction'];
          $url =  $transaction['url'];
          $charge_id = $json['id'];




        if (!$charge_id) {
            return response()->json([
                'status' => false,
                'msg' => 'فشلت عملية الدفع يرجى التحقق من البطاقة'
            ]);
        } else {
            DB::beginTransaction();

            $order = auth('customer')->user()->orders()->create([
                'total_price' => $amount,
                //'customer_id' => auth('customer')->user()->id,
                'status' => 0,
            ]);

            $basket_products = auth('customer')->user()
                ->basketProduct()->where('status', 1)->where('size_id', '!=' , null)
                ->get();
            $product_id = [];

            foreach ($basket_products as $basket_product) {
                array_push($product_id, $basket_product->product_id);
            }

            $products = Product::whereIn('id', $product_id)->get();

             $order_id = $order['id'];

            foreach ($products as $product) {
                foreach ($basket_products as $basket_product) {
                    if ($product->id == $basket_product->product_id) {
                        auth('customer')->user()->purchases()->create([
                            'order_id' => $order_id,
                            'product_id' => $basket_product->product_id,
                            'quantity' => $basket_product->quantity,
                            'number_of_meters' => $basket_product->number_of_meters,
                        ]);
                        $product_sales = Product::where('id', $basket_product->product_id)->first();
                        $count_sales = $product_sales->sales + 1;
                        $product_sales->where('id', $basket_product->product_id)->update([
                            'sales' => $count_sales
                        ]);

                    }
                }
            }


            $customer_id = auth('customer')->user()->id;
            $basket_product = BasketProduct::where('customer_id', $customer_id)->where('status', 1)->delete();

            DB::commit();
            return response()->json([
                'status' => true,
                'msg' => 'تم شراء المنتج'
            ]);


        }

    }

    public function updateNumberOfMeters(Request $request)
    {
        $customer_id = auth('customer')->user()->id;
        $basket_product = BasketProduct::where('customer_id', $customer_id)
            ->where('product_id', request('product_id'))
            ->update([
               'number_of_meters' => $request->number_of_meters
            ]);

        $basket_products = auth('customer')->user()
            ->basketProduct()->where('status', 1)->where('size_id', '!=' , null)
            ->get();
        $product_id = [];

        foreach ($basket_products as $basket_product) {
            array_push($product_id, $basket_product->product_id);
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
                                    $total_price += (($fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)) * $basket_product->quantity) + ($fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)) * $basket_product->number_of_meters;

                                } else {
                                    $total_price += ($fabric->product->price * $basket_product->quantity) + ($fabric->product->price * $basket_product->number_of_meters);
                                }
                            }
                        }

                    }
                }
            }
        }

        return response()->json([
            'status' => true,
            'total_price' => $total_price,
            'msg' => 'تم تحديث عدد أمتار هذا المنتج'
        ]);
    }

    public function updateQuantity(Request $request)
    {
        $customer_id = auth('customer')->user()->id;
        $basket_product = BasketProduct::where('customer_id', $customer_id)
            ->where('product_id', request('product_id'))
            ->update([
                'quantity' => $request->quantity
            ]);

        $basket_products = auth('customer')->user()
            ->basketProduct()->where('status', 1)->where('size_id', '!=' , null)
            ->get();
        $product_id = [];

        foreach ($basket_products as $basket_product) {
            array_push($product_id, $basket_product->product_id);
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
                                    $total_price += (($fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)) * $basket_product->quantity) + ($fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)) * $basket_product->number_of_meters;

                                } else {
                                    $total_price += ($fabric->product->price * $basket_product->quantity) + ($fabric->product->price * $basket_product->number_of_meters);
                                }
                            }
                        }

                    }
                }
            }
        }

        return response()->json([
            'status' => true,
            'total_price' => $total_price,
            'msg' => 'تم تحديث كمية هذا المنتج'
        ]);
    }

    public function checkCoupon(Request $request)
    {
        $basket_products = auth('customer')->user()
            ->basketProduct()->where('status', 1)->where('size_id', '!=' , null)
            ->get();
        $product_id = [];

        foreach ($basket_products as $basket_product) {
            array_push($product_id, $basket_product->product_id);
        }

        $products = Product::whereIn('id', $product_id)->get();

        $vendor_id = [];
        foreach ($products as $product) {
            array_push($vendor_id, $product->vendor_id);
        }

        $code = $request->coupon_code;
        $total_price = $request->total_price;

        $coupon = Coupon::where('code', $code)->where('vendor_id', $vendor_id)->first();

        if ($coupon){
            if ($coupon->start_datetime <= Carbon::today()->format('Y-m-d') && Carbon::today()->format('Y-m-d') <= $coupon->end_datetime){
                if ($coupon->type == 1){ // percent

                    $discount = ($total_price / 100) * $coupon->percent_discount;
                } elseif ($coupon->type == 2){  // fixed amount

                    $discount = $coupon->percent_discount;
                }


                $final_total_price = $total_price - $discount;

                return response()->json([
                    'status' => true,
                    'total_price' => $final_total_price,
                    'msg' => 'تم الخصم بنجاح'
                ]);


            } else {
                return response()->json([
                    'status' => 'expired',
                    'msg' => 'هذا الكود غير صالح'
                ]);
            }

        } else {
            return response()->json([
                'status' => false,
                'msg' => 'هذا الكود غير موجود'
            ]);
        }
    }

    public function destroy()
    {
        $customer_id = auth('customer')->user()->id;
        $basket_product = BasketProduct::where('customer_id', $customer_id)->where('product_id', request('product_id'))->delete();

        $basket_products = auth('customer')->user()
            ->basketProduct()->where('status', 1)->where('size_id', '!=' , null)
            ->get();
        $product_id = [];

        foreach ($basket_products as $basket_product) {
            array_push($product_id, $basket_product->product_id);
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
                                    $total_price += (($fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)) * $basket_product->quantity) + ($fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)) * $basket_product->number_of_meters;

                                } else {
                                    $total_price += ($fabric->product->price * $basket_product->quantity) + ($fabric->product->price * $basket_product->number_of_meters);
                                }
                            }
                        }

                    }
                }
            }
        }

        return response()->json([
            'status' => true,
            'total_price' => $total_price,
            'msg' => 'تم حذف المنتج من السلة'
        ]);
    }

}
