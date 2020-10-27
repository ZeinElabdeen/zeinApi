{!! $data['message'] !!}
@isset($data['logo'])
<div style="margin: auto;width:200px">
    <img src="{{ $message->embed($data['logo'])}}" alt="logo" style="width:200px;height:150px">
</div>
@endisset
