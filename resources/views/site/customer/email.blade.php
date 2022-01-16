@extends('layouts.site')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-sm-12 px-5">

            <div class="text-lg-right text-center  mx-lg-5 my-1">
                <a class="pl-lg-5 mx-5 MontserratArabic-logo text-warning login-logo text-decoration-none" href="{{route('index')}}">
                    @isset($logo)
                        <img src="{{$logo->getPhoto($logo->photo)}}" style="width: 50px">

                    @else
                        ترزي
                    @endisset
                </a>

                <p class="pr-lg-5  pt-3 MontserratArabicLight font30">
                    استرجاع كلمة المرور
                </p>
                @if (session('status'))
                    <div class="alert alert-success mx-lg-5 text-center">
                        <p><small>تم ارسال ايميل يمكنك مراجعة بريدك الالكتروني</small></p>
                    </div>
                @endif
            </div>


            <form method="POST" action="{{ route('customer.password.email')}}" class="form justify-content-center px-lg-5 px-sm-2 mx-lg-5  ml-lg-5 reg-form-custom" _lpchecked="1">
                @csrf
                <div class="row" style="height: 70px;">
                    <div role="group" class="col-md-12 col-sm-12">
                        <input name="email" id="email"  type="email" class="form-control" value="{{ old('email') }}" placeholder=" ">
                        <label for="email"  class="MontserratArabicLight label">البريد الالكتروني</label>
                        <div class="row position-absolute">
                            @error('email')
                            <span class="text-danger MontserratArabicLightPure span" role="alert" style=" margin-right: 15px; text-align: center">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="row">
                    <button type="submit" class="btn btn-yellow w-100 m-3 MontserratArabicLight">استرجاع </button>
                </div>
            </form>

        </div>
        <div class="col-md-6 col-sm-12 register-img">
            <div class="position text-right">
                <h3 class="p-4 my-2 text-warning MontserratArabic">منصة ترزي</h3>

                <p class="px-2 text-white MontserratArabicLight">
                    هي منصة تتيح لك اختيار ذوق اللبس الخاص بك بنوع القماش الذي يناسبك                    </p>
                <a class="m-2 btn btn-yellow login-btn" href="{{route('customer.register.page')}}">سجل ك عميل الآن  </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
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
