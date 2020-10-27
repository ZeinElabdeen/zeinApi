@extends('front.layouts.app')
<!-- ============ Body content start ============= -->
@section('content')

<div class="container-fluid">
      <div class="home-slider">

    @foreach($sliders as $row)
        <div class="item">
          <div class="row">
            <div class="col-sm-6 col-md-5 col-lg-4">
              @if(!empty($row['text_'.app()->getLocale()]))
               <h3>{{$row['text_'.app()->getLocale()]}}</h3>
              @endif
              @if(!empty($row['link']))
               <a href="{{$row['link'] }}" target="_blank" class="btn btn-white">    {{ __('front.shopnow') }} <i class="icon fas fa-chevron-right"></i></a>
              @endif
            </div>
            <div class="col-sm-6 col-md-7 col-lg-8">
              <img src="{{config('ad_storage'). $row['image']}}" alt="{{$row['text_'.app()->getLocale()]}}" class="img-fluid" />
            </div>
          </div>
        </div>
      @endforeach

      </div>
    </div>
  </header>

  <section>
    <div class="container-fluid">
      <div class="row">

        <?php $i=1; ?>
        @foreach($cats as $cat)
        <?php $cat_url = str_replace(' ', '-',strtolower($cat['title_en'])) ;?>
        @if($i == 1)
        <div class="col-lg-6">
          <a href="{{url('categories/'.$cat_url)}}">
            <div class="card category-card large-category">
              <div class="card-header">
                <img src="{{config('category_storage'). $cat['image']}}" alt="{{$cat['title_'.app()->getLocale()]}}" />
              </div>
              <div class="card-body">
                <h4 class="card-title">{{$cat['title_'.app()->getLocale()]}}</h4>
              </div>
            </div>
          </a>
        </div>
      @endif

          @if($i == 2)
          <div class="col-lg-6">
            <div class="row">
            <div class="col-md-6">
              <a href="{{url('categories/'.$cat_url)}}">
                <div class="card category-card">
                  <div class="card-header">
                    <img src="{{config('category_storage'). $cat['image']}}" alt="{{$cat['title_'.app()->getLocale()]}}" />
                  </div>
                  <div class="card-body">
                    <h4 class="card-title">{{$cat['title_'.app()->getLocale()]}}</h4>
                  </div>
                </div>
              </a>
            </div>
          @elseif($i == 3)
            <div class="col-md-6">
              <a href="{{url('categories/'.$cat_url)}}">
                <div class="card category-card">
                  <div class="card-header">
                    <img src="{{config('category_storage'). $cat['image']}}" alt="{{$cat['title_'.app()->getLocale()]}}" />
                  </div>
                  <div class="card-body">
                    <h4 class="card-title">{{$cat['title_'.app()->getLocale()]}}</h4>
                  </div>
                </div>
              </a>
            </div>
          </div>
        @elseif($i == 4)
          <a href="{{url('categories/'.$cat_url)}}">
            <div class="card category-card">
              <div class="card-header">
                <img src="{{config('category_storage'). $cat['image']}}" alt="{{$cat['title_'.app()->getLocale()]}}" />
              </div>
              <div class="card-body">
                <h4 class="card-title">{{$cat['title_'.app()->getLocale()]}}</h4>
              </div>
            </div>
          </a>
        </div>
        @endif

      @if($i > 4 )
        <div class="col-md-6 col-lg-3">
          <a href="{{url('categories/'.$cat_url)}}">

            <div class="card category-card">
              <div class="card-header">
                <img src="{{config('category_storage'). $cat['image']}}" alt="{{$cat['title_'.app()->getLocale()]}}" />
              </div>
              <div class="card-body">
                <h4 class="card-title">{{$cat['title_'.app()->getLocale()]}}</h4>
              </div>
            </div>
          </a>
        </div>
        @endif
        <?php $i++; ?>
        @endforeach

      </div>
    </div>
  </section>

  <section class="items-slider">
    <div class="container">
      <div class="section-title align-items-center">
        <h3>{{ __('front.sales') }}</h3>
      </div>
      <div class="items">
     @foreach ($products_sale as $row)
     <?php $pro_url = str_replace(' ', '-',strtolower($row['name_en'])) ;?>
        <div class="card product-card">
          <div class="card-header">
            <img src="{{config('proudect_img'). $row['main_image']}}" alt="{{$row['name_'.app()->getLocale()]}}">
            <ul class="list-inline options">
              <li class="list-inline-item">
                <a onclick="add_fav({{$row['id']}})">
                <img src="{{asset('assets/front/'.app()->getLocale() )}}/img/icons/favorite.png" alt="{{ __('front.favorite') }}">
                </a>
              </li>
              <li class="list-inline-item">
                <a onclick="add_cart({{$row['id']}},'list')" >
                  {{ __('front.add_cart') }}
                </a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <a href="{{url('categories/'.str_replace(' ', '-',strtolower($row->category['title_en'])).'/'.$pro_url.'/'.$row['id'])}}">
              <h4 class="card-title">
               {{$row['name_'.app()->getLocale()]}}
              </h4>
               @if($row['sale_percentage'] > 0)
              <?php $price_discount = $row['price'] - ($row['price']*$row['sale_percentage']/100); ?>
              <p class="price">{{$price_discount .'$' }} <del>{{$row['price'].'$' }}</del></p>
              @else
              <p class="price">{{$row['price'].'$' }} </p>
              @endif
            </a>
          </div>
        </div>
     @endforeach


      </div>
    </div>
  </section>

@endsection
