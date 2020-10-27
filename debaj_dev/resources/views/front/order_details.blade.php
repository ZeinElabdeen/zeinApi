@extends('front.layouts.app')
<!-- ============ Body content start ============= -->
@section('content')

<div class="page-header">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fas fa-home"></i> {{ __('front.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{url('my-orders')}}">{{ __('front.my_orders') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('front.orders_details') }}</li>
          </ol>
        </nav>
        <h2>{{ __('front.orders_details') }}</h2>
      </div>
    </div>
  </header>

  <section class="cart-list">
    <div class="container">
      <div class="row">
      @if(!empty($order_details))
        <div class="col-lg-12">
          <form action="">
            <div class="head">
              <div class="row">
                <div class="col-md-5">{{ __('front.product') }}</div>
                <div class="col-3 col-md-3 col-lg-3">{{ __('front.orders_status') }}</div>
                <div class="col-3 col-md-3 col-lg-1">{{ __('front.price') }}</div>
                <div class="col-2 col-md-2 col-lg-1">{{ __('front.size_num') }}</div>
                <div class="col-2 col-md-2 col-lg-1">{{ __('front.subtotal') }}</div>
              </div>
            </div>
            <div class="body">
            <?php $total=0; ?>
            @foreach ($order_details as $row)
              <div class="cart-item" id="cart-{{$row['id']}}" >
                <div class="row">
                  <div class="col-md-5">
                    <div class="product-item">
                      <div class="image"><img src="{{config('proudect_img'). $row['photo']}}" alt="{{$row['name_'.app()->getLocale()]}}"></div>
                      <h5>{{$row['name_'.app()->getLocale()]}}</h5>
                      @if(!empty($row['color']))
                       <h5  style="width: 15px;height: 15px;border-radius: 9px;background:{{$row['color']}};margin-right: 10%;">&nbsp;&nbsp;</h5>
                      @endif

                       <h5 style="text-transform: capitalize;" >{{ __('front.vendor') .': '.$row->product->vendor->username}}</h5>
                   
                    </div>
                  </div>

                  <div class="col-3 col-md-3 col-lg-3">
                    {{ __('front.status_'.$row['order_item_status']) }}
                  </div>

                  <div class="col-3 col-md-3 col-lg-1 price">$ {{$row['price']}}</div>

                  <div class="col-2 col-md-2 col-lg-1">
                    <div class="counter">
                      <div class="form-inline">
                        <input class="prod-count-value form-control"  value=" {{$row['size_num']}}" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-2 col-md-2 col-lg-1 subtotal">$ {{$row['price']*$row['quantity']}}</div>

                </div>
              </div>
              <?php $total = $total + ($row['price']*$row['quantity']); ?>
            @endforeach


        </div>

          </form>
        </div>
        <div class="col-lg-12">
          <div class="head">

          </div>

          <div class="body">
            <ul class="list-unstyled order-review">
              <li>
                <div>{{ __('front.total') }}</div>
                <div id="total_div" >
                  ${{$total}}
                </div>
              </li>
              @if( !empty($order['salecode']) )
              <li>
                <div>{{ __('front.totalaftersale') }}</div>
                <div id="total_div" >
                  ${{$total - ($total * $order['salecode_value']/100)}}
                </div>
              </li>
              @endif
            </ul>

          </div>
        </div>

    </div>
  @endif
      </div>
    </div>
  </section>



@endsection
