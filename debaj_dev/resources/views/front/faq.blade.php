@extends('front.layouts.app')
<!-- ============ Body content start ============= -->
@section('content')

<div class="page-header">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fas fa-home"></i> {{ __('front.home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('front.fqs') }}</li>
          </ol>
        </nav>
        <h2>{{ __('front.fqs') }}</h2>
      </div>
    </div>
  </header>

  <section>
    <div class="container">
      <div class="section-title">
        <h3> {{ __('front.fqstitle') }}</h3>
      </div>
      <div class="accordion faqAccordion" id="faqAccordion">
    <?php $i=1;?>
    @foreach($data as $row )
        <div class="card">
          <div class="card-header" id="heading{{$i}}">
            <h2 class="mb-0">
              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#faq{{$i}}"
                aria-expanded="true" aria-controls="faq{{$i}}">
                <span class="icon-box"><i class="fas fa-plus icon"></i></span>
                 {{$row['question_'.app()->getLocale()]}}
              </button>
            </h2>
          </div>

          <div id="faq{{$i}}" class="collapse" aria-labelledby="heading{{$i}}" data-parent="#faqAccordion">
            <div class="card-body">
              <p>
                {{$row['answer_'.app()->getLocale()]}}
              </p>
            </div>
          </div>
        </div>
        <?php $i++;?>
      @endforeach




      </div>
    </div>
  </section>

@endsection
