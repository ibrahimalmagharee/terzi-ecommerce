@extends('layouts.site')

@section('title')
    تعديل منتج | تفصيل
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


    <div class="container my-5">
        <div class="row ">
            <div class="col text-right d-flex p-0">
                <h4  class="pr-2 border-3 section-title" >تعديل منتج - {{$design->name}} </h4>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-md-6 col-sm-12">
                <form action="{{route('vendor.updateProductDesign', $design->id)}}" method="POST" class="needs-validation pr-1" novalidate enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{$design->id}}">
                    <input type="hidden" name="vendor_id" value="{{$design->product->vendor_id}}">
                    <div class="form-row my-2">
                        <label class=" about-text MontserratArabicLight" for="validationCustom01">اسم المنتج</label>
                        <input type="text" name="name" value="{{$design->name}}" class="form-control" id="validationCustom01">

                        @error('name')
                        <span id="photo_error" class="text-danger">{{$message}} </span>
                        @enderror
                    </div>
                    <div class="form-row my-2">
                        <div class="col-md-6 p-0">
                            <label class="float-right about-text MontserratArabicLight" for="validationCustom01">نوعه</label>
                            <select name="type_id" id="exampleFormControlSelect1" class="form-control">
                                <optgroup label="الرجاء اختر نوع الملابس">
                                    @isset($data['types'])
                                        @foreach($data['types'] as $type)
                                            <option value="{{$type->id}}" @if($design->type_id == $type->id) selected @endif>{{$type->name}}</option>
                                        @endforeach
                                    @endisset
                                </optgroup>
                            </select>
                            @error('type_id')
                            <span id="type_id" class="text-danger">{{$message}} </span>
                            @enderror
                        </div>
                        <div class="col-md-6 pl-0">
                            <label class="float-right about-text MontserratArabicLight" for="validationCustom01">القسم</label>
                            <select name="category_id" id="exampleFormControlSelect1" class="form-control">
                                <optgroup label="الرجاء اختر القسم">
                                    @isset($data['categories'] )
                                        @foreach($data['categories'] as $category)

                                            <option value="{{$category->id}}" @if($design->product->category_id == $category->id) selected @endif>{{$category->name}}</option>

                                        @endforeach
                                    @endisset
                                </optgroup>
                            </select>
                            @error('category_id')
                            <span id="category_id" class="text-danger">{{$message}} </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row my-2">
                        <label class="about-text MontserratArabicLight" for="validationCustom01">وصف المنتج</label>
                        <textarea name="description" class="form-control" id="validationCustom01" rows="5">{{$design->description}}</textarea>
                        @error('description')
                        <span id="description" class="text-danger">{{$message}} </span>
                        @enderror
                    </div>
                    <div class="form-row">
                        <label class=" about-text MontserratArabicLight" for="validationCustom01">  اضف صورة  <span class="text-danger">( يجب أن تكون عرض الصورة 322px و طول الصورة 280px )</span></label>
                    </div>
                    <div class="form-row my-2">
                        <div class="col-md-12 p-0 d-flex h-25">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="images[]" multiple>
                                <label class="custom-file-label" for="customFile"> ملفات الجهاز</label>
                            </div>
{{--                            <label for="file-upload" class="custom-file-upload">--}}
{{--                                ملفات الجهاز--}}
{{--                            </label>--}}
{{--                            <input id="file-upload" type="file" name="images[]" multiple>--}}
                            @error('images')
                            <span id="photo" class="text-danger">{{$message}} </span>
                            @enderror
                        </div>

                        <div class="col-md-6 pl-0 d-flex">
                            @foreach($design->images as $image)
                                <img src="{{$image->getPhotoDesign($image->photo)}}" style="width: 150px;height: 150px" alt="photo"
                                     class="height-150 p-2">
                            @endforeach
                        </div>

                    </div>

                    <div class="form-row my-2">
                        <div class="col-md-6 p-0">
                            <label class="float-right about-text MontserratArabicLight" for="validationCustom01">السعر</label>
                            <input type="number" step="any" name="price" value="{{$design->product->price}}" class="form-control" id="validationCustom01">
                            @error('price')
                            <span id="price" class="text-danger float-right">{{$message}} </span>
                            @enderror
                        </div>
                        <div class="col-md-6 pl-0">
                            <label class="float-right about-text MontserratArabicLight" for="validationCustom01">عروض</label>
                            <input type="text" name="offer" value="{{$design->product->offer}}" class="form-control" id="offer">
                            @error('offer')
                            <span id="offer" class="text-danger">{{$message}} </span>
                            @enderror
                        </div>
                    </div>

                    <button class="btn btn-yellow about-text float-left mt-5 px-5 MontserratArabicLight" style="width: 265px;" type="submit">تعديل المنتج</button>
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
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
        });
    </script>
@endsection
