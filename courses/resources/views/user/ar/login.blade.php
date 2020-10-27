@extends('user.ar.layouts.lay') @section('title','تسجبل دخول ') @section('links')

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
            <span class="text-light">الرئيسية / <span>تسجيل الدخول </span>
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
            <h4 >تسجيل الدخول</h4>
            <p class="text-muted">برجاء تسجيل الدخول في موقعنا لبصلك كل جديد </p>
            <label >رقم الجوال</label>
            <input type="text" name="phone" id="inputNumber" class="form-control @error('student_phone') is-invalid @enderror" placeholder="برجاء ادخال رقم الجوال" value="{{old('phone')}}" required autofocus>
            @if ($errors->has('student_phone'))
                <p class='text-danger text-right'>{{$errors->first('student_phone')}}</p>
            @endif
            <label>كلمة المرور</label>
            <input type="password" name="password"  id="inputPassword" class="form-control  @error('student_password') is-invalid @enderror" placeholder="برجاء ادخال كلمة المرور"  required>
            @if ($errors->has('student_password'))
                <p class='text-danger text-right' >{{$errors->first('student_password')}}</p>
            @endif
            @if(Session::has('Error'))
            <p class='text-danger text-right' >{{Session::get('Error')}}</p>
            {{Session::forget('Error')}}
            @endif
            <button class="btn btn-lg  btn-block" type="submit">تسجيل الدخول</button>
            <p class="text-muted"> هل نسيت كلمة المرور ؟ <span><a href="{{url('verify-phone')}}">اضغط هنا</a></span>
            <p class="text-muted">ليس لديك حساب؟ <span><a href="{{url('user-register')}}">اضغط هنا</a></span></p>
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
