@extends('user.en.layouts.lay') @section('title',' Add-note ') @section('links')

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
            <span class="text-light">Home / <span>  Add Note  </span>
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
            <h4 > Add Your Note </h4>
            {{-- <p class="text-muted"> Log in to our site to receive all new</p> --}}
            <label >Description </label>
            <textarea name="note_details" id=""  rows="10" class="form-control @error('note_details') is-invalid @enderror"  placeholder=" Enter your notes " required autofocus>{{old('note_details')}}</textarea>
            @if ($errors->has('note_details'))
                <p class='text-danger text-left'>{{$errors->first('note_details')}}</p>
            @endif
            <label> Photo </label>
            <img src="{{url('storage/images/notes/default.jpg')}}" id="img" style="margin-top: 20px;cursor: pointer;max-width: 100%">
            <input type="file" name="note_photo"  id="imginput" style="display: none" onchange="showPhoto()">
            @if ($errors->has('note_photo'))
                <p class='text-danger text-left' >{{$errors->first('note_photo')}}</p>
            @endif
            @if(Session::has('Error'))
            <p class='text-danger text-left' >{{Session::get('Error')}}</p>
            {{Session::forget('Error')}}
            @endif
            <button class="btn btn-lg  btn-block" type="submit"> Add Note</button>
           
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
