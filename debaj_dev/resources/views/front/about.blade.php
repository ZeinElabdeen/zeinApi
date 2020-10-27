@extends('front.layouts.app')
<!-- ============ Body content start ============= -->
@section('content')

<div class="page-header">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fas fa-home"></i> {{ __('front.home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$data['title_'.app()->getLocale()]}}</li>
          </ol>
        </nav>
        <h2>{{$data['title_'.app()->getLocale()]}}</h2>
      </div>
    </div>
  </header>

  <section>
    <div class="container">
      <div class="section-title">
        <h3> {{$data['title_'.app()->getLocale()]}}</h3>
      </div>
      <div class="accordion faqAccordion" id="faqAccordion">

        <div class="card">

            <div class="card-body">
              <p>
                 {!!$data['content_'.app()->getLocale()]!!}
              </p>

          </div>
        </div>





      </div>
    </div>
  </section>

@endsection
