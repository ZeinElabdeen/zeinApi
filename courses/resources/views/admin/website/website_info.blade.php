@extends('admin.layouts.nav')
@section('title','Website information')
@section('links')
   <style>
        #img,#img2{
        cursor: pointer;
    }
   </style>
@endsection
@section('content')
<section class="content my-2">
    <div class="container-fluid">
        <div class="row">
        <!-- left column -->
            <div class="col-md-6 mx-auto">
                <div class="form-group text-center">
                    @if(Session::has('Success'))
                        <div class="alert alert-success text-center">{{Session::get('Success')}}</div>
                    @endif
                    @php
                    if(Session::get('Success')){
                        Session::forget('Success');
                    }
                    @endphp
        
                    @if(Session::has('Error'))
                        <div class="alert alert-danger text-center">{{Session::get('Error')}}</div>
                    @endif
                    @php
                    if(Session::get('Error')){
                        Session::forget('Error');
                    }
                    @endphp
                </div>
                <!-- general form elements -->
                <div class="card card-primary">

                    <div class="card-header">
                    <h3 class="card-title">Edit Website infromations</h3>
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ url('admin/website-information') }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email </label>

                            <input type="text" class="form-control @error('info_mail') is-invalid @enderror" id="exampleInputEmail1" name="info_mail" placeholder="Enter Email" value="{{$info->info_mail}}">
                            @if ($errors->has('info_mail'))
                                <p class='text-danger'>{{$errors->first('info_mail')}}</p>
                            @endif

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phone </label>

                            <input type="text" class="form-control @error('info_phone') is-invalid @enderror" id="exampleInputEmail1" name="info_phone" placeholder="Enter Phone" value="{{$info->info_phone}}">
                            @if ($errors->has('info_phone'))
                                <p class='text-danger'>{{$errors->first('info_phone')}}</p>
                            @endif

                        </div>      

                        <div class="form-group">
                            <label for="exampleInputEmail1">City </label>
                            <input type="text" class="form-control @error('info_city') is-invalid @enderror" name="info_city" id=""  placeholder="Enter city " value="{{$info->info_city}}">
                            @if ($errors->has('info_city'))
                                <p class='text-danger'>{{$errors->first('info_city')}}</p>
                            @endif
                            <br>
                            <input type="text" class="form-control @error('info_city_ar') is-invalid @enderror" name="info_city_ar" id=""  style="direction:rtl" placeholder="ادخل اسم المدينة" value="{{$info->info_city_ar}}">
                            @if ($errors->has('info_city_ar'))
                                <p class='text-danger'>{{$errors->first('info_city_ar')}}</p>
                            @endif

                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Country </label>
                            <input type="text" class="form-control @error('info_country') is-invalid @enderror" name="info_country" id="" cols="65" rows="5" placeholder="Enter Counrty " value="{{$info->info_country}}">
                            @if ($errors->has('info_country'))
                                <p class='text-danger'>{{$errors->first('info_country')}}</p>
                            @endif
                            <br>
                            <input type="text" class="form-control @error('info_country_ar') is-invalid @enderror" name="info_country_ar" id="" cols="65" rows="5" style="direction:rtl" placeholder="ادخل اسم الدولة" value="{{$info->info_country_ar}}" >
                            @if ($errors->has('info_country_ar'))
                                <p class='text-danger'>{{$errors->first('info_country_ar')}}</p>
                            @endif

                        </div>

                      
                        
                        <div class="form-group">
                            <label for="exampleInputFile">Upload Primary Logo </label>
                            <div class="input-group">
                                <img src="{{url('storage/images/logo/'.$info->logo) }}" id="img" alt="cover" width="100%">
                                <p><small> Photo must be 1600 x 495 </small></p>
                            </div>
                            <div class="input-group">

                            <div class="custom-file">
                                <input type="file" class="form-control" id="imginput" name="logo" onchange="showPhoto()">
                            </div>
                            </div>
                            @if ($errors->has('logo'))
                            <p class='text-danger'>{{$errors->first('logo')}}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Upload secondary Logo </label>
                            <div class="input-group">
                                <img src="{{url('storage/images/logo/'.$info->logo2) }}" id="img2" alt="cover" width="100%">
                                <p><small> Photo must be 1600 x 495 </small></p>
                            </div>
                            <div class="input-group">

                            <div class="custom-file">
                                <input type="file" class="form-control" id="imginput2" name="logo2" onchange="showPhoto2()">
                            </div>
                            </div>
                            @if ($errors->has('logo2'))
                            <p class='text-danger'>{{$errors->first('logo2')}}</p>
                            @endif
                        </div>
                       
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            {{-- <div class="col-md-6">
                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
            </div> --}}
      </div>
    </div>
</section>
@section('scripts')
<script>

    // institute upload photo function
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



        document.getElementById("img2").addEventListener("click", function(){
            document.getElementById("imginput2").click();
        });
        function showPhoto2() {
        var file = document.getElementById('imginput2').files[0];
        console.log(file);
        reader = new FileReader();
        // console.log(reader);
        reader.onloadend = function () {
            document.getElementById('img2').setAttribute("src",reader.result);
            // console.log(reader.result);
        };
        reader.readAsDataURL(file);
        }

</script>
@endsection
@endsection
