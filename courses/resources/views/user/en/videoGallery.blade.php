@extends('user.en.layouts.lay') @section('title','vedio') @section('links')

<link rel="stylesheet" href="{{url('assets-en/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/Base.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/premium.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/gallery-vedio.css')}}">
<link rel="stylesheet" href="{{url('assets-en/css/jquery.fancybox.css')}}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
@endsection @section('content')

<header>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="banner">
              {{-- <h2>About-us</h2> --}}
              <span class="text-light">Home / <span>Vedio Gallery</span>
          </div>
        </div>
      </div>
    </div>
  </header>
<!--END Header Section -->

<!--Start vedio Section -->

<section class="vedio">
    <div class="container">
        <div class="row">
            @foreach ($vedios as $vedio)
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="middle">
                        <div class="text">
                            <a class="fancybox" href="{{asset('storage/videos/'.$vedio['video_url']) }}">
                            <img src="{{asset('storage/videos/covers/'.$vedio['cover_photo'])}}" style="width: 100%;">
                                {{ $vedio['video_title'] }}
                        </div>
                    </div>
                    <img src="{{asset('storage/videos/covers/'.$vedio['cover_photo'])}}">
                </div>
            @endforeach
            <div class="col-sm-12 col-md-12 col-lg-12">
                {{ $vedioPage->links() }}

            </div>
        </div>
    </div>
</section>
@endsection @section('scripts')
<script src="{{url('assets-en/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{url('assets-en/js/popper.min.js')}}"></script>
<script src="{{url('assets-en/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets-en/js/main.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
<script src="{{url('assets-en/js/jquery.fancybox.js')}}"></script>
<script>
 $(function() {
   $(".fancybox").fancybox();

 });
</script>
@endsection
