@extends('user.ar.layouts.lay') @section('title','الشروط و الأحكام') @section('links')

<link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/Base.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/premium.css')}}" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
<link rel="stylesheet" href="{{url('assets/css/Terms.css')}}">
@endsection @section('content')

<header>
    <div class="container">
        <div class="row">
        <div class="col-lg-12 text-center">
            <div class="banner">
                <h2>الشروط و الأحكام</h2>
                <span>الرئيسية / <span> الشروط و الأحكام</span>
            </div>
        </div>
        </div>
    </div>
    </header>

    <!--END Header Section -->

    <!--Start Terms and Conditions Section-->

    <section class="terms">
        <div class="container">
            @foreach ($terms as $term)
                <h1>{{$term['term_title']}}</h1>
                <hr>
                <p> {{$term['term_details']}}</p>
            @endforeach
        </div>
    </section>
@endsection @section('scripts')
<script src="{{url('assets/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{url('assets/js/popper.min.js')}}"></script>
<script src="{{url('assets/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/main.js')}}"></script>
@endsection
