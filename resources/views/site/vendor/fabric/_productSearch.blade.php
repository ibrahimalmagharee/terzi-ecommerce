@isset($fabrics)
    @foreach($fabrics as $fabric)
        @if($vendor->id == $fabric->product->vendor->id)
            @if($search != '')
                <div class="card mb-3 rounded-cust-prod shadow-cust width-cust" style="width: 100%">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img class="img-product rounded-cust-prod-right" style="width: 373px; height: 313px;"
                                 src="{{$fabric->getPhoto($fabric->images[0]->photo)}}" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body text-right py-4 px-5">
                                <div class="row">
                                    <div class="col pr-4">
                                        <h5 class="card-title">{{$fabric->name}}</h5>
                                    </div>
                                    <div class="col text-left">
                                        <p class="MontserratArabicLightPure">{{$fabric->product->sales}}  اشتريا هذا المنتج </p>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-10 pl-5 overflow-hidden">
                                        <p class="card-text">
                                            {{\Illuminate\Support\Str::limit($fabric->description, 100)}}
                                        </p>
                                        <br>
                                        <small class="MontserratArabicLightPure mt-1">{{$fabric->product->offer == '' ? 'لايوجد عرض' : $fabric->product->offer}} @if($fabric->product->offer != '') % @endif</small>
                                    </div>
                                    <div class="col pt-5 pr-4">
                                        <a class="MontserratArabicLightPure" href="{{route('vendor.viewFabricProductDetails',$fabric->id)}}">المزيد</a>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    @if($fabric->product->offer)
                                        <p class="card-text pr-3"><s>{{$fabric->product->price}} ر.س</s></p>
                                        <p class="card-text pr-3">{{$fabric->product->price - (($fabric->product->price / 100) * $fabric->product->offer)}} ر.س </p>
                                    @else
                                        <p class="card-text pr-3">{{$fabric->product->price}} ر.س</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="my-5">
                    <h5 class="MontserratArabicLight float-right">لا يوجد منتجات لعرضها الان</h5>
                </div>
                @endif


        @endif
    @endforeach
@endisset









