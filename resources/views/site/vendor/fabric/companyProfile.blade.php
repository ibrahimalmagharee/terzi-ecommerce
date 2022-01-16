@extends('layouts.site')

@section('title')
    بروفايل تاجر | أقمشة
@endsection
@section('content')

    <header  class="bg-dark ">
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent container pt-2">
            <a class="navbar-brand MontserratArabic-logo text-warning" href="{{route('vendor.aboutFabric')}}">
                @isset($logo)
                    <img src="{{$logo->getPhoto($logo->image->photo)}}" style="width: 50px">

                @else
                    ترزي
                @endisset
            </a>
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link MontserratArabicLightPure" href="{{route('vendor.aboutFabric')}}"
                        >الرئيسية<span class="sr-only">(current)</span></a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link MontserratArabicLightPure" href="{{route('vendor.addProductFabric')}}">إضافة منتج</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link MontserratArabicLightPure" href="{{route('vendor.viewProductsFabric')}}">المنتجات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link MontserratArabicLightPure" href="{{route('vendor.purseFabric')}}"
                        >المحفظة
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('vendor.getSearchPageFabric')}}"
                        ><i class="fa fa-search" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link MontserratArabicLightPure" href="{{route('vendor.contactUsFabric')}}">اتصل بنا</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="navbarDropdown"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('vendor.profileFabric')}}">الملف الشخصي</a>
                            <a class="dropdown-item" href="{{route('vendor.changePasswordFabric')}}">تغيير كلمة المرور</a>
                            <a class="dropdown-item" href="{{route('vendor.logout')}}">تسجيل الخروج</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>


