<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

    <!-- begin:: Header Menu -->
    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
            
        </div>
    </div>

    <!-- end:: Header Menu -->

    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">


        <!--begin: Notifications -->
        @if (permission('customer-feedback-view'))
        <div class="kt-header__topbar-item dropdown">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="false">
                <span class="kt-header__topbar-icon @if (Auth::user()->unreadNotifications->count() > 0) kt-pulse kt-pulse--brand @endif">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                            <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                            <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" id="Combined-Shape" fill="#000000"></path>
                        </g>
                    </svg> <span class="kt-pulse__ring"></span>
                </span>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg" x-placement="top-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-246px, 5px, 0px);">

                    <!--begin: Head -->
                    <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" style="background-image: url(images/bg-1.jpg)">
                        <h3 class="kt-head__title">
                            Notifications
                            &nbsp;
                            <span class="btn btn-success btn-sm btn-bold btn-font-md">{{Auth::user()->unreadNotifications->count()}} new</span>
                        </h3>
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-success kt-notification-item-padding-x" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications" role="tab" aria-selected="true">Customer Feedback</a>
                            </li>
                        </ul>
                    </div>

                    <!--end: Head -->
                    <div class="tab-content">
                        <div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
                            
                            @if (Auth::user()->unreadNotifications->count() > 0)
                            <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll ps ps--active-y"
                                data-scroll="true" data-height="300" data-mobile-height="200"
                                style="height: 300px;">
                                <div style="overflow-y: scroll;height:250px;">
                                    @foreach (Auth::user()->unreadNotifications as $item)
                                    <a href="{{route('admin.read.notification',['id'=>$item->id])}}" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="fas fa-comment-dots kt-font-success"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title">
                                                <b>{{$item->data['name']}}</b><br>
                                                <span>{{read_more($item->data['description'], $limit = 60)}}</span>
                                            </div>
                                            <div class="kt-notification__item-time">
                                                {{$item->created_at->diffForHumans()}}
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                                
                                
                                <div class="kt-notification__item-details">
                                    <div class="kt-notification__item-title" style="padding: 10px 15px;">
                                        <a href="{{route('admin.mark.all.read')}}" class="btn btn-sm btn-primary float-left ">
                                            <b>Mark All As Read</b>
                                        </a>
                                        <a href="{{route('admin.delete.all.notification')}}" class="btn btn-sm btn-danger float-right">
                                        <b>Delete All</b>
                                        </a>
                                    </div>
                                </div>
                                
                            </div>
                            @else
                            <div class="kt-grid kt-grid--ver" style="min-height: 200px;">
                                <div
                                    class="kt-grid kt-grid--hor kt-grid__item kt-grid__item--fluid kt-grid__item--middle">
                                    <div class="kt-grid__item kt-grid__item--middle kt-align-center">
                                        All caught up!
                                        <br>No new notifications.
                                    </div>
                                </div>
                            </div>
                            @endif
                            

                           
                        </div>
                    </div>
            </div>
        </div>
        @endif
        <!--end: Notifications -->


        <!--begin: User Bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                <div class="kt-header__topbar-user">
                    <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
                    <span class="kt-header__topbar-username kt-hidden-mobile">{{explode(' ',Auth::user()->name)[0]}}</span>
                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                    <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{Auth::user()->name[0]}}</span>
                </div>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                <!--begin: Head -->
                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(images/bg-1.jpg)">
                    <div class="kt-user-card__avatar">
                        @if (!empty(Auth::user()->avatar))
                            <img alt="{{explode(' ',Auth::user()->name)[0]}}" src="storage/user/{{Auth::user()->avatar}}" style="max-width:6rahman.ali@gmail.com0px;" />
                        @else 
                            <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                            <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">{{Auth::user()->name[0]}}</span>
                        @endif
                    </div>
                    <div class="kt-user-card__name">
                        {{Auth::user()->name}}
                    </div>
                    {{-- <div class="kt-user-card__badge">
                        <span class="btn btn-success btn-sm btn-bold btn-font-md">23 messages</span>
                    </div> --}}
                </div>

                <!--end: Head -->

                <!--begin: Navigation -->
                <div class="kt-notification">
                    <a href="{{route('admin.profile')}}" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-calendar-3 kt-font-success"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold">
                                My Profile
                            </div>
                        </div>
                    </a>
                    <div class="kt-notification__custom kt-space-between">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                        class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>

                <!--end: Navigation -->
            </div>
        </div>

        <!--end: User Bar -->
    </div>

    <!-- end:: Header Topbar -->
</div>
