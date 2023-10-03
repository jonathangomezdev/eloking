<div class="header-container">
    <div class="header">
        <a href="{{ URL::to('/')  }}" class="logo">
            <img width="48" height="95" src="{{ asset('img/logo.svg') }}" alt="Eloking Boosting Logo" />
        </a>

        @include('layout.partials.navigation')

        @if(auth()->check())
            <a class="members-area" href="{{ URL::to('/panel/orders') }}">
                <img width="24" height="24" src="{{ asset('img/icons/members-area.svg') }}" alt="Eloking Members Area" />
                <span>Member Area</span>
            </a>
        @else
            <a class="members-area" href="{{ URL::to('/member/login') }}">
                <img width="24" height="24" src="{{ asset('img/icons/members-area.svg') }}" alt="Eloking Members Area" />
                <span>Member Login</span>
            </a>
        @endif

        <div class="hamburger">
            <div></div>
            <span></span>
            <span></span>
            <span></span>
            <div></div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    jQuery(document).ready(function() {
        /* Mobile navigation */
        $('.hamburger').on('click', function(){
            $('.header-container').toggleClass('active');
            $('.navigation:not(.gameselect)').toggle();
            $('body').toggleClass('overlay');
        });

        let activeGame = $('.navigation.gameselect .submenu .link.active');

        if (activeGame.length > 0) {
            if ($('.hamburger').is(':visible')) {
                activeGame.attr('href', 'javascript:void(0);');
                activeGame.find('span:not(.title)').text('Click to change game');

                activeGame.on('click', function() {
                    $('.navigation.gameselect .submenu .link:not(.title)').toggleClass('visible');
                });
            }
        } else {
            $('.navigation.gameselect').addClass('empty');
        }

        /* Improved navigation */
        let scrollTimeOut = true,
            lastYPos = 0,
            yPos = 0,
            yPosDelta = 5,
            nav = $('.header-container'),
            navHeight = nav.outerHeight(),
            setNavClass = function() {
                scrollTimeOut = false;
                yPos = $(window).scrollTop();

                if (Math.abs(lastYPos - yPos) >= yPosDelta && !nav.hasClass('active')) {
                    if (yPos > lastYPos) {
                        nav.addClass('hide-nav');
                    } else {
                        if (yPos > 0) {
                            nav.addClass('shadow').addClass('fixed');
                        } else {
                            nav.addClass('hide-nav').removeClass('shadow');

                            setTimeout(function() {
                                nav.removeClass('fixed').removeClass('hide-nav');
                            }, 250);
                        }

                        nav.removeClass('hide-nav');
                    }
                    lastYPos = yPos;
                }
            };

        if ($(window).width() > 1063) {
            $(window).scroll(function(e){
                scrollTimeOut = true;
            });
    
            setInterval(function() {
                if (scrollTimeOut) {
                    setNavClass();
                }
    
            }, 250);
        } else {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 700){  
                    $('.header-container').addClass("fixed");
                }
                else{
                    $('.header-container').removeClass("fixed");
                }
            });
        }


        $(".go").click(function (e) {
            e.preventDefault();
            elementClick = $(this).attr("href");
            destination = $(elementClick).offset().top - 100;
            $("body,html").animate({scrollTop: destination }, 800);
        });

        function closeVideo() {
            $('body').removeClass('overlay');
            $('.video-modal-overlay').removeClass('show');
            $('.video-modal').removeClass('modal-animation--long');
            const loc = document.getElementById('video-modal-frame').src;
            const stoploc = loc.replace("?autoplay=1", "");
            document.getElementById('video-modal-frame').setAttribute('src', stoploc);
        }

        $(document).keyup(function(e) {
            if (e.key === "Escape") { // escape key maps to keycode `27`
                closeVideo()
            }
        });

        /*Video player */
        $('.video-modal-overlay, #video-modal-close').on('click', function(e){
            e.preventDefault();
            closeVideo()
        });

        $('.video-modal').on('click', function(e){
            e.stopPropagation();
        });

        $('.play-video').on('click', function(e){
            e.preventDefault();
            const loc = document.getElementById('video-modal-frame').dataset.src;
            const autoloc = loc + "?autoplay=1";
            document.getElementById('video-modal-frame').setAttribute('src', autoloc);
                $('body').addClass('overlay');
                $('.video-modal-overlay').addClass('show');
                $('.video-modal').addClass('modal-animation--long');
        });

    });
</script>
 @endpush
