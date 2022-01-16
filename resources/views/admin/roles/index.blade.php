@extends('layouts.admin')
@section('title')
   الصلاحيات
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">الصلاحيات</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a></li>
                                <li class="breadcrumb-item active">الصلاحيات</li>
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
                                       id="addNewRole"><i class="la la-plus"></i>  اضافة صلاحية جديدة</a>
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
                                        <table class="table role-table">
                                            <thead>
                                            <tr>
                                                <th>الصلاحية</th>
                                                <th>الاجراءات</th>

                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                        <div class="row mt-1">
                                            <div class="col-md-3">
                                                <input type="text" data-name="0" name="name" id="name_filter" class="form-control" placeholder="الصلاحية">
                                            </div>

                                            <div class="col-md-4">
{{--                                                <select name="permissions" data-permissions="1" id="permissions_filter" class="form-control select2" multiple>--}}
{{--                                                    <optgroup label="الرجاء اختر نوع الصلاحية">--}}
{{--                                                        <option value="">اختر نوع الصلاحية</option>--}}
{{--                                                        @foreach (config('global.permissions') as $name => $value)--}}
{{--                                                            <option value="{{$name}}">{{$name}}</option>--}}

{{--                                                        @endforeach--}}
{{--                                                    </optgroup>--}}
{{--                                                </select>--}}
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

    <div class="modal fade modal-open" id="role-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content width-500">
                <div class="modal-header">
                    <h4 class="modal-title form-section" id="modalheader">
                        <i class="ft-home"></i> اضافة صلاحية
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form class="form" id="roleForm" enctype="multipart/form-data">
                                @csrf

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput1"> اسم الصلاحية </label>
                                                <input type="text" id="name" class="form-control" placeholder="مثال:ادمن"
                                                       name="name" value="{{old('name')}}">
                                                <span id="name_error" class="text-danger"></span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="projectinput1">القيود :</label>
                                            @isset($permissions)
                                                @foreach ($permissions as $permission)
                                                <div>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" class="chk-box" name="permissions[]" value="{{ $permission->id }}">  {{ $permission->name  }}
                                                    </label>
                                                </div>
                                                @endforeach
                                            @endisset

                                            <span id="permissions_error" class="text-danger"></span>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="hidden" name="action" id="action" value="Add">
                                    <button type="button" class="btn btn-warning mr-1" data-dismiss="modal"><i
                                            class="la la-undo"></i> تراجع
                                    </button>
                                    <button class="btn btn-primary" id="addRole"><i class="la la-save"></i> حفظ</button>
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
                        <h5>هل أنت متأكد من حذف هذه الصلاحية !!</h5>
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
            var roleTable = $('.role-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route("index.roles")}}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                language:{"url" :"{{asset('/public/assets/admin/js/dataTableArabic.json')}}"}
            });

            $('#name_filter').on('keyup',function(){
                roleTable.column($(this).data('name')).search($(this).val()).draw();

            });

            $('select[name="permissions"]').on('change',function(){
                roleTable.column($(this).data('permissions')).search($(this).val()).draw();

            });

            //Show Form
            $('#addNewRole').click(function () {
                $('#roleForm').trigger('reset');
                $('#role-modal').modal('show');

            });


            //Add Or Update
            $(document).on('click', '#addRole', function (e) {
                e.preventDefault();
                var formData = new FormData($('#roleForm')[0]);
                $('#name_error').text('');
                $('#permissions_error').text('');
                $.ajax({
                    type: 'post',
                    url: "{{ route('save.role') }}",
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true) {
                            toastr.success(data.msg);
                            $('#roleForm').trigger('reset');
                            $('#role-modal').modal('hide');
                            roleTable.draw();
                        } else {
                            toastr.error(data.msg);
                            $('#roleForm').trigger('reset');
                            $('#role-modal').modal('hide');
                            roleTable.draw();
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

            $('body').on('click', '.deleteRole', function () {
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
                                roleTable.draw();
                            } else {
                                $('#delete-modal').modal('hide');
                                toastr.error(data.msg);
                                roleTable.draw();
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
