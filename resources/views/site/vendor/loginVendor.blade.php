@extends('layouts.site')

@section('title')
    تسجيل الدخول | تاجر
    @endsection
@section('content')
    <div class="container-fluid ">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="container">
                <div class="text-lg-right text-center  mx-5 my-1">
                    <h3> <a class="px-5 my-1 text-warning MontserratArabic text-decoration-none" href="{{route('index')}}">
                            @isset($logo)
                                <img src="{{$logo->getPhoto($logo->photo)}}" style="width: 50px">

                            @else
                                ترزي.
                            @endisset
                        </a></h3>
                    <p class="pr-lg-5  pt-3 MontserratArabicLight">
                        أهلا بك مرة أخرى!
                    </p>
                </div>

                <form method="post" action="{{route('check.vendor.login')}}" class="form justify-content-center px-lg-5 px-sm-2 mx-lg-5  ml-lg-5 reg-form-custom" _lpchecked="1">
                    @csrf
                    <div class="row" style="height: 70px;">
                        <div role="group" class="col-md-12 col-sm-12">
                            <input name="email" id="email"  type="email" class="form-control" placeholder=" ">
                            <label for="email" class="MontserratArabicLight label">البريد الالكتروني</label>
                            <div class="row position-absolute">
                            @error('email')
                            <span class="span text-danger MontserratArabicLightPure float-right" style="margin-top: 5px; margin-right: 15px; text-align: center">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="row mt-2"  style="height: 70px;">
                            <div role="group" class="col-md-12 col-sm-12">

                                <input name="password" id="password" type="password" class="form-control" placeholder=" ">
                                <label for="password"  class="MontserratArabicLight label">كلمة المرور</label>
                                <span class="log-after-input"><i toggle="#password" class="fa fa-eye toggle-password" aria-hidden="true"></i></span>

                                <div class="row position-absolute">
                                    <span class="float-right" style="margin-top:-20px;">
                                <a href="{{ route('vendor.password.request')}}" class="text-decoration-none">
                                  <small class="text-warning MontserratArabicLight pr-3">نسيت كلمة المرور ؟</small>
                                </a>
                                </span>
                                    @error('password')
                                    <span  class="text-danger MontserratArabicLightPure pr-2" style="margin-top:-20px; text-align: center">{{$message}}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>



                    </div>

                    <div class="row">
                        <button class="btn btn-yellow w-100 m-3 MontserratArabicLight">تسجيل الدخول </button>
                    </div>
                </form>
                <div class="container ">
                    <div class="row mx-5 px-4 justify-content-center">
                        <p class="MontserratArabicLight" style="text-align: center;">
                            أو قم بالتسجيل من خلال
                        </p>
                    </div>
                    <hr class="mx-5 px-5">
                    <div class="row mx-lg-5 px-lg-4 justify-content-center">
                        <i class="icon-custom fa fa-apple px-3"></i>
                        <a href="#"><i class="icon-custom fa fa-google px-3"></i></a>
                        <a href="#"><i class="icon-custom fa fa-facebook-f px-3"></i></a>
                    </div>

                    <div class="row mx-5 p-4 justify-content-center">
                        لديك حساب بالفعل ؟ <span> <a href="{{route('vendor.register.page')}}" class="text-warning MontserratArabicLight"> سجل الان</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 register-img">
            <div class="position text-right">
                <h3 class="p-4 my-2 text-warning MontserratArabicLight">منصة ترزي</h3>

                <p class="px-2 text-white MontserratArabicLight">
                    هي منصة تتيح لك اختيار ذوق اللبس الخاص بك بنوع القماش الذي يناسبك                    </p>
                <a class="m-2 btn btn-yellow login-btn" href="{{route('vendor.register.page')}}">سجل ك تاجر الآن  </a>
            </div>
        </div>
    </div>
    </div>
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
