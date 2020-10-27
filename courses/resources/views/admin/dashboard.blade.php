@extends('admin.layouts.nav')
@section('links')
    <link rel="stylesheet" href="{{url('adminAssests/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{url('adminAssests/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{url('adminAssests/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{url('adminAssests/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('adminAssests/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{url('adminAssests/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{url('adminAssests/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{url('adminAssests/plugins/summernote/summernote-bs4.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

@endsection
@section('title','Dashboard')

@section('content')
{{-- <form action="{{url('/change-lang')}}" method="post">
    @csrf

        <select name="language" id="">
            <option value="ar">Arabic</option>
            <option value="en">English</option>
        </select>
        <input type="submit" value="choose">
    </form> --}}

        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard v1</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                    <h3>{{ $noOfCourses }}</h3>

                    <p>No. Courses</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-align-justify"></i>
                    </div>
                    <a href="{{ url('admin/course') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                    <h3>{{ $noOfInstitute }}</h3>

                    <p>No. Institute</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon   fas fa-university"></i>
                    </div>
                    <a href="{{ url('admin/institute') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                    <h3>{{ $noOfOnlineCourse }}</h3>

                    <p>No. Online Course</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-list-alt"></i>
                    </div>
                    <a href="{{ url('admin/courseOnline') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                    <h3>{{ $noOfStudent }}</h3>

                    <p>No. Student</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-users"></i>
                    </div>
                    <a href="{{ url('admin/student') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <!-- ./col -->
            </div>
            <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">
                      <h5 class="card-title">Monthly Recap Report</h5>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="row">

                        <!-- /.col -->
                        <div class="col-md-6">

                          <p class="text-center">
                            <strong>Reservation</strong>
                          </p>
                            <!-- /.progress-group -->
                            <div class="progress-group">
                                Pending Reservation
                                <span class="float-right"><b>{{ $noOfPending }}</b>/{{ $noOfAllReservation }}</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-warning" style="width: {{ ($noOfPending/$noOfAllReservation)*100 }}%"></div>
                                </div>
                            </div>
                            <!-- /.progress-group -->
                          <div class="progress-group">
                            Confiremed Reservation
                            <span class="float-right"><b>{{ $noOfConfirmed }}</b>/{{ $noOfAllReservation }}</span>
                            <div class="progress progress-sm">
                              <div class="progress-bar bg-primary" style="width: {{ ($noOfConfirmed/$noOfAllReservation)*100 }}%"></div>
                            </div>
                          </div>
                          <!-- /.progress-group -->

                          <div class="progress-group">
                            Cancel Reservation
                            <span class="float-right"><b>{{ $noOfCancel }}</b>/{{ $noOfAllReservation }}</span>
                            <div class="progress progress-sm">
                              <div class="progress-bar bg-danger" style="width: {{ ($noOfCancel/$noOfAllReservation)*100 }}%"></div>
                            </div>
                          </div>

                          <!-- /.progress-group -->
                          <div class="progress-group">
                            <span class="progress-text">Compeleted Reservation</span>
                            <span class="float-right"><b>{{ $noOfcompelete }}</b>/{{ $noOfAllReservation }}</span>
                            <div class="progress progress-sm">
                              <div class="progress-bar bg-success" style="width: {{ ($noOfcompelete/$noOfAllReservation)*100 }}%"></div>
                            </div>
                          </div>


                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <!-- Info Boxes Style 2 -->
                                <div class="info-box mb-3 bg-warning">
                                  <span class="info-box-icon"><i class="far fa-envelope"></i></span>
                                  <a href="{{url('admin/messages')}}">
                                  <div class="info-box-content">
                                    <span class="info-box-text">Pending Message</span>
                                    <span class="info-box-number">{{ $pendingMsg }} Messages</span>
                                  </div>
                                </a>
                                  <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                                <div class="info-box mb-3 bg-success">
                                  
                                  <span class="info-box-icon"><i class="far fa-envelope-open"></i></span>
                                  <a href="{{url('admin/sent-messages')}}">
                                  <div class="info-box-content">
                                    <span class="info-box-text">Reply Message</span>
                                    <span class="info-box-number">{{ $replyedMsg }} Messages</span>
                                  </div>
                                  </a>
                                  <!-- /.info-box-content -->
                                </div>

                              </div>
                            <!-- /.chart-responsive -->
                          </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
                    <div class="card-footer">
                      <div class="row">
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                              <span class="description-percentage text-warning"><i class="fas {{round(($noOfPending/$noOfAllReservation)*100) > 50 ? 'fa-caret-up' : 'fa-caret-down' }} "></i> {{ round(($noOfPending/$noOfAllReservation)*100) }}%</span>
                              <a href="{{url('/admin/reservation')}}"><h5 class="description-header">Pending Reservation</h5></a>
                              {{-- <span class="description-text">Pending Reservation</span> --}}
                            </div>
                            <!-- /.description-block -->
                          </div>
                        <div class="col-sm-3 col-6">
                          <div class="description-block border-right">
                            <span class="description-percentage text-primary"><i class="fas {{round(($noOfConfirmed/$noOfAllReservation)*100) > 50 ? 'fa-caret-up' : 'fa-caret-down' }}"></i> {{ round(($noOfConfirmed/$noOfAllReservation)*100) }}%</span>
                            <a href="{{url('/admin/confirmReservation')}}"><h5 class="description-header">Confiremed Reservation</h5></a>
                            {{-- <span class="description-text">TOTAL REVENUE</span> --}}
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->

                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                          <div class="description-block border-right">
                            <span class="description-percentage text-danger"><i class="fas {{round(($noOfCancel/$noOfAllReservation)*100) > 50 ? 'fa-caret-up' : 'fa-caret-down' }}"></i> {{ round(($noOfCancel/$noOfAllReservation)*100) }}%</span>
                            <a href="{{url('/admin/cancelReservation')}}"><h5 class="description-header">Cancel Reservation</h5></a>
                            {{-- <span class="description-text">TOTAL PROFIT</span> --}}
                          </div>
                          <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                          <div class="description-block">
                            <span class="description-percentage text-success"><i class="fas {{round(($noOfcompelete/$noOfAllReservation)*100) > 50 ? 'fa-caret-up' : 'fa-caret-down' }}"></i> {{ round(($noOfcompelete/$noOfAllReservation)*100) }}%</span>
                            <a href="{{url('/admin/reservation?prev=yes')}}"><h5 class="description-header">Compeleted Reservation</h5></a>
                            {{-- <span class="description-text">GOAL COMPLETIONS</span> --}}
                          </div>
                          <!-- /.description-block -->
                        </div>
                      </div>
                      <!-- /.row -->
                    </div>
                    <!-- /.card-footer -->
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->
              </div>

              
            </div>
        </section>

@endsection
@section('scripts')

@endsection
