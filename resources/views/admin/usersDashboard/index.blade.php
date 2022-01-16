@extends('layouts.admin')
@section('title')
    مستخدمين لوحة التحكم
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> مستخدمين لوحة التحكم </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a></li>
                                <li class="breadcrumb-item active">  مستخدمين لوحة التحكم</li>
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
                                       id="addNewUser"><i class="la la-plus"></i>  اضافة مستخدم جديد</a>
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
                                        <table class="table user-table">
                                            <thead>
                                            <tr>
                                                <th>الاسم</th>
                                                <th>الايميل</th>
                                                <th>الصلاحية</th>
                                                <th>الاجراءات</th>

                                            </tr>
                                            </thead>
                                            <tbody></tbody>

                                        </table>
                                        <div class="row mt-1">
                                            <div class="col-md-3">
                                                <input type="text" data-name="0" name="name" id="name_filter" class="form-control" placeholder="اسم المستخدم">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="email" data-email="1" name="email" id="email_filter" class="form-control" placeholder="الايميل">
                                            </div>
                                            <div class="col-md-3">
                                                <select name="role" data-role="2" id="role_id_filter" class="form-control">
                                                    <optgroup label="الرجاء اختر نوع الصلاحية">
                                                        <option value="">اختر نوع الصلاحية</option>
                                                        @isset($roles)
                                                            @foreach($roles as $role)
                                                                <option value="{{$role->name}}">{{$role->name}}</option>
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

    <div class="modal fade modal-open" id="user-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content width-800">
                <div class="modal-header">
                    <h4 class="modal-title form-section" id="modalheader">
                        <i class="ft-home"></i> اضافة مستخدم
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form class="form" id="userForm" enctype="multipart/form-data">
                                @csrf

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
                                                <label for="projectinput1"> الايميل </label>
                                                <input type="email" id="email" class="form-control" placeholder="مثال:ahmad@gmail.com"
                                                       name="email" value="{{old('email')}}">
                                                <span id="email_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">كلمة السر </label>
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput2">الصلاحية</label>
                                                <select name="role_id" id="role_id" class="form-control">
                                                    <optgroup label="الرجاء اختر نوع الصلاحية">
                                                        @isset($roles)
                                                            @foreach($roles as $role)
                                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                                            @endforeach
                                                        @endisset
                                                    </optgroup>
                                                </select>
                                                <span id="role_id_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="hidden" name="action" id="action" value="Add">
                                    <button type="button" class="btn btn-warning mr-1" data-dismiss="modal"><i
                                            class="la la-undo"></i> تراجع
                                    </button>
                                    <button class="btn btn-primary" id="addUser"><i class="la la-save"></i> حفظ</button>
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
                        <h5>هل أنت متأكد من حذف هذا مستخدم !!</h5>
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
            var userTable = $('.user-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route("index.users")}}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'role_id', name: 'role_id'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                language:{"url" :"{{asset('/public/assets/admin/js/dataTableArabic.json')}}"}
            });

            $('#name_filter').on('keyup',function(){
                userTable.column($(this).data('name')).search($(this).val()).draw();

            });

            $('#email_filter').on('keyup',function(){
                userTable.column($(this).data('email')).search($(this).val()).draw();

            });

            $('select[name="role"]').on('change',function(){
                userTable.column($(this).data('role')).search($(this).val()).draw();

            });


            //Show Form
            $('#addNewUser').click(function () {
                $('#userForm').trigger('reset');
                $('#user-modal').modal('show');

            });


            //Add Or Update
            $(document).on('click', '#addUser', function (e) {
                e.preventDefault();
                var formData = new FormData($('#userForm')[0]);
                $('#name_error').text('');
                $('#email_error').text('');
                $('#password_error').text('');
                $('#role_id_error').text('');
                $.ajax({
                    type: 'post',
                    url: "{{ route('save.user') }}",
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true) {
                            toastr.success(data.msg);
                            $('#userForm').trigger('reset');
                            $('#user-modal').modal('hide');
                            userTable.draw();
                        } else {
                            toastr.error(data.msg);
                            $('#userForm').trigger('reset');
                            $('#user-modal').modal('hide');
                            userTable.draw();
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

            $('body').on('click', '.deleteUser', function () {
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
                                userTable.draw();
                            } else {
                                $('#delete-modal').modal('hide');
                                toastr.error(data.msg);
                                userTable.draw();
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
