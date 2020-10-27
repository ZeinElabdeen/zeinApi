@extends('user.ar.layouts.lay') @section('title','تسجبل دخول ') @section('links')

<link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/Base.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/premium.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/my-account.css')}}" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />



@endsection @section('content')

<header>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="banner">
            {{-- <h2>من نحن</h2> --}}
            <span class="text-light">الرئيسية / <span> انشاء حساب  </span>
        </div>
      </div>
    </div>
  </div>
</header>

<!--Start Form sign-in-->


<section class="my-account">
    <div class="container">
        <form class="form-update" method="POST" action="{{url('user-register')}}">
            @csrf
          <h4>تعديل الملف الشخصي</h4>
          <p class="text-muted">هذا النص هو مثال لنص يمكن ان يستبدل بنص اخر في نفس المساحة لقد تم توليد هذا النص من مولد العربي</p>
          <label >اسم المستخدم</label>
          <input type="text" name = "name" id="inputName" class="form-control @error('student_name') is-invalid @enderror" placeholder="برجاء ادخال اسم المستخدم" value="{{old('name')}}"  autofocus="" >
          
            @if ($errors->has('student_name'))
                <p class='text-danger text-right'>{{$errors->first('student_name')}}</p>
            @endif

          <label>البريد الألكتروني</label>
          <input type="email" name = "email"  id="inputemail" class="form-control @error('student_email') is-invalid @enderror" placeholder="برجاء ادخال الايميل " value="{{old('email')}}" >
          
            @if ($errors->has('student_email'))
                <p class='text-danger text-right'>{{$errors->first('student_email')}}</p>
            @endif

          <label >رقم الجوال</label>
          <input type="number" name = "phone"  id="inputNumber" class="form-control @error('student_phone') is-invalid @enderror" placeholder="برجاء ادخال رقم الجوال"   value="{{old('phone')}}" autofocus="">
          
            @if ($errors->has('student_phone'))
                <p class='text-danger text-right'>{{$errors->first('student_phone')}}</p>
            @endif

          <label > كلمة المرور </label>
          <input type="password" name = "password"  id="inputNumber" class="form-control @error('student_password') is-invalid @enderror" placeholder="برجاء ادخال كلمة المرور"  autofocus="">
          
            @if ($errors->has('student_password'))
                <p class='text-danger text-right'>{{$errors->first('student_password')}}</p>
            @endif

          <label >تأكيد كلمة المرور</label>
          <input type="password" name = "confirmPassword" id="inputNumber" class="form-control @error('student_password') is-invalid @enderror" placeholder="برجاء تأكيد كلمة المرور"  autofocus="">
          <button class="btn btn-lg btn-warning btn-block" type="submit">انشاء حساب</button>
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
