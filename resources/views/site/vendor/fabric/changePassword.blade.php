@extends('layouts.site')

@section('title')
    تغيير كلمة المرور | تاجر
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
                        <a class="nav-link MontserratArabicLightPure" href="{{route('vendor.viewProductsFabric')}}">المنتجات</a>
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

    <div class="container my-5">
        <div class="row ">
            <div class="col text-right d-flex p-0">
                <h4  class="pr-2 border-3 section-title" >تغيير كلمة المرور</h4>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-6 col-sm-12">
                <form method="post" action="{{route('vendor.updatePasswordFabric')}}" class="form justify-content-center px-lg-2 px-sm-2 mx-lg-5  ml-lg-2 reg-form-custom" _lpchecked="1">
                    @csrf
                    <div class="row mt-2"  style="height: 70px;">
                        <div role="group" class="col-md-12 col-sm-12">

                            <input name="old_password" id="old_password" type="password" class="form-control" placeholder=" ">
                            <label for="old_password"  class="MontserratArabicLight label">كلمة المرور القديمة</label>
                            <span class="log-after-input"><i toggle="#old_password" class="fa fa-eye toggle-password" aria-hidden="true"></i></span>

                            <div class="row position-absolute">
                                @error('old_password')
                                <span  class="text-danger MontserratArabicLightPure pr-3" style="margin-top:-20px; text-align: right">{{$message}}</span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="">
                        <div class="row mt-2"  style="height: 70px;">
                            <div role="group" class="col-md-12 col-sm-12">

                                <input name="password" id="password" type="password" class="form-control" placeholder=" ">
                                <label for="password"  class="MontserratArabicLight label">كلمة المرور الجديدة</label>
                                <span class="log-after-input"><i toggle="#password" class="fa fa-eye toggle-password" aria-hidden="true"></i></span>

                                <div class="row position-absolute">
                                    @error('password')
                                    <span  class="text-danger MontserratArabicLightPure pr-3" style="margin-top:-20px; text-align: right">{{$message}}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="row mt-2"  style="height: 70px;">
                            <div role="group" class="col-md-12 col-sm-12">

                                <input name="password_confirmation" id="password_confirmation" type="password" class="form-control" placeholder=" ">
                                <label for="password_confirmation"  class="MontserratArabicLight label">تأكيد كلمة المرور</label>
                                <span class="log-after-input"><i toggle="#password_confirmation" class="fa fa-eye toggle-password" aria-hidden="true"></i></span>

                                <div class="row position-absolute">
                                    @error('password')
                                    <span  class="text-danger MontserratArabicLightPure pr-3" style="margin-top:-20px; text-align: right">{{$message}}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>



                    </div>

                    <div class="row">
                        <button class="btn btn-yellow w-100 m-3 MontserratArabicLight">تغيير كلمة المرور  </button>
                    </div>
                </form>

            </div>
        </div>


    </div>


    <footer class="bg-dark">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 col-sm-12 d-flex">
                    <a class="navbar-brand MontserratArabic-logo text-warning pt-4 footer-logo" href="{{route('vendor.aboutDesign')}}">
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
                            <a class="text-white" href="{{route('vendor.aboutDesign')}}">الرئيسية</a>
                        </li>
                        <li class="py-2">
                            <a class="text-white" href="{{route('vendor.viewProductsDesign')}}" >التصاميم</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-2 col-sm-12">
                    <ul class="footer-col pt-4">
                        <li class="py-2">
                            <a class="text-muted" href="{{route('vendor.aboutDesign')}}">من نحن ؟</a>
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
    <script>
        $(".toggle-password").click(function () {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        $(".focus").on("focusin", function () {
            $(this).parent().find("label").addClass("active2");
            $(this).parent().find("input").addClass("active-input");
        });
        $(".focus").on("focusout", function () {
            if (!this.value) {
                $(this).parent().find("label").removeClass("active2");
                $(this).parent().find("input").removeClass("active-input");
            }
        });
    </script>
@endsection
