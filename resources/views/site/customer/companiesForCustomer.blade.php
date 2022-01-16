@extends('layouts.site')

@section('title')
    بروفايل الشركة
    @endsection
@section('content')
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
                        <a class="nav-link MontserratArabicLightPure" href="{{route('customer.viewFabricProduct')}}">الأقمشة</a>
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
        <div class="profile">

            <div class="container pb-5 my-5">
                <div class="row ">
                    <div class="col text-right d-flex p-0">
                        <h4  class="pr-2 border-3 section-title" >الشركات</h4>
                    </div>
                </div>

                <div class="row mt-5">
                    @isset($vendors)
                        @foreach($vendors as $vendor)
                            <div class="col-md-4 col-sm-12 pr-0 pl-5 pr-3 resp col-resp2 my-2">
                                <div class="card border-0 shadow-cust rounded-cust card-resp" style="width: 100%;">
                                    <img src="{{asset('/public/assets/front/assets/jennifer-burk-ECXB0YAZ_zU-unsplash.png')}}" class="card-img-top">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{$vendor->getPhoto($vendor->image->photo)}}" class="img-rounded img-round" style="border-radius: 50%; height: 100px" alt="">
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{$vendor->name}}</h5>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="card-text">النوع: {{$vendor->type_activity}}</p>
                                            <p class="card-text">{{count($vendor->product)}} منتج</p>
                                        </div>
                                        <a href="{{route('customer.companyProfile', $vendor->id)}}" class="btn btn-yellow">عرض المنتجات</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endisset
                </div>
            </div>
        </div>
    </div>

    @include('site.customer.footer')

@endsection

@section('script')

@endsection
