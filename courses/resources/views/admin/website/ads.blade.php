@extends('admin.layouts.nav')
@section('title','Advertisment')
@section('links')
   <style>
        #img{
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
                    <h3 class="card-title">Edit Advertisment</h3>
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ url('admin/advertisement') }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Advertisment title</label>

                            <input type="text" class="form-control @error('ads_title') is-invalid @enderror" id="exampleInputEmail1" name="ads_title" placeholder="Enter advertisment title " value="{{$getAd->ads_title}}">
                            @if ($errors->has('ads_title'))
                                <p class='text-danger'>{{$errors->first('ads_title')}}</p>
                            @endif

                            <input type="text" class="form-control my-2 @error('ads_title_ar') is-invalid @enderror" style="direction:rtl" name="ads_title_ar" id="exampleInputEmail1" placeholder="ادخل عنوان الاعلان" value="{{$getAd->ads_title_ar}}">
                            @if ($errors->has('ads_title_ar'))
                                <p class='text-danger'>{{$errors->first('ads_title_ar')}}</p>
                            @endif

                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Advertisment details</label>
                            <textarea class="form-control @error('ads_details') is-invalid @enderror" name="ads_details" id="" cols="65" rows="5" placeholder="Enter advertisment details " >{{$getAd->ads_details}}</textarea>
                            @if ($errors->has('ads_details'))
                                <p class='text-danger'>{{$errors->first('ads_details')}}</p>
                            @endif

                            <textarea class="form-control @error('ads_details_ar') is-invalid @enderror" name="ads_details_ar" id="" cols="65" rows="5" style="direction:rtl" placeholder="ادخل تفاصيل الاعلان" >{{$getAd->ads_details_ar}}</textarea>
                            @if ($errors->has('ads_details_ar'))
                                <p class='text-danger'>{{$errors->first('ads_details_ar')}}</p>
                            @endif

                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Advertisment links</label>

                            <input type="text" class="form-control @error('ads_andriod_link') is-invalid @enderror" id="exampleInputEmail1" name="ads_andriod_link" placeholder="Enter Andriod Link " value="{{$getAd->ads_andriod_link}}">
                            @if ($errors->has('ads_andriod_link'))
                                <p class='text-danger'>{{$errors->first('ads_andriod_link')}}</p>
                            @endif

                            <input type="text" class="form-control my-2 @error('ads_ios_link') is-invalid @enderror"  name="ads_ios_link" id="exampleInputEmail1" placeholder=" Enter IOS link" value="{{$getAd->ads_ios_link}}">
                            @if ($errors->has('ads_ios_link'))
                                <p class='text-danger'>{{$errors->first('ads_ios_link')}}</p>
                            @endif

                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputFile">Upload Image</label>
                            <div class="input-group">
                                <img src="{{url('storage/images/'.$getAd->ads_cover_photo) }}" id="img" alt="cover" width="100%">
                                <p><small> Photo must be 1600 x 495 </small></p>
                            </div>
                            <div class="input-group">

                            <div class="custom-file">
                                <input type="file" class="form-control" id="imginput" name="ads_cover_photo" onchange="showPhoto()">
                            </div>
                            </div>
                            @if ($errors->has('ads_cover_photo'))
                            <p class='text-danger'>{{$errors->first('ads_cover_photo')}}</p>
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

</script>
@endsection
@endsection
