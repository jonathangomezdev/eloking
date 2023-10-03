<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>{{ isset($title) ? $title . ' - Eloking Member Area' : 'Eloking Member Area' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="robots" content="noindex">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/icons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/icons/favicon-16x16.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload"
          href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@400;500;600&display=swap"
          as="style"
          onload="this.onload=null;this.rel='stylesheet'"/>
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@400;500;600&display=swap"
              rel="stylesheet" type="text/css"/>
    </noscript>
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link href="{{ asset('css/panel.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Start of LiveChat (www.livechatinc.com) code -->
    <script>
        window.__lc = window.__lc || {};
        window.__lc.license = 13408752;
        window.__lc.params = [
            { name: 'Name', value: '{{ auth()->user()->name }}' },
            { name: 'Account ID', value: '{{ auth()->id() }}' },
        ];
        ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
    </script>
    <noscript><a href="https://www.livechatinc.com/chat-with/13408752/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechatinc.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
    <!-- End of LiveChat code -->
    @stack('head')
</head>

<body>
<span id="sound"></span>
<div class="panel-wrap">
    @include('panel.layout.partials.navigation')
    @yield('content')
</div>
@if (! request()->is('panel/help'))
    <div class="live-chat-btn live-chat-right" onclick="LC_API.open_chat_window();return false">
        <div class="live-chat-btn__icon">
            <img width="70" height="77" class="live-chat-btn__icon__img" src="{{ asset('img/panel/live-chat.png') }}" srcset="{{ asset('img/panel/live-chat@2x.png') }} 2x" alt="Live chat" />
        </div>
        <a class="live-chat-btn__content">
            <img src="{{ asset('img/panel/liv-chat-lines.png') }}" srcset="{{ asset('/img/panel/liv-chat-lines@2x.png') }} 2x" alt="Live chat lines" class="live-chat-btn__lines" />
            <div class="live-chat-btn__title">
                Chat with us
            </div>
        </a>
    </div>
@endif

@include('panel.layout.partials.notifications')

<script type="text/javascript">
    window.App = {!! json_encode([
        'user' => Auth::user()
    ]); !!};
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/lazysizes.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2({
            width: '100%',
            minimumResultsForSearch: -1
        });

        $('.alert').delay(7000).animate({
            opacity: 0,
            right: '-200px'
        }, 'slow', 'linear', function() {
            $(this).remove();
        });

        $('.select2-searchable').select2({
            width: '100%',
        });

        $('.select2-trigger').on('click', function() {
            let selectElement = $(this).find('select.select2');
            if (!selectElement.hasClass('select2-hidden-accessible')) {
                $(this).find('select.select2').trigger('click');
                return;
            }

            selectElement.select2('open');
        })


        // TODO: Implement properly as an ::after element
        $('select.select2').on('select2:open', function() {
            $(this).siblings('.dropdown-icon').find('img').css({
                'transform': 'rotate(180deg)'
            })
            $(this).addClass('select2-open');
        })
        $('select.select2').on('select2:close', function() {
            $(this).siblings('.dropdown-icon').find('img').css({
                'transform': 'rotate(0deg)'
            })
        })

        $('.tooltip-link').on( "mousemove", function( event ) {
            var title = $(this).attr('data-tooltip');
            $( ".tooltip" ).text(title).css({
                "left" : event.pageX,
                "top" : event.pageY
            }).show();
        });
        $('.tooltip-link').mouseout(function() {
            $('.tooltip').hide();
        });

        $('.dropdown-button').on('click', function(e){
            e.stopPropagation();
            $(this).addClass('show');
        })

        $(document).keyup(function(e) {
            if (e.key === "Escape") { // escape key maps to keycode `27`
                hideDropdown();
            }
        });

        $(".dropdown-button").on("click", "a", function(e) {
            e.stopPropagation();
            hideDropdown();
        });

        if ($(window).width() > 767) {
            $('.dropdown-button').on('mouseenter', function(e){
                e.stopPropagation();
                $(this).addClass('show');
            })

            $(".dropdown-button").on("mouseleave", function(e) {
                hideDropdown();
            });
        }


        $('body').on('click', function() {
            hideDropdown();
        })

        function hideDropdown() {
            if ($('.dropdown-button').hasClass('show')) {
                $('.dropdown-button').removeClass('show');
            }
        }
        $('.lc-o3p3tk').css({
            'visibility' : 'hidden',
        })

        $('.e1mwfyk10').click(() => {
            $('.lc-o3p3tk').css({
                'visibility' : 'hidden',
            })
        })

        /* Tooltip side checker */
        $('.tooltip-trigger').on('mouseenter', function(e) {
            const offset = $(this).offset().top - $(window).scrollTop() - $(this).children()[0].offsetHeight - 50;
            if (offset < 0) {
                $(this).children('.tooltip').addClass('bottom');
            } else {
                $(this).children('.tooltip').removeClass('bottom');
            }
        })
    });
</script>
@if (env('APP_ENV') === 'local')
    <script type="text/javascript">zaraz = { track: () => {}, ecommerce: () => {}}</script>
@endif
@stack('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        @if(strlen(auth()->user()->name) > 0)
        LiveChatWidget.call("set_customer_name", '{{ auth()->user()->name }}');
        @endif
        LiveChatWidget.call("set_customer_email", '{{ auth()->user()->email }}');
    });
</script>
</body>
</html>
