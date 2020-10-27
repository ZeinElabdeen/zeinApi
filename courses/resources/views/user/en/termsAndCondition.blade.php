@extends('user.en.layouts.lay') @section('title','Terms & Conditions') @section('links')

<link rel="stylesheet" href="{{url('assets-en/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/Base.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/premium.css')}}" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
<link rel="stylesheet" href="{{url('assets-en/css/Terms.css')}}">
@endsection @section('content')

<header>
    <div class="container">
        <div class="row">
        <div class="col-lg-12 text-center">
            <div class="banner">
                {{-- <h2> Terms & Conditions </h2> --}}
                <span class="text-light">Home / <span>Terms & Conditions</span>
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
<script src="{{url('assets-en/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{url('assets-en/js/popper.min.js')}}"></script>
<script src="{{url('assets-en/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets-en/js/main.js')}}"></script>
@endsection
