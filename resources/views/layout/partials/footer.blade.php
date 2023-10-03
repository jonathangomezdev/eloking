<div class="footer">
    <div class="badges">
        <a href="{{ URL::to('/')  }}" class="logo">
            <img width="48" height="90" src="{{ asset('img/logo.svg') }}" alt="Eloking Boosting Logo" />
        </a>
        <div class="tooltip-trigger">
            <div class="tooltip">
                <div class="tooltip-heading">
                    <img class="badge-info lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('/img/icons/info.svg') }}" alt="icon"/> Quality
                </div>
                <div class="tooltip-body">
                    <span>We guarantee the quality of the service by screening all our coaches personally for a wide
                        range of skills, qualifications, personality types, etc.</span>
                </div>
            </div>
            <div class="value guarantee"></div>
        </div>
        <div class="tooltip-trigger">
            <div class="tooltip">
                <div class="tooltip-heading">
                    <img class="badge-info lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('/img/icons/info.svg') }}" alt="icon"/> Security
                </div>
                <div class="tooltip-body">
                    <span>Payments on Eloking are end to end encrypted and safe. We do not store your payment details.</span>
                </div>
            </div>
            <div class="value security"></div>
        </div>
        <div class="tooltip-trigger">
            <div class="tooltip">
                <div class="tooltip-heading">
                    <img class="badge-info lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('/img/icons/info.svg') }}" alt="icon"/> Trust
                </div>
                <div class="tooltip-body">
                    <span>Eloking is trusted by customers worldwide. We strive to deliver the best boosting service
                        in the market.</span>
                </div>
            </div>
            <div class="value trust"></div>
        </div>
    </div>
    <div class="footer-content">
        <div class="col">
            <span {!! (request()->is('csgo*')) ? 'class="active"' : '' !!}>CS:GO</span>
            <a href="{{ URL::to('/csgo/rank-boost') }}" title="csgo rank boost" {!! (request()->is('csgo/rank-boost*')) ? 'class="active"' : '' !!}>Rank Boost</a>
            <a href="{{ URL::to('/csgo/faceit-boost') }}" title="faceit level boost" {!! (request()->is('csgo/faceit-boost*')) ? 'class="active"' : '' !!}>Faceit Boost</a>
            <a href="{{ URL::to('/csgo/esea-boost') }}" title="esea rank boost" {!! (request()->is('csgo/esea-boost*')) ? 'class="active"' : '' !!}>ESEA Boost</a>
        </div>
        <div class="col">
            <span {!! (request()->is('valorant-boost*')) ? 'class="active"' : '' !!}>Valorant</span>
            <a href="{{ URL::to('/valorant-boost') }}" title="valorant rank boost" {!! (request()->is('valorant-boost*')) ? 'class="active"' : '' !!}>Valorant Boost</a>
        </div>
        <div class="col">
            <span {!! (request()->is('lol-boost*')) ? 'class="active"' : '' !!}>League of Legends</span>
            <a href="{{ URL::to('/lol-boost') }}" title="lol elo boost" {!! (request()->is('lol-boost*')) ? 'class="active"' : '' !!}>LoL Boost</a>
        </div>
        <div class="divider">
            <div class="line"></div>
        </div>
        <div class="col">
            <span {!! (request()->is('about*') || request()->is('blog*') ||
                        request()->is('jobs*') || request()->is('help*')) ? 'class="active"' : '' !!}>Company</span>
            <a href="{{ URL::to('/about') }}" title="about eloking" {!! (request()->is('about*')) ? 'class="active"' : '' !!}>About</a>
            <a href="{{ URL::to('/blog') }}" title="eloking blog" {!! (request()->is('blog*')) ? 'class="active"' : '' !!}>Blog</a>
            <a href="{{ URL::to('/jobs') }}" title="work at eloking" {!! (request()->is('jobs*')) ? 'class="active"' : '' !!}>Jobs</a>
            <a href="{{ URL::to('/contact') }}" title="contact eloking" {!! (request()->is('help*')) ? 'class="active"' : '' !!}>Contact Us</a>
        </div>
        <div class="col">
            <span {!! (request()->is('terms-for-users*') || request()->is('terms-for-players*') ||
                        request()->is('privacy-policy*')) ? 'class="active"' : '' !!}>Legal</span>
            <a href="{{ URL::to('/terms-for-users') }}" {!! (request()->is('terms-for-users*')) ? 'class="active"' : '' !!}>Terms & Conditions</a>
            <a href="{{ URL::to('/terms-for-players') }}" {!! (request()->is('terms-for-players*')) ? 'class="active"' : '' !!}>T&C for Players</a>
            <a href="{{ URL::to('/privacy-policy') }}" {!! (request()->is('privacy-policy*')) ? 'class="active"' : '' !!}>Privacy Policy</a>
        </div>
        <div class="col">
            <span>Social Media</span>
            <a href="https://www.tiktok.com/@elokingboost" target="_blank" rel="noopener">TikTok</a>
            <a href="https://www.instagram.com/elokingboost/" target="_blank" rel="noopener">Instagram</a>
            <a href="https://www.facebook.com/elokingboost" target="_blank" rel="noopener">Facebook</a>
            <a href="https://discord.gg/kXy9aEBUr2" target="_blank" rel="noopener">Discord</a>
        </div>
        <div class="divider">
            <div class="line"></div>
        </div>
        <div class="divider payment-methods">
            <img width="317" height="24" src="{{ asset('img/icons/payment-methods.svg') }}" alt="Eloking Accepted Payment Methods" />
        </div>
        <div class="divider">
            <p class="legal-notice">Counter-Strike: Global Offensive is a registered trademark of Valve Corporation
                Company. We are in no way affiliated with, associated with or endorsed by Valve Corporation. Eloking
                isn't endorsed by Riot Games and doesn't reflect the views or opinions of Riot Games or anyone officially
                involved in producing or managing League of Legends or Valorant. League of Legends, Valorant and Riot
                Games are trademarks or registered trademarks of Riot Games, Inc. Any other marks are trademarks and/or
                registered trademarks of their respective owners. No endorsement is expressed or implied.
            </p>
        </div>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
jQuery(document).ready(function() {
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

@if(auth()->id())
    zaraz.track('page_view', { user_id: {!! auth()->id() !!} });
@endif
</script>
@endpush
