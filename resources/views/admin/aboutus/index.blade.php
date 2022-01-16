@extends('layouts.admin')
@section('title')
    من نحن
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
                                <li class="breadcrumb-item active"> من نحن</li>
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
                                       id="addNewAboutUs"><i class="la la-plus"></i>  اضافة نبذة جديدة</a>
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

                                <div class="card-content collapse show" id="viewAboutUs">
                                    <div class="card-body card-dashboard table-responsive">
                                        <table class="table aboutUs-table">
                                            <thead>
                                            <tr>
                                                <th>من نحن</th>
                                                <th>الاجراءات</th>

                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                        <div class="justify-content-center d-flex"></div>
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

    <div class="modal fade modal-open" id="aboutUs-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content width-600">
                <div class="modal-header">
                    <h4 class="modal-title form-section" id="modalheader">
                        <i class="ft-home"></i> اضافة نبذة
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form class="form" id="aboutUsForm" enctype="multipart/form-data">
                                @csrf

                                <div class="form-body">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label> اضف صورة أو فيديو</label>
                                            <label id="projectinput7" class="file center-block">
                                                <input type="file" id="photo" name="photo">
                                                <span class="file-custom"></span>
                                            </label>
                                            <span id="photo_error" class="text-danger"> </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput1">الرابط</label>
                                                <input type="text" id="link" class="form-control" placeholder="https://www.youtube.com/embed/QTlU9S2O4cE"
                                                       name="link" value="{{old('link')}}">
                                                <span id="link_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput1">من نحن</label>
                                                <textarea name="about" id="about" cols="3" rows="6"
                                                          class="form-control" placeholder="نحن شركة زياد مشتهى للاقمشة ..."></textarea>
                                            </div>
                                            <span id="about_error" class="text-danger"></span>
                                        </div>
                                    </div>


                                </div>

                                <div class="form-actions">
                                    <input type="hidden" name="action" id="action" value="Add">
                                    <button type="button" class="btn btn-warning mr-1" data-dismiss="modal"><i
                                            class="la la-undo"></i> تراجع
                                    </button>
                                    <button class="btn btn-primary" id="addAboutUs"><i class="la la-save"></i> حفظ</button>
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
                        <h5>هل أنت متأكد من حذف هذه النبذة !!</h5>
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
            var aboutUsTable = $('.aboutUs-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route("index.about")}}",
                columns: [
                    {data: 'about', name: 'about'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                language:{"url" :"{{asset('/public/assets/admin/js/dataTableArabic.json')}}"}
            });


            //Show Form
            $('#addNewAboutUs').click(function () {
                $('#aboutUsForm').trigger('reset');
                $('#aboutUs-modal').modal('show');

            });


            //Add Or Update
            $(document).on('click', '#addAboutUs', function (e) {
                e.preventDefault();
                var formData = new FormData($('#aboutUsForm')[0]);
                $('#about_error').text('');
                $.ajax({
                    type: 'post',
                    url: "{{ route('save.about') }}",
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true) {
                            toastr.success(data.msg);
                            $('#aboutUsForm').trigger('reset');
                            $('#aboutUs-modal').modal('hide');
                            aboutUsTable.draw();
                        } else {
                            toastr.error(data.msg);
                            $('#aboutUsForm').trigger('reset');
                            $('#aboutUs-modal').modal('hide');
                            aboutUsTable.draw();
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

            $('body').on('click', '.deleteAboutUs', function () {
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
                                aboutUsTable.draw();
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
