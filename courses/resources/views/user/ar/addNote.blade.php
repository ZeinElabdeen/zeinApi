@extends('user.ar.layouts.lay') @section('title','أضافة ملاحظة  ') @section('links')

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
            <span class="text-light">الرثيسية  / <span>  أضافة ملاحظة  </span>
        </div>
      </div>
    </div>
  </div>
</header>

<!--Start Form sign-in-->


<section class="sign-in">

    <div class="container">
        <form class="form-signin"  method="POST" action="{{url('add-note')}}" enctype="multipart/form-data">
            @csrf
            <h4 > أضف ملاحظاتك</h4>
            {{-- <p class="text-muted"> Log in to our site to receive all new</p> --}}
            <label >الوصف  </label>
            <textarea name="note_details" id=""  rows="10" class="form-control @error('note_details') is-invalid @enderror"  placeholder=" أضف ملاحظاتك" required autofocus>{{old('note_details')}}</textarea>
            @if ($errors->has('note_details'))
                <p class='text-danger text-right'>{{$errors->first('note_details')}}</p>
            @endif
            <label> صورة </label>
            <img src="{{url('storage/images/notes/default.jpg')}}" id="img" style="margin-top: 20px;cursor: pointer;max-width: 100%">
            <input type="file" name="note_photo"  id="imginput" style="display: none" onchange="showPhoto()">
            @if ($errors->has('note_photo'))
                <p class='text-danger text-right' >{{$errors->first('note_photo')}}</p>
            @endif
            @if(Session::has('Error'))
            <p class='text-danger text-right' >{{Session::get('Error')}}</p>
            {{Session::forget('Error')}}
            @endif
            <button class="btn btn-lg  btn-block" type="submit"> أضافة ملاحظة </button>
           
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
