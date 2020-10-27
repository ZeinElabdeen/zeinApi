@extends('admin.layouts.nav')
@section('title','add student')
@section('links')
<script src="{{url("adminAssests/plugins/jquery/jquery.min.js")}}"></script>
@endsection
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
                        <h3 class="card-title">Add Student</h3>
                    </div>
                    <form role="form" method="POST" action="{{ url('admin/student') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Student name</label>
                                <input type="text" class="form-control @error('student_name') is-invalid @enderror"  name="student_name" placeholder="Enter Student Name" value="{{old('student_name')}}">
                                @if ($errors->has('student_name'))
                                <p class='text-danger'>{{$errors->first('student_name')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">E-mail</label>
                                <input type="email" class="form-control @error('student_email') is-invalid @enderror"  name="student_email" placeholder="Enter Student Email" value="{{old('student_email')}}">
                                @if ($errors->has('student_email'))
                                <p class='text-danger'>{{$errors->first('student_email')}}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone</label>
                                <input type="number" class="form-control @error('student_phone') is-invalid @enderror"  name="student_phone" placeholder="Enter Student Phone" value="{{old('student_phone')}}">
                                @if ($errors->has('student_phone'))
                                <p class='text-danger'>{{$errors->first('student_phone')}}</p>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">password</label>
                                        <input type="password" class="form-control @error('student_password') is-invalid @enderror"  name="student_password" placeholder="Enter Password" value="{{old('student_password')}}">
                                        @if ($errors->has('student_password'))
                                        <p class='text-danger'>{{$errors->first('student_password')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">confirm password</label>
                                        <input type="password" class="form-control @error('student_password') is-invalid @enderror"  name="student_password" placeholder="Enter Student Password" value="{{old('student_password')}}">
                                        @if ($errors->has('student_password'))
                                        <p class='text-danger'>{{$errors->first('student_password')}}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <label for="" id="add" onclick="document.getElementById('text').style.display='block'" style="cursor: pointer"><i class="fas fa-plus-circle"></i> Add passport</label>
                                @if ($errors->has('student_passport_name') || $errors->has('student_passport_number') || $errors->has('passport_photo'))
                                    <script>
                                        $(document).ready(function(){
                                            document.getElementById('text').style.display='block'
                                        });
                                    </script>
                                @endif
                            <div id="text" style="display:none">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Passport Name</label>
                                    <input type="text" class="form-control @error('student_passport_name') is-invalid @enderror"  name="student_passport_name" placeholder="Enter Passport Name" value="{{old('student_passport_name')}}">
                                    @if ($errors->has('student_passport_name'))
                                    <p class='text-danger'>{{$errors->first('student_passport_name')}}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Passport Number</label>
                                    <input type="number" class="form-control @error('student_passport_number') is-invalid @enderror"  name="student_passport_number" placeholder="Enter Passport Number" value="{{old('student_passport_number')}}">
                                    @if ($errors->has('student_passport_number'))
                                    <p class='text-danger'>{{$errors->first('student_passport_number')}}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Upload Passport Photo</label>
                                    <div class="input-group">
                                        <img src="{{url('storage/app/public/images/institutes') }}" id="img" alt="" width="500px">
                                    </div>
                                    <div class="input-group">

                                    <div class="custom-file">
                                        <input type="file" class="form-control" id="imginput" name="passport_photo" onchange="showPhoto()">
                                    </div>
                                    </div>
                                    @if ($errors->has('passport_photo'))
                                    <p class='text-danger'>{{$errors->first('passport_photo')}}</p>
                                    @endif
                                </div>
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
    {{-- <script>
        document.getElementById("add").addEventListener("click", myFunction);
        function myFunction() {
        document.getElementById("demo").innerHTML = "YOU CLICKED ME!";
        }
    </script> --}}
@endsection
@endsection
