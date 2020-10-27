@extends('front.layouts.app')
<!-- ============ Body content start ============= -->
@section('content')

<div class="page-header">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fas fa-home"></i> {{ __('front.home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('front.checkout_done') }}</li>
          </ol>
        </nav>
        <h2>{{ __('front.checkout_done') }}</h2>
      </div>
    </div>
  </header>

  <section class="form">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-lg-7 col-md-6 bg-gray text-center">
          <h3 class="mt-4">
            {{ __('front.order_thank') }}
          </h3>
          <p> {{ __('front.order_thank_mess') }}</p>
          <a class="btn btn-second mt-4 mb-4" href="{{url('/')}}">{{ __('front.shopnow') }}</a>
        </div>
      </div>
    </div>
  </section>

@endsection
