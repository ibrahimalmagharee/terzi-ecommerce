@extends('layouts.site')

@section('title')
    المقاسات
@endsection
@section('content')
@endsection
<header class="bg-dark ">
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent container pt-2">
        <a class="navbar-brand MontserratArabic-logo text-warning" href="{{route('index')}}">
            @isset($logo)
                <img src="{{$logo->getPhoto($logo->photo)}}" style="width: 50px">

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
                    <a class="nav-link MontserratArabicLightPure" href="{{route('index')}}"
                    >الرئيسية<span class="sr-only">(current)</span></a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link MontserratArabicLightPure"
                       href="{{route('customer.viewFabricProduct')}}">الأقمشة</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link MontserratArabicLightPure"
                       href="{{route('customer.viewDesignProduct')}}">التصاميم</a>
                </li>
                @auth('customer')
                    <li class="nav-item">
                        <a class="nav-link MontserratArabicLightPure"
                           href="{{route('customer.sizes')}}">المقاسات</a>
                    </li>
                @endauth
                <li class="nav-item">

                    <a class="nav-link MontserratArabicLight" href="{{route('basket.products.index')}}">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <div class="cart-products-count">@auth('customer') {{count($basket_products)}} @else 0 @endauth</div>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('customer.getSearchPage')}}"
                    ><i class="fa fa-search" aria-hidden="true"></i>
                    </a>
                </li>
                @auth('customer')
                    <li class="nav-item">
                        <a class="nav-link MontserratArabicLightPure" href="{{route('contactUs')}}">اتصل بنا</a>
                    </li>
                @endauth
                @auth('customer')
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

                            <a class="dropdown-item d-flex justify-content-between" href="{{route('wishlist.products.index')}}">
                                <p>منتجاتي المفضلة</p>
                                <i class="fa fa-heart  mr-3 nav-icon" aria-hidden="true"></i>
                            </a>

                            <a class="dropdown-item d-flex justify-content-between" href="{{route('customer.getMyPurchases')}}">
                                <p>مشترياتي</p>
                                <i class="fa fa-shopping-cart  mr-3 nav-icon" aria-hidden="true"></i>
                            </a>

                            <a class="dropdown-item d-flex justify-content-between" href="#">
                                <p>مساعدة</p>
                                <i class="fa fa-question-circle  mr-3 nav-icon" aria-hidden="true"></i>
                            </a>

                            <a class="dropdown-item d-flex justify-content-between" href="{{route('customer.logout')}}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <p>تسجيل الخروج</p>
                                <i class="fa fa-sign-out  mr-3 nav-icon" aria-hidden="true"></i>
                                <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </a>


                        </div>
                    </li>
                @endauth
                @guest('customer')
                    <li class="nav-item">
                        <a class="nav-link MontserratArabicLightPure" href="{{route('customer.login.page')}}">تسجيل الدخول</a>
                    </li>

                @endguest
            </ul>
        </div>
    </nav>
</header>


<div class="container">

    <div class="container pb-2 my-5">
        <div class="row ">
            <div class="col  d-flex p-0 justify-content-between">
                <h4 class="section-title"> المقاسات</h4>
                <a class="btn btn-yellow" href="javascript:void(0)"
                   id="addNewSize"><i class="la la-plus"></i>  اضافة مقاس جديد</a>
            </div>



        </div>

    </div>

    <table class="table customer-size-table">
        <thead class="thead-dark">
        <tr>
            <th>الاسم</th>
            <th>النوع</th>
            <th>الاجراءات</th>
        </tr>
        </thead>
        <tbody>

