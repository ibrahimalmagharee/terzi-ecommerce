@extends('layouts.login')
@section('title')
   التحقق من الايميل
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
                            <span>التحقق من الايميل </span>
                        </h6>
                        <div class="row mr-2 ml-2">
                            @if (session('status'))
                                <div class="btn btn-lg btn-block btn-outline-success">
                                    <p><strong>تم ارسال ايميل</strong></p>
                                </div>
                            @endif
                        </div>

                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            <form class="form-horizontal form-simple" action="{{ route('admin.password.email')}}"
                                  method="post" novalidate>
                                @csrf
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <input type="text" name="email"
                                           class="form-control form-control-lg input-lg @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}" id="email" placeholder="أدخل البريد الالكتروني ">
                                    <div class="form-control-position">
                                        <i class="ft-user"></i>
                                    </div>

                                    @error('email')
                                    <span class="text-danger invalid-feedback" role="alert"><strong>{{$message}} </strong></span>
                                    @enderror

                                </fieldset>
                                <br>
                                <button type="submit" class="btn btn-info btn-lg btn-block"><i
                                        class="ft-unlock"></i>
                                    التحقق من الايميل
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
