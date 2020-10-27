@extends('dashboard.layout.master')

@section('css')
    <link href="{{asset("dashboard_assets/css/pages/invoices/invoice-1.css")}}" rel="stylesheet" type="text/css" />
@endsection

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


           <div class="dropdown dropdown-inline" style="font-size: 15px; background: #5d78ff; color: white; padding: 5px; border-radius: 7px; margin: 10px;">
            @if($data->status  != '4' && $data->status  != '2')
            <span >الإجراء</span>
              <button type="button" class="btn btn-brand btn-elevate-hover btn-icon btn-sm btn-icon-md btn-circle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="flaticon-more-1"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                @if($data->status  == '0')
                  <a class="dropdown-item" href="{{route('dashboard.orderStatus',['id'=>$data->id,'status'=>'1'])}}"><i class="la la-plus"></i> تأكيد</a>
                @endif
                @if($data->status  == '1')
                  <a class="dropdown-item" href="{{route('dashboard.orderStatus',['id'=>$data->id,'status'=>'3'])}}"><i class="la la-plus"></i> شحن </a>
                @endif
                @if($data->status  == '3')
                  <a class="dropdown-item" href="{{route('dashboard.orderStatus',['id'=>$data->id,'status'=>'4'])}}"><i class="la la-plus"></i> تم التسليم</a>
                @endif
                @if($data->status  != '4')
                  <a class="dropdown-item" href="{{route('dashboard.orderStatus',['id'=>$data->id,'status'=>'2'])}}"><i class="la la-plus"></i> إلغاء</a>
                 @endif
              </div>

          @endif
          @if($data->status  == '4')

              <span>
                  تم التسليم
              </span>
              @endif
              @if($data->status  == '2')
              <span>
                تم الإلغاء
              </span>
              @endif
         </div>


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



            <div class="kt-portlet">
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="kt-invoice-1">
                        <div class="kt-invoice__body">
                            <div class="kt-invoice__container">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>اسم المنتج</th>
                                            <th>سعر الوحدة</th>
                                            <th>الكمية</th>
                                            <th>الإجمالي</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data->orderItems as $item)
                                        <tr>
                                            <td>{{$item->itemDetails->title_ar}}</td>
                                            <td>{{$item->itemDetails->price}}</td>
                                            <td>{{$item->count}}</td>
                                            <td>{{$item->itemDetails->price*$item->count}}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="kt-invoice__footer">
                            <div class="kt-invoice__container">
                                <div class="kt-invoice__bank" style="min-width: 200px">
                                    <div class="kt-invoice__title">تفاصيل الطلب</div>
                                    <div class="kt-invoice__item" >
                                        <span class="kt-invoice__label">كود الطلب </span>
                                        <span class="kt-invoice__value" style="color: #f43ebe">{{$data->code}}</span>
                                    </div>
                                    <div class="kt-invoice__item" >
                                        <span class="kt-invoice__label">طريقة الدفع </span>
                                        <span class="kt-invoice__value" style="color: #f43ebe">{{$data->paymentMethod()}}</span>
                                    </div>
                                    <div class="kt-invoice__item" >
                                        <span class="kt-invoice__label">  المدفوع من المحفظمه </span>
                                        <span class="kt-invoice__value" style="color: #f43ebe"> {{$data->from_wallet}} </span>
                                    </div>
                                    <div class="kt-invoice__item" >
                                        <span class="kt-invoice__label">  المطلوب كاش </span>
                                        <span class="kt-invoice__value" style="color: #f43ebe"> {{$data->cash_req}} </span>
                                    </div>
                                    <div class="kt-invoice__item">
                                        <span class="kt-invoice__label">وقت التسليم</span>
                                        <span class="kt-invoice__value" style="color: #f43ebe">{{$data->deliveryTime()}}</span>
                                    </div>
                                    <div class="kt-invoice__item" >
                                        <span class="kt-invoice__label">تكرار الطلب</span>
                                        <span class="kt-invoice__value" style="color: #f43ebe">{{$data->repeat()}}</span>
                                    </div>
                                    <div class="kt-invoice__item" >
                                        <span class="kt-invoice__label">تاريخ الطلب</span>
                                        <span class="kt-invoice__value" style="color: #f43ebe">{{$data->order_creation_date}}</span>
                                    </div>
                                    <div class="kt-invoice__item" >
                                        <span class="kt-invoice__label">مكان التوصيل</span>
                                        <span class="kt-invoice__value" style="color: #f43ebe">
                                            <a href="https://www.google.ca/maps/place/{{$data->lat}}+{{$data->lng}}" target="_blank">
                                                <i class="flaticon2-location" style="font-size: 20px;"></i>
                                            </a>
                                        </span>
                                        <span class="kt-invoice__value" style="color: #f43ebe">
                                            {{$data->address}}
                                        </span>
                                    </div>
                                </div>
                                <div class="kt-invoice__total">
                                    <span class="kt-invoice__title">الإجمالي</span>
                                    <span class="kt-invoice__price">{{$data->total_cost}}</span>
                                    <span class="kt-invoice__notice"> قيمة الضريبة  <span style="color: #f43ebe">{{$data->tax}}</span></span>
                                    @if(!empty($data->promo_code))
                                     <span class="kt-invoice__notice"> قيمة الخصم  : <span style="color: #f43ebe">{{$data->promo_code_value}} % </span></span>
                                     <span class="kt-invoice__notice"> كود الخصم : <span style="color: #f43ebe">{{$data->promo_code}}</span></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="kt-invoice__actions">
                            <div class="kt-invoice__container">
                                <button type="button" class="btn btn-label-brand btn-bold" onclick="window.print();">Download Invoice</button>
                                <button type="button" class="btn btn-brand btn-bold" onclick="window.print();">Print Invoice</button>
                            </div>
                        </div>
                    </div>
                </div>
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
