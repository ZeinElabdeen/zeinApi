
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
                                         <th> التكلفة الكلية  </th>
                                         <th> قيمة الخصم</th>
                                        <th> الحالة  </th>
                                        <th>التحكم </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($data)>0 && !empty($data))
                                        @foreach($data as $item)
                                            <tr>
                                                <td>
                                                    <a href="{{url('dashboard/order/show/'.$item->id)}}" class="text-info mr-2">
                                                        {{$item->code}}
                                                    </a>
                                                </td>
                                                <td>{{$item->village->state .' - '.$item->village->city .' - '.$item->village->village}}</td>

                                                <td>{{$item->total_cost}}</td>
                                                <td>
                                                  @if(!empty($item->coupon_discount))
                                                  {{$item->coupon_discount}}%
                                                  @endif
                                                </td>
                                                <td>
                                                    @switch($item->status)
                                                        @case(0)
                                                            <p  href="{{url('dashboard/user/suspend/'.$item->id)}}"  class="badge badge-warning " style="width:80px;height: 25px;padding:auto;margin:auto;padding-top: 7px; font-size: small">جديد</p>
                                                            @break
                                                        @case(1)
                                                            <p  href="{{url('dashboard/user/suspend/'.$item->id)}}"  class="badge badge-info " style="width:80px;height: 25px;padding:auto;margin:auto;padding-top: 7px; font-size: small">تم التأكيد</p>
                                                        @break
                                                        @case(2)
                                                            <p  href="{{url('dashboard/user/suspend/'.$item->id)}}"  class="badge badge-danger " style="width:80px;height: 25px;padding:auto;margin:auto;padding-top: 7px; font-size: small">ملغي </p>
                                                        @break
                                                        @case(3)
                                                            <p  href="{{url('dashboard/user/suspend/'.$item->id)}}"  class="badge badge-primary " style="width:80px;height: 25px;padding:auto;margin:auto;padding-top: 7px; font-size: small">تم الشحن</p>
                                                        @break
                                                        @case(4)
                                                            <p  href="{{url('dashboard/user/suspend/'.$item->id)}}"  class="badge badge-success " style="width:80px;height: 25px;padding:auto;margin:auto;padding-top: 7px; font-size: small">تم التوصيل</p>
                                                        @break
                                                        @default
                                                        @endswitch

                                                </td>
                                                <td style="text-align: center;">
                                                    <div class="dropdown dropleft text-right w-50">
                                                        <button class="btn bg-gray-100" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="nav-icon i-Gear-2"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="text-align: right">
                                                            <a class="dropdown-item" href="{{route('dashboard.orderStatus',['id'=>$item->id,'status'=>'1'])}}">تم التأكيد</a>
                                                            <a class="dropdown-item" href="{{route('dashboard.orderStatus',['id'=>$item->id,'status'=>'3'])}}">تم الشحن</a>
                                                            <a class="dropdown-item" href="{{route('dashboard.orderStatus',['id'=>$item->id,'status'=>'4'])}}">تم التوصيل</a>
                                                            <a class="dropdown-item" href="{{route('dashboard.orderStatus',['id'=>$item->id,'status'=>'2'])}}">إلغاء</a>
                                                        </div>
                                                    </div>
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
