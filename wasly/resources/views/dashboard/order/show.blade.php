
@extends('dashboard.layouts.app')
@section('css')
    <link id="gull-theme" rel="stylesheet" href="{{asset('assets')}}/styles/css/image.css">
    <link rel="stylesheet" href="{{asset('assets')}}/styles/vendor/pickadate/classic.css">
    <link rel="stylesheet" href="{{asset('assets')}}/styles/vendor/pickadate/classic.date.css">
@endsection

<!-- ============ Body content start ============= -->
@section('content')
{{--    <div class="breadcrumb">--}}
{{--        <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>--}}
{{--        <ul>--}}
{{--            <li><a> {{$title}}</a></li>--}}
{{--        </ul>--}}
{{--    </div>--}}

{{--    <div class="separator-breadcrumb border-top"></div>--}}
{{--    <div class="app-admin-wrap layout-sidebar-large">--}}
    <!-- ============ Body content start ============= -->
{{--    <div class="main-content-wrap sidenav-open d-flex flex-column">--}}
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs justify-content-end mb-4" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="true">الفاتورة</a>
                    </li>

                </ul>
                <div class="card">

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
                            <div class="d-sm-flex mb-5" data-view="print">
                                <span class="m-auto"></span>
                                <button class="btn btn-primary mb-sm-0 mb-3 print-invoice">طباعة الفاتورة</button>

                                      @if($data->status  == '0')
                                        <a  href="{{route('dashboard.orderStatus',['id'=>$data->id,'status'=>'1'])}}">
                                          <button class="btn btn-info mb-sm-0 mb-3" style="margin: 7px;" >
                                          تاكيد
                                        </button>
                                       </a>
                                      @endif
                                      @if($data->status  == '1')
                                        <a  href="{{route('dashboard.orderStatus',['id'=>$data->id,'status'=>'3'])}}">
                                          <button class="btn btn-warning mb-sm-0 mb-3" style="margin: 7px;" >
                                          شحن
                                        </button>
                                        </a>
                                      @endif
                                      @if($data->status  == '3')
                                        <a  href="{{route('dashboard.orderStatus',['id'=>$data->id,'status'=>'4'])}}">
                                          <button class="btn btn-success mb-sm-0 mb-3" style="margin: 7px;" >
                                            تم التوصيل
                                        </button>
                                        </a>
                                      @endif
                                      @if($data->status  == '2')
                                           <span  style="margin: 7px;" >
                                             تم الإلغاء
                                           </span>
                                      @endif
                                      @if($data->status  != '4' && $data->status  != '2')
                                        <a  href="{{route('dashboard.orderStatus',['id'=>$data->id,'status'=>'2'])}}">
                                          <button class="btn btn-danger mb-sm-0 mb-3" style="margin: 7px;" >
                                            إلغاء
                                        </button>
                                        </a>
                                     @endif
                                     @if($data->status  == '4')
                                          <span  style="margin: 7px;" >
                                            تم التوصيل
                                          </span>
                                     @endif


                            </div>

                            <!---===== Print Area =======-->
                            <div id="print-area">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p> {{$data->created_at->format('d-m-Y')}}</p>
                                        <h4 class="font-weight-bold">بيانات الطلب</h4>
                                        <p>#{{$data->code}}</p>
                                    </div>
                                    <div class="col-md-6 text-sm-right">

                                    </div>
                                </div>
                                <div class="mt-3 mb-4 border-top"></div>
                                <div class="row mb-5">
                                    <div class="col-md-6 mb-3 mb-sm-0">
                                        <h5 class="font-weight-bold">بيانات صاحب الطلب</h5>
                                        <p> {{$data->user->first_name .' ' . $data->user->last_name}}</p>
                                        <span style="white-space: pre-line">
                                                {{$data->user->city->state . ' ' . $data->user->city->city.' ' . $data->village->village}}
                                                {{$data->address_description}}
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-10 table-responsive">
                                        <table class="table table-hover mb-4">
                                            <thead class="bg-gray-300">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">اسم المنتج</th>
                                                <th scope="col">الكمية</th>
                                                <th scope="col">سعر الوحدة</th>
{{--                                                <th scope="col">الاجمالي</th>--}}
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data->orderItems as $index => $item)
                                                <tr>
                                                    <th scope="row">{{$index}}</th>
                                                    <td>{{$item->itemDetails->title}}</td>
                                                    <td>{{$item->count}}</td>
                                                    <td>{{$item->price}}</td>
{{--                                                    <td>{{$item->count * $item->price}}</td>--}}
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="invoice-summary">
                                            <p>تكلفة الطلب: <span>{{$data->order_cost}}</span></p>
                                            @if(!empty($data->coupon_discount))
                                              <p>قيمة الخصم : <span>{{$data->coupon_discount}} % </span></p>
                                            @endif
                                            <p>سعر التوصيل: <span>{{$data->shipping_cost}}</span></p>
                                            <h5 class="font-weight-bold">الإجمالي: <span> {{$data->total_cost}}</span></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--==== / Print Area =====-->
                        </div>
                    </div>

                </div>
            </div>
        </div>
{{--    </div>--}}
        <!-- Footer Start -->
        <div class="flex-grow-1"></div>
        <!-- fotter end -->

{{--    </div>--}}
    <!-- ============ Body content End ============= -->
{{--    </div>--}}
@endsection
<!-- ============ Body content End ============= -->
@section('js')
    <script src="{{asset('assets')}}/js/image.js"></script>
    <script src="{{asset('assets')}}/js/vendor/pickadate/picker.js"></script>
    <script src="{{asset('assets')}}/js/vendor/pickadate/picker.date.js"></script>
    <script src="{{asset('assets')}}/js/invoice.script.js"></script>

@endsection
