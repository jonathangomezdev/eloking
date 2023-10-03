@extends('layout.main')
@section('content')
    <div class="main-background main-background--csgo">
        <div class="container">
            <div class="top-block">
                <h1 class="short"><span>CS:GO</span> boosters at your service</h1>
                <p class="short">Get your desired rank in the platform of your choice. Our team consists of boosters that
                    operate in matchmaking rank, Faceit and ESEA boosting.</p>
                <a href="#choose-platform" class="button top go">Select your platform</a>
                @if ($orderSummary)
                    <p class="last-order">⏱ Last Order - {{ $orderSummary }}</p>
                @endif
            </div>
            <div class="blackbox">
                @include('layout.partials.reviews')
            </div>
        </div>
    </div>
    <div class="container bananas" id="choose-platform">
        <h2 class="short">Select your platform to begin your <span>CS:GO</span> boost</h2>
        <div class="select-type">
        <a href="{{ URL::to('/csgo/rank-boost') }}" title="buy csgo rank boost" class="selectbox content pointer">
            <div class="icon matchmaking"></div>
            <h3>CS:GO rank boost</h3>
            <p>One of our main CS:GO boosting services is rank boosting in matchmaking, also known as MM Boosting.</p>
            <button class="button top full">Order Rank Boost</button>
        </a>
        <a href="{{ URL::to('/csgo/faceit-boost') }}" title="buy faceit boost" class="selectbox content pointer">
            <div class="icon faceit"></div>
            <h3>Faceit boost</h3>
            <p>Faceit boosting is a fast and reliable way to get your desired Faceit ELO with the help of a professional
                CS:GO player.</p>
            <button class="button top red full">Try Faceit Boosting</button>
        </a>
        <a href="{{ URL::to('/csgo/esea-boost') }}" title="buy esea boosting" class="selectbox content pointer">
            <div class="icon esea"></div>
            <h3>ESEA boost</h3>
            <p>Our ESEA boost is provided by Rank G and S players that have incredible win rates, therefore finishing
                boosts is fast.</p>
            <button class="button top green full">Start ESEA Boost</button>
        </a>
        </div>
    </div>
    <div class="container">
        <div class="divider top bottom"></div>
    </div>
    <div class="container col-2">
        <div class="col">
            <div class="video-thumbnail play-video play-video--csgo">
                <div class="logo">
                    <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/logo.svg') }}" alt="Eloking Logo" />
                </div>
                <div class="video-title">How to purchase boost on Eloking?</div>
                <div class="video-subtitle">by <span>Eloking</span></div>
                <div class="play-button"></div>
            </div>
        </div>
        <div class="col">
            <h2>What makes Eloking <span>CS:GO</span> boosters stand out?</h2>
            <ol>
                <li>Best CS:GO boosters in the market</li>
                <li>Zero-toxicity policy</li>
                <li>Highly discreet boosters</li>
                <li>Properly vetted and tested boosters only</li>
            </ol>
            <a href="{{ URL::to('/csgo/rank-boost') }}" class="button">Try CS:GO Rank Boost</a>
        </div>
    </div>
    <div class="container">
        <div class="highlight">
            <h2><span>Don't worry.</span> We have an elite team of boosters with proven track record</h2>
            <p>Boosters from other sites often fall in the shadows when playing with or against our csgo boosters. Our top
                boosters have more than 4k elo in Faceit. That's more than s1mple has!</p>
            <a href="{{ URL::to('/csgo/rank-boost') }}" class="button">Calculate CS:GO Rank Boost Price</a>
            <div class="screenshots">
                <img width="248" height="176" src="{{ asset('img/1x1.png') }}" class="lazyload"
                     data-srcset="{{ asset('img/icons/csgo/screenshot1.png') }} 1x, {{ asset('img/icons/csgo/screenshot1@2x.png') }} 2x" alt="CS:GO Rank Up Screenshot" />
                <img width="248" height="176" src="{{ asset('img/1x1.png') }}" class="lazyload"
                     data-srcset="{{ asset('img/icons/csgo/screenshot-faceit1.png') }} 1x, {{ asset('img/icons/csgo/screenshot-faceit1@2x.png') }} 2x" alt="Faceit Rank Up Games" />
                <img width="248" height="176" src="{{ asset('img/1x1.png') }}" class="lazyload"
                     data-srcset="{{ asset('img/icons/csgo/screenshot-esea1.png') }} 1x, {{ asset('img/icons/csgo/screenshot-esea1@2x.png') }} 2x" alt="CS:GO ESEA Wins" />
            </div>
        </div>
        <div class="letter">
            <div class="background-text">Letter from former CS:GO booster</div>
            <h2>Letter from a former <span>CS:GO</span> booster, now a board member at Eloking</h2>
            <p>I am an ex-CS:GO and Valorant booster with more than 300 completed boosting jobs. While working as a
                booster, I saw that there is a major issue on how customers and boosters are treated. Since my
                experience as a booster was so bad with many boosting sites, I wanted to change how essentially my
                booster friends and I was treated.</p>
            <p>When trying out various boosting platforms, there were many underlying issues in the business management,
                how boosters and customers are treated in general. Each platform had its own set of problems and almost
                none of them cared to even think about resolving them. There were only like 2-3 boosting platforms that
                actually care about boosters and customers but even with identifying the issues, the management was
                inexperienced and greedy, therefore providing just acceptable enough services for high costs. I was not
                okay with that.</p>
            <p>A few months later, I found a team of people who actively create successful startups and are experienced
                in business and focus on long-term growth and providing top notch quality. The three of us agreed on
                taking CS:GO boosting service to another level by providing the best boosters experience in the market
                (above the market earnings share, timely payouts, etc) as well as treating customers as they are
                already treated in other industries - godly.</p>
            <p>And this is how Eloking was born. By boosters, for boosters and customers that want to be treated
                professionally and have fun while being boosted or coached. With our careful vetting process for
                boosters and my partners' extensive experience with consumers, we are here to leave the competition
                miles behind. Try out our CS:GO boosters and I am sure you will never look for another boosting
                provider.</p>
            <p><img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/csgo/hex0r.svg') }}" alt="hex0r Signature" /></p>
            <p><a href="{{ URL::to('/csgo/rank-boost') }}" class="button full">Start CS:GO Boost Now</a></p>
        </div>
    </div>
    <div class="container">
        <div class="divider top"></div>
    </div>
    <div class="video-modal-overlay">
        <div class="video-modal" id="video-modal">
            <button type="button" id="video-modal-close" class="forgot-password-btn-close-modal"><i>&times;</i></button>
            <iframe id="video-modal-frame" height="100%" width="100%" src="{{ asset('img/1x1.png') }}" data-src="https://www.youtube.com/embed/cJBGJJjx9lk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
    @include('blog.partials.posts', ['category' => 'csgo'])
    @include('layout.partials.king-banner', ['type' => 'csgo-home'])
@endsection
