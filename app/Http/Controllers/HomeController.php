<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function stripe()
    {
        return view('site.customer.paymentTest');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function stripePost(Request $request)
    {
        //return $request;
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
            "amount" => $request->amount,
            "currency" => $request->currency,
            "source" => $request->source,
            "description" => $request->description,
        ]);


        return response()->json([
            'status' => true,
            'msg' => 'تم شراء المنتج'
        ]);


        //Session::flash('success', 'Payment successful!');

        //return back();
    }
}
