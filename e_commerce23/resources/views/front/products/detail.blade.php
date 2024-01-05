@extends('front.layout.layout')
@section('content')


<!--====== App Content ======-->
<div class="app-content">

    <!--====== Section 1 ======-->
    <div class="u-s-p-t-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">

                    <!--====== Product Breadcrumb ======-->
                    <div class="pd-breadcrumb u-s-m-b-30">
                        <ul class="pd-breadcrumb__list">
                            <li class="has-separator">

                            <?php echo $categoryDetails['breadcrumbs']; ?>
                        </ul>
                    </div>
                    <!--====== End - Product Breadcrumb ======-->


                    <!--====== Product Detail Zoom ======-->
                    <div class="pd u-s-m-b-30">
                        <div class="slider-fouc pd-wrap">
                            <div id="pd-o-initiate">
                                @foreach($productDetails['images'] as $image)
                                    
                                
                                <div class="pd-o-img-wrap" data-src="{{asset('admin-assets/front/products/large/'.$image['image'])}}">
                                    {{-- <div class="pd-o-img-wrap" data-src="{{asset('frontend/images/product/sitemakers-tshirt-large-1.png')}}"> --}}
                                    <img class="u-img-fluid" src="{{asset('admin-assets/front/products/large/'.$image['image'])}}" data-zoom-image="{{asset('admin-assets/front/products/large/'.$image['image'])}}" alt="">
                                </div>
                                @endforeach
                            </div>

                            <span class="pd-text">Click for larger zoom</span>
                        </div>
                        <div class="u-s-m-t-15">
                            <div class="slider-fouc">
                                <div id="pd-o-thumbnail">
                                    @foreach($productDetails['images'] as $image)
                                    <div>
                                        <img class="u-img-fluid" src="{{asset('admin-assets/front/products/small/'.$image['image'])}}" alt="">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--====== End - Product Detail Zoom ======-->
                </div>
                <div class="col-lg-7">

                    <!--====== Product Right Side Details ======-->
                    <div class="pd-detail">
                        <div>
                            <div class="print-err-msg" style="display: none;"></div>
                            <div class="print-successs-msg" style="display: none;"></div>

                            <span class="pd-detail__name">{{$productDetails['product_name']}}</span></div>
                        <div>
                            <div class="pd-detail__inline getAttributePrice ">

                                <span class="pd-detail__price "> @if(isset($productDetails['final_price']))  ₹{{ $productDetails['final_price'] }} @else 734 @endif</span>

                                @if(isset($productDetails['discount_type']))
                                <span class="pd-detail__discount">@isset($productDetails['product_discount']) ({{ $productDetails['product_discount'] }}% OFF) @else 15 % OFF @endisset</span>
                                @endif
                        
                                @if(isset($productDetails['product_price']))
                                <del class="pd-detail__del">₹{{ $productDetails['product_price'] }}</del>
                                @endif 
                                
                        <div class="u-s-m-b-15">
                            <div class="pd-detail__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>

                                <span class="pd-detail__review u-s-m-l-4">

                                    <a data-click-scroll="#view-review">25 Reviews</a></span></div>
                        </div>
                        <div class="u-s-m-b-15">
                            <div class="pd-detail__inline">

                                <span class="pd-detail__stock">200 in stock</span>

                                <span class="pd-detail__left">Only 2 left</span></div>
                        </div>
                        <div class="u-s-m-b-15">

                            <span class="pd-detail__preview-desc">{{$productDetails['description']}}.</span></div>
                        <div class="u-s-m-b-15">
                            <div class="pd-detail__inline">
                                <span class="pd-detail__click-wrap"><i class="far fa-heart u-s-m-r-6"></i>
                                    <a href="signin.html">Add to Wishlist</a>
                                </span>
                            </div>
                        </div>
                        
                        <div class="u-s-m-b-15">
                            <ul class="pd-social-list">
                                <li>
                                    <?php $facebookUrl = 'https://www.facebook.com/'; ?>
                                    <a class="s-fb--color-hover" href="{{ $facebookUrl }}"><i class="fab fa-facebook-f"></i></a>

                                <li>

                                    <a class="s-tw--color-hover" href="{{'https://twitter.com/i/flow/login'}}"><i class="fab fa-twitter"></i></a></li>
                                <li>

                                    <a class="s-insta--color-hover" href="{{'https://www.instagram.com/accounts/login/'}}"><i class="fab fa-instagram"></i></a></li>
                                <li>

                                    <a class="s-wa--color-hover" href="{{'https://web.whatsapp.com/'}}"><i class="fab fa-whatsapp"></i></a></li>
                                <li>

                                    <a class="s-gplus--color-hover" href="{{'https://google.com/'}}"><i class="fab fa-google-plus-g"></i></a></li>
                            </ul>
                        </div>
                        
                        <div class="u-s-m-b-15">
                            <form id="addToCart" name="addToCart" class="pd-detail__form" action="javascript:;">
                                <input type="hidden" name="product_id" value="{{$productDetails['id']}}">
                                @if(count($groupProducts) > 0)
                                <div class="u-s-m-b-15">

                                    <span class="pd-detail__label u-s-m-b-8">Color:</span>
                                    <div class="pd-detail__color">
                                        @foreach($groupProducts as $product)
                                        <a href="{{url('product/'.$product['id'])}}">
                                            <div class="color__radio">
                                                <label class="color__radio-label" for="folly" style="background-color: {{$product['product_color']}}"></label>
                                            </div>
                                        </a>
                                        @endforeach
                                        
                                    </div>
                                </div>
                                @endif
                                <div class="u-s-m-b-15">

                                    <span class="pd-detail__label u-s-m-b-8">Size:</span>
                                    <div class="pd-detail__size">
                                        @foreach($productDetails['attributes'] as $attributes)
                                        
                                        <div class="size__radio">

                                            <input type="radio" id="{{$attributes['size']}}" name="size" value="{{$attributes['size']}}" product-id="{{$productDetails['id']}}" class="getPrice" checked required>

                                            <label class="size__radio-label" for="{{$attributes['size']}}">{{$attributes['size']}}</label>
                                        </div>
                                        @endforeach
                                        
                                    </div>
                                </div>
                                <div class="pd-detail-inline-2">
                                    <div class="u-s-m-b-15">

                                        <!--====== Input Counter ======-->
                                        <div class="input-counter">

                                            <span class="input-counter__minus fas fa-minus"></span>

                                            <input class="input-counter__text input-counter--text-primary-style" type="text" value="1" data-min="1" data-max="1000" name="qty" id="qty">

                                            <span class="input-counter__plus fas fa-plus"></span></div>
                                        <!--====== End - Input Counter ======-->
                                    </div>
                                    <div class="u-s-m-b-15">

                                        <button class="btn btn--e-brand-b-2" type="submit">Add to Cart</button></div>
                                </div>
                            </form>
                        </div>
                        
                        <div class="u-s-m-b-15">

                            <span class="pd-detail__label u-s-m-b-8">Product Policy:</span>
                            <ul class="pd-detail__policy-list">
                                <li><i class="fas fa-check-circle u-s-m-r-8"></i>

                                    <span>Buyer Protection.</span></li>
                                <li><i class="fas fa-check-circle u-s-m-r-8"></i>

                                    <span>Full Refund if you don't receive your order.</span></li>
                                <li><i class="fas fa-check-circle u-s-m-r-8"></i>

                                    <span>Returns accepted if product not as described.</span></li>
                            </ul>
                        </div>
                    </div>
                    <!--====== End - Product Right Side Details ======-->
                </div>
            </div>
        </div>
    </div>

    <!--====== Product Detail Tab ======-->
    <div class="u-s-p-y-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pd-tab">
                        <div class="u-s-m-b-30">
                            <ul class="nav pd-tab__list">
                                <li class="nav-item">

                                    <a class="nav-link" data-toggle="tab" href="#pd-desc">DESCRIPTION</a></li>
                                <li class="nav-item">

                                    <a class="nav-link" data-toggle="tab" href="#pd-tag">VIDEO</a></li>
                                <li class="nav-item">

                                    <a class="nav-link active" id="view-review" data-toggle="tab" href="#pd-rev">REVIEWS
                                        <span>(25)</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">

                            <!--====== Tab 1 ======-->
                            <div class="tab-pane" id="pd-desc">
                                <div class="pd-tab__desc">
                                    <div class="u-s-m-b-15">
                                        <p>
                                            @if(isset($productDetails['description']) && !empty($productDetails['description']))
                                                {{ $productDetails['description'] }}
                                            @else
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s...
                                            @endif
                                        </p>
                                                                            </div>
                                    <div class="u-s-m-b-30"><iframe src="https://www.youtube.com/embed/qKqSBm07KZk" allowfullscreen></iframe></div>
                                    <!-- <div class="u-s-m-b-30">
                                        <ul>
                                            <li><i class="fas fa-check u-s-m-r-8"></i>

                                                <span>Buyer Protection.</span></li>
                                            <li><i class="fas fa-check u-s-m-r-8"></i>

                                                <span>Full Refund if you don't receive your order.</span></li>
                                            <li><i class="fas fa-check u-s-m-r-8"></i>

                                                <span>Returns accepted if product not as described.</span></li>
                                        </ul>
                                    </div> -->
                                    <div class="u-s-m-b-15">
                                        <h4>PRODUCT INFORMATION</h4>
                                    </div>
                                    <div class="u-s-m-b-15">
                                        <div class="pd-table gl-scroll">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td>Product Code</td>
                                                        <td> @if(isset($productDetails['product_code']) && !empty($productDetails['product_code']))
                                                            {{ $productDetails['product_code'] }}
                                                        @else
                                                        RC001
                                                        @endif </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Product Color</td>
                                                        <td>@if(isset($productDetails['product_color']) && !empty($productDetails['product_color']))
                                                            {{ $productDetails['product_color'] }}
                                                        @else
                                                           Red 
                                                        @endif </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Fabric</td>
                                                        <td>@if(isset($productDetails['fabric']) && !empty($productDetails['fabric']))
                                                            {{ $productDetails['fabric'] }}
                                                        @else
                                                        Cotton
                                                        @endif </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sleeve</td>
                                                        <td>@if(isset($productDetails['sleeve']) && !empty($productDetails['sleeve']))
                                                            {{ $productDetails['sleeve'] }}
                                                        @else
                                                        Long Sleeve 
                                                        @endif </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Fit</td>
                                                        <td>@if(isset($productDetails['fit']) && !empty($productDetails['fit']))
                                                            {{ $productDetails['fit'] }}
                                                        @else
                                                        Regular
                                                        @endif </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Neck</td>
                                                        <td>@if(isset($productDetails['description']) && !empty($productDetails['description']))
                                                            {{ $productDetails['description'] }}
                                                        @else
                                                        Round Neck
                                                        @endif </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Occasion</td>
                                                        <td>@if(isset($productDetails['occassion']) && !empty($productDetails['occassion']))
                                                            {{ $productDetails['occassion'] }}
                                                        @else
                                                        Casual
                                                        @endif </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shipping Weight (Grams)</td>
                                                        <td>@if(isset($productDetails['product_weight']) && !empty($productDetails['product_weight']))
                                                            {{ $productDetails['product_weight'] }}
                                                        @else
                                                        500
                                                        @endif </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--====== End - Tab 1 ======-->


                            <!--====== Tab 2 ======-->
                            <div class="tab-pane" id="pd-tag">
                                <div class="pd-tab__tag">
                                    <h2 class="u-s-m-b-15">PRODUCT VIDEO</h2>
                                    <div class="u-s-m-b-15">
                                        @if($productDetails['product_video'] > 0)
                                           
                                        <video width="400" controls>
                                          <source src="{{url('admin-assets/front/VIDEOS/'.$productDetails['product_video'])}}" type="video/mp4">
                                          {{-- <source src="video/sample.mp4" type="video/mp4"> --}}
                                        
                                          Your browser does not support HTML video.
                                        </video>
                                        @elseif($productDetails['product_video'])
                                            <img src="{{url('admin-assets/front/VIDEOS/'.$productDetails['product_video'])}}" alt="Product Image" width="400">

                                        @else
                                        product video does not exists!
                                        @endif

                                    </div>

                                    <span class="gl-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
                                </div>
                            </div>
                            <!--====== End - Tab 2 ======-->


                            <!--====== Tab 3 ======-->
                            <div class="tab-pane fade show active" id="pd-rev">
                                <div class="pd-tab__rev">
                                    <div class="u-s-m-b-30">
                                        <div class="pd-tab__rev-score">
                                            <div class="u-s-m-b-8">
                                                <h2>25 Reviews - 4.6 (Overall)</h2>
                                            </div>
                                            <div class="gl-rating-style-2 u-s-m-b-8"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></div>
                                            <div class="u-s-m-b-8">
                                                <h4>We want to hear from you!</h4>
                                            </div>

                                            <span class="gl-text">Tell us what you think about this item</span>
                                        </div>
                                    </div>
                                    <div class="u-s-m-b-30">
                                        <form class="pd-tab__rev-f1">
                                            <div class="rev-f1__group">
                                                <div class="u-s-m-b-15">
                                                    <h2>25 Review(s) for Double Shade Black Grey Casual T-Shirt</h2>
                                                </div>
                                                <div class="u-s-m-b-15">

                                                    <label for="sort-review"></label><select class="select-box select-box--primary-style" id="sort-review">
                                                        <option selected>Sort by: Best Rating</option>
                                                        <option>Sort by: Worst Rating</option>
                                                    </select></div>
                                            </div>
                                            <div class="rev-f1__review">
                                                <div class="review-o u-s-m-b-15">
                                                    <div class="review-o__info u-s-m-b-8">

                                                        <span class="review-o__name">Good Product</span>

                                                        <span class="review-o__date">22 July 2023 10:57:43</span></div>
                                                    <div class="review-o__rating gl-rating-style u-s-m-b-8"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>

                                                        <span>(4)</span></div>
                                                    <p class="review-o__text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                </div>
                                                <div class="review-o u-s-m-b-15">
                                                    <div class="review-o__info u-s-m-b-8">

                                                        <span class="review-o__name">Good Product</span>

                                                        <span class="review-o__date">22 July 2023 10:57:43</span></div>
                                                    <div class="review-o__rating gl-rating-style u-s-m-b-8"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>

                                                        <span>(4)</span></div>
                                                    <p class="review-o__text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                </div>
                                                <div class="review-o u-s-m-b-15">
                                                    <div class="review-o__info u-s-m-b-8">

                                                        <span class="review-o__name">Good Product</span>

                                                        <span class="review-o__date">22 July 2023 10:57:43</span></div>
                                                    <div class="review-o__rating gl-rating-style u-s-m-b-8"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>

                                                        <span>(4)</span></div>
                                                    <p class="review-o__text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="u-s-m-b-30">
                                        <form class="pd-tab__rev-f2">
                                            <h2 class="u-s-m-b-15">Add a Review</h2>

                                            <span class="gl-text u-s-m-b-15">Your email address will not be published. Required fields are marked *</span>
                                            <div class="u-s-m-b-30">
                                                <div class="rev-f2__table-wrap gl-scroll">
                                                    <table class="rev-f2__table">
                                                        <thead>
                                                            <tr>
                                                                <th>
                                                                    <div class="gl-rating-style-2"><i class="fas fa-star"></i>

                                                                        <span>(1)</span></div>
                                                                </th>
                                                                <th>
                                                                    <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>

                                                                        <span>(1.5)</span></div>
                                                                </th>
                                                                <th>
                                                                    <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i>

                                                                        <span>(2)</span></div>
                                                                </th>
                                                                <th>
                                                                    <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>

                                                                        <span>(2.5)</span></div>
                                                                </th>
                                                                <th>
                                                                    <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>

                                                                        <span>(3)</span></div>
                                                                </th>
                                                                <th>
                                                                    <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>

                                                                        <span>(3.5)</span></div>
                                                                </th>
                                                                <th>
                                                                    <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>

                                                                        <span>(4)</span></div>
                                                                </th>
                                                                <th>
                                                                    <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>

                                                                        <span>(4.5)</span></div>
                                                                </th>
                                                                <th>
                                                                    <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>

                                                                        <span>(5)</span></div>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>

                                                                    <!--====== Radio Box ======-->
                                                                    <div class="radio-box">

                                                                        <input type="radio" id="star-1" name="rating">
                                                                        <div class="radio-box__state radio-box__state--primary">

                                                                            <label class="radio-box__label" for="star-1"></label></div>
                                                                    </div>
                                                                    <!--====== End - Radio Box ======-->
                                                                </td>
                                                                <td>

                                                                    <!--====== Radio Box ======-->
                                                                    <div class="radio-box">

                                                                        <input type="radio" id="star-1.5" name="rating">
                                                                        <div class="radio-box__state radio-box__state--primary">

                                                                            <label class="radio-box__label" for="star-1.5"></label></div>
                                                                    </div>
                                                                    <!--====== End - Radio Box ======-->
                                                                </td>
                                                                <td>

                                                                    <!--====== Radio Box ======-->
                                                                    <div class="radio-box">

                                                                        <input type="radio" id="star-2" name="rating">
                                                                        <div class="radio-box__state radio-box__state--primary">

                                                                            <label class="radio-box__label" for="star-2"></label></div>
                                                                    </div>
                                                                    <!--====== End - Radio Box ======-->
                                                                </td>
                                                                <td>

                                                                    <!--====== Radio Box ======-->
                                                                    <div class="radio-box">

                                                                        <input type="radio" id="star-2.5" name="rating">
                                                                        <div class="radio-box__state radio-box__state--primary">

                                                                            <label class="radio-box__label" for="star-2.5"></label></div>
                                                                    </div>
                                                                    <!--====== End - Radio Box ======-->
                                                                </td>
                                                                <td>

                                                                    <!--====== Radio Box ======-->
                                                                    <div class="radio-box">

                                                                        <input type="radio" id="star-3" name="rating">
                                                                        <div class="radio-box__state radio-box__state--primary">

                                                                            <label class="radio-box__label" for="star-3"></label></div>
                                                                    </div>
                                                                    <!--====== End - Radio Box ======-->
                                                                </td>
                                                                <td>

                                                                    <!--====== Radio Box ======-->
                                                                    <div class="radio-box">

                                                                        <input type="radio" id="star-3.5" name="rating">
                                                                        <div class="radio-box__state radio-box__state--primary">

                                                                            <label class="radio-box__label" for="star-3.5"></label></div>
                                                                    </div>
                                                                    <!--====== End - Radio Box ======-->
                                                                </td>
                                                                <td>

                                                                    <!--====== Radio Box ======-->
                                                                    <div class="radio-box">

                                                                        <input type="radio" id="star-4" name="rating">
                                                                        <div class="radio-box__state radio-box__state--primary">

                                                                            <label class="radio-box__label" for="star-4"></label></div>
                                                                    </div>
                                                                    <!--====== End - Radio Box ======-->
                                                                </td>
                                                                <td>

                                                                    <!--====== Radio Box ======-->
                                                                    <div class="radio-box">

                                                                        <input type="radio" id="star-4.5" name="rating">
                                                                        <div class="radio-box__state radio-box__state--primary">

                                                                            <label class="radio-box__label" for="star-4.5"></label></div>
                                                                    </div>
                                                                    <!--====== End - Radio Box ======-->
                                                                </td>
                                                                <td>

                                                                    <!--====== Radio Box ======-->
                                                                    <div class="radio-box">

                                                                        <input type="radio" id="star-5" name="rating">
                                                                        <div class="radio-box__state radio-box__state--primary">

                                                                            <label class="radio-box__label" for="star-5"></label></div>
                                                                    </div>
                                                                    <!--====== End - Radio Box ======-->
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="rev-f2__group">
                                                <div class="u-s-m-b-15">

                                                    <label class="gl-label" for="reviewer-text">YOUR REVIEW *</label><textarea class="text-area text-area--primary-style" id="reviewer-text"></textarea></div>
                                                <div>
                                                    <p class="u-s-m-b-30">

                                                        <label class="gl-label" for="reviewer-name">YOUR NAME *</label>

                                                        <input class="input-text input-text--primary-style" type="text" id="reviewer-name"></p>
                                                    <p class="u-s-m-b-30">

                                                        <label class="gl-label" for="reviewer-email">YOUR EMAIL *</label>

                                                        <input class="input-text input-text--primary-style" type="text" id="reviewer-email"></p>
                                                    <p class="u-s-m-b-30">

                                                        <label class="gl-label" for="review-title">REVIEW TITLE *</label>

                                                        <input class="input-text input-text--primary-style" type="text" id="review-title"></p>
                                                </div>
                                            </div>
                                            <div>

                                                <button class="btn btn--e-brand-shadow" type="submit">SUBMIT</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--====== End - Tab 3 ======-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Product Detail Tab ======-->
    <div class="u-s-p-b-90">

        <!--====== Section Intro ======-->
        <div class="section__intro u-s-m-b-46">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary u-s-m-b-12">RELATED PRODUCTS</h1>

                            <span class="section__span u-c-grey">PRODUCTS THAT YPU ALSO LIKE TO BUY</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Intro ======-->


        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="slider-fouc">
                    <div class="owl-carousel product-slider" data-item="4">
                        @foreach($relatedProducts as  $Product)
                        
                        <div class="u-s-m-b-30">
                            <div class="product-o product-o--hover-on">
                                <div class="product-o__wrap">
                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="">
                                    {{-- <a class="aspect aspect--bg-grey aspect--square u-d-block" href="{{url('product/'.$product['id'])}}"> --}}
                                        @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))
                                            <img class="aspect__img" src="{{ asset('admin-assets/front/products/small/'.$product['images'][0]['image']) }}" alt="">
                                        @else
                                            <img class="aspect__img" src="{{ asset('admin-assets/front/products/small/.sitemakers-tshirt.png') }}" alt="">

                                        @endif
                                    </a>
                                </div>
                                <span class="product-o__category">
                                    <a href="">@if(isset($product['brand']['brand_name']))
                                        <a href="">{{$product['brand']['brand_name']}}</a>
                                    @endif
                                </a></span>
                                <span class="product-o__name">

                                    <a href="">@if(isset($product['product_name']))
                                    {{-- <a href="{{url('product/'.$product['id'])}}">@if(isset($product['product_name'])) --}}
                                        <a href="">{{ $product['product_name'] }}</a>
                                        {{-- <a href="{{ url('product/'.$product['id']) }}">{{ $product['product_name'] }}</a> --}}
                                    @endif</a></span>
                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>

                                    <span class="product-o__review">(20)</span></div>

                                    <span class="product-o__price">
                                        @if(isset($product['final_price']))
                                            ₹{{ $product['final_price'] }}
                                            @if($product['discount_type'] == null)
                                                <span class="product-o__discount">₹{{ $product['product_price'] }}</span>
                                            @endif
                                        @endif
                                    </span>
                                    
                                    @if(isset($product['discount_type']) && $product['discount_type'] == null)
                                    <span class="product-o__discount">₹{{ $product['product_price'] }}</span>
                                @endif
                                
                            </div>
                        </div>                                                   
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
    <!--====== End - Section 1 ======-->
    <!--====== End - Product Detail Tab ======-->
    <div class="u-s-p-b-90">

        <!--====== Section Intro ======-->
        <div class="section__intro u-s-m-b-46">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary u-s-m-b-12">CUSTOMER ALSO VIEWED PRODUCTS</h1>
{{-- 
                            <span class="section__span u-c-grey">PRODUCTS THAT YPU ALSO LIKE TO BUY</span> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Intro ======-->


        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="slider-fouc">
                    <div class="owl-carousel product-slider" data-item="4">
                        @foreach($recentlyproducts as  $Product)
                        
                        <div class="u-s-m-b-30">
                            <div class="product-o product-o--hover-on">
                                <div class="product-o__wrap">
                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="">
                                    {{-- <a class="aspect aspect--bg-grey aspect--square u-d-block" href="{{url('product/'.$product['id'])}}"> --}}
                                        @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))
                                            <img class="aspect__img" src="{{ asset('admin-assets/front/products/small/'.$product['images'][0]['image']) }}" alt="">
                                        @else
                                            <img class="aspect__img" src="{{ asset('admin-assets/front/products/small/.sitemakers-tshirt.png') }}" alt="">

                                        @endif
                                    </a>
                                </div>
                                <span class="product-o__category">
                                    <a href="">@if(isset($product['brand']['brand_name']))
                                        <a href="">{{$product['brand']['brand_name']}}</a>
                                    @endif
                                </a></span>
                                <span class="product-o__name">

                                    <a href="">@if(isset($product['product_name']))
                                    {{-- <a href="{{url('product/'.$product['id'])}}">@if(isset($product['product_name'])) --}}
                                        <a href="">{{ $product['product_name'] }}</a>
                                        {{-- <a href="{{ url('product/'.$product['id']) }}">{{ $product['product_name'] }}</a> --}}
                                    @endif</a></span>
                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>

                                    <span class="product-o__review">(20)</span></div>

                                    <span class="product-o__price">
                                        @if(isset($product['final_price']))
                                            ₹{{ $product['final_price'] }}
                                            @if($product['discount_type'] == null)
                                                <span class="product-o__discount">₹{{ $product['product_price'] }}</span>
                                            @endif
                                        @endif
                                    </span>
                                    
                                    @if(isset($product['discount_type']) && $product['discount_type'] == null)
                                    <span class="product-o__discount">₹{{ $product['product_price'] }}</span>
                                @endif
                                
                            </div>
                        </div>                                                   
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
    <!--====== End - Section 1 ======-->
</div>
<!--====== End - App Content ======-->

@endsection