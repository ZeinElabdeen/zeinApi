



@extends('admin.layouts.nav')
@section('title','Edit Pages')
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
              <h3 class="card-title">Edit page</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
             
                <form role="form" method="POST" action="{{url('admin/pages/'.$page->page_id)}}" enctype="multipart/form-data">
                    @method("PUT")
                    @csrf
                    <div class="card-body">
                
                
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title (EN) </label> 
                            <input type="text" class="form-control @error('title') is-invalid @enderror"  name="title" value="{{$page->title}}">
                            @if ($errors->has('title'))
                                <p class='text-danger'>{{$errors->first('title')}}</p>
                            @endif
                        </div>
                
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title (AR) </label>
                            <input type="text" class="form-control @error('title_ar') is-invalid @enderror" style="direction: rtl"  name="title_ar" value="{{$page->title_ar}}">
                            @if ($errors->has('title_ar'))
                                <p class='text-danger'>{{$errors->first('title_ar')}}</p>
                            @endif
                        </div>
                
                        <div class="form-group">
                            <label for="exampleInputEmail1">Details (EN) </label>
                            <textarea class="form-control @error('details') is-invalid @enderror" style="resize: none" name="details"  cols="65" rows="5" >{{$page->details}}</textarea>
                            @if ($errors->has('details'))
                                <p class='text-danger'>{{$errors->first('details')}}</p>
                            @endif
                        </div>
                
                        <div class="form-group">
                            <label for="exampleInputEmail1">Details (AR) </label>
                            <textarea class="form-control @error('details_ar') is-invalid @enderror" style="direction: rtl;resize: none" cols="65" rows="5"  name="details_ar" >{{$page->details_ar}}</textarea>
                            @if ($errors->has('details_ar'))
                                <p class='text-danger'>{{$errors->first('details_ar')}}</p>
                            @endif
                        </div>
                
                        @if ($page->page_id == 34)
                            <div class="form-group">
                                <label for="exampleInputFile"> This Photo appears on website only </label>
                                <div class="input-group">
                                    <img src="{{url("storage/images/".$page->page_photo)}}" id="img" alt="{{$page->page_id}}" >
                                </div>
                                <p><small> Photo must be 480 x 468 </small></p>
                
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="form-control" id="imginput" name="page_photo" onchange="showPhoto()" style="display: none">
                                    </div>
                                </div>
                                @if ($errors->has('page_photo'))
                                <p class='text-danger'>{{$errors->first('page_photo')}}</p>
                                @endif
                            </div>
                        @endif
                
                
                
                
                
                
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
                // console.log(reader.result);
            };
            reader.readAsDataURL(file);
            }
    </script>
    @endsection