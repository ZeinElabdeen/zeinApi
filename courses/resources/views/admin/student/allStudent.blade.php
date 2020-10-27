@extends('admin.layouts.nav')
@section('title','All Student')
@section('links')
    <link rel="stylesheet" href="{{url('adminAssests/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="adminAssests/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{url('adminAssests/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@endsection
@section('content')
    <section class="content">
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3">
                    <h1>Students</h1>
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
                    <li class="breadcrumb-item active">All Students</li>
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
                    <th>Student Id </th>
                    <th>Student Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Create at</th>
                    <th>Active</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                    @isset($students)
                        @foreach ($students as $st)
                            <tr>
                                <td>{{$st->student_id}}</td>
                                <td>{{$st->student_name}}</td>
                                <td>{{$st->student_email}}</td>
                                <td>{{$st->student_phone}}</td>
                                <td>{{$st->st_created_at}}</td>
                                <td class="text-center">
                                    <a href="studentSt/{{ $st->student_id.'/'.$st->verification }}" id="don{{$loop->index}}">
                                        <div class="icheck-success d-inline">
                                            <input type="checkbox" {{$st->verification == 0 ? '' : 'checked'}} id="checkboxSuccess{{ $loop->index }}">
                                            <label for="checkboxSuccess{{$loop->index}}">
                                            </label>
                                          </div>
                                    </a>
                                    <script>
                                        document.getElementById("checkboxSuccess{{ $loop->index }}").addEventListener("click", function(){
                                            document.getElementById("don{{$loop->index}}").click();
                                            });
                                    </script>
                                </td>
                                <td class="text-center">
                                    <a href="{{url('/admin/student/'.$st->student_id)}}" class="btn btn-outline-warning rounded"><i class="fas fa-edit"></i></a>
                                </td>
                                <td class="text-center">
                                    <form action="{{url('/admin/student/'.$st->student_id)}}" method="post" style="display: inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger rounded"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endisset

                    @empty($students)
                        No Student
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
    <script src="{{url('adminAssests/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
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
      <script>
           $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });
      </script>
@endsection
