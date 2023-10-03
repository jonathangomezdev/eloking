<div class="notification-overlay">
    <div class="notifications-wrap">
        <h3 class="notifications-wrap__title">
            Notifications
        </h3>
        <div class="noti-new-wrap">
            <div class="noti-header">
                <h4 class="noti-header__title">
                    New
                    <div class="notification-count-wrapper">
                        @if (auth()->user()->unreadNotifications()->count() > 0)
                            <div class="noti-header__counter counter">
                                <div class="number notification-count">
                                    {{ auth()->user()->unreadNotifications()->count() }}
                                </div>
                            </div>
                        @endif
                    </div>
                </h4>
                @if (count(auth()->user()->unreadNotifications) > 0)
                    <button id="btnMarkAllSeen" class="noti-header__btn">
                        <div>
                            Mark All as Seen
                        </div>
                    </button>
                @endif
            </div>
            <ul id="unreadNotificationList" onclick="markAllNotificationRead()" class="noti-list">
                @forelse (auth()->user()->unreadNotifications as $notification)
                    <li class="noti-list__item">
                        <a href="{{ isset($notification->data['action_url']) ? $notification->data['action_url'] : '#'}}">
                            @if (isset($notification->data['gametype']))
                                <div class="noti-list__icon noti-list__icon--img">
                                    <img src="{{ asset('img/icons/' . ($notification->data['gametype']) . '.svg') }}" alt="icon"/>
                                </div>
                            @else
                                <div class="noti-list__icon">
                                    <div class="user-letter {{ $notification->data['user']['initial'] }}">
                                        {{ $notification->data['user']['initial'] }}
                                    </div>
                                </div>
                            @endif
                            <div class="noti-list__info">
                                <div class="noti-list__text">
                                    {!! $notification->data['message'] ?? 'Something' !!}
                                </div>
                                <div class="noti-list__date">
                                    {{ $notification->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </a>
                    </li>
                @empty
                    <span id="nothingNewNotification" class="empty-new-notification-text">
                        Nothing new here..
                    </span>
                @endforelse
            </ul>
        </div>
        <div class="noti-seen-wrap">
            <div class="noti-header">
                @if (auth()->user()->notifications()->whereNotNull('read_at')->take(15)->count() > 0)
                    <h4 class="noti-header__title">
                        Seen
                    </h4>
                @endif
            </div>
            <ul class="noti-list">
                @foreach (auth()->user()->notifications()->whereNotNull('read_at')->take(15)->get() as $notification)
                    <li class="noti-list__item">
                        <a href="{{ isset($notification->data['action_url']) ? $notification->data['action_url'] : '#'}}">
                            @if (isset($notification->data['gametype']))
                                <div class="noti-list__icon noti-list__icon--img">
                                    <img src="{{ asset('img/icons/' . ($notification->data['gametype']) . '.svg') }}" alt="icon"/>
                                </div>
                            @else
                                <div class="noti-list__icon">
                                    <div class="user-letter {{ $notification->data['user']['initial'] }}">
                                        {{ $notification->data['user']['initial'] }}
                                    </div>
                                </div>
                            @endif
                            <div class="noti-list__info">
                                <div class="noti-list__text">
                                    {!! $notification->data['message'] ?? 'Something' !!}
                                </div>
                                <div class="noti-list__date">
                                    {{ $notification->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<button class="notification-hamburger"></button>

@push('scripts')
<script type="text/javascript">
jQuery(document).ready(function() {
    /* Notifications */
    $('#notifications').on('click', function() {
        if ($('.menu').hasClass('active')) {
            $('body').toggleClass('hidden');
        }

        if (!$('#notifications').hasClass('active')) {
            $('.menu').removeClass('active');
            $('.navigation a.active').addClass('not-active');
            $(this).addClass('active');
            $('.notification-hamburger').addClass('active');
            $('.notification-overlay').addClass('opened');
        } else {
            hideNavigation();
        }
    })

    $('.notifications-wrap, #notifications').on('click', function(event) {
        event.stopPropagation();
    })

    $('.notification-overlay, .menu, .notification-hamburger').on('click', function(event) {
        hideNavigation();
    })

    $(document).keyup(function(e) {
        if (e.key === "Escape") { // escape key maps to keycode `27`
            hideNavigation();
        }
    });

    function hideNavigation() {
        if ($('#notifications').hasClass('active')) {
            $('#notifications, .notification-hamburger').removeClass('active');
            $('.notification-overlay').removeClass('opened');
        }
        $('.navigation a.not-active').removeClass('not-active');
    }

    /* Help-center */
    function helpCenter() {
        const buttons = $('.faq-list__item').get();
        const titles = $('.help-content-list__item').get();
        const content = $('.faq-list-content').get();
        $(".help-content-list__item, .faq-list-content").hide();
        $(titles[0]).show();
        $(content[0]).show();
        $('.faq-list__item').on('click', function(event) {
            $('.faq-list__item--sub').show();
            $(".faq-list__item, .help-content-list__item, .faq-list-content").removeClass('active');
            $(buttons[$(this).index()]).addClass('active');
            $(titles[$(this).index()]).addClass('active');
            $(content[$(this).index()]).addClass('active');
            $(".help-content-list__item, .faq-list-content").hide();
            $(titles[$(this).index()]).show();
            $(content[$(this).index()]).show();
        })
    }

    helpCenter();

    $('#unreadNotificationList, #notifications').click(e => {
        markAllSeen();
    })

    $('#btnMarkAllSeen').on('click', function(){
        markAllSeen();
    });

    function markAllSeen() {
        $.ajax({
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/panel/notifications/markAllSeen',
            success: (res) => {
                console.log('res', res)
                window.notification.setCount(0)
            },
            error: (err) => {
                console.log('err', err)
            }
        })
    }
});
</script>
@endpush
