<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1">

            <ul class="kt-menu__nav ">
                <li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true">
                    <a href="{{url('dashboard')}}" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon2-architecture-and-city"></i>
                        <span class="kt-menu__link-text">الرئيسية</span>
                    </a>
                </li>
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">الطلبات</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true">
                    <a href="{{url('dashboard/order/new')}}" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon2-calendar-6"></i>
                        <span class="kt-menu__link-text">الطلبات الجديدة</span>
                    </a>
                </li>

                <li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true">
                    <a href="{{url('dashboard/order/confirmed')}}" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon2-calendar-6"></i>
                        <span class="kt-menu__link-text">طلبات تم تأكيدها </span>
                    </a>
                </li>

                <li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true">
                    <a href="{{url('dashboard/order/underway')}}" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon2-calendar-6"></i>
                        <span class="kt-menu__link-text">طلبات تم شحنها </span>
                    </a>
                </li>

                <li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true">
                    <a href="{{url('dashboard/order/delivered')}}" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon2-calendar-6"></i>
                        <span class="kt-menu__link-text">طلبات تم تسليمها </span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true">
                    <a href="{{url('dashboard/order/canceled')}}" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon2-calendar-6"></i>
                        <span class="kt-menu__link-text">طلبات تم الغاءها </span>
                    </a>
                </li>

                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">المستخدمين</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true">
                    <a href="{{url('dashboard/user/all')}}" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon-users"></i>
                        <span class="kt-menu__link-text">مستخدمين</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true">
                    <a href="{{url('dashboard/admin/index')}}" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon-user-settings"></i>
                        <span class="kt-menu__link-text">مديرين</span>
                    </a>
                </li>
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">الإعلانات</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true">
                    <a href="{{url('dashboard/category/index')}}" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon2-layers-1"></i>
                        <span class="kt-menu__link-text">الأقسام</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true">
                    <a href="{{url('dashboard/size/index')}}" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon2-indent-dots"></i>
                        <span class="kt-menu__link-text">الأحجام</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true">
                    <a href="{{url('dashboard/coupon/index')}}" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon2-indent-dots"></i>
                        <span class="kt-menu__link-text">أكواد الخصم</span>
                    </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true">
                    <a href="{{url('dashboard/ad/index')}}" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon2-shopping-cart-1"></i>
                        <span class="kt-menu__link-text">الإعلانات</span>
                    </a>
                </li>


                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">الاعدادات</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>

                <li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true">
                    <a href="{{url('dashboard/setting/index')}}" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon2-gear"></i>
                        <span class="kt-menu__link-text">الاعدادات</span>
                    </a>
                </li>

                <li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true">
                    <a href="{{url('dashboard/contact-messages')}}" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon2-envelope"></i>
                        <span class="kt-menu__link-text">رسائل اتصل بنا</span>
                    </a>
                </li>

                <li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true">
                    <a href="{{url('dashboard/faq/index')}}" class="kt-menu__link ">
                        <i class="kt-menu__link-icon flaticon2-gear"></i>
                        <span class="kt-menu__link-text">الاسئلة الشائعة</span>
                    </a>
                </li>



                {{--                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">--}}
{{--                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">--}}
{{--                        <i class="kt-menu__link-icon flaticon2-contract" style="color: #5d78ff;"></i>--}}
{{--                        <span class="kt-menu__link-text" style="color: #5d78ff;">الطلبات</span>--}}
{{--                        <i class="kt-menu__ver-arrow la la-angle-right" style="color: #5d78ff;"></i>--}}
{{--                    </a>--}}
{{--                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>--}}
{{--                        <ul class="kt-menu__subnav">--}}
{{--                            <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Skins</span></span></li>--}}
{{--                            <li class="kt-menu__item " aria-haspopup="true"><a href="layout/skins/aside-light.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Light Aside</span></a></li>--}}
{{--                            <li class="kt-menu__item " aria-haspopup="true"><a href="layout/skins/header-dark.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Dark Header</span></a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </li>--}}

            </ul>
        </div>
    </div>

    <!-- end:: Aside Menu -->
</div>

<!-- end:: Aside -->
