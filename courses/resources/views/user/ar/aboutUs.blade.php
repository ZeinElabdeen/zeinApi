@extends('user.ar.layouts.lay') @section('title','من نحن') @section('links')

<link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/Base.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/premium.css')}}" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
<link rel="stylesheet" href="{{url('assets/css/about.css')}}">
<style>
#homePost {
    /* width:50%;
    height:auto; */
    /* box-shadow: 0 0 0 6px #fff, 0 0 0 12px #888; */
    margin-right: 25px;
    margin-bottom: 20px;
}
</style>
@endsection @section('content')

<header>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="banner">
              <h2>من نحن</h2>
              <span>الرئيسية / <span>من نحن</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!--END Header Section -->

  <!-- Start About-US Section-->

  <section class ="about-us">
      <div class="container">
        <div class="well well-sm">
            <div class="row">
                <div class="col-sm-12">
                    <p style="padding-left: 20px; padding-right: 20px;">
                        <img style="float:left" src="{{asset('storage/images/'.$about->page_photo	)}}" id="homePost">
                        <span style="float:right">
                            <h1 class="head-1"> من نحن</h1>
                            <h2 class="head-2">{{$about->title}}</h2>
                            <p class="large-text">
                                {{ $about->details }}
                            </p>
                        </span>
                    </p>
                </div>
            </div>
        </div>
      </div>
  </section>
@endsection @section('scripts')
<script src="{{url('assets/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{url('assets/js/popper.min.js')}}"></script>
<script src="{{url('assets/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/main.js')}}"></script>
@endsection
