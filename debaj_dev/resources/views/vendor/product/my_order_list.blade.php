@extends('vendor.layouts.app')

@section('content')

<div class="breadcrumb">
    <a href="{{url('vendor/dashboard')}}"><h1>الرئيسية</h1></a>
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
                    <strong class="text-primary"> قائمة الطلبات</strong>
                </div>
            </div>
            @include('vendor.layouts.message')



      <div class="card-body">
      <div class="table-responsive">
      <table id="alternative_pagination_table" class="display table table-striped table-bordered" style="width:100%">
      <thead>
      <tr>
          <th> OrderID </th>
          <th> حالة الطلب </th>
          <th> بيانات العميل </th>
          <th>تفاصيل الطلب</th>
      </tr>
      </thead>
      <tbody>
          @foreach($my_orders as $row)<tr>  
              <td>{{$row->orders_id}}</td>
              <td>{{$status[$row->order_item_status]}}</td>

            @if(!empty($row->user_id))
            <?php $username =  DB::table('users')->where('id',$row->user_id)->first(['username','phone','address']); ?>
              <td>
                <div>{{$username->username}}</div>
                <div>{{$username->phone}}</div>
                @if(empty($row->new_ship_adress))
                <div>{{$username->address}}</div>
                @else
                <div>{{$row->new_ship_adress}}</div>
                @endif
              </td>
            @endif
                <td style="text-align: center;">
                        <a href="{{url('vendor/dashboard/product/order/items/'.$row->orders_id)}}" title="عرض" class="text-info mr-2">
                            <i class="nav-icon i-Eye" style="font-size: 40px;"></i>
                        </a>

                </td>
              </tr>
          @endforeach

      </tbody>

      </table>
      </div>
      </div>
      @endsection
