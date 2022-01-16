@extends('layouts.site')

@section('title')
    المفضلة
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

        <div class="container pb-5 my-5">
            <div class="row ">
                <div class="col text-right d-flex p-0">
                    <h4  class="pr-2 border-3 section-title" > منتجاتي المفضلة</h4>
                </div>
            </div>
        </div>

        <div class="row my-5">
            @if($designs->count() > 0)
                @foreach($designs as $design)
                    <div class="card mb-3 rounded-cust-prod shadow-cust width-cust delete-product" style="width: 100%">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img class="img-product rounded-cust-prod-right" style="width: 373px; height: 313px;"
                                     src="{{$design->getPhoto($design->images[0]->photo)}}" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body text-right py-4 px-5">
                                    <div class="row">
                                        <div class="col pr-4">
                                            <h5 class="card-title">{{$design->name}}</h5>
                                        </div>
                                        <div class="col text-danger text-left">
                                            <i class="fa fa-heart fa-2x removeFromWishlist" data-product-id="{{$design->product->id}}" style="cursor:pointer" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-10 pl-5 overflow-hidden">
                                            <p class="card-text">
                                                {{  \Illuminate\Support\Str::limit($design->description, 100) }}
                                            </p>
                                            <br>
                                            <small class="MontserratArabicLightPure">{{$design->product->vendor->name}}</small>
                                        </div>
                                        <div class="col pt-5 pr-4">
                                            <a class="MontserratArabicLightPure" href="{{route('customer.viewDesignProductDetails',$design->id)}}">المزيد</a>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        @if($design->product->offer)
                                            <p class="card-text pr-3"><s>{{$design->product->price}} ر.س</s></p>
                                            <p class="card-text pr-3">{{$design->product->price - (($design->product->price / 100) * $design->product->offer)}} ر.س </p>
                                        @else
                                            <p class="card-text pr-3">{{$design->product->price}} ر.س</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            @endif

                @if($fabrics->count() > 0)
                    @foreach($fabrics as $fabric)
                        <div class="card mb-3 rounded-cust-prod shadow-cust width-cust delete-product" style="width: 100%">
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
                                            <div class="col text-danger text-left">
                                                <i class="fa fa-heart fa-2x removeFromWishlist" data-product-id="{{$fabric->product->id}}" aria-hidden="true" style="cursor:pointer"></i>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-10 pl-5 overflow-hidden">
                                                <p class="card-text">
                                                    {{$fabric->description}}
                                                </p>
                                                <br>
                                                <small class="MontserratArabicLightPure">{{$fabric->product->vendor->name}}</small>
                                            </div>
                                            <div class="col pt-5 pr-4">
                                                <a class="MontserratArabicLightPure" href="{{route('customer.viewFabricProductDetails',$fabric->id)}}">المزيد</a>
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
                    @endforeach


                @endif




        </div>
    </div>

    @include('site.customer.footer')

@endsection

@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.removeFromWishlist', function (e) {
            e.preventDefault();

            var Clickedthis = $(this);
            var product_id = $(Clickedthis).closest('.delete-product').attr('data-product-id');

            @guest('customer')
            toastr.warning('انت غير مسجل دخول في النظام')
            @endguest

            $.ajax({
                type: 'delete',
                url: "{{Route('ProductWishlist.destroy')}}",
                data: {
                    'product_id': $(this).attr('data-product-id'),
                },
                success: function (data) {
                    $(Clickedthis).closest('.delete-product').remove();
                    toastr.success(data.msg);
                }
            });
        });

    </script>
@endsection
