@extends('admin.layouts.nav')
@php
    $flag = 0;
    if(isset($photosedit))
        $flag =1;
@endphp
@section('title',$flag ? 'edit Photo':'add Photo')

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
                    <h3 class="card-title">{{ $flag ? 'Edit Photo' : 'Add Photo' }}</h3>
                    </div>


                    <form role="form" method="POST" action="{{ $flag ? url('/admin/gallery/'.$photosedit->photo_id) : url('/admin/gallery') }}" enctype="multipart/form-data">
                        @csrf
                        @if ($flag)
                            @method('put')
                        @endif
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputFile">Upload Photo</label>
                            <div class="input-group">
                                <img src="{{$flag ? url('storage/images/gallery/'.$photosedit->photo_name) : url('storage/images/gallery/default.jpg') }}" id="img" style="cursor: pointer" alt="" width="{{$flag ? '100%':'200px'}}">
                            </div>
                            <div class="input-group">
                                <div class="custom-file">
                                <input type="file" class="form-control" id="imginput" name="photo_name" onchange="showPhoto()" style="display:none" value="{{$flag ? $photosedit->photo_name : old('photo_name') }}">
                                </div>
                            </div>
                            @if ($errors->has('photo_name'))
                                <p class='text-danger'>{{$errors->first('photo_name')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title (EN)</label>
                            <input type="text" class="form-control @error('photo_title') is-invalid @enderror"  name="photo_title" placeholder="Enter Photo Title" value="{{$flag ? $photosedit->photo_title : old('photo_title')}}">
                            @if ($errors->has('photo_title'))
                            <p class='text-danger'>{{$errors->first('photo_title')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title (AR)</label>
                            <input type="text" class="form-control @error('photo_title_ar') is-invalid @enderror text-right"  name="photo_title_ar" placeholder="ادخل عنوان للصوره" value="{{$flag ? $photosedit->photo_title_ar : old('photo_title_ar')}}">
                            @if ($errors->has('photo_title_ar'))
                            <p class='text-danger'>{{$errors->first('photo_title_ar')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6">

                            </div>
                            <div class="col-6 text-right">
                                <button type="submit" class="btn {{$flag ? 'btn-success' : 'btn-primary'}}">{{$flag ? 'Update' : 'Submit'}}</button>
                            </div>
                        </div>
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
