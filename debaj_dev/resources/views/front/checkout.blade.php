@extends('front.layouts.app')
<!-- ============ Body content start ============= -->
@section('content')

<div class="page-header">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fas fa-home"></i> {{ __('front.home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('front.checkout_done') }}</li>
          </ol>
        </nav>
        <h2>{{ __('front.checkout_done') }}</h2>
      </div>
    </div>
  </header>

  <section class="form checkout">
    <div class="container">
      <!--<form action="">-->
        <div class="row">
          <div class="col-lg-8">
            <h4>{{ __('front.adress_detials') }}</h4>
            <div class="row">
              <div class="col-sm-12">
                <label>{{ __('front.name') }} </label>
                <input type="text" class="form-control" value="{{auth('users')->user()->full_name}}" readonly >
              </div>
              <div class="col-lg-12">
                <label for="">{{ __('front.email') }} </label>
                <input type="email" class="form-control" value="{{auth('users')->user()->email}}" readonly >
              </div>
              <div class="col-lg-12">
                <label for="">{{ __('front.phone') }} </label>
                <input type="tel" class="form-control" value="{{auth('users')->user()->phone}}" readonly >
              </div>

              <div class="col-lg-12">
                <label for="">{{ __('front.adress') }} </label>
                <input type="text" class="form-control" value="{{auth('users')->user()->address}}" readonly >
              </div>

              <!--<div class="col-lg-12">
                <label for="">{{ __('front.salecode') }} </label>
                <input type="text" class="form-control" name="salecode" id="salecode" >
              </div> -->

              <div class="col-lg-12">
              <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="coupon mb-12">
                  <div class="form-inline">
                     <input type="text" class="form-control" name="salecode" id="salecode" placeholder="{{ __('front.salecode') }}" >
                    <button type="button" onclick="salecode_apply()" class="form-control btn btn-gray">{{ __('front.salecode_apply') }}</button>
                  </div>
                </div>
              </div>
              </div>

            </div>

            <div class="custom-control custom-control-inline custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="change_adress" name="change_adress" onclick="add_address()">
              <label class="custom-control-label" for="change_adress">{{ __('front.change_adress') }}</label>
            </div>
            <div class="col-lg-12" style="display: none;" id="newadress" >
              <label for="">{{ __('front.newadress') }} </label>
            <form id="new_data">
              <input type="text" class="form-control" id="newadressval" name="newadressval" value="" >
            </form>
            </div>
          </div>
          <div class="col-lg-4">
            <h4>{{ __('front.your_order') }}</h4>
            <ul class="list-unstyled order-review">
              <?php $total=0; ?>
            @foreach ($data as $key => $value)
              <li>
                <div>{{$data[$key]['name_'.app()->getLocale()]}}</div>
                <div> {{__('front.size_num') .': '.$data[$key]['size_num']}} m </div>
                <div>$ {{$data[$key]['price']*$data[$key]['quantity']}}</div>
                @if(!empty($data[$key]['color']))
                 <div style="width: 15px;height: 15px;border-radius: 9px;background:{{$data[$key]['color']}};">&nbsp;&nbsp;</div>
                @endif
                @if(!empty($data[$key]['size']))
                 <div>{{ __('front.size') .': '.$data[$key]['size']}}</div>
                @endif
              </li>
              <?php $total = $total + ($data[$key]['price']*$data[$key]['quantity']); ?>
            @endforeach
              <li class="total-price">
                <div>{{ __('front.subtotal') }} </div>
                <div>${{$total}}</div>
              </li>

              <li class="total-price">
                <div>{{ __('front.total') }}</div>
                <div>${{$total}}</div>
              </li>
              <li class="total-price">
                <div>{{ __('front.totalaftersale') }}</div>
                <div id="totalaftersale"></div>
              </li>

            </ul>

            <div class="text-center">
              <button class="btn btn-second" onclick="send_order()" >
                {{ __('front.checkout_done') }}
              </button>
            </div>
          </div>
        </div>
      <!--</form> -->
    </div>
  </section>
  <script>

    function salecode_apply()
    {
        if($("#salecode").val().trim() == ''){
          Swal.fire("{{ __('front.entersalecode') }}");
          event.preventDefault();
          return false;
        }else{
          var salecode = $("#salecode").val();

          $.ajax({
          url: '{{url("salecode-check")}}',
          type: 'POST',
          data: {
          "_token": "{{ csrf_token() }}",
          "salecode": salecode
          },
          async: false,
          success: function (data) {
            if($.isEmptyObject(data.error)){
                  var newprice = {{$total}} - ( {{$total}}*data.codeval/100 );
                  $("#totalaftersale").html(newprice+'$');
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
    }

    function add_address()
    {

      if($("#change_adress").prop("checked") == true){
          $("#newadress").show();
      }
      else if($("#change_adress").prop("checked") == false){
          $("#newadress").hide();
      }
    }

    function send_order()
    {
      var new_address ='';
      var salecode ='';
      if($("#change_adress").prop("checked") == true){
          if($("#newadressval").val().trim() == ''){
            Swal.fire("{{ __('front.enternewadress') }}");
            event.preventDefault();
            return false;
          }else{
            new_address = $("#newadressval").val();
          }

      }

        if($("#salecode").val().trim() != ''){
          salecode = $("#salecode").val();
        }

        $.ajax({
        url: '{{url("send-order")}}',
        type: 'POST',
        data: {
        "_token": "{{ csrf_token() }}",
        "salecode": salecode,
        "new_address": new_address
        },
        async: false,
        success: function (data) {
          if($.isEmptyObject(data.error)){
                Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: data.success,
                      showConfirmButton: false,
                      timer: 2500
                    });
              location.href ='{{url("done-order")}}';
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

  </script>
@endsection
