@extends('layouts.admin')
@section('title')
    تعديل|نبذة تاجر-{{$about->vendor->name}}
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
                                    <a href="{{route('index.vendors')}}">التجار </a>

                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{route('index.about.vendors')}}">من نحن </a>

                                </li>
                                <li class="breadcrumb-item active"> تعديل نبذة - {{$about->vendor->name}}
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
                                        <strong> تعديل نبذة - {{$about->vendor->name}}
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
                                              action="{{route('update.about.vendor',$about->id)}}"
                                              id="vendorForm" enctype="multipart/form-data">
                                            @csrf
                                            <h4 class="form-section"><i
                                                    class="ft-home"></i>  تعديل نبذة - {{$about->vendor->name}}
                                            </h4>
                                            <input type="hidden" name="id" value="{{$about->id}}">
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
                                                            <img src="{{$about->getPhoto($about->image->photo)}}"
                                                                 alt="photo"
                                                                 class="height-150">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">اختر الشركة</label>
                                                            <select name="vendor_id" id="vendor_id"
                                                                    class="form-control">
                                                                <optgroup label="الرجاء اختر التاجر">
                                                                    @isset($data['vendors'] )
                                                                        @foreach($data['vendors'] as $vendor)
                                                                            <option value="{{$vendor->id}}"
                                                                                    @if($about->vendor_id == $vendor->id) selected @endif>{{$vendor->name}}</option>
                                                                            h
                                                                        @endforeach
                                                                    @endisset
                                                                </optgroup>
                                                            </select>
                                                            <span id="vendor_id_error" class="text-danger"></span>
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">من نحن</label>
                                                            <textarea name="about" id="about" cols="3" rows="6"
                                                                      class="form-control"
                                                                      placeholder="نحن شركة زياد مشتهى للاقمشة ...">{{$about->about}}</textarea>
                                                        </div>
                                                        <span id="about_error" class="text-danger"></span>
                                                    </div>
                                                </div>



                                            </div>

                                            <div class="form-actions">
                                                <a href="{{route('index.about.vendors')}}" class="btn btn-warning mr-1"
                                                   data-dismiss="modal"><i
                                                        class="la la-undo"></i> تراجع
                                                </a>
                                                <button class="btn btn-primary" id="updateAboutVendor"><i
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


