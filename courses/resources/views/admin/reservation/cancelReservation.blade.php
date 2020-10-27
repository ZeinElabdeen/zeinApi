@extends('admin.layouts.nav')
@section('title','cancel reservation')
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
                <div class="col-sm-6">
                <h1>cancel revervation</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    {{-- <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li> --}}
                    <li class="breadcrumb-item active">canceled revervation</li>
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
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
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
                    @isset($cancel)
                        @foreach ($cancel as $c)
                            <tr>
                                <td>{{$c->reservation_id}}</td>
                                      <td>{{$c->student_name}}</td>
                                      <td>{{$c->course_name}}</td>
                                      {{-- <td>{{$last->institute_name}}</td> --}}
                                      {{-- <td>{{$last->total}}</td> --}}
                                      <td>{{$c->created_at}}</td>

                                      <td class="text-center">

                                          <form action="{{url('admin/reservation/'.$c->reservation_id)}}" method="post" style="display: inline">
                                              @method('DELETE')
                                              @csrf

                                              <button type="submit" class="btn btn-outline-danger rounded btn-sm" title="delete"><i class="fas fa-trash-alt"></i></button>

                                          </form>
                                      </td>
                            </tr>
                        @endforeach
                    @endisset

                    @empty($cancel)
                        no cancel revervation
                    @endempty
                  </tbody>

                </table>
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
      </script>
@endsection
