<!DOCTYPE html>

<html direction="rtl" dir="rtl" style="direction: rtl">

<!-- begin::Head -->
<head>
    <base href="">
    <meta charset="utf-8" />
    <title>Mashroby | Dashboard</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Asap+Condensed:500">--}}
{{--    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>--}}
{{--    <script>--}}
{{--        WebFont.load({--}}
{{--            google: {--}}
{{--                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]--}}
{{--            },--}}
{{--            active: function() {--}}
{{--                sessionStorage.fonts = true;--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}

{{--    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7CPrata" rel="stylesheet">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">--}}
    <!--end::Fonts -->
    <style>
        @import url('https://fonts.googleapis.com/css?family=Cairo');
        *{
            font-family: 'Cairo', sans-serif ;
        }
    </style>
    <!--begin::Page Vendors Styles(used by this page) -->

    <!--end::Page Vendors Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->

    <!--begin:: Vendor Plugins -->
    <link href="{{asset("dashboard_assets/plugins/general/perfect-scrollbar/css/perfect-scrollbar.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/tether/dist/css/tether.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/bootstrap-timepicker/css/bootstrap-timepicker.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/bootstrap-daterangepicker/daterangepicker.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/bootstrap-select/dist/css/bootstrap-select.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/select2/dist/css/select2.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/ion-rangeslider/css/ion.rangeSlider.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/nouislider/distribute/nouislider.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/owl.carousel/dist/assets/owl.carousel.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/owl.carousel/dist/assets/owl.theme.default.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/dropzone/dist/dropzone.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/quill/dist/quill.snow.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/@yaireo/tagify/dist/tagify.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/summernote/dist/summernote.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/bootstrap-markdown/css/bootstrap-markdown.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/animate.css/animate.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/toastr/build/toastr.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/dual-listbox/dist/dual-listbox.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/morris.js/morris.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/sweetalert2/dist/sweetalert2.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/socicon/css/socicon.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/plugins/line-awesome/css/line-awesome.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/plugins/flaticon/flaticon.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/plugins/flaticon2/flaticon.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/general/@fortawesome/fontawesome-free/css/all.min.css")}}" rel="stylesheet" type="text/css" />

    <!--end:: Vendor Plugins -->
    <link href="{{asset("dashboard_assets/css/datatables.bundle.rtl.css")}}" rel="stylesheet" type="text/css" />


    <!--begin:: Vendor Plugins for custom pages -->
    <link href="{{asset("dashboard_assets/plugins/custom/plugins/jquery-ui/jquery-ui.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/custom/@fullcalendar/core/main.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/custom/@fullcalendar/daygrid/main.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/custom/@fullcalendar/list/main.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/custom/@fullcalendar/timegrid/main.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/custom/datatables.net-bs4/css/dataTables.bootstrap4.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/custom/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/custom/datatables.net-autofill-bs4/css/autoFill.bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/custom/datatables.net-colreorder-bs4/css/colReorder.bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/custom/datatables.net-fixedcolumns-bs4/css/fixedColumns.bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/custom/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/custom/datatables.net-keytable-bs4/css/keyTable.bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/custom/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/custom/datatables.net-rowgroup-bs4/css/rowGroup.bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/custom/datatables.net-rowreorder-bs4/css/rowReorder.bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/custom/datatables.net-scroller-bs4/css/scroller.bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/custom/datatables.net-select-bs4/css/select.bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/custom/jstree/dist/themes/default/style.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/custom/jqvmap/dist/jqvmap.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/plugins/custom/uppy/dist/uppy.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/css/style.bundle.rtl.css")}}" rel="stylesheet" type="text/css" />

    <!--end:: Vendor Plugins for custom pages -->

    <!--start:: custom datatable style -->
{{--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">--}}
{{--    <link rel="stylesheet" href="{{asset('dashboard_assets/css/dataTableStyle.css')}}">--}}
    <!--end::  custom datatable style -->

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
@yield('css')
    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{asset("dashboard_assets/favlogo.jpg")}}" />
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-page-content-white kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->

<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    <div class="kt-header-mobile__logo">
        <a href="{{route('dashboard.home')}}">
            <img alt="Logo" width="70" height="70" src="{{asset("dashboard_assets/logo.jpg")}}" />
        </a>
    </div>
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
    </div>
</div>

<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            <!-- begin:: Header -->
            <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " data-ktheader-minimize="on">
                <div class="kt-container  kt-container--fluid ">

                    <!-- begin:: Brand -->
                    <div class="kt-header__brand " id="kt_header_brand">
                        <div class="kt-header__brand-logo">
                            <a href="{{url('dashboard')}}">
                                <img alt="Logo" width="50" src="{{asset("dashboard_assets/logo.jpg")}}" />
                            </a>
                        </div>
                    </div>
                    <!-- end:: Brand -->
                    <div class="kt-header__topbar">

                        <!--begin: Profile Details -->
                        <div class="kt-header__topbar-item dropdown">
                            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                            <span class="kt-header__topbar-icon" style="color: white;" >
                                {{auth()->guard('admin')->user()->username}}
                            </span>
                            </div>
                            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                                <span class="kt-header__topbar-icon"><i class="flaticon2-gear"></i></span>
                            </div>
                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                                <div class="kt-notification">
                                    <div class="kt-notification__custom kt-space-between">
                                        <a href="{{route('dashboard.changePassword.get')}}"  class="btn btn-clean btn-sm btn-bold">تعديل كلمة المرور</a>
                                        <a href="{{route('dashboard.logout')}}" class="btn btn-label btn-label-brand btn-sm btn-bold">تسجيل الخروج</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--end: Profile Details -->
                    </div>
                </div>
            </div>
