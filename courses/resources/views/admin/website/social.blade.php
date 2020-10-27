@extends('admin.layouts.nav')
@section('title','Social')
@section('links')
  
@endsection
@section('content')
<section class="content my-2">
    <div class="container-fluid">
        <div class="row">
        <!-- left column -->
            <div class="col-md-12 my-4">
                <h3 class="text-center text-dark">Edit Website infromations</h3>
            </div>
            <div class="col-md-12 text-center">
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
            @foreach ($socials as $social)
            <div class="col-md-6 ">
               
                <!-- general form elements -->
                <div class="card card-primary">

                    <div class="card-header">
                    <h3 class="card-title">Edit Social Media </h3>
                    </div>
                  

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ url('admin/social/'.$social->social_id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Social Link </label>

                                <textarea class="form-control @error('social_link') is-invalid @enderror" id="exampleInputEmail1" name="social_link" placeholder="Enter socail link" >{{$social->social_link}}</textarea>
                                @if ($errors->has('social_link'))
                                    <p class='text-danger'>{{$errors->first('social_link')}}</p>
                                @endif

                            </div>
                        
                        
                            <div class="form-group">
                                <label for="exampleInputFile">Upload Social Logo  
                                    <span style="background-color: black;width:10px;height: 20px;">
                                        <img src="{{url('storage/images/'.$social->social_photo) }}" id="img{{$loop->index}}" alt="cover" width="10px" height="20px">
                                    </span>
                                </label>
                                <div class="input-group" >
                                   
                                    <p style="display: block !important"><small> Photo must be 10 x 20 </small></p>
                                </div>
                                <div class="input-group">

                                <div class="custom-file">
                                    <input type="file" class="form-control" id="imginput{{$loop->index}}" name="social_photo" onchange="showPhoto{{$loop->index}}()">
                                </div>
                                </div>
                                @if ($errors->has('social_photo'))
                                <p class='text-danger'>{{$errors->first('social_photo')}}</p>
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
            
            <style>
                #img{{$loop->index}}{
                cursor: pointer;
            }
           </style>
            <script>

                // institute upload photo function
                    document.getElementById("img{{$loop->index}}").addEventListener("click", function(){
                        document.getElementById("imginput{{$loop->index}}").click();
                    });
                    function showPhoto{{$loop->index}}() {
                    var file = document.getElementById('imginput{{$loop->index}}').files[0];
                    console.log(file);
                    reader = new FileReader();
                    // console.log(reader);
                    reader.onloadend = function () {
                        document.getElementById('img{{$loop->index}}').setAttribute("src",reader.result);
                        // console.log(reader.result);
                    };
                    reader.readAsDataURL(file);
                    }
            
            </script>
            @endforeach
      </div>
    </div>
</section>
@section('scripts')

@endsection
@endsection
