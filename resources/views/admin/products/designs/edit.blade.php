@extends('layouts.admin')
@section('title')
    تعديل|منتج-{{$design->name}}
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
                                    <a href="{{route('index.vendors')}}">التفصيل  </a>

                                </li>
                                <li class="breadcrumb-item active"> تعديل -
                                    {{$design->name}}</li>
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
                                            {{$design->name}} </strong></h4>
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
                                                  action="{{route('update.design',$design->id)}}"
                                                  id="designForm" enctype="multipart/form-data">
                                                @csrf
                                                <h4 class="form-section"><i
                                                        class="ft-home"></i> تعديل - {{$design->name}}
                                                </h4>
                                                <input type="hidden" name="id" value="{{$design->id}}">
                                                <div class="form-group">
                                                    <div class="text-center">
                                                        @foreach($design->images as $image)
                                                            <img src="{{$image->getPhotoDesign($image->photo)}}" alt="photo"
                                                                 class="height-150">
                                                            @endforeach

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div id="photo1">
                                                            <div class="form-body">

                                                                <h4 class="form-section"> صور المنتج <span class="text-danger">( يجب أن تكون عرض الصورة 322px و طول الصورة 280px )</span></h4>
                                                                <div class="form-group">
                                                                    <div id="dpz-multiple-files" class="dropzone dropzone-area">
                                                                        <div class="dz-message">يمكنك رفع اكثر من صوره هنا</div>
                                                                    </div>
                                                                    <br><br>
                                                                </div>


                                                            </div>
                                                        </div>
                                                        @error('photo')
                                                        <span id="photo_error" class="text-danger">{{$message}} </span>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2">اختر التاجر</label>
                                                                <select name="vendor_id" id="vendor_id" class="select2 form-control width-360">
                                                                    <optgroup label="الرجاء اختر التاجر">
                                                                        @isset($data['vendors'])
                                                                            @foreach($data['vendors'] as $vendor)
                                                                                <option value="{{$vendor->id}}" @if($design->product->vendor_id == $vendor->id) selected @endif>{{$vendor->name}}</option>
                                                                            @endforeach
                                                                        @endisset
                                                                    </optgroup>
                                                                </select>

                                                                @error('vendor_id')
                                                                <span id="vendor_id_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1">الاسم</label>
                                                                <input type="text" id="name" class="form-control" placeholder=""
                                                                       name="name" value="{{$design->name}}">

                                                                @error('name')
                                                                <span id="name_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2">النوع</label>
                                                                <select name="type_id" id="type" class="form-control">
                                                                    <optgroup label="الرجاء اختر نوع الملابس">
                                                                        @isset($data['types'])
                                                                            @foreach($data['types'] as $type)
                                                                                <option value="{{$type->id}}" @if($design->type_id == $type->id) selected @endif>{{$type->name}}</option>
                                                                            @endforeach
                                                                        @endisset
                                                                    </optgroup>
                                                                </select>
                                                                @error('type_id')
                                                                <span id="type_id_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2">اختر القسم</label>
                                                                <select name="category_id" id="category_id" class="form-control">
                                                                    <optgroup label="الرجاء اختر القسم">
                                                                        @isset($data['categories'] )
                                                                            @foreach($data['categories'] as $category)

                                                                                <option value="{{$category->id}}" @if($design->product->category_id == $category->id) selected @endif>{{$category->name}}</option>

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
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> وصف المنتج</label>
                                                                <textarea name="description" id="short-description" cols="3" rows="6"
                                                                          class="form-control" placeholder="سيتطلع المشتري على تفاصيل المنتج لاخاصة">{{$design->description}}</textarea>
                                                            </div>
                                                            @error('description')
                                                            <span id="description_error" class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1">السعر</label>
                                                                <input type="number" step="any" id="price" class="form-control" placeholder="300"
                                                                       name="price" value="{{$design->product->price}}">

                                                                @error('price')
                                                                <span id="price_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> العرض</label>
                                                                <input type="text" id="offer" class="form-control" placeholder="لا يوجد عرض / نسبة الخصم :10"
                                                                       name="offer" value="{{$design->product->offer}}">

                                                                @error('offer')
                                                                <span id="offer_error" class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-actions">
                                                    <a href="{{route('index.designs')}}" class="btn btn-warning mr-1" data-dismiss="modal"><i
                                                            class="la la-undo"></i> تراجع
                                                    </a>
                                                    <button class="btn btn-primary" id="updateDesign"><i class="la la-edit"></i> تحديث</button>
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
@section('script')
    <script type="text/javascript">


        var uploadedDocumentMap = {}

        Dropzone.options.dpzMultipleFiles = {
            paramName: "dzfile", // The name that will be used to transfer the file
            //autoProcessQueue: false,
            maxFilesize: 5, // MB
            clickable: true,
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            dictFallbackMessage: " المتصفح الخاص بكم لا يدعم خاصيه تعدد الصوره والسحب والافلات ",
            dictInvalidFileType: "لايمكنك رفع هذا النوع من الملفات ",
            dictCancelUpload: "الغاء الرفع ",
            dictCancelUploadConfirmation: " هل انت متاكد من الغاء رفع الملفات ؟ ",
            dictRemoveFile: "حذف الصوره",
            dictMaxFilesExceeded: "لايمكنك رفع عدد اكثر من هضا ",
            headers: {
                'X-CSRF-TOKEN':
                    "{{ csrf_token() }}"
            }
            ,
            url: "{{route('save.images.design.inFolder')}}", // Set the url
            success:
                function (file, response) {
                    $('form').append('<input type="hidden" name="images[]" id="photo" value="' + response.name + '">')
                    uploadedDocumentMap[file.name] = response.name
                }
            ,

            removedfile: function(file)
            {
                var name = file.upload.filename;

                $.ajax({
                    type: 'POST',
                    url: '{{route('delete.image.design.fromFolder')}}',
                    data: {filename:name},

                    success: function(file, name)
                    {
                        console.log(name);
                        file.upload.filename=name;
                    },
                    error: function(e) {
                        console.log(e);
                    }});
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },

            // previewsContainer: "#dpz-btn-select-files", // Define the container to display the previews
            init: function () {
                    @if(isset($event) && $event->images)
                var files;
                {!! json_encode($event->images) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="images[]" id="photo" value="' + file.file_name + '">')
                }
                @endif
            }
        }
    </script>
@endsection


