@extends('layouts.site')

@section('title')
    من نحن
@endsection
@section('content')
    <header class="about-header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent container pt-2">
            <a class="navbar-brand MontserratArabic-logo text-warning" href="{{route('vendor.aboutBoth')}}">
                @isset($logo)
                    <img src="{{$logo->getPhoto($logo->image->photo)}}" style="width: 50px">

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
                    <li class="nav-item  mx-4">
                        <a class="nav-link MontserratArabicLightPure text-lg-warning" href="{{route('vendor.aboutBoth')}}"
                        >الرئيسية<span class="sr-only">(current)</span></a
                        >
                    </li>

                    <li class="nav-item dropdown mx-2">
                        <a
                            class="nav-link dropdown-toggle nav-vendor"
                            href="#"
                            id="navbarDropdown"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            إضافة منتج
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('vendor.addProductDesign')}}">إضافة منتج تفصيل</a>
                            <a class="dropdown-item" href="{{route('vendor.addProductFabric')}}">إضافة منتج قماش</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown mx-2">
                        <a
                            class="nav-link dropdown-toggle nav-vendor"
                            href="#"
                            id="navbarDropdown"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            المنتجات
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('vendor.viewProductsDesign')}}">منتجات التفصيل</a>
                            <a class="dropdown-item" href="{{route('vendor.viewProductsFabric')}}">منتجات الأقمشة</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown mx-3">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="navbarDropdown"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            المحفظة
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('vendor.purseDesign')}}">مبيعات التفصيل</a>
                            <a class="dropdown-item" href="{{route('vendor.purseFabric')}}">مبيعات الأقمشة</a>
                        </div>
                    </li>
                    <li class="nav-item  mx-2">
                        <a class="nav-link nav-vendor" href="{{route('vendor.getSearchPageBoth')}}"
                        ><i class="fa fa-search" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link MontserratArabicLightPure nav-vendor" href="{{route('vendor.contactUsBoth')}}">اتصل بنا</a>
                    </li>
                    <li class="nav-item dropdown mr-3">
                        <a
                            class="nav-link dropdown-toggle nav-vendor"
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
                            <a class="dropdown-item" href="{{route('vendor.profileBoth')}}">الملف الشخصي</a>
                            <a class="dropdown-item" href="{{route('vendor.changePasswordBoth')}}">تغيير كلمة المرور</a>
                            <a class="dropdown-item" href="{{route('vendor.logout')}}">تسجيل الخروج</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 text-right">
                    <h1 class="py-5 mt-6 px-3 font28 MontserratArabic ">ابدأ ببيع
                        <br>
                        وتفصيل تصاميمك
                        <br>
                        الان !</h1>

                    <p class="px-3 mt-3 mb-5 MontserratArabicLight">
                        يمكنك الان عرض منتجاتك وخدماتك وتصاميمك وترتيبها وجدولتها والبيع من خلال منصة ترزي .
                    </p>
                    <button class="mx-3 mt-6 btn btn-yellow">هيا بنا ؟</button>
                </div>
                <div class="col-md-7 col-sm-12 about-header-sec">
                    <img class="pr-5 py-5 w-100" src="{{asset('public/assets/front/assets/Container.png')}}" alt="">
                </div>
            </div>
        </div>
    </header>

    <section class="container mt-5">
      <div class="row mb-5">
        <div class="col text-right">
          <p class="py-3 about-text MontserratArabic">من نحن</p>
        </div>
      </div>
      <div class="container">
        <div class="row">
            @foreach($data['about_vendor'] as $about_vendor)
                @if($about_vendor->vendor_id == $vendor->id)

          <div class="col-md-5 col-sm-12">
            <img src="{{$about_vendor->getPhoto($about_vendor->image->photo)}}" style="width: 357.5px; height: 400px" class="w-100" alt="" />
          </div>
          <div class="col-md-7 col-sm-12">
            <p class="p-5 mx-5 MontserratArabicLight font22 ab-text">
              {{$about_vendor->about}}
            </p>
              @endif
              @endforeach
          </div>
        </div>
      </div>
    </section>

    <section class="container-fluid mt-5 pl-5 pr-5">
        <div class="row mb-5">
            <div class="col text-center">
                <h2  class="text-warning py-3 MontserratArabicLight font30" >أبرز مراجعات عملائنا</h2>
                <p class="MontserratArabicLight">نسعى دائما لتوفير أفضل تجربة لعملائنا داخل المنصة</p>
            </div>
        </div>
        <div  class="owl-carousel third owl-theme">
            <div class="item d-flex justify-content-center">
                <div class="opinions card border-0 shadow-lg rounded w-50 mb-5 p-5 text-center" >
                    <p class="MontserratArabicLight">لقد كانت تجربة ممتعة لي داخل المنصة حيث انني قمت بتجهيز كافة ملابسي من كان واحد وكانت أيضا سهلة الاستخدام</p>
                    <div class="d-flex justify-content-center mt-3">
                        <img src="{{asset('public/assets/front/assets/kelly-sikkema-v9FQR4tbIq8-unsplash.png')}}" class=" rounded-circle shadow img-round-second" alt="">
                    </div>
                    <div class="card-body text-center pt-3">
                        <h5 class="card-title">سارة الدواسرة</h5>
                        <p class="MontserratArabicLight">السعودية</p>
                    </div>
                </div>
            </div>
            <div class="item d-flex justify-content-center">
                <div class="opinions card border-0 shadow-lg rounded w-50 mb-5 p-5 text-center" >
                    <p class="MontserratArabicLight">لقد كانت تجربة ممتعة لي داخل المنصة حيث انني قمت بتجهيز كافة ملابسي من كان واحد وكانت أيضا سهلة الاستخدام</p>
                    <div class="d-flex justify-content-center mt-3">
                        <img src="{{asset('public/assets/front/assets/kelly-sikkema-v9FQR4tbIq8-unsplash.png')}}" class=" rounded-circle shadow img-round-second" alt="">
                    </div>
                    <div class="card-body text-center pt-3">
                        <h5 class="card-title">سارة الدواسرة</h5>
                        <p class="MontserratArabicLight">السعودية</p>
                    </div>
                </div>
            </div>
            <div class="item d-flex justify-content-center">
                <div class="opinions card border-0 shadow-lg rounded w-50 mb-5 p-5 text-center" >
                    <p class="MontserratArabicLight">لقد كانت تجربة ممتعة لي داخل المنصة حيث انني قمت بتجهيز كافة ملابسي من كان واحد وكانت أيضا سهلة الاستخدام</p>
                    <div class="d-flex justify-content-center mt-3">
                        <img src="{{asset('public/assets/front/assets/kelly-sikkema-v9FQR4tbIq8-unsplash.png')}}" class=" rounded-circle shadow img-round-second" alt="">
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
                <h2  class="text-warning pb-3 MontserratArabic font30" >خدماتنا</h2>
                <p class="MontserratArabicLight">منصة مختصة ببيع التصاميم والأقمشة بحيث نوفر كل هذا في مكان واحد</p>
            </div>
        </div>
        <div class="container">
            <div class="row  py-2">
                <div class="col-md-6 col-sm-12 p-5">
                    <div class="text-right about-last ">
                        <h2  class="text-warning py-3 about-text MontserratArabic font30" >الأقمشة</h2>
                        <p class="MontserratArabicLight">جميع أنواع الأقمشة من أشهر الشركات المقدة</p>
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        <button class="btn btn-yellow-about MontserratArabicLight"> رؤية المزيد</button>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <img src="{{asset('public/assets/front/assets/Image1.png')}}" class="w-100 shadow" alt="">
                </div>
            </div>

            <div class="row  py-2">
                <div class="col-md-6 col-sm-12">
                    <img src="{{asset('public/assets/front/assets/Image2.png')}}" class="w-100 shadow" alt="">
                </div>
                <div class="col-md-6 col-sm-12 p-5">
                    <div class="text-right about-last">
                        <h2  class="text-warning about-text py-3 MontserratArabic font30" >التصاميم</h2>
                        <p class="MontserratArabicLight">العديد والعديد من التصاميم العصرية</p>
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        <button class="btn btn-yellow-about"> رؤية المزيد</button>
                    </div>
                </div>
            </div>

            <div class="row  pt-2 pb-5">
                <div class="col-md-6 col-sm-12 p-5">
                    <div class="text-right about-last">
                        <h2  class="text-warning about-text py-3 MontserratArabic font30" >التوصيل</h2>
                        <p class="MontserratArabicLight"> سيتم توصيل طلبك للمكان الذي تريده</p>
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        <button class="btn btn-yellow-about"> رؤية المزيد</button>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <img src="{{asset('public/assets/front/assets/Image1.png')}}" class="w-100 shadow" alt="">
                </div>
            </div>

        </div>
    </section>

    <footer class="bg-dark">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 col-sm-12 d-flex">
                    <a class="navbar-brand MontserratArabic-logo text-warning pt-4 footer-logo" href="{{route('vendor.aboutBoth')}}">
                        @isset($logo)
                            <img src="{{$logo->getPhoto($logo->image->photo)}}" style="width: 50px">

                        @else
                            ترزي
                        @endisset
                    </a>
                </div>
                <div class="col-md-2 col-sm-12">
                    <ul class="footer-col pt-4">
                        <li class="py-2">
                            <a class="text-white" href="{{route('vendor.aboutBoth')}}">الرئيسية</a>
                        </li>
                        <li class="py-2">
                            <a class="text-white" href="{{route('vendor.viewProductsDesign')}}" >التصاميم</a>
                        </li>
                        <li class="py-2">
                            <a class="text-white" href="{{route('vendor.viewProductsFabric')}}" >الأقمشة</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-2 col-sm-12">
                    <ul class="footer-col pt-4">
                        <li class="py-2">
                            <a class="text-muted" href="{{route('vendor.aboutBoth')}}">من نحن ؟</a>
                        </li>
                        <li class="py-2">
                            <a class="text-muted" href="">المساعدة</a>
                        </li>
                        <li class="py-2">
                            <a class="text-muted" href="" >الشروط</a>
                        </li>
                        <li class="py-2">
                            <a class="text-muted" href="">تقديم شكوى</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-12">
                    <form class="form-inline pt-4">
                        <div class="col p-0 text-right">
                            <div class="input-group ">
                                <input type="text" class="form-control bg-dark text-white border-left-0 rounded-right" placeholder="الايميل">
                                <div class="input-group-prepend">
                                    <button type="submit" class=" rounded-left border-right-0 bg-dark text-white input-group-text" >
                                        <img src="{{asset('public/assets/front/assets/send.png')}}" alt="">
                                    </button>
                                </div>
                            </div>
                            <small class="text-light MontserratArabicLight">
                                ابقى على تواصل مع اهم مستجدات عروضنا
                            </small>
                        </div>
                    </form>

                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="column text-light pt-4">
                        @if ($social_media_link[0])
                            <a class="text-decoration-none text-light" href="{{$social_media_link[0]->link}}" target="_blank"><i class="fa fa-facebook-f px-2"></i></a>
                        @endif

                        @if ($social_media_link[1])
                            <a class="text-decoration-none text-light" href="{{$social_media_link[1]->link}}" target="_blank"><i class="fa fa-instagram px-2"></i></a>
                        @endif

                        @if ($social_media_link[2])
                            <a class="text-decoration-none text-light" href="{{$social_media_link[2]->link}}" target="_blank"><i class="fa fa-twitter px-2"></i></a>
                        @endif

                        @if ($social_media_link[3])
                            <a class="text-decoration-none text-light" href="{{$social_media_link[3]->link}}" target="_blank"><i class="fa fa-youtube px-2"></i></a>
                        @endif

                        @if ($social_media_link[4])
                            <a class="text-decoration-none text-light" href="{{$social_media_link[4]->link}}" target="_blank"><i class="fa fa-whatsapp px-2"></i></a>
                        @endif

                        @if ($social_media_link[5])
                            <a class="text-decoration-none text-light" href="{{$social_media_link[5]->link}}" target="_blank"><img src="{{asset('/public/assets/front/assets/snapchat-brands.svg')}}" class="fa img_icon px-2"  alt=""></a>
                        @endif

                        @if ($social_media_link[6])
                            <a class="text-decoration-none text-light" href="{{$social_media_link[6]->link}}" target="_blank"><img src="{{asset('/public/assets/front/assets/tiktok-brands.svg')}}" class="fa img_icon px-2"  alt=""></a>
                        @endif

                    </div>

                </div>
            </div>
            <div class="row">
                <p class="copy-right mr-auto text-white">Tarze© Copyright 2020</p>
            </div>
        </div>
    </footer>

@endsection

