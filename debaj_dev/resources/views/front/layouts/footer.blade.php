<section class="subscribe-section">
    <div class="container-fluid">
      <div class="bg-gray">
        <div class="row">
          <div class="col-lg-7">
            <h2>{{ __('front.subsc_title') }}</h2>
            <p>
              {{ __('front.subsc_desc') }}
            </p>
          </div>
          <div class="col-lg-5">
            <form onsubmit="subscribeFun(event)" id="subscribe-form" class="form-inline">
              <input type="email" class="form-control" name="subscribe_mail" id="subscribe_mail" placeholder="{{ __('front.mail') }}" required />
              <button type="submit" class="btn btn-second">{{ __('front.subscribe') }}</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-5">
          <ul class="list-inline list-links">
            <li class="list-inline-item"><a href="{{url('/')}}">{{ __('front.home') }}</a></li>
            <li class="list-inline-item"><a href="{{url('about-us')}}">{{ __('front.about') }}</a></li>
            <li class="list-inline-item"><a href="{{url('terms-and-conditions')}}">{{ __('front.terms') }}</a></li>
            <li class="list-inline-item"><a href="{{url('contact-us')}}">{{ __('front.contact') }}</a></li>
            <li class="list-inline-item"><a href="{{url('faq')}}">{{ __('front.fqs') }}</a></li>
            <li class="list-inline-item"><a href="{{url('my-account')}}">{{ __('front.my_account') }}</a></li>
          </ul>
        </div>
        <div class="col-lg-3">
          <p>&copy; {{ __('front.copyright') }}</p>
        </div>
        <div class="col-lg-4">
          <ul class="list-inline list-social">
          @if(!empty($social['facebook']))
            <li class="list-inline-item">
              <a href="{{ $social['facebook'] }}" target="_blank" ><i class="fab fa-facebook-f"></i></a>
            </li>
          @endif
          @if(!empty($social['instgram']))
            <li class="list-inline-item">
              <a href="{{ $social['instgram'] }}" target="_blank"><i class="fab fa-instagram"></i></a>
            </li>
            @endif
            @if(!empty($social['twiter']))
            <li class="list-inline-item">
              <a href="{{ $social['twiter'] }}" target="_blank"><i class="fab fa-twitter"></i></a>
            </li>
            @endif
            @if(!empty($social['pintrist']))
            <li class="list-inline-item">
              <a href="{{ $social['pintrist'] }}" target="_blank"><i class="fab fa-pinterest"></i></a>
            </li>
            @endif
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <script>

    function search_valdation(event)
    {
      if( $("#search_for").val().trim() == '')
      {
        Swal.fire(" {{ __('front.search_for_empty') }}");
        event.preventDefault();
        return false;
      }
    }

    function subscribeFun(event)
    {
      var submail= $("#subscribe_mail").val();

      if( submail.trim() == '')
      {
        Swal.fire(" {{ __('front.submail') }}");
        event.preventDefault();
        return false;
      }
      else{

        var data = {'submail':submail,"_token": "{{ csrf_token() }}",};
         $.ajax({
            url: '{{url("subscribe")}}',
            type: 'POST',
            data:data,
            async: false,
            success: function (data) {
                if(data == '1'){
                  Swal.fire("{{ __('front.subdone') }}");
                }
                else if(data == '0'){
                  Swal.fire("{{ __('front.suberror') }}");
                }
                else {
                  Swal.fire(data.submail[0]);
                }
              } ,
              error:function (xhr, ajaxOptions, thrownError){
                var ret = JSON.parse(xhr.responseText);
                //console.log(ret.errors.submail);
                Swal.fire("{{ __('front.submail') }}");
              }
          });

          $('#subscribe-form').trigger("reset");
          event.preventDefault();
			    return true;
     }
  }

  function add_cart(id,fromtype)
  {

    var color = '';
    var size_num  = 0.5;

    if( fromtype == 'details' )
    {
      var size_num = $("#prod-size_num").val();
      if ($("input[name='radioColor']").is(':checked')) {
         color = $("input[name='radioColor']:checked").val();
      }
      // if ( $("input[name='radioColor']").is(':checked')) {
      //    size = $("input[name='radioSize']:checked").val();
      // }
      var count = 1;
    }else{
      var count = 1;
    }
    //  var data = {'pro_count':count,'pro_id':id,"_token": "{{ csrf_token() }}",};
      var data = {'pro_count':count,'pro_id':id,'size_num':size_num,'color':color,"_token": "{{ csrf_token() }}",};
     $.ajax({
        url: '{{url("add-to-cart")}}',
        type: 'POST',
        data:data,
        async: false,
        success: function (data) {
          if($.isEmptyObject(data.error)){
                Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: '{{ __("front.add_cart") }}',
                      showConfirmButton: false,
                      timer: 1500
                    });
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
  function add_fav(id)
  {
    var data = {'pro_id':id,"_token": "{{ csrf_token() }}",};
     $.ajax({
        url: '{{url("add-to-favorite")}}',
        type: 'POST',
        data:data,
        async: false,
        success: function (data) {
          if($.isEmptyObject(data.error)){
             if(data.success == 'exist')
             {
               Swal.fire({
                     position: 'top-end',
                     icon: 'warning',
                     title: '{{ __("front.exist") }}',
                     showConfirmButton: false,
                     timer: 1500
                   });
             }else{
                Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: '{{ __("front.add_favorite") }}',
                      showConfirmButton: false,
                      timer: 1500
                    });
                    $('#favorite_notfi').html('<span>'+data.success+'</span>');
              }

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
  <!-- JavaScript Libraries -->
  <script src="{{asset('assets/front/'.app()->getLocale() )}}/js/jquery-3.3.1.min.js"></script>
  <script src="{{asset('assets/front/'.app()->getLocale() )}}/js/popper.min.js"></script>
  <script src="{{asset('assets/front/'.app()->getLocale() )}}/js/bootstrap.min.js"></script>
  <script src="{{asset('assets/front/'.app()->getLocale() )}}/js/all-fontawesome.min.js"></script>
  <script src="{{asset('assets/front/'.app()->getLocale() )}}/js/wow.min.js"></script>
  <script src="{{asset('assets/front/'.app()->getLocale() )}}/js/slick.min.js"></script>
  <script src="{{asset('assets/front/'.app()->getLocale() )}}/js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.all.min.js"></script>
  <!--Add the following script at the bottom of the web page (before </body></html>)-->
<script type="text/javascript">function add_chatinline(){var hccid=61122664;var nt=document.createElement("script");nt.async=true;nt.src="https://www.mylivechat.com/chatinline.aspx?hccid="+hccid;var ct=document.getElementsByTagName("script")[0];ct.parentNode.insertBefore(nt,ct);}
add_chatinline();</script>
</body>

</html>
