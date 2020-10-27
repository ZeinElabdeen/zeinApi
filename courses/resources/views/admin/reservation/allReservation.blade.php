@extends('admin.layouts.nav')
@section('title','all reservation')
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
                <h1>Reservation</h1>
                </div>
                <div class="col-6">
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
                <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    {{-- <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li> --}}
                    <li class="breadcrumb-item active">All Reservation</li>
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
                    <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Current Reservation</a>
                    <a class="nav-item nav-link" id="courses-tab" data-toggle="tab" href="#courses" role="tab" aria-controls="courses" aria-selected="false">Previous Reservation</a>


                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-3 w-100" id="nav-tabContent">
                <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                    <table id="example1" class="table table-bordered table-hover ">
                        <thead>
                        <tr>
                          <th>Reservation Id </th>
                          <th>Student Name</th>
                          <th>Course</th>
                          {{-- <th>Institute</th> --}}
                          <th>Total</th>
                          <th>Confirm</th>
                          <th>Cancel</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                          @isset($reserve)
                              @foreach ($reserve as $res)
                                  <tr>
                                      <td>{{$res->reservation_id}}</td>
                                      <td>{{$res->student_name}}</td>
                                      <td>{{$res->course_name}}</td>
                                      {{-- <td>{{$res->institute_name}}</td> --}}
                                      <td>{{$res->created_at}}</td>

                                      <td class="text-center">
                                          <a href="{{url('admin/confirmStatus/'.$res->reservation_id)}}" type="submit" class="btn btn-outline-success rounded btn-sm" title="confirm"><i class="fas fa-check-square"></i></a>
                                          
                                      </td>
                                      <td class="text-center">
                                        <a href="{{url('admin/cancelStatus/'.$res->reservation_id)}}"type="submit" class="btn btn-outline-danger rounded btn-sm" title="cancel"><i class="fas fa-check-square"></i></a>

                                      </td>
                                      <td class="text-center">
                                        <a href="{{url('admin/reservation/'.$res->reservation_id)}}" class="btn btn-outline-warning rounded btn-sm" title="edit"><i class="fas fa-edit"></i></a>

                                      </td>
                                      <td class="text-center">
                                        <form action="{{url('admin/reservation/'.$res->reservation_id)}}" method="post" style="display: inline">
                                          @method('DELETE')
                                          @csrf

                                          <button type="submit" class="btn btn-outline-danger rounded btn-sm" title="delete"><i class="fas fa-trash-alt"></i></button>

                                        </form>
                                      </td>
                                  </tr>
                              @endforeach
                          @endisset

                          @empty($reserve)
                              No Reservation
                          @endempty
                        </tbody>

                    </table>
                </div>
                <div class="tab-pane fade" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                    <table id="example2" class="table table-bordered table-hover ">
                        <thead>
                        <tr>
                          <th>Reservation Id </th>
                          <th>Student Name</th>
                          <th>Course</th>
                          {{-- <th>Institute</th> --}}
                          <th>Create at</th>
                          <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                          @isset($lastReserve)
                              @foreach ($lastReserve as $last)
                                  <tr>
                                      <td>{{$last->reservation_id}}</td>
                                      <td>{{$last->student_name}}</td>
                                      <td>{{$last->course_name}}</td>
                                      {{-- <td>{{$last->institute_name}}</td> --}}
                                      {{-- <td>{{$last->total}}</td> --}}
                                      <td>{{$last->created_at}}</td>

                                      <td class="text-center">
                                          {{-- <button type="submit" class="btn btn-outline-success rounded btn-sm" title="confirm"><i class="fas fa-check-square"></i></button> --}}

                                          <a href="{{url('admin/reservation/'.$last->reservation_id)}}" class="btn btn-outline-warning rounded btn-sm" title="edit"><i class="fas fa-edit"></i></a>
                                          <form action="{{url('admin/reservation/'.$last->reservation_id)}}" method="post" style="display: inline">
                                              @method('DELETE')
                                              @csrf

                                              <button type="submit" class="btn btn-outline-danger rounded btn-sm" title="delete"><i class="fas fa-trash-alt"></i></button>

                                          </form>
                                      </td>
                                  </tr>
                              @endforeach
                          @endisset

                          @empty($lastReserve)
                              No Last Reservation
                          @endempty
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

      </script>
      @isset($prev)
          @if ($prev)
              <script>
                $(document).ready(function(){
                  $('#courses-tab').click();
                });
              </script>
          @endif
      @endisset
@endsection