{{--        @isset($sizes)--}}
{{--            @foreach($sizes as $size)--}}
{{--                <tr>--}}
{{--                    <th scope="row">{{$size->name}}</th>--}}
{{--                    <td>{{$size->category->name}}</td>--}}
{{--                    <td><a href="" data-toggle="tooltip"  data-id="{{$size->id}}" data-original-title="تعديل" id="editCustomer" class="badge-info box-shadow-3 mb-1 editSize text-decoration-none" ><i class="fa fa-edit font-large-5"></i></a>--}}
{{--                   <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$size->id}}" data-original-title="حذف" class="badge-danger box-shadow-3 mb-1 deleteSize text-decoration-none" ><i class="fa fa-trash font-large-5"></i></a></td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--        @endisset--}}


        </tbody>
    </table>





    <div class="modal fade" id="sizeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 800px !important;" role="document">
            <div class="modal-content " >
                <div class="modal-header" id="modal_header">
                    <h5 class="modal-title" id="exampleModalLabel">القياسات</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="container text-right">
                        <p>أضف قياسات (سم)</p>
                        <div class="row text-right">

                            <br>
                            <form id="sizeForm">
                                @csrf
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="customer_id" id="customer_id" value="{{auth('customer')->user()->id}}">
                                <div class="row">
                                    <div class="col-md-1">الاسم</div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="name" class="form-control"
                                                   name="name" value="{{old('name')}}">
                                            <span id="name_error" class="text-danger"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-2">نوع القماش</div>
                                    <div class="col-md-4">
                                        <select name="category_id" id="category_id" class="custom-select">
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
                                <div class="row mr-1">
                                    <p>أضف قياسات (سم)</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">محيط الصدر</div>
                                    <div class="col-md-3">
                                        <input type="text" id="chest_circumference" class="form-control"
                                               name="chest_circumference" value="{{old('chest_circumference')}}">
                                        <span id="chest_circumference_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-3">طول الرقبة</div>
                                    <div class="col-md-3">
                                        <input type="text" id="neck_length" class="form-control"
                                               name="neck_length" value="{{old('neck_length')}}">
                                        <span id="neck_length_error" class="text-danger"></span>
                                    </div>

                                </div>
                                <div class="row my-2">
                                    <div class="col-md-3">محيط الخصر</div>
                                    <div class="col-md-3">
                                        <input type="text" id="waistline" class="form-control"
                                               name="waistline" value="{{old('waistline')}}">
                                        <span id="waistline_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-3">عرض الرقبة</div>
                                    <div class="col-md-3">
                                        <input type="text" id="neck_width" class="form-control"
                                               name="neck_width" value="{{old('neck_width')}}">
                                        <span id="neck_width_error" class="text-danger"></span>
                                    </div>

                                </div>
                                <div class="row my-2">
                                    <div class="col-md-3">محيط الارداف</div>
                                    <div class="col-md-3">
                                        <input type="text" id="buttock_circumference" class="form-control"
                                               name="buttock_circumference" value="{{old('buttock_circumference')}}">
                                        <span id="buttock_circumference_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-3">محيط الرقبة</div>
                                    <div class="col-md-3">
                                        <input type="text" id="neck_circumference" class="form-control"
                                               name="neck_circumference" value="{{old('neck_circumference')}}">
                                        <span id="neck_circumference_error" class="text-danger"></span>
                                    </div>

                                </div>
                                <div class="row my-2">
                                    <div class="col-md-3">طول بنسة الصدر</div>
                                    <div class="col-md-3">
                                        <input type="text" id="length_by_chest" class="form-control"
                                               name="length_by_chest" value="{{old('length_by_chest')}}">
                                        <span id="length_by_chest_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-3">المسافة بين الثديين</div>
                                    <div class="col-md-3">
                                        <input type="text" id="distance_between_breasts" class="form-control"
                                               name="distance_between_breasts" value="{{old('distance_between_breasts')}}">
                                        <span id="distance_between_breasts_error" class="text-danger"></span>
                                    </div>

                                </div>
                                <div class="row my-2">
                                    <div class="col-md-3">طول الصدر</div>
                                    <div class="col-md-3">
                                        <input type="text" id="chest_length" class="form-control"
                                               name="chest_length" value="{{old('chest_length')}}">
                                        <span id="chest_length_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-3">طول الذراع</div>
                                    <div class="col-md-3">
                                        <input type="text" id="arm_length" class="form-control"
                                               name="arm_length" value="{{old('arm_length')}}">
                                        <span id="arm_length_error" class="text-danger"></span>
                                    </div>

                                </div>
                                <div class="row my-2">
                                    <div class="col-md-3">طول الكتف</div>
                                    <div class="col-md-3">
                                        <input type="text" id="shoulder_length" class="form-control"
                                               name="shoulder_length" value="{{old('shoulder_length')}}">
                                        <span id="shoulder_length_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-3">محيط الذراع</div>
                                    <div class="col-md-3">
                                        <input type="text" id="arm_circumference" class="form-control"
                                               name="arm_circumference" value="{{old('arm_circumference')}}">
                                        <span id="arm_circumference_error" class="text-danger"></span>
                                    </div>

                                </div>
                                <div class="row my-2">
                                    <div class="col-md-3">عرض الظهر</div>
                                    <div class="col-md-3">
                                        <input type="text" id="back_view" class="form-control"
                                               name="back_view" value="{{old('back_view')}}">
                                        <span id="back_view_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-3">طول حردة الابط</div>
                                    <div class="col-md-3">
                                        <input type="text" id="armpit_length" class="form-control"
                                               name="armpit_length" value="{{old('armpit_length')}}">
                                        <span id="armpit_length_error" class="text-danger"></span>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="action" id="action" value="Add">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    <button type="button" class="btn btn-yellow  MontserratArabicLight font22" id="addSize">التأكيد</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-5 justify-content-end">
        <a class="btn btn-yellow  m-3 px-5" href="{{route('basket.products.index')}}">رجوع </a>
    </div>

</div>
{{-- Confirmation Modal --}}
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" style="width: 500px" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">تأكيد عملية الحذف</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>

            <form id="delete_modal_form">
                @csrf
                {{method_field('delete')}}

                <div class="modal-body">
                    <input type="hidden" id="delete_language">
                    <h5 class="text-right">هل أنت متأكد من حذف هذا المقاس !!</h5>
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

@include('site.customer.footer')



@section('script')

    <script>
        $(document).ready(function () {
            var url_update;
            $(document).on('click', '.is_sure', function (e) {
                e.preventDefault();
                let status = $(this).attr('data-status');
                let product_id = $(this).attr('data-product-id');
                console.log(status);
                console.log(product_id);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: '{{ route('update.status') }}',
                    data: {'status': status, 'product_id': product_id},
                    success: function (data) {
                        toastr.success(data.msg);
                       // $('#product_status').html(data.product_status);

                    }
                });
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var customerSizeTable = $('.customer-size-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route("customer.sizes", $customer_id)}}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'category', name: 'category'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                language:{"url" :"{{asset('/public/assets/admin/js/dataTableArabic.json')}}"},
            });

            $(document).on('click', '.removeFromBasket', function (e) {
                e.preventDefault();

                var Clickedthis = $(this);
                var product_id = $(Clickedthis).closest('.delete-product').attr('data-product-id');

                @guest('customer')
                toastr.warning('انت غير مسجل دخول في النظام')
                @endguest

                $.ajax({
                    type: 'delete',
                    url: "{{Route('ProductBasket.destroy')}}",
                    data: {
                        'product_id': $(this).attr('data-product-id'),
                    },
                    success: function (data) {
                        $(Clickedthis).closest('.delete-product').remove();
                        toastr.success(data.msg);
                        $('#total_price').html(data.total_price + ' ر.س ');
                    }
                });
            });

            $(document).on('change', '.selectSize', function (e) {
                e.preventDefault();
                let product_id = $(this).attr('data-product-id');
                let size_id = $(this).val();
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: '{{ route('select.size') }}',
                    data: {'product_id': product_id , 'size_id': size_id},
                    success: function (data) {
                        toastr.success(data.msg);
                        // $('#product_status').html(data.product_status);

                    }
                });
            });

            $('body').on('click', '#addNewSize', function () {
               // var product_id = $(this).data('product-id');
                $('#sizeModal').modal('show');
                $('#sizeForm').trigger('reset');
                $('#addSize').html('تأكيد');
                $('#action').val('Add');
                $('#modal_header').html('اضافة مقاس');
            });

            $('#addSize').on('click', function (e) {
                e.preventDefault();
                var id = $('#id').val();
                var name = $('#name').val();
                var customer_id = $('#customer_id').val();
                var category_id = $('#category_id').val();
                var chest_circumference = $('#chest_circumference').val();
                var waistline = $('#waistline').val();
                var buttock_circumference = $('#buttock_circumference').val();
                var length_by_chest = $('#length_by_chest').val();
                var chest_length = $('#chest_length').val();
                var shoulder_length = $('#shoulder_length').val();
                var back_view = $('#back_view').val();
                var neck_length = $('#neck_length').val();
                var neck_width = $('#neck_width').val();
                var neck_circumference = $('#neck_circumference').val();
                var distance_between_breasts = $('#distance_between_breasts').val();
                var arm_length = $('#arm_length').val();
                var arm_circumference = $('#arm_circumference').val();
                var armpit_length = $('#armpit_length').val();
                //var formData = new FormData($('#sizeForm')[0]);
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

                if ($('#action').val() === 'Add'){
                    $.ajax({
                        type: 'post',
                        url: "{{route('add.size')}}",
                        enctype: 'multipart/form-data',
                        data: {
                            'customer_id': customer_id,
                            'name': name,
                            'category_id': category_id,
                            'chest_circumference': chest_circumference,
                            'waistline': waistline,
                            'buttock_circumference': buttock_circumference,
                            'length_by_chest': length_by_chest,
                            'chest_length': chest_length,
                            'shoulder_length': shoulder_length,
                            'back_view': back_view,
                            'neck_length': neck_length,
                            'neck_width': neck_width,
                            'neck_circumference': neck_circumference,
                            'distance_between_breasts': distance_between_breasts,
                            'arm_length': arm_length,
                            'arm_circumference': arm_circumference,
                            'armpit_length': armpit_length,

                        },
                        // processData: false,
                        // contentType: false,
                        cache: false,
                        dataType: 'json',

                        success: function (data) {
                            if (data.status == true) {
                                toastr.success(data.msg);
                                $('#sizeForm').trigger('reset');
                                $('#sizeModal').modal('hide');
                                customerSizeTable.draw();
                            } else {
                                toastr.error(data.msg);
                                $('#sizeForm').trigger('reset');
                                $('#sizeModal').modal('hide');
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
                }if ($('#action').val() === 'update'){
                    $.ajax({
                        type: 'post',
                        url: "{{route('update.size')}}",
                        enctype: 'multipart/form-data',
                        data: {
                            'id': id,
                            'customer_id': customer_id,
                            'name': name,
                            'category_id': category_id,
                            'chest_circumference': chest_circumference,
                            'waistline': waistline,
                            'buttock_circumference': buttock_circumference,
                            'length_by_chest': length_by_chest,
                            'chest_length': chest_length,
                            'shoulder_length': shoulder_length,
                            'back_view': back_view,
                            'neck_length': neck_length,
                            'neck_width': neck_width,
                            'neck_circumference': neck_circumference,
                            'distance_between_breasts': distance_between_breasts,
                            'arm_length': arm_length,
                            'arm_circumference': arm_circumference,
                            'armpit_length': armpit_length,

                        },
                        // processData: false,
                        // contentType: false,
                        cache: false,
                        dataType: 'json',

                        success: function (data) {
                            if (data.status == true) {
                                toastr.success(data.msg);
                                $('#sizeForm').trigger('reset');
                                $('#sizeModal').modal('hide');
                                customerSizeTable.draw();
                            } else {
                                toastr.error(data.msg);
                                $('#sizeForm').trigger('reset');
                                $('#sizeModal').modal('hide');
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
                }


            });

            $(document).on('click', '.editSize', function () {
                var id = $(this).data('id');

                $('#action').val('update');
                $.ajax({
                    type: 'post',
                    url: "{{route('edit.size')}}",
                    enctype: 'multipart/form-data',
                    data: {
                        'id': id,
                    },
                    // processData: false,
                    // contentType: false,
                    cache: false,
                    dataType: 'json',

                    success: function (data) {
                        $('#modal_header').html('تعديل المقاس : ' + data.name);
                        $('#addSize').html('تحديث');
                        $('#sizeModal').modal('show');
                        $('#id').val(data.id);
                        $('#name').val(data.name);
                        $('#customer_id').val(data.customer_id);
                        $('select[name="category_id"]').val(data.category_id);
                        $('#chest_circumference').val(data.chest_circumference);
                        $('#waistline').val(data.waistline);
                        $('#buttock_circumference').val(data.buttock_circumference);
                        $('#length_by_chest').val(data.length_by_chest);
                        $('#chest_length').val(data.chest_length);
                        $('#shoulder_length').val(data.shoulder_length);
                        $('#back_view').val(data.back_view);
                        $('#neck_length').val(data.neck_length);
                        $('#neck_width').val(data.neck_width);
                        $('#neck_circumference').val(data.neck_circumference);
                        $('#distance_between_breasts').val(data.distance_between_breasts);
                        $('#arm_length').val(data.arm_length);
                        $('#arm_circumference').val(data.arm_circumference);
                        $('#armpit_length').val(data.armpit_length);
                    },


                });

            });

            $(document).on('click', '.deleteSize', function () {
                var id = $(this).data('id');
                $('#delete-modal').modal('show');

                $('#delete').click(function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'post',
                        url: "{{route('delete.size')}}" ,
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
