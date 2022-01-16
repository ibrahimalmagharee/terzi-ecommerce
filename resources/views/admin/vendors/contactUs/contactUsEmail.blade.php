@extends('layouts.admin')
@section('title')
    تواصل معنا|تاجر
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> من نحن </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a></li>
                                <li class="breadcrumb-item"><a href="{{route('index.vendors')}}">التجار </a></li>
                                <li class="breadcrumb-item active">تواصل معنا</li>
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
                                        <table class="table contactUs-table">
                                            <thead>
                                            <tr>
                                                <th>اسم الشركة</th>
                                                <th>الايميل</th>
                                                <th>رقم الهاتف</th>
                                                <th>عنوان الطلب</th>
                                                <th>الرسالة</th>
                                                <th>الاجراءات</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        <div class="row mt-1">
                                            <div class="col-md-3">
                                                <select name="vendor_id" data-vendor="0" id="vendor_id" class="form-control">
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
                                                <input type="email" data-email="1" name="email" id="email_filter" class="form-control" placeholder="الايميل">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" data-mobile="2" name="mobile_No" id="mobile_No_filter" class="form-control" placeholder="رقم الهاتف">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" data-address_request="3" name="address_request" id="address_request_filter" class="form-control" placeholder="العنوان">
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
                        <h5>هل أنت متأكد من حذف رسالة هذا التاجر !!</h5>
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
            var contactUsVendorTable = $('.contactUs-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route("index.contactUs.vendors")}}",
                columns: [
                    {data: 'vendor_id', name: 'vendor_id'},
                    {data: 'email', name: 'email'},
                    {data: 'phone_number', name: 'phone_number'},
                    {data: 'address_request', name: 'address_request'},
                    {data: 'message', name: 'message'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ],
                language:{"url" :"{{asset('/public/assets/admin/js/dataTableArabic.json')}}"}
            });

            $('select[name="vendor_id"]').on('change',function(){
                contactUsVendorTable.column($(this).data('vendor')).search($(this).val()).draw();

            });

            $('#email_filter').on('keyup',function(){
                contactUsVendorTable.column($(this).data('email')).search($(this).val()).draw();

            });

            $('#mobile_No_filter').on('keyup',function(){
                contactUsVendorTable.column($(this).data('mobile')).search($(this).val()).draw();

            });

            $('#address_request_filter').on('keyup',function(){
                contactUsVendorTable.column($(this).data('address_request')).search($(this).val()).draw();

            });

            //Delete

            $('body').on('click', '.deleteContactUsVendor', function () {
                var id = $(this).data('id');
                $('#delete-modal').modal('show');

                $('#delete').click(function (e) {
                    e.preventDefault();
                    $.ajax({

                        url: "contact-us/delete/" + id,

                        success: function (data) {
                            console.log('success:', data);
                            if (data.status == true) {
                                $('#delete-modal').modal('hide');
                                toastr.warning(data.msg);
                                contactUsVendorTable.draw();
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
