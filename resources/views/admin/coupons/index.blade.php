@extends('layouts.admin')
@section('title')
    أكواد الخصم
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> أكواد الخصم </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a></li>
                                <li class="breadcrumb-item active">  أكواد الخصم</li>
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
                                       id="addNewCopon"><i class="la la-plus"></i>  اضافة كود جديد</a>
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

                                <div class="card-content collapse show" id="viewCopons">
                                    <div class="card-body card-dashboard table-responsive">
                                        <table class="table copon-table">
                                            <thead>
                                            <tr>
                                                <th>التاجر</th>
                                                <th>الكود</th>
                                                <th>النوع</th>
                                                <th>نسبة الخصم</th>
                                                <th>تاريخ الانتهاء</th>
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
                                                        @isset($vendors)
                                                            @foreach($vendors as $vendor)
                                                                <option value="{{$vendor->name}}">{{$vendor->name}}</option>
                                                            @endforeach
                                                        @endisset
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" data-code="1" name="code" id="code_filter" class="form-control" placeholder="الكود">
                                            </div>
                                            <div class="col-md-3">
                                                <select name="type" data-type="2" id="type_filter" class="select2 form-control">
                                                    <optgroup label="الرجاء اختر نوع الكوبون">
                                                        <option value="">نوع الكوبون</option>
                                                        <option value="نسبة">نسبة</option>
                                                        <option value="قيمة ثابتة">قيمة ثابتة</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" data-percent_discount="3" name="percent_discount" id="percent_discount_filter" class="form-control" placeholder="نسبة الخصم">
                                            </div>
                                            <div class="col-md-3 mt-1">
                                                <input type="date" data-end="4" name="end_datetime" id="end_datetime_filter" class="form-control">
                                            </div>
                                            <div class="col-md-3 mt-1">
                                                <select  data-status="5" name="status" id="status_filter" class="select2 form-control">
                                                    <optgroup label="الرجاء اختر الحالة">
                                                        <option value="">الحالة</option>
                                                        <option value="1">مفعل</option>
                                                        <option value="0">غير مفعل</option>
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

    <div class="modal fade modal-open" id="copon-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content width-800">
                <div class="modal-header">
                    <h4 class="modal-title form-section" id="modalheader">
                        <i class="ft-home"></i> اضافة كود الخصم
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form class="form" id="coponForm" enctype="multipart/form-data">
                                @csrf

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput2">اختر التاجر</label>
                                                <select name="vendor_id" id="vendor_id" class="select2 form-control width-350">
                                                    <optgroup label="الرجاء اختر التاجر">
                                                        @isset($vendors)
                                                            @foreach($vendors as $vendor)
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
                                                <label for="projectinput1"> الكود </label>
                                                <input type="text" id="code" class="form-control" placeholder="a@#$12c"
                                                       name="code" value="{{old('code')}}">
                                                <span id="code_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput2">نوع الكوبون</label>
                                                <select name="type" id="type" class="select2 form-control width-350">
                                                    <optgroup label="الرجاء اختر نوع الكوبون">
                                                        <option value="1">نسبة</option>
                                                        <option value="2">قيمة ثابتة</option>
                                                    </optgroup>
                                                </select>
                                                <span id="type_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> نسبة الخصم </label>
                                                <input type="text" id="percent_discount" class="form-control" placeholder="خصم 10%"
                                                       name="percent_discount" value="{{old('percent_discount')}}">
                                                <span id="percent_discount_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput2">تاريخ البداية</label>
                                                <input type="datetime-local" name="start_datetime" id="start_datetime" class="form-control" value="{{old('start_datetime')}}">
                                                <span id="start_datetime_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">  تاريخ النهاية </label>
                                                <input type="datetime-local" name="end_datetime" id="end_datetime" class="form-control" value="{{old('end_datetime')}}">
                                                <span id="end_datetime_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mt-1">
                                                <label for="switcheryColor4" class="card-title ml-1">الحالة</label>
                                                <input type="checkbox" name="status" value="1" id="switcheryColor4"
                                                       class="switchery active" data-color="success" checked/>

                                                <span id="status_error" class="text-danger"></span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="hidden" name="action" id="action" value="Add">
                                    <button type="button" class="btn btn-warning mr-1" data-dismiss="modal"><i
                                            class="la la-undo"></i> تراجع
                                    </button>
                                    <button class="btn btn-primary" id="addCopon"><i class="la la-save"></i> حفظ</button>
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
                        <h5>هل أنت متأكد من حذف هذا الكود !!</h5>
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
            var coponTable = $('.copon-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route("index.coupons")}}",
                columns: [
                    {data: 'vendor_id', name: 'vendor_id'},
                    {data: 'code', name: 'code'},
                    {data: 'type', name: 'type'},
                    {data: 'percent_discount', name: 'percent_discount'},
                    {data: 'end_datetime', name: 'end_datetime'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                language:{"url" :"{{asset('/public/assets/admin/js/dataTableArabic.json')}}"}
            });

            $('select[name="vendor"]').on('change',function(){
                coponTable.column($(this).data('vendor')).search($(this).val()).draw();

            });

            $('#code_filter').on('keyup',function(){
                coponTable.column($(this).data('code')).search($(this).val()).draw();

            });

            $('select[name="type"]').on('change',function(){
                coponTable.column($(this).data('type')).search($(this).val()).draw();

            });

            $('#percent_discount_filter').on('keyup',function(){
                coponTable.column($(this).data('percent_discount')).search($(this).val()).draw();

            });

            $('#end_datetime_filter').on('change',function(){
                coponTable.column($(this).data('end')).search($(this).val()).draw();

            });

            $('select[name="status"]').on('change',function(){
                coponTable.column($(this).data('status')).search($(this).val()).draw();

            });



            //Show Form
            $('#addNewCopon').click(function () {
                $('#coponForm').trigger('reset');
                $('#copon-modal').modal('show');

            });


            //Add Or Update
            $(document).on('click', '#addCopon', function (e) {
                e.preventDefault();
                var formData = new FormData($('#coponForm')[0]);
                $('#vendor_id_error').text('');
                $('#code_error').text('');
                $('#type-error').text('');
                $('#percent_discount_error').text('');
                $('#start_datetime_error').text('');
                $('#end_datetime_error').text('');

                $.ajax({
                    type: 'post',
                    url: "{{ route('save.coupon') }}",
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true) {
                            toastr.success(data.msg);
                            $('#coponForm').trigger('reset');
                            $('#copon-modal').modal('hide');
                            coponTable.draw();
                        } else {
                            toastr.error(data.msg);
                            $('#coponForm').trigger('reset');
                            $('#copon-modal').modal('hide');
                            coponTable.draw();
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

            $('body').on('click', '.deleteCopon', function () {
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
                                coponTable.draw();
                            }

                        }

                    });
                });

                $('#cancel').click(function () {
                    $('#delete-modal').modal('hide');
                });
            });

            $(document).on('change', '.is_active', function () {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let coupon_id = $(this).data('id');
                console.log(status);
                console.log(coupon_id);
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: '{{ route('updateStatus.coupon') }}',
                    data: {'status': status, 'coupon_id': coupon_id},
                    success: function (data) {
                        toastr.success(data.msg);
                    }
                });
            });



        });
    </script>
@endsection
