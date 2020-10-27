@extends('admin.layouts.nav')
@section('title','add city')

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
                    <h3 class="card-title">Add City</h3>
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ url('admin/location') }}" enctype="multipart/form-data">
                        @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">City name (EN)</label>
                            <input type="text" class="form-control @error('city_name') is-invalid @enderror" id="exampleInputEmail1" name="city_name" placeholder="Enter City name" value="{{old('city_name')}}">
                            @if ($errors->has('city_name'))
                            <p class='text-danger'>{{$errors->first('city_name')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">City name (AR)</label>
                            <input type="text" class="form-control my-2 @error('city_name_ar') is-invalid @enderror" style="direction:rtl" name="city_name_ar" id="exampleInputEmail1" placeholder="ادخل اسم المدينة" value="{{old('institute_name_ar')}}">
                            @if ($errors->has('city_name_ar'))
                            <p class='text-danger'>{{$errors->first('city_name_ar')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Select Country</label>
                            <select class="form-control @error('location_id') is-invalid @enderror" name="location_id">
                                @foreach ($country as $country)
                                <option value="{{ $country->location_id }}">{{ $country->country }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('location_id'))
                            <p class='text-danger'>{{$errors->first('location_id')}}</p>
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


</script>
@endsection
@endsection
