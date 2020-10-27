@extends('user.ar.layouts.lay') @section('title',' التحقق من المستخدم ') @section('links')

<link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/Base.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/premium.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/sign-in.css')}}" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />



@endsection @section('content')

<header>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="banner">
            {{-- <h2>من نحن</h2> --}}
            <span class="text-light">الرثيسية  / <span> التحقق من المستخدم </span>
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
            <h4 > التحقق من المستخدم  </h4>
            <p class="text-muted">من فضلك ارسل الكود المرسل اليك في رسالة نصية </p>
            <label >  كود التحقق </label>
            <input type="text" name="verify" id="inputNumber" class="form-control @error('activation_code') is-invalid @enderror" placeholder=" " required autofocus>
            @if ($errors->has('activation_code'))
                <p class='text-danger text-right'>{{$errors->first('activation_code')}}</p>
            @endif
            @if(Session::has('Error'))
                <p class='text-danger text-right' >{{Session::get('Error')}}</p>
            {{Session::forget('Error')}}
            @endif
            <input type="hidden" name="STID" value="{{$user_id}}">
            <input type="hidden" name="forget" value="{{$forget}}">

            <button class="btn btn-lg  btn-block" type="submit"> التحقق </button>
            <p class="text-muted">   ارسال الكود مرة اخرى ؟  <span><a href="{{url('')}}"> أضغط هنا</a></span></p>
        </form>
    </div>
</section>
    
<!---END Sign-in-->


</section>
@endsection @section('scripts')
<script src="{{url('assets/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{url('assets/js/popper.min.js')}}"></script>
<script src="{{url('assets/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/main.js')}}"></script>
@endsection
