@extends('layouts.site')

@section('title')
    بروفايل الشركة
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

    <div class="container">
        <div class="profile">
            <div class="profile-header">
                <div class="profile-header-cover">
                    @if($vendor->headerCover)
                        <img src="{{$vendor->getPhotoHeaderCover($vendor->headerCover->photo)}}" id="profile-header-cover" style="width: 100%; height: 18rem;" alt="">
                    @else
                        <img src="{{asset('/public/assets/front/assets/companyprofile1.png')}}" id="profile-header-cover" style="width: 100%; height: 18rem;" alt="">

                    @endif
                </div>
                <div class="profile-header-content">
                    <div class="profile-header-img">
                        <img style="width: 100%; height: 100%;" src="{{$vendor->getPhoto($vendor->image->photo)}}" alt="" />
                    </div>
                    <div class="row profile-header-tab">
                        <div class="col-md-6 text-right">
                            {{$vendor->name}}
                        </div>
                        <div class="col-md-6 text-left">
                        </div>
                    </div>
                </div>
            </div>

            <div class="container pb-5 my-5">
                <div class="row ">
                    <div class="col text-right d-flex p-0">
                        <h4  class="pr-2 border-3 section-title" >المنتجات</h4>
                    </div>
                </div>
                <div class="row mt-5 p-2">
                    @isset($product_designs)
                        @foreach($product_designs as $product_design)
                            <div class="col-md-4 col-sm-12 pr-0 pl-5 col-resp  my-2">
                                <div class="card border-0 shadow-cust rounded-cust card-resp" style="width: 100%;">
                                    <a href="{{route('customer.viewDesignProductDetails',$product_design->id)}}">
                                        <img src="{{$product_design->getPhoto($product_design->images[0]->photo)}}" class="card-img-top" style="width: 100%; height:280px">

                                    </a>
                                    <div class="card-body text-center">
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <h5 class="card-text">{{$product_design->name}}</h5>
                                            @if($product_design->product->offer)
                                                <p class="card-text text-danger"><s>{{$product_design->product->price}} ر.س</s></p>
                                                <p class="card-text text-danger">{{$product_design->product->price - (($product_design->product->price / 100) * $product_design->product->offer)}} ر.س </p>
                                            @else
                                                <p class="card-text text-danger">{{$product_design->product->price}} ر.س</p>
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <p class="card-text"></p>
                                            <div>
                                                <button class="btn text-danger bg-white shadow-cust addToWishlist" data-product-id="{{$product_design->product->id}}">
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                </button>
                                                <button class="btn text-danger bg-white shadow-cust mr-2 addProductToBasket"  data-product-id="{{$product_design->product->id}}">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endisset

                        @isset($product_fabrics)
                            @foreach($product_fabrics as $product_fabric)
                                <div class="col-md-4 col-sm-12 pr-0 pl-5 col-resp  my-2">
                                    <div class="card border-0 shadow-cust rounded-cust card-resp" style="width: 100%;">
                                        <a href="{{route('customer.viewFabricProductDetails',$product_fabric->id)}}">
                                            <img src="{{$product_fabric->getPhoto($product_fabric->images[0]->photo)}}" class="card-img-top" style="width: 100%; height:280px">
                                        </a>
                                        <div class="card-body text-center">
                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <h5 class="card-text">{{$product_fabric->name}}</h5>
                                                @if($product_fabric->product->offer)
                                                    <p class="card-text text-danger"><s>{{$product_fabric->product->price}} ر.س</s></p>
                                                    <p class="card-text text-danger">{{$product_fabric->product->price - (($product_fabric->product->price / 100) * $product_fabric->product->offer)}} ر.س </p>
                                                @else
                                                    <p class="card-text text-danger">{{$product_fabric->product->price}} ر.س</p>
                                                @endif
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <p class="card-text"></p>
                                                <div>
                                                    <button class="btn text-danger bg-white shadow-cust addToWishlist" data-product-id="{{$product_fabric->product->id}}">
                                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                    </button>
                                                    <button class="btn text-danger bg-white shadow-cust mr-2 addProductToBasket"  data-product-id="{{$product_fabric->product->id}}">
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
            </div>
        </div>
    </div>

    @include('site.customer.footer')

@endsection

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

                $.ajax({
                    type: 'post',
                    url: "{{ route('customer.saveProductBasket') }}",
                    enctype: 'multipart/form-data',
                    data: {'product_id' : $(this).attr('data-product-id'),

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
@endsection
