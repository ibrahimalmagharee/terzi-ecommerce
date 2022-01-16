<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\DesignResource;
use App\Http\Resources\FabricResource;
use App\Models\Design;
use App\Models\Fabric;
use App\Models\Logo;
use App\Models\SocialMediaLink;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function getSearchPage()
    {
        $logo = Logo::first();
        $social_media_link = SocialMediaLink::get();
        if (auth('customer')->user()) {
            $basket_products = auth('customer')->user()
                ->basketProduct()
                ->get();

            return view('site.customer.search', compact('basket_products', 'social_media_link', 'logo'));
        } else{
            return view('site.customer.search', compact('social_media_link', 'logo'));
        }

    }

    public function getSearch(Request $request)
    {
         $search = $request->input('search');

        $designs = Design::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->get();
        DesignResource::collection($designs);

        $fabrics = Fabric::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->get();
        FabricResource::collection($fabrics);

        return view('site.customer._productSearch', compact('designs', 'fabrics', 'search'));

    }
}
