@extends('vendor.layouts.app')

@section('content')

<div class="breadcrumb">
    <a href="{{url('vendor/dashboard')}}"><h1>الرئيسية</h1></a>
    <ul>
        <li> التقيمات</li>
    </ul>
</div>
<div class="separator-breadcrumb border-top"></div>

<!-- end of row -->

<div class="row mb-4">
    <div class="col-md-12 mb-4">
        <div class="card text-left">
            <div class="card-header">
                <div class="card-title mb-3">
                    <strong class="text-primary"> قائمة التقيمات</strong>
                </div>
            </div>
            @include('vendor.layouts.message')



      <div class="card-body">
      <div class="table-responsive">
      <table id="alternative_pagination_table" class="display table table-striped table-bordered" style="width:100%">
      <thead>
      <tr>
          <th> # </th>
          <th> الاسم </th>
          <th>البريد الالكتروني </th>
          <th>التقيم</th>
          <th>التعليق</th>
          <th>المنتج</th>
          <th>الحالة</th>
      </tr>
      </thead>
      <tbody>
          @foreach($comments as $row)<tr>

              <td>{{$row->id}}</td>
              <td>{{$row->name}}</td>
              <td>{{$row->email}}</td>
              <td>
                {{$row->stars}} /5
              </td>
              <td>{{$row->comment}}</td>
              <td style="text-align: center;">
                        <a  target="_blank" href="{{url('vendor/dashboard/product/edit/'.$row->pro_id)}}" title="عرض المنتج" class="text-info mr-2">
                          <button class="btn">
                            <i class="nav-icon i-Eye" style="font-size: 25px;"></i>
                          </button>
                        </a>
                </td>


                @if($row->status == '1')
                    <td style="text-align: center;"><a  href="{{url('vendor/dashboard/product/comment/suspend/'.$row->id)}}"  class="badge badge-success status-btn" style="width:80px;height: 25px;padding:auto;margin:auto;
                        padding-top: 7px; font-size: small">منشور</a></td>
                @else
                    <td style="text-align: center;"><a  href="{{url('vendor/dashboard/product/comment/suspend/'.$row->id)}}"  class="badge badge-danger status-btn" style="width:80px;height: 25px;padding:auto;margin:auto;
                        padding-top: 7px; font-size: small">غير منشور</a></td>
                @endif

              </tr>
          @endforeach

      </tbody>

      </table>
      </div>
      </div>
      @endsection
