@extends('vendor.layouts.app')

@section('content')

<div class="breadcrumb">
    <a href="{{url('vendor/dashboard')}}"><h1>الرئيسية</h1></a>
    <ul>
        <li> المنتجات</li>
    </ul>
</div>
<div class="separator-breadcrumb border-top"></div>

<!-- end of row -->

<div class="row mb-4">
    <div class="col-md-12 mb-4">
        <div class="card text-left">
            <div class="card-header">
                <div class="card-title mb-3">
                    <strong class="text-primary"> قائمة المنتجات</strong>
                    <span class="align-baseline" style="display:inline;">
                        <a class="btn btn-primary " href="{{url('vendor/dashboard/product/create')}}" style="float: left">
                        <i class="i-Add align-middle" style="font-size: 17px; font-weight: 600;"></i> إضافة منتج جديد </a>
                    </span>
                </div>
            </div>
            @include('vendor.layouts.message')



      <div class="card-body">
      <div class="table-responsive">
      <table id="alternative_pagination_table" class="display table table-striped table-bordered" style="width:100%">
      <thead>
      <tr>
          <th> ID </th>
          <th>ref</th>
          <th>اسم المنتج العربى</th>
          <th>القسم</th>
          <th>السعر</th>
        <!--  <th>أضيف بواسطة</th>-->
          <th>التحكم</th>
      </tr>
      </thead>
      <tbody>
          @foreach($products as $product)<tr>


          <td>{{$product->id}}</td>
              <td>{{$product->ref}}</td>
              <td>{{$product->name_ar}}</td>
              <td>{{$product->category['title_ar']}}</td>
              <td>{{$product->price}}</td>
      
              <td style="text-align: center;">
                      <a href="{{url('vendor/dashboard/product/edit/'.$product->id)}}" class="text-info mr-2">
                          <i class="nav-icon i-Edit font-weight-bold " ></i>
                      </a>
                      <a href="{{url('vendor/dashboard/product/delete/'.$product->id)}}" class="text-danger mr-2">
                          <i class="nav-icon i-Close-Window font-weight-bold delete-btn"></i>
                          <form action=""></form>
                      </a>
                  </td>
              </tr>
          @endforeach

      </tbody>

      </table>
      </div>
      </div>
      @endsection
