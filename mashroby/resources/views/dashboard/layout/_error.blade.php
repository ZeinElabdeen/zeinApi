
@if(session('error'))
    <div id="flashError" class="m-page-loader m-page-loader--base" style="text-align: center">
        <div class="m-blockui" style="text-align: center">
            <div class="alert alert-danger text-center">
                <span>{{session('error')}} </span>
                <span>
                <div class="m-loader m-loader--brand"></div>
            </span>
            </div>
        </div>
    </div>
@endif

@if(session('success'))
    <div id="flashError" class="m-page-loader m-page-loader--base" style="text-align: center">
        <div class="m-blockui" style="text-align: center">
            <div class="alert alert-success text-center">
                <span>{{session('success')}} </span>
                <span>
                <div class="m-loader m-loader--brand"></div>
            </span>
            </div>
        </div>
    </div>
@endif

@if(session('info'))
    <div id="flashError" class="m-page-loader m-page-loader--base" style="text-align: center">
        <div class="m-blockui" style="text-align: center">
            <div class="alert alert-info text-center">
                <span>{{session('info')}} </span>
                <span>
                <div class="m-loader m-loader--brand"></div>
            </span>
            </div>
        </div>
    </div>
@endif
