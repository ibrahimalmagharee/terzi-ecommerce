@extends('layouts.admin')
@section('title')
    منتجات التصاميم
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> التصاميم </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a></li>
                                <li class="breadcrumb-item active"> التصاميم</li>
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
                                    <a class="btn btn-outline-success float-left" href="javascript:void(0)"
                                       id="addNewDesign"><i class="la la-plus"></i>  اضافة تصميم جديد</a>
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

                                <div class="card-content collapse show" id="viewDesigns">
                                    <div class="card-body card-dashboard table-responsive">
                                        <table class="table design-table">
                                            <thead>
                                            <tr>
                                                <th>التاجر</th>
                                                <th>الاسم</th>
                                                <th>النوع</th>
                                                <th>القسم</th>
                                                <th>السعر</th>
                                                <th>العرض</th>
                                                <th>الحالة</th>
                                                <th>الاجراءات</th>

                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                        <div class="row mt-1">
                                            <div class="col-md-3">
                                                <select name="vendor" data-vendor="0" id="vendor_id" class="form-control">
                                                    <optgroup label="الرجاء اختر التاجر">
                                                        <option value="">اختر التاجر</option>
                                                        @isset($data['vendors'])
                                                            @foreach($data['vendors'] as $vendor)
                                                                <option value="{{$vendor->name}}">{{$vendor->name}}</option>
                                                            @endforeach
                                                        @endisset
                                                    </optgroup>
                                                </select>                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" data-name="1" name="name" id="name_filter" class="form-control" placeholder="اسم المنتج">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" data-type="2" name="type" id="type_filter" class="form-control" placeholder="النوع">
                                            </div>
                                            <div class="col-md-3">
                                                <select name="category_id" data-category_id="3" id="category_id_filter" class="form-control">
                                                    <optgroup label="الرجاء اختر القسم">
                                                        <option value="">اختر القسم</option>
                                                        @isset($data['categories'] )
                                                            @foreach($data['categories'] as $category)

                                                                <option value="{{$category->name}}">{{$category->name}}</option>
                                                            @endforeach
                                                        @endisset
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mt-1">
                                                <input type="text" data-price="4" name="price" id="price_filter" class="form-control" placeholder="السعر">
                                            </div>
                                            <div class="col-md-3 mt-1">
                                                <input type="text" data-offer="5" name="offer" id="offer_filter" class="form-control" placeholder="العرض">
                                            </div>
{{--                                            <div class="col-md-3 mt-1">--}}
{{--                                                <select data-status="6" name="status" id="status_filter" class="form-control">--}}
{{--                                                    <optgroup label="الرجاء اختر حالة المنتج">--}}
{{--                                                        <option value="">اختر حالة المنتج</option>--}}
{{--                                                        <option value="نشر">نشر</option>--}}
{{--                                                        <option value="الغاء النشر">الغاء النشر</option>--}}

{{--                                                    </optgroup>--}}
{{--                                                </select>--}}
{{--                                            </div>--}}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Begin Form Add Main Category -->

    <div class="modal fade modal-open" id="design-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content width-800">
                <div class="modal-header">
                    <h4 class="modal-title form-section" id="modalheader">
                        <i class="ft-home"></i> اضافة منتج تصميم
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form class="form" id="designForm" enctype="multipart/form-data">
                                @csrf

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
                                        <span id="photo_error" class="text-danger"> </span>
                                    </div>
                                </div>

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput2">اختر التاجر</label>
                                                <select name="vendor_id" id="vendor_id" class="select2 form-control width-350">
                                                    <optgroup label="الرجاء اختر التاجر">
                                                        @isset($data['vendors'])
                                                            @foreach($data['vendors'] as $vendor)
                                                                <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                                                @endforeach
                                                            @endisset
                                                    </optgroup>
                                                </select>
                                                <span id="vendor_id_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">الاسم</label>
                                                <input type="text" id="name" class="form-control" placeholder=""
                                                       name="name" value="{{old('name')}}">
                                                <span id="name_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput2">النوع</label>
                                                <select name="type_id" id="type_id" class="form-control">
                                                    <optgroup label="الرجاء اختر نوع الملابس">
                                                        @isset($data['types'])
                                                            @foreach($data['types'] as $type)
                                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                                            @endforeach
                                                        @endisset
                                                    </optgroup>
                                                </select>
                                                <span id="type_id_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput2">اختر القسم</label>
                                                <select name="category_id" id="category_id" class="form-control">
                                                    <optgroup label="الرجاء اختر القسم">
                                                        @isset($data['categories'] )
                                                            @foreach($data['categories'] as $category)

                                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                            @endforeach
                                                        @endisset
                                                    </optgroup>
                                                </select>
                                                <span id="category_id_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput1"> وصف المنتج</label>
                                                <textarea name="description" id="short-description" cols="3" rows="6"
                                                          class="form-control" placeholder="سيتطلع المشتري على تفاصيل المنتج لاخاصة"></textarea>
                                            </div>
                                            <span id="description_error" class="text-danger"></span>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">السعر</label>
                                                <input type="number" step="any" id="price" class="form-control" placeholder="300"
                                                       name="price" value="{{old('price')}}">
                                                <span id="price_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput2"> العرض</label>
                                                <input type="text" id="offer" class="form-control" placeholder="لا يوجد عرض / نسبة الخصم :10"
                                                       name="offer" value="{{old('offer')}}">
                                                <span id="offer_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <input type="hidden" name="action" id="action" value="Add">
                                    <button type="button" class="btn btn-warning mr-1" data-dismiss="modal"><i
                                            class="la la-undo"></i> تراجع
                                    </button>
                                    <button class="btn btn-primary" id="addDesign"><i class="la la-save"></i> حفظ</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Form Add Main Category -->



    <!-- // Basic form layout section end -->



    {{-- Confirmation Modal --}}
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">تأكيد عملية الحذف</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="delete_modal_form">
                    @csrf
                    {{method_field('delete')}}

                    <div class="modal-body">
                        <input type="hidden" id="delete_language">
                        <h5>هل أنت متأكد من حذف هذا التصميم !!</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">الغاء</button>
                        <button type="submit" class="btn btn-danger" id="delete">حذف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Confirmation Modal --}}


