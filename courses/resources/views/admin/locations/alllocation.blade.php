@extends('admin.layouts.nav')
@section('title','all location')
@section('links')
    <link rel="stylesheet" href="{{url('adminAssests/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="adminAssests/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection
@section('content')

    <section class="content">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3">
                <h1>All Locations</h1>
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
                    {{-- <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li> --}}
                    <li class="breadcrumb-item active">All Locations</li>
                </ol>
                </div>
            </div>
            </div><!-- /.container-fluid -->
        </section>
        {{-- data table  --}}
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                {{-- <h3 class="card-title">DataTable with minimal features & hover style</h3> --}}
                <div class="nav nav-tabs" id="product-tab" role="tablist">
                    <a class="nav-item nav-link active" id="country-tab" data-toggle="tab" href="#country" role="tab" aria-controls="country" aria-selected="true">Country</a>
                    <a class="nav-item nav-link" id="city-tab" data-toggle="tab" href="#city" role="tab" aria-controls="city" aria-selected="false">City</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-3 w-100" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="country" role="tabpanel" aria-labelledby="country-tab">
                        <table id="example1" class="table table-bordered table-hover ">
                            <thead>
                            <tr>
                              <th>Id </th>
                              <th colspan="2">Country Name</th>
                              <th>City Name</th>
                              {{-- <th>Created At</th> --}}
                              <th>Edit</th>
                              <th>Delete</th>

                            </tr>
                            </thead>
                            <tbody>

                             @foreach ($country as $c)
                                  <tr>
                                      <td>{{$loop->iteration}}</td>
                                      <td>{{$c->country}}</td>
                                      <td>{{$c->country_ar}}</td>
                                      <td>
                                          <select name=""  class="form-control" id="">
                                              @foreach ($cities as $city)
                                                  @if ($c->location_id == $city->location_id)
                                                      <option value="">{{$city->city_name}}</option>
                                                  @endif
                                              @endforeach
                                          </select>
                                      </td>
                                      {{-- <td>{{$c->created_at}} SAR</td> --}}
                                      <td class="text-center">
                                        <a href="{{url('admin/location/'.$c->location_id)}}" class="btn btn-outline-warning rounded"><i class="fas fa-edit"></i></a>

                                      </td>
                                      <td class="text-center">
                                          <form action="{{url('admin/deleteCountry/'.$c->location_id)}}" method="post" style="display: inline">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn btn-outline-danger rounded"><i class="fas fa-trash-alt"></i></button>
                                          </form>
                                      </td>
                                  </tr>
                              @endforeach

                            </tbody>

                        </table>
                    </div>
                    <div class="tab-pane fade" id="city" role="tabpanel" aria-labelledby="city-tab">
                        <table id="example2" class="table table-bordered table-hover ">
                            <thead>
                            <tr>
                              <th>Id </th>
                              <th colspan="2">City Name</th>
                              <th colspan="2">Country Name</th>

                              {{-- <th>Created At</th> --}}
                              <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                             @foreach ($cities as $city)
                                  <tr>
                                      <td>{{$loop->iteration}}</td>
                                      <td>{{$city->city_name}}</td>
                                      <td class="text-right">{{$city->city_name_ar}}</td>
                                      <td>
                                          @foreach ($country as $count)
                                          @if ($count->location_id == $city->location_id)
                                          {{$count->country}}
                                          @endif

                                          @endforeach
                                        </td>
                                        <td class="text-right">
                                            @foreach ($country as $count)
                                            @if ($count->location_id == $city->location_id)
                                            {{$count->country_ar}}
                                            @endif

                                            @endforeach
                                          </td>
                                          <td class="text-center">
                                            <a href="{{url('admin/showCity/'.$city->city_id)}}" class="btn btn-outline-warning rounded"><i class="fas fa-edit"></i></a>

                                          </td>
                                      {{-- <td>{{$c->created_at}} SAR</td> --}}
                                      <td class="text-center">
                                          <form action="{{url('admin/location/'.$city->city_id)}}" method="post" style="display: inline">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn btn-outline-danger rounded"><i class="fas fa-trash-alt"></i></button>
                                          </form>
                                      </td>
                                  </tr>
                              @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
@endsection
@section('scripts')
    <script src="{{url('adminAssests/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('adminAssests/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('adminAssests/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('adminAssests/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script>
        $(function () {
          $('#example1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });
        });

        $(function () {
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });
        });
    </script>
@endsection
