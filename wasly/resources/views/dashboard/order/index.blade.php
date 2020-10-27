
@extends('dashboard.layouts.app')

<!-- ============ Body content start ============= -->
@section('content')
        <div class="breadcrumb">
            <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>
            <ul>
                <li> الطلبات</li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>

        <!-- end of row -->

        <div class="row mb-4">
            <div class="col-md-12 mb-4">
                <div class="card text-left">
                    <div class="card-header">
                        <div class="card-title mb-3">
                            <strong class="text-primary"> قائمة {{$title}}</strong>

                        </div>
                    </div>
                    @include('dashboard.layouts.message')
                    <div class="card-body">
                        @if(count($data) > 0)
                            <div class="table-responsive">
                                <table id="alternative_pagination_table" class="display table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th> كود الطلب  </th>
                                        <th> العنوان  </th>
                                        <th> صاحب الطلب</th>
                                        <th> تفاصيل الطلب  </th>
                                        <th> تكلفة الشحن </th>
                                        <th> تكلفة الطلب </th>
                                        <th> قيمة الخصم </th>
                                        <th> التكلفة الكلية  </th>
                                        <th>التحكم </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($data)>0 && !empty($data))
                                        @foreach($data as $item)
                                            <tr>
                                                <td>
                                                  <!--  <a href="{{url('dashboard/order/show/'.$item->id)}}" class="text-info mr-2"> -->
                                                        {{$item->code}}
                                                  <!--  </a>-->
                                                </td>
                                                <td>{{$item->village->state.' - '.$item->village->city .' - '.$item->village->village }}</td>
                                                <td>
                                                  {{$item->user->first_name .' '. $item->user->last_name }}
                                                </br>
                                                  {{$item->user->phone }}

                                                </td>


                                                <td style="text-align: center;" >
                                                  <a href="{{url('dashboard/order/show/'.$item->id)}}" class="text-info mr-2">
                                                    <button type="button" class="btn btn-secondary">عرض الطلب</button>
                                                  </a>
                                                </td>
                                                <td>{{$item->shipping_cost}}</td>
                                                <td>{{$item->order_cost}}</td>
                                                <td>
                                                  @if(!empty($item->coupon_discount))
                                                  {{$item->coupon_discount}}%
                                                  @endif
                                                </td>
                                                <td>{{$item->total_cost}}</td>
                                                <td style="text-align: center;">
                                                @if($item->status  != '4' && $item->status  != '2')
                                                    <div class="dropdown dropleft text-right w-50">
                                                        <button class="btn bg-gray-100" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="nav-icon i-Gear-2"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="text-align: right">
                                                          @if($item->status  == '0')
                                                            <a class="dropdown-item" href="{{route('dashboard.orderStatus',['id'=>$item->id,'status'=>'1'])}}">تاكيد</a>
                                                          @endif
                                                          @if($item->status  == '1')
                                                            <a class="dropdown-item" href="{{route('dashboard.orderStatus',['id'=>$item->id,'status'=>'3'])}}">شحن</a>
                                                          @endif
                                                          @if($item->status  == '3')
                                                            <a class="dropdown-item" href="{{route('dashboard.orderStatus',['id'=>$item->id,'status'=>'4'])}}">تم التوصيل</a>
                                                          @endif
                                                          @if($item->status  != '4')
                                                            <a class="dropdown-item" href="{{route('dashboard.orderStatus',['id'=>$item->id,'status'=>'2'])}}">إلغاء</a>
                                                          @endif

                                                        </div>
                                                    </div>
                                                    @endif

                                                    @if($item->status  == '4')
                                                    <span style="margin: 7px;" >
                                                        تم التوصيل
                                                    </span>
                                                    @endif
                                                    @if($item->status  == '2')
                                                    <span style="margin: 7px;" >
                                                      تم الإلغاء
                                                    </span>
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>

                                </table>
                            </div>
                        @else
                            <p class="alert alert-danger text-danger"> لا يوجد بيانات حاليا</p>
                        @endif

                    </div>
                </div>
            </div>
            <!-- end of col -->

        </div>
        <!-- end of row -->


@endsection
<!-- ============ Body content End ============= -->
@section('js')
    <script>
        $(document).ready(function() {

            $("#alternative_pagination_table").on('click', '.status-btn', function () {
                var id = $(this).attr('id');
                var r = confirm("هل انت متاكد من تغيير الحالة");
                if (!r) {
                    return false
                }
            });

            $("#alternative_pagination_table").on('click', '.delete-btn', function () {
                var id = $(this).attr('id');
                var r = confirm("هل انت متاكد من عمليه الحذف ؟");
                if (!r) {
                    return false
                }
            });
        });
    </script>

@endsection
