<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> @yield('title') </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome --> 
  <link rel="stylesheet" href="{{url('adminAssests/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="  {{url('adminAssests/plugins//tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{url('adminAssests/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{url("adminAssests/plugins/jqvmap/jqvmap.min.css")}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('adminAssests/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url("adminAssests/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{url("adminAssests/plugins/daterangepicker/daterangepicker.css")}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{url("adminAssests/plugins/summernote/summernote-bs4.css")}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  @yield('links')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{url('admin')}}" class="nav-link">Home</a> 
            {{-- <p>{{URL::current('/admin')}}</p> --}}
        </li>
        <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
        </ul>

        <!-- SEARCH FORM -->

        {{-- <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
            </button>
            </div>
        </div>
        </form> --}}

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
           
                @if(\App\Http\Controllers\controller::getUnReadMessages()->msgCount != 0)
                <span class="badge badge-danger navbar-badge">
                {{\App\Http\Controllers\controller::getUnReadMessages()->msgCount}}
                </span>
                @endif
            
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class="dropdown-divider"></div>
            @if(\App\Http\Controllers\controller::getUnReadMessages()->msgCount != 0)
                @foreach (\App\Http\Controllers\controller::getUnReadMessages()->messages as $msg)
                <a href="{{url('admin/messages/'.$msg->message_id)}}" class="dropdown-item {{$msg->read_message == 0 ? 'bg-light' : ''}}">
                
                    <!-- Message Start -->
                    <div class="media">
                    <img src="{{ url('storage/images/passports/'.$msg->passport_photo) }}" alt="user" class="img-size-50 img-circle mr-3">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                        {{$msg->student_name}}
                        {{-- <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span> --}}
                        </h3>
                        <p class="text-sm">{{$msg->message_title}}</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{\Illuminate\Support\Carbon::parse($msg->sent_at)->diffForHumans()}} </p>
                    </div>
                    </div>
                    <!-- Message End -->
                

                </a>
                @endforeach
                <div class="dropdown-divider"></div>
                <div class="row">
                    <div class="col-6">
                        <a href="{{url('admin/messages')}}" class="dropdown-item dropdown-footer" > See All Messages </a>
                    </div>
                    <div class="col-6">
                    <form action="{{url('admin/markAllAsRead')}}" method="post">
                        @csrf
                                <input class="dropdown-item dropdown-footer" type="submit" value="Mark All As Read">
                        </div>
                    </form>
                </div>
                
            @else
                <div class="dropdown-divider"></div>
                <p class="dropdown-item dropdown-footer"> No Recent Messages </p>
            @endif
           
           
            {{-- <a href="#" ></a> --}}
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                @if(\App\Http\Controllers\controller::getAdminNoti()->reservationCount != 0)
                <span class="badge badge-danger navbar-badge">{{\App\Http\Controllers\controller::getAdminNoti()->reservationCount}}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            {{-- <span class="dropdown-item dropdown-header">15 Notifications</span> --}}
            {{-- <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i> 4 new messages
                <span class="float-right text-muted text-sm">3 mins</span>
            </a> 
            <div class="dropdown-divider"></div>--}}
            @if(\App\Http\Controllers\controller::getAdminNoti()->reservationCount != 0)
            @foreach (\App\Http\Controllers\controller::getAdminNoti()->reservations as $noti)
                <a href="{{url('admin/reservation/'.$noti->reservation_id.'/1')}}" class="dropdown-item {{$noti->read_at == 0 ? 'bg-light' : ''}}">
                    <i class="fas fa-users mr-2"></i> New Booking
                    <span class="float-right text-muted text-sm"> {{\Illuminate\Support\Carbon::parse($noti->reserved_at)->diffForHumans()}} </span>
                </a>
            @endforeach
                
           
            {{-- <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> 3 new reports
                <span class="float-right text-muted text-sm">2 days</span>
            </a> --}}
            <div class="dropdown-divider"></div>
                <div class="row">
                    <div class="col-6">
                        <a href="{{url('admin/reservation')}}" class="dropdown-item dropdown-footer" > See All Notifications </a>
                    </div>
                    <div class="col-6">
                    <form action="{{url('admin/markAllAsReadNoti')}}" method="post">
                        @csrf
                                <input class="dropdown-item dropdown-footer" type="submit" value="Mark All As Read">
                        </div>
                    </form>
                </div>
            @else 
            <div class="dropdown-divider"></div>
                <p class="dropdown-item dropdown-footer"> No Recent Notifications </p>
            @endif
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
            </a>
        </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{url('admin')}}" class="brand-link text-center">
            {{-- .\App\Http\Controllers\controller::socialMedia()->info->logo --}}
        <img src="{{asset('storage/images/logo/kas5.png')}}" alt="AdminLTE Logo" width="150px" height="90px">
        <span class="brand-text font-weight-light"></span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <div class="img-circle elevation-2">
                    <i class="far fa-user p-2 img-circle  bg-light" style="font-size: 20px"></i>
                    {{-- <i class="fas fa-user"></i> --}}
                </div>
            {{-- <img src="{{url("adminAssests/dist/img/user2-160x160.jpg")}}" class="img-circle elevation-2" alt="User Image"> --}}
            </div>
            <div class="info">
            <a href="{{ url('admin/get-profile') }}" class="d-block" style="text-transform: capitalize">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-header">Main Services</li>
                {{-- <li class="nav-item">
                    <a href="pages/calendar.html" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>
                        Calendar
                        <span class="badge badge-info right">2</span>
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link">
                    <i class="nav-icon far fa-image"></i>
                    <p>
                        Gallery
                    </p>
                    </a>
                </li> --}}
                <li class="nav-item has-treeview  {{Request::is('admin/course') || Request::is('admin/course/create') || Request::is('admin/course/*') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-align-justify"></i>
                    <p>
                        Courses
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="{{url('/admin/course')}}" class="nav-link">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>All Courses</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/admin/course/create')}}" class="nav-link">
                            <i class="nav-icon far fa-plus-square"></i>
                            <p>Add Course</p>
                        </a>
                    </li>
                   
                    </ul>
                </li>

                <li class="nav-item has-treeview {{Request::is('admin/course-types') || Request::is('admin/course-types/create') || Request::is('admin/course-types/*')  ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-list-alt"></i>
                    <p>
                        Course Types
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="{{url('/admin/course-types')}}" class="nav-link">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>All Course Types</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('admin/course-types/create')}}" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>Add Course Type</p>
                        </a>
                    </li>
                   
                    </ul>
                </li>

                <li class="nav-item has-treeview {{Request::is('admin/institute') || Request::is('admin/institute/create') || Request::is('admin/institute/*')  ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon   fas fa-university"></i>
                        <p>
                        Institutes
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{url('/admin/institute')}}" class="nav-link">
                            <i class="nav-icon fas fa-hotel"></i>
                            <p>All Institutes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/admin/institute/create')}}" class="nav-link">
                            <i class="nav-icon fab fa-houzz"></i>
                            <p>Add Institute</p>
                        </a>
                    </li>
                    
                    
                    </ul>
                </li>

                <li class="nav-item has-treeview {{Request::is('admin/student') || Request::is('admin/student/create') || Request::is('admin/student/*') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                     <p>
                         Students
                         <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{url('/admin/student')}}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>All Students</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/admin/student/create')}}" class="nav-link">
                        <i class=" nav-icon fas fa-user-plus"></i>
                        <p>Add Student</p>
                        </a>
                    </li>
                    
                    
                    </ul>
                </li>

                <li class="nav-item has-treeview {{Request::is('admin/courseOnline') || Request::is('admin/courseOnline/create') || Request::is('admin/courseOnline/*') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>Online Course
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/courseOnline')}}" class="nav-link">
                                <i class="nav-icon far fa-list-alt"></i>
                                <p>All Online Courses</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/courseOnline/create')}}" class="nav-link">
                                <i class="nav-icon far fa-plus-square"></i>
                                <p>Add Online Course</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item has-treeview {{Request::is('admin/reservation') || Request::is('admin/confirmReservation') || Request::is('admin/cancelReservation') || Request::is('admin/reservation/create') || Request::is('admin/add-reservation/*') || Request::is('admin/reservation/*') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user-shield"></i>
                    <p>Reservation
                        @if(\App\Http\Controllers\controller::getAdminNoti()->reservationCount != 0)
                            <span class=" badge badge-danger">New</span>
                        @endif
                        <i class="fas fa-angle-left right" style="right: 1.2rem !important"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/reservation')}}" class="nav-link">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>All Reservations</p>
                            

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/confirmReservation')}}" class="nav-link">
                            <i class=" nav-icon fas fa-check"></i>
                            <p>Confirmed Reservations</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/cancelReservation')}}" class="nav-link">
                                <i class="nav-icon fas fa-times"></i>
                                <p>Canceled Reservations</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/reservation/create')}}" class="nav-link">
                                <i class="nav-icon far fa-plus-square"></i>
                            <p>Add Reservation</p>
                            </a>
                        </li>
                 
                    </ul>
                </li>

                <li class="nav-item has-treeview {{Request::is('admin/location') || Request::is('admin/location/create') || Request::is('admin/country')  || Request::is('admin/showCity/*') || Request::is('admin/location/*') ? 'menu-open' : ''}} ">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-globe-asia"></i>
                    <p>Location
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/location')}}" class="nav-link">
                                <i class="nav-icon fas fa-globe-asia"></i>
                                <p>All Locations</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/location/create')}}" class="nav-link">
                                <i class="nav-icon fas fa-city"></i>
                                <p>Add City</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/country')}}" class="nav-link">
                            <i class="  nav-icon fab fa-fort-awesome-alt"></i>
                            <p>Add Country</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{Request::is('admin/gallery') || Request::is('admin/gallery/create') || Request::is('admin/allVideos')  || Request::is('admin/galleryVedio') || Request::is('admin/gallery/*') || Request::is('admin/editVideo/*') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fab fa-envira"></i>
                        <p>Gallery
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/gallery')}}" class="nav-link">
                            <i class="nav-icon fas fa-file-image"></i>
                            <p>All Photos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/gallery/create')}}" class="nav-link">
                            <i class="nav-icon far fa-file-image"></i>
                            <p>Add Photo</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{url('admin/allVideos')}}" class="nav-link">
                                <i class="nav-icon fas fa-file-video"></i>
                                <p>All Videos</p>
                            </a>
                        </li>
                       
                        <li class="nav-item">
                            <a href="{{url('admin/galleryVedio')}}" class="nav-link">
                            <i class="nav-icon far fa-file-video"></i>
                            <p>Add Video</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item has-treeview {{Request::is('admin/partners') || Request::is('admin/partners/create') || Request::is('admin/partners/*') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user-friends"></i>
                    <p> Partners
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/partners')}}" class="nav-link">
                                <i class="nav-icon fas fa-user-friends"></i>
                                <p>All Partners</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/partners/create')}}" class="nav-link">
                                <i class="nav-icon far fa-plus-square"></i>
                            <p>Add Partner</p>
                            </a>
                        </li>
                
                    </ul>
                </li>

                <li class="nav-item has-treeview {{Request::is('admin/bankAccount') || Request::is('admin/bankAccount/create') || Request::is('admin/bankAccount/*') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-money-check-alt" ></i>
                    <p>Bank Account
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/bankAccount')}}" class="nav-link">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>All Account</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/bankAccount/create')}}" class="nav-link">
                                <i class="nav-icon far fa-plus-square"></i>
                            <p>Add Account</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{Request::is('admin/slider') || Request::is('admin/slider/create') || Request::is('admin/slider/*') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-sync"></i>
                        <p> Sliders
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/slider')}}" class="nav-link">
                                <i class="nav-icon  fas fa-sliders-h"></i>
                                <p>All Sliders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/slider/create')}}" class="nav-link">
                                <i class="nav-icon far fa-plus-square"></i>
                            <p>Add Slider</p>
                            </a>
                        </li>
                
                    </ul>
                </li>


                <li class="nav-item has-treeview {{Request::is('admin/terms-conditions') || Request::is('admin/terms-conditions/create') || Request::is('admin/terms-conditions/*') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p> Terms And Conditions
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/terms-conditions')}}" class="nav-link">
                                <i class="nav-icon far fa-list-alt"></i>
                                <p>All Terms And Conditions </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/terms-conditions/create')}}" class="nav-link">
                                <i class="nav-icon far fa-plus-square"></i>
                            <p>Add Term And condition </p>
                            </a>
                        </li>
                
                    </ul>
                </li>

                <li class="nav-item has-treeview {{Request::is('admin/advertisement') || Request::is('admin/website-information') || Request::is('admin/pages') || Request::is('admin/social') || Request::is('admin/password-reset') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-align-justify"></i>
                    <p>Website
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/advertisement')}}" class="nav-link">
                                <i class=" nav-icon fas fa-mobile-alt"></i>
                                <p>Application Advertisement</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/website-information')}}" class="nav-link">
                                <i class="nav-icon fas fa-info"></i>
                            <p>Website Information</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{url('admin/pages')}}" class="nav-link">
                                <i class="nav-icon fas fa-clone"></i>     
                                <p>Static Pages</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{url('admin/social')}}" class="nav-link">
                            <i class=" nav-icon fas fa-hashtag"></i>
                            <p>Social Media</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{url('admin/password-reset')}}" class="nav-link">
                            <i class="nav-icon fas fa-key"></i>
                            <p>Password Resets</p>
                            </a>
                        </li>
                 
                    </ul>
                </li>

            
                <li class="nav-item has-treeview {{Request::is('admin/messages') || Request::is('admin/sent-messages') ? 'menu-open' : ''}}" style="margin-bottom: 40px;">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p> Messages
                        @if(\App\Http\Controllers\controller::getUnReadMessages()->msgCount != 0)
                            <span class=" badge badge-danger">New</span>
                        @endif
                        <i class="fas fa-angle-left right" style="right: 1.2rem !important"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/messages')}}" class="nav-link">
                                <i class="nav-icon far fa-envelope"></i>

                                <p>Pending Messages </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/sent-messages')}}" class="nav-link">
                            <i class="nav-icon far fa-envelope-open"></i>
                            <p>Sent Messages </p>
                            </a>
                        </li>

                        {{-- <li class="nav-item">
                            <a href="{{url('admin/send-message')}}" class="nav-link">
                                <i class="nav-icon fas fa-envelope-open-text"></i>
                                <p>Send New Message </p>
                            </a>
                        </li> --}}
                
                    </ul>
                </li>


                {{-- <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p> Admins
                        <i class="fas fa-angle-left right" ></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/get-admins')}}" class="nav-link">
                                <i class="nav-icon far fa-envelope"></i>

                                <p>All Admins </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/get-register')}}" class="nav-link">
                                <i class="nav-icon far fa-plus-square"></i>
                                <p>Add Admin </p>
                            </a>
                        </li>

                     
                
                    </ul>
                </li> --}}

                
                    
                    
                    </ul>
                </li>
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <section class="content-wrapper">
        @yield('content')
    </section>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2020 <a href="#">URIALLAB</a>.</strong>
        {{-- http://adminlte.io --}}
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
        {{-- <b>Version</b> 3.0.4 --}}
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{url("adminAssests/plugins/jquery/jquery.min.js")}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url("adminAssests/plugins/jquery-ui/jquery-ui.min.js")}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{url("adminAssests/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- ChartJS -->
<script src="{{url("adminAssests/plugins/chart.js/Chart.min.js")}}"></script>
<!-- Sparkline -->
<script src="{{url("adminAssests/plugins/sparklines/sparkline.js")}}"></script>
<!-- JQVMap -->
<script src="{{url("adminAssests/plugins/jqvmap/jquery.vmap.min.js")}}"></script>
<script src="{{url("adminAssests/plugins/jqvmap/maps/jquery.vmap.usa.js")}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{url("adminAssests/plugins/jquery-knob/jquery.knob.min.js")}}"></script>
<!-- daterangepicker -->
<script src="{{url("adminAssests/plugins/moment/moment.min.js")}}"></script>
<script src="{{url("adminAssests/plugins/daterangepicker/daterangepicker.js")}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url("adminAssests/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js")}}"></script>
<!-- Summernote -->
<script src="{{url("adminAssests/plugins/summernote/summernote-bs4.min.js")}}"></script>
<!-- overlayScrollbars -->
<script src="{{url("adminAssests/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{url("adminAssests/dist/js/adminlte.js")}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{url("adminAssests/dist/js/pages/dashboard.js")}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url("adminAssests/dist/js/demo.js")}}"></script>
@yield('scripts')
</body>
</html>
