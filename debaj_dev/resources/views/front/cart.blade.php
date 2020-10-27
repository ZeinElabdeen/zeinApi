@extends('front.layouts.app')
<!-- ============ Body content start ============= -->
@section('content')

<div class="page-header">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fas fa-home"></i> {{ __('front.home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('front.cart') }}</li>
          </ol>
        </nav>
        <h2>{{ __('front.cart') }}</h2>
      </div>
    </div>
  </header>

  <section class="cart-list">
    <div class="container">
      <div class="row">
      @if(!empty($data))
        <div class="col-lg-9">
          <form action="">
            <div class="head">
              <div class="row">
                <div class="col-md-5">{{ __('front.product') }}</div>
                <div class="col-2 col-md-1 col-lg-1">{{ __('front.quantity') }}</div>
                <div class="col-3 col-md-3 col-lg-1">{{ __('front.price') }}</div>
                <div class="col-3 col-md-3 col-lg-2">{{ __('front.size_num') }}</div>
                <div class="col-3 col-md-3 col-lg-2">{{ __('front.subtotal') }}</div>
              </div>
            </div>
            <div class="body">
            <?php $total=0; ?>
            @foreach ($data as $key => $value)
              <div class="cart-item" id="cart-{{$key}}" >
                <div class="row">
                  <div class="col-md-5">
                    <div class="product-item">
                      <div class="image"><img src="{{config('proudect_img'). $data[$key]['photo']}}" alt="{{$data[$key]['name_'.app()->getLocale()]}}"></div>
                      <h5>{{$data[$key]['name_'.app()->getLocale()]}}</h5>
                    </div>
                  </div>
                  <div class="col-2 col-md-1 col-lg-1">
                    <div class="counter">
                      <div class="form-inline">
                        <!--<div class="input-group-text minuse-btn" onclick="update_cart('-'+{{$data[$key]['price']}},{{$key}})">
                          <i class="fas fa-minus"></i>
                        </div>-->
                        <input class="prod-count-value form-control" id="pro_count_{{$key}}" name=id="pro_count_{{$key}}" value=" {{$data[$key]['quantity']}}" readonly>
                      <!--  <div class="input-group-text add-btn" onclick="update_cart({{$data[$key]['price']}},{{$key}})">
                          <i class="fas fa-plus"></i>
                        </div>-->
                      </div>
                    </div>
                  </div>

                  <div class="col-3 col-md-3 col-lg-1 price">${{$data[$key]['price']}}</div>

                  <div class="col-3 col-md-3 col-lg-3">
                    <div class="counter">
                      <div class="form-inline">
                        <div class="input-group-text minuse-btn" onclick="update_cart({{$key}})">
                          <i class="fas fa-minus"></i>
                        </div>
                        <input class="prod-count-value form-control" id="size_num_{{$key}}" name="size_num_{{$key}}" value=" {{$data[$key]['size_num']}}" readonly>
                        <div class="input-group-text add-btn" onclick="update_cart({{$key}})">
                          <i class="fas fa-plus"></i>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-3 col-md-3 col-lg-1 subtotal">${{$data[$key]['price']*$data[$key]['quantity']}}</div>
                  <div class="col-3 col-lg-1 text-left">
                    <button class="btn btn-transparent" onclick="remove_cart({{$key}})" type="button" data-toggle="tooltip" data-placement="top"
                      title="{{ __('front.remove') }}"><i class="fas fa-times"></i></button>
                  </div>
                </div>
              </div>
              <?php $total = $total + ($data[$key]['price']*$data[$key]['quantity']); ?>
            @endforeach


        </div>

          </form>
        </div>
        <div class="col-lg-3">
          <div class="head">

          </div>
          <div class="body">
            <ul class="list-unstyled order-review">
              <li>
                <div>{{ __('front.total') }}</div>
                <div id="total_div" >
                  ${{$total}}
                </div>
                <input type="hidden" id="last_total" value="{{$total}}" >
              </li>
            </ul>
            <a class="btn btn-second btn-block" href="{{url('checkout')}}">{{ __('front.checkout') }}</a>
          </div>
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
    function remove_cart(id)
    {
      var data = {'pro_id':id,"_token": "{{ csrf_token() }}",};
       $.ajax({
          url: '{{url("remove-cart")}}',
          type: 'POST',
          data:data,
          async: false,
          success: function (data) {
            if($.isEmptyObject(data.error)){

                  Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '{{ __("front.done_remove") }}',
                        showConfirmButton: false,
                        timer: 1500
                      });
                      $('#cart-'+id).remove();
                      $('#cart_notfi').html('<span>'+data.success+'</span>');

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

    function update_cart(id)
    {
      setTimeout(function(){
        var newsize_num = $("#size_num_"+id).val();


        var data = {'pro_count':1,'size_num':newsize_num,'pro_id':id,"_token": "{{ csrf_token() }}",};
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

      }, 50);

  }
  </script>

@endsection
