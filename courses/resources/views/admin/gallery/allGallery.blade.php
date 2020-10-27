@extends('admin.layouts.nav')
@section('title','Gallery Photo')
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
                    <li class="breadcrumb-item active">All Photos</li>
                </ol>
                </div>
            </div>
            </div>
        </section>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Gallery Photo</h3>
              </div>

              <div class="card-body">
                    <div class="container">
                        <div class="row">
                            @foreach ($photos as $photo)
                            <div class="col-4">
                                <div class="card " style="width: 20rem;">
                                    <div class="card-header text-right bg-light">
                                        <a href="{{url('admin/gallery/'.$photo->photo_id)}}" class="btn btn-outline-warning rounded btn-sm" title="edit"><i class="fas fa-edit"></i></a>
                                        <form action="{{url('admin/gallery/'.$photo->photo_id)}}" method="post" style="display: inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger rounded btn-sm" title="delete"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                        <img src="{{ asset('storage/images/gallery/'.$photo->photo_name) }}" class="card-img-top rounded" alt="..." style="width:100%;height:200px">
                                    <div class="card-body bg-light">
                                      <h5 class="card-title"><b>{{ $photo->photo_title }}</b></h5>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        {{ $photos->links() }}
                    </div>
                </div>

            </div>

          </div>

        </div>
      </section>
@endsection

