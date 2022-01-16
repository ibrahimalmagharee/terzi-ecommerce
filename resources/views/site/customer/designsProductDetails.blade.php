@extends('layouts.site')

@section('title')
    تفصيل منتج تفصيل
@endsection
@section('content')
@endsection
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
            <small>{{$design->product->vendor->name}}</small>
            <div class="row mt-4">
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
            <h5 class="mt-3">تفاصيل المنتج</h5>
            <p>{{$design->description}}</p>

            <div class="row">
                <div class="product-quantity">
                    <div class="quantity-selectors-container">
                        <div class="quantity-selectors ">
                            <button type="button" class="increment-quantity" aria-label="Add one" data-direction="1"><span style="position: relative; bottom: 5px " class="overflow-hidden">&#43;</span></button>
                            <button type="button" class="decrement-quantity" aria-label="Subtract one" data-direction="-1" disabled="disabled"><span style="position: relative; bottom: 5px " class="overflow-hidden">&#8722;</span></button>
                        </div>
                    </div>
                    <input class="rounded input-qunt border-none" data-min="1" data-max="0" type="text" name="quantity" value="1" readonly="true">
                </div>
                <button type="submit" title="أضف الى السلة" class="action btn btn-danger mr-3 col-5 addProductToBasket"  data-product-id="{{$design->product->id}}" style="width: 180px;">
                    أضف الى السلة
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </button>

                <button class="btn text-danger bg-white shadow-cust mr-3 addToWishlist" data-product-id="{{$design->product->id}}">
                    <i class="fa fa-heart" aria-hidden="true"></i>
                </button>

            </div>
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
                                <p class="card-text">{{$design_related->product->vendor->name}}</p>
                                <div class="row">
                                    <button class="btn text-danger bg-white shadow-cust addToWishlist" data-product-id="{{$design_related->product->id}}">
                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn text-danger bg-white shadow-cust mr-2 addProductToBasket"  data-product-id="{{$design_related->product->id}}">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endisset

    </div>
</section>


@include('site.customer.footer')



@section('script')

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click', '.addToWishlist', function (e) {
                e.preventDefault();
                @guest('customer')
                toastr.warning('انت غير مسجل دخول في النظام')
                @endguest

                $.ajax({
                    type: 'post',
                    url: "{{ route('customer.saveProductWishlist') }}",
                    enctype: 'multipart/form-data',
                    data: {'product_id' : $(this).attr('data-product-id')},
                    dataType: 'json',

                    success: function (data) {
                        if (data.wished == true) {
                            toastr.success(data.msg);
                        } else {
                            toastr.info(data.msg);
                        }
                    },
                });
            });

            $(document).on('click', '.addProductToBasket', function (e) {
                e.preventDefault();
                @guest('customer')
                toastr.warning('انت غير مسجل دخول في النظام')
                @endguest
                console.log($('input[name="quantity"]').val());

                $.ajax({
                    type: 'post',
                    url: "{{ route('customer.saveProductBasket') }}",
                    enctype: 'multipart/form-data',
                    data: {'product_id' : $(this).attr('data-product-id'),
                            'quantity' : $('input[name="quantity"]').val()


                    },
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true) {
                            toastr.success(data.msg);
                            $('.cart-products-count').html(data.cart_products_count)
                        } else {
                            toastr.info(data.msg);
                        }
                    },
                });
            });
        });
    </script>

    <script>

        function myFunction(imgs) {
            var expandImg = document.getElementById("expandedImg");
            expandImg.src = imgs.src;
        }
        $(".increment-quantity,.decrement-quantity").on("click", function(ev) {
            var currentQty = $('input[name="quantity"]').val();
            var qtyDirection = $(this).data("direction");
            var newQty = 0;

            if (qtyDirection == "1") {
                newQty = parseInt(currentQty) + 1;
            }
            else if (qtyDirection == "-1") {
                newQty = parseInt(currentQty) - 1;
            }

            // make decrement disabled at 1
            if (newQty == 1) {
                $(".decrement-quantity").attr("disabled", "disabled");
            }

            // remove disabled attribute on subtract
            if (newQty > 1) {
                $(".decrement-quantity").removeAttr("disabled");
            }

            if (newQty > 0) {
                newQty = newQty.toString();
                $('input[name="quantity"]').val(newQty);
            }
            else {
                $('input[name="quantity"]').val("1");
            }
        });
    </script>

@endsection
