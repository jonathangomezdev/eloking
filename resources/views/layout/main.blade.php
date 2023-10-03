<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @stack('html-attributes')>
<head>
    <meta charset="utf-8">
    <title>{{ isset($title) ? $title . ' - Eloking' : 'Eloking - Get the rank you desire' }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    @if(isset($meta_keywords))
        <meta name="keyword" content="{{ $meta_keywords }}">
    @endif

    @if(isset($meta_description))
        <meta name="description" content="{{ $meta_description }}">
    @endif

    <meta content="index, follow" name="robots">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/icons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/icons/favicon-16x16.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        rel="preload"
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@400;500;600&display=swap"
        as="style"
        onload="this.onload=null;this.rel='stylesheet'"
    />
    <noscript>
        <link
            href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@400;500;600&display=swap"
            rel="stylesheet"
            type="text/css"
        />
    </noscript>

    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/retina.css') }}" rel="stylesheet" type="text/css" />

    @if (request()->is('csgo*'))
        <link href="{{ asset('css/csgo.css') }}" rel="stylesheet" type="text/css" />
    @elseif (request()->is('valorant*'))
        <link href="{{ asset('css/valorant.css') }}" rel="stylesheet" type="text/css" />
    @elseif (request()->is('lol*'))
        <link href="{{ asset('css/lol.css') }}" rel="stylesheet" type="text/css" />
    @endif

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "url": "{{ URL::to('/') }}",
      "logo": "{{ asset('img/logo.png') }}"
    }
    </script>
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    @stack('rich-snippets')
    <!-- Start of LiveChat (www.livechatinc.com) code -->
    <script>
        window.__lc = window.__lc || {};
        window.__lc.license = 13408752;
        ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
    </script>
    <noscript><a href="https://www.livechatinc.com/chat-with/13408752/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechatinc.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
    <!-- End of LiveChat code -->

    @if(env('ENABLE_HOTJAR', true))
        <!-- Hotjar Tracking Code for https://eloking.com -->
        <script>
            (function(h,o,t,j,a,r){
                h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                h._hjSettings={hjid:2792435,hjsv:6};
                a=o.getElementsByTagName('head')[0];
                r=o.createElement('script');r.async=1;
                r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                a.appendChild(r);
            })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
        </script>
    @endif
</head>
<body>

<div class="live-chat-btn" onclick="LC_API.open_chat_window();return false">
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

@include('layout.partials.header')
@yield('content')
@include('layout.partials.footer')
@include('layout.partials.cookies')

<script src="{{ asset('js/jquery-3.6.0.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/lazysizes.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function() {
        /* Cursor circle */
        var mouseX = 0, mouseY = 0;
        var xp = 0, yp = 0;
        $(document).mousemove(function(e){
            mouseX = e.pageX - 20;
            mouseY = e.pageY - 20;
        });
        setInterval(function(){
            xp += ((mouseX - xp)/6);
            yp += ((mouseY - yp)/6);
            $("#cursor-circle").css({left: xp +'px', top: yp +'px'});
        }, 20);
        $('*').mouseenter(function(){
            if($(this).css('cursor') == 'pointer') {
                $("#cursor-circle").css('border-color','rgba(255, 255, 255, 0.3)');
            } else {
                $("#cursor-circle").css('border-color','rgba(255, 255, 255, 0.08)');
            }
        });

        /* Select2 initiation for non-mobile devices */
        if ($(window).width() > 767) {
            $('.select2').select2({
                width: '100%',
                minimumResultsForSearch: -1
            });
        }

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
    });
</script>
<span id="cursor-circle"></span>
@if (env('APP_ENV') === 'local')
    <script type="text/javascript">zaraz = { track: () => {}, ecommerce: () => {}}</script>
@endif
@if(session('success'))
    <script type="text/javascript">
        $(document).ready(function() {
            $('.alert').delay(7000).animate({
                opacity: 0,
                right: '-200px'
            }, 'slow', 'linear', function() {
                $(this).remove();
            });
        });
    </script>
@endif
@stack('scripts')
</body>
</html>
