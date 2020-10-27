@extends('user.en.layouts.lay') @section('title',' Login ') @section('links')

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
            <span class="text-light">Home / <span> LogIn  </span>
        </div>
      </div>
    </div>
  </div>
</header>

<!--Start Form sign-in-->


<section class="sign-in">

    <div class="container">
        <form class="form-signin"  method="POST" action="{{url('account')}}">
            @csrf
            <h4 > login </h4>
            <p class="text-muted"> Log in to our site to receive all new</p>
            <label >Phone </label>
            <input type="text" name="phone" id="inputNumber" class="form-control @error('student_phone') is-invalid @enderror" placeholder="Please Enter Phone " value="{{old('phone')}}" required autofocus>
            @if ($errors->has('student_phone'))
                <p class='text-danger text-left'>{{$errors->first('student_phone')}}</p>
            @endif
            <label> Password </label>
            <input type="password" name="password"  id="inputPassword" class="form-control  @error('student_password') is-invalid @enderror" placeholder=" Please Enter password"  required>
            @if ($errors->has('student_password'))
                <p class='text-danger text-left' >{{$errors->first('student_password')}}</p>
            @endif
            @if(Session::has('Error'))
            <p class='text-danger text-left' >{{Session::get('Error')}}</p>
            {{Session::forget('Error')}}
            @endif
            <button class="btn btn-lg  btn-block" type="submit"> Login</button>
            <p class="text-muted"> Forget password ? <span><a href="{{url('verify-phone')}}"> Click here</a></span>
            <p class="text-muted">No account? <span><a href="{{url('user-register')}}">Click here </a></span></p>
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
