@extends('front.layouts.app')
<!-- ============ Body content start ============= -->
@section('content')

<div class="page-header">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fas fa-home"></i> {{ __('front.home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('front.my_orders') }}</li>
          </ol>
        </nav>
        <h2>{{ __('front.my_orders') }}</h2>
      </div>
    </div>
  </header>

  <section class="cart-list">
    <div class="container">
      <div class="row">
      @if(!empty($my_orders))
        <div class="col-lg-9">
          <form action="">
            <div class="head">
              <div class="row">
                <div class="col-md-5">{{ __('front.orders_num') }}</div>
                <div class="col-7 col-md-3 col-lg-3">{{ __('front.orders_status') }}</div>
                <div class="col-7 col-md-3 col-lg-3"></div>
              </div>
            </div>
            <div class="body">

            @foreach ($my_orders as $row)
              <div class="cart-item"  id="order-{{$row['id']}}">
                <div class="row">
                  <div class="col-md-5">
                    <div class="product-item">
                    #  <h5>{{$row['id']}}</h5>
                    </div>
                  </div>
                <!--  <div class="col-3 col-md-3 col-lg-2 ">{{$status[$row['status']]}}</div> -->
                  <div class="col-3 col-md-4 col-lg-4 ">
                    <div class="text-center">
                      <a class="btn btn-second" style="border-radius: 28px;" href="{{url('order-details/'.$row['id'])}}">{{ __('front.orders_details') }}</a>
                    </div>
                  </div>
                @if($row['status'] == '0')
                <!--  <div class="col-3 col-lg-1 text-left">
                    <button class="btn btn-transparent" onclick="cancel_order({{$row['id']}})" type="button" data-toggle="tooltip" data-placement="top"
                      title="{{ __('front.cancel') }}"><i class="fas fa-times"></i></button>
                  </div>-->
                 @endif
                </div>
              </div>
            @endforeach


        </div>

          </form>
        </div>

      @else
    <div class="col-lg-12">
      <div class="row align-items-center justify-content-center">
      <div class="col-lg-5 col-md-6">
        <i class="row align-items-center justify-content-center" style="position: inherit;top: 26px;" >
          <img src="{{asset('assets/front/'.app()->getLocale() )}}/img/icons/cart.png"
            alt="Favorite" />
        </i>
        <h2 class="row align-items-center justify-content-center" style="padding: 40px;">
          {{ __('front.emptycart') }}
        </h2>
        <div class="text-center">
          <a class="btn btn-second" href="{{url('/')}}">{{ __('front.shopnow') }}</a>
        </div>
      </div>
     </div>
    </div>
  @endif
      </div>
    </div>
  </section>

  <script>
    function cancel_order(id)
    {
      var data = {'order_id':id,"_token": "{{ csrf_token() }}",};
       $.ajax({
          url: '{{url("cancel-order")}}',
          type: 'POST',
          data:data,
          async: false,
          success: function (data) {
            if($.isEmptyObject(data.error)){

                  Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '{{ __("front.cancel_order") }}',
                        showConfirmButton: false,
                        timer: 1500
                      });
                    //  $('#order-'+id).remove();
                    location.href ='{{url("my-orders")}}';
              }else{
                var error_msg = '';
                $.each( data.error, function( key, value ) {
                  error_msg = error_msg+value+'<br/><br/>';
                });
                Swal.fire(error_msg);
              }
            } ,
            error:function (xhr, ajaxOptions, thrownError){
              var ret = JSON.parse(xhr.responseText);
              Swal.fire(ret);
            }
        });
    }

    function update_cart(added_price,id)
    {
      var current_count = parseInt($("#pro_count_"+id).val());
      setTimeout(function(){
        var submit_count = Math.sign(parseInt(added_price));
        if( (current_count + submit_count) > 0){
        var new_count = parseInt($("#pro_count_"+id).val());

        var last_total= parseInt($("#last_total").val());
        var new_total = parseInt(added_price)*1 + parseInt(last_total);
        $("#total_div").html('$'+new_total);
        $("#last_total").val(new_total);

        var data = {'pro_count':submit_count,'pro_id':id,"_token": "{{ csrf_token() }}",};
         $.ajax({
            url: '{{url("add-to-cart")}}',
            type: 'POST',
            data:data,
            async: false,
            success: function (data) {
              if($.isEmptyObject(data.error)){
                  console.log(data.success);
                }else{
                  var error_msg = '';
                  $.each( data.error, function( key, value ) {
                    error_msg = error_msg+value+'<br/><br/>';
                  });
                  Swal.fire(error_msg);
                }
              } ,
              error:function (xhr, ajaxOptions, thrownError){
                var ret = JSON.parse(xhr.responseText);
                Swal.fire(ret);
              }
          });
        }
      }, 50);

  }
  </script>

@endsection
