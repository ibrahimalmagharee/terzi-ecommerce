@extends('layouts.site')

@section('title')
    السلة
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
                        <a class="nav-link MontserratArabicLightPure"
                           href="{{route('customer.viewFabricProduct')}}">الأقمشة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link MontserratArabicLightPure"
                           href="{{route('customer.viewDesignProduct')}}">التصاميم</a>
                    </li>
                    @auth('customer')
                        <li class="nav-item pl-1" >
                            <a class="nav-link MontserratArabicLightPure "
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


    <div class="container my-5 pt-5">
        <div class="stepwizard MontserratArabicLightPure">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a hidden href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                    <div class="row">
                        <div class="col">
                            <i class="fa fa-shopping-basket fa-2x border p-3 rounded-circle color_icon_basket" id="first_step" aria-hidden="true"></i>
                        </div>
                        <div class="col">
                            <p class="text-dark">سلة المشتريات</p>
                            <small class="text-muted">الخطوة الأولى </small>
                        </div>
                    </div>
                </div>
                <div class="stepwizard-step">
                    <a hidden href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                    <div class="row">
                        <div class="col">
                            <i class="fa fa-truck fa-2x border p-3 rounded-circle" id="socend_step" aria-hidden="true"></i>
                        </div>
                        <div class="col">
                            <p class="text-dark">تفاصيل التوصيل</p>
                            <small class="text-muted">الخطوة الثانية </small>
                        </div>
                    </div>
                </div>
                <div class="stepwizard-step">
                    <a hidden href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <div class="row">
                        <div class="col">
                            <i class="fa fa-id-card-o fa-2x border p-3 rounded-circle" id="thired_step" aria-hidden="true"></i>
                        </div>
                        <div class="col">
                            <p class="text-dark">كيفية الدفع</p>
                            <small class="text-muted">الخطوة الثالثة </small>
                        </div>
                    </div>
                </div>

                <div class="stepwizard-step">
                    <a hidden href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                    <div class="row">
                        <div class="col">
                            <i class="fa fa-certificate fa-2x border p-3 rounded-circle" id="forth_step" aria-hidden="true"></i>
                        </div>
                        <div class="col">
                            <p class="text-dark">التأكيد</p>
                            <small class="text-muted">الخطوة الرابعة </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row setup-content mt-5" id="step-1">
            <div class="col-xs-12 w-100">
                <div class="col-md-12">
                    <table class="table table-borderless text-center MontserratArabicLightPure">
                        <thead>
                        <tr>
                            <th scope="col">العناصر</th>
                            <th scope="col">السعر</th>
                            <th scope="col">عدد الأمتار</th>
                            <th scope="col">الكمية</th>
                            <th scope="col">السعر الكلي</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody class="shadow">

                        @isset($designs)
                            @foreach($designs as $index=>$design)
                                <tr class="delete-product" data-id="{{$index+1}}" >
                                    <th >
                                        <img src="{{$design->getPhoto($design->images[0]->photo)}}" class="shadow" style="width: 100px; height: 100px;" alt="">
                                    </th>
                                    <td>
                                        @if($design->product->offer)
                                            <p><s>{{$design->product->price}} ريال سعودي </s></p>
                                            <p>{{$design->product->price - (($design->product->price / 100) * $design->product->offer)}} ريال سعودي </p>
                                        @else
                                            <p>{{$design->product->price}}ريال سعودي </p>
                                        @endif
                                    </td>
                                    <td></td>
                                    @foreach($basket_products as $basket_product)
                                        @foreach($products as $product)
                                            @if($basket_product->product_id == $product->id)
                                                @if($product->productable_type == 'App\Models\Design')
                                                    @if($design->id == $product->productable_id)
                                                        <td>

                                                            <select name="quantity_design" class="custom-select quantity" data-product-id="{{$design->product->id}}" data-product-price="
                                                            @if($design->product->offer)
                                                            {{$design->product->price - (($design->product->price / 100) * $design->product->offer)}}
                                                            @else
                                                            {{$design->product->price}}
                                                            @endif
                                                                ">
                                                                @php
                                                                    $counter = 1;
                                                                @endphp
                                                                @while($counter<=10)
                                                                    <option value="{{$counter}}" @if($basket_product->quantity == $counter) selected @endif>{{$counter}}</option>
                                                                    @php
                                                                        $counter += 1;
                                                                    @endphp
                                                                @endwhile
                                                            </select>
                                                        </td>

                                                        <td>
                                                            <p id="design_price_{{$index+1}}"  data-product-id="{{$design->product->id}}">
                                                                @if($design->product->offer)
                                                                    <span class="price">{{($design->product->price - (($design->product->price / 100) * $design->product->offer)) * $basket_product->quantity}}</span> ريال سعودي
                                                                @else
                                                                    <span class="price">{{$design->product->price * $basket_product->quantity}}</span> ريال سعودي
                                                                @endif

                                                            </p>
                                                        </td>
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <td>
                                        <button class="btn removeFromBasket" data-product-id="{{$design->product->id}}"><i class="fa fa-times" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endisset


                        @isset($fabrics)
                            @foreach($fabrics as $index=>$fabric)
                                <tr class="delete-product" data-fabric-id="{{$index+1}}">
                                    <th >
                                        <img src="{{$fabric->getPhoto($fabric->images[0]->photo)}}" class="shadow" style="width: 100px; height: 100px;" alt="">
                                    </th>
                                    <td>
                                        @if($fabric->product->offer)
                                            <p><s>{{$fabric->product->price}} ريال سعودي </s></p>
                                            <p>{{$fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)}} ريال سعودي </p>
                                        @else
                                            <p>{{$fabric->product->price}}ريال سعودي </p>
                                        @endif
                                    </td>
                                    @foreach($basket_products as $basket_product)
                                        @foreach($products as $product)
                                            @if($basket_product->product_id == $product->id)
                                                @if($product->productable_type == 'App\Models\Fabric')
                                                    @if($fabric->id == $product->productable_id)
                                                        <td>

                                                            <select name="number_of_meters" class="custom-select number_of_meters number_meters_{{$index+1}}" data-product-id="{{$fabric->product->id}}" data-product-price="
                                                        @if($fabric->product->offer)
                                                            {{$fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)}}
                                                            @else
                                                            {{$fabric->product->price}}
                                                            @endif
                                                                ">
                                                                <option value="">عدد الأمتار</option>

                                                                @php
                                                                    $counter = 1;
                                                                @endphp
                                                                @while($counter<=10)
                                                                    <option value="{{$counter}}" @if($basket_product->number_of_meters == $counter) selected @endif>{{$counter}}</option>
                                                                    @php
                                                                        $counter += 1;
                                                                    @endphp
                                                                @endwhile
                                                            </select>
                                                        </td>


                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach

                                    @foreach($basket_products as $basket_product)
                                        @foreach($products as $product)
                                            @if($basket_product->product_id == $product->id)
                                                @if($product->productable_type == 'App\Models\Fabric')
                                                    @if($fabric->id == $product->productable_id)
                                                        <td>

                                                            <select name="quantity_fabric" class="custom-select quantity quantity_fabric_{{$index+1}}" data-product-id="{{$fabric->product->id}}" data-product-price="
                                                        @if($fabric->product->offer)
                                                            {{$fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)}}
                                                            @else
                                                            {{$fabric->product->price}}
                                                            @endif
                                                                ">

                                                                @php
                                                                    $counter = 1;
                                                                @endphp
                                                                @while($counter<=10)
                                                                    <option value="{{$counter}}" @if($basket_product->quantity == $counter) selected @endif>{{$counter}}</option>
                                                                    @php
                                                                        $counter += 1;
                                                                    @endphp
                                                                @endwhile
                                                            </select>
                                                        </td>

                                                        <td>
                                                            <p id="fabric_price_{{$index+1}}" data-product-id="{{$fabric->product->id}}">
                                                                @if($fabric->product->offer)
                                                                    <span class="price_fabric">{{(($fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)) * $basket_product->quantity) + (($fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)) * $basket_product->number_of_meters)}}</span> ريال سعودي
                                                                @else
                                                                    <span class="price_fabric">{{($fabric->product->price * $basket_product->quantity) + ($fabric->product->price * $basket_product->number_of_meters)}}</span> ريال سعودي
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <td>
                                        <button class="btn removeFromBasket" data-product-id="{{$fabric->product->id}}"><i class="fa fa-times" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endisset

                        </tbody>
                    </table>
                    <table class="table table-borderless text-center MontserratArabicLightPure bg-dark text-white">
                        <tbody class="shadow">
                        <tr>
                            <td class="col-4" >
                                <input type="text" name="coupon_code" id="coupon_code" class="form-control bg-dark text-white " placeholder="اضف كود الخصم">
                            </td>
                            <td>
                                <p> السعر الكلي</p>
                            </td>

                            <td>
                                <p id="total_price" data-total-price="{{$total_price}}">{{$total_price}}<span id="curruncy"> ريال سعودي</span></p>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <ul class="list-inline mt-5 text-center">
                        <li>
                            <a href="{{route('index')}}" type="button" class="btn btn-warning text-white px-5 shadow rounded-0">كمل تسوقك
                            </a>
                        </li>
                        <li>
                            <button class="btn px-5  nextBtn btn-secondary shadow rounded-0" type="button" id="movebt">التوصيل</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row setup-content" id="step-2">
            <div class="col-xs-12 w-100">
                <div class="col-md-12">
                    <form id="shippingForm">
                        @csrf
                        <div class="shadow mt-5">
                        <h4 class="text-right MontserratArabicLightPure pt-5 mr-5">تفاصيل الشحن</h4>

                            <div class="row ">
                                <div class="col-lg-6 col-sm-12  pb-5 px-5">
                                    <div class="row mt-2">
                                        <div class="col-6 col-md-6 text-right mt-5">
                                            <label class=" about-text  MontserratArabicLight" for="validationCustom01">اسم صاحب
                                                البطاقة</label>
                                            <input type="text" class="form-control" name="card_name" id="card_name" required>
                                        </div>
                                        <div class="col-6 col-md-6 text-right mt-5">
                                            <label class=" about-text MontserratArabicLight" for="validationCustom01">رقم
                                                البطاقة</label>
                                            <input type="text" class="form-control" name="card_number" id="card_number" required>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-3  text-right mt-5">
                                            <label class=" about-text  MontserratArabicLight"
                                                   for="validationCustom01">الدولة</label>
                                            <select name="country" class="form-control" id="country">
                                                <option value="" disabled selected>إختر الدولة</option>
                                                <option value="السعودية">السعودية</option>
                                            </select>
                                        </div>
                                        <div class="col-3  text-right mt-5">
                                            <label class=" about-text  MontserratArabicLight"
                                                   for="validationCustom01">المدينة</label>
                                            <select name="city" class="form-control" id="city">
                                                <option value="" disabled selected>إختر المدينة</option>
                                                <option value="الرياض">الرياض</option>
                                                <option value="جدة">جدة</option>
                                                <option value="مكة المكرمة">مكة المكرمة</option>
                                                <option value="المدينة المنورة">المدينة المنورة</option>
                                                <option value="الطائف">الطائف</option>
                                                <option value="الدمام">الدمام</option>
                                                <option value="الأحمدي">الأحمدي</option>
                                                <option value="الأحساء">الأحساء</option>
                                                <option value="بريدة">بريدة</option>
                                                <option value="تبوك">تبوك</option>
                                                <option value="القطيف">القطيف</option>
                                                <option value="خميس مشيط">خميس مشيط</option>
                                                <option value="الخبر">الخبر</option>
                                                <option value="حفر الباطن">حفر الباطن</option>
                                                <option value="الجبيل">الجبيل</option>
                                                <option value="الخرج">الخرج</option>
                                                <option value="أبها">أبها</option>
                                                <option value="حائل">حائل</option>
                                                <option value="نجران">نجران</option>
                                                <option value="ينبع">ينبع</option>
                                                <option value="صبيا">صبيا</option>
                                                <option value="الدوادمي">الدوادمي</option>
                                                <option value="بيشة">بيشة</option>
                                                <option value="أبو عريش">أبو عريش</option>
                                            </select>
                                        </div>
                                        <div class="col-6 text-right mt-5">
                                            <label class=" about-text MontserratArabicLight"
                                                   for="validationCustom01">الحي</label>
                                            <input type="text" class="form-control" name="neighborhood" id="neighborhood" required>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-5 text-right mt-5">
                                            <label class=" about-text  MontserratArabicLight" for="validationCustom01">ZIP
                                                Code</label>
                                            <input type="text" class="form-control" name="zip_code" id="zip_code" required>
                                        </div>
                                        <div class="col-7  text-right mt-5">
                                            <label class=" about-text MontserratArabicLight"
                                                   for="validationCustom01">العنوان</label>
                                            <input type="text" class="form-control" name="address" id="address" required>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6 col-md-6 text-right mt-5">
                                            <label class=" about-text  MontserratArabicLight" for="validationCustom01">رقم
                                                الجوال</label>
                                            <input type="text" class="form-control" name="phone" id="phone" required>
                                        </div>
                                        <div class="col-6 col-md-6 text-right mt-5">
                                            <label class=" about-text MontserratArabicLight"
                                                   for="validationCustom01">الايميل</label>
                                            <input type="email" class="form-control" name="email" id="email" required>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-6 col-sm-12   p-5">
                                    <img src="{{asset('/public/assets/front/assets/shah.png')}}" class="w-100 .d-sm-none .d-md-block" alt="">

                                </div>
                            </div>
                        </div>
                        <ul class="list-inline mt-5 text-center">
                            <li>
                                <a href="{{route('index')}}" type="button" class="btn btn-warning text-white px-5 shadow rounded-0">كمل تسوقك
                                </a>
                            </li>
                            <li>
                                <button class="btn  px-5 nextBtn btn-secondary shadow rounded-0" type="button" id="delivery">الدفع</button>
                            </li>
                        </ul>
                    </form>




                </div>
            </div>

        </div>
        <div class="row setup-content" id="step-3">
            <div class="col-xs-12 w-100">
                <div class="col-md-12">
                    <form id="form-container">
                        <div class="row shadow mt-5">
                            <div class="col-md-5 col-sm-12">
                                <img src="{{asset('/public/assets/front/assets/Visa Card.png')}}" class="w-100" alt="">
                            </div>
                            <div class="col-md-7 col-sm-12">

                                @csrf

                                <div class='row mt-5'>
                                    <div class='col-md-12 error form-group d-none'>
                                        <div class='alert-danger alert'></div>
                                    </div>
                                </div>
                                <div id="element-container">
                                    <input type="hidden" name="price_total" value="{{$total_price}}" id="price_total">

                                    {{--                            <div class="row mt-1">--}}
                                    {{--                                <div class="col-6 col-md-6 text-right mt-4">--}}
                                    {{--                                    <label class=" about-text  MontserratArabicLight" for="validationCustom01">اسم صاحب--}}
                                    {{--                                        البطاقة</label>--}}
                                    {{--                                    <input type="text" class="form-control" name="nameCard" id="nameCard">--}}
                                    {{--                                    @error('nameCard')--}}
                                    {{--                                    <span class="text-danger">{{$message}} </span>--}}
                                    {{--                                    @enderror--}}
                                    {{--                                </div>--}}
                                    {{--                                <div class="col-6 col-md-6 text-right mt-4">--}}
                                    {{--                                    <label class=" about-text MontserratArabicLight" for="validationCustom01">رقم--}}
                                    {{--                                        البطاقة</label>--}}
                                    {{--                                    <input type="text" class="form-control" name="numberCard" id="numberCard">--}}
                                    {{--                                    @error('number')--}}
                                    {{--                                    <span class="text-danger">{{$message}} </span>--}}
                                    {{--                                    @enderror--}}
                                    {{--                                </div>--}}
                                    {{--                            </div>--}}
                                    {{--                            <div class="row mt-2">--}}
                                    {{--                                <div class="col-6 col-md-6 text-right">--}}
                                    {{--                                    <div class="row pr-3">--}}
                                    {{--                                        <label class=" about-text 2 MontserratArabicLight" for="validationCustom01">Expire--}}
                                    {{--                                            Date</label>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="row pr-3">--}}
                                    {{--                                        <select class="custom-select col-5 ml-3" id="mm" name="mm">--}}
                                    {{--                                            <option value="-1" selected>MM</option>--}}
                                    {{--                                            @php--}}
                                    {{--                                                $counter = 1;--}}
                                    {{--                                            @endphp--}}
                                    {{--                                            @while($counter<=31)--}}
                                    {{--                                                <option value="{{$counter}}">{{$counter}}</option>--}}
                                    {{--                                                @php--}}
                                    {{--                                                    $counter += 1;--}}
                                    {{--                                                @endphp--}}
                                    {{--                                            @endwhile--}}
                                    {{--                                        </select>--}}
                                    {{--                                        <select class="custom-select col-5 mr-4" id="yy" name="yy">--}}
                                    {{--                                            <option value="-1" selected>YY</option>--}}
                                    {{--                                            @php--}}
                                    {{--                                                $years = [21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40];--}}
                                    {{--                                            @endphp--}}
                                    {{--                                            @foreach($years as $year)--}}
                                    {{--                                                <option value="{{$year}}">{{$year}}</option>--}}
                                    {{--                                            @endforeach--}}
                                    {{--                                        </select>--}}
                                    {{--                                    </div>--}}

                                    {{--                                </div>--}}
                                    {{--                                <div class="col-3 col-md-3 text-right">--}}
                                    {{--                                    <label class=" about-text MontserratArabicLight"--}}
                                    {{--                                           for="validationCustom01">CCV</label>--}}
                                    {{--                                    <input type="text" class="form-control" name="cvv" id="cvv">--}}
                                    {{--                                </div>--}}

                                    {{--                            </div>--}}
                                </div>
                                <div id="error-handler" role="alert"></div>
                                {{--                        <div id="success" style=" display: none;;position: relative;float: left;">--}}
                                {{--                            Success! Your token is <span id="token"></span>--}}
                                {{--                        </div>--}}




                            </div>
                        </div>
                        <ul class="list-inline mt-5 text-center">
                            <li><a href="{{route('index')}}" type="button" class="btn btn-warning text-white px-5 shadow rounded-0">كمل تسوقك</a></li>
                            <li>
                                <button class="btn  nextBtn btn-secondary px-5 shadow rounded-0"  id="tap-btn">تأكيد</button>
                            </li>
                        </ul>

                    </form>

                </div>
            </div>
        </div>
        <div class="row setup-content" id="step-4">
            <div class="col-xs-12 w-100">
                <div class="col-md-12">

                    <div class="shadow mt-5">
                        <img src="{{asset('/public/assets/front/assets/congrats.png')}}" class="w-100" alt="">
                        <h3 class="tax" style="  position: absolute !important; -webkit-transform: translate(-217%, -224%) !important; transform: translate(-217%, -224%) !important; color: white !important;">نسبة الضريبة :15٪</h3>
                    </div>
                    <div class="row justify-content-end mt-4">
                        <a href="{{route('index')}}" class="MontserratArabicLight text-decoration-none text-danger">
                            تراجع
                        </a>
                    </div>
                    <!-- <button class="btn btn-success btn-lg pull-right" type="submit">Finish!</button> -->
                </div>
            </div>
        </div>

    </div>

    @include('site.customer.footer')
