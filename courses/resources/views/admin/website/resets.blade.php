@extends('admin.layouts.nav')
@section('title','Password Resets')
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
                <h1>Password Resets</h1>
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
                    <li class="breadcrumb-item active">All Password Resets</li>
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
                <table id="example2" class="table table-bordered table-hover text-center">
                  <thead>
                  <tr>
                    <th>Reset Id </th>
                    <th>Student Id</th>
                    <th>Student Phone </th>
                    <th>Reset Date </th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                   @foreach ($allResets as $reset)
                        <tr>
                            <td>{{$reset->reset_id}}</td>
                            <td>
                                <a href="{{url('student/'.$reset->student_id)}}">
                                    {{$reset->student_id}}
                                </a>
                                
                            </td>
                            <td>{{$reset->student_phone}}</td>
                            <td>{{$reset->reset_at}}</td>

                            <td class="text-center">
                                <form action="{{url('admin/password-reset/'.$reset->reset_id)}}" method="post" style="display: inline">

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