@extends('admin.layouts.nav')
@php
    $flag = 0;
    if(isset($videosedit))
        $flag =1;
@endphp
@section('title', $flag ? 'Edit video' : 'Add video')

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
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">{{ $flag ? 'Edit video' : 'Add video' }}</h3>
                    </div>
                    <form role="form" method="POST" action="{{ $flag ? url('/admin/updateVideo/'.$videosedit->video_id) : url('/admin/addVedio') }}" enctype="multipart/form-data">
                        @csrf
                        @if ($flag)
                        @method('put')
                        @endif
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputFile">Upload Vedio</label>
                            <div class="input-group">
                                <iframe src="{{$flag ? url("storage/videos/".$videosedit->video_url) : url("storage/videos/default.jpg")}}" id="vedio" width="100%" style="overflow:hidden;"></iframe>
                            </div>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="form-control" id="vedioinput" name="video_url" onchange="showvedio()" value="{{$flag ? $videosedit->video_url : old('video_url')}}">
                                </div>
                            </div>
                            @if ($errors->has('video_url'))
                                <p class='text-danger'>{{$errors->first('video_url')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Upload Photo</label>
                            <div class="input-group">
                                <img src="{{$flag ? url("storage/videos/covers/".$videosedit->cover_photo) : url("storage/app/public/videos/covers")}}" id="img" alt="" width="500px" style="cursor: {{ $flag ? 'pointer' : '' }}">
                            </div>
                            <div class="input-group">
                                <div class="custom-file">
                                <input type="file" class="form-control" id="imginput" name="cover_photo" onchange="showPhoto()"  value="{{$flag ? $videosedit->cover_photo : ''}}">
                                </div>
                            </div>
                            @if ($errors->has('cover_photo'))
                                <p class='text-danger'>{{$errors->first('cover_photo')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title (EN)</label>
                            <input type="text" class="form-control @error('video_title') is-invalid @enderror"  name="video_title" placeholder="Enter Vedio Title" value="{{$flag ? $videosedit->video_title : old('video_title')}}">
                            @if ($errors->has('video_title'))
                            <p class='text-danger'>{{$errors->first('video_title')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title (AR)</label>
                            <input type="text" class="form-control @error('video_title_ar') is-invalid @enderror text-right"  name="video_title_ar" placeholder="ادخل عنوان للفيديو" value="{{$flag ? $videosedit->video_title_ar : old('video_title_ar')}}">
                            @if ($errors->has('video_title_ar'))
                            <p class='text-danger'>{{$errors->first('video_title_ar')}}</p>
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
    <script>
        function showvedio() {
            var file = document.getElementById('vedioinput').files[0];
            console.log(file);
            reader = new FileReader();
            reader.onloadend = function () {
                document.getElementById('vedio').setAttribute("src",reader.result);
            };
            reader.readAsDataURL(file);
            }
    </script>
@endsection
@endsection
