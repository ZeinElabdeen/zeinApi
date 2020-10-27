@extends('user.en.layouts.lay') @section('title','Photo-Gallery') @section('links')

<link rel="stylesheet" href="{{url('assets-en/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/Base.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/premium.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/gallery-photo.css')}}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">



@endsection @section('content')
<!--Start Header Section -->

<header>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="banner">
              {{-- <h2>About-US</h2> --}}
              <span class="text-light">Home / <span>gallery-photo</span>
          </div>
        </div>
      </div>
    </div>
</header>

<!--END Header Section -->

<!--Start Photo Section-->

<section class="photo">
    <div class="container">
        <div class="row">
            @foreach ($photos as $photo)
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="middle">
                    <div class="text">
                       <img src="{{asset('storage/images/noun_Zoom In_1448913.png')}}" style="width: 100%;">
                       {{ $photo['photo_title'] }}
                    </div>
                  </div>
                <a href="{{ asset('storage/images/gallery/'.$photo['photo_name']) }}" data-toggle="lightbox" data-gallery="example-gallery">
                    <img src="{{ asset('storage/images/gallery/'.$photo['photo_name']) }}" class="img-fluid">
                </a>
            </div>
            @endforeach


            <div class="col-sm-12 col-md-12 col-lg-12">
                    {{ $photosPage->links() }}
            </div>
        </div>
    </div>
</section>

<!--END photo Section-->

@endsection @section('scripts')
<script src="{{url('assets-en/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{url('assets-en/js/popper.min.js')}}"></script>
<script src="{{url('assets-en/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets-en/js/main.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>

<script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
</script>
@endsection
