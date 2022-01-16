@extends('layouts.admin')
@section('title')
    تعديل|مقاس-{{$size->customer->name}}
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
                                        href="{{route('admin.dashboard')}}">الرئيسية  </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{route('index.customers')}}">العملاء  </a>

                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{route('size.customer.index', $size->customer_id)}}">المقاسات  </a>

                                </li>
                                <li class="breadcrumb-item active"> تعديل مقاس - {{$size->name}}
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
                                        <strong> تعديل مقاس -
                                            {{$size->name}} </strong></h4>
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
                                                  action="{{route('size.update.customer',$size->id)}}"
                                                  id="sizeForm" enctype="multipart/form-data">
                                                @csrf
                                                <h4 class="form-section"><i
                                                        class="ft-home"></i> تعديل - {{$size->name}}
                                                </h4>
                                                <input type="hidden" name="id" value="{{$size->id}}">
                                                <input type="hidden" name="customer_id" value="{{$size->customer_id}}">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> الاسم </label>
                                                                <input type="text" id="name" class="form-control" placeholder="مثال:أحمد عبدالله"
                                                                       name="name" value="{{$size->name}}">
                                                                @error('name')
                                                                <span id="name_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> نوع القماش </label>
                                                                <select name="category_id"  id="category_id" class="form-control">
                                                                    <optgroup label="الرجاء اختر نوع القماش">
                                                                        <option value="">اختر نوع القماش</option>
                                                                        @isset($categories )
                                                                            @foreach($categories as $category)

                                                                                <option value="{{$category->id}}" @if($category->id == $size->category_id) selected @endif>{{$category->name}}</option>
                                                                            @endforeach
                                                                        @endisset
                                                                    </optgroup>
                                                                </select>
                                                                @error('category_id')
                                                                <span id="category_id_error" class="text-danger">{{$message}}</span>
                                                                @enderror

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> محيط الصدر </label>
                                                                <input type="text" id="chest_circumference" class="form-control"
                                                                       name="chest_circumference" value="{{$size->chest_circumference}}">
                                                                @error('chest_circumference')
                                                                <span id="chest_circumference_error" class="text-danger">{{$message}}</span>
                                                                @enderror

                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> محيط الخصر </label>
                                                                <input type="text" id="waistline" class="form-control"
                                                                       name="waistline" value="{{$size->waistline}}">
                                                                @error('waistline')
                                                                <span id="waistline_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> محيط الأرداف </label>
                                                                <input type="text" id="buttock_circumference" class="form-control"
                                                                       name="buttock_circumference" value="{{$size->buttock_circumference}}">
                                                                @error('buttock_circumference')
                                                                <span id="buttock_circumference_error" class="text-danger">{{$message}}</span>
                                                                @enderror

                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> طول بنسة الصدر </label>
                                                                <input type="text" id="length_by_chest" class="form-control"
                                                                       name="length_by_chest" value="{{$size->length_by_chest}}">
                                                                @error('length_by_chest')
                                                                <span id="length_by_chest_error" class="text-danger">{{$message}}</span>
                                                                @enderror

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> طول الصدر </label>
                                                                <input type="text" id="chest_length" class="form-control"
                                                                       name="chest_length" value="{{$size->chest_length}}">
                                                                @error('chest_length')
                                                                <span id="chest_length_error" class="text-danger">{{$message}}</span>
                                                                @enderror

                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> طول الكتف </label>
                                                                <input type="text" id="shoulder_length" class="form-control"
                                                                       name="shoulder_length" value="{{$size->shoulder_length}}">
                                                                @error('shoulder_length')
                                                                <span id="shoulder_length_error" class="text-danger">{{$message}}</span>
                                                                @enderror

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> عرض الظهر </label>
                                                                <input type="text" id="back_view" class="form-control"
                                                                       name="back_view" value="{{$size->back_view}}">
                                                                @error('back_view')
                                                                <span id="back_view_error" class="text-danger">{{$message}}</span>
                                                                @enderror

                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> طول الرقبة </label>
                                                                <input type="text" id="neck_length" class="form-control"
                                                                       name="neck_length" value="{{$size->neck_length}}">
                                                                @error('neck_length')
                                                                <span id="neck_length_error" class="text-danger">{{$message}}</span>
                                                                @enderror

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> عرض الرقبة </label>
                                                                <input type="text" id="neck_width" class="form-control"
                                                                       name="neck_width" value="{{$size->neck_width}}">
                                                                @error('neck_width')
                                                                <span id="neck_width_error" class="text-danger">{{$message}}</span>
                                                                @enderror

                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> محيط الرقبة </label>
                                                                <input type="text" id="neck_circumference" class="form-control"
                                                                       name="neck_circumference" value="{{$size->neck_circumference}}">
                                                                @error('neck_circumference')
                                                                <span id="neck_circumference_error" class="text-danger">{{$message}}</span>
                                                                @enderror

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> المسافة بين الثديين </label>
                                                                <input type="text" id="distance_between_breasts" class="form-control"
                                                                       name="distance_between_breasts" value="{{$size->distance_between_breasts}}">
                                                                @error('distance_between_breasts')
                                                                <span id="distance_between_breasts_error" class="text-danger">{{$message}}</span>
                                                                @enderror

                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> طول الذراع </label>
                                                                <input type="text" id="arm_length" class="form-control"
                                                                       name="arm_length" value="{{$size->arm_length}}">
                                                                @error('arm_length')
                                                                <span id="arm_length_error" class="text-danger">{{$message}}</span>
                                                                @enderror

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> محيط الذراع </label>
                                                                <input type="text" id="arm_circumference" class="form-control"
                                                                       name="arm_circumference" value="{{$size->arm_circumference}}">
                                                                @error('arm_circumference')
                                                                <span id="arm_circumference_error" class="text-danger">{{$message}}</span>
                                                                @enderror

                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> طول حردة الابط </label>
                                                                <input type="text" id="armpit_length" class="form-control"
                                                                       name="armpit_length" value="{{$size->armpit_length}}">
                                                                @error('armpit_length')
                                                                <span id="armpit_length_error" class="text-danger">{{$message}}</span>
                                                                @enderror

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-actions">
                                                    <a href="{{route('size.customer.index', $size->customer_id)}}" class="btn btn-warning mr-1" data-dismiss="modal">
                                                        <i class="la la-undo"></i> تراجع</a>
                                                    <button class="btn btn-primary" id="updateSize"><i class="la la-edit"></i> تحديث</button>
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