<div class="container">
    <div class="profile">
        <div class="profile-header">
            <div class="profile-header-cover">
                @if($vendor->headerCover)
                    <img src="{{$vendor->getPhotoHeaderCover($vendor->headerCover->photo)}}" id="profile-header-cover" style="width: 100%; height: 18rem;" alt="">
                @else
                    <img src="{{asset('/public/assets/front/assets/companyprofile1.png')}}" id="profile-header-cover" style="width: 100%; height: 18rem;" alt="">

                @endif
                <button class="camera " type="button" class="btn btn-primary" style="position: absolute; left: 0; right: 99%; top: 2%;"  id="editProfileHeaderCover">
                    <i class="fa fa-camera" aria-hidden="true"></i>
                </button>

            </div>
            <div class="profile-header-content">
                <button class="camera " type="button" class="btn btn-primary" id="editPhotoProfile">
                    <i class="fa fa-camera" aria-hidden="true"></i>
                </button>
                <div class="profile-header-img">
                    <img id="profile-header-img" src="{{$vendor->getPhoto($vendor->image->photo)}}" alt="" />

                </div>
                <div class="row profile-header-tab">
                    <div class="col-md-6 text-right">
                        <h3 class="MontserratArabicLight" id="vendor_name">{{$vendor->name}}</h3>
                    </div>
                    <div class="col-md-6 text-left">
                        <a class="MontserratArabicLightPure editAccount" data-id="{{$vendor->id}}" href="javascript:void(0)"
                           id="editAccount"> تعديل الحساب</a>

                    </div>
                </div>
            </div>
        </div>

        <div class="container pb-5 my-5">
            <div class="row">
                <div class="col text-right d-flex p-0">
                    <h4  class="pr-2 border-3 section-title" >المنتجات</h4>
                </div>
            </div>
            <div class="row mt-5">
                @foreach($fabrics as $fabric)
                    @if($vendor->id == $fabric->product->vendor->id)

                        <div class="col-md-4 col-sm-12 pr-0 pl-5 col-resp my-2">
                            <div class="card border-0 shadow-cust rounded-cust card-resp" style="width: 100%;">
                                <img src="{{$fabric->getPhoto($fabric->images[0]->photo)}}" class="card-img-top rounded-top" style="width: 100%; height: 280px;">
                                <div class="card-body text-center">
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <h5 class="card-text">{{$fabric->name}}</h5>
                                        @if($fabric->product->offer)
                                            <p class="card-text text-danger"><s>{{$fabric->product->price}} ر.س</s></p>
                                            <p class="card-text text-danger">{{$fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)}} ر.س </p>
                                        @else
                                            <p class="card-text text-danger">{{$fabric->product->price}} ر.س</p>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <p class="card-text">{{$fabric->product->sales}} مبيعات</p>
                                        <a href="{{route('vendor.editProductFabric',$fabric->id)}}" class="btn btn-dark px-5 MontserratArabicLightPure">تعديل</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="ProfileHeaderCover" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تحديث صورة الخلفية</h5>

                </div>
                <div class="modal-body">
                    <form class="form"  id="editProfileHeaderCoverForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                        <span class="text-danger float-right mb-2">( يجب أن تكون عرض الصورة 1110px و طول الصورة 288px )</span>
                        <div class="input-group mb-3">

                            <div class="custom-file">

                                <input type="file" name="header_photo" class="custom-file-input" id="inputGroupFile0">
                                <label class="custom-file-label" for="inputGroupFile0" aria-describedby="inputGroupFileAddon02">اختر الصورة</label>

                            </div>

                        </div>
                        <span id="header_photo_error" class="text-danger"></span>


                        <div class="form-actions float-right">
                            <button type="button" class="btn btn-warning mr-1" data-dismiss="modal"><i
                                    class="la la-undo"></i> تراجع
                            </button>
                            <button class="btn btn-primary" id="editProfileHeaderCoverPhoto"><i class="fa fa-save"></i> حفظ</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="photo_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Profile Pic</h5>

            </div>
            <div class="modal-body">
                <form class="form"  id="editProfilePhotoForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                    <span class="text-danger float-right mb-2">( يجب أن تكون عرض الصورة 194px و طول الصورة 194px )</span>

                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" name="photo" class="custom-file-input" id="inputGroupFile02">
                            <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">اختر الصورة</label>
                        </div>
                    </div>
                    <span id="photo_error" class="text-danger"></span>


                    <div class="form-actions float-right">
                        <button type="button" class="btn btn-warning mr-1" data-dismiss="modal"><i
                                class="la la-undo"></i> تراجع
                        </button>
                        <button class="btn btn-primary" id="editProfilePhoto"><i class="fa fa-save"></i> حفظ</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-open" id="editAccount-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 130%">
            <div class="modal-header">
                <h4 class="modal-title form-section" id="modalheader">
                    <i class="fa fa-home"></i>تعديل حساب -  {{$vendor->name}}
                </h4>

            </div>
            <div class="modal-body">
                <div class="card-content collapse show">
                    <div class="card-body">
                        <form class="form" id="editAccountForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id" value="">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1" class="float-right"> اسم الشركة </label>
                                            <input type="text" id="name" class="form-control" placeholder="مثال:شركة المدينة المنورة"
                                                   name="name" value="">
                                            <span id="name_error" class="text-danger float-right"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1" class="float-right"> موقع الشركة </label>
                                            <input type="text" id="location" class="form-control" placeholder="مثال:الرياض"
                                                   name="location" value="">
                                            <span id="location_error" class="text-danger float-right"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1" class="float-right"> رقم السجل التجاري </label>
                                            <input type="text" id="commercial_registration_No" class="form-control" placeholder="مثال:5658"
                                                   name="commercial_registration_No" value="">
                                            <span id="commercial_registration_No_error" class="text-danger float-right"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1" class="float-right"> رقم الجوال </label>
                                            <input type="text" id="mobile_No" class="form-control" placeholder="مثال:0599664473"
                                                   name="mobile_No" value="">
                                            <span id="mobile_No_error" class="text-danger float-right"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1" class="float-right"> الهوية الوطنية </label>
                                            <input type="text" id="national_Id" class="form-control" placeholder="مثال:505990014"
                                                   name="national_Id" value="">
                                            <span id="national_Id_error" class="text-danger float-right"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="projectinput1" class="float-right"> البريد الالكتروني </label>
                                            <input type="email" id="email" class="form-control" placeholder="مثال:almadina@gmail.com"
                                                   name="email" value="">
                                            <span id="email_error" class="text-danger float-right"></span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-actions float-right">
                                <input type="hidden" name="action" id="action" value="Add">
                                <button type="button" class="btn btn-warning mr-1" data-dismiss="modal"><i
                                        class="la la-undo"></i> تراجع
                                </button>
                                <button class="btn btn-primary" id="editAccountVendor"><i class="fa fa-save"></i> حفظ</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<footer class="bg-dark">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-sm-12 d-flex">
                <a class="navbar-brand MontserratArabic-logo text-warning pt-4 footer-logo" href="{{route('vendor.aboutFabric')}}">
                    @isset($logo)
                        <img src="{{$logo->getPhoto($logo->image->photo)}}" style="width: 50px">

                    @else
                        ترزي
                    @endisset
                </a>
            </div>
            <div class="col-md-2 col-sm-12">
                <ul class="footer-col pt-4">
                    <li class="py-2">
                        <a class="text-white" href="{{route('vendor.aboutFabric')}}">الرئيسية</a>
                    </li>
                    <li class="py-2">
                        <a class="text-white" href="{{route('vendor.viewProductsFabric')}}">الأقمشة</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-2 col-sm-12">
                <ul class="footer-col pt-4">
                    <li class="py-2">
                        <a class="text-muted" href="{{route('vendor.aboutFabric')}}">من نحن ؟</a>
                    </li>
                    <li class="py-2">
                        <a class="text-muted" href="">المساعدة</a>
                    </li>
                    <li class="py-2">
                        <a class="text-muted" href="" >الشروط</a>
                    </li>
                    <li class="py-2">
                        <a class="text-muted" href="">تقديم شكوى</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-12">
                <form class="form-inline pt-4">
                    <div class="col p-0 text-right">
                        <div class="input-group ">
                            <input type="text" class="form-control bg-dark text-white border-left-0 rounded-right" placeholder="الايميل">
                            <div class="input-group-prepend">
                                <button type="submit" class=" rounded-left border-right-0 bg-dark text-white input-group-text" >
                                    <img src="{{asset('/public/assets/front/assets/send.png')}}" alt="">
                                </button>
                            </div>
                        </div>
                        <small class="text-light MontserratArabicLight">
                            ابقى على تواصل مع اهم مستجدات عروضنا
                        </small>
                    </div>
                </form>

            </div>
            <div class="col-md-3 col-sm-12">
                <div class="column text-light pt-4">
                    @if ($social_media_link[0])
                        <a class="text-decoration-none text-light" href="{{$social_media_link[0]->link}}" target="_blank"><i class="fa fa-facebook-f px-2"></i></a>
                    @endif

                    @if ($social_media_link[1])
                        <a class="text-decoration-none text-light" href="{{$social_media_link[1]->link}}" target="_blank"><i class="fa fa-instagram px-2"></i></a>
                    @endif

                    @if ($social_media_link[2])
                        <a class="text-decoration-none text-light" href="{{$social_media_link[2]->link}}" target="_blank"><i class="fa fa-twitter px-2"></i></a>
                    @endif

                    @if ($social_media_link[3])
                        <a class="text-decoration-none text-light" href="{{$social_media_link[3]->link}}" target="_blank"><i class="fa fa-youtube px-2"></i></a>
                    @endif

                    @if ($social_media_link[4])
                        <a class="text-decoration-none text-light" href="{{$social_media_link[4]->link}}" target="_blank"><i class="fa fa-whatsapp px-2"></i></a>
                    @endif

                    @if ($social_media_link[5])
                        <a class="text-decoration-none text-light" href="{{$social_media_link[5]->link}}" target="_blank"><img src="{{asset('/public/assets/front/assets/snapchat-brands.svg')}}" class="fa img_icon px-2"  alt=""></a>
                    @endif

                    @if ($social_media_link[6])
                        <a class="text-decoration-none text-light" href="{{$social_media_link[6]->link}}" target="_blank"><img src="{{asset('/public/assets/front/assets/tiktok-brands.svg')}}" class="fa img_icon px-2"  alt=""></a>
                    @endif

                </div>

            </div>
        </div>
        <div class="row">
            <p class="copy-right mr-auto text-white">Tarze© Copyright 2020</p>
        </div>
    </div>
