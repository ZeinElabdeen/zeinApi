
@extends('admin.layouts.nav')
@if ($add == 1)
    @section('title','Add Slider')
@else
    @section('title','Edit Slider')
@endif
@section('links')
    <style>
        #img{
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
<section class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-3">
            {{-- <h1>Edit Pages</h1> --}}
            </div>
            <div class="col-sm-6">
             
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
            </div>
            <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
                {{-- <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li> --}}
                {{-- <li class="breadcrumb-item active"> Edit Pages</li> --}}
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="row">
        <div class="col-6 m-auto">
          <div class="card">
            <div class="card-header bg-primary">
              <h3 class="card-title">{{$add == 1 ? 'Add Slider':'Edit Slider'}} </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
             
                <form role="form" method="POST" action="{{ $add == 1 ? url("admin/slider/") : url("admin/slider/".$slider->slider_id) }}" enctype="multipart/form-data">
                    @if ($add != 1)
                        @method("PUT")
                    @endif
                    @csrf
                    <div class="card-body">
                
                
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title (EN) </label> 
                            <input type="text" class="form-control @error('slider_title') is-invalid @enderror"  name="slider_title" value="{{ $add == 1 ? old('slider_title') : $slider->slider_title}}">
                            @if ($errors->has('slider_title'))
                                <p class='text-danger'>{{$errors->first('slider_title')}}</p>
                            @endif
                        </div>
                
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title (AR) </label>
                            <input type="text" class="form-control @error('slider_title_ar') is-invalid @enderror" style="direction: rtl"  name="slider_title_ar" value="{{ $add == 1 ? old('slider_title_ar') : $slider->slider_title_ar}}">
                            @if ($errors->has('slider_title_ar'))
                                <p class='text-danger'>{{$errors->first('slider_title_ar')}}</p>
                            @endif
                        </div>
                
                        <div class="form-group">
                            <label for="exampleInputEmail1">Details (EN) </label>
                            <textarea class="form-control @error('slider_details') is-invalid @enderror" style="resize: none" name="slider_details"  cols="65" rows="5" >{{ $add == 1 ? old('slider_details') : $slider->slider_details}}</textarea>
                            @if ($errors->has('slider_details'))
                                <p class='text-danger'>{{$errors->first('slider_details')}}</p>
                            @endif
                        </div>
                
                        <div class="form-group">
                            <label for="exampleInputEmail1">Details (AR) </label>
                            <textarea class="form-control @error('slider_details_ar') is-invalid @enderror" style="direction: rtl;resize: none" cols="65" rows="5"  name="slider_details_ar" >{{ $add == 1 ? old('slider_details_ar') : $slider->slider_details_ar}}</textarea>
                            @if ($errors->has('slider_details_ar'))
                                <p class='text-danger'>{{$errors->first('slider_details_ar')}}</p>
                            @endif
                        </div>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <input type="radio" aria-label="Radio button for following text input" name="slider_link" value="all-courses" {{ $add == 1 ? '' : $slider->slider_link == 'all-courses' ? 'checked':''}}>
                                </div>
                            </div>
                            <input type="text" class="form-control" aria-label="Text input with radio button" value="All Courses Page" readonly>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <input type="radio" aria-label="Radio button for following text input" name="slider_link" value="all-institutes" {{ $add == 1 ? '' : $slider->slider_link == 'all-institutes' ? 'checked':''}}>
                                </div>
                            </div>
                            <input type="text" class="form-control" aria-label="Text input with radio button" value="All Institutes Page" readonly>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <input type="radio" aria-label="Radio button for following text input" name="slider_link" value="account" {{ $add == 1 ? '' : $slider->slider_link == 'account' ? 'checked':''}}>
                                </div>
                            </div>
                            <input type="text" class="form-control" aria-label="Text input with radio button" value="Login Page" readonly>
                        </div>
                <br>
                        <div class="form-group">
                            <label for="exampleInputFile"> Slider Photo </label>
                            <div class="input-group">
                                <img src="{{$add == 1 ? url("storage/images/partners/default.jpg"): url("storage/images/sliders/".$slider->slider_photo)}}" id="img" width="{{$add == 1 ? '' : '100%'}}">
                            </div>
                            <p><small> Photo must be 770 x 400 </small></p>
            
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="form-control" id="imginput" name="slider_photo" onchange="showPhoto()" style="display: none">
                                </div>
                            </div>
                            @if ($errors->has('slider_photo'))
                            <p class='text-danger'>{{$errors->first('slider_photo')}}</p>
                            @endif
                        </div>
                
                        
                
                
                
                
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

    @endsection
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
                document.getElementById('img').setAttribute("width","100%");
                // console.log(reader.result);
            };
            reader.readAsDataURL(file);
            }
    </script>
    @endsection