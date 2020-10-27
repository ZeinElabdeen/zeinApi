@include('dashboard.layout.header')

<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
    <div class="kt-container  kt-container--fluid  kt-grid kt-grid--ver">

@include('dashboard.layout.aside')
        <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

@yield('content')
        </div>
    </div>
</div>
@include('dashboard.layout.footer')
