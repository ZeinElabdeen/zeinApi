@extends('vendor.layouts.app')

@section('content')

<div class="breadcrumb">
    <a href="{{url('vendor/dashboard')}}"><h1>الرئيسية</h1></a>
    <ul>
        <li> تفاصيل الطلب </li>
    </ul>
</div>
<div class="separator-breadcrumb border-top"></div>

<!-- end of row -->

<div class="row mb-4">
    <div class="col-md-8 mb-4">
        <div class="card text-left">
            <div class="card-header">
                <div class="card-title mb-3">
                    <strong class="text-primary"> قائمة المنتجات المطلوبة</strong>
                </div>
            </div>
            @include('vendor.layouts.message')
      <div class="card-body">
      <div class="table-responsive">
      <table  class="table" >
      <thead>
      <tr>
          <th> OrderID </th>
          <th> الرقم المرجعي </th>
          <th>اسم المنتج العربى</th>
          <th>السعر</th>
          <th>الكمية</th>
          <th>اللون</th>
          <th>المقاس</th>
          <th>الاجمالي</th>
      </tr>
      </thead>
      <tbody>
          <?php $order_total = 0 ; ?>
          @foreach($order_items as $product)
          <tr>
              <td>{{$product->orders_id}}</td>
              <td>{{$product->ref}}</td>
              <td><a href="{{url('vendor/dashboard/product/edit/'.$product->pro_id)}}" target="_blank" title="تفاصيل المنتج" >
                {{$product->name_ar}}
              </a></td>
              <td>{{$product->price}}$</td>
              <td>{{$product->quantity}}</td>

              @if(!empty($product->color))
               <td>
                 <h5  style="width: 15px;height: 15px;border-radius: 9px;background:{{$product->color}};margin-right: 10%;">&nbsp;&nbsp;</h5>
               </td>
              @else
               <td>لم يحدد</td>
              @endif
              @if(!empty($product->size_num))
               <td>{{$product->size_num}}m</td>
              @else
               <td>لم يحدد</td>
              @endif
              <td style="text-align: center;" >{{ $product->price * $product->quantity }}$</td>
          </tr>
          <?php $order_total = $order_total + ($product->price * $product->quantity) ; ?>
          @endforeach
      </tbody>

      </table>
      <div class="col-md-12">
          <div class="invoice-summary">
              <!--<p>Sub total: <span>$1200</span></p>
              <p>Vat: <span>$120</span></p> -->
              <p class="font-weight-bold">أجمالي الفاتورة: <span>${{$order_total}}</span></p>

              @if( !empty($order_details['salecode']) )

                 <p class="font-weight-bold" style="color: #cd955e;">
                   ألاجمالي بعد الخصم: <span>  ${{$order_total - ($order_total * $order_details['salecode_value']/100)}}</span>
                 </p>

              @endif
          </div>
      </div>

      </div>
      </div>

       </div>

     </div>

     <div class="col-md-4 text-right" style="margin-inline-start: -5%;">
        <label class="font-weight-bold" >حالة الطلب</label>
        <div class="pr-0 mb-4">
          @if($product->order_item_status !=3)
              @if($product->order_item_status == 0 )
                <label class="radio radio-reverse radio-warning">
                    <input type="radio" name="orderStatus" value="0"><span>طلب جديد</span><span class="checkmark"></span>
                </label>
              @endif
              @if($product->order_item_status == 0 || $product->order_item_status == 1)
                <label class="radio radio-reverse radio-info">
                    <input type="radio" name="orderStatus" value="1"><span>تم التاكيد وفي انتظار الشحن</span><span class="checkmark"></span>
                </label>
              @endif
              @if($product->order_item_status == 2 || $product->order_item_status == 1)
                <label class="radio radio-reverse radio-dark">
                    <input type="radio" name="orderStatus" value="2"><span>في الشحن</span><span class="checkmark"></span>
                </label>
             @endif
          @endif
          @if($product->order_item_status == 3 || $product->order_item_status == 2)
          <!--  <label class="radio radio-reverse radio-danger">
                <input type="radio" name="orderStatus" value="4"><span>ملغي</span><span class="checkmark"></span>
            </label> -->
            <label class="radio radio-reverse radio-success">
                <input type="radio" name="orderStatus" value="3"><span>تم التوصيل</span><span class="checkmark"></span>
            </label>
        @endif
        </div>
    </div>

   </div>



   <div class="row mb-4">
       <div class="col-md-6 mb-4">
           <div class="card text-left">
               <div class="card-header">
                   <div class="card-title mb-3">
                       <strong class="text-primary"> تفاصيل الطلب</strong>
                   </div>
               </div>
               <div class="card-body">
               <div class="table-responsive">
               <table  class="table" >
               <thead>
               <tr>
                  <th>{{$order_details->full_name}}</th>
               </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>{{$order_details->phone}}</td>
                  </tr>
                  <tr>
                     <td>{{$order_details->email}}</td>
                  </tr>
                  <tr>
                       @if( empty($order_details->new_ship_adress) )
                        <td>{{$order_details->address}}</td>
                       @else
                        <td>{{$order_details->new_ship_adress}}</td>
                       @endif
                   </tr>

               </tbody>

               </table>


               </div>
               </div>



       </div>
     </div>
   </div>

   <script>

     document.addEventListener("DOMContentLoaded", function(event) {
         $("input[name=orderStatus][value='{{$product->order_item_status}}']").prop('checked', true);

         $('input[type=radio][name=orderStatus]').change(function() {
           if(confirm('هل أنت متاكد من تغير حالة الطلب ؟'))
           {
             var new_status = this.value ;
             @foreach($order_items as $product)
                 $.ajax({
                 url: '{{url("vendor/dashboard/product/order-item/status/change")}}',
                 type: 'POST',
                 data: {
                 "_token": "{{ csrf_token() }}",
                 "item_id": "{{ $product->id }}",
                 "new_status": new_status
                 },
                 async: false,
                 success: function (data) {
                   console.log(data);
                   } ,
                   error:function (xhr, ajaxOptions, thrownError){
                     var ret = JSON.parse(xhr.responseText);
                     console.log(ret);
                   }
               });
             @endforeach
           }else{
             $(this).prop("checked", false);
              $("input[name=orderStatus][value='{{$product->order_item_status}}']").prop('checked', true);
           }
        });

      });

   </script>

  @endsection
