@extends('layouts.site')

@section('title')
    تفصيل منتج قماش
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
            <img src="{{$fabric->getPhoto($fabric->images[0]->photo)}}" style="height: 443px;" class="w-100" alt="">
        </div>
        <div class="col-lg-7 col-sm-12 text-right MontserratArabicLightPure">
            <small>قسم - {{$fabric->product->category->name}}</small>
            <div class="row my-3">
                <div class="col text-right">
                    <h3>{{$fabric->name}}</h3>
                </div>
                <div class="col text-left">
                    @if($fabric->product->offer)
                        <h3><s>{{$fabric->product->price}} ر.س</s></h3>
                        <h3>{{$fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)}} ر.س </h3>
                    @else
                        <h3>{{$fabric->product->price}} ر.س</h3>
                    @endif
                </div>
            </div>
            <small>{{$fabric->product->vendor->name}}</small>
            <h5 class="mt-3">تفاصيل المنتج</h5>
            <p>{{$fabric->description}}</p>
            <div class="row">
                <div class="col-8 d-flex">
                    @foreach($fabric->colors as $color)
                        <label class="contain">
                            <input type="radio" name="radio">
                            <span class="checkmark
                            @if($color -> color == 'الاصفر')
                                bg-warning
                            @elseif($color -> color == 'الاحمر')
                                                            bg-danger
                            @elseif($color -> color == 'الازرق')
                                                            bg-primary
                            @elseif($color -> color == 'الاخضر')
                                                            bg-success
                            @elseif($color -> color == 'التركوازي')
                                                            bg-info
                            @elseif($color -> color == 'النيلي')
                                                            btn-darkblue
                            @elseif($color -> color == 'البنفسجي')
                                                            btn-indiago
                            @endif
                                " style="border-radius: 15% !important;"></span>
                        </label>

                        @endforeach

                </div>
                <div class="col">
                    <div class="coupon p-3 float-left rounded">
                        <strong>{{$fabric->product->offer == '' ? 'لايوجد عرض' : $fabric->product->offer}} @if($fabric->product->offer != '') % @endif</strong>
                        <br>

                    </div>
                </div>
            </div>
            <div class="row">

                <div class="product-quantity">

                    <div class="quantity-selectors-container">
                        <div class="quantity-selectors ">
                            <button type="button" class="increment-quantity" aria-label="Add one" data-direction="1"><span>&#43;</span></button>
                            <button type="button" class="decrement-quantity" aria-label="Subtract one" data-direction="-1" disabled="disabled"><span>&#8722;</span></button>
                        </div>
                    </div>
                    <input class="rounded input-qunt border-none" data-min="1" data-max="0" type="text" name="quantity" value="1" readonly="true">
                </div>
                <button type="submit" title="أضف الى السلة" class="action btn btn-danger mr-3 col-5 addProductToBasket"  data-product-id="{{$fabric->product->id}}" style="width: 180px;">
                    أضف الى السلة
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </button>

                <button class="btn text-danger bg-white shadow-cust mr-3 addToWishlist" data-product-id="{{$fabric->product->id}}">
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
        @isset($fabrics_related)
            @foreach($fabrics_related as $fabric_related)
        <div class="col-md-4 col-sm-12 pr-0 pl-5 col-resp  my-2">

                    <div class="card border-0 shadow-cust rounded-cust card-resp" style="width: 100%;">
                        <a href="{{route('customer.viewFabricProductDetails',$fabric_related->id)}}">
                            <img src="{{$fabric_related->getPhoto($fabric_related->images[0]->photo)}}" class="card-img-top" style="width: 100%; height:280px">
                        </a>
                        <div class="card-body text-center">
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <h5 class="card-text">{{$fabric_related->name}}</h5>
                                @if($fabric_related->product->offer)
                                    <p class="card-text text-danger"><s>{{$fabric_related->product->price}} ر.س</s></p>
                                    <p class="card-text text-danger">{{$fabric_related->product->price - (($fabric_related->product->price / 100) * $fabric_related->product->offer)}} ر.س </p>
                                @else
                                    <p class="card-text text-danger">{{$fabric_related->product->price}} ر.س</p>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <p class="card-text">{{$fabric_related->product->vendor->name}}</p>
                                <div class="row">
                                    <button class="btn text-danger bg-white shadow-cust addToWishlist" data-product-id="{{$fabric_related->product->id}}">
                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn text-danger bg-white shadow-cust mr-2 addProductToBasket"  data-product-id="{{$fabric_related->product->id}}">
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
