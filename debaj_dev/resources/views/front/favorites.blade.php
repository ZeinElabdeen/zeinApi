@extends('front.layouts.app')
<!-- ============ Body content start ============= -->
@section('content')

<div class="page-header">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fas fa-home"></i> {{ __('front.home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('front.favorite') }}</li>
          </ol>
        </nav>
        <h2>{{ __('front.favorite') }}</h2>
      </div>
    </div>
  </header>

  <section class="cart-list">
    <div class="container">
    @if(!empty($data))
      <div class="head">
        <div class="row">
          <div class="col-md-6 col-lg-4">{{ __('front.product') }}</div>
          <div class="col-5 col-md-3 col-lg-2">{{ __('front.price') }}</div>
        </div>
      </div>
      <div class="body">
       @foreach ($data as $key => $value)
          <div class="cart-item" id="fav-{{$key}}">
            <div class="row">
              <div class="col-md-6 col-lg-4">
                <div class="product-item">
                  <div class="image"><img src="{{config('proudect_img'). $data[$key]['photo']}}" alt="{{$data[$key]['name_'.app()->getLocale()]}}"></div>
                  <h5>{{$data[$key]['name_'.app()->getLocale()]}}</h5>
                </div>
              </div>

              <div class="col-5 col-md-3 col-lg-2 price">${{$data[$key]['price']}}</div>

              <div class="col-lg-4">
                <div class="d-flex justify-content-between">
                <a class="btn btn-second" onclick="add_cart({{$key}},'list')" >
                  {{ __('front.add_cart') }}
                </a>
                  <button class="btn btn-transparent" onclick="remove_fav({{$key}})" type="button" data-toggle="tooltip" data-placement="top"
                    title="{{ __('front.remove') }}">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      @else
      <div class="col-lg-12">
        <div class="row align-items-center justify-content-center">
        <div class="col-lg-6 col-md-6">
          <i class="row align-items-center justify-content-center" style="position: inherit;top: 26px;" >
            <img src="{{asset('assets/front/'.app()->getLocale() )}}/img/icons/favorite.png"
              alt="Favorite" />
          </i>
          <h2 class="row align-items-center justify-content-center" style="padding: 40px;">
            {{ __('front.emptyfav') }}
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
    function remove_fav(id)
    {
      var data = {'pro_id':id,"_token": "{{ csrf_token() }}",};
       $.ajax({
          url: '{{url("remove-favorites")}}',
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
                      $('#fav-'+id).remove();
                      $('#favorite_notfi').html('<span>'+data.success+'</span>');

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
