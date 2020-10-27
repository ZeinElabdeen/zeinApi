@extends('admin.layouts.nav')
@section('title','Gallery Video')
@section('links')
    <link rel="stylesheet" href="{{url('adminAssests/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="adminAssests/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <link rel="stylesheet" href="{{url('assets-en/css/jquery.fancybox.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
@endsection
@section('content')
    <section class="content">
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3">
                <h1>Gallery</h1>
                </div>
                <div class="col-sm-6">
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
                <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">All Videos</li>
                </ol>
                </div>
            </div>
            </div>
        </section>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Gallery Video</h3>
              </div>
              <div class="card-body">
                    <div class="container">
                        <div class="row">
                            @foreach ($vedios as $vedio)
                            <div class="col-4">
                                <div class="card " style="width: 20rem;">
                                    <div class="card-header text-right bg-light">
                                        <a href="{{url('admin/editVideo/'.$vedio->video_id)}}" class="btn btn-outline-warning rounded btn-sm" title="edit"><i class="fas fa-edit"></i></a>
                                        <form action="deleteVideo/{{$vedio->video_id}}" method="post" style="display: inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger rounded btn-sm" title="delete"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                    <div class="text">
                                        <a class="fancybox" href="{{asset('storage/videos/'.$vedio->video_url) }}">
                                        <img src="{{asset('storage/videos/covers/'.$vedio->cover_photo)}}" class="card-img-top" style="width:100%;height:200px">
                                    </div>
                                    <div class="card-body bg-light">
                                      <h5 class="card-title"><b>{{ $vedio->video_title }}</b></h5>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        {{ $vedios->links() }}
                    </div>

              </div>

            </div>

          </div>

        </div>

      </section>
@endsection
@section('scripts')
    <script src="{{url('adminAssests/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('adminAssests/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('adminAssests/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('adminAssests/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
      <script src="{{url('assets-en/js/jquery.fancybox.js')}}"></script>
      <script>
       $(function() {
         $(".fancybox").fancybox();

       });
      </script>
@endsection