</footer>
@endsection

@section('script')
    <script type="text/javascript">

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('input[type="file"]').change(function(e){
                var fileName = e.target.files[0].name;
                $('.custom-file-label').html(fileName);
            });

            //Show Form
            $('#editAccount').click(function () {
                $('#editAccountForm').trigger('reset');
                $('#editAccount-modal').modal('show');

            });

            $('#editPhotoProfile').click(function () {
                $('#editProfilePhotoForm').trigger('reset');
                $('#photo_profile').modal('show');

            });

            $('#editProfileHeaderCover').click(function () {
                $('#editProfileHeaderCoverForm').trigger('reset');
                $('#ProfileHeaderCover').modal('show');

            });

            $(document).on('click', '.editAccount', function () {
                var id = $(this).data('id');

                //$('#action').val('update');

                $.get("{{route('vendor.editAccountFabric')}}", function (data) {
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#location').val(data.location);
                    $('#commercial_registration_No').val(data.commercial_registration_No);
                    $('#mobile_No').val(data.mobile_No);
                    $('#national_Id').val(data.national_Id);
                    $('#email').val(data.email);

                })
            });

            //Add Or Update
            $(document).on('click', '#editAccountVendor', function (e) {
                e.preventDefault();
                var formData = new FormData($('#editAccountForm')[0]);
                $('#name_error').text('');
                $('#location_error').text('');
                $('#commercial_registration_No_error').text('');
                $('#mobile_No_error').text('');
                $('#national_Id_error').text('');
                $('#email_error').text('');
                $.ajax({
                    type: 'post',
                    url: "{{ route('vendor.updateAccountFabric') }}",
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true) {
                            $('#editAccountForm').trigger('reset');
                            $('#editAccount-modal').modal('hide');
                            $('#vendor_name').html(data.vendor);
                            toastr.success(data.msg);
                        } else {
                            toastr.error(data.msg);
                            $('#editAccount-modal').modal('hide');
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

            // Edit Photo Profile
            $(document).on('click', '#editProfilePhoto', function (e) {
                e.preventDefault();
                var formData = new FormData($('#editProfilePhotoForm')[0]);
                $('#photo_error').text('');

                $.ajax({
                    type: 'post',
                    url: "{{route('vendor.saveProfilePhotoFabric',$vendor->id)}}",
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true) {
                            $('#editProfilePhotoForm').trigger('reset');
                            $('#photo_profile').modal('hide');
                            $('.custom-file-label').html('اختر الصورة');
                            $('#profile-header-img').attr('src', data.photo );
                            toastr.success(data.msg);
                        } else {
                            toastr.error(data.msg);
                            $('#photo_profile').modal('hide');
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

            // Edit Header Cover Profile
            $(document).on('click', '#editProfileHeaderCoverPhoto', function (e) {
                e.preventDefault();
                var formData = new FormData($('#editProfileHeaderCoverForm')[0]);
                $('#header_photo_error').text('');

                $.ajax({
                    type: 'post',
                    url: "{{route('vendor.saveProfileHeaderCoverFabric',$vendor->id)}}",
                    enctype: 'multipart/form-data',
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',

                    success: function (data) {
                        if (data.status == true) {
                            $('#editProfileHeaderCoverForm').trigger('reset');
                            $('#ProfileHeaderCover').modal('hide');
                            $('.custom-file-label').html('اختر الصورة');
                            $('#profile-header-cover').attr('src', data.photo );
                            toastr.success(data.msg);
                        } else {
                            toastr.error(data.msg);
                            $('#ProfileHeaderCover').modal('hide');
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
    </script>
@endsection
