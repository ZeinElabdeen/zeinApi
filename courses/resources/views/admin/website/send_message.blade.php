@extends('admin.layouts.nav')
@section('title','Messages')
@section('links')
    <link rel="stylesheet" href="{{url('adminAssests/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="adminAssests/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <script src="{{url("adminAssests/plugins/jquery/jquery.min.js")}}"></script>

@endsection
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-3">
            <h1>Compose</h1>
          </div>
          <div class="col-6">
            <div class=" text-center">
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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Compose</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    
    
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">
              <a href="mailbox.html" class="btn btn-primary btn-block mb-3">Back to Inbox</a>
  
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Folders</h3>
  
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body p-0">
                  <ul class="nav nav-pills flex-column">
                    <li class="nav-item active">
                      <a href="#" class="nav-link">
                        <i class="fas fa-inbox"></i> Inbox
                        <span class="badge bg-primary float-right">12</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="far fa-envelope"></i> Sent
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="far fa-file-alt"></i> Drafts
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="fas fa-filter"></i> Junk
                        <span class="badge bg-warning float-right">65</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="far fa-trash-alt"></i> Trash
                      </a>
                    </li>
                  </ul>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Labels</h3>
  
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                      <a class="nav-link" href="#"><i class="far fa-circle text-danger"></i> Important</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#"><i class="far fa-circle text-warning"></i> Promotions</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#"><i class="far fa-circle text-primary"></i> Social</a>
                    </li>
                  </ul>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <form action="{{url('admin/send-message')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                          <h3 class="card-title">Compose New Message</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <div class="form-group">
                            <input class="form-control" placeholder="To:" name="student_email">
                          </div>
                          <div class="form-group">
                            <input class="form-control" placeholder="Subject:" name="subject">
                          </div>
                          <div class="form-group">
                              <textarea id="compose-textarea" class="form-control" style="height: 300px" name="message_reply"></textarea>
                          </div>

                            <div class="form-group">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" id="autoSizingCheck2" value="1" name="includeLogo">
                                      <label class="form-check-label" for="autoSizingCheck2">
                                        Include Logo
                                      </label>
                                    </div>
                            </div>
                          <div class="form-group">
                            <div class="btn btn-default btn-file">
                              <i class="fas fa-paperclip"></i> Attachment
                              <input type="file" name="attachment">
                            </div>
                            <p class="help-block">Max. 32MB</p>
                          </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                          <div class="float-right">
                            <button type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Draft</button>
                            <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                          </div>
                          <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
                        </div>
                        <!-- /.card-footer -->
                      </div>

                </form>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

      
      

@endsection
@section('scripts')
    <script src="{{url('adminAssests/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('adminAssests/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('adminAssests/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('adminAssests/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="../../plugins/summernote/summernote-bs4.min.js"></script>

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

<!-- Page Script -->
<script>
  $(function () {
    //Add text editor
    $('#compose-textarea').summernote({
        placeholder: 'Type your message here...',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link']], //, 'picture', 'video'
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      })
  })
</script>
@endsection