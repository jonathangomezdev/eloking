<div class="menu">
    <a href="{{ URL::to('/panel/orders') }}" class="logo">
        <img width="48" height="88" src="{{ asset('img/logo.svg') }}" alt="Eloking Logo" />
    </a>

    <div class="hamburger">
        <div></div>
        <span></span>
        <span></span>
        <span></span>
        <div></div>
    </div>

    <div class="navigation-wrapper">
        <div class="navigation">
            @if (auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('booster')))
                <a href="{{ URL::to('/panel/booster/payouts') }}" {!! (request()->is('panel/booster/payouts*')) ? 'class="active"' :
                    '' !!}>
                    <img src="{{ asset('img/panel/icons/cash.svg') }}" alt="Payouts" />
                    <div class="title">
                        Payouts
                    </div>
                </a>
            @endif
            @role('booster')
                <a href="{{ URL::to('/panel/jobs') }}" {!! (request()->is('panel/jobs*')) ? 'class="active"' :
                    '' !!}>
                    <img src="{{ asset('img/panel/icons/job.svg') }}" alt="Booster jobs" />
                    <div class="title">
                        Jobs
                    </div>
                </a>
            @endrole
            @if(auth()->user()->hasRole('accountant'))
                <a href="{{ URL::to('/panel/booster/payouts') }}" {!! (request()->is('panel/booster/payouts*')) ? 'class="active"' :
                '' !!}>
                    <img src="{{ asset('img/panel/icons/cash.svg') }}" alt="Payouts" />
                    <div class="title">
                        Payouts
                    </div>
                </a>
                <a href="{{ URL::to('/panel/report') }}" {!! (request()->is('panel/report*')) ? 'class="active"' : '' !!}>
                    <img src="{{ asset('img/panel/icons/report.svg') }}" alt="Report" />
                    <div class="title">
                        Report
                    </div>
                </a>
            @else
                <a href="{{ URL::to('/panel/orders') }}" {!! (request()->is('panel/orders*')) ? 'class="active"' : '' !!}>
                    <img src="{{ asset('img/panel/icons/cart.svg') }}" alt="Orders" />
                    <div class="title">
                        My Orders
                    </div>
                </a>
                <a href="{{ URL::to('/panel/help') }}" {!! (request()->is('panel/help*')) ? 'class="active"' : '' !!}>
                    <img src="{{ asset('img/panel/icons/help.svg') }}" alt="Help" />
                    <div class="title">
                        Help & Support
                    </div>
                </a>
                <a href="javascript:void(0);" id="notifications">
                    <div class="notification-count-wrapper">
                        @if (auth()->user()->unreadNotifications()->count() > 0)
                            <div class="noti-header__counter counter">
                                <div class="number notification-count">
                                    {{ auth()->user()->unreadNotifications()->count() }}
                                </div>
                            </div>
                        @endif
                    </div>
                    <img src="{{ asset('img/panel/icons/notifications.svg') }}" alt="Notifications" />
                    <div class="title">
                        Notifications
                    </div>
                </a>
            @endif
        </div>

        <div class="profile-menu">
            <input type="checkbox" id="loginmenu">
            <label for="loginmenu">
                <div {!! (request()->is('panel/profile*')) ? 'class="profile active"' : 'class="profile"' !!}>
                    <div class="user-letter {{ auth()->user()->firstLetter() }}">
                        {{ ucfirst(auth()->user()->firstLetter()) }}
                    </div>
                </div>
            </label>
            <nav class="login-menu-wrap">
                <div class="login-menu-wrap__user">
                    {{ auth()->user()->name ?: 'My Profile' }}
                </div>
                <ul class="login-menu">
                    <li class="login-menu__item">
                        <a href="{{ URL::to('/panel/profile') }}" class="login-menu__link">
                            <div class="user-letter {{ auth()->user()->firstLetter() }}">
                                <span class="user-status-dot online"></span>
                                {{ ucfirst(auth()->user()->firstLetter()) }}
                            </div>
                            Profile
                        </a>
                    </li>
                </ul>
                <div class="login-menu-wrap__hr"></div>
                <div class="login-menu-wrap__user">
                    Useful
                </div>
                <ul class="login-menu">
                    <li class="login-menu__item">
                        <a href="{{ URL::to('/') }}" class="login-menu__link">Back to Marketing Site</a>
                    </li>
                    @if(auth()->user()->hasRole('booster') || auth()->user()->hasRole('admin'))
                    <li class="login-menu__item">
                        <a href="{{ URL::to('/panel/rules') }}" class="login-menu__link">Booster rules</a>
                    </li>
                    @endif
                </ul>

                @if(auth()->user()->hasRole('admin'))
                <div class="login-menu-wrap__hr"></div>
                <div class="login-menu-wrap__user">
                    Admin
                </div>
                <ul class="login-menu">
                    <li class="login-menu__item">
                        <a href="{{ URL::to('/panel/admin/user') }}" class="login-menu__link">User Management</a>
                    </li>
                    <li class="login-menu__item">
                        <a href="{{ URL::to('/panel/blog') }}" class="login-menu__link">Blog</a>
                    </li>
                    <li class="login-menu__item">
                        <a href="{{ URL::to('/panel/order-log') }}" class="login-menu__link">Order Log</a>
                    </li>
                    <li class="login-menu__item">
                        <a href="{{ URL::to('/panel/report') }}" class="login-menu__link">Reports</a>
                    </li>
                </ul>
                @endif

                <a href="{{ URL::to('/logout') }}" class="button">Log Out</a>
            </nav>
        </div>
    </div>

</div>

@push('scripts')
<script type="text/javascript">
jQuery(document).ready(function() {
    /* Mobile navigation */
    $('.hamburger').on('click', function() {
        $('.menu').toggleClass('active');
    });
    /* Login menu */
    $('.profile-menu').on('click', function(event) {
        event.stopPropagation();
    })

    $(document).on('click', function(event) {
        hideNavigation();
    })

    $(document).keyup(function(e) {
        if (e.key === "Escape") { // escape key maps to keycode `27`
            hideNavigation();
        }
    });

    function hideNavigation() {
        $('#loginmenu').prop('checked', false); // Unchecks it
    }
});
</script>
@endpush
