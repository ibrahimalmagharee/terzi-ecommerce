@extends('layouts.admin')
@section('title')
   التجار
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> التجار </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a></li>
                                <li class="breadcrumb-item active"> التجار</li>
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
                                       id="addNewVendor"><i class="la la-plus"></i>  اضافة تاجر جديد</a>
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

                                <div class="card-content collapse show" id="viewVendors">
                                    <div class="card-body card-dashboard table-responsive">
                                        <table class="table vendor-table">
                                            <thead>
                                            <tr>
                                                <th>اسم الشركة</th>
                                                <th>موقع الشركة</th>
                                                <th>رقم السجل التجاري</th>
                                                <th>رقم الجوال</th>
                                                <th>الهوية الوطنية</th>
                                                <th>الايميل</th>
                                                <th>نوع النشاط</th>
                                                <th>تغيير كلمة المرور</th>
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
                                                <input type="text" data-location="1" name="location" id="location_filter" class="form-control" placeholder="العنوان">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" data-commercial="2" name="commercial_registration_No" id="commercial_registration_No_filter" class="form-control" placeholder="رقم السجل التجاري">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" data-mobile="3" name="mobile_No" id="mobile_No_filter" class="form-control" placeholder="رقم الجوال">
                                            </div>
                                            <div class="col-md-3 mt-1">
                                                <input type="text" data-national="4" name="national_Id" id="national_Id_filter" class="form-control" placeholder="رقم الهوية">
                                            </div>
                                            <div class="col-md-3 mt-1">
                                                <input type="email" data-email="5" name="email" id="email_filter" class="form-control" placeholder="الايميل">
                                            </div>
                                            <div class="col-md-3 mt-1">
                                                <select name="type_activity" data-type_activity="6" id="type_activity_filter" class="select form-control">
                                                    <optgroup label="حدد نوع النشاط">
                                                        <option value="">نوع النشاط</option>
                                                        <option value="تفصيل">تفصيل</option>
                                                        <option value="أقمشة">أقمشة</option>
                                                        <option value="الاثنين معا">الاثنين معا</option>
                                                    </optgroup>
                                                </select>
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

    <div class="modal fade modal-open" id="vendor-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content width-800">
                <div class="modal-header">
                    <h4 class="modal-title form-section" id="modalheader">
                        <i class="ft-home"></i> اضافة تاجر
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form class="form" id="vendorForm" enctype="multipart/form-data">
                                @csrf

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> اسم الشركة </label>
                                                <input type="text" id="name" class="form-control" placeholder="مثال:شركة المدينة المنورة"
                                                       name="name" value="{{old('name')}}">
                                                <span id="name_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> موقع الشركة </label>
                                                <input type="text" id="location" class="form-control" placeholder="مثال:الرياض"
                                                       name="location" value="{{old('location')}}">
                                                <span id="location_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> رقم السجل النجاري </label>
                                                <input type="number" id="commercial_registration_No" class="form-control" placeholder="مثال:5658"
                                                       name="commercial_registration_No" value="{{old('commercial_registration_No')}}">
                                                <span id="commercial_registration_No_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> رقم الجوال </label>
                                                <input type="number" id="mobile_No" class="form-control" placeholder="مثال:0599664473"
                                                       name="mobile_No" value="{{old('mobile_No')}}">
                                                <span id="mobile_No_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> الهوية الوطنية </label>
                                                <input type="number" id="national_Id" class="form-control" placeholder="مثال:505990014"
                                                       name="national_Id" value="{{old('national_Id')}}">
                                                <span id="national_Id_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> الايميل </label>
                                                <input type="email" id="email" class="form-control" placeholder="مثال:almadina@gmail.com"
                                                       name="email" value="{{old('email')}}">
                                                <span id="email_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput2"> نوع النشاط </label>
                                                <select name="type_activity" id="type_activity" class="select form-control">
                                                    <optgroup label="حدد نوع النشاط">
                                                        <option value="تفصيل">تفصيل</option>
                                                        <option value="أقمشة">أقمشة</option>
                                                        <option value="الاثنين معا">الاثنين معا</option>
                                                    </optgroup>
                                                </select>
                                                <span id="type_activity_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">كلمة المرور </label>
                                                <input type="password" id="password" class="form-control" placeholder="مثال:******"
                                                       name="password" value="{{old('password')}}">
                                                <span id="password_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> تأكيد كلمة المرور </label>
                                                <input type="password" id="password_confirmation" class="form-control" placeholder="مثال:******"
                                                       name="password_confirmation" value="{{old('password_confirmation')}}">
                                                <span id="password_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-actions">
                                    <input type="hidden" name="action" id="action" value="Add">
                                    <button type="button" class="btn btn-warning mr-1" data-dismiss="modal"><i
                                            class="la la-undo"></i> تراجع
                                    </button>
                                    <button class="btn btn-primary" id="addVendor"><i class="la la-save"></i> حفظ</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- End Form Add Main Category -->

    <div class="modal fade modal-open" id="change_password_vendor_modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content width-500">
                <div class="modal-header">
                    <h4 class="modal-title form-section" id="modalheader">
                        <i class="ft-home"></i> تغيير كلمة المرور
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form class="form" id="changePasswordVendorForm" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" id="id">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput1">كلمة المرور القديمة </label>
                                                <input type="password" id="old_password" class="form-control" placeholder="مثال:******"
                                                       name="old_password" value="">
                                                <span id="old_password_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput1">كلمة المرور الجديدة </label>
                                                <input type="password" id="new_password" class="form-control" placeholder="مثال:******"
                                                       name="new_password" value="">
                                                <span id="new_password_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput1"> تأكيد كلمة المرور </label>
                                                <input type="password" id="new_password_confirmation" class="form-control" placeholder="مثال:******"
                                                       name="new_password_confirmation" value="">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-actions">
                                    <input type="hidden" name="action" id="action" value="Add">
                                    <button type="button" class="btn btn-warning mr-1" data-dismiss="modal"><i
                                            class="la la-undo"></i> تراجع
                                    </button>
                                    <button class="btn btn-primary" id="changePassword"><i class="la la-save"></i> تغيير كلمة المرور</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                        <h5>هل أنت متأكد من حذف هذا التاجر !!</h5>
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
            var vendorTable = $('.vendor-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route("index.vendors")}}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'location', name: 'location'},
                    {data: 'commercial_registration_No', name: 'commercial_registration_No'},
                    {data: 'mobile_No', name: 'mobile_No'},
                    {data: 'national_Id', name: 'national_Id'},
                    {data: 'email', name: 'email'},
                    {data: 'type_activity', name: 'type_activity'},
                    {data: 'changePassword', name: 'changePassword'},
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
                            columns: [ 0, 1, 2,3,4, 5,6 ],
                            modifier: {
                                order : 'applied',
                                page: 'all',
                            },
                        },
                    },
                    // {
                    //     extend: 'pdfHtml5',
                    // }

                ],
            });

            $('#name_filter').on('keyup',function(){
                vendorTable.column($(this).data('name')).search($(this).val()).draw();

            });

            $('#location_filter').on('keyup',function(){
                vendorTable.column($(this).data('location')).search($(this).val()).draw();

            });

            $('#commercial_registration_No_filter').on('keyup',function(){
                vendorTable.column($(this).data('commercial')).search($(this).val()).draw();

            });

            $('#mobile_No_filter').on('keyup',function(){
                vendorTable.column($(this).data('mobile')).search($(this).val()).draw();

            });

            $('#national_Id_filter').on('keyup',function(){
                vendorTable.column($(this).data('national')).search($(this).val()).draw();

            });

            $('#email_filter').on('keyup',function(){
                vendorTable.column($(this).data('email')).search($(this).val()).draw();

            });

            $('select[name="type_activity"]').on('change',function(){
                vendorTable.column($(this).data('type_activity')).search($(this).val()).draw();

            });


            //Show Form
            $('#addNewVendor').click(function () {
                $('#vendorForm').trigger('reset');
                $('#vendor-modal').modal('show');

            });


            //Add Or Update
            $(document).on('click', '#addVendor', function (e) {
                e.preventDefault();
                var formData = new FormData($('#vendorForm')[0]);
                $('#name_error').text('');
                $('#location_error').text('');
                $('#commercial_registration_No_error').text('');
                $('#mobile_No_error').text('');
                $('#national_Id_error').text('');
                $('#email_error').text('');
                $('#type_activity_error').text('');
                $('#password_error').text('');
                $.ajax({
                    type: 'post',
                    url: "{{ route('save.vendor') }}",
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true) {
                            toastr.success(data.msg);
                            $('#vendorForm').trigger('reset');
                            $('#vendor-modal').modal('hide');
                            vendorTable.draw();
                        } else {
                            toastr.error(data.msg);
                            $('#vendorForm').trigger('reset');
                            $('#vendor-modal').modal('hide');
                            vendorTable.draw();
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

            $('body').on('click', '.deleteVendor', function () {
                var id = $(this).data('id');
                $('#delete-modal').modal('show');

                $('#delete').click(function (e) {
                    e.preventDefault();
                    $.ajax({

                        url: "delete/" + id,

                        success: function (data) {
                            console.log('success:', data);
                            if (data.status === true) {
                                $('#delete-modal').modal('hide');
                                toastr.warning(data.msg);
                                vendorTable.draw();
                            }

                        }

                    });
                });

                $('#cancel').click(function () {
                    $('#delete-modal').modal('hide');
                });
            });

            // change password

            $('body').on('click', '.changePasswordVendor', function () {
                var id = $(this).data('id');
                $('#change_password_vendor_modal').modal('show');
                $('#id').val(id);
                $('#changePassword').click(function (e) {
                    e.preventDefault();
                    $('#old_password_error').text('');
                    $('#new_password_error').text('');
                    var formData = new FormData($('#changePasswordVendorForm')[0]);
                    $.ajax({
                        type: 'post',
                        url: "{{ route('change.password.vendor') }}",
                        enctype: 'multipart/form-data',
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        dataType: 'json',

                        success: function (data) {
                            console.log('success:', data);
                            if (data.status === true) {
                                toastr.success(data.msg);
                                $('#changePasswordVendorForm').trigger('reset');
                                $('#change_password_vendor_modal').modal('hide');
                                vendorTable.draw();
                            } else {
                                toastr.error(data.msg);
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

            });

        });
    </script>
@endsection
