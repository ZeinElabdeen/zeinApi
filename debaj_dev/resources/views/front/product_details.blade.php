@extends('front.layouts.app')
<!-- ============ Body content start ============= -->
@section('content')
<div class="page-header">
     <div class="container">
       <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fas fa-home"></i> {{ __('front.home') }}</a></li>
           <li class="breadcrumb-item"><a href="{{url('/categories/'.str_replace(' ', '-',strtolower($cat_details['title_en'])))}}">{{ $cat_details['title_'.app()->getLocale()] }}</a></li>
           <li class="breadcrumb-item active" aria-current="page">{{ $product['name_'.app()->getLocale()] }}</li>
         </ol>
       </nav>
       <h2>{{ $product['name_'.app()->getLocale()] }}</h2>
     </div>
   </div>
 </header>

 <section class="product-details">
   <div class="container">
     <div class="row">
       <div class="col-lg-6">
         <div class="product-slider">
           <div class="slider-for">
            @foreach($product_img as $row)
             <div class="item">
               <img src="{{config('proudect_img'). $row['imageName']}}" alt="{{ $product['name_en'].'-'. $row['id']}}">
             </div>
            @endforeach
           </div>
           <div class="slider-nav">
             @foreach($product_img as $row)
             <div class="item"><img src="{{config('proudect_img'). $row['imageName']}}" alt="slider img"></div>
             @endforeach
           </div>
         </div>
       </div>
       <div class="col-lg-6">
         <form action="">
           <div class="info">
             <h1>{{ $product['name_'.app()->getLocale()] }}
             </h1>
             <p>{{ __('front.ref') }}. {{ $product['ref']}}</p>
             <h5 data-toggle="tooltip" data-placement="top" title="{{ __('front.vendor')}}">{{$product->vendor->username}}</h5>
             @if($product['sale_percentage'] > 0)
             <?php $price_discount = $product['price'] - ($product['price']*$product['sale_percentage']/100); ?>
             <h4 class="price">{{$price_discount .'$' }} <del>{{$product['price'].'$' }}</del></h4>
             @else
             <h4 class="price">$ {{ $product['price']}}</h4>
             <p>
             @endif
             <p>
               {!! $product['shortDetails_'.app()->getLocale()] !!}
             </p>
             <?php $pro_color = explode(',',$product['color']) ?>
             <div class="product-option">
               <span>{{ __('front.color') }}: </span>
               @foreach ($pro_color as $key => $value)
                 <div class="custom-control custom-radio custom-control-inline radio-color">
                   <input type="radio" id="radioColor{{$key}}" name="radioColor" value="{{$color_to_find[$value]}}" class="custom-control-input">
                   <label class="custom-control-label" for="radioColor{{$key}}" data-toggle="tooltip" data-placement="top"
                     title="{{$color_to_find_names[$value]}}" style="background-color: {{$color_to_find[$value]}};"></label>
                 </div>
               @endforeach

             </div>


             <div class="product-option">
              <span>   {{ __('front.size_num') }} </span>
               <div class="counter">
                 <div class="form-inline">
                   <div class="input-group-text minuse-btn">
                     <i class="fas fa-minus"></i>
                   </div>
                   <input class="prod-count-value form-control"  id="prod-size_num" value="0.5" readonly>
                   <div class="input-group-text add-btn">
                     <i class="fas fa-plus"></i>
                   </div>
                 </div>
               </div>
               <a class="btn btn-second" onclick="add_cart({{$product['id']}},'details')" >
                 {{ __('front.add_cart') }}
               </a>
               <a onclick="add_fav({{$product['id']}})" class="btn btn-like">
                 <img src="{{asset('assets/front/'.app()->getLocale() )}}/img/icons/favorite.png" alt="{{ __('front.favorite') }}">
               </a>
             </div>
             <ul class="list-unstyled more-info">

               <li><span>{{ __('front.cat') }}:</span>
                 <p>{{ $cat_details['title_'.app()->getLocale()] }}</p>
               </li>
              <li><span> {{ __('front.tags') }}:</span>
                 <p> {{ $cat_details['tags_'.app()->getLocale()] }} </p>
               </li>
               <!--  <li>
                 <span>Share on:</span>
                 <p>
                   <a href=""><i class="fab fa-facebook-f icon"></i></a>
                   <a href=""><i class="fab fa-twitter icon"></i></a>
                   <a href=""><i class="fab fa-instagram icon"></i></a>
                   <a href=""><i class="fab fa-pinterest icon"></i></a>
                 </p>
               </li> -->
             </ul>
           </div>
         </form>
       </div>
     </div>
     <!-- Nav tabs -->
     <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
       <li class="nav-item">
         <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info"
           aria-selected="true">{{ __('front.descrip') }} </a>
       </li>
       <li class="nav-item">
         <a class="nav-link" id="services-tab" data-toggle="tab" href="#services" role="tab" aria-controls="services"
           aria-selected="false"> {{ __('front.addition_info') }} </a>
       </li>
       <li class="nav-item">
         <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews"
           aria-selected="false"> {{ __('front.reviews') }} ({{sizeof($comments)}})</a>
       </li>
     </ul>
     <!-- Tab panes -->
     <div class="tab-content">
       <div class="tab-pane active" id="info" role="tabpanel" aria-labelledby="info-tab">
         <p>
          {!! $product['description_'.app()->getLocale()] !!}
         </p>

       </div>

       <div class="tab-pane" id="services" role="tabpanel" aria-labelledby="services-tab">
         <p>
           {!! $product['additionalInfo_'.app()->getLocale()] !!}
         </p>
       </div>
       <div class="tab-pane" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
         <ul class="list-unstyled reviews-list">
          @if(!empty($comments))
          @foreach($comments as $row )
             <li class="media">
               <img style="visibility: hidden;" src="{{asset('assets/front/'.app()->getLocale() )}}/img/dynamic/user.png" class="mr-3" alt="media img">
               <div class="media-body">
                 <h5 class="mt-0 mb-1"> {{$row['name']}}</h5>
                 <span>{{date( 'd/m/Y', strtotime($row['created_at']) )}}</span>
                 <div class="rates readonly">
                   @for($i=0;$i<$row['stars'];$i++)
                     <i class="fas fa-star active"></i>
                   @endfor
                   @for($i=0; $i < ( 5-$row['stars']) ;$i++)
                     <i class="fas fa-star"></i>
                   @endfor
                 </div>
                 <p>
                   {{$row['comment']}}
                 </p>
               </div>
             </li>
           @endforeach
          @endif
         </ul>
         <form onsubmit="add_review()" id="add_review" class="add-review">
           <h5>{{ __('front.addreviews') }}</h5>
           <div class="row">
             <div class="col-lg-6">
               <input type="text" class="form-control" name="name"  id="name" required placeholder="{{ __('front.name') }}*">
             </div>
             <div class="col-lg-6">
               <input type="email" class="form-control"  name="email" id="email" required placeholder="{{ __('front.email') }}*">
             </div>
           </div>
           <div class="add-rates">
             <h5>{{ __('front.your_rate') }}</h5>
             <div class="rating">
               <label>
                 <input type="radio" name="stars"  value="1">
                 <span class="icon">
                   <i class="fas fa-star"></i>
                 </span>
               </label>
               <label>
                 <input type="radio" name="stars" value="2">
                 <span class="icon">
                   <i class="fas fa-star"></i>
                 </span>
                 <span class="icon">
                   <i class="fas fa-star"></i>
                 </span>
               </label>
               <label>
                 <input type="radio" name="stars" value="3">
                 <span class="icon">
                   <i class="fas fa-star"></i>
                 </span>
                 <span class="icon">
                   <i class="fas fa-star"></i>
                 </span>
                 <span class="icon">
                   <i class="fas fa-star"></i>
                 </span>
               </label>
               <label>
                 <input type="radio" name="stars" value="4">
                 <span class="icon">
                   <i class="fas fa-star"></i>
                 </span>
                 <span class="icon">
                   <i class="fas fa-star"></i>
                 </span>
                 <span class="icon">
                   <i class="fas fa-star"></i>
                 </span>
                 <span class="icon">
                   <i class="fas fa-star"></i>
                 </span>
               </label>
               <label>
                 <input type="radio" name="stars" value="5">
                 <span class="icon">
                   <i class="fas fa-star"></i>
                 </span>
                 <span class="icon">
                   <i class="fas fa-star"></i>
                 </span>
                 <span class="icon">
                   <i class="fas fa-star"></i>
                 </span>
                 <span class="icon">
                   <i class="fas fa-star"></i>
                 </span>
                 <span class="icon">
                   <i class="fas fa-star"></i>
                 </span>
               </label>
             </div>
           </div>
           <textarea rows="6" class="form-control" name="comment" id="comment" placeholder="{{ __('front.review') }}"></textarea>
           <button class="btn btn-second" type="submit">{{ __('front.submit') }}</button>
         </form>
       </div>
     </div>
   </div>
 </section>

 <section class="items-slider">
   <div class="container">
     <div class="section-title align-items-center">
       <h3>{{ __('front.related_products') }}</h3>
     </div>
     <div class="items">
    @foreach ($product_related as $row)
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
           <a href="{{url('categories/'.str_replace(' ', '-',strtolower($cat_details['title_en'])).'/'.$pro_url.'/'.$row['id'])}}">
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

 <script>
   function add_review(){

     if( $("#name").val().trim() == ''   || $("#email").val().trim() == ''|| !$("input[name='stars']").is(':checked'))
     {
       Swal.fire(" {{ __('front.alert_empty_data') }}");
       event.preventDefault();
       return false;
     }
     else{
        var data = $("#add_review").serializeArray();
        data.push({name: "pro_id", value: "{{ $product['id'] }}"});
        data.push({name: "vendor_id", value: "{{ $product['vendor_id'] }}"});
        data.push({name: "_token", value: "{{ csrf_token() }}"});
         $.ajax({
          url: '{{url("add-review")}}',
          type: 'POST',
          data:data,
          async: false,
          success: function (data) {
            if($.isEmptyObject(data.error)){
                  Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: data.success,
                        showConfirmButton: false,
                        timer: 1500
                      });
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

        $('#add_review').trigger("reset");
        event.preventDefault();
        return true;
     }

   }
 </script>
@endsection
