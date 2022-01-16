@extends('layouts.site')

@section('title')
    اتصل بنا
@endsection
@section('content')
  <header class="bg-dark">
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent container pt-4">
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
            <a class="nav-link MontserratArabicLightPure" href="{{route('customer.viewDesignProduct')}}">التصاميم</a>
          </li>
            @auth('customer')
                <li class="nav-item pl-2">
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
                    <a class="nav-link MontserratArabicLightPure text-warning" href="{{route('contactUs')}}">اتصل بنا</a>
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
                    <a class="nav-link MontserratArabicLight" href="{{route('customer.login.page')}}">تسجيل الدخول</a>
                </li>

            @endguest
        </ul>
      </div>
    </nav>
  </header>

  <section class="container mt-5">
      <div class="row mb-5">
          <div class="col text-center">
            <h3 class="MontserratArabicLight about-text">اتصل بنا</h3>
            <p class="MontserratArabicLight">مركز الدعم الفني :يمكنك الاتصال بنا وتقديم شكواك <br>
               ومقترحاتك بأي وقت</p>
          </div>
        </div>
        <div class="container">
        <div class="row">

          <div class="col-md-2 text-right">
            <p class="MontserratArabicLight">رقم الدعم الفني</p>
          </div>
          <div class="col text-right">
              <p class="MontserratArabicLight">+966 025 0255 </p>
          </div>

        </div>
      </div>
  </section>

  <section class="section-1">
      <div class="container text-center">
          <div class="row">
              <div class="col-md-6">
                  <div class="panel text-right">
                      <h3 class="text-white mt-1 py-1 font48">تواصل معنا</h3>
                      <div class="col-md-6">
                          <form class="needs-validation pr-1" method="post" action="{{route('customer.saveContactUs')}}" novalidate>
                              @csrf

                              @auth('customer')
                                  <input type="hidden" name="customer_id" value="{{auth('customer')->user()->id}}">

                              @endauth
                              <div class="form-row">
                                  <label class="text-white about-text MontserratArabicLight" for="validationCustom01">الاسم الاول</label>
                                  <input type="text" class="form-control" name="first_name" value="{{old('first_name')}}" id="validationCustom01">
                                  @error('first_name')
                                  <small id="email" class="text-danger float-right">{{$message}} </small>
                                  @enderror
                              </div>
                              <div class="form-row ">
                                  <label class="text-white about-text MontserratArabicLight" for="validationCustom01">الاسم الاخير</label>
                                  <input type="text" class="form-control" name="last_name" value="{{old('last_name')}}" id="validationCustom01" >
                                  @error('last_name')
                                  <small id="email" class="text-danger float-right">{{$message}} </small>
                                  @enderror
                              </div>
                              <div class="form-row">
                                  <label class="text-white about-text MontserratArabicLight" for="validationCustom01">الايميل</label>
                                  <input type="email" class="form-control" name="email" value="{{old('email')}}" id="validationCustom01">
                                  @error('email')
                                  <small id="email" class="text-danger float-right">{{$message}} </small>
                                  @enderror
                              </div>
                              <div class="form-row">
                                  <label class="text-white about-text MontserratArabicLight" for="validationCustom01">الرسالة</label>
                                  <textarea class="form-control" name="message"  id="validationCustom01" rows="3">{{old('message')}}</textarea>
                                  @error('message')
                                  <small id="email" class="text-danger float-right">{{$message}} </small>
                                  @enderror
                              </div>

                              <button class="btn btn-dark about-text float-left mt-4 px-5 MontserratArabicLight" type="submit">ارسل</button>
                            </form>
                      </div>
                      <div class="col-md-6"></div>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="pray">
                      <img src="{{asset('/public/assets/front/assets/Image Placeholder.png')}}" alt="">
                  </div>
              </div>
          </div>
      </div>
  </section>


  <footer class="bg-dark">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-2 col-sm-12 d-flex">
                  <a class="navbar-brand MontserratArabic-logo text-warning pt-4 footer-logo" href="{{route('index')}}">
                      ترزي
                  </a>
              </div>

              <div class="col-md-2 col-sm-12">
                  <ul class="footer-col pt-4">
                      <li class="py-2">
                          <a class="text-white" href="{{route('index')}}">الرئيسية</a>
                      </li>
                      <li class="py-2">
                          <a class="text-white" href="{{route('customer.viewFabricProduct')}}">الأقمشة</a>
                      </li>
                      <li class="py-2">
                          <a class="text-white" href="{{route('customer.viewDesignProduct')}}">التصاميم</a>
                      </li>
                      <li class="py-2">
                          <a class="text-white" href="">مشترياتي</a>
                      </li>
                      <li class="py-2">
                          <a class="text-white" href="{{route('customer.viewCompanies')}}">الشركات</a>
                      </li>
                  </ul>
              </div>
              <div class="col-md-2 col-sm-12">
                  <ul class="footer-col pt-4">
                      <li class="py-2">
                          <a class="text-muted" href="{{route('aboutLanding')}}">من نحن ؟</a>
                      </li>
                      <li class="py-2">
                          <a class="text-muted" href="">المساعدة</a>
                      </li>
                      <li class="py-2">
                          <a class="text-muted" href="">الشروط</a>
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
                              <input type="text" class="form-control bg-dark text-white border-left-0 rounded-right"
                                     placeholder="الايميل">
                              <div class="input-group-prepend">
                                  <button type="submit"
                                          class=" rounded-left border-right-0 bg-dark text-white input-group-text">
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
                      <a class="text-decoration-none text-light" href="https://m.facebook.com/%D8%AA%D8%B1%D8%B2%D9%8A-Tarzy-108261764824908"><i class="fa fa-facebook-f px-3"></i></a>
                      <a class="text-decoration-none text-light" href="https://www.instagram.com/tarzyclub/?utm_medium=copy_link&fbclid=IwAR3ZEKWR46p1z-h4uX0KEQxe2cFrZfAIE7y0SaGGpvuwyRz0AO-2lMRxPUw"><i class="fa fa-instagram px-3"></i></a>
                      <i class="fa fa-twitter px-3"></i>
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



