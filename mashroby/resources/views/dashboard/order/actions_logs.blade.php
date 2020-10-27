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
                        {{$title}}  </a>
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
                        {{$title}}
                    </h3>

                </div>

                <a target="_blank" href="{{url('/dashboard/order/show/'.$order_id)}}" class="btn btn-success" style="height: min-content;margin: 12px;">
                  عرض الطلب
                </a>

            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                @if(count($data) > 0)
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>قام به </th>
                        <th>الإجراء</th>
                        <th>تاريخ الإجراء</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $index => $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->admin_data->username}}</td>
                            <td>
                                      @if($item->action  == '1')
                                        قام بنقل الطلب الي تم  التاكيد
                                      @endif
                                      @if($item->action  == '3')
                                        قام بنقل الطلب الي تم الشحن
                                      @endif
                                      @if($item->action  == '4')
                                        قام بنقل الطلب الي تم التسليم
                                       @endif
                                       @if($item->action  == '2')
                                       قام بالغاء الطلب
                                       @endif
                            </td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                    <p class="alert alert-danger">لا يوجد بيانات حاليا</p>
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
