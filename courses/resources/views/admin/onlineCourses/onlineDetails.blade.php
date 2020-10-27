@extends('admin.layouts.nav')
@section('title','Institute Details')
@section('links')
    <style>
        #img{
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
<form action="{{url('admin/courseOnline/'.$allonlineCourse->online_course_id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-3">
          <h1>Online Course</h1>
        </div>
        <div class="col-6">
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
        <div class="col-sm-3">
          <ol class="breadcrumb float-sm-right">
            {{-- <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li> --}}
            <li class="breadcrumb-item active">Online Course Details</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none">{{$allonlineCourse->online_course_name}}</h3>
                <div class="col-12">
                    <img src="{{url('storage/images/onlineCourse/'.$allonlineCourse->online_course_photo)}}" class="product-image" id="img" alt="{{$allonlineCourse->online_course_name}}">
                    <input type="file" name="online_course_photo" id="imginput" style="display: none;" onchange="showPhoto()">
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <h3 class="my-3"  style="text-transform: capitalize;" >{{$allonlineCourse->online_course_name}}</h3>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th class="align-middle">Course Name (EN)</th>
                                <td style="text-transform: capitalize;">
                                    <input type="text" name="online_course_name" class="form-control" id="" value="{{$allonlineCourse->online_course_name}}" min="1">
                                </td>
                            </tr>
                            <tr>
                                <th class="align-middle">Course Name (AR)</th>
                                <td style="text-transform: capitalize;">
                                    <input type="text" name="online_course_name_ar" class="form-control" id="" value="{{$allonlineCourse->online_course_name_ar}}" min="1">
                                </td>
                            </tr>
                            <tr>
                                <th class="align-middle">Institute Name</th>
                                <td style="text-transform: capitalize;">
                                    <select name="institute_id" id="" class="form-control">
                                        @foreach ($institute as $inst)
                                            <option value="{{$inst->institute_id}}" {{$inst->institute_id == $allonlineCourse->institute_id ? 'selected' : '' }}>{{$inst->institute_name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th class="align-middle">Course Link</th>
                                <td style="text-transform: capitalize;">
                                    <input type="text" name="online_course_link" class="form-control" id="" value="{{$allonlineCourse->online_course_link}}" min="1">
                                </td>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
        <div class="row mt-4">
          <nav class="w-100">
            <div class="nav nav-tabs" id="product-tab" role="tablist">
              <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
            </div>
          </nav>
          <div class="tab-content p-3 w-100" id="nav-tabContent">
            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                <div>
                    <label for="">Details (EN)</label>
                    <textarea name="online_course_details" id="" class=" form-control" style="resize: none" rows="5">{{$allonlineCourse->online_course_details}}</textarea>
                </div>
                <div>
                    <label for="">Details (AR)</label>
                    <textarea name="online_course_details_ar" id="" style="direction:rtl" class=" form-control" style="resize: none" rows="5">{{$allonlineCourse->online_course_details_ar}}</textarea>
                </div>
            </div>
            <div class="text-right my-3">
                <button type="submit" class="btn btn-outline-success"><b>Save Changes</b></button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
</form>
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
