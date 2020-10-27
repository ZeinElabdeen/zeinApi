@extends('user.en.layouts.lay') @section('title','Contact-Us') @section('links')

<link rel="stylesheet" href="{{url('assets-en/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/Base.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/premium.css')}}" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
<link rel="stylesheet" href="{{url('assets-en/css/contact-us.css')}}">
@endsection @section('content')
  <header>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="banner">
              {{-- <h2>Contact US</h2> --}}
              <span class="text-light">Home / <span> contact-us </span>
          </div>
        </div>
      </div>
    </div>
  </header>
<!-- START contact-us Section -->


  <section class="contact-us">
    <div class="container">

        <form class="form-signin" action="{{url('sendMessage')}}" method="POST">
            @csrf
            @if(Session::has('Success'))
            <div class="alert alert-success text-center">{{Session::get('Success')}}</div>
            @endif
            @php
            if(Session::get('Success')){
                Session::forget('Success');
            }
            @endphp

            @if(Session::has('Error'))
                <div class="alert alert-danger text-center">{{Session::get('Error')}}</div>
            @endif
            @php
            if(Session::get('Error')){
                Session::forget('Error');
            }
            @endphp
          <div class="row">
          <div class="col-md-4 us">
            <img src="{{asset('storage/images/map.png')}}">
            <h6 class="head-6">Location</h6>
            <p class="small-text">{{ $info->info_city }} -  {{ $info->info_country }} </p>
          </div>
          <div class="col-md-4 us">
            <img src="{{asset('storage/images/call.png')}}" alt="">
            <h6 class="head-6">Mobile Number</h6>
            <p class="small-text">{{ $info->info_phone }}</p>
          </div>
          <div class="col-md-4 us">
            <img src="{{asset('storage/images/message-1.png')}}" alt="">
            <h6 class="head-6">E-mail</h2>
            <p class="small-text">{{ $info->info_mail }}</p>
          </div>
        </div>
          <label>Message subject</label>
          <select name="message_title_id" id="" class="form-control">
              @foreach ($typeOfMsgs as $typeOfMsg)
                <option value="{{$typeOfMsg['message_title_id']}}">{{$typeOfMsg['message_title']}}</option>
              @endforeach
          </select>
          <label>Message</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message" placeholder="please insert Message"></textarea>
          <button class="btn btn-lg btn-block" type="submit">send</button>
        </form>
    </div>
    </section>
@endsection @section('scripts')
<script src="{{url('assets-en/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{url('assets-en/js/popper.min.js')}}"></script>
<script src="{{url('assets-en/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets-en/js/main.js')}}"></script>
@endsection
