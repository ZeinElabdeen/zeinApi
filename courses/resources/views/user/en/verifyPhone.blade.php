@extends('user.en.layouts.lay') @section('title',' Phone Verification ') @section('links')

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
            <span class="text-light">Home  / <span> Phone Verification</span>
        </div>
      </div>
    </div>
  </div>
</header>

<!--Start Form sign-in-->


<section class="sign-in">

    <div class="container">
        <form class="form-signin"  method="POST" action="{{url('verify-phone')}}">
            @csrf
            <h4 >Phone Verification  </h4>
            <p class="text-muted">Please Enter Your Phone Number </p>
            <label > Phone Number  </label>
            <input type="tel" name="phone" id="inputNumber" class="form-control @error('student_phone') is-invalid @enderror" placeholder=" Enter Phone "value="{{old('phone')}}" required autofocus>
            @if ($errors->has('student_phone'))
                <p class='text-danger text-left'>{{$errors->first('student_phone')}}</p>
            @endif
            @if(Session::has('Error'))
                <p class='text-danger text-left' >{{Session::get('Error')}}</p>
            {{Session::forget('Error')}}
            @endif
            <button class="btn btn-lg  btn-block" type="submit"> verify </button>
            {{-- <p class="text-muted">   ارسال الكود مرة اخرى ؟  <span><a href="{{url('')}}"> أضغط هنا</a></span></p> --}}
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
