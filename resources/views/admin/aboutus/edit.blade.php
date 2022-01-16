@extends('layouts.admin')
@section('title')
    تعديل|من نحن
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"></h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{route('admin.dashboard')}}">الرئيسية </a>
                                </li>

                                <li class="breadcrumb-item">
                                    <a href="{{route('index.about')}}">من نحن </a>

                                </li>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title text-center">
                                        <strong> تعديل النبذة
                                        </strong></h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>


                                <!--  Begin Form Edit -->

                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" method="post"
                                              action="{{route('update.about',$about_us->id)}}"
                                              id="vendorForm" enctype="multipart/form-data">
                                            @csrf
                                            <h4 class="form-section"><i
                                                    class="ft-home"></i>  تعديل النبذة
                                            </h4>
                                            <input type="hidden" name="id" value="{{$about_us->id}}">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label> اختر الصورة او الفيديو</label>
                                                        <label id="projectinput7" class="file center-block">
                                                            <input type="file" id="file" name="photo">
                                                            <span class="file-custom"></span>
                                                        </label>
                                                        @error('photo')
                                                        <span id="photo_error"
                                                              class="text-danger">{{$message}} </span>
                                                        @enderror
                                                    </div>

                                                        <div class="text-center">

                                                            @isset($about_us->image)

                                                            @if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png')
                                                                <img src="{{$about_us->getPhoto($about_us->image->photo)}}"
                                                                     alt="photo"
                                                                     class="height-150">
                                                            @else
                                                                <video width="320" height="240" controls>

                                                                    <source src="{{$about_us->getPhoto($about_us->image->photo)}}" type="video/mp4">
                                                                </video>

                                                            @endif
                                                                @endisset

                                                        </div>

                                                </div>

                                            </div>
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">الرابط</label>
                                                            <input type="text" id="link" class="form-control" placeholder="https://www.youtube.com/embed/QTlU9S2O4cE"
                                                                   name="link" value="{{$about_us->link}}">
                                                            <span id="link_error" class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">من نحن</label>
                                                            <textarea name="about" id="about" cols="3" rows="6"
                                                                      class="form-control"
                                                                      placeholder="نحن شركة زياد مشتهى للاقمشة ...">{{$about_us->about}}</textarea>
                                                        </div>
                                                        @error('about')
                                                        <span id="about_error" class="text-danger">{{$massage}}</span>
                                                        @enderror
                                                    </div>
                                                </div>



                                            </div>

                                            <div class="form-actions">
                                                <a href="{{route('index.about')}}" class="btn btn-warning mr-1"
                                                   data-dismiss="modal"><i
                                                        class="la la-undo"></i> تراجع
                                                </a>
                                                <button class="btn btn-primary" id="updateAboutUs"><i
                                                        class="la la-edit"></i> تحديث
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
@endsection


