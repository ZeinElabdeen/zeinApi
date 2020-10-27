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
                    <h3 class="card-title"> {{$add == 1 ? 'Add Terms And Conditions':'Edit Terms And Conditions'}} </h3>
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action=" {{ $add == 1 ? url("admin/terms-conditions/") : url("admin/terms-conditions/".$term->term_id) }}" >
                        @if ($add != 1)
                            @method("PUT")
                        @endif
                        @csrf
                    <div class="card-body">
                        

                        <div class="form-group">
                            <label for="exampleInputEmail1">Term (EN) </label> 
                            <input type="text" class="form-control @error('term_title') is-invalid @enderror"  name="term_title" value="{{ $add == 1 ? old('term_title') : $term->term_title}}">
                            @if ($errors->has('term_title'))
                                <p class='text-danger'>{{$errors->first('term_title')}}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Term (AR) </label>
                            <input type="text" class="form-control @error('term_title_ar') is-invalid @enderror" style="direction: rtl"  name="term_title_ar" value="{{$add == 1 ? old('term_title_ar') : $term->term_title_ar}}">
                            @if ($errors->has('term_title_ar'))
                                <p class='text-danger'>{{$errors->first('term_title_ar')}}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Condition (EN) </label>
                            <textarea class="form-control @error('term_details') is-invalid @enderror" style="resize: none" name="term_details"  cols="65" rows="5" >{{$add == 1 ? old('term_details') : $term->term_details}}</textarea>
                            @if ($errors->has('term_details'))
                                <p class='text-danger'>{{$errors->first('term_details')}}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Condition (AR) </label>
                            <textarea class="form-control @error('term_details_ar') is-invalid @enderror" style="direction: rtl;resize: none" cols="65" rows="5"  name="term_details_ar" >{{$add == 1 ? old('term_details_ar') : $term->term_details_ar}}</textarea>
                            @if ($errors->has('term_details_ar'))
                                <p class='text-danger'>{{$errors->first('term_details_ar')}}</p>
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
