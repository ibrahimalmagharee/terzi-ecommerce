@extends('layouts.login')
@section('title')
    تعيين كلمة مرور جديدة
@endsection
@section('content')
    <section class="flexbox-container">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
                <div class="card border-grey border-lighten-3 m-0">
                    <div class="card-header border-0">
                        <div class="card-title text-center">
                            <div class="p-1">
                                <img src="{{asset('/public/assets/front/assets/logo.png')}}" alt="LOGO"/>

                            </div>
                        </div>
                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                            <span>تعيين كلمة مرور جديدة </span>
                        </h6>
                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            <form class="form-horizontal form-simple" action="{{ route('admin.password.update') }}"
                                  method="post" novalidate>
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <input type="text" name="email"
                                           class="form-control form-control-lg input-lg @error('email') is-invalid @enderror"
                                           value="{{ $email ?? old('email') }}" id="email" placeholder="أدخل البريد الالكتروني ">
                                    <div class="form-control-position">
                                        <i class="ft-user"></i>
                                    </div>

                                    @error('email')
                                    <span class="text-danger" role="alert">{{$message}} </span>
                                    @enderror

                                </fieldset>
                                <br>
                                <fieldset class="form-group position-relative has-icon-left mt-2">
                                    <input type="password" name="password"
                                           class="form-control form-control-lg input-lg @error('password') is-invalid @enderror"
                                           id="user-password"
                                           placeholder="أدخل كلمة المرور">
                                    <div class="form-control-position">
                                        <i class="la la-key"></i>
                                    </div>
                                    @error('password')
                                    <span class="text-danger">{{$message}} </span>
                                    @enderror
                                </fieldset>

                                <fieldset class="form-group position-relative has-icon-left mt-2">
                                    <input type="password" name="password_confirmation"
                                           class="form-control form-control-lg input-lg @error('password') is-invalid @enderror"
                                           id="password_confirmation"
                                           placeholder="تأكيد كلمة المرور">
                                    <div class="form-control-position">
                                        <i class="la la-key"></i>
                                    </div>
                                    @error('password')
                                    <span class="text-danger">{{$message}} </span>
                                    @enderror
                                </fieldset>




                                <button type="submit" class="btn btn-info btn-lg btn-block"><i
                                        class="ft-unlock"></i>
                                   تعيين كلمة مرور جديدة
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
