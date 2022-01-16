@extends('layouts.site')

@section('title')
    تسجيل الاشتراك |زبون
@endsection
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6 col-sm-12  px-5">

                <div class="text-lg-right text-center  mx-5 my-1">
                    <p class="px-5">
                        <a class="pl-lg-5 MontserratArabic-logo text-warning login-logo text-decoration-none" href="{{route('index')}}">
                            @isset($logo)
                                <img src="{{$logo->getPhoto($logo->photo)}}" style="width: 50px">

                            @else
                                ترزي
                            @endisset
                        </a>
                    </p>

                    <p class="pr-lg-5  pt-3 MontserratArabicLight font30">
                        تسجيل الدخول
                    </p>
                </div>

                <form method="post" action="{{route('customer.register')}}" class="form justify-content-center px-lg-5 px-sm-2 mx-lg-5  ml-lg-5 needs-validation reg-form-custom" _lpchecked="1" novalidate>
                    @csrf
                    <div class="row" style="height: 70px;">
                        <div role="group" class="col-md-12 col-sm-12">
                            <input name="name" id="name" value="{{old('name')}}" type="text" class="form-control" placeholder=" ">
                            <label for="name" class="MontserratArabicLight label">الاسم
                                كاملا </label>
                            <div class="row position-absolute">
                            @error('name')
                            <span class="text-danger MontserratArabicLightPure float-right span" style="margin-top: 5px; margin-right: 15px; text-align: center">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2" style="height: 70px;">
                        <div role="group" class="col-md-12  col-sm-12">
                            <input name="email" id="email" value="{{old('email')}}" type="email"
                                   class="form-control" placeholder=" ">
                            <label for="email" class="MontserratArabicLight label">الايميل او رقم
                                الهاتف </label>
                            <div class="row position-absolute">
                            @error('email')
                            <span class="text-danger MontserratArabicLightPure float-right span" style="margin-top: 5px; margin-right: 15px; text-align: center">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2" style="height: 70px;">
                        <div role="group" class="col-md-12 col-sm-12">
                            <input name="password" id="password" value="{{old('password')}}" type="password"
                                   class="form-control" placeholder=" ">
                            <label for="password" class="MontserratArabicLight label">كلمة المرور</label>
                            <span class="after-input"><i toggle="#password" class="fa fa-eye toggle-password"
                                                         aria-hidden="true"></i>
                        </span>
                            <div class="row position-absolute">

                                @error('password')
                                <span class="text-danger MontserratArabicLightPure float-right mr-3">{{$message}}</span>

                                @else
                                    <span><small class="float-right MontserratArabicLightPure mr-3">كلمة المرور يجب ان تكون ما بين 4 الى 6 احرف</small></span>

                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2" style="height: 70px;">
                        <div role="group" class="col-md-12  col-sm-12">
                            <input name="password_confirmation" id="password_confirmation" type="password"
                                   class="form-control" placeholder=" " value="{{old('password_confirmation')}}">
                            <label for="password_confirmation" class="MontserratArabicLight label">تاكيد كلمة
                                المرور</label>
                            <span class="after-input"><i toggle="#password_confirmation"
                                                         class="fa fa-eye toggle-password" aria-hidden="true"></i>
                        </span>
                            <div class="row position-absolute">
                            @error('password')
                            <span id="password"
                                  class="text-danger MontserratArabicLightPure float-right span" style="margin-top: 5px; margin-right: 15px; text-align: center">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row" style="height: 50px;">
                        <div role="group" class="form-group col-md-12  col-sm-12 d-flex">
                            <input type="checkbox" name="terms_conditions" class="form-check-input float-right"
                                   id="exampleCheck1">
                            <label class="form-check-label mr-3 MontserratArabicLight" for="exampleCheck1">
                                <small>
                                    لقد قبلت
                                    <span>
                            <a href="#" class="text-warning text-decoration-none">
                              الشروط والأحكام
                            </a>
                          </span>
                                </small>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn btn-yellow w-100 m-3">تسجيل</button>
                    </div>
                </form>

                <div class="row mx-lg-5 pl-lg-4 justify-content-center">
                    <p class="MontserratArabicLight" style="text-align: center;">
                        أو قم بالتسجيل من خلال
                    </p>
                </div>
                <hr  style="margin-left: 18% !important; margin-right: 18% !important;">
                <div class="row mx-lg-5 pl-lg-4 justify-content-center">
                    <a><i class="icon-custom fa fa-apple px-3"></i></a>
                    <a href="{{route('service.customer','google')}}"><i class="icon-custom fa fa-google px-3"></i></a>
                    <a href="{{route('service.customer','facebook')}}"><i class="icon-custom fa fa-facebook-f px-3"></i></a>
                </div>

                <div class="row mx-lg-5 p-4 justify-content-center">
                    لديك حساب بالفعل ؟ <span> <a href="{{route('customer.login.page')}}" class="text-warning MontserratArabicLight"> سجل الدخول الان</a></span>
                </div>

            </div>
            <div class="col-md-6 col-sm-12 register-img">
                <div class="position text-right">
                    <h3 class="p-4 my-2 text-warning MontserratArabic">منصة ترزي</h3>

                    <p class="px-lg-2 text-white MontserratArabicLight">
                        هي منصة تتيح لك اختيار ذوق اللبس الخاص بك بنوع القماش الذي يناسبك                    </p>
                    <a class="m-2 btn btn-yellow" href="{{route('customer.login.page')}}">تسجيل الدخول ك عميل  </a>
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
