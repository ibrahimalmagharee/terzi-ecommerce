@extends('layouts.site')

@section('title')
    مشترياتي
@endsection
@section('content')
@endsection
<header class="bg-dark ">
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent container pt-2">
        <a class="navbar-brand MontserratArabic-logo text-warning" href="{{route('index')}}">
            @isset($logo)
                <img src="{{$logo->getPhoto($logo->photo)}}" style="width: 50px">

            @else
                ترزي
            @endisset
        </a>
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link MontserratArabicLightPure" href="{{route('index')}}"
                    >الرئيسية<span class="sr-only">(current)</span></a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link MontserratArabicLightPure"
                       href="{{route('customer.viewFabricProduct')}}">الأقمشة</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link MontserratArabicLightPure"
                       href="{{route('customer.viewDesignProduct')}}">التصاميم</a>
                </li>
                @auth('customer')
                    <li class="nav-item">
                        <a class="nav-link MontserratArabicLightPure"
                           href="{{route('customer.sizes')}}">المقاسات</a>
                    </li>
                @endauth
                <li class="nav-item">

                    <a class="nav-link MontserratArabicLight" href="{{route('basket.products.index')}}">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <div class="cart-products-count">@auth('customer') {{count($basket_products)}} @else 0 @endauth</div>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('customer.getSearchPage')}}"
                    ><i class="fa fa-search" aria-hidden="true"></i>
                    </a>
                </li>
                @auth('customer')
                    <li class="nav-item">
                        <a class="nav-link MontserratArabicLightPure" href="{{route('contactUs')}}">اتصل بنا</a>
                    </li>
                @endauth
                @auth('customer')
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="navbarDropdown"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item d-flex justify-content-between" href="{{route('wishlist.products.index')}}">
                                <p>منتجاتي المفضلة</p>
                                <i class="fa fa-heart  mr-3 nav-icon" aria-hidden="true"></i>
                            </a>

                            <a class="dropdown-item d-flex justify-content-between" href="{{route('customer.getMyPurchases')}}">
                                <p>مشترياتي</p>
                                <i class="fa fa-shopping-cart  mr-3 nav-icon" aria-hidden="true"></i>
                            </a>

                            <a class="dropdown-item d-flex justify-content-between" href="#">
                                <p>مساعدة</p>
                                <i class="fa fa-question-circle  mr-3 nav-icon" aria-hidden="true"></i>
                            </a>

                            <a class="dropdown-item d-flex justify-content-between" href="{{route('customer.logout')}}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <p>تسجيل الخروج</p>
                                <i class="fa fa-sign-out  mr-3 nav-icon" aria-hidden="true"></i>
                                <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </a>


                        </div>
                    </li>
                @endauth
                @guest('customer')
                    <li class="nav-item">
                        <a class="nav-link MontserratArabicLightPure" href="{{route('customer.login.page')}}">تسجيل الدخول</a>
                    </li>

                @endguest
            </ul>
        </div>
    </nav>
</header>

<div class="container">

    <div class="container pb-5 my-5">
        <div class="row ">
            <div class="col text-right d-flex p-0">
                <h4 class="section-title"> مشترياتي</h4>
            </div>
        </div>
    </div>

    <div class="row my-5">
        @isset($proceeds)
            @foreach($proceeds as $proceed)
                @isset($designs)
                    @foreach($designs as $design)
                        @foreach($products as $product)
                            @if($proceed->product_id == $product->id)
                                @if($product->productable_type == 'App\Models\Design')
                                    @if($design->id == $product->productable_id)

                                        <div class="col-lg-6 com-sm-6">
                                            <div class="card mb-3  shadow-cust width-cust" style="width: 100%">
                                                <div class="row g-0">
                                                    <div class="col-md-5">
                                                        <img class="img-product rou"
                                                             style="width: 200px; height: 200px;"
                                                             src="{{$design->getPhoto($design->images[0]->photo)}}"
                                                             alt="...">
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="card-body text-right py-4 px-3">
                                                            <div class="row">
                                                                <div class="col-8 pr-2">
                                                                    <p class="card-title MontserratArabicLightPure">{{$design->name}}</p>
                                                                </div>
                                                                <div class="col text-danger text-left pr-0">
                                                                    <small class="MontserratArabicLightPure">تم</small>
                                                                </div>
                                                            </div>


                                                            <div class="row mt-2">
                                                                <div class="col pl-1 overflow-hidden">
                                                                    <small class="MontserratArabicLightPure"> العدد
                                                                        - {{$proceed->quantity}}</small>
                                                                </div>
                                                                <div class="col pr-1">
                                                                    <small class="MontserratArabicLightPure"
                                                                           href="">{{$design->product->vendor->name}}</small>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                @if($design->product->offer)
                                                                    <p class="card-text pr-1">{{$design->product->price - (($design->product->price / 100) * $design->product->offer)}} ر.س </p>
                                                                @else
                                                                    <p class="card-text pr-1">{{$design->product->price}} ر.س</p>
                                                                @endif
                                                            </div>
                                                            <div class="row mt-3">
                                                                <p class="card-text pr-1 ">{{$proceed->created_at->format('m/d/Y')}}</p>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                @endisset
            @endforeach
        @endisset

        @isset($proceeds)
            @foreach($proceeds as $proceed)
                @isset($fabrics)
                    @foreach($fabrics as $fabric)
                        @foreach($products as $product)
                            @if($proceed->product_id == $product->id)
                                @if($product->productable_type == 'App\Models\Fabric')
                                    @if($fabric->id == $product->productable_id)
                                        <div class="col-lg-6 com-sm-6">
                                            <div class="card mb-3  shadow-cust width-cust" style="width: 100%">
                                                <div class="row g-0">
                                                    <div class="col-md-5">
                                                        <img class="img-product " style="width: 200px; height: 200px;"
                                                             src="{{$fabric->getPhoto($fabric->images[0]->photo)}}"
                                                             alt="...">
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="card-body text-right py-4 px-3">
                                                            <div class="row">
                                                                <div class="col-8 pr-2">
                                                                    <p class="card-title MontserratArabicLightPure">{{$fabric->name}}</p>
                                                                </div>
                                                                <div class="col text-danger text-left pr-0">
                                                                    <small class="MontserratArabicLightPure">تم</small>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-2">
                                                                <div class="col pl-1 overflow-hidden">
                                                                    <small class="MontserratArabicLightPure"> العدد -
                                                                        {{$proceed->quantity}}</small>
                                                                </div>
                                                                <div class="col pr-1">
                                                                    <small class="MontserratArabicLightPure" href="">{{$fabric->product->vendor->name}}</small>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                @if($fabric->product->offer)
                                                                    <p class="card-text pr-1">{{$fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)}} ر.س </p>
                                                                @else
                                                                    <p class="card-text pr-1">{{$fabric->product->price}} ر.س</p>
                                                                @endif
                                                            </div>
                                                            <div class="row mt-3">
                                                                <p class="card-text pr-1 ">{{$proceed->created_at->format('m/d/Y')}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                @endisset
            @endforeach
        @endisset

    </div>

</div>


@include('site.customer.footer')



@section('script')

@endsection
