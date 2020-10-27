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
          <th> الرقم المرجعي </th>
          <th>اسم المنتج العربى</th>
          <th>السعر</th>
          <th>الكمية</th>
          <th> العميل </th>
          <th>التحكم</th>
      </tr>
      </thead>
      <tbody>
          @foreach($products as $product)<tr>

          <td>{{$product->orders_id}}</td>
              <td>{{$product->ref}}</td>
              <td><a href="{{url('vendor/dashboard/product/edit/'.$product->pro_id)}}" target="_blank" title="تفاصيل المنتج" >
                {{$product->name_ar}}
              </a></td>
              <td>{{$product->price}} $</td>
              <td>{{$product->quantity}}</td>

            @if(!empty($product->user_id))
            <?php $username =  DB::table('users')->where('id',$product->user_id)->first(['username','phone','address']); ?>
              <td>
                <div>{{$username->username}}</div>
                <div>{{$username->phone}}</div>
                @if(empty($product->new_ship_adress))
                <div>{{$username->address}}</div>
                @else
                <div>{{$product->new_ship_adress}}</div>
                @endif
              </td>
            @endif
              <td style="text-align: center;">
                      <a href="{{url('vendor/dashboard/order/item/'.$product->item_id)}}" class="text-info mr-2">
                          <i class="nav-icon i-Edit font-weight-bold " ></i>
                      </a>

                  </td>
              </tr>
          @endforeach

      </tbody>

      </table>
      </div>
      </div>
      @endsection
