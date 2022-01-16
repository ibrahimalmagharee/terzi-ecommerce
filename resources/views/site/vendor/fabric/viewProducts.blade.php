@extends('layouts.site')

@section('title')
    منتجات تاجر | تفصيل
@endsection
@section('content')
    <header  class="bg-dark ">
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent container pt-2">
            <a class="navbar-brand MontserratArabic-logo text-warning" href="{{route('vendor.aboutFabric')}}">
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
                    <li class="nav-item">
                        <a class="nav-link MontserratArabicLightPure" href="{{route('vendor.aboutFabric')}}"
                        >الرئيسية<span class="sr-only">(current)</span></a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link MontserratArabicLightPure" href="{{route('vendor.addProductFabric')}}">إضافة منتج</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link MontserratArabicLightPure text-warning" href="{{route('vendor.viewProductsFabric')}}">المنتجات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link MontserratArabicLightPure" href="{{route('vendor.purseFabric')}}"
                        >المحفظة
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('vendor.getSearchPageFabric')}}"
                        ><i class="fa fa-search" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link MontserratArabicLightPure" href="{{route('vendor.contactUsFabric')}}">اتصل بنا</a>
                    </li>
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
                            <a class="dropdown-item" href="{{route('vendor.profileFabric')}}">الملف الشخصي</a>
                            <a class="dropdown-item" href="{{route('vendor.changePasswordFabric')}}">تغيير كلمة المرور</a>
                            <a class="dropdown-item" href="{{route('vendor.logout')}}">تسجيل الخروج</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>


    <div class="container">

        <div class="container pb-5 my-5">
            <div class="row ">
                <div class="col text-right d-flex p-0">
                    <h4  class="pr-2 border-3 section-title" >منتجاتي</h4>
                </div>
            </div>
            <div class="row my-5">
                @if($fabrics -> count() > 0)
                    @foreach($fabrics as $fabric)
                        @if($vendor->id == $fabric->product->vendor->id)
                            <div class="card mb-3 rounded-cust-prod shadow-cust width-cust" style="width: 100%">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img class="img-product rounded-cust-prod-right" style="width: 373px; height: 313px;"
                                             src="{{$fabric->getPhoto($fabric->images[0]->photo)}}" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body text-right py-4 px-5">
                                            <div class="row">
                                                <div class="col pr-4">
                                                    <h5 class="card-title">{{$fabric->name}}</h5>
                                                </div>
                                                <div class="col text-left">
                                                    <p class="MontserratArabicLightPure">{{$fabric->product->sales}}  اشتريا هذا المنتج </p>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-10 pl-5 overflow-hidden">
                                                    <p class="card-text">
                                                        {{\Illuminate\Support\Str::limit($fabric->description, 100)}}
                                                    </p>
                                                    <br>
                                                    <small class="MontserratArabicLightPure mt-1">{{$fabric->product->offer == '' ? 'لايوجد عرض' : $fabric->product->offer}} @if($fabric->product->offer != '') % @endif</small>
                                                </div>
                                                <div class="col pt-5 pr-4">
                                                    <a class="MontserratArabicLightPure" href="{{route('vendor.viewFabricProductDetails',$fabric->id)}}">المزيد</a>
                                                </div>
                                            </div>
                                            <div class="row mt-5">
                                                @if($fabric->product->offer)
                                                    <p class="card-text pr-3"><s>{{$fabric->product->price}} ر.س</s></p>
                                                    <p class="card-text pr-3">{{$fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)}} ر.س </p>
                                                @else
                                                    <p class="card-text pr-3">{{$fabric->product->price}} ر.س</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endif
                    @endforeach
                @else
                    <div class="my-5">
                        <h5 class="MontserratArabicLight">لا يوجد منتجات لعرضها الان</h5>
                    </div>
                @endif

            </div>


        </div>
    </div>

    <footer class="bg-dark mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 col-sm-12 d-flex">
                    <a class="navbar-brand MontserratArabic-logo text-warning pt-4 footer-logo" href="{{route('vendor.aboutFabric')}}">
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
                            <a class="text-white" href="{{route('vendor.aboutFabric')}}">الرئيسية</a>
                        </li>
                        <li class="py-2">
                            <a class="text-white" href="{{route('vendor.viewProductsFabric')}}">الأقمشة</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-2 col-sm-12">
                    <ul class="footer-col pt-4">
                        <li class="py-2">
                            <a class="text-muted" href="{{route('vendor.aboutFabric')}}">من نحن ؟</a>
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
                                        <img src="{{asset('/public/assets/front/assets/send.png')}}" alt="">
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

@section('script')
@endsection
