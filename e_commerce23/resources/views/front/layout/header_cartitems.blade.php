<?php
    use App\Models\Products;
    $getCartItems=getCartItems();
    ?>
<!--====== Mini Product Container ======-->
<div class="mini-product-container gl-scroll u-s-m-b-15">
    @php
    $total_price=0;
    @endphp
    @foreach($getCartItems as $item)
    <?php $getAttributePrice=Products::getAttributePrice($item['product_id'],$item['product_size']);
    // dd($getAttributePrice);
     ?>
    <!--====== Card for mini cart ======-->
    <div class="card-mini-product">
        <div class="mini-product">
            <div class="mini-product__image-wrapper">
                <a href="{{url('product/'.$item['id'])}}">
                    @if(isset($item['product']['images'][0]['image']) && !empty($item['product']['images'][0]['image']))
                    <img class="u-img-fluid"
                        src="{{ asset('admin-assets/front/products/small/'.$item['product']['images'][0]['image']) }}"
                        alt="">
                    @else
                    <img class="u-img-fluid"
                        src="{{ asset('admin-assets/front/products/small/.sitemakers-tshirt.png') }}" alt="">
                    @endif
                </a>
            </div>
            <div class="mini-product__info-wrapper">
                <span class="mini-product__category">
                    <a href="{{url('product/'.$item['id'])}}">{{$item['product']['brand']['brand_name']}}</a></span>
                <span class="mini-product__name">
                    <a href="product-detail.html">{{ $item['product']['product_name'] }}</a></span>
                <span class="mini-product__quantity">{{$item['product_qty']}} x {{$item['product_size']}}</span>
                <span class="mini-product__price">₹{{ $getAttributePrice['final_price'] * $item['product_qty']}}</span>
            </div>
        </div>
        <a class="mini-product__delete-link far fa-trash-alt"></a>
    </div>
    @php
    $total_price += ($item['product']['final_price'] * $item['product_qty']);
    
@endphp
    @endforeach

</div>
<!--====== End - Mini Product Container ======-->
<!--====== Mini Product Statistics ======-->
<div class="mini-product-stat">
    <div class="mini-total">
        <span class="subtotal-text">SUBTOTAL</span>
        <span class="subtotal-value">₹{{$total_price}}</span>
    </div>
    <div class="mini-action">
        <a class="mini-link btn--e-brand-b-2" href="checkout.html">PROCEED TO CHECKOUT</a>
        <a class="mini-link btn--e-transparent-secondary-b-2" href="cart.html">VIEW CART</a>
    </div>
</div>
<!--====== End - Mini Product Statistics ======-->
</div>