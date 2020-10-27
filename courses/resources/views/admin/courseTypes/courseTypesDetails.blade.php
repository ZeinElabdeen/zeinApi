@extends('admin.layouts.nav')
@if ($add == 1)
    @section('title','Add Course Type')
@else
    @section('title','Edit Course Type')
@endif
@section('links')

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
                    <h3 class="card-title"> {{$add == 1 ? 'Add Course Type':'Edit Course Type'}} </h3>
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action=" {{ $add == 1 ? url("admin/course-types/") : url("admin/course-types/".$courseType->course_type_id) }}" enctype="multipart/form-data">
                        @if ($add != 1)
                            @method("PUT")
                        @endif
                        @csrf
                    <div class="card-body">
                        

                        <div class="form-group">
                            <label for="exampleInputEmail1">Course Type (EN) </label> 
                            <input type="text" class="form-control @error('course_type_name') is-invalid @enderror"  name="course_type_name" value="{{ $add == 1 ? old('course_type_name') : $courseType->course_type_name}}">
                            @if ($errors->has('course_type_name'))
                                <p class='text-danger'>{{$errors->first('course_type_name')}}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Course Type (AR) </label>
                            <input type="text" class="form-control @error('course_type_name_ar') is-invalid @enderror"  name="course_type_name_ar" value="{{$add == 1 ? old('course_type_name_ar') : $courseType->course_type_name_ar}}">
                            @if ($errors->has('course_type_name_ar'))
                                <p class='text-danger'>{{$errors->first('course_type_name_ar')}}</p>
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

@endsection
@endsection
