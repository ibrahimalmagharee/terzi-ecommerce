
@isset($fabrics)
    @foreach($fabrics as $fabric)
        <div class="col-md-4 col-sm-12 pr-0 pl-5 col-resp my-2" id="col-width">
            <div class="card border-0 shadow-cust rounded-cust card-resp my-2" style="width: 100%">
                <a href="{{route('customer.viewFabricProductDetails',$fabric->id)}}">
                    <img src="{{$fabric->getPhoto($fabric->images[0]->photo)}}" class="card-img-top" style="width: 100%; height:280px">
                </a>
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
                        <p class="card-text">{{$fabric->product->vendor->name}}</p>
                        <div>
                            <button class="btn text-danger bg-white shadow-cust addToWishlist" data-product-id="{{$fabric->product->id}}">
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                            </button>
                            <button class="btn text-danger bg-white shadow-cust mr-2 addProductToBasket"  data-product-id="{{$fabric->product->id}}">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endisset

