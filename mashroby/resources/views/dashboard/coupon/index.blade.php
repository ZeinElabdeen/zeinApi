@extends('dashboard.layout.master')

@section('content')
    @include('dashboard.layout._error')
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <a href="{{route('dashboard.home')}}">
                    <h3 class="kt-subheader__title">
                        لوحة التحكم </h3>
                </a>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a  class="kt-subheader__breadcrumbs-link">
                      قائمة الكوبونات </a>

                </div>
            </div>

        </div>
    </div>

    <!-- end:: Subheader -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <br>
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
												<span class="kt-portlet__head-icon">
													<i class="kt-font-brand flaticon2-line-chart"></i>
												</span>
                    <h3 class="kt-portlet__head-title">
                       قائمة الكوبونات
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">

                            <a href="{{url('dashboard/coupon/create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                            إضافة كوبون
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                @if(count($data) > 0)
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                    <tr>
                        <th>الكود  </th>
                        <th>نسبة الخصم  </th>

                        <th>الحالة  </th>
                        <th nowrap></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $index => $item)
                        <tr>
                          <td>{{$item->code}}</td>
                          <td>{{$item->discount}}%</td>

                          <td>
                              @if( $item->status == '1')
                              <a  href="{{url('dashboard/coupon/suspend/'.$item->id)}}"  class="badge badge-success status-btn" style="width:80px;height: 25px;padding:auto;margin:auto;
                                padding-top: 7px; font-size: small">غير مستخدم</a>
                              @else
                              <a  href="{{url('dashboard/coupon/activate/'.$item->id)}}"  class="badge badge-danger status-btn" style="width:80px;height: 25px;padding:auto;margin:auto;
                                padding-top: 7px; font-size: small">مستخدم</a>

                              @endif

                          </td>
                            <td>

                                <a onclick = "if (! confirm('هل انت متاكد من الحذف?')) { return false; }" href="{{url('dashboard/coupon/delete/'.$item->id)}}" >
                                    <i class="text-danger la la-trash-o la-lg" ></i>
                                </a>

                                <a class="btn  btn-xs" href="{{url('dashboard/coupon/edit/'.$item->id)}}" style="padding:0px"><i class="text-primary fa fa-edit la-lg"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                    <p class="alert alert-danger text-center">لا يوجد بيانات حاليا</p>
                @endif
                <!--end: Datatable -->
            </div>
        </div>
    </div>

    <!-- end:: Content -->

@endsection
@section('js')
{{--    <script src="{{asset("dashboard_assets/js/pages/crud/datatables/advanced/column-rendering.js")}}" type="text/javascript"></script>--}}
{{--<script src="{{asset("dashboard_assets/js/pages/crud/datatables/basic/headers.js")}}" type="text/javascript"></script>--}}
{{--<script src="{{asset("dashboard_assets/js/datatables.bundle.js")}}" type="text/javascript"></script>--}}

{{--    <script type="text/javascript" charset="utf8"--}}
{{--            src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $("#kt_table_1").DataTable();--}}
{{--        });--}}

{{--    </script>--}}
{{--<script src="{{asset("dashboard_assets/js/pages/crud/datatables/basic/paginations.js")}}" type="text/javascript"></script>--}}

@endsection
