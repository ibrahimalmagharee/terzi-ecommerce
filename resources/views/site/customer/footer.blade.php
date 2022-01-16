<footer class="bg-dark">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-sm-12 d-flex">
                <a class="navbar-brand MontserratArabic-logo text-warning pt-4 footer-logo" href="{{route('index')}}">
                    @isset($logo)
                        <img src="{{$logo->getPhoto($logo->photo)}}" style="width: 50px">

                    @else
                        ترزي
                    @endisset
                </a>
            </div>

            <div class="col-md-2 col-sm-12">
                <ul class="footer-col pt-4">
                    <li class="py-2">
                        <a class="text-white" href="{{route('index')}}">الرئيسية</a>
                    </li>
                    <li class="py-2">
                        <a class="text-white" href="{{route('customer.viewFabricProduct')}}">الأقمشة</a>
                    </li>
                    <li class="py-2">
                        <a class="text-white" href="{{route('customer.viewDesignProduct')}}">التصاميم</a>
                    </li>
                    <li class="py-2">
                        <a class="text-white" href="{{route('customer.getMyPurchases')}}">مشترياتي</a>
                    </li>
                    <li class="py-2">
                        <a class="text-white" href="{{route('customer.viewCompanies')}}">الشركات</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-2 col-sm-12">
                <ul class="footer-col pt-4">
                    <li class="py-2">
                        <a class="text-muted" href="{{route('aboutLanding')}}">من نحن ؟</a>
                    </li>
                    <li class="py-2">
                        <a class="text-muted" href="">المساعدة</a>
                    </li>
                    <li class="py-2">
                        <a class="text-muted" href="{{route('termCondition')}}">الشروط و الأحكام</a>
                    </li>
                    <li class="py-2">
                        <a class="text-muted" href="{{route('usagePolicy')}}">سياسة الاستخدام</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-12">
                <form class="form-inline pt-4">
                    <div class="col p-0 text-right">
                        <div class="input-group ">
                            <input type="text" class="form-control bg-dark text-white border-left-0 rounded-right"
                                   placeholder="الايميل">
                            <div class="input-group-prepend">
                                <button type="submit"
                                        class=" rounded-left border-right-0 bg-dark text-white input-group-text">
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
                    @if (count($social_media_link))

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
                    @endif
                </div>

            </div>
        </div>
        <div class="row">
            <p class="copy-right mr-auto text-white">Tarze© Copyright 2020</p>
        </div>
    </div>
</footer>
