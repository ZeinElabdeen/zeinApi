
{{--@if (count($errors->all()) > 0)--}}
{{--    <div class="alert alert-danger alert-block">--}}
{{--        <i class="fa fa-ban"></i>--}}
{{--        <button type="button" class="close" data-dismiss="alert"><i class="glyphicon glyphicon-remove"></i></button>--}}

{{--        <ul>--}}
{{--            @foreach($errors->all() as $message)--}}
{{--                <li>{{ $message }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block session-box">
        <i class="fa fa-check"></i>
        <button type="button" class="close" data-dismiss="alert"><i class="glyphicon glyphicon-remove"></i></button>
        @if(is_array($message))
            @foreach ($message as $m)
                <h4 class="text-success text-center">  {{ $m }}</h4>
            @endforeach
        @else
            <h4 style="text-align: center;">  {{ $message }}</h4>
        @endif
    </div>
@endif
@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block session-box">
        <i class="fa fa-ban"></i>
        <button type="button" class="close" data-dismiss="alert"><i class="glyphicon glyphicon-remove"></i></button>

        @if(is_array($message))
            @foreach ($message as $m)
                {{ $m }}
            @endforeach
        @else
            <h4 class="text-danger text-center" >{{ $message }}</h4>
        @endif
    </div>
@endif

@if ($message = Session::get('warning_message'))
    <div class="alert alert-warning alert-block session-box">
        <i class="fa fa-warning"></i>
        <button type="button" class="close" data-dismiss="alert"><i class="glyphicon glyphicon-remove"></i></button>

        @if(is_array($message))
            @foreach ($message as $m)
                {{ $m }}
            @endforeach
        @else
            <h4 style="text-align: center;"> {{ $message }}</h4>
        @endif
    </div>
@endif

@if ($message = Session::get('info_message'))
    <div class="alert alert-info alert-block session-box">
        <i class="fa fa-info"></i>
        <button type="button" class="close" data-dismiss="alert"><i class="glyphicon glyphicon-remove"></i></button>

        @if(is_array($message))
            @foreach ($message as $m)
                {{ $m }}
            @endforeach
        @else
            <h4 style="text-align: center;"> {{ $message }}</h4>
        @endif
    </div>
@endif
