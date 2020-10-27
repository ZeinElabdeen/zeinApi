@extends('user.ar.layouts.lay') @section('title',' الملف الشخصي ') @section('links')

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
            <span class="text-light">الرئيسية / <span>  الملف الشخصي  </span>
        </div>
      </div>
    </div>
  </div>
</header>

<!--Start Form sign-in-->


<!--Start My-Account Section -->

<section class="my-account">
    <div class="container">
    <form class="form-update" method="POST" action="{{url('update-profile/'.Session::get('user_id'))}}" enctype="multipart/form-data">
            @csrf
            
            @isset($profile)
                <h4>تعديل الملف الشخصي</h4>
                @if (Session::has('Success'))
                    <div class="alert alert-success text-center">{{Session::get('Success')}}</div>
                    @php
                      Session::forget('Success')  
                    @endphp
                @endif
                @if (Session::has('Error'))
                    <div class="alert alert-danger text-center">{{Session::get('Error')}}</div>
                    @php
                      Session::forget('Error')  
                    @endphp
                @endif

                {{-- <p class="text-muted">هذا النص هو مثال لنص يمكن ان يستبدل بنص اخر في نفس المساحة لقد تم توليد هذا النص من مولد العربي</p> --}}
                <label >اسم المستخدم</label>
                <input type="text" name="name" id="inputName" class="form-control  @error('student_name') is-invalid @enderror" placeholder="برجاء ادخال اسم المستخدم" required value="{{$profile->student_name}}">
                    @if ($errors->has('student_name'))
                        <p class='text-danger text-right'>{{$errors->first('student_name')}}</p>
                    @endif
                    
                <label>البريد الألكتروني</label>
                <input type="email" name="email" id="inputemail" class="form-control  @error('student_email') is-invalid @enderror" placeholder="برجاء ادخال كلمة المرور" required value="{{$profile->student_email}}">
                    @if ($errors->has('student_email'))
                        <p class='text-danger text-right'>{{$errors->first('student_email')}}</p>
                    @endif
            @endisset
            
            {{-- <label >رقم الجوال</label> --}}
            {{-- <input type="number" id="inputNumber" class="form-control" placeholder="برجاء ادخال رقم الجوال" value="{{$profile->student_name}}"> --}}
            @empty($profile)
                <h4>اتمام الحجز</h4>
            @endempty
            <label > الاسم حسب الجواز </label>
                @isset($profile->student_passport_name)
                    @php
                        $student_passport_name = $profile->student_passport_name;

                    @endphp
                @endisset
                @empty($profile->student_passport_name)
                    @php
                        $student_passport_name = old('passportName');
                    @endphp
                @endempty
                <input type="name" name="passportName" id="name" class="form-control @error('student_passport_name') is-invalid @enderror" placeholder="برجاء ادخال اسم الجواز" value="{{$student_passport_name}}">
                @if ($errors->has('student_passport_name'))
                    <p class='text-danger text-right'>{{$errors->first('student_passport_name')}}</p>
                @endif
            <label> رقم الجواز </label>

            @isset($profile->student_passport_number)
            @php
                $student_passport_number = $profile->student_passport_number;

            @endphp
            @endisset
            @empty($profile->student_passport_number)
                @php
                    $student_passport_number =  old('passportNumber');
                @endphp
            @endempty
            <input type="number"  name="passportNumber" id="password" class="form-control @error('student_passport_number') is-invalid @enderror" placeholder="برجاء ادخال رقم الجواز" value="{{$student_passport_number}}">
                @if ($errors->has('student_passport_number'))
                    <p class='text-danger text-right'>{{$errors->first('student_passport_number')}}</p>
                @endif 
                @isset($profile->passport_photo)
                    @php
                        $photo = $profile->passport_photo;

                    @endphp
                @endisset
                @empty($profile->passport_photo)
                    @php
                        $photo = 'default.jpg';
                    @endphp
                @endempty
            <img src="{{url('storage/images/passports/'.$photo)}}" id="img" style="margin-top: 20px;cursor: pointer;max-width: 100%">
            
                <input type="file" id="imginput"  name="passportPhoto" class="form-control" style="display: none" onchange="showPhoto()">
                <input type="hidden" name="old_photo_name" value="{{$photo}}">
                @if ($errors->has('passport_photo'))
                    <p class='text-danger text-right'>{{$errors->first('passport_photo')}}</p>
                @endif
                
                @isset($insertFirst)
                    <input type="hidden" name="insertFirst" value="{{$insertFirst}}">
                @endisset
                <button class="btn btn-lg btn-warning btn-block" type="submit"> تعديل الملف الشخصي </button>
        </form>
        @isset($profile)
        <form class="form-update" action="{{url('logout')}}" method="post">
            @csrf
            <button class="btn btn-lg  btn-dark  btn-block" type="submit"> تسجيل الخروج <i class="fas fa-sign-out-alt"></i></button>
        </form>
        @endisset


    </div>
</section>

<!--END My-Account Section -->


<!--Start Form sign-in-->


  
<!---END Sign-in-->

    
<!---END Sign-in-->


</section>
@endsection @section('scripts')
<script src="{{url('assets/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{url('assets/js/popper.min.js')}}"></script>
<script src="{{url('assets/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/main.js')}}"></script>
<script>

    document.getElementById("img").addEventListener("click", function(){
        document.getElementById("imginput").click();
    });
    
    function showPhoto() {
    var file = document.getElementById('imginput').files[0];
    console.log(file);
    reader = new FileReader();
    // console.log(reader);
    reader.onloadend = function () {
        document.getElementById('img').setAttribute("src",reader.result);
        // console.log(reader.result);
    };
    reader.readAsDataURL(file);
    }

</script>
@endsection
