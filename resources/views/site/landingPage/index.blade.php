@extends('layouts.site')

@section('title')
    الصفحة الرئيسية
@endsection
@section('content')
<header class="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent container pt-4">
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
                <li class="nav-item active">
                    <a class="nav-link MontserratArabicLight" href="{{route('index')}}"
                    >الرئيسية<span class="sr-only">(current)</span></a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link MontserratArabicLight" href="{{route('customer.viewFabricProduct')}}">الأقمشة</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link MontserratArabicLight" href="{{route('customer.viewDesignProduct')}}">التصاميم</a>
                </li>
                @auth('customer')
                    <li class="nav-item pl-2">
                        <a class="nav-link MontserratArabicLight"
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
                        <a class="nav-link MontserratArabicLight" href="{{route('customer.login.page')}}">تسجيل
                            الدخول</a>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>

    <div class="title mx-auto text-center">
        <h2 class="py-2">ابدأ بتفصيل ملابسك الان</h2>
        <p class="pb-2">قمنا بجمعهم لك في مكان واحد أقمشتك وتصاميمك</p>
        @guest('customer')
        <a class="btn btn-yellow" href="{{route('customer.login.page')}}">سجل دخولك الان</a>
        @endguest
    </div>
</header>

<section class=" after-header">
    <div class="row py-2">
        <div class="col-md-4 col-sm-12">
            <div class="row">
                <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                    <img src="{{asset('/public/assets/front/assets/cloth.png')}}" alt="">
                </div>
                <div class="col-md-6 col-sm-12 text-center pt-3">
                    <p>جميع خامات الأقمشة لكل مناسباتك</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="row">
                <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                    <img src="{{asset('/public/assets/front/assets/dummy.png')}}" alt="">
                </div>
                <div class="col-md-6 col-sm-12 text-center pt-3">
                    <p>تصاميم مميزة بانتظارك</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="row">
                <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                    <img src="{{asset('/public/assets/front/assets/package.png')}}" alt="">
                </div>
                <div class="col-md-6 col-sm-12 text-center pt-3">
                    <p>توصيل آمن لكل طلباتك</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container">
    <div class="row py-2">
        <h4 class="border-bottom border-warning p-2 section-title font30">الأقمشة</h4>
    </div>
    <div  class="owl-carousel first owl-theme">
        <div class="item">
            <div class="row text-right">
                <div class="col-md-4 col-sm-12">
                    <h2 class=" first-title py-5">اكتشف </h2>
                    <p class=" first-details py-4">لدينا مجموعات كثيرة جدا من الأقمشة والألوان والشركات المقدمة</p>
                    <a class="first-btn btn btn-yellow mt-5" href="{{route('customer.viewFabricProduct')}}">تسوق الآن</a>
                </div>
                <div class="col-md-8 col-sm-12">
                    <img src="{{asset('/public/assets/front/assets/actionvance-UvisJMJmqAU-unsplash.png')}}" class="w-100" alt="">
                </div>
            </div>
        </div>
        <div class="item">
            <div class="row text-right">
                <div class="col-md-4 col-sm-12">
                    <h2 class="first-title py-5">اكتشف  </h2>
                    <p class="first-details py-4">لدينا مجموعات كثيرة جدا من الأقمشة والألوان والشركات المقدمة</p>
                    <a class="first-btn btn btn-yellow mt-5" href="{{route('customer.viewFabricProduct')}}">تسوق الآن</a>
                </div>
                <div class="col-md-8 col-sm-12">
                    <img src="{{asset('/public/assets/front/assets/actionvance-UvisJMJmqAU-unsplash.png')}}" class="w-100" alt="">
                </div>
            </div>
        </div>
        <div class="item">
            <div class="row text-right">
                <div class="col-md-4 col-sm-12">
                    <h2 class="py-5 first-title">اكتشف </h2>
                    <p class="py-4 first-details">لدينا مجموعات كثيرة جدا من الأقمشة والألوان والشركات المقدمة</p>
                    <a class="first-btn btn btn-yellow mt-5" href="{{route('customer.viewFabricProduct')}}">تسوق الآن</a>
                </div>
                <div class="col-md-8 col-sm-12">
                    <img src="{{asset('/public/assets/front/assets/actionvance-UvisJMJmqAU-unsplash.png')}}" class="w-100" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mt-5">
    <div class="container">
        <div class=" row justify-content-center">
            <h4 class="border-bottom border-warning p-2 my-5 first-title font30">التصاميم</h4>
        </div>
    </div>
    <div class="cover">
        <div class="content text-center">
            <div class="container mt-5">
                <div class=" row justify-content-center py-5">
                    <h5 class="border-bottom border-warning p-2 text-white first-title">تصاميم جديدة و عصرية</h5>
                </div>
            </div>
            <a class="btn btn-yellow-outline my-4 MontserratArabicLight" href="{{route('customer.viewDesignProduct')}}">اختر الان</a>
        </div>
    </div>
