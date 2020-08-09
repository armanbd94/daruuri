<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
    <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">

        <ul class="kt-menu__nav ">
        @foreach (Session::get('permitted_modules') as $menu)
            @if($menu->children->isEmpty())
            <li class="kt-menu__item  
            @if (Request::is('admin') && $menu->module_link == '/')
                {{'kt-menu__item--active'}}
            @endif
            {{ Request::is('admin'.'/'.$menu->module_link) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                    <a href="{{url('admin'.'/'.$menu->module_link)}}"
                    class="kt-menu__link "><span class="kt-menu__link-icon"><i class="{{$menu->module_icon}}"></i></span>
                    <span class="kt-menu__link-text">{{$menu->module_name}}</span>
                </a>
            </li>
            @else 
            <li class="kt-menu__item  kt-menu__item--submenu 
            @foreach ($menu->children as $submenu)
            {{ Request::is('admin'.'/'.$submenu->module_link) ? 'kt-menu__item--open' : '' }}
            @endforeach
            " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a  href="javascript:void(0);" class="kt-menu__link kt-menu__toggle">
                    <span class="kt-menu__link-icon"><i class="{{$menu->module_icon}}"></i></span>
                    <span class="kt-menu__link-text">{{$menu->module_name}}</span>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        @foreach ($menu->children as $submenu)
                        <li class="kt-menu__item {{ Request::is('admin'.'/'.$submenu->module_link) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                            <a  href="{{url('admin',$submenu->module_link)}}" class="kt-menu__link ">
                                <span class="kt-menu__link-icon"><i class="{{$submenu->module_icon}}"></i></span>
                                <span class="kt-menu__link-text">{{$submenu->module_name}}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </li>
            @endif
        @endforeach
        </ul>

    </div>
</div>
