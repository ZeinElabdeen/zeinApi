<!DOCTYPE html>
<!-- <html dir="ltr" lang="en"> -->
<html dir="rtl" lang="{{ app()->getLocale() }}">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="robots" content="index, follow" />
  <meta name="author" content="Urial Lab" />

  <!-- Search Engine -->
  <meta name="description" content="{{ $seo['description_'.app()->getLocale()] }}" />
  <meta name="image" content="{{asset('assets/front/'.app()->getLocale() )}}/img/logo.png" />
  <!-- Twitter -->
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:title" content="{{ $seo['title_'.app()->getLocale()] }}" />
  <meta name="twitter:description" content="{{ $seo['description_'.app()->getLocale()] }}" />
  <!-- Open Graph general (Facebook, Pinterest & Google+) -->
  <meta name="og:title" content="{{ $seo['title_'.app()->getLocale()] }}" />
  <meta name="og:description" content="{{ $seo['description_'.app()->getLocale()] }}" />
  <meta name="og:type" content="website" />

  <!-- frameworks CSS -->
  @if(app()->getLocale() == 'ar')
  <link rel="stylesheet" href="{{asset('assets/front/'.app()->getLocale() )}}/css/bootstrap-rtl.min.css" />
  @else
  <link rel="stylesheet" href="{{asset('assets/front/'.app()->getLocale() )}}/css/bootstrap.min.css" />
  @endif
  <link rel="stylesheet" href="{{asset('assets/front/'.app()->getLocale() )}}/css/animate.min.css" />
  <link rel="stylesheet" href="{{asset('assets/front/'.app()->getLocale() )}}/css/slick.css" />
  <link rel="stylesheet" href="{{asset('assets/front/'.app()->getLocale() )}}/css/slick-theme.css" />
  <!-- custom style -->
  <link rel="stylesheet" href="{{asset('assets/front/'.app()->getLocale() )}}/css/style.css" />
  <!-- <link rel="stylesheet" href="css/style-en.css" /> -->
  <link rel="stylesheet" href="{{asset('assets/front/'.app()->getLocale() )}}/css/style-{{app()->getLocale()}}.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.css">

  <title>{{ $seo['title_'.app()->getLocale()] }}</title>
  <link rel="shortcut icon" href="{{asset('assets/front/'.app()->getLocale() )}}/img/fav.png" type="image/x-icon" />

  <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/popper.min.js"></script>
  <![endif]-->

</head>

<body>

  <header>
    <style>
    .swal2-title{
      font-size: 1.3em;
      color: #e44343;
      border: solid 2px #3085d6;
      padding: 36px;
      font-weight: 500;
      border-radius: 18px;
    }
   </style>
    <nav class="navbar navbar-center navbar-expand-lg" id="navbar">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-2 col-sm-4">
            <button type="button" class="navbar-toggler menu-wrapper" data-toggle="collapse"
              data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="hamburger-menu"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav more-links">
                <li class="nav-item">
                  <a class="nav-link" href="">
                    <i class="fas fa-bars"></i>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link underline-hover" href="{{url('/')}}">
                    {{ __('front.home') }}
                  </a>
                </li>

                @if( !auth()->guard('users')->check() )
                <li class="nav-item">
                  <a class="nav-link underline-hover" href="{{url('my-account')}}">
                    {{ __('front.my_account') }}
                  </a>
                </li>
                @elseif( auth()->guard('users')->user()->type =='0')

                 <li class="nav-item">
                    <a class="nav-link underline-hover" href="{{url('my-profile')}}">
                      {{ __('front.hello').','. auth()->guard('users')->user()->username  }}
                    </a>
                  </li>

                 <li class="nav-item">
                    <a class="nav-link underline-hover" href="{{url('my-orders')}}">
                      {{ __('front.my_orders') }}
                    </a>
                  </li>

                  <li class="nav-item">
                   <a class="nav-link underline-hover" href="{{url('logout')}}">
                     {{ __('front.logout') }}
                   </a>
                  </li>

                @elseif( auth()->guard('users')->user()->type =='1')
                <li class="nav-item">
                  <a class="nav-link underline-hover" href="{{url('vendor/dashboard')}}">
                    {{  __('front.hello').','. auth()->guard('users')->user()->username  }}
                  </a>
                 </li>
                @endif

              </ul>
            </div>
          </div>
          <div class="col-5 col-sm-4 text-center">
            <a class="navbar-brand" href="{{url('/')}}">
              <img src="{{asset('assets/front/'.app()->getLocale() )}}/img/logo.png" style=" height: 100px; width: 111px;" alt="{{ $seo['title_'.app()->getLocale()] }}" />
            </a>
          </div>
          <div class="col-5 col-sm-4 text-right">
            <ul class="list-inline options">
              <li class="list-inline-item">
                <a href="" class="show-search"><img src="{{asset('assets/front/'.app()->getLocale() )}}/img/icons/search.png" alt="{{__('front.search')}}" /></a>
              </li>
              <li class="list-inline-item">
                <a href="{{url('favorites')}}" class="number">
                  <i id="favorite_notfi" >
                    @if(!empty($favorite_size))
                    <span>{{$favorite_size}}</span>
                    @endif
                  </i>
                  <img src="{{asset('assets/front/'.app()->getLocale() )}}/img/icons/favorite.png"
                    alt="{{__('front.favorite')}}" /></a>
              </li>
              <li class="list-inline-item">
                <a href="{{url('cart')}}" class="number">
                  <i id="cart_notfi" >
                    @if(!empty($cart_size))
                    <span>{{$cart_size}}</span>
                    @endif
                  </i>
                  <img src="{{asset('assets/front/'.app()->getLocale() )}}/img/icons/cart.png"
                    alt="{{__('front.cart')}}" />
                  </a>
              </li>

              <li class="list-inline-item">
                @if(app()->getLocale() == 'ar')
                <a href="{{url('locale/en')}}" class="text">
                  <span>EN</span>
                </a>
                @else
                <a href="{{url('locale/ar')}}" class="text">
                  <span>عربي</span>
                </a>
                @endif
              </li>
            </ul>
          </div>
        </div>
        <div class="search-block">
          <form action="{{url('search')}}" onsubmit="search_valdation(event)" method="get">

            <div class="form-inline">
              <input type="text" name="search" id="search_for" class="form-control"  >
              <button class="btn btn-second" type="submit">
                <img src="{{asset('assets/front/'.app()->getLocale() )}}/img/icons/search.png" alt="{{__('front.search')}}">
              </button>
            </div>
          </form>
        </div>
      </div>
    </nav>
