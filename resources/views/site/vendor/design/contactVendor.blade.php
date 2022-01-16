@extends('layouts.site')

@section('title')
    تواصل معنا
    @endsection
@section('content')
    <header  class="bg-dark ">
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent container pt-2">
            <a class="navbar-brand MontserratArabic-logo text-warning" href="{{route('vendor.aboutDesign')}}">
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
                        <a class="nav-link MontserratArabicLightPure" href="{{route('vendor.aboutDesign')}}"
                        >الرئيسية<span class="sr-only">(current)</span></a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link MontserratArabicLightPure" href="{{route('vendor.addProductDesign')}}">إضافة منتج</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link MontserratArabicLightPure" href="{{route('vendor.viewProductsDesign')}}">المنتجات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link MontserratArabicLightPure" href="{{route('vendor.purseDesign')}}"
                        >المحفظة
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('vendor.getSearchPageDesign')}}"
                        ><i class="fa fa-search" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link MontserratArabicLightPure text-warning" href="{{route('vendor.contactUsDesign')}}">اتصل بنا</a>
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
                            <a class="dropdown-item" href="{{route('vendor.profileDesign')}}">الملف الشخصي</a>
                            <a class="dropdown-item" href="{{route('vendor.changePasswordDesign')}}">تغيير كلمة المرور</a>
                            <a class="dropdown-item" href="{{route('vendor.logout')}}">تسجيل الخروج</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>


    <div class="container">
        <div class="row my-5">
            <div class="col text-right">
                <small class="MontserratArabicLight pr-5">+966 2525 252 </small>
            </div>
            <div class="col">
                <small class="MontserratArabicLight pl-5">info.tafselk@gmail.com </small>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-md-6 col-sm-12 text-right">
                <p class="MontserratArabicLight">كيف يمكننا مساعدتك</p>
                <form method="post" action="{{route('vendor.saveContactUsDesign')}}" class="pr-1">
                    @csrf
                    <input type="hidden" name="vendor_id" value="{{$vendor->id}}">

                    <div class="form-row">
                        <label class=" about-text MontserratArabicLight">البريد الالكتروني</label>
                        <input type="email" name="email" value="{{old('email')}}" class="form-control" id="validationCustom01">
                        @error('email')
                        <span id="email" class="text-danger float-right">{{$message}} </span>
                        @enderror
                    </div>
                    <div class="form-row">
                        <label class=" about-text MontserratArabicLight" for="validationCustom01">رقم الهاتف</label>
                        <input type="text" name="phone_number" value="{{old('phone_number')}}"  class="form-control" id="validationCustom01">
                        @error('phone_number')
                        <span id="phone_number" class="text-danger float-right">{{$message}} </span>
                        @enderror

                    </div>
                    <div class="form-row">
                        <label class=" about-text MontserratArabicLight" for="validationCustom01">عنوان الطلب</label>
                        <input type="text" name="address_request" value="{{old('address_request')}}"  class="form-control" id="validationCustom01">
                        @error('address_request')
                        <span id="address_request" class="text-danger float-right">{{$message}} </span>
                        @enderror
                    </div>
                    <div class="form-row">
                        <label class=" about-text MontserratArabicLight" for="validationCustom01">الرسالة</label>
                        <textarea class="form-control" name="message" id="validationCustom01" rows="5">{{old('message')}}</textarea>
                        @error('message')
                        <span id="message" class="text-danger float-right">{{$message}} </span>
                        @enderror
                    </div>

                    <button class="btn btn-warning text-white about-text float-left mt-5 px-5 MontserratArabicLight" type="submit">ارسل</button>
                </form>
            </div>
            <div class="col-md-6 col-sm-12"></div>
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

@section('script')
@endsection