@endsection




@section('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.4/bluebird.min.js"></script>
    <script src="https://secure.gosell.io/js/sdk/tap.min.js"></script>
{{--    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>--}}
    <script>

        $(document).ready(function () {

            $('#movebt').click(function (e) {
                $('#first_step').removeClass('color_icon_basket');
                $('#socend_step').addClass('color_icon_basket');
            });

            $('#delivery').click(function (e) {
                $('#socend_step').removeClass('color_icon_basket');
                $('#thired_step').addClass('color_icon_basket');
            });


                var isValid = true;
                var allowedMove = false;

                var navListItems = $('div.setup-panel div a'),
                    allWells = $('.setup-content'),
                    allNextBtn = $('.nextBtn');
                allWells.hide();
                navListItems.click(function (e) {
                    e.preventDefault();
                    var $target = $($(this).attr('href')),
                        $item = $(this);

                    if (!$item.hasClass('disabled')) {
                        navListItems.removeClass('btn-primary').addClass('btn-default');
                        $item.addClass('btn-primary');
                        allWells.hide();
                        $target.show();
                        $target.find('input:eq(0)').focus();
                    }
                });

            $('div.setup-panel div a.btn-primary').trigger('click');

                $('#movebt').click( function () {
                    var curStep = $(this).closest(".setup-content"),
                        curStepBtn = curStep.attr("id"),
                        nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a");

                    if (isValid) {
                        nextStepWizard.removeAttr('disabled').trigger('click');
                    }
                });

            $('#delivery').click( function () {
                var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a");

                if (isValid) {
                    nextStepWizard.removeAttr('disabled').trigger('click');
                }
            });

                $('#payment').click( function () {
                    var curStep = $(this).closest(".setup-content"),
                        curStepBtn = curStep.attr("id"),
                        nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a");


                    if (isValid && allowedMove) {
                        nextStepWizard.removeAttr('disabled').trigger('click');
                    }
                });



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.is_sure', function (e) {
                e.preventDefault();
                let status = $(this).attr('data-status');
                let product_id = $(this).attr('data-product-id');
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: '{{ route('update.status') }}',
                    data: {'status': status, 'product_id': product_id},
                    success: function (data) {
                        toastr.success(data.msg);
                    }
                });
            });


            function totalPrice(){
                let total = 0;
                $('.price').each( function () {
                    total+= parseInt($(this).html())
                });
                $('#total_price').html(total + ' ريال سعودي ');
            }
            $(document).on('change', '.number_of_meters', function(e){
                e.preventDefault();
                let product_id = $(this).attr('data-product-id');
                let number_of_meters = $(this).val();
                let fabric_price_id = $(this).closest('tr').attr('data-fabric-id');
                let fabric_price = $(this).attr('data-product-price');
                let quantity = $('.quantity_fabric_'+fabric_price_id).val();
                $('#fabric_price_'+fabric_price_id).html((fabric_price *  number_of_meters) + (fabric_price *  quantity) + ' ريال سعودي ');
                // $('#price_total').val(data.total_price);
                console.log(quantity)

               // totalPrice();

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: '{{ route('Product.update.meters') }}',
                    data: {'number_of_meters': number_of_meters, 'product_id': product_id},
                    success: function (data) {
                        toastr.success(data.msg);
                        $('#total_price').html(data.total_price + ' ريال سعودي ');
                        $('#price_total').val(data.total_price);
                        $('#total_price').attr('data-total-price', data.total_price);
                    },

                    error: function () {
                        toastr.error('لم يتم اختيار عدد امتار القماش ');
                    }
                });
            });

            $(document).on('change', '.quantity', function(e){
                e.preventDefault();
                let product_id = $(this).attr('data-product-id');
                let quantity = $(this).val();
                let design_price_id = $(this).closest('tr').data('id');
                let fabric_price_id = $(this).closest('tr').attr('data-fabric-id');
                let design_price = $(this).attr('data-product-price');
                let fabric_price = $(this).attr('data-product-price');
                let number_of_meters_of_product = $('.number_meters_'+fabric_price_id).val();
                $('#design_price_'+design_price_id).html(design_price *  quantity + ' ريال سعودي ');
                // $('#fabric_price').html(data.fabric_price + ' ريال سعودي ');
                $('#fabric_price_'+fabric_price_id).html((fabric_price *  number_of_meters_of_product) + (fabric_price *  quantity) + ' ريال سعودي ');
                // $('#price_total').val(data.total_price);

               // console.log(number_of_meters_of_product);

                // totalPrice();

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: '{{ route('Product.update.quantity') }}',
                    data: {'quantity': quantity, 'product_id': product_id},
                    success: function (data) {
                        toastr.success(data.msg);
                        $('#total_price').html(data.total_price + ' ريال سعودي ');
                        $('#price_total').val(data.total_price);
                        $('#total_price').attr('data-total-price', data.total_price);
                    },

                    error: function () {
                        toastr.error('لم تتم تحديث كمية المنتج');
                    }
                });
            });

            $(document).on('change', '#coupon_code', function(e){
                e.preventDefault();
                let coupon_code = $(this).val();
                let total_price = $('#total_price').attr('data-total-price');
               // console.log(total_price)

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: '{{ route('Product.checkCoupon') }}',
                    data: {'coupon_code': coupon_code, 'total_price': total_price},
                    success: function (data) {
                        if (data.status == true){
                            toastr.success(data.msg);
                            $('#total_price').html(data.total_price + ' ريال سعودي ');
                            $('#price_total').val(data.total_price);
                            $('#total_price').attr('data-total-price', data.total_price);
                        }
                        if(data.status == 'expired') {
                            toastr.warning(data.msg);
                        }
                        if(data.status == false) {
                            toastr.error(data.msg);
                        }

                    },
                });
            });

            $(document).on('click', '.removeFromBasket', function (e) {
                e.preventDefault();

                var Clickedthis = $(this);
                var product_id = $(Clickedthis).closest('.delete-product').attr('data-product-id');

                @guest('customer')
                toastr.warning('انت غير مسجل دخول في النظام')
                @endguest

                $.ajax({
                    type: 'delete',
                    url: "{{Route('Product.destroy')}}",
                    data: {
                        'product_id': $(this).attr('data-product-id'),
                    },
                    success: function (data) {
                        $(Clickedthis).closest('.delete-product').remove();
                        toastr.success(data.msg);
                        $('#total_price').html(data.total_price + ' ريال سعودي ');
                        $('#price_total').val(data.total_price);
                    }
                });
            });

            $(document).on('click', '#delivery', function (e) {
                e.preventDefault();
                var card_name  = $('#card_name').val();
                var card_number  = $('#card_number').val();
                var country  = $('#country').val();
                var city  = $('#city').val();
                var neighborhood  = $('#neighborhood').val();
                var zip_code  = $('#zip_code').val();
                var address  = $('#address').val();
                var phone  = $('#phone').val();
                var email  = $('#email').val();
                var formData = new FormData($('#shippingForm')[0]);

                $.ajax({
                    type: 'post',
                    url: "{{Route('customer.shipping')}}",
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',
                    success: function (data) {
                        toastr.success(data.msg);

                    }
                });
            });


            $(function () {
                var tap = Tapjsli('pk_live_HoqNMSrC71LDphAJ24yPxjEc');

                var elements = tap.elements({});

                var style = {
                    base: {
                        color: '#535353',
                        lineHeight: '18px',
                        fontFamily: 'sans-serif',
                        fontSmoothing: 'antialiased',
                        fontSize: '16px',
                        '::placeholder': {
                            color: 'rgba(0, 0, 0, 0.26)',
                            fontSize:'15px'
                        }
                    },
                    invalid: {
                        color: 'red'
                    }
                };
// input labels/placeholders
                var labels = {
                    cardHolder:"اسم صاحب البطاقة",
                    cardNumber:"رقم البطاقة",
                    expirationDate:"MM/YY",
                    cvv:"CVV",

                };
//payment options
                var paymentOptions = {
                    currencyCode:["KWD","USD","SAR"],
                    labels : labels,
                    TextDirection:'rtl'
                }
//create element, pass style and payment options
                var card = elements.create('card', {style: style},paymentOptions);
//mount element
                card.mount('#element-container');
//card change event listener

                card.addEventListener('change', function(event) {
                    if(event.loaded){
                        console.log("UI loaded :"+event.loaded);
                        console.log("current currency is :"+card.getCurrency())
                    }
                    var displayError = document.getElementById('error-handler');
                    if (event.error) {
                        displayError.textContent = event.error.message;
                    } else {
                        displayError.textContent = '';
                    }
                });


                var form = document.getElementById('form-container');
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    console.log($('#price_total').val());
                    tap.createToken(card).then(function(result) {
                        if (result.error) {
                            // Inform the user if there was an error
                            var errorElement = document.getElementById('error-handler');
                            errorElement.textContent = result.error.message;
                        } else {
                            // Send the token to your server
                            // var errorElement = document.getElementById('success');
                            // errorElement.style.display = "block";
                            // var tokenElement = document.getElementById('token');
                            // tokenElement.textContent = result.id;
                            // console.log(result.id);
                            tapTokenHandler(result.id)


                        }
                    });
                });

                function tapTokenHandler(token) {

                    // Insert the token ID into the form so it gets submitted to the server
                    var form = document.getElementById('form-container');
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'tapToken');
                    hiddenInput.setAttribute('value', token);
                    form.appendChild(hiddenInput);
                    console.log(token);

                    // Submit the form
                    // form.submit();

                    $.ajax({
                        type: 'POST',
                        url: '{{route('customer.payment')}}',
                        headers: {
                            Authorization: 'Bearer {{env('TAP_SK')}}',
                            //'content-type': 'application/json'
                        },
                        data: {
                            'amount': parseInt($('#price_total').val()),
                            'token': token,
                        },
                        success: (response) => {
                            if (response.status == true){
                                allowedMove = true;
                                toastr.success(response.msg);
                                $('#thired_step').removeClass('color_icon_basket');
                                $('#forth_step').addClass('color_icon_basket');
                                var nextStepWizard = $('div.setup-panel div a[href="#step-3"]').parent().next().children("a");

                                if (isValid && allowedMove) {
                                    nextStepWizard.removeAttr('disabled').trigger('click');
                                }



                            }


                        },
                        error: (response) => {
                            toastr.error('error');
                            console.log('error payment: ', response);
                        }
                    })


                }

                card.addEventListener('change', function(event) {
                    if(event.BIN){
                        console.log(event.BIN)
                    }
                    var displayError = document.getElementById('card-errors');
                    if (event.error) {
                        displayError.textContent = event.error.message;
                    } else {
                        displayError.textContent = 'no error';
                    }
                });
            })



            {{--$(function() {--}}

            {{--    var $form = $(".require-validation");--}}
            {{--    $('form.require-validation').bind('submit', function(e) {--}}
            {{--        var $form         = $(".require-validation"),--}}
            {{--             inputSelector = ['input[type=email]', 'input[type=password]',--}}
            {{--                 'input[type=text]', 'input[type=file]',--}}
            {{--                 'textarea'].join(', '),--}}
            {{--            $inputs       = $form.find('.required').find(inputSelector),--}}
            {{--            $errorMessage = $form.find('div.error'),--}}
            {{--            valid         = true;--}}
            {{--        $errorMessage.addClass('d-none');--}}

            {{--        $('.has-error').removeClass('has-error');--}}
            {{--        $inputs.each(function(i, el) {--}}
            {{--            var $input = $(el);--}}
            {{--            if ($input.val() === '') {--}}
            {{--                $input.parent().addClass('has-error');--}}
            {{--                $errorMessage.addClass('d-none');--}}
            {{--                e.preventDefault();--}}
            {{--            }--}}
            {{--        });--}}

            {{--        if (!$form.data('cc-on-file')) {--}}
            {{--            e.preventDefault();--}}
            {{--            Stripe.setPublishableKey($form.data('stripe-publishable-key'));--}}
            {{--            Stripe.createToken({--}}
            {{--                number: $('#numberCard').val(),--}}
            {{--                cvc: $('#cvv').val(),--}}
            {{--                exp_month: $('#mm').val(),--}}
            {{--                exp_year: $('#yy').val(),--}}
            {{--            }, stripeResponseHandler);--}}
            {{--        }--}}

            {{--    });--}}

            {{--    function stripeResponseHandler(status, response) {--}}
            {{--        if (response.error) {--}}
            {{--            $('.error')--}}
            {{--                .removeClass('d-none')--}}
            {{--                .find('.alert')--}}
            {{--                .text(response.error.message);--}}
            {{--        } else {--}}
            {{--            /* token contains id, last4, and card type */--}}
            {{--            var token = response['id'];--}}

            {{--            $form.find('input[type=text]').empty();--}}
            {{--            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");--}}

            {{--            console.log(token);--}}
            {{--            //$form.get(0).submit();--}}
            {{--            $.ajax({--}}
            {{--                type: 'POST',--}}
            {{--                url: '{{route('customer.payment')}}',--}}
            {{--                headers: {--}}
            {{--                    Authorization: 'Bearer {{env('STRIPE_SECRET')}}'--}}
            {{--                },--}}
            {{--                data: {--}}
            {{--                    amount: parseInt($('#price_total').val()),--}}
            {{--                    currency: 'usd',--}}
            {{--                    source: token,--}}
            {{--                    description: "Charge for madison.garcia@example.com",--}}
            {{--                },--}}
            {{--                success: (response) => {--}}
            {{--                   if (response.status == true){--}}
            {{--                       allowedMove = true;--}}
            {{--                       toastr.success(response.msg);--}}
            {{--                       var nextStepWizard = $('div.setup-panel div a[href="#step-3"]').parent().next().children("a");--}}

            {{--                       if (isValid && allowedMove) {--}}
            {{--                           nextStepWizard.removeAttr('disabled').trigger('click');--}}
            {{--                       }--}}



            {{--                    }--}}


            {{--                },--}}
            {{--                error: (response) => {--}}
            {{--                    toastr.error('error');--}}
            {{--                    console.log('error payment: ', response);--}}
            {{--                }--}}
            {{--            })--}}
            {{--        }--}}
            {{--    }--}}




            {{--});--}}



        });



    </script>

{{--    <script>--}}
{{--        $(document).ready(function () {--}}

{{--            --}}{{--$(document).on('click', '#payment', function (e) {--}}
{{--            --}}{{--    e.preventDefault();--}}
{{--            --}}{{--    var form = new FormData();--}}
{{--            --}}{{--    var nameCard = $('#nameCard').val();--}}
{{--            --}}{{--    var numberCard = $('#numberCard').val();--}}
{{--            --}}{{--    var mm = $('#mm').val();--}}
{{--            --}}{{--    var yy = $('#yy').val();--}}
{{--            --}}{{--    var cvv = $('#cvv').val();--}}
{{--            --}}{{--    var price_total = $('#price_total').val();--}}

{{--            --}}{{--    form.append('nameCard', nameCard);--}}
{{--            --}}{{--    form.append('numberCard', numberCard);--}}
{{--            --}}{{--    form.append('mm', mm);--}}
{{--            --}}{{--    form.append('yy', yy);--}}
{{--            --}}{{--    form.append('cvv', cvv);--}}
{{--            --}}{{--    form.append('price_total', price_total);--}}
{{--            --}}{{--    window.onload = function () {--}}

{{--            --}}{{--        var stripe = Stripe("pk_test_51J5GpSFtIeBLnPqTp2suoBs3DiNWy3XrWKM4cDS4obJ1QIXGtAYhYi7mABviGKYM2ZBTzsrZiSI5ejxxdkFqcGcp00Z9yjXp85");--}}
{{--            --}}{{--        var elements = stripe.elements();--}}

{{--            --}}{{--        form.addEventListener('submit', function (event) {--}}
{{--            --}}{{--            event.preventDefault();--}}

{{--            --}}{{--            stripe.createToken({--}}
{{--            --}}{{--                numberCard: $('#numberCard').val(),--}}
{{--            --}}{{--                mm: $('#mm').val(),--}}
{{--            --}}{{--                yy: $('#yy').val(),--}}
{{--            --}}{{--                cvv: $('#cvv').val(),--}}
{{--            --}}{{--                price_total: $('#price_total').val(),--}}
{{--            --}}{{--            }).then(function (result) {--}}
{{--            --}}{{--                if (result.error) {--}}
{{--            --}}{{--                    var errorElement = document.getElementById('card-errors');--}}
{{--            --}}{{--                    errorElement.textContent = result.error.message;--}}
{{--            --}}{{--                } else {--}}
{{--            --}}{{--                    // Send the token to your server.--}}
{{--            --}}{{--                    stripeTokenHandler(result.token);--}}
{{--            --}}{{--                }--}}
{{--            --}}{{--            });--}}
{{--            --}}{{--        });--}}

{{--            --}}{{--        function stripeTokenHandler(token) {--}}
{{--            --}}{{--            // Insert the token ID into the form so it gets submitted to the server--}}
{{--            --}}{{--            var hiddenInput = document.createElement('input');--}}
{{--            --}}{{--            hiddenInput.setAttribute('type', 'hidden');--}}
{{--            --}}{{--            hiddenInput.setAttribute('name', 'stripeToken');--}}
{{--            --}}{{--            hiddenInput.setAttribute('value', token.id);--}}
{{--            --}}{{--            form.appendChild(hiddenInput);--}}

{{--            --}}{{--            // Submit the form--}}
{{--            --}}{{--            form.submit();--}}
{{--            --}}{{--        }--}}
{{--            --}}{{--    }--}}


{{--            --}}{{--        $.ajax({--}}
{{--            --}}{{--            type: "POST",--}}
{{--            --}}{{--            url: '{{ route('customer.payment') }}',--}}
{{--            --}}{{--            data: form,--}}
{{--            --}}{{--            processData: false,--}}
{{--            --}}{{--            contentType: false,--}}
{{--            --}}{{--            success: function (data) {--}}
{{--            --}}{{--                // console.log(data);--}}
{{--            --}}{{--                toastr.success(data.msg);--}}
{{--            --}}{{--            }--}}
{{--            --}}{{--        });--}}
{{--        });--}}


{{--    </script>--}}


@endsection
