@extends('layouts.admin')
@section('title')
    تعديل|الشعار
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
                                <li class="breadcrumb-item active"> تعديل الشعار
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
                                        <strong> تعديل الشعار
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
                                              action="{{route('update.logo',$logo->id)}}"
                                              id="vendorForm" enctype="multipart/form-data">
                                            @csrf
                                            <h4 class="form-section"><i
                                                    class="ft-home"></i>  تعديل الشعار
                                            </h4>
                                            <input type="hidden" name="id" value="{{$logo->id}}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label> اختر الصورة</label>
                                                        <label id="projectinput7" class="file center-block">
                                                            <input type="file" id="file" name="photo">
                                                            <span class="file-custom"></span>
                                                        </label>
                                                        @error('photo')
                                                        <span id="photo_error"
                                                              class="text-danger">{{$message}} </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="text-center">
                                                            <img src="{{$logo->getPhoto($logo->photo)}}" style="width: 50px"
                                                                 alt="photo"
                                                                 class="height-150">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-actions">
                                                <a href="{{route('index.logo')}}" class="btn btn-warning mr-1"
                                                   data-dismiss="modal"><i
                                                        class="la la-undo"></i> تراجع
                                                </a>
                                                <button class="btn btn-primary" id="updateLogo"><i
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


