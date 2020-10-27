@extends('user.en.layouts.lay') @section('title',' Password Reset ') @section('links')

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
            <span class="text-light">Home  / <span> Password Reset</span>
        </div>
      </div>
    </div>
  </div>
</header>

<!--Start Form sign-in-->

@foreach ($errors->all() as $e)
<li>{{$e}}</li>
    
@endforeach
<section class="sign-in">

    <div class="container">
        <form class="form-signin"  method="POST" action="{{url('forget-password')}}">
            @csrf
            <h4 >Password Reset  </h4>
            {{-- <p class="text-muted">Please Enter Your Phone Number </p> --}}
            <label > New Password  </label>
            <input type="password" name="password" id="inputNumber" class="form-control @error('student_password') is-invalid @enderror" placeholder=" Please enter password "  required autofocus>
            @if ($errors->has('student_password'))
                <p class='text-danger text-left'>{{$errors->first('student_password')}}</p>
            @endif
            <label > Confirm New Password  </label>
            <input type="password" name="password_confirmation" id="inputNumber" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder=" Password confirmation " required >
            @if ($errors->has('password_confirmation'))
                <p class='text-danger text-left'>{{$errors->first('password_confirmation')}}</p>
            @endif
            @if(Session::has('Error'))
                <p class='text-danger text-left' >{{Session::get('Error')}}</p>
            {{Session::forget('Error')}}
            @endif
            <input type="hidden" name="user_id" value="{{$user_id}}">
            <input type="hidden" name="signature" value="{{$signature}}">
            <button class="btn btn-lg  btn-block" type="submit"> Change </button>
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
