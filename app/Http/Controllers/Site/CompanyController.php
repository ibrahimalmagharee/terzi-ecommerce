<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Design;
use App\Models\Fabric;
use App\Models\Logo;
use App\Models\SocialMediaLink;
use App\Models\Vendor;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function companyProfile($vendor_id)
    {
        $vendor = Vendor::find($vendor_id);
        $logo = Logo::first();
        $social_media_link = SocialMediaLink::get();

        if (!$vendor_id){
            $notification = array(
                'message' => 'هذا التاجر غير موجود',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        $product_designs = Design::where('vendor_id', $vendor_id)->get();
        $product_fabrics = Fabric::where('vendor_id', $vendor_id)->get();

        if (auth('customer')->user()) {
            $basket_products = auth('customer')->user()
                ->basketProduct()
                ->get();

            return view('site.customer.companyProfileCustomer', compact('vendor','product_designs','product_fabrics', 'basket_products', 'social_media_link', 'logo'));

        } else {
            return view('site.customer.companyProfileCustomer', compact('vendor','product_designs','product_fabrics', 'social_media_link', 'logo'));

        }

    }

    public function viewCompanies()
    {
        $vendors = Vendor::get();

        $logo = Logo::first();

        $social_media_link = SocialMediaLink::get();

        if (auth('customer')->user()) {
            $basket_products = auth('customer')->user()
                ->basketProduct()
                ->get();

            return view('site.customer.companiesForCustomer', compact('vendors', 'basket_products', 'social_media_link', 'logo'));
        } else {
            return view('site.customer.companiesForCustomer', compact('vendors', 'social_media_link', 'logo'));

        }


    }
}
