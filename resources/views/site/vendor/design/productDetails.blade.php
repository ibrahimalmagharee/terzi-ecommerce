@extends('layouts.site')

@section('title')
    تفصيل منتج
@endsection
@section('content')
@endsection
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
                    <a class="nav-link MontserratArabicLightPure text-warning" href="{{route('vendor.addProductDesign')}}">إضافة منتج</a>
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
                    <a class="nav-link MontserratArabicLightPure" href="{{route('vendor.contactUsDesign')}}">اتصل بنا</a>
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

<section class="container my-5">
    <div class="row">
        <div class="col-lg-5 col-sm-12">
            <img src="{{$design->getPhoto($design->images[0]->photo)}}" id="expandedImg" style="height: 443px;" class="w-100" alt="">
        </div>
        <div class="col-lg-7 col-sm-12 text-right MontserratArabicLightPure">
            <small>قسم - {{$design->product->category->name}}</small>
            <div class="row my-3">
                <div class="col text-right">
                    <h3>{{$design->name}}</h3>
                </div>
                <div class="col text-left">
                    @if($design->product->offer)
                        <h3><s>{{$design->product->price}} ر.س</s></h3>
                        <h3>{{$design->product->price - (($design->product->price / 100) * $design->product->offer)}} ر.س </h3>
                    @else
                        <h3>{{$design->product->price}} ر.س</h3>
                    @endif


                </div>
            </div>
            <div class="row mt-5">
                <div class="col-8 d-flex">
                    @foreach($design->images as $image)
                        <div class="float-left rounded">
                            <img src="{{$image->getPhotoDesign($image->photo)}}" onclick="myFunction(this);" style="width:70px; height: 70px;" alt="">
                        </div>
                        @endforeach


                </div>
                <div class="col">
                    <div class="coupon p-3 float-left rounded">
                        <strong>{{$design->product->offer == '' ? 'لايوجد عرض' : $design->product->offer}} @if($design->product->offer != '') % @endif</strong>
                    </div>
                </div>
            </div>
            <h5 class="mt-4">تفاصيل المنتج</h5>
            <p>{{$design->description}}</p>


        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col border-bottom border-warning"></div>
        <div class="col"></div>
    </div>
</div>




<section class="container mt-5 mb-5">
    <div class="container pb-3 my-5">
        <div class="row pt-4 ">
            <div class="col text-right d-flex p-0">
                <h4  class="pr-2 border-3 section-title" >منتجات ذات صلة</h4>
            </div>
        </div>
    </div>
    <div class="row mt-5 p-2">
        @isset($designs_related)
            @foreach($designs_related as $design_related)
                <div class="col-md-4 col-sm-12 pr-0 pl-5 col-resp  my-2">
                    <div class="card border-0 shadow-cust rounded-cust card-resp" style="width: 100%;">
                        <a href="{{route('customer.viewDesignProductDetails',$design_related->id)}}">
                            <img src="{{$design_related->getPhoto($design_related->images[0]->photo)}}" class="card-img-top"
                                 style="width: 100%; height:280px">
                        </a>
                        <div class="card-body text-center">
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <h5 class="card-text">{{$design_related->name}}</h5>
                                @if($design_related->product->offer)
                                    <p class="card-text text-danger"><s>{{$design_related->product->price}} ر.س</s></p>
                                    <p class="card-text text-danger">{{$design_related->product->price - (($design_related->product->price / 100) * $design_related->product->offer)}} ر.س </p>
                                @else
                                    <p class="card-text text-danger">{{$design_related->product->price}} ر.س</p>
                                @endif

                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                    <p class="card-text">{{$design_related->product->sales}} مبيعات</p>
                                    <a href="{{route('vendor.editProductDesign',$design_related->id)}}" class="btn btn-dark px-5 MontserratArabicLightPure editProduct">تعديل</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endisset

    </div>
</section>


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



@section('script')

    <script>

        function myFunction(imgs) {
            var expandImg = document.getElementById("expandedImg");
            expandImg.src = imgs.src;
        }
    </script>

@endsection
