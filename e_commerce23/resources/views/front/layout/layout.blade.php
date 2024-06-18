<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="UTF-8">
        <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="SiteMakers.in">
        {{-- below meta tag refresh th epage every 5 second --}}
        {{-- <meta http-equiv="refresh" content="5"> --}}
        <meta name="csrf-token" content="{{csrf_token()}}">
        <link href="{{asset('frontend/images/favicon.png')}}" rel="shortcut icon">
        <title>Laravel E-commerce Template - By SiteMakers.in</title>
        <!--====== Google Font ======-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">
        <!--====== Vendor Css ======-->
        <link rel="stylesheet" href="{{asset('frontend/css/vendor.css')}}">
        <!--====== Utility-Spacing ======-->
        <link rel="stylesheet" href="{{asset('frontend/css/utility.css')}}">
        <!--====== App ======-->
        <link rel="stylesheet" href="{{asset('frontend/css/app.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/css/alert.css')}}">
        <style>
            .loader
            {
              background: rgba( 255, 255, 255, 0.8 );
              display: none;
              height: 100%;
              position: fixed;
              width: 100%;
              z-index: 9999;
            }
            
            .loader img
            {
              left: 50%;
              margin-left: -32px;
              margin-top: -32px;
              position: absolute;
              top: 50%;
              width: 64px; /* Adjust to the desired width */
              height: 64px;
            }
            </style>
    </head>
    <body class="config">
        <div class="loader">
            {{-- <img src="{{asset('frontend/images/loader3.gif')}}" alt="loading..." /> --}}
            <img src="https://i.gifer.com/ZKZg.gif" alt="loading..." />

         </div>   
        <div class="preloader is-active">
            <div class="preloader__wrap">
                <img class="preloader__img" src="{{asset('frontend/images/preloader.png')}}" alt="">
            </div>
        </div>
        <!--====== Main App ======-->
        <div id="app">
           

            @include('front.layout.header')
           
            @yield('content')
            <!--====== Main Footer ======-->
            @include('front.layout.footer')
            <!--====== Modal Section ======-->
            
            @include('front.newsletter')
            <!--====== End - Modal Section ======-->
        </div>
        <!--====== End - Main App ======-->
        <!--====== Google Analytics: change UA-XXXXX-Y to be your site's ID ======-->
        <script>
            window.ga = function() {
                ga.q.push(arguments)
            };
            ga.q = [];
            ga.l = +new Date;
            ga('create', 'UA-XXXXX-Y', 'auto');
            ga('send', 'pageview')
        </script>
        <script src="https://www.google-analytics.com/analytics.js')}}" async defer></script>
        <!--====== Vendor Js ======-->
        <script src="{{asset('frontend/js/vendor.js')}}"></script>
        <!--====== jQuery Shopnav plugin ======-->
        <script src="{{asset('frontend/js/jquery.shopnav.js')}}"></script>
        <!--====== App ======-->
        <script src="{{asset('frontend/js/app.js')}}"></script>
        <script src="{{asset('frontend/js/custom.js')}}"></script>
        <script src="{{asset('frontend/js/filters.js')}}"></script>
        {{-- <script src="{{asset('frontend/js/dynamic.js')}}"></script> --}}
        <!--====== Noscript ======-->
        <noscript>
            <div class="app-setting">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="app-setting__wrap">
                                <h1 class="app-setting__h1">JavaScript is disabled in your browser.</h1>
                                <span class="app-setting__text">Please enable JavaScript in your browser or upgrade to a JavaScript-capable browser.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </noscript>
    </body>
</html>
{{-- loader script --}}
<script>
    $(document).ready(function(){
      $("#formid").on("submit", function(){
        $(".loader").show();
      });//submit
    });//document ready
    </script>