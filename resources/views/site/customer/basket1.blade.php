@extends('layouts.site')

@section('title')
    السلة
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
            <div class="col text-right d-flex p-0">
                <h4 class="section-title"> السلة</h4>
            </div>
            <div class="col text-left pt-3 px-0">
                <p class="MontserratArabicLightPure"> المجموع الكلي: <span class=" p-3 rounded shadow-sm"
                                                                           id="total_price">{{$total_price}} ر.س</span>
                </p>
            </div>
        </div>

    </div>


    @isset($designs)
        @foreach($designs as $index=>$design)
            <div class="row my-5 delete-product" data-design-id="{{$index+1}}" >
                <div class="col-lg-8 col-sm-6">
                    <div class="card mb-3  shadow-cust width-cust" style="width: 100%">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img class="img-product  pr-0 py-3" style="width: 100%; height: 200px;"
                                     src="{{$design->getPhoto($design->images[0]->photo)}}" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body text-right py-4 px-3">
                                    <div class="row">
                                        <div class="col-8 pr-2">
                                            <p class="card-title MontserratArabicLightPure">{{$design->name}}</p>
                                        </div>
                                        <div class="col text-danger text-left pr-0">
                                            <a class="MontserratArabicLightPure text-danger removeFromBasket"
                                               data-product-id="{{$design->product->id}}" style="cursor:pointer">حذف</a>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        @foreach($basket_products as $basket_product)
                                            @foreach($products as $product)
                                                @if($basket_product->product_id == $product->id)
                                                    @if($product->productable_type == 'App\Models\Design')
                                                        @if($design->id == $product->productable_id)
                                                            <small class="MontserratArabicLightPure"> العدد
                                                                - {{$basket_product->quantity}}</small>


                                    </div>
                                    <div class="row mt-2">
                                        <small class="MontserratArabicLightPure"
                                               href="">{{$design->product->vendor->name}}</small>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col pr-2">
                                            @if($design->product->offer)
                                                <p class="card-text pr-1"><s>{{$design->product->price}} ر.س</s></p>
                                                <p class="card-text pr-1">{{$design->product->price - (($design->product->price / 100) * $design->product->offer)}} ر.س </p>
                                            @else
                                                <p class="card-text pr-1">{{$design->product->price}} ر.س</p>
                                            @endif
                                        </div>

                                        <div class="col">
                                            <div class="row">
                                                @isset($sizes)
                                                    <div class="col text-danger text-left pr-0">

                                                        <select class="custom-select selectSize" data-product-id="{{$design->product->id}}">
                                                            <option value="">اختر المقاس</option>
                                                            @foreach($sizes as $size)
                                                                <option value="{{$size->id}}" @if($size->id == $basket_product->size_id) selected @endif>{{$size->name}}</option>
                                                            @endforeach
                                                        </select>


                                                    </div>

                                                @endisset
                                            </div>
                                            <div class="row my-2">
                                                <div class="col text-danger text-left pr-0">
                                                    <a class="btn btn-secondary w-100 MontserratArabicLightPure sizeModal" href="javascript:void(0)" data-product-id="{{$design->product->id}}" >اضافة المقاسات</a>
                                                </div>
                                            </div>
                                        </div>




                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 ">
                    <button class="btn  p-2 rounded shadow-sm MontserratArabicLightPure px-4 is_sure @if($basket_product->status == 1) d-none @endif"
                           data-status="{{$basket_product->status}}"
                            data-product-id="{{$design->product->id}}" style="margin-top: 40%;" id="not_sure_{{$index+1}}">
                        تأكيد
                    </button>

                    <button class="btn p-2 rounded shadow-sm MontserratArabicLightPure px-4 is_sure @if($basket_product->status == 0) d-none @endif "
                            data-status="{{$basket_product->status}}"
                            data-product-id="{{$design->product->id}}" style="margin-top: 40%; color: red" id="sure_{{$index+1}}">
                        الغاء تأكيد
                    </button>

                </div>

                @endif
                @endif
                @endif
                @endforeach
                @endforeach
            </div>
        @endforeach
    @endisset

    @isset($fabrics)
        @foreach($fabrics as $index=>$fabric)
            <div class="row my-5 delete-product" data-fabric-id="{{$index+1}}">
                <div class="col-lg-8 col-sm-6">
                    <div class="card mb-3  shadow-cust width-cust" style="width: 100%">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img class="img-product  pr-0 py-3" style="width: 100%; height: 200px;"
                                     src="{{$fabric->getPhoto($fabric->images[0]->photo)}}" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body text-right py-4 px-3">
                                    <div class="row">
                                        <div class="col-8 pr-2">
                                            <p class="card-title MontserratArabicLightPure">{{$fabric->name}}</p>
                                        </div>
                                        <div class="col text-danger text-left pr-0">
                                            <a class="MontserratArabicLightPure text-danger removeFromBasket"
                                               data-product-id="{{$fabric->product->id}}" style="cursor:pointer">حذف</a>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        @foreach($basket_products as $basket_product)
                                            @foreach($products as $product)
                                                @if($basket_product->product_id == $product->id)
                                                    @if($product->productable_type == 'App\Models\Fabric' )
                                                        @if($fabric->id == $product->productable_id)
                                                            <small class="MontserratArabicLightPure"> العدد
                                                                - {{$basket_product->quantity}}</small>

                                    </div>
                                    <div class="row mt-2">
                                        <small
                                            class="MontserratArabicLightPure">{{$fabric->product->vendor->name}}</small>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col pr-2">
                                            @if($fabric->product->offer)
                                                <p class="card-text pr-1"><s>{{$fabric->product->price}} ر.س</s></p>
                                                <p class="card-text pr-1">{{$fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)}} ر.س </p>
                                            @else
                                                <p class="card-text pr-1">{{$fabric->product->price}} ر.س</p>
                                            @endif

                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                @isset($sizes)
                                                    <div class="col text-danger text-left pr-0">
                                                        <select class="custom-select selectSize" data-product-id="{{$fabric->product->id}}">
                                                            <option value="">اختر المقاس</option>
                                                            @foreach($sizes as $size)
                                                                <option value="{{$size->id}}" @if($size->id == $basket_product->size_id) selected @endif>{{$size->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endisset
                                            </div>

                                            <div class="row  my-2">
                                                <div class="col text-danger text-left pr-0">
                                                    <a class="btn btn-secondary w-100 MontserratArabicLightPure sizeModal" href="javascript:void(0)" data-product-id="{{$fabric->product->id}}">اضافة المقاسات</a>
                                                </div>
                                            </div>

                                        </div>




                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <button class="btn  p-2 rounded shadow-sm MontserratArabicLightPure px-4 is_sure @if($basket_product->status == 1) d-none @endif" id="f_not_sure_{{$index+1}}"
                             data-status="{{$basket_product->status}}"
                            data-product-id="{{$fabric->product->id}}" style="margin-top: 40%;">
                       تأكيد
                    </button>

                    <button class="btn  p-2 rounded shadow-sm MontserratArabicLightPure px-4 is_sure @if($basket_product->status == 0) d-none @endif" id="f_sure_{{$index+1}}"
                            data-status="{{$basket_product->status}}"
                            data-product-id="{{$fabric->product->id}}" style="margin-top: 40%; color: red">
                        الغاء تأكيد
                    </button>
                </div>

                @endif
                @endif
                @endif
                @endforeach
                @endforeach
            </div>
        @endforeach
    @endisset
    <div class="modal fade" id="sizeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content width-800">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة مقاس جديد</h5>
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
        <a class="btn btn-yellow  m-3 px-5" href="{{route('customer.getCartPage')}}">التأكيد </a>
    </div>

</div>


@include('site.customer.footer')



@section('script')

    <script>
        $(document).ready(function () {
            $(document).on('click', '.is_sure', function (e) {
                e.preventDefault();
                let status = $(this).attr('data-status');
                let product_id = $(this).attr('data-product-id');
                let index_design_id = $(this).closest('.delete-product').attr('data-design-id');
                let index_fabric_id = $(this).closest('.delete-product').attr('data-fabric-id');
                console.log(status);
                console.log(product_id);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: '{{ route('update.status') }}',
                    data: {'status': status, 'product_id': product_id},
                    success: function (data) {
                        if (data.status == true){
                            toastr.success(data.msg);
                            if (data.product_status == 1) {
                                if (data.product_type === 'App\\Models\\Design') {
                                    $('#sure_'+index_design_id).addClass('display');
                                    $('#sure_'+index_design_id).removeClass('d-none');
                                    $('#sure_'+index_design_id).attr('data-status', data.product_status);
                                    $('#not_sure_'+index_design_id).attr('data-status', data.product_status);
                                    $('#not_sure_'+index_design_id).addClass('d-none');

                                } else if (data.product_type === 'App\\Models\\Fabric') {
                                    $('#f_sure_'+index_fabric_id).addClass('display');
                                    $('#f_sure_'+index_fabric_id).removeClass('d-none');
                                    $('#f_sure_'+index_fabric_id).attr('data-status', data.product_status);
                                    $('#f_not_sure_'+index_fabric_id).attr('data-status', data.product_status);
                                    $('#f_not_sure_'+index_fabric_id).addClass('d-none');
                                }


                            } else if(data.product_status == 0) {
                                if (data.product_type === 'App\\Models\\Design') {
                                    $('#sure_'+index_design_id).addClass('d-none');
                                    $('#not_sure_'+index_design_id).addClass('display');
                                    $('#not_sure_'+index_design_id).removeClass('d-none');
                                    $('#sure_'+index_design_id).attr('data-status', data.product_status);
                                    $('#not_sure_'+index_design_id).attr('data-status', data.product_status);

                                } else if (data.product_type === 'App\\Models\\Fabric') {
                                    $('#f_sure_'+index_fabric_id).addClass('d-none');
                                    $('#f_not_sure_'+index_fabric_id).addClass('display');
                                    $('#f_not_sure_'+index_fabric_id).removeClass('d-none');
                                    $('#f_sure_'+index_fabric_id).attr('data-status', data.product_status);
                                    $('#f_not_sure_'+index_fabric_id).attr('data-status', data.product_status);
                                }


                            }
                        } else {
                            toastr.warning(data.msg);
                        }





                    }
                });
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
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
                        $('.cart-products-count').html(data.cart_products_count)
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

            $('body').on('click', '.sizeModal', function () {
                var product_id = $(this).data('product-id');
                console.log(product_id)
                $('#sizeModal').modal('show');

                $('#addSize').on('click', function (e) {
                    e.preventDefault();
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

                    $.ajax({
                        type: 'post',
                        url: "{{ route('add.size') }}",
                        enctype: 'multipart/form-data',
                        data: {
                            'product_id': product_id,
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
                                console.log(data.size_id, data.size_name)
                                var option = $('<option value="'+data.size_id+'">'+data.size_name+'</option>');
                                $('.selectSize').append(option);
                                $('#sizeForm').trigger('reset');
                                $('#sizeModal').modal('hide');
                            } else {
                                toastr.error(data.msg);
                                $('#sizeForm').trigger('reset');
                                $('#sizeModal').modal('hide');
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
