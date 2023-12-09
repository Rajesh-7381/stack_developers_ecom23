@extends('front.layout.layout')
@section('content')
<!--====== App Content ======-->
 <div class="app-content">
    <!--====== Primary Slider ======-->
    
<div class="s-skeleton s-skeleton--h-600 s-skeleton--bg-grey">
    <div class="owl-carousel primary-style-1" id="sitemakers-slider">
        @foreach($homesliderbanner as  $sliderbanner)
        <div class="sitemakers-slide sitemakers-slide--1" style="background-image: url('{{ asset('admin-assets/front/banners/'.$sliderbanner['image']) }}');" alt="{{$sliderbanner['alt']}}">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="slider-content slider-content--animation">

                            <span class="content-span-2 u-c-secondary">{{$sliderbanner['title']}}</span>

                            <a class="shop-now-link btn--e-brand" href="{{$sliderbanner['link']}}">SHOP NOW</a></div>
                    </div>
                </div>
            </div>
        </div>
        
    @endforeach
        
        {{-- <div class="sitemakers-slide sitemakers-slide--2" style="background-image: url('{{ asset('frontend/images/banners/sitemaker-slider-banner-2.png') }}');">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="slider-content slider-content--animation">

                            <span class="content-span-2 u-c-secondary">20% Off on T-Shirts</span>

                            <a class="shop-now-link btn--e-brand" href="shop-side-version-2.html">SHOP NOW</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sitemakers-slide sitemakers-slide--3" style="background-image: url('{{ asset('frontend/images/banners/sitemaker-slider-banner-3.png') }}');">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="slider-content slider-content--animation">

                            <span class="content-span-2 u-c-secondary">15% Off on Jackets</span>

                            <a class="shop-now-link btn--e-brand" href="shop-side-version-2.html">SHOP NOW</a></div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
<!--====== End - Primary Slider ======-->
    <!--====== Section 1 ======-->
    <div class="u-s-p-y-60">
        <!--====== Section Intro ======-->
        <div class="section__intro u-s-m-b-46">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary u-s-m-b-12">SHOP BY DEALS</h1>
                            <span class="section__span u-c-silver">BROWSE FAVOURITE DEALS</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Intro ======-->
        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="row">
                    @if(isset($homefixbanner[0]['image']))
                    <div class="col-lg-5 col-md-5 u-s-m-b-30">
                        <a class="collection" href="{{$homefixbanner[0]['link']}}" title="{{$homefixbanner[0]['title']}}">
                            <div class="aspect aspect--bg-grey aspect--square">
                                <img class="aspect__img collection__img" src="{{asset('admin-assets/front/banners/'.$homefixbanner[0]['image'])}}" alt="">
                            </div>
                        </a>
                    </div>
                    @endif
                    @if(isset($homefixbanner[1]['image']))
                    <div class="col-lg-7 col-md-7 u-s-m-b-30">
                        <a class="collection" href="{{$homefixbanner[1]['link']}}" title="{{$homefixbanner[1]['title']}}">
                            <div class="aspect aspect--bg-grey aspect--1286-890">
                                <img class="aspect__img collection__img" src="{{asset('admin-assets/front/banners/'.$homefixbanner[1]['image'])}}" alt="">
                            </div>
                        </a>
                    </div>
                    @endif
                    @if(isset($homefixbanner[2]['image']))
                    <div class="col-lg-7 col-md-7 u-s-m-b-30">
                        <a class="collection" href="{{$homefixbanner[2]['link']}}" title="{{$homefixbanner[2]['title']}}">
                            <div class="aspect aspect--bg-grey aspect--1286-890">
                                <img class="aspect__img collection__img" src="{{asset('admin-assets/front/banners/'.$homefixbanner[2]['image'])}}" alt="">
                            </div>
                        </a>
                    </div>
                    @endif
                    @if(isset($homefixbanner[3]['image']))
                    <div class="col-lg-5 col-md-5 u-s-m-b-30">
                        <a class="collection" href="{{$homefixbanner[3]['link']}}" title="{{$homefixbanner[3]['title']}}">
                            <div class="aspect aspect--bg-grey aspect--square">
                                <img class="aspect__img collection__img" src="{{asset('admin-assets/front/banners/'.$homefixbanner[3]['image'])}}" alt="">
                            </div>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!--====== Section Content ======-->
    </div>
    <!--====== End - Section 1 ======-->
    <!--====== Section 2 ======-->
    <div class="u-s-p-b-60">
        <!--====== Section Intro ======-->
        <div class="section__intro u-s-m-b-16">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary u-s-m-b-12">TOP TRENDING</h1>
                            <span class="section__span u-c-silver">CHOOSE CATEGORY</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Intro ======-->
        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="filter-category-container">
                            <div class="filter__category-wrapper">
                                <button class="btn filter__btn filter__btn--style-1 js-checked" type="button" data-filter="*">ALL</button>
                            </div>
                            <div class="filter__category-wrapper">
                                <button class="btn filter__btn filter__btn--style-1" type="button" data-filter=".newarrivals">NEW ARRIVALS</button>
                            </div>
                            <div class="filter__category-wrapper">
                                <button class="btn filter__btn filter__btn--style-1" type="button" data-filter=".bestsellers">BEST SELLERS</button>
                            </div>
                            <div class="filter__category-wrapper">
                                <button class="btn filter__btn filter__btn--style-1" type="button" data-filter=".discountedproducts">DISCOUNTED PRODUCTS</button>
                            </div>
                            <div class="filter__category-wrapper">
                                <button class="btn filter__btn filter__btn--style-1" type="button" data-filter=".featuredproducts">FEATURED PRODUCTS</button>
                            </div>
                        </div>
                        <div class="filter__grid-wrapper u-s-m-t-30">
                            <div class="row">
                                @foreach($newproducts as $product)
                                
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30 filter__item newarrivals">
                                    <div class="product-o product-o--hover-on product-o--radius">
                                        <div class="product-o__wrap">
                                            <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
                                            <img class="aspect__img" src="" alt=""></a>
                                        </div>
                                        <span class="product-o__category">
                                        <a href="shop-side-version-2.html">{{$product['brand']['brand_name']}}</a></span>
                                        <span class="product-o__name">
                                        <a href="product-detail.html">{{$product['product_name']}}</a></span>
                                        <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                            <span class="product-o__review">(25)</span>
                                        </div>
                                        <span class="product-o__price">₹
                                            {{$product['final_price'] }}
                                                
                                                @if($product['discount_type'] == null) 
                                                {{-- @if($product['discount_type'] == null)  {{it is correct according stack developer but in my case shown discount type is null in mt db thats why we change  condition --}}
                                                    <span class="product-o__discount">₹{{ $product['product_price'] }}</span></span>                                      
                                                @endif
                                          
                                    </div>
                                </div>                                                                 
                                @endforeach                               
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="load-more">
                            <button class="btn btn--e-brand" type="button">View More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
    <!--====== Section 4 ======-->
    <div class="u-s-p-b-60">
        <!--====== Section Intro ======-->
        <div class="section__intro u-s-m-b-46">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary u-s-m-b-12">NEW ARRIVALS</h1>
                            <span class="section__span u-c-silver">GET UP FOR NEW ARRIVALS</span>
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
                        <div class="u-s-m-b-30">
                            <div class="product-o product-o--hover-on product-o--radius">
                                <div class="product-o__wrap">
                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
                                    <img class="aspect__img" src="{{asset('frontend/images/product/sitemakers-tshirt.png')}}" alt=""></a>
                                </div>
                                <span class="product-o__category">
                                <a href="shop-side-version-2.html">Brand Name</a></span>
                                <span class="product-o__name">
                                <a href="product-detail.html">Product Name</a></span>
                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    <span class="product-o__review">(25)</span>
                                </div>
                                <span class="product-o__price">₹900.00
                                <span class="product-o__discount">₹1000.00.00</span></span>
                            </div>
                        </div>
                        <div class="u-s-m-b-30">
                            <div class="product-o product-o--hover-on product-o--radius">
                                <div class="product-o__wrap">
                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
                                    <img class="aspect__img" src="{{asset('frontend/images/product/sitemakers-tshirt.png')}}" alt=""></a>
                                </div>
                                <span class="product-o__category">
                                <a href="shop-side-version-2.html">Brand Name</a></span>
                                <span class="product-o__name">
                                <a href="product-detail.html">Product Name</a></span>
                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    <span class="product-o__review">(25)</span>
                                </div>
                                <span class="product-o__price">₹900.00
                                <span class="product-o__discount">₹1000.00.00</span></span>
                            </div>
                        </div>
                        <div class="u-s-m-b-30">
                            <div class="product-o product-o--hover-on product-o--radius">
                                <div class="product-o__wrap">
                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
                                    <img class="aspect__img" src="{{asset('frontend/images/product/sitemakers-tshirt.png')}}" alt=""></a>
                                </div>
                                <span class="product-o__category">
                                <a href="shop-side-version-2.html">Brand Name</a></span>
                                <span class="product-o__name">
                                <a href="product-detail.html">Product Name</a></span>
                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    <span class="product-o__review">(25)</span>
                                </div>
                                <span class="product-o__price">₹900.00
                                <span class="product-o__discount">₹1000.00.00</span></span>
                            </div>
                        </div>
                        <div class="u-s-m-b-30">
                            <div class="product-o product-o--hover-on product-o--radius">
                                <div class="product-o__wrap">
                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
                                    <img class="aspect__img" src="{{asset('frontend/images/product/sitemakers-tshirt.png')}}" alt=""></a>
                                </div>
                                <span class="product-o__category">
                                <a href="shop-side-version-2.html">Brand Name</a></span>
                                <span class="product-o__name">
                                <a href="product-detail.html">Product Name</a></span>
                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    <span class="product-o__review">(25)</span>
                                </div>
                                <span class="product-o__price">₹900.00
                                <span class="product-o__discount">₹1000.00.00</span></span>
                            </div>
                        </div>
                        <div class="u-s-m-b-30">
                            <div class="product-o product-o--hover-on product-o--radius">
                                <div class="product-o__wrap">
                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
                                    <img class="aspect__img" src="{{asset('frontend/images/product/sitemakers-tshirt.png')}}" alt=""></a>
                                </div>
                                <span class="product-o__category">
                                <a href="shop-side-version-2.html">Brand Name</a></span>
                                <span class="product-o__name">
                                <a href="product-detail.html">Product Name</a></span>
                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    <span class="product-o__review">(25)</span>
                                </div>
                                <span class="product-o__price">₹900.00
                                <span class="product-o__discount">₹1000.00.00</span></span>
                            </div>
                        </div>
                        <div class="u-s-m-b-30">
                            <div class="product-o product-o--hover-on product-o--radius">
                                <div class="product-o__wrap">
                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
                                    <img class="aspect__img" src="{{asset('frontend/images/product/sitemakers-tshirt.png')}}" alt=""></a>
                                </div>
                                <span class="product-o__category">
                                <a href="shop-side-version-2.html">Brand Name</a></span>
                                <span class="product-o__name">
                                <a href="product-detail.html">Product Name</a></span>
                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    <span class="product-o__review">(25)</span>
                                </div>
                                <span class="product-o__price">₹900.00
                                <span class="product-o__discount">₹1000.00.00</span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="load-more">
                        <button class="btn btn--e-brand" type="button">View More</button>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
    <!--====== End - Section 4 ======-->
    <!--====== Section 5 ======-->
    <div class="u-s-p-b-60">
        <!--====== Section Intro ======-->
        <div class="section__intro u-s-m-b-46">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary u-s-m-b-12">FEATURED PRODUCTS</h1>
                            <span class="section__span u-c-silver">GET UP FOR FEATURED PRODUCTS</span>
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
                        <div class="u-s-m-b-30">
                            <div class="product-o product-o--hover-on product-o--radius">
                                <div class="product-o__wrap">
                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
                                    <img class="aspect__img" src="{{asset('frontend/images/product/sitemakers-tshirt.png')}}" alt=""></a>
                                </div>
                                <span class="product-o__category">
                                <a href="shop-side-version-2.html">Brand Name</a></span>
                                <span class="product-o__name">
                                <a href="product-detail.html">Product Name</a></span>
                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    <span class="product-o__review">(25)</span>
                                </div>
                                <span class="product-o__price">₹900.00
                                <span class="product-o__discount">₹1000.00.00</span></span>
                            </div>
                        </div>
                        <div class="u-s-m-b-30">
                            <div class="product-o product-o--hover-on product-o--radius">
                                <div class="product-o__wrap">
                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
                                    <img class="aspect__img" src="{{asset('frontend/images/product/sitemakers-tshirt.png')}}" alt=""></a>
                                </div>
                                <span class="product-o__category">
                                <a href="shop-side-version-2.html">Brand Name</a></span>
                                <span class="product-o__name">
                                <a href="product-detail.html">Product Name</a></span>
                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    <span class="product-o__review">(25)</span>
                                </div>
                                <span class="product-o__price">₹900.00
                                <span class="product-o__discount">₹1000.00.00</span></span>
                            </div>
                        </div>
                        <div class="u-s-m-b-30">
                            <div class="product-o product-o--hover-on product-o--radius">
                                <div class="product-o__wrap">
                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
                                    <img class="aspect__img" src="{{asset('frontend/images/product/sitemakers-tshirt.png')}}" alt=""></a>
                                </div>
                                <span class="product-o__category">
                                <a href="shop-side-version-2.html">Brand Name</a></span>
                                <span class="product-o__name">
                                <a href="product-detail.html">Product Name</a></span>
                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    <span class="product-o__review">(25)</span>
                                </div>
                                <span class="product-o__price">₹900.00
                                <span class="product-o__discount">₹1000.00.00</span></span>
                            </div>
                        </div>
                        <div class="u-s-m-b-30">
                            <div class="product-o product-o--hover-on product-o--radius">
                                <div class="product-o__wrap">
                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
                                    <img class="aspect__img" src="{{asset('frontend/images/product/sitemakers-tshirt.png')}}" alt=""></a>
                                </div>
                                <span class="product-o__category">
                                <a href="shop-side-version-2.html">Brand Name</a></span>
                                <span class="product-o__name">
                                <a href="product-detail.html">Product Name</a></span>
                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    <span class="product-o__review">(25)</span>
                                </div>
                                <span class="product-o__price">₹900.00
                                <span class="product-o__discount">₹1000.00.00</span></span>
                            </div>
                        </div>
                        <div class="u-s-m-b-30">
                            <div class="product-o product-o--hover-on product-o--radius">
                                <div class="product-o__wrap">
                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
                                    <img class="aspect__img" src="{{asset('frontend/images/product/sitemakers-tshirt.png')}}" alt=""></a>
                                </div>
                                <span class="product-o__category">
                                <a href="shop-side-version-2.html">Brand Name</a></span>
                                <span class="product-o__name">
                                <a href="product-detail.html">Product Name</a></span>
                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    <span class="product-o__review">(25)</span>
                                </div>
                                <span class="product-o__price">₹900.00
                                <span class="product-o__discount">₹1000.00.00</span></span>
                            </div>
                        </div>
                        <div class="u-s-m-b-30">
                            <div class="product-o product-o--hover-on product-o--radius">
                                <div class="product-o__wrap">
                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
                                    <img class="aspect__img" src="{{asset('frontend/images/product/sitemakers-tshirt.png')}}" alt=""></a>
                                </div>
                                <span class="product-o__category">
                                <a href="shop-side-version-2.html">Brand Name</a></span>
                                <span class="product-o__name">
                                <a href="product-detail.html">Product Name</a></span>
                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    <span class="product-o__review">(25)</span>
                                </div>
                                <span class="product-o__price">₹900.00
                                <span class="product-o__discount">₹1000.00.00</span></span>
                            </div>
                        </div>
                        <div class="u-s-m-b-30">
                            <div class="product-o product-o--hover-on product-o--radius">
                                <div class="product-o__wrap">
                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
                                    <img class="aspect__img" src="{{asset('frontend/images/product/sitemakers-tshirt.png')}}" alt=""></a>
                                </div>
                                <span class="product-o__category">
                                <a href="shop-side-version-2.html">Brand Name</a></span>
                                <span class="product-o__name">
                                <a href="product-detail.html">Product Name</a></span>
                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    <span class="product-o__review">(25)</span>
                                </div>
                                <span class="product-o__price">₹900.00
                                <span class="product-o__discount">₹1000.00.00</span></span>
                            </div>
                        </div>
                        <div class="u-s-m-b-30">
                            <div class="product-o product-o--hover-on product-o--radius">
                                <div class="product-o__wrap">
                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
                                    <img class="aspect__img" src="{{asset('frontend/images/product/sitemakers-tshirt.png')}}" alt=""></a>
                                </div>
                                <span class="product-o__category">
                                <a href="shop-side-version-2.html">Brand Name</a></span>
                                <span class="product-o__name">
                                <a href="product-detail.html">Product Name</a></span>
                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    <span class="product-o__review">(25)</span>
                                </div>
                                <span class="product-o__price">₹900.00
                                <span class="product-o__discount">₹1000.00.00</span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="load-more">
                        <button class="btn btn--e-brand" type="button">View More</button>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
    <!--====== End - Section 5 ======-->
</div>
<!--====== End - App Content ======-->
@endsection