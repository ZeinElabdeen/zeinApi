@extends('admin.layouts.nav')
@section('title','add online course')

@section('content')
<section class="content my-2">
    <div class="container-fluid">
        <div class="row">
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
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Online Course</h3>
                    </div>
                    <form role="form" method="POST" action="{{ url('admin/courseOnline') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="exampleInputEmail1">Course name (EN)</label>
                                    <input type="text" class="form-control @error('online_course_name') is-invalid @enderror" id="exampleInputEmail1" name="online_course_name" placeholder="Enter Course name" value="{{old('online_course_name')}}">
                                    @if ($errors->has('online_course_name'))
                                    <p class='text-danger'>{{$errors->first('online_course_name')}}</p>
                                    @endif
                                </div>
                                <div class="form-group col-6">
                                    <label for="exampleInputEmail1" class="text-right d-block">اسم الدورة</label>
                                    <input type="text" class="form-control text-right d-block @error('online_course_name_ar') is-invalid @enderror" id="exampleInputEmail1" name="online_course_name_ar" placeholder=" ادخل اسم الدورة" value="{{old('online_course_name_ar')}}">
                                    @if ($errors->has('online_course_name_ar'))
                                    <p class='text-danger'>{{$errors->first('online_course_name_ar')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Select Institute</label>
                                <select class="form-control @error('institute_id') is-invalid @enderror" name="institute_id">
                                    @foreach ($institute as $inst)
                                        <option value="{{ $inst->institute_id }}" {{old('institute_id') == $inst->institute_id ? 'selected' : ''}}>{{ $inst->institute_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('institute_id'))
                            <p class='text-danger'>{{$errors->first('institute_id')}}</p>
                            @endif
                            </div>
                            <div class="form-group">
                                <label for="">Course Link</label>
                                <input type="url" class="form-control @error('online_course_link') is-invalid @enderror" name="online_course_link" placeholder="Enter Course URL" value="{{old('online_course_link')}}">
                                @if ($errors->has('online_course_link'))
                                <p class='text-danger'>{{$errors->first('online_course_link')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Upload Image</label>
                                <div class="input-group">
                                    <img src="{{url('storage/app/public/images/onlineCourse') }}" id="img" alt="" width="500px">
                                </div>
                                <div class="input-group">

                                <div class="custom-file">
                                    <input type="file" class="form-control" id="imginput" name="online_course_photo" onchange="showPhoto()">
                                </div>
                                </div>
                                @if ($errors->has('online_course_photo'))
                                <p class='text-danger'>{{$errors->first('online_course_photo')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Course Details (EN)</label>
                                <textarea class="form-control @error('online_course_details') is-invalid @enderror" name="online_course_details" id="" cols="65" rows="5">{{old('online_course_details')}}</textarea>
                                @if ($errors->has('online_course_details'))
                                <p class='text-danger'>{{$errors->first('online_course_details')}}</p>
                                @endif
                            </div>
                            <div class="form_group">
                                <label for="exampleInputPassword1" class="text-right d-block"> تفاصيل الدورة  </label>
                                <textarea class="form-control @error('online_course_details_ar') is-invalid @enderror" name="online_course_details_ar" id="" cols="65" rows="5">{{old('online_course_details_ar')}}</textarea>
                                @if ($errors->has('online_course_details_ar'))
                                <p class='text-danger'>{{$errors->first('online_course_details_ar')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
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
        reader.onloadend = function () {
            document.getElementById('img').setAttribute("src",reader.result);
        };
        reader.readAsDataURL(file);
        }
    </script>
@endsection
@endsection
