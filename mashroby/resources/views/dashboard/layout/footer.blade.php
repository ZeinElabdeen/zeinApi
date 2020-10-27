
<!-- begin:: Footer -->
<div class="kt-footer kt-grid__item" id="kt_footer">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-footer__wrapper">
            <div class="kt-footer__copyright">

            </div>
        </div>
    </div>
</div>

<!-- end:: Footer -->
</div>
</div>
</div>

<!-- end:: Page -->

<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>

<!-- end::Scrolltop -->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "light": "#ffffff",
                "dark": "#282a3c",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>

<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->

<!--begin:: Vendor Plugins -->

<script src="{{asset("dashboard_assets/plugins/general/jquery/dist/jquery.js")}}" type="text/javascript"></script>
{{--<script src="{{asset("dashboard_assets/plugins/general/popper.js/dist/umd/popper.js")}}" type="text/javascript"></script>--}}
<script src="{{asset("dashboard_assets/plugins/general/bootstrap/dist/js/bootstrap.min.js")}}" type="text/javascript"></script>
{{--<script src="{{asset("dashboard_assets/plugins/general/sticky-js/dist/sticky.min.js")}}" type="text/javascript"></script>--}}
{{--<script src="{{asset("dashboard_assets/plugins/general/perfect-scrollbar/dist/perfect-scrollbar.js")}}" type="text/javascript"></script>--}}
{{--<script src="{{asset("dashboard_assets/plugins/general/bootstrap-notify/bootstrap-notify.min.js")}}" type="text/javascript"></script>--}}
{{--<script src="{{asset("dashboard_assets/plugins/general/js/global/integration/plugins/bootstrap-notify.init.js")}}" type="text/javascript"></script>--}}
{{--<script src="{{asset("dashboard_assets/plugins/general/jquery-validation/dist/jquery.validate.js")}}" type="text/javascript"></script>--}}
{{--<script src="{{asset("dashboard_assets/plugins/general/js/global/integration/plugins/jquery-validation.init.js")}}" type="text/javascript"></script>--}}
<!--end:: Vendor Plugins -->
{{--<script src="{{asset("dashboard_assets/js/scripts.bundle.js")}}" type="text/javascript"></script>--}}
@include('dashboard.include.js')
{{--<script type="text/javascript" charset="utf8"--}}
{{--        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>--}}

<script src="{{asset("dashboard_assets/datatables.script.js")}}" type="text/javascript"></script>
<script src="{{asset("dashboard_assets/datatables.min.js")}}" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $("#kt_table_1").DataTable({
            "language" : {
                "url" : "//cdn.datatables.net/plug-ins/1.10.20/i18n/Arabic.json"
            }
        });
    });

</script>

@yield('js')

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
<script>
    if ($("#flashError").length) {
        function removeError () {
            $("#flashError").remove();
        }
        setTimeout(removeError,4000);
    }

</script>
<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
{{--<script src="{{asset("dashboard_assets/js/pages/dashboard.js")}}" type="text/javascript"></script>--}}

<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>
