@extends('layouts.site')

@section('title')
    من نحن
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
                        <a class="nav-link MontserratArabicLight"
                           href="{{route('customer.viewFabricProduct')}}">الأقمشة</a>
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

    <section class="container mt-5">
        <div class="row mb-5">
            <div class="col text-right">
                <p class=" py-3 about-text MontserratArabic">من نحن</p>
            </div>
        </div>
        <div class="container">
            @isset($about_us)

                <div class="row">
                    <div class="col-md-5 col-sm-12">
                        @if($about_us->image)
                            @if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png')

                                <img src="{{$about_us->getPhoto($about_us->image->photo)}}" class="w-100" alt="photo">

                            @elseif($ext == 'mp4' || $ext == 'ogx' || $ext == 'oga'  || $ext == 'ogv' || $ext == 'ogg' || $ext == 'webm')

                                <video class="w-100" height="240" controls>

                                    <source src="{{$about_us->getPhoto($about_us->image->photo)}}">
                                </video>
                            @endif

                        @else
                            <iframe width="420" height="315" src="{{$link}}" class="w-100" height="240" frameborder="0"
                                    allowfullscreen></iframe>

                        @endif

                    </div>
                    <div class="col-md-7 col-sm-12">
                        <p class="p-5 mx-5 MontserratArabicLight font22 ab-text">{{$about_us->about}}</p>
                    </div>
                </div>

            @endisset

        </div>
    </section>

    <section class="container-fluid mt-5 pl-5 pr-5">
        <div class="row mb-5">
            <div class="col text-center">
                <h2 class="text-warning py-3 MontserratArabicLight font30">أبرز مراجعات عملائنا</h2>
                <p class="MontserratArabicLight">نسعى دائما لتوفير أفضل تجربة لعملائنا داخل المنصة</p>
            </div>
        </div>
        <div class="owl-carousel third owl-theme">
            <div class="item d-flex justify-content-center">
                <div class="opinions card border-0 shadow-lg rounded w-50 mb-5 p-5 text-center">
                    <p class="MontserratArabicLight">لقد كانت تجربة ممتعة لي داخل المنصة حيث انني قمت بتجهيز كافة ملابسي
                        من كان واحد وكانت أيضا سهلة الاستخدام</p>
                    <div class="d-flex justify-content-center mt-3">
                        <img src="{{asset('/public/assets/front/assets/kelly-sikkema-v9FQR4tbIq8-unsplash.png')}}"
                             class=" rounded-circle shadow img-round-second" alt="">
                    </div>
                    <div class="card-body text-center pt-3">
                        <h5 class="card-title">سارة الدواسرة</h5>
                        <p class="MontserratArabicLight">السعودية</p>
                    </div>
                </div>
            </div>
            <div class="item d-flex justify-content-center">
                <div class="opinions card border-0 shadow-lg rounded w-50 mb-5 p-5 text-center">
                    <p class="MontserratArabicLight">لقد كانت تجربة ممتعة لي داخل المنصة حيث انني قمت بتجهيز كافة ملابسي
                        من كان واحد وكانت أيضا سهلة الاستخدام</p>
                    <div class="d-flex justify-content-center mt-3">
                        <img src="{{asset('/public/assets/front/assets/kelly-sikkema-v9FQR4tbIq8-unsplash.png')}}"
                             class=" rounded-circle shadow img-round-second" alt="">
                    </div>
                    <div class="card-body text-center pt-3">
                        <h5 class="card-title">سارة الدواسرة</h5>
                        <p class="MontserratArabicLight">السعودية</p>
                    </div>
                </div>
            </div>
            <div class="item d-flex justify-content-center">
                <div class="opinions card border-0 shadow-lg rounded w-50 mb-5 p-5 text-center">
                    <p class="MontserratArabicLight">لقد كانت تجربة ممتعة لي داخل المنصة حيث انني قمت بتجهيز كافة ملابسي
                        من كان واحد وكانت أيضا سهلة الاستخدام</p>
                    <div class="d-flex justify-content-center mt-3">
                        <img src="{{asset('/public/assets/front/assets/kelly-sikkema-v9FQR4tbIq8-unsplash.png')}}"
                             class=" rounded-circle shadow img-round-second" alt="">
                    </div>
                    <div class="card-body text-center pt-3">
                        <h5 class="card-title">سارة الدواسرة</h5>
                        <p class="MontserratArabicLight">السعودية</p>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="container-fluid  mb-5 pl-5 pr-5">
        <div class="row mb-5">
            <div class="col text-center">
                <h2 class="text-warning pb-3 MontserratArabic font30">خدماتنا</h2>
                <p class="MontserratArabicLight">منصة مختصة ببيع التصاميم والأقمشة بحيث نوفر كل هذا في مكان واحد</p>
            </div>
        </div>
        <div class="container">
            <div class="row  py-2">
                <div class="col-md-6 col-sm-12 p-5">
                    <div class="text-right about-last ">
                        <h2 class="text-warning py-3 about-text MontserratArabic font30">الأقمشة</h2>
                        <p class="MontserratArabicLight">جميع أنواع الأقمشة من أشهر الشركات المقدة</p>
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        <a class="btn btn-yellow-about MontserratArabicLight"
                           href="{{route('customer.viewFabricProduct')}}"> رؤية المزيد</a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <img src="{{asset('/public/assets/front/assets/Image1.png')}}" class="w-100 shadow" alt="">
                </div>
            </div>

            <div class="row  py-2">
                <div class="col-md-6 col-sm-12">
                    <img src="{{asset('/public/assets/front/assets/Image2.png')}}" class="w-100 shadow" alt="">
                </div>
                <div class="col-md-6 col-sm-12 p-5">
                    <div class="text-right about-last">
                        <h2 class="text-warning about-text py-3 MontserratArabic font30">التصاميم</h2>
                        <p class="MontserratArabicLight">العديد والعديد من التصاميم العصرية</p>
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        <a class="btn btn-yellow-about" href="{{route('customer.viewDesignProduct')}}"> رؤية المزيد</a>
                    </div>
                </div>
            </div>

            <div class="row  pt-2 pb-5">
                <div class="col-md-6 col-sm-12 p-5">
                    <div class="text-right about-last">
                        <h2 class="text-warning about-text py-3 MontserratArabic font30">التوصيل</h2>
                        <p class="MontserratArabicLight"> سيتم توصيل طلبك للمكان الذي تريده</p>
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        <button class="btn btn-yellow-about"> رؤية المزيد</button>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <img src="{{asset('/public/assets/front/assets/Image1.png')}}" class="w-100 shadow" alt="">
                </div>
            </div>

        </div>
    </section>
    @include('site.customer.footer')

@endsection
