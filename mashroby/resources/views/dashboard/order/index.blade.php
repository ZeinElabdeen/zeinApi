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

                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
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

            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                @if(count($data) > 0)
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>الكود</th>
                        <th>صاحب الطلب</th>
                        <th>التكلفة</th>
                        <th>تاريخ الإنشاء</th>
                      <!--  <th>الإجراء</th> -->
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $index => $item)
                        <tr>
                            <td>{{++$index}}</td>
                            <td>{{$item->code}}</td>
                            <td>{{$item->user->username}}</td>
                            <td>{{$item->total_cost}}</td>
                            <td>{{$item->created_at->format('Y-m-d')}}</td>
                            <!--<td>
                                <div class="dropdown dropdown-inline">
                                  @if($item->status  != '4' && $item->status  != '2')
                                    <button type="button" class="btn btn-brand btn-elevate-hover btn-icon btn-sm btn-icon-md btn-circle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="flaticon-more-1"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                      @if($item->status  == '0')
                                        <a class="dropdown-item" href="{{route('dashboard.orderStatus',['id'=>$item->id,'status'=>'1'])}}"><i class="la la-plus"></i> تأكيد</a>
                                      @endif
                                      @if($item->status  == '1')
                                        <a class="dropdown-item" href="{{route('dashboard.orderStatus',['id'=>$item->id,'status'=>'3'])}}"><i class="la la-plus"></i> شحن </a>
                                      @endif
                                      @if($item->status  == '3')
                                        <a class="dropdown-item" href="{{route('dashboard.orderStatus',['id'=>$item->id,'status'=>'4'])}}"><i class="la la-plus"></i> تم التسليم</a>
                                      @endif
                                      @if($item->status  != '4')
                                        <a class="dropdown-item" href="{{route('dashboard.orderStatus',['id'=>$item->id,'status'=>'2'])}}"><i class="la la-plus"></i> إلغاء</a>
                                       @endif
                                    </div>
                                </div>
                                @endif
                                @if($item->status  == '4')
                                  <span style="margin: 7px;" >
                                      تم التسليم
                                  </span>
                                  @endif
                                  @if($item->status  == '2')
                                  <span style="margin: 7px;" >
                                    تم الإلغاء
                                  </span>
                                  @endif
                            </td> -->
                            <td>
                                <a href="{{url('/dashboard/order/show/'.$item->id)}}" class="btn btn-danger btn-xs">عرض الطلب</a>
                                @if($item->status  != '0')
                                <a href="{{url('/dashboard/order/actions-logs/'.$item->id)}}" class="btn btn-warning btn-xs">عرض سجلات الاجراءات</a>
                                @endif
                            </td>
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
