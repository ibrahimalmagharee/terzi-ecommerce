@extends('layouts.admin')
@section('title')
    تعديل|كوبون-{{$coupon->code}}
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
                                    <a href="{{route('index.coupons')}}">اكواد الخصم </a>

                                </li>
                                <li class="breadcrumb-item active"> تعديل -
                                    {{$coupon->code}}</li>
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
                                        <strong> تعديل -
                                            {{$coupon->code}} </strong></h4>
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
                                              action="{{route('update.coupon',$coupon->id)}}"
                                              id="offerForm" enctype="multipart/form-data">
                                            @csrf
                                            <h4 class="form-section"><i
                                                    class="ft-home"></i> تعديل - {{$coupon->code}}
                                            </h4>
                                            <input type="hidden" name="id" value="{{$coupon->id}}">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">اختر التاجر</label>
                                                            <select name="vendor_id" id="vendor_id" class="select2 form-control">
                                                                <optgroup label="الرجاء اختر التاجر">
                                                                    @isset($vendors)
                                                                        @foreach($vendors as $vendor)
                                                                            <option value="{{$vendor->id}}" @if($vendor->id == $coupon->vendor_id) selected @endif>{{$vendor->name}}</option>
                                                                        @endforeach
                                                                    @endisset
                                                                </optgroup>
                                                            </select>
                                                            @error('code')
                                                            <span id="vendor_id_error" class="text-danger">{{$message}}</span>
                                                            @enderror

                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الكود </label>
                                                            <input type="text" id="code" class="form-control"
                                                                   placeholder="a@#$12c"
                                                                   name="code" value="{{$coupon->code}}">

                                                            @error('code')
                                                            <span id="code" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">نوع الكوبون</label>
                                                            <select name="type" id="type" class="select2 form-control">
                                                                <optgroup label="الرجاء اختر نوع الكوبون">
                                                                    <option value="1" @if($coupon->type == 1) selected @endif>نسبة</option>
                                                                    <option value="2" @if($coupon->type  == 2) selected @endif>قيمة ثابتة</option>
                                                                </optgroup>
                                                            </select>
                                                            <span id="type_error" class="text-danger"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> نسبة الخصم </label>
                                                            <input type="text" id="percent_discount" class="form-control" placeholder="خصم 10%"
                                                                   name="percent_discount" value="{{$coupon->percent_discount}}">

                                                            @error('percent_discount')
                                                            <span id="percent_discount" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">تاريخ البداية</label>
                                                            <input type="datetime-local" name="start_datetime" id="start_datetime" class="form-control" value="{{date('Y-m-d\TH:i', strtotime($coupon->start_datetime))}}">
                                                            @error('start_datetime')
                                                            <span id="start_datetime_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  تاريخ النهاية </label>
                                                            <input type="datetime-local" name="end_datetime" id="end_datetime" class="form-control" value="{{date('Y-m-d\TH:i', strtotime($coupon->end_datetime))}}">

                                                            @error('end_datetime')
                                                            <span id="end_datetime_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group mt-1">
                                                            <label for="switcheryColor4" class="card-title ml-1">الحالة</label>
                                                            <input type="checkbox" name="status" value="1" id="switcheryColor4"
                                                                   class="switchery active" data-color="success" @if($coupon->status == 1) checked @endif/>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-actions">
                                                <a href="{{route('index.coupons')}}" class="btn btn-warning mr-1"
                                                   data-dismiss="modal">
                                                    <i class="la la-undo"></i> تراجع</a>
                                                <button class="btn btn-primary" id="updateCopon"><i
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


