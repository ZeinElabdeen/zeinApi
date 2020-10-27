@extends('user.en.layouts.lay') @section('title',' Register ') @section('links')

<link rel="stylesheet" href="{{url('assets-en/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/Base.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/premium.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/my-account.css')}}" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />



@endsection @section('content')

<header>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="banner">
            {{-- <h2>من نحن</h2> --}}
            <span class="text-light">Home / <span> Register   </span>
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
          <h4>  Sign Up Now </h4>
          {{-- <p class="text-muted">هذا النص هو مثال لنص يمكن ان يستبدل بنص اخر في نفس المساحة لقد تم توليد هذا النص من مولد العربي</p> --}}
          <label > Username </label>
          <input type="text" name = "name" id="inputName" class="form-control @error('student_name') is-invalid @enderror" placeholder="Enter Username" value="{{old('name')}}"  autofocus="" >
          
            @if ($errors->has('student_name'))
                <p class='text-danger text-right'>{{$errors->first('student_name')}}</p>
            @endif

          <label> Email</label>
          <input type="email" name = "email"  id="inputemail" class="form-control @error('student_email') is-invalid @enderror" placeholder=" Enter Email " value="{{old('email')}}" >
          
            @if ($errors->has('student_email'))
                <p class='text-danger text-right'>{{$errors->first('student_email')}}</p>
            @endif

          <label >Phone </label>
          <input type="number" name = "phone"  id="inputNumber" class="form-control @error('student_phone') is-invalid @enderror" placeholder=" Enter Phone"   value="{{old('phone')}}" autofocus="">
          
            @if ($errors->has('student_phone'))
                <p class='text-danger text-right'>{{$errors->first('student_phone')}}</p>
            @endif

          <label > Password  </label>
          <input type="password" name = "password"  id="inputNumber" class="form-control @error('student_password') is-invalid @enderror" placeholder="Enter Password  "  autofocus="">
          
            @if ($errors->has('student_password'))
                <p class='text-danger text-right'>{{$errors->first('student_password')}}</p>
            @endif

          <label > Password Confirmation</label>
          <input type="password" name = "confirmPassword" id="inputNumber" class="form-control @error('student_password') is-invalid @enderror" placeholder=" Confirm Password"  autofocus="">
          <button class="btn btn-lg btn-warning btn-block" type="submit"> Sign UP</button>
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
