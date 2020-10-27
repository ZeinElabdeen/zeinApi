@extends('front.layouts.app')
<!-- ============ Body content start ============= -->
@section('content')

<div class="page-header">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fas fa-home"></i> {{ __('front.home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('front.contact') }}</li>
          </ol>
        </nav>
        <h2>{{ __('front.contact') }}</h2>
      </div>
    </div>
  </header>

  <section>
    <div class="container">
      <div class="section-title">
        <h3> {{ __('front.contact') }}</h3>
      </div>
      <div class="contact-us">

          <form id="contact_form" method="post" class="form" onsubmit="send_message(event)" >

            <div class="col-md-9 form-group mb-3">
                <label for=""> {{ __('front.name') }}</label>
                <input type="text" name="name" id="name" class="form-control" required >
            </div>

            <div class="col-md-9 form-group mb-3">
                <label for="">{{ __('front.mail') }} </label>
                <input type="email" name="mail" id="mail" class="form-control" required >
            </div>

            <div class="col-md-9 form-group mb-3">
                <label for="">{{ __('front.message') }} </label>
                <textarea rows="5" name="message" id="message" class="form-control" required ></textarea>
            </div>

            <div class="col-md-9 form-group mb-3">
                <button class="btn btn-second btn-block mt-4 mb-4" type="submit"> {{ __('front.submit') }} </button>
            </div>

          </form>

      </div>
  </section>

  <section class="our-features">
    <div class="container">
      <div class="row">

        <div class="col-md-6 col-lg-4">
          <div class="card feature-card">
            <div class="card-header">
              <img src="{{asset('assets/front/'.app()->getLocale() )}}/img/icons/Email.png" alt=" {{ __('front.email') }}">
            </div>
            <div class="card-body">
              <h5> {{ __('front.email') }}</h5>
              <p>{{$data['mail']}}</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card feature-card">
            <div class="card-header">
              <img src="{{asset('assets/front/'.app()->getLocale() )}}/img/icons/Phone.jpg" alt="{{ __('front.phone') }}">
            </div>
            <div class="card-body">
              <h5>{{ __('front.phone') }}</h5>
              <p>{{$data['mobile']}}</p>
              <p>{{$data['tel']}}</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card feature-card">
            <div class="card-header">
              <img src="{{asset('assets/front/'.app()->getLocale() )}}/img/icons/Place1.jpg" alt="{{ __('front.adress') }}">
            </div>
            <div class="card-body">
              <h5>{{ __('front.adress') }}</h5>
              <p>{{$data['adress_'.app()->getLocale()]}}</p>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="widget-googlemap ">
      		<div class="widget-content">
            {!!$data['map_fram']!!}
          </div>
        </div>
      </div>

    </div>

  </section>
  <script>
    function send_message(event)
    {
      if( $("#name").val().trim() == '' || $("#mail").val().trim() == '' || $("#message").val().trim() == '')
      {
        Swal.fire(" {{ __('front.alert_empty_data') }}");
        event.preventDefault();
        return false;
      }

       else{
          var data = $("#contact_form").serializeArray();
          data.push({name: "_token", value: "{{ csrf_token() }}"});
           $.ajax({
            url: '{{url("contact-us")}}',
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

          $('#contact_form').trigger("reset");
          event.preventDefault();
          return true;
     }
  }
  </script>
@endsection