</section>

<section class="container pb-5 my-5">

    <div class="row mb-5">
        <div class="col text-right d-flex">
            <h4  class="pr-2 border-3 section-title" >الشركات المميزة</h4>
            <div class="mr-3">
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
        <div class="col text-left">
            <a class="link-title section-title" href="{{route('customer.viewCompanies')}}">عرض الكل </a>
        </div>
    </div>
    <div class="row mt-5">
        @isset($vendors)
            @foreach($vendors as $vendor)
                @if(count($vendor->product) > 1)
                <div class="col-md-4 col-sm-12 pr-0 pl-5 pr-3 resp my-2 col-resp2">
                    <div class="card border-0 shadow-cust rounded-cust card-resp" style="width: 100%;">
                        <img src="{{asset('/public/assets/front/assets/jennifer-burk-ECXB0YAZ_zU-unsplash.png')}}" class="card-img-top">
                        <div class="d-flex justify-content-center">
                            <img src="{{$vendor->getPhoto($vendor->image->photo)}}" class="img-rounded img-round" style="border-radius: 50%; height: 100px" alt="">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title">{{$vendor->name}}</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="card-text">النوع: {{$vendor->type_activity}} </p>
                                <p class="card-text">{{count($vendor->product)}} منتج</p>
                            </div>
                            <a href="{{route('customer.companyProfile', $vendor->id)}}" class="btn btn-yellow">عرض المنتجات</a>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            @endisset


    </div>
</section>

<section class="container mt-5">
    <div class="row mb-5">
        <div class="col text-right">
            <h4  class="most-sold border-width-top pr-2 section-title" >الاكثر مبيعا</h4>
            <div class="mr-3 newdots">
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
    </div>
    <div>
        <div class="row px-0">
            <div class="col-md-9 col-sm-12 mb-2 d-flex justify-content-center">
                <div class="card mb-4 bg-light border-0 shadow-cust card-resp">
                    <div class="row no-gutters">
                        <div class="col-md-8 col-sm-12">
                            <img src="{{asset('/public/assets/front/assets/actionvance-UvisJMJmqAU-unsplash.png')}}" style=" height: 368px;" class="card-img" alt="...">
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="card-body text-right p-3">
                                <h5 class="card-title border-width py-2 card-title-cust">قماش <br>
                                    زهري مموج <br>
                                    ستان خامة ممتازة</h5>
                                <p class="card-text card-text-cust">نص ترويجي للقماش يضيفه صاحب المنتج نص ترويجي للقماش يضيفه صاحب المنتج نص ترويجي للقماش يضيفه صاحب المنتج </p>
                                <a href="#" class="float-left font-22  mt-4 text-warning"> تسوق الآن <i class="fa fa-arrow-left .text-warning" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 mb-2 d-flex justify-content-center">
                <div class="jacket card bg-light border-0 shadow-cust card-resp" style=" height: 368px;">
                    <img src="{{asset('/public/assets/front/assets/ghaly-wedinly-m4BFg71sNp4-unsplash.png')}}" class="card-img-top" alt="...">
                    <div class="card-body text-right p-1">
                        <h5 class="card-title border-width py-1">جاكيت عصري</h5>
                        <a href="#" class="float-left mt-5 mt-resp mt-resp2 text-warning">تسوق الآن <i class="fa fa-arrow-left .text-warning" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 col-sm-12 d-flex justify-content-center">
                <div class="card mb-3 bg-light border-0 shadow-cust card-resp">
                    <div class="row no-gutters">
                        <div class="col-md-4 col-sm-12">
                            <div class="card-body text-right p-3">
                                <h5 class="card-title border-width py-2 card-title-cust">قماش <br>
                                    زهري مموج <br>
                                    ستان خامة ممتازة</h5>
                                <p class="card-text card-text-cust ">نص ترويجي للقماش يضيفه صاحب المنتج نص ترويجي للقماش يضيفه صاحب المنتج نص ترويجي للقماش يضيفه صاحب المنتج </p>
                                <a href="#" class="float-left mt-5 font-22 text-warning special">تسوق الآن <i class="fa fa-arrow-left .text-warning" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <img src="{{asset('/public/assets/front/assets/henri-meilhac-jJ0tLs2ROd4-unsplash.png')}}" style=" height: 368px;" class="card-img" alt="...">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 d-flex justify-content-center">
                <div class=" jacket card bg-light border-0 shadow-cust card-resp" style=" height: 368px;">
                    <img src="{{asset('/public/assets/front/assets/engin-akyurt-SuehLCmYYEE-unsplash.png')}}" class="card-img-top" alt="...">
                    <div class="card-body text-right p-1">
                        <h5 class="card-title border-width py-1">جاكيت عصري</h5>
                        <a href="#" class="float-left mt-5 mt-resp mt-resp2 text-warning">تسوق الآن <i class="fa fa-arrow-left .text-warning" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>

