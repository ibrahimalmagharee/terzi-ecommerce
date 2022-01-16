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
                                    <a href="{{route('index.header_bottom')}}">الصفحة الرئيسية للموقع </a>

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
                                        <strong> تعديل الرأسية
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
                                              action="{{route('update.header_bottom',$header_bottom->id)}}"
                                              id="vendorForm" enctype="multipart/form-data">
                                            @csrf
                                            <h4 class="form-section"><i
                                                    class="ft-home"></i> تعديل  الرأسية
                                            </h4>
                                            <input type="hidden" name="id" value="{{$header_bottom->id}}">
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
                                                        <img src="{{$header_bottom->getPhoto($header_bottom->image->photo)}}"
                                                             alt="photo"
                                                             class="height-150">
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="form-body">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput2">نوع الرأسية</label>
                                                            <select name="type" id="type" class=" form-control">
                                                                <optgroup label="الرجاء اختر نوع الرأسية">
                                                                    <option value="1" @if($header_bottom->type == 1) selected @endif>قماش</option>
                                                                    <option value="2" @if($header_bottom->type == 2) selected @endif>تصميم</option>
                                                                    <option value="3" @if($header_bottom->type == 3) selected @endif>توصيل</option>
                                                                </optgroup>
                                                            </select>
                                                            <span id="type_error" class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">الوصف</label>
                                                            <textarea name="description" id="description" cols="3" rows="6"
                                                                      class="form-control"
                                                                      placeholder="نحن شركة زياد مشتهى للاقمشة ...">{{$header_bottom->description}}</textarea>
                                                        </div>
                                                        @error('description')
                                                        <span id="description_error" class="text-danger">{{$massage}}</span>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="form-actions">
                                                <a href="{{route('index.header_bottom')}}" class="btn btn-warning mr-1"
                                                   data-dismiss="modal"><i
                                                        class="la la-undo"></i> تراجع
                                                </a>
                                                <button class="btn btn-primary" id="updateHeaderBottomIndex"><i
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


