@extends('admin.layouts.nav')
@section('title','add revervation')

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
                    <h3 class="card-title">Add Reservation</h3>
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ url('admin/reservation-session') }}" >
                        @csrf

                    <div class="card-body">
                        
                        <div class="form-group">
                            <label>Select Student</label>
                            <select class="form-control @error('student_id') is-invalid @enderror" name="student_id">
                                @foreach ($students as $student)
                                <option value="{{ $student->student_id }}" {{old('student_id') == $student->student_id ? 'selected' : ''}}>{{ $student->student_id }}-{{ $student->student_name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('student_id'))
                                <p class='text-danger'>{{$errors->first('student_id')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Select Course</label>
                            <select class="form-control @error('course_id') is-invalid @enderror" name="course_id">
                                @foreach ($courses as $course)
                                <option value="{{ $course->course_id }}" {{old('course_id') == $course->course_id ? 'selected' : ''}}>{{ $course->course_id }}-{{ $course->course_name }}-{{ $course->course_name_ar }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('course_id'))
                                <p class='text-danger'>{{$errors->first('course_id')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" name="start_at" id="" class="form-control">
                            @if ($errors->has('start_at'))
                                <p class='text-danger'>{{$errors->first('start_at')}}</p>
                            @endif
                        </div>
                            
                        <div class="form-group">
                            <label> Weeks Number </label>
                            <input type="number" name="reserved_weeks_number" id="" class="form-control" min="1">
                            @if ($errors->has('reserved_weeks_number'))
                                <p class='text-danger'>{{$errors->first('reserved_weeks_number')}}</p>
                            @endif
                        </div>
                            
                            
                    </div>                      
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Next</button>
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
