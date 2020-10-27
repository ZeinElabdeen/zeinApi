@extends('admin.layouts.nav')
@section('title','add_institue')

@section('content')
<section class="content my-2">
    <div class="container-fluid">
        <div class="row">
        <!-- left column -->
            <div class="col-md-6 mx-auto">
                <div class="form-group text-center">
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                </div>
                <!-- general form elements -->
                <div class="card card-primary">

                    <div class="card-header">
                    <h3 class="card-title">Add Institute</h3>
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ url('admin/institute') }}" enctype="multipart/form-data">
                        @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Institute name</label>
                            <input type="text" class="form-control @error('institute_name') is-invalid @enderror" id="exampleInputEmail1" name="institute_name" placeholder="Enter Institute name" value="{{old('institute_name')}}">
                            @if ($errors->has('institute_name'))
                            <p class='text-danger'>{{$errors->first('institute_name')}}</p>
                            @endif
                            <input type="text" class="form-control my-2 @error('institute_name_ar') is-invalid @enderror" style="direction:rtl" name="institute_name_ar" id="exampleInputEmail1" placeholder="ادخل اسم المعهد" value="{{old('institute_name_ar')}}">
                            @if ($errors->has('institute_name_ar'))
                            <p class='text-danger'>{{$errors->first('institute_name_ar')}}</p>
                            @endif
                        </div>
                        <div class="form-group">

                            <label for="exampleInputEmail1">Institute Email</label>
                            <input type="text" class="form-control @error('institute_email') is-invalid @enderror" id="exampleInputEmail1" name="institute_email" placeholder="Enter Institute Email" value="{{old('institute_email')}}">
                            @if ($errors->has('institute_email'))
                                <p class='text-danger'>{{$errors->first('institute_email')}}</p>
                            @endif
                           
                        </div>
                        <div class="form-group">
                            <label>Select City</label>
                            <select class="form-control @error('city_id') is-invalid @enderror" name="city_id">
                                @foreach ($city as $c)
                                <option value="{{ $c->city_id }}">{{ $c->city_name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('city_id'))
                            <p class='text-danger'>{{$errors->first('city_id')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Select Country</label>
                            <select class="form-control @error('location_id') is-invalid @enderror" name="location_id">
                                @foreach ($country as $country)
                                <option value="{{ $country->location_id }}">{{ $country->country }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('location_id'))
                            <p class='text-danger'>{{$errors->first('location_id')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Upload Image</label>
                            <div class="input-group">
                                <img src="{{url('storage/app/public/images/institutes') }}" id="img" alt="" width="500px">
                            </div>
                            <div class="input-group">

                            <div class="custom-file">
                                <input type="file" class="form-control" id="imginput" name="institutes_photo" onchange="showPhoto()">
                                {{-- <label class="custom-file-label" for="exampleInputFile" id="clik"><i class="fas fa-camera-retro"></i></label> --}}
                            </div>
                            </div>
                            @if ($errors->has('institutes_photo'))
                            <p class='text-danger'>{{$errors->first('institutes_photo')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Institute Details</label>
                        <textarea class="form-control @error('institute_details') is-invalid @enderror" name="institute_details" id="" cols="65" rows="5">{{old('institute_details')}}</textarea>
                        @if ($errors->has('institute_details'))
                        <p class='text-danger'>{{$errors->first('institute_details')}}</p>
                        @endif
                        <label for="exampleInputPassword1" class="text-right d-block">تفاصيل المعهد</label>
                        <textarea class="form-control @error('institute_details_ar') is-invalid @enderror" name="institute_details_ar" id="" cols="65" rows="5">{{old('institute_details_ar')}}</textarea>
                        {{-- <span id="add" onclick="document.getElementById('text').style.display='block'" style="cursor: pointer;direction:rtl"><i class="fas fa-plus-circle"></i>add arabic details </span>
                            <textarea class="form-control" name="institute_details_ar" id="text" cols="65" rows="10" style="direction:rtl" >إضافة التفاصيل </textarea> --}}
                        @if ($errors->has('institute_details_ar'))
                        <p class='text-danger'>{{$errors->first('institute_details_ar')}}</p>
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
        // document.getElementById("clik").addEventListener("click", function(){
        // document.getElementById("imginput").click();
        // });
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
@endsection
