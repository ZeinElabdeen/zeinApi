@extends('user.ar.layouts.lay') @section('title','معرض الصور ') @section('links')

<link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/Base.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/premium.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/gallery-photo.css')}}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">



@endsection @section('content')
<!--Start Header Section -->

<header>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="banner">
              <h2>من نحن</h2>
              <span>الرئيسية / <span>معرض الصور</span>
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
                       <img src="{{asset('storage/images/noun_Zoom In_1448913.png')}}" >
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
<script src="{{url('assets/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{url('assets/js/popper.min.js')}}"></script>
<script src="{{url('assets/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/main.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>

<script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
</script>
@endsection
