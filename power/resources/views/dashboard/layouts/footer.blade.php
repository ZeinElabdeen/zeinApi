
    <!-- ============ Search UI End ============= -->
<script src="{{asset('assets')}}/js/vendor/jquery-3.3.1.min.js"></script>
<script src="{{asset('assets')}}/js/vendor/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets')}}/js/vendor/perfect-scrollbar.min.js"></script>
<script src="{{asset('assets')}}/js/vendor/echarts.min.js"></script>

    <script src="{{asset('assets')}}/js/es5/echart.options.min.js"></script>
    <script src="{{asset('assets')}}/js/es5/dashboard.v1.script.min.js"></script>

    <script src="{{asset('assets')}}/js/es5/script.min.js"></script>
    <script src="{{asset('assets')}}/js/es5/sidebar.large.script.min.js"></script>
    <script src="{{asset('assets')}}/js/vendor/sweetalert2.min.js"></script>
    <script src="{{asset('assets')}}/js/sweetalert.script.js"></script>
    <script src="{{asset('assets')}}/js/vendor/datatables.min.js"></script>
    <script src="{{asset('assets')}}/js/quill.script.js"></script>

    <!-- page custom js -->
    <script src="{{asset('assets')}}/js/datatables.script.js"></script>
    <script src="{{asset('assets')}}/js/form.validation.script.js"></script>
    <!-- quill js -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script src="{{asset('assets')}}/js/vendor/quill.min.js"></script>
    <script src="https://cdn.quilljs.com/1.0.5/quill.min.js" type="text/javascript"></script>

    <script>
        $("document").ready(function(){
            var quill = new Quill('#editor', {
                modules: {
                    toolbar: '#toolbar',

                },
                theme: 'snow'
            });
            setTimeout(function(){

                $("div.alert").css({"top": "100px"});
                $("div.alert").remove();

            }, 5000 );

        });
    </script>
    @yield('js')

    </body>

</html>