<section class="container-fluid mt-5 mb-5 pl-5 pr-5">
    <div class="row mb-5">
        <div class="col text-center">
            <h2  class="text-warning py-3 MontserratArabicLight font48" >أبرز مراجعات عملائنا</h2>
            <p class="MontserratArabicLight">نسعى دائما لتوفير أفضل تجربة لعملائنا داخل المنصة</p>
        </div>
    </div>
    <div  class="owl-carousel third owl-theme">
        <div class="item d-flex justify-content-center">
            <div class="opinions card border-0 shadow-lg rounded w-50 mb-5 p-5 text-center col-md-6 col-sm-12" >
                <p class="MontserratArabicLight">لقد كانت تجربة ممتعة لي داخل المنصة حيث انني قمت بتجهيز كافة ملابسي من كان واحد وكانت أيضا سهلة الاستخدام</p>
                <div class="d-flex justify-content-center mt-3">
                    <img src="{{asset('/public/assets/front/assets/kelly-sikkema-v9FQR4tbIq8-unsplash.png')}}" class=" rounded-circle shadow img-round-second" alt="">
                </div>
                <div class="card-body text-center pt-3">
                    <h5 class="card-title">سارة الدواسرة</h5>
                    <p class="MontserratArabicLight">السعودية</p>
                </div>
            </div>
        </div>
        <div class="item d-flex justify-content-center">
            <div class="opinions card border-0 shadow-lg rounded w-50 p-5 text-center col-md-6 col-sm-12" >
                <p class="MontserratArabicLight">لقد كانت تجربة ممتعة لي داخل المنصة حيث انني قمت بتجهيز كافة ملابسي من كان واحد وكانت أيضا سهلة الاستخدام</p>
                <div class="d-flex justify-content-center mt-3">
                    <img src="{{asset('/public/assets/front/assets/kelly-sikkema-v9FQR4tbIq8-unsplash.png')}}" class=" rounded-circle shadow img-round-second" alt="">
                </div>
                <div class="card-body text-center pt-3">
                    <h5 class="card-title">سارة الدواسرة</h5>
                    <p class="MontserratArabicLight">السعودية</p>
                </div>
            </div>
        </div>
        <div class="item d-flex justify-content-center">
            <div class="opinions card border-0 shadow-lg rounded w-50 p-5 text-center col-md-6 col-sm-12" >
                <p class="MontserratArabicLight">لقد كانت تجربة ممتعة لي داخل المنصة حيث انني قمت بتجهيز كافة ملابسي من كان واحد وكانت أيضا سهلة الاستخدام</p>
                <div class="d-flex justify-content-center mt-3">
                    <img src="{{asset('/public/assets/front/assets/kelly-sikkema-v9FQR4tbIq8-unsplash.png')}}" class=" rounded-circle shadow img-round-second" alt="">
                </div>
                <div class="card-body text-center pt-3">
                    <h5 class="card-title">سارة الدواسرة</h5>
                    <p class="MontserratArabicLight">السعودية</p>
                </div>
            </div>
        </div>
    </div>

</section>

@include('site.customer.footer')



@endsection
