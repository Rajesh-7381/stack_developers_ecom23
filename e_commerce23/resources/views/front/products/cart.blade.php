
@extends('front.layout.layout')
@section('content')

<!--====== App Content ======-->
<div class="app-content appendcartitems">
@include('front.products.cart_items')
</div>
<!--====== End - App Content ======-->

@endsection