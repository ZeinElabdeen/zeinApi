@extends('user.ar.layouts.lay') @section('title',' اعادة كلمة المرور ') @section('links')

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
            <span class="text-light">الرثيسية  / <span>  اعادة كلمة المرور </span>
        </div>
      </div>
    </div>
  </div>
</header>

<!--Start Form sign-in-->


<section class="sign-in">

    <div class="container">
        <form class="form-signin"  method="POST" action="{{url('forget-password')}}">
            @csrf
            <h4 >اعادة كلمة المرور   </h4>
            {{-- <p class="text-muted">Please Enter Your Phone Number </p> --}}
            <label > كلمة المرور الجديدة </label>
            <input type="password" name="password" id="inputNumber" class="form-control @error('student_password') is-invalid @enderror" placeholder="  من فضلك ادخل كلمة المرور "  required autofocus>
            @if ($errors->has('student_password'))
                <p class='text-danger text-right'>{{$errors->first('student_password')}}</p>
            @endif
            <label > تأكيد كلمة المرور </label>
            <input type="password" name="password_confirmation" id="inputNumber" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder=" تأكيد كلمة المرور  "  required >
            @if ($errors->has('password_confirmation'))
                <p class='text-danger text-right'>{{$errors->first('password_confirmation')}}</p>
            @endif
            @if(Session::has('Error'))
                <p class='text-danger text-right' >{{Session::get('Error')}}</p>
            {{Session::forget('Error')}}
            @endif
            <input type="hidden" name="user_id" value="{{$user_id}}">
            <input type="hidden" name="signature" value="{{$signature}}">
            <button class="btn btn-lg  btn-block" type="submit"> تغير </button>
            {{-- <p class="text-muted">   ارسال الكود مرة اخرى ؟  <span><a href="{{url('')}}"> أضغط هنا</a></span></p> --}}
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
