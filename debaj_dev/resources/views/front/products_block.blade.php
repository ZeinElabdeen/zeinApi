
        @foreach ($products as $row)
        <?php
              $pro_color = explode(',',$row['color']);
              $cat_url   = str_replace(' ', '-',strtolower($row['title_en']));
        ?>
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
                <p class="price">{{$row['price'].'$' }} <!--<del>$65.00</del>--></p>
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


      <!--    <nav aria-label="Page navigation example">
            productslinks
          </nav> -->
