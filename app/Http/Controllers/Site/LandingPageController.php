<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ContactUSRequest;
use App\Models\AboutUs;
use App\Models\ContactCustomer;
use App\Models\HeaderBottomIndex;
use App\Models\Logo;
use App\Models\SocialMediaLink;
use App\Models\TermsAndConditions;
use App\Models\UsagePolicy;
use App\Models\Vendor;
use Illuminate\Http\Request;
use DB;

class LandingPageController extends Controller
{


    public function aboutLanding()
    {
        $logo = Logo::first();
        $social_media_link = SocialMediaLink::get();
        $about_us = AboutUs::first();
        if ($about_us){
            $url = $about_us->link;
            $link = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
                "//www.youtube.com/embed/$1",$url);

            $ext = '';
            if ($about_us->image != null){
                $ext =  pathinfo($about_us->image->photo, PATHINFO_EXTENSION);

            }

            if (auth('customer')->user()) {
                $basket_products = auth('customer')->user()
                    ->basketProduct()
                    ->get();

                return view('site.landingPage.aboutLanding', compact('about_us','ext', 'link', 'basket_products', 'social_media_link', 'logo'));
            } else{
                return view('site.landingPage.aboutLanding', compact('about_us','ext', 'link', 'social_media_link', 'logo'));
            }


        }else{
            if (auth('customer')->user()) {
                $basket_products = auth('customer')->user()
                    ->basketProduct()
                    ->get();

                return view('site.landingPage.aboutLanding', compact('about_us', 'basket_products', 'social_media_link'));
            } else{
                return view('site.landingPage.aboutLanding', compact('about_us', 'social_media_link'));
            }

        }


    }

    public function index()
    {
        $vendors = Vendor::with('product')->get();
        $social_media_link = SocialMediaLink::get();

        $logo = Logo::first();
        $headers_bottoms = HeaderBottomIndex::get();

        if (auth('customer')->user()) {
            $basket_products = auth('customer')->user()
                ->basketProduct()
                ->get();

            return view('site.landingPage.index', compact('vendors', 'headers_bottoms', 'basket_products', 'social_media_link', 'logo'));
        } else{
            return view('site.landingPage.index', compact('vendors', 'headers_bottoms', 'social_media_link', 'logo'));
        }



    }


    public function contactUs()
    {
        $social_media_link = SocialMediaLink::get();
        $logo = Logo::first();
        if (auth('customer')->user()) {
            $basket_products = auth('customer')->user()
                ->basketProduct()
                ->get();

            return view('site.landingPage.contactUs', compact('basket_products', 'social_media_link', 'logo'));
        } else{
            return view('site.landingPage.contactUs' , compact('social_media_link', 'logo'));
        }

    }

    public function saveContactUs(ContactUSRequest $request)
    {
        DB::beginTransaction();
        $contact = ContactCustomer::create([
            'customer_id' => $request->customer_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        $contact->save();

        DB::commit();

        $notification = array(
            'message' => 'تم ارسال الرسالة بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('contactUs')->with($notification);
    }

    public function usagePolicy()
    {
        $social_media_link = SocialMediaLink::get();
        $usage_policy = UsagePolicy::first();
        if (auth('customer')->user()) {
            $basket_products = auth('customer')->user()
                ->basketProduct()
                ->get();

            return view('site.customer.usagePolicy', compact('basket_products', 'usage_policy', 'social_media_link'));
        } else{
            return view('site.customer.usagePolicy', compact('usage_policy', 'social_media_link'));
        }

    }

    public function termCondition()
    {
        $social_media_link = SocialMediaLink::get();
        $term_condition = TermsAndConditions::first();
        if (auth('customer')->user()) {
            $basket_products = auth('customer')->user()
                ->basketProduct()
                ->get();

            return view('site.customer.termConditions', compact('basket_products', 'term_condition', 'social_media_link'));
        } else{
            return view('site.customer.termConditions', compact('term_condition', 'social_media_link'));
        }

    }
}
