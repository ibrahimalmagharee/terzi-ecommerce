@extends('layouts.admin')
@section('title')
    شعار الشركة
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">شعار الشركة</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a></li>
                                <li class="breadcrumb-item"><a href="{{route('index.vendors')}}">التجار </a></li>
                                <li class="breadcrumb-item active">شعار الشركة</li>
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
                                       id="addNewLogoVendor"><i class="la la-plus"></i>  اضافة شعار جديد</a>
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
                                        <table class="table logoVendor-table">
                                            <thead>
                                            <tr>
                                                <th>اسم الشركة</th>
                                                <th>الشعار</th>
                                                <th>الاجراءات</th>

                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                        <div class="row mt-1">
                                            <div class="col-md-3">
                                                <select name="vendor" data-vendor="0" id="vendor_id" class="select2 form-control width-350">
                                                    <optgroup label="الرجاء اختر التاجر">
                                                        <option value="">اختر التاجر</option>
                                                        @isset($data['vendors'])
                                                            @foreach($data['vendors'] as $vendor)
                                                                <option value="{{$vendor->name}}">{{$vendor->name}}</option>
                                                            @endforeach
                                                        @endisset
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

    <div class="modal fade modal-open" id="logoVendor-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content width-600">
                <div class="modal-header">
                    <h4 class="modal-title form-section" id="modalheader">
                        <i class="ft-home"></i>  اضافة شعار جديد
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form class="form" id="logoVendorForm" enctype="multipart/form-data">
                                @csrf

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput2">اختر الشركة</label>
                                                <select name="vendor_id" id="vendor_id" class="form-control">
                                                    <optgroup label="الرجاء اختر القسم">
                                                        @isset($data['vendors'] )
                                                            @foreach($data['vendors'] as $vendor)
                                                                <option value="{{$vendor->id}}">{{$vendor->name}}</option>h
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
                                            <label> اضف صورة</label>
                                            <label id="projectinput7" class="file center-block">
                                                <input type="file" id="photo" name="photo">
                                                <span class="file-custom"></span>
                                            </label>
                                            <span id="photo_error" class="text-danger"> </span>
                                        </div>
                                    </div>


                                </div>

                                <div class="form-actions">
                                    <input type="hidden" name="action" id="action" value="Add">
                                    <button type="button" class="btn btn-warning mr-1" data-dismiss="modal"><i
                                            class="la la-undo"></i> تراجع
                                    </button>
                                    <button class="btn btn-primary" id="addLogoVendor"><i class="la la-save"></i> حفظ</button>
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
                        <h5>هل أنت متأكد من حذف شعار هذا التاجر !!</h5>
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
            var logoVendorTable = $('.logoVendor-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route("index.logo.vendors")}}",
                columns: [
                    {data: 'vendor_id', name: 'vendor_id'},
                    {data: 'photo', name: 'photo'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                language:{"url" :"{{asset('/public/assets/admin/js/dataTableArabic.json')}}"}
            });

            $('select[name="vendor"]').on('change',function(){
                logoVendorTable.column($(this).data('vendor')).search($(this).val()).draw();

            });


            //Show Form
            $('#addNewLogoVendor').click(function () {
                $('#logoVendorForm').trigger('reset');
                $('#logoVendor-modal').modal('show');

            });


            //Add Or Update
            $(document).on('click', '#addLogoVendor', function (e) {
                e.preventDefault();
                var formData = new FormData($('#logoVendorForm')[0]);
                $('#vendor_id_error').text('');
                $('#photo_error').text('');
                $.ajax({
                    type: 'post',
                    url: "{{ route('save.logo.vendor') }}",
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true) {
                            toastr.success(data.msg);
                            $('#logoVendorForm').trigger('reset');
                            $('#logoVendor-modal').modal('hide');
                            logoVendorTable.draw();
                        } else {
                            toastr.error(data.msg);
                            $('#logoVendorForm').trigger('reset');
                            $('#logoVendor-modal').modal('hide');
                            logoVendorTable.draw();
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

            $('body').on('click', '.deleteLogoVendor', function () {
                var id = $(this).data('id');
                $('#delete-modal').modal('show');

                $('#delete').click(function (e) {
                    e.preventDefault();
                    $.ajax({

                        url: "logo/delete/" + id,

                        success: function (data) {
                            console.log('success:', data);
                            if (data.status == true) {
                                $('#delete-modal').modal('hide');
                                toastr.warning(data.msg);
                                logoVendorTable.draw();
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