@endsection

@section('script')
    <script type="text/javascript">

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //Show Table
            var designTable = $('.design-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route("index.designs")}}",
                columns: [
                    {data: 'vendor_id', name: 'vendor_id'},
                    {data: 'name', name: 'name'},
                    {data: 'type_id', name: 'type_id'},
                    {data: 'category_id', name: 'category_id'},
                    {data: 'price', name: 'price'},
                    {data: 'offer', name: 'offer'},
                    {data: 'status', name: 'status'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                language:{"url" :"{{asset('/public/assets/admin/js/dataTableArabic.json')}}"},
                "dom":  '<"rt-buttons"Bf><"clear">ltip',
                "paging": true,
                "autoWidth": true,
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'اكسيل',
                        autoFilter: true,
                        sheetName: 'Exported data',
                        footer: true ,
                        exportOptions: {
                            orthogonal: 'excel',
                        },
                    },

                ],
            });

            $('select[name="vendor"]').on('change',function(){
                designTable.column($(this).data('vendor')).search($(this).val()).draw();

            });

            $('#name_filter').on('keyup',function(){
                designTable.column($(this).data('name')).search($(this).val()).draw();

            });

            $('#type_filter').on('keyup',function(){
                designTable.column($(this).data('type')).search($(this).val()).draw();

            });

            $('select[name="category_id"]').on('change',function(){
                designTable.column($(this).data('category_id')).search($(this).val()).draw();

            });

            $('#price_filter').on('keyup',function(){
                designTable.column($(this).data('price')).search($(this).val()).draw();

            });

            $('#offer_filter').on('keyup',function(){
                designTable.column($(this).data('offer')).search($(this).val()).draw();

            });

            $('select[name="status"]').on('change',function(){
                designTable.column($(this).data('status')).search($(this).val()).draw();

            });

            // $('#status_filter').on('keyup',function(){
            //     designTable.column($(this).data('status')).search($(this).val()).draw();
            //
            // });


            //Show Form
            $('#addNewDesign').click(function () {
                $('#designForm').trigger('reset');
                $('#design-modal').modal('show');

            });


            //Add Or Update
            $(document).on('click', '#addDesign', function (e) {
                e.preventDefault();
                var formData = new FormData($('#designForm')[0]);
                console.log($('#photo').val());
                $('#vendor_id_error').text('');
                $('#name_error').text('');
                $('#type_id_error').text('');
                $('#category_id_error').text('');
                $('#description_error').text('');
                $('#photo_error').text('');
                $('#price_error').text('');
                $('#offer_error').text('');
                $.ajax({
                    type: 'post',
                    url: "{{ route('save.design') }}",
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true) {
                            toastr.success(data.msg);
                            $('#designForm').trigger('reset');
                            $('#design-modal').modal('hide');
                            designTable.draw();
                        } else {
                            toastr.error('لم تتم اضافة المنتج');
                            $('#designForm').trigger('reset');
                            $('#design-modal').modal('hide');
                            designTable.draw();
                        }

                    },

                    error: function (reject) {
                        console.log('Error: not added', reject);
                        var response = $.parseJSON(reject.responseText);
                        $.each(response.errors, function (key, val) {
                            $("#" + key + "_error").text(val[0]);


                        });

                    }

                });
            });

            $(document).on('click', '.changeStatus', function (e) {
                e.preventDefault();

                var status = $(this).data('status');
                var product_id = $(this).data('id');

                console.log('product_id' + product_id + '  status' + status);
                $.ajax({
                    type: 'post',
                    url: "{{ route('changeStatus.design') }}",
                    data: {'product_id': product_id, 'status': status},
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true){
                            toastr.success(data.msg);
                            if (data.product_status == 1) {
                                if (data.product_type === 'App\\Models\\Design') {
                                    $('#published_'+product_id).addClass('display');
                                    $('#published_'+product_id).removeClass('hidden');
                                    $('#published_'+product_id).attr('data-status', data.product_status);
                                    $('#un_published_'+product_id).attr('data-status', data.product_status);
                                    $('#un_published_'+product_id).addClass('hidden');

                                }

                            } else if(data.product_status == 0) {
                                if (data.product_type === 'App\\Models\\Design') {
                                    $('#published_'+product_id).addClass('hidden');
                                    $('#un_published_'+product_id).addClass('display');
                                    $('#un_published_'+product_id).removeClass('hidden');
                                    $('#published_'+product_id).attr('data-status', data.product_status);
                                    $('#un_published_'+product_id).attr('data-status', data.product_status);

                                }


                            }
                        }



                    },


                });
            });

            //Delete

            $('body').on('click', '.deleteDesign', function () {
                var id = $(this).data('id');
                $('#delete-modal').modal('show');

                $('#delete').click(function (e) {
                    e.preventDefault();
                    $.ajax({

                        url: "delete/" + id,

                        success: function (data) {
                            console.log('success:', data);
                            if (data.status == true) {
                                $('#delete-modal').modal('hide');
                                toastr.warning(data.msg);
                                designTable.draw();
                            }

                        }

                    });
                });

                $('#cancel').click(function () {
                    $('#delete-modal').modal('hide');
                });
            });

        });

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
