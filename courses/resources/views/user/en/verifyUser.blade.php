@extends('user.en.layouts.lay') @section('title','Verify User ') @section('links')

<link rel="stylesheet" href="{{url('assets-en/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/Base.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/premium.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/sign-in.css')}}" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />



@endsection @section('content')

<header>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="banner">
            {{-- <h2>من نحن</h2> --}}
            <span class="text-light">Home / <span> User Verification </span>
        </div>
      </div>
    </div>
  </div>
</header>

<!--Start Form sign-in-->


<section class="sign-in">

    <div class="container">
        <form class="form-signin"  method="POST" action="{{url('verify-user')}}">
            @csrf
            <h4 > User Verification </h4>
            <p class="text-muted"> Please Write below The code we sent to you in text message  </p>
            <label > Verfication Code </label>
            <input type="text" name="verify" id="inputNumber" class="form-control @error('activation_code') is-invalid @enderror" placeholder=" "  required autofocus>
            @if ($errors->has('activation_code'))
                <p class='text-danger text-left'>{{$errors->first('activation_code')}}</p>
            @endif
            @if(Session::has('Error'))
              <p class='text-danger text-left' >{{Session::get('Error')}}</p>
              {{Session::forget('Error')}}
          @endif
            <input type="hidden" name="STID" value="{{$user_id}}">
                        <input type="hidden" name="forget" value="{{$forget}}">

            <button class="btn btn-lg  btn-block" type="submit"> Verify </button>
            <p class="text-muted"> Send Code Again  <span><a href="{{url('')}}">Click Here</a></span></p>
        </form>
    </div>
</section>
    
<!---END Sign-in-->


</section>
@endsection @section('scripts')
<script src="{{url('assets-en/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{url('assets-en/js/popper.min.js')}}"></script>
<script src="{{url('assets-en/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets-en/js/main.js')}}"></script>
@endsection
