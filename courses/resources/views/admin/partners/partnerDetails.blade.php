@extends('admin.layouts.nav')
@if ($add == 1)
    @section('title','Add Partner')
@else
    @section('title','Partner Details')
@endif
@section('links')
   <style>
        #img,#img2{
        cursor: pointer;
    }
   </style>
   {{-- {{$add == 1 ? '':''}} --}}
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
                    <h3 class="card-title"> {{$add == 1 ? 'Add Partner':'Edit Partner'}} </h3>
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action=" {{ $add == 1 ? url("admin/partners/") : url("admin/partners/".$partner->partner_id) }}" enctype="multipart/form-data">
                        @if ($add != 1)
                            @method("PUT")
                        @endif
                        @csrf
                    <div class="card-body">
                        

                        
                        <div class="form-group">
                            <label for="exampleInputFile">Upload Partner Logo </label>
                            <div class="input-group">
                                <img src="{{$add == 1 ? url("storage/images/partners/default.jpg"):url("storage/images/partners/".$partner->partner_photo)}}" id="img" alt="cover" >
                            </div>
                            <p><small> Photo must be 200 x 67 </small></p>

                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="form-control" id="imginput" name="partner_photo" onchange="showPhoto()" style="display: none">
                                </div>
                            </div>
                            @if ($errors->has('partner_photo'))
                            <p class='text-danger'>{{$errors->first('partner_photo')}}</p>
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
          
      </div>
    </div>
</section>
@section('scripts')
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
@endsection
