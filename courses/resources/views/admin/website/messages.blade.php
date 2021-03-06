@extends('admin.layouts.nav')
@section('title','Messages')
@section('links')
    <link rel="stylesheet" href="{{url('adminAssests/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="adminAssests/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <script src="{{url("adminAssests/plugins/jquery/jquery.min.js")}}"></script>

@endsection
@section('content')
    
    <section class="content">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3">
                <h1>All Messages</h1>
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
                    <li class="breadcrumb-item active">All Messages</li>
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
                    <th>Message Id </th>
                    <th>Student </th>
                    <th>Student Mail </th>
                    <th>Message Type (EN)</th>
                    <th>Message Date</th>
                    <th>Reply</th>
                    <th>Delete</th>

                  </tr>
                  </thead>
                  <tbody>
                   
                   @foreach ($allMessages as $message)
                        <tr class="{{$message->read_message == 0 ? 'bg-light' : ''}}">
                            <td>{{$message->message_id}}</td>
                            <td><a href="{{url('admin/student/'.$message->student_id)}}">{{$message->student_name}}</a></td>
                            <td>{{$message->student_email}}</td>
                            <td>{{$message->message_title}}</td>
                            <td>{{$message->sent_at}}</td>
                            {{-- //ssss  --}}
                            <td class="text-center">
                                <a data-toggle="modal" data-target="#smallmodal{{$message->message_id}}" href="#"  id = "clk{{$message->message_id}}" send{{$message->message_id}} = {{$message->message_id}}  class="btn rounded  btn-outline-primary rounded"><i class="fas fa-reply"></i></a>

                            </td>

                            <td class="text-center">
                                <form action="{{url('admin/delete-message/'.$message->message_id)}}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn rounded  btn-outline-danger rounded" type="submit" > <i class="fas fa-trash"></i> </button>
                                </form>
                            </td>
                        </tr>
                        {{ Session::put('MessageCount',$loop->iteration) }}
                        <div class="modal fade" id="smallmodal{{$message->message_id}}" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-info" id="smallmodalLabel"> Client Message </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                       
                                            
                                                
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h6> Message ID : <b>{{$message->message_id}}</b> </h6>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="text" class="form-control"  value="{{$message->message_title}}" readonly>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="text" class="form-control" value="{{$message->message_title_ar}}" readonly>
                                                    </div>
                                                    <div class="col-12">
                                                        <textarea class="form-control" cols="65" rows="5" style="resize: none" readonly> {{$message->message}} </textarea>

                                                    </div>
                                                   
                                                </div>
                                               
                                                
                                    </div>
                                    <div class="modal-footer">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5>Reply: </h5>
                                                <form action="{{url('admin/reply-message/'.$message->message_id)}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="message_id" value="{{$message->message_id}}" >
                                                    <input type="hidden" name="student_email" value="{{$message->student_email}}" >
                                                    <textarea name="message_reply" id=""  class="form-control textarea" style="resize: none" cols="30" rows="10" placeholder="Please Type your reply here.."></textarea>
                                                    @if ($errors->has('message_reply'))
                                                        <p class='text-danger'>{{$errors->first('message_reply')}}</p>
                                                    @endif
                                                    <button type="submit" class="btn btn-info rounded">Send</button>
                                                    <button type="button" class="btn btn-secondary rounded" data-dismiss="modal">Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                        
                                    </div>

                                </div>
                            </div>
                        </div>
                        <script>
                            $("#clk{{$message->message_id}}").click(function(){
                                var getAtrrKey = $("#clk{{$message->message_id}}").attr("send{{$message->message_id}}");
                                var ModalID = '#smallmodal' + getAtrrKey;
                                // alert(ModalID);
                                localStorage.setItem("ModalKey", ModalID);
                            });
                        </script>

                    @endforeach
                    @if (count($errors) > 0)
                        <script>

                            $(document).ready(function(){
                                $(localStorage.getItem("ModalKey")).modal('show');
                            });

                        </script>
                    @endif
                        <script>
                            $(document).ready(function(){
                                $('#smallmodal{{$openModal}}').modal('show');
                            });
                        </script>
                  
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