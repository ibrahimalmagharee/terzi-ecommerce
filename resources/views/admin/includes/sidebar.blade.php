<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item @if(request()->url() === route('admin.dashboard')) active @endif"><a href="{{route('admin.dashboard')}}"><i class="la la-home"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span></a>
            </li>

            @can('purchase')
                @php

                    $purchases = \App\Models\Purchase::get();

                    $product_id = [];

                    foreach ($purchases as $purchase) {
                        array_push($product_id, $purchase->product_id);
                    }

                    $products = \App\Models\Product::whereIn('id', $product_id)->get();

                    $design_id = [];
                    $fabric_id = [];
                    foreach ($products as $product) {

                        if ($product->productable_type == 'App\Models\Design') {
                            array_push($design_id, $product->productable_id);
                        } else {
                            array_push($fabric_id, $product->productable_id);
                        }
                    }

                    $designs = \App\Models\Design::whereIn('id', $design_id)->get();
                    $fabrics = \App\Models\Fabric::whereIn('id', $fabric_id)->get();

                    $count_fabric = 0;
                    foreach ($purchases as $purchase) {
                        foreach ($products as $product) {
                            if ($product->productable_type == 'App\Models\Fabric') {
                                if ($product->id == $purchase->product_id){
                                    $count_fabric +=1;
                                }

                            }
                        }
                    }

                    $count_design = 0;
                    foreach ($purchases as $purchase) {
                        foreach ($products as $product) {
                            if ($product->productable_type == 'App\Models\Design') {
                                if ($product->id == $purchase->product_id){
                                    $count_design +=1;
                                }

                            }
                        }
                    }
                @endphp
                <li class="nav-item"><a href=""><i class="la la-group"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">المبيعات </span>
                        <span class="badge badge badge-danger badge-pill float-right mr-2">{{$count_design + $count_fabric}}</span>

                    </a>

                    <ul class="menu-content">
                        <li class="@if(request()->url() === route('purchase.fabric')) active @endif"><a class="menu-item"
                                                                                                  href="{{route('purchase.fabric')}}"
                                                                                                  data-i18n="nav.dash.ecommerce">
                                مبيعات الأقمشة
                                <span class="badge badge badge-success badge-pill float-right mr-2">{{$count_fabric}}</span>
                            </a>
                        </li>

                        <li class="@if(request()->url() === route('purchase.design')) active @endif"><a class="menu-item"
                                                                                                  href="{{route('purchase.design')}}"
                                                                                                  data-i18n="nav.dash.ecommerce">
                                مبيعات التصميم
                                <span class="badge badge badge-danger badge-pill float-right mr-2">{{$count_design}}</span>
                            </a>
                        </li>

                    </ul>
                </li>
            @endcan


            {{--            <li class="nav-item"><a href=""><i class="la la-group"></i>--}}
            {{--                    <span class="menu-title" data-i18n="nav.dash.main">الصفحة الرئيسية للموقع </span>--}}
            {{--                </a>--}}
            {{--                <ul class="menu-content">--}}
            {{--                    <li class="{{'index.header_index' == request()->path() ? 'active' : ''}}"><a class="menu-item" href="{{route('index.header_index')}}" data-i18n="nav.dash.ecommerce">--}}
            {{--                            الرأسية--}}
            {{--                            <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\HeaderIndex::count()}}</span>--}}

            {{--                        </a>--}}
            {{--                    </li>--}}

            {{--                    <li class="{{'index.header_bottom' == request()->path() ? 'active' : ''}}"><a class="menu-item" href="{{route('index.header_bottom')}}" data-i18n="nav.dash.ecommerce">--}}
            {{--                            الرأسية الثانوية--}}
            {{--                            <span class="badge badge badge-warning badge-pill float-right mr-2">{{\App\Models\HeaderBottomIndex::count()}}</span>--}}

            {{--                        </a>--}}
            {{--                    </li>--}}

            {{--                    <li class="{{'index.fabric_slider' == request()->path() ? 'active' : ''}}"><a class="menu-item" href="{{route('index.fabric_slider')}}" data-i18n="nav.dash.ecommerce">--}}
            {{--                            سلايدر القماش--}}
            {{--                            <span class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\FabricSliderIndex::count()}}</span>--}}

            {{--                        </a>--}}
            {{--                    </li>--}}

            {{--                    <li class="{{'index.content_center_design' == request()->path() ? 'active' : ''}}"><a class="menu-item" href="{{route('index.content_center_design')}}" data-i18n="nav.dash.ecommerce">--}}
            {{--                            محتوى للتصميم--}}
            {{--                            <span class="badge badge badge-success badge-pill float-right mr-2">{{\App\Models\ContentCenterDesignIndex::count()}}</span>--}}

            {{--                        </a>--}}
            {{--                    </li>--}}

            {{--                </ul>--}}
            {{--            </li>--}}


            @can('product')
                <li class="nav-item"><a href=""><i class="la la-group"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">المنتجات </span>
                        <span
                            class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\Product::count()}}</span>
                    </a>
                    <ul class="menu-content">

                        @can('design')
                            <li class="@if(request()->url() === route('index.designs')) active @endif"><a class="menu-item"
                                                                                                          href="{{route('index.designs')}}"
                                                                                                          data-i18n="nav.dash.ecommerce">
                                    التصاميم
                                    <span
                                        class="badge badge badge-success badge-pill float-right mr-2">{{\App\Models\Design::count()}}</span>
                                </a>

                            </li>
                        @endcan

                        @can('fabric')
                            <li class="@if(request()->url() === route('index.fabrics')) active @endif"><a class="menu-item"
                                                                                                          href="{{route('index.fabrics')}}"
                                                                                                          data-i18n="nav.dash.ecommerce">
                                    الأقمشة
                                    <span
                                        class="badge badge badge-warning badge-pill float-right mr-2">{{\App\Models\Fabric::count()}}</span>
                                </a>

                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('users')
                <li class="nav-item"><a href=""><i class="la la-group"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> مستخدمين لوحة التحكم</span>
                        <span
                            class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\Admin::count()}}</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(request()->url() === route('index.users')) active @endif"><a class="menu-item"
                                                                                              href="{{route('index.users')}}"
                                                                                              data-i18n="nav.dash.ecommerce">
                                عرض الكل</a>
                        </li>

                    </ul>
                </li>

            @endcan

            @can('roles')
                <li class="nav-item"><a href=""><i class="la la-group"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">الصلاحيات </span>
                        <span
                            class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\Role::count()}}</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(request()->url() === route('index.roles')) active @endif"><a class="menu-item"
                                                                                              href="{{route('index.roles')}}"
                                                                                              data-i18n="nav.dash.ecommerce">
                                عرض الكل</a>
                        </li>

                    </ul>
                </li>
            @endcan

            @can('about-us')
                <li class="nav-item"><a href=""><i class="la la-group"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">نبذة الموقع </span>
                        <span
                            class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\AboutUs::count()}}</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(request()->url() === route('index.about')) active @endif"><a class="menu-item"
                                                                                              href="{{route('index.about')}}"
                                                                                              data-i18n="nav.dash.ecommerce">
                                عرض الكل</a>
                        </li>

                    </ul>
                </li>
            @endcan

            @can('vendor')
                <li class="nav-item"><a href=""><i class="la la-group"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">التجار </span>
                        <span
                            class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\Vendor::count()}}</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(request()->url() === route('index.vendors')) active @endif"><a class="menu-item"
                                                                                                href="{{route('index.vendors')}}"
                                                                                                data-i18n="nav.dash.ecommerce">
                                عرض الكل</a>
                        </li>

                        <li class="@if(request()->url() === route('index.about.vendors')) active @endif"><a class="menu-item"
                                                                                                      href="{{route('index.about.vendors')}}"
                                                                                                      data-i18n="nav.dash.ecommerce">
                                من نحن
                                <span
                                    class="badge badge badge-success badge-pill float-right mr-2">{{\App\Models\AboutVendor::count()}}</span>
                            </a>

                        </li>

                        <li class="@if(request()->url() === route('index.logo.vendors')) active @endif"><a class="menu-item"
                                                                                                      href="{{route('index.logo.vendors')}}"
                                                                                                      data-i18n="nav.dash.ecommerce">
                                الشعار
                                <span
                                    class="badge badge badge-success badge-pill float-right mr-2">{{\App\Models\LogoVendor::count()}}</span>
                            </a>

                        </li>

                        <li class="@if(request()->url() === route('index.contactUs.vendors')) active @endif"><a class="menu-item"
                                                                                                          href="{{route('index.contactUs.vendors')}}"
                                                                                                          data-i18n="nav.dash.ecommerce">
                                تواصل معنا
                                <span
                                    class="badge badge badge-warning badge-pill float-right mr-2">{{\App\Models\ContactVendor::count()}}</span>
                            </a>

                        </li>

                    </ul>
                </li>
            @endcan


            @can('customer')
                <li class="nav-item"><a href=""><i class="la la-group"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">العملاء </span>
                        <span
                            class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\Customer::count()}}</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(request()->url() === route('index.customers')) active @endif"><a class="menu-item"
                                                                                                  href="{{route('index.customers')}}"
                                                                                                  data-i18n="nav.dash.ecommerce">عرض
                                الكل</a>
                        </li>

                        <li class="@if(request()->url() === route('index.contactUs.customers')) active @endif"><a
                                class="menu-item" href="{{route('index.contactUs.customers')}}"
                                data-i18n="nav.dash.ecommerce">
                                تواصل معنا
                                <span
                                    class="badge badge badge-warning badge-pill float-right mr-2">{{\App\Models\ContactCustomer::count()}}</span>
                            </a>

                        </li>
                    </ul>
                </li>
            @endcan

            @can('category')
                <li class="nav-item"><a href=""><i class="la la-group"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">الاقسام </span>
                        <span
                            class="badge badge badge-warning badge-pill float-right mr-2">{{\App\Models\Category::count()}}</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(request()->url() === route('index.categories')) active @endif"><a class="menu-item"
                                                                                                   href="{{route('index.categories')}}"
                                                                                                   data-i18n="nav.dash.ecommerce">عرض
                                الكل</a>
                        </li>
                    </ul>
                </li>
            @endcan

           @can('type')
                <li class="nav-item"><a href=""><i class="la la-group"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">الأصناف </span>
                        <span
                            class="badge badge badge-secondary badge-pill float-right mr-2">{{\App\Models\Type::count()}}</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(request()->url() === route('index.types')) active @endif"><a class="menu-item"
                                                                                              href="{{route('index.types')}}"
                                                                                              data-i18n="nav.dash.ecommerce">عرض
                                الكل</a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('color')
                <li class="nav-item"><a href=""><i class="la la-group"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">الألوان </span>
                        <span
                            class="badge badge badge-success badge-pill float-right mr-2">{{\App\Models\Color::count()}}</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(request()->url() === route('index.colors')) active @endif"><a class="menu-item"
                                                                                               href="{{route('index.colors')}}"
                                                                                               data-i18n="nav.dash.ecommerce">عرض
                                الكل</a>
                        </li>
                    </ul>
                </li>
            @endcan


            @can('coupon')
                <li class="nav-item"><a href=""><i class="la la-group"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">أكواد الخصم (الكوبون) </span>
                        <span
                            class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\Coupon::count()}}</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(request()->url() === route('index.coupons')) active @endif"><a class="menu-item"
                                                                                                href="{{route('index.coupons')}}"
                                                                                                data-i18n="nav.dash.ecommerce">عرض
                                الكل</a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('social_media_link')
                <li class="nav-item"><a href=""><i class="la la-group"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">روابط التواصل</span>
                        <span
                            class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\SocialMediaLink::count()}}</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(request()->url() === route('index.social_media_link')) active @endif"><a class="menu-item"
                                                                                                      href="{{route('index.social_media_link')}}"
                                                                                                      data-i18n="nav.dash.ecommerce">عرض
                                الكل</a>
                        </li>
                    </ul>
                </li>


            @endcan

            @can('logo')
                <li class="nav-item"><a href=""><i class="la la-group"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">الشعار</span>
                        <span
                            class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\Logo::count()}}</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(request()->url() === route('index.logo')) active @endif"><a class="menu-item"
                                                                                                                href="{{route('index.logo')}}"
                                                                                                                data-i18n="nav.dash.ecommerce">عرض
                                الكل</a>
                        </li>
                    </ul>
                </li>


            @endcan


            @can('term_condition')
                <li class="nav-item"><a href=""><i class="la la-group"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">الشروط و الأحكام</span>
                        <span
                            class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\TermsAndConditions::count()}}</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(request()->url() === route('index.term_condition')) active @endif"><a class="menu-item"
                                                                                                             href="{{route('index.term_condition')}}"
                                                                                                             data-i18n="nav.dash.ecommerce">عرض
                                الكل</a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('usage_policy')
                <li class="nav-item"><a href=""><i class="la la-group"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">سياسة الاستخدام</span>
                        <span
                            class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\UsagePolicy::count()}}</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(request()->url() === route('index.usage_policy')) active @endif"><a class="menu-item"
                                                                                                           href="{{route('index.usage_policy')}}"
                                                                                                           data-i18n="nav.dash.ecommerce">عرض
                                الكل</a>
                        </li>
                    </ul>
                </li>
            @endcan



        </ul>
    </div>
</div>
