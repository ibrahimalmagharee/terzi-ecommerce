@extends('layouts.admin')
@section('title')
    المقاسات
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> المقاسات </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a></li>
                                <li class="breadcrumb-item"><a href="{{route('index.customers')}}">العملاء </a></li>
                                <li class="breadcrumb-item active"> مقاسات - {{$customer->name}}</li>
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
                                       id="addNewSize"><i class="la la-plus"></i>  اضافة مقاس جديد</a>
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

                                <div class="card-content collapse show" id="viewCustomers">
                                    <div class="card-body card-dashboard table-responsive">
                                        <table class="table customer-size-table">
                                            <thead>
                                            <tr>
                                                <th>الاسم</th>
                                                <th>النوع</th>
                                                <th>العميل</th>
{{--                                                <th>المنتج</th>--}}
                                                <th>الاجراءات</th>

                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                        <div class="row mt-1">
                                            <div class="col-md-3">
                                                <input type="text" data-name="0" name="name" id="name_filter" class="form-control" placeholder="الاسم">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="email" data-email="1" name="email" id="email_filter" class="form-control" placeholder="الايميل">
                                            </div>

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

    <div class="modal fade modal-open" id="size-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content width-800">
                <div class="modal-header">
                    <h4 class="modal-title form-section" id="modalheader">
                        <i class="ft-home"></i> اضافة مقاس
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form class="form" id="sizeForm" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="customer_id" value="{{$customer->id}}">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> الاسم </label>
                                                <input type="text" id="name" class="form-control" placeholder="مثال:أحمد عبدالله"
                                                       name="name" value="{{old('name')}}">
                                                <span id="name_error" class="text-danger"></span>
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> محيط الصدر </label>
                                                <input type="text" id="chest_circumference" class="form-control"
                                                       name="chest_circumference" value="{{old('chest_circumference')}}">
                                                <span id="chest_circumference_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> محيط الخصر </label>
                                                <input type="text" id="waistline" class="form-control"
                                                       name="waistline" value="{{old('waistline')}}">
                                                <span id="waistline_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> محيط الأرداف </label>
                                                <input type="text" id="buttock_circumference" class="form-control"
                                                       name="buttock_circumference" value="{{old('buttock_circumference')}}">
                                                <span id="buttock_circumference_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> طول بنسة الصدر </label>
                                                <input type="text" id="length_by_chest" class="form-control"
                                                       name="length_by_chest" value="{{old('length_by_chest')}}">
                                                <span id="length_by_chest_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> طول الصدر </label>
                                                <input type="text" id="chest_length" class="form-control"
                                                       name="chest_length" value="{{old('chest_length')}}">
                                                <span id="chest_length_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> طول الكتف </label>
                                                <input type="text" id="shoulder_length" class="form-control"
                                                       name="shoulder_length" value="{{old('shoulder_length')}}">
                                                <span id="shoulder_length_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> عرض الظهر </label>
                                                <input type="text" id="back_view" class="form-control"
                                                       name="back_view" value="{{old('back_view')}}">
                                                <span id="back_view_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> طول الرقبة </label>
                                                <input type="text" id="neck_length" class="form-control"
                                                       name="neck_length" value="{{old('neck_length')}}">
                                                <span id="neck_length_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> عرض الرقبة </label>
                                                <input type="text" id="neck_width" class="form-control"
                                                       name="neck_width" value="{{old('neck_width')}}">
                                                <span id="neck_width_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> محيط الرقبة </label>
                                                <input type="text" id="neck_circumference" class="form-control"
                                                       name="neck_circumference" value="{{old('neck_circumference')}}">
                                                <span id="neck_circumference_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> المسافة بين الثديين </label>
                                                <input type="text" id="distance_between_breasts" class="form-control"
                                                       name="distance_between_breasts" value="{{old('distance_between_breasts')}}">
                                                <span id="distance_between_breasts_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> طول الذراع </label>
                                                <input type="text" id="arm_length" class="form-control"
                                                       name="arm_length" value="{{old('arm_length')}}">
                                                <span id="arm_length_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> محيط الذراع </label>
                                                <input type="text" id="arm_circumference" class="form-control"
                                                       name="arm_circumference" value="{{old('arm_circumference')}}">
                                                <span id="arm_circumference_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> طول حردة الابط </label>
                                                <input type="text" id="armpit_length" class="form-control"
                                                       name="armpit_length" value="{{old('armpit_length')}}">
                                                <span id="armpit_length_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-actions">
                                    <input type="hidden" name="action" id="action" value="Add">
                                    <button type="button" class="btn btn-warning mr-1" data-dismiss="modal"><i
                                            class="la la-undo"></i> تراجع
                                    </button>
                                    <button class="btn btn-primary" id="addSize"><i class="la la-save"></i> حفظ</button>
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
                        <h5>هل أنت متأكد من حذف هذا المقاس !!</h5>
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
            var customerSizeTable = $('.customer-size-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route("size.customer.index", $customer->id)}}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'category', name: 'category'},
                    {data: 'customer', name: 'customer'},
                    //{data: 'product', name: 'product'},
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
                        serverSide: false,
                        sheetName: 'Exported data',
                        footer: true ,
                        exportOptions: {
                            orthogonal: 'excel',
                        },
                    },

                ],
            });

            $('#name_filter').on('keyup',function(){
                customerSizeTable.column($(this).data('name')).search($(this).val()).draw();

            });



            //Show Form
            $('#addNewSize').click(function () {
                $('#sizeForm').trigger('reset');
                $('#size-modal').modal('show');

            });


            //Add Or Update
            $(document).on('click', '#addSize', function (e) {
                e.preventDefault();
                var formData = new FormData($('#sizeForm')[0]);
                $('#name_error').text('');
                $('#category_id_error').text('');
                $('#chest_circumference_error').text('');
                $('#waistline_error').text('');
                $('#buttock_circumference_error').text('');
                $('#length_by_chest_error').text('');
                $('#chest_length_error').text('');
                $('#shoulder_length_error').text('');
                $('#back_view_error').text('');
                $('#neck_length_error').text('');
                $('#neck_width_error').text('');
                $('#neck_circumference_error').text('');
                $('#distance_between_breasts_error').text('');
                $('#arm_length_error').text('');
                $('#arm_circumference_error').text('');
                $('#armpit_length_error').text('');

                $.ajax({
                    type: 'post',
                    url: "{{ route('size.save.customer') }}",
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true) {
                            toastr.success(data.msg);
                            $('#sizeForm').trigger('reset');
                            $('#size-modal').modal('hide');
                            customerSizeTable.draw();
                        } else {
                            toastr.error(data.msg);
                            $('#sizeForm').trigger('reset');
                            $('#size-modal').modal('hide');
                            customerSizeTable.draw();
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

            //Delete

            $('body').on('click', '.deleteSize', function () {
                var id = $(this).data('id');
                $('#delete-modal').modal('show');

                $('#delete').click(function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'post',
                        url: "{{route('size.delete.customer')}}" ,
                        data: {
                            'id': id,
                        },
                        // processData: false,
                        // contentType: false,
                        cache: false,
                        dataType: 'json',

                        success: function (data) {
                            console.log('success:', data);
                            if (data.status == true) {
                                $('#delete-modal').modal('hide');
                                toastr.warning(data.msg);
                                customerSizeTable.draw();
                            }

                        }

                    });
                });

                $('#cancel').click(function () {
                    $('#delete-modal').modal('hide');
                });
            });

        });
    </script>
@endsection
