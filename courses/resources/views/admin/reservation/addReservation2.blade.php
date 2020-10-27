@extends('admin.layouts.nav')
@section('title','add revervation')

@section('content')
<section class="content my-2">
    <div class="container-fluid">
        <div class="row">
        <!-- left column -->
            <div class="col-md-6 mx-auto">
                <div class="form-group text-center">
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
                <!-- general form elements -->
                <div class="card card-primary">

                    <div class="card-header">
                    <h3 class="card-title">Complete Reservation</h3>
                   
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ url('admin/reservation') }}" >
                        @csrf

                    <div class="card-body">
                        
                        <div class="form-group">
                            <label>Select Residence</label>
                            <select name="living_id" id="" class="form-control">
                                <option value="4">i dont want Residence</option>
                                @foreach ($residences as $residence)
                                    <option value="{{$residence->living_id}}" {{old('living_id') == $residence->living_id ? 'selected' : ''}} >{{$residence->living_name}}</option>
                                @endforeach
                                

                            </select>
                            @if ($errors->has('living_id'))
                                <p class="text-danger">{{$errors->first('living_id')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Select Reception</label>
                            <select name="airport_rec_id" id="" class="form-control">
                                <option value="13">i dont want Reception</option>
                                @foreach ($receptions as $reception)
                                    <option value="{{$reception->airport_rec_id}}" {{old('airport_rec_id') == $reception->airport_rec_id ? 'selected' : ''}}>{{$reception->airport_rec_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('airport_rec_id'))
                                <p class="text-danger">{{$errors->first('airport_rec_id')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Select Insurance</label>

                            <select name="medical_insurance_id" id="" class="form-control">

                                <option value="13">i dont want insurance</option>
                                @foreach ($insurances as $insurance)
                                    <option value="{{$insurance->medical_insurance_id}}" {{old('medical_insurance_id') == $insurance->medical_insurance_id ? 'selected' : ''}}>{{$insurance->medical_insurance_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('medical_insurance_id'))
                                <p class="text-danger">{{$errors->first('medical_insurance_id')}}</p>
                            @endif
                        </div>
                            
                        <div class="form-group">
                            <label> coupon  </label>
                            <input type="number" name="coupon" id="" class="form-control" min="1" placeholder="Insert coupon">
                            @if ($errors->has('coupon'))
                                <p class='text-danger'>{{$errors->first('coupon')}}</p>
                            @endif
                        </div>
                            
                            
                    </div>                      
                    <div class="card-footer ">
                        <div class="row">
                            <div class="col-3">
                                <a href="{{url('admin/reservation/create')}}" class="btn btn-dark">Back</a>
                            </div>
                            <div class="col-6">
    
                            </div>
                            <div class="col-3 text-right">
                                <button type="submit" class="btn btn-primary">confirm</button>
                            </div>
                        </div>
                       
                        
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
