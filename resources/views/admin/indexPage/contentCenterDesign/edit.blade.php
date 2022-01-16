@extends('layouts.admin')
@section('title')
    تعديل|الصفحة الرئيسية للموقع
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
                                    <a href="{{route('index.content_center_design')}}">الصفحة الرئيسية للموقع </a>

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
                                        <strong>  تعديل محتوى التصميم
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
                                              action="{{route('update.content_center_design',$content_center_design->id)}}"
                                              id="vendorForm" enctype="multipart/form-data">
                                            @csrf
                                            <h4 class="form-section"><i
                                                    class="ft-home"></i> تعديل   محتوى التصميم
                                            </h4>
                                            <input type="hidden" name="id" value="{{$content_center_design->id}}">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label> اختر الصورة </label>
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
                                                        <img src="{{$content_center_design->getPhoto($content_center_design->image->photo)}}"
                                                             alt="photo"
                                                             class="height-150">
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="form-body">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">العنوان</label>
                                                            <input type="text" id="header" class="form-control" placeholder="ابدأ بتفصيل ملابسك الان"
                                                                   name="header" value="{{$content_center_design->header}}">
                                                            @error('header')
                                                            <span id="header_error" class="text-danger">{{$massage}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-actions">
                                                <a href="{{route('index.content_center_design')}}" class="btn btn-warning mr-1"
                                                   data-dismiss="modal"><i
                                                        class="la la-undo"></i> تراجع
                                                </a>
                                                <button class="btn btn-primary" id="updateContentCenterDesignIndex"><i
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


