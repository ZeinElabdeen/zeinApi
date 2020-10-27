@extends('front.layouts.app')
<!-- ============ Body content start ============= -->
@section('content')

<div class="page-header">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fas fa-home"></i> {{ __('front.home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $cat_details['title_'.app()->getLocale()] }}</li>
          </ol>
        </nav>
        <h2>{{ $cat_details['title_'.app()->getLocale()] }}</h2>
      </div>
    </div>
  </header>

  <section class="search-results">
    <div class="container">
      <div class="results-status">
        <p></p>
        <nav aria-label="Page navigation example">
            {{ $cat_products->links() }}
        </nav>
      </div>
      <div class="row">
        <div class="col-lg-3">
          <button class="btn show-filter">
            <i class="fas fa-filter"></i>
          </button>
          <button class="btn hide-filter">
            <i class="fas fa-times"></i>
          </button>
          <aside class="search-filter">
            <form action="" id="filtering">
              <div class="block">
                <h4 class="block-title">{{ __('front.sort_by') }}</h4>
                <ul class="list-group">
                  <li class="list-group-item">
                    <div class="custom-control custom-checkbox">
                      <input type="radio" class="custom-control-input" name="price_order" value="asc" id="check1">
                      <label class="custom-control-label" for="check1"> {{ __('front.price_filter1') }}</label>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="custom-control custom-checkbox">
                      <input type="radio" class="custom-control-input" name="price_order" value="desc"  id="check2">
                      <label class="custom-control-label" for="check2">{{ __('front.price_filter2') }}</label>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" name="newest_order" value="desc" id="check3">
                      <label class="custom-control-label" for="check3">{{ __('front.arrival_filter') }}</label>
                    </div>
                  </li>
                <!--  <li class="list-group-item">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="check4">
                      <label class="custom-control-label" for="check4">{{ __('front.popularity') }}</label>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="check5">
                      <label class="custom-control-label" for="check5">{{ __('front.rating_filter') }}</label>
                    </div>
                  </li>-->

                </ul>
              </div>

            <!--  <div class="block">
                <h4 class="block-title">{{ __('front.size') }}</h4>
                <ul class="list-group">
                  <li class="list-group-item">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" name="size[]" value="l" id="size1">
                      <label class="custom-control-label" for="size1"> L</label>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="size2" name="size[]" value="m">
                      <label class="custom-control-label"  for="size2"> M</label>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" value="s" name="size[]" id="size3">
                      <label class="custom-control-label"  for="size3">S</label>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" value="xl" name="size[]" id="size4">
                      <label class="custom-control-label"  for="size4"> XL</label>
                    </div>
                  </li>
                </ul>
              </div> -->
              <div class="block">
                <h4 class="block-title">{{ __('front.color') }}</h4>
                <ul class="list-group">
                @foreach($colors as $row)
                  <li class="list-group-item">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" name="color[]" value="{{$row['id']}}" id="color{{$row['id']}}">
                      <label class="custom-control-label" for="color{{$row['id']}}"><span class="color"
                          style="background-color: {{$row['code']}}"></span> {{$row['name_'.app()->getLocale()]}}</label>
                    </div>
                  </li>
                @endforeach
                </ul>
              </div>
            </form>
              <div class="block">
                <h4 class="block-title">{{ __('front.tags') }}</h4>
                <?php $tags = explode(",",$cat_details['tags_'.app()->getLocale()]) ;?>
                @foreach ($tags as $key => $value)
                <div class="custom-control custom-radio custom-control-inline radio-btn">
                  <input type="checkbox" id="checkInline{{$key}}" name="checkInline" class="custom-control-input">
                  <label class="custom-control-label" for="checkInline{{$key}}">{{$value}}</label>
                </div>
                @endforeach



              </div>

          </aside>
        </div>
        <div class="col-lg-9"  >
        <div  id="pro_container" >
        @foreach ($cat_products as $row)
        <?php $pro_color = explode(',',$row['color']) ?>
          <div class="card product-card product-large-card">
            <div class="card-header">
            <!--  <span class="badge sale-badge">sale</span>-->
              <img src="{{config('proudect_img'). $row['main_image']}}" alt="{{$row['name_'.app()->getLocale()]}}">
              <ul class="list-inline switch-color">

                @foreach ($pro_color as $key => $value)
                    <li class="list-inline-item">
                      <a><span class="color" data-toggle="tooltip" data-placement="top" title="{{$color_to_find_names[$value]}}"
                          style="background-color:{{$color_to_find[$value]}};"></span></a>
                    </li>
                @endforeach

              </ul>
            </div>
            <?php $pro_url = str_replace(' ', '-',strtolower($row['name_en'])) ;?>

            <div class="card-body">
              <a href="{{url('categories/'.$cat_url.'/'.$pro_url.'/'.$row['id'])}}">
                <h4 class="card-title">
                  {{$row['name_'.app()->getLocale()]}}
                </h4>
                @if($row['sale_percentage'] > 0)
                <?php $price_discount = $row['price'] - ($row['price']*$row['sale_percentage']/100); ?>
                <p class="price">{{$price_discount .'$' }} <del>{{$row['price'].'$' }}</del></p>
                @else
                <p class="price">{{$row['price'].'$' }} </p>
                @endif
                <p class="description">
                    {!! strip_tags(Str::words($row['shortDetails_'.app()->getLocale()], '50')); !!}

                </p>
              </a>
              <ul class="list-inline options">
              <li class="list-inline-item">
                <a onclick="add_fav({{$row['id']}})" >
                  <img src="{{asset('assets/front/'.app()->getLocale() )}}/img/icons/favorite.png" alt="{{ __('front.favorite') }}">
                </a>
              </li>
                <li class="list-inline-item">
                  <a onclick="add_cart({{$row['id']}},'list')" >
                  {{ __('front.add_cart') }}</a></li>
              </ul>
            </div>
          </div>
        @endforeach
    </div>

          <nav aria-label="Page navigation example">
            {{ $cat_products->links() }}
          </nav>
        </div>
      </div>
    </div>
  </section>
  <script>

    document.addEventListener("DOMContentLoaded", function(event) {

      $("#filtering :input").change(function() {
        // $("#filtering").data("changed",true);
        var data = $("#filtering").serializeArray();
            data.push({name: "cat_id", value: "{{ $cat_details['id'] }}"});
            data.push({name: "_token", value: "{{ csrf_token() }}"});
          console.log(data);
        $.ajax({
         url: '{{url("filtering")}}',
         type: 'POST',
         data:data,
         async: false,
         success: function (data) {
           if($.isEmptyObject(data.error)){
             $("#pro_container").html(data.filtering_data);
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

      });
    });
  </script>

@endsection
