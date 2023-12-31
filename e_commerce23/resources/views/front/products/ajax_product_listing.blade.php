@foreach($categoryproducts as $product)
    
<div class="col-lg-4 col-md-6 col-sm-6">
    <div class="product-m">
        <div class="product-m__thumb">
            <a class="aspect aspect--bg-grey aspect--square u-d-block"
                href="">
                <a class="aspect aspect--bg-grey aspect--square u-d-block" href="{{url('product/'.$product['id'])}}">
                    @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))
                        <img class="aspect__img" src="{{ asset('admin-assets/front/products/small/'.$product['images'][0]['image']) }}" alt="">
                    @else
                      <img class="aspect__img" src="{{ asset('admin-assets/front/products/small/.sitemakers-tshirt.png') }}" alt="">

                    @endif
                </a>
            </a>
            <div class="product-m__quick-look">
                <a class="fas fa-search" data-modal="modal" data-modal-id="#quick-look"
                    data-tooltip="tooltip" data-placement="top" title="Quick Look"></a>
            </div>
            <div class="product-m__add-cart">
                <a class="btn--e-brand" data-modal="modal"
                    data-modal-id="#add-to-cart">View Details</a>
            </div>
        </div>
        <div class="product-m__content">
            <div class="product-m__category">
                <a href="shop-side-version-2.html">{{$product['brand']['brand_name']}}</a>
            </div>
            <div class="product-m__name">
                <a href="product-detail.html">{{$product['product_name']}}</a>
            </div>
            <div class="product-m__rating gl-rating-style"><i class="fas fa-star"></i><i
                    class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><i
                    class="far fa-star"></i><i class="far fa-star"></i>
                <span class="product-m__review">(25)</span>
            </div>
            <div class="product-m__price"> {{$product['final_price'] }}
                                                
                @if($product['discount_type'] == null) 
                {{-- @if($product['discount_type'] == null)  {{it is correct according stack developer but in my case shown discount type is null in mt db thats why we change  condition --}}
                    <span class="product-o__discount">₹{{ $product['product_price'] }}</span>                                     
                @endif

                {{-- <span class="product-m__discount">₹1000.00</span> --}}
            </div>
            <div class="product-m__hover">
                <div class="product-m__preview-description">

                    <span>{{$product['meta_description']}}</span>
                </div>
                <div class="product-m__wishlist">

                    <a class="far fa-heart" href="#" data-tooltip="tooltip"
                        data-placement="top" title="Add to Wishlist"></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach