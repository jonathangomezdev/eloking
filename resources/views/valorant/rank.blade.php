@extends('layout.main')
@section('content')
    <div class="main-background csgo-rank main-background--valorant">
        <div class="container">
            <div class="top-block">
                <h1 class="short">Buy <span>Valorant</span> boost service</h1>
                <p class="short">Professional Valorant ELO boosting service to help you reach the rank of your
                    dreams.</p>
                <a href="#calculate-boost" class="button top go">Calculate Boost Price</a>
                @if ($orderSummary)
                    <p class="last-order">⏱ Last Order - {{ $orderSummary }}</p>
                @endif
            </div>
            <div class="calculator" id="calculate-boost">
                <div class="blackbox blackbox-calculator-container">
                    @include('calculator.block', ['gameType' => 'valorant'])
                </div>
                <div class="blackbox blackbox-review-container">
                    @include('layout.partials.reviews')
                </div>
            </div>
        </div>
    </div>
    <div class="container col-3 values spacing-top">
        <div class="col">
            <div class="icon-bg purple">
                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/shield.svg') }}" alt="Eloking is secure" />
            </div>
            <h3>Secure</h3>
            <p>We have end to end encryption with granular access levels to ensure proper data security.</p>
        </div>
        <div class="col">
            <div class="icon-bg green">
                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/5star-short.svg') }}" alt="Eloking boosters are experienced" />
            </div>
            <h3>Experienced</h3>
            <p>Among our boosters and coaches we have the top players in the world, including even current professional
                players.</p>
        </div>
        <div class="col">
            <div class="icon-bg red">
                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/head.svg') }}" alt="Eloking boosters are friendly" />
            </div>
            <h3>Friendly</h3>
            <p>Zero tolerance for toxicity and incredibly high standards are just some of the many reasons to choose us
                among the competition.</p>
        </div>
    </div>
    <div class="container">
        <div class="divider top bottom"></div>
    </div>
    <div class="container col-2">
        <div class="col">
            <div class="video-thumbnail play-video play-video--valorant">
                <div class="logo">
                    <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/logo.svg') }}" alt="Eloking Logo" />
                </div>
                <div class="video-title">Valorant boosting service explained</div>
                <div class="video-subtitle">by <span>Eloking</span></div>
                <div class="play-button"></div>
            </div>
        </div>
        <div class="col">
            <h2>How does <span>Valorant</span> boosting work?</h2>
            <ol>
                <li>Choose between Win or Rank boosting</li>
                <li>Place your order</li>
                <li>Chat directly with the booster</li>
                <li>Climb ranks easily</li>
            </ol>
            <a href="#calculate-boost" class="button go">Order Now</a>
        </div>
    </div>
    <div class="container">
        <div class="divider top bottom"></div>
    </div>
    <div class="container col-2">
        <div class="col">
            <h2>High win rates, <span>enjoyable</span> games</h2>
            <p>Playing with boosters at Eloking you will see highest win rates in the market. Our players are Radiant
                rank and can easily carry games in solo as well as duo orders.</p>
            <a href="#calculate-boost" class="button go">Calculate Price</a>
        </div>
        <div class="col csgo-raise-rank-image">
            <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-srcset="{{ asset('img/valorant-stack.png') }} 1x, {{ asset('img/valorant-stack@2x.png') }} 2x" alt="Valorant"/>
        </div>
    </div>
    <div class="clear"></div>
    <div class="container">
        <div class="highlight">
            <h2><span>Radiant</span> rank players at your service</h2>
            <p>By hiring the best boosters in the market we are among the few companies that can guarantee incredibly
                high win rates and that the players gaming together with the boosters will have enjoyable games that
                are free of toxicity. Our Valorant boosters always try to find ways to provide the best gaming
                experience for the players being boosted.</p>
            <a href="#calculate-boost" class="button go">Try Valorant ELO Boost</a>
            <div class="screenshots">
                <img width="248" height="176" src="{{ asset('img/1x1.png') }}" class="lazyload"
                     data-srcset="{{ asset('img/icons/valorant/screenshot1.png') }} 1x, {{ asset('img/icons/valorant/screenshot1@2x.png') }} 2x" alt="Valorant Wins Screenshot" />
                <img width="248" height="176" src="{{ asset('img/1x1.png') }}" class="lazyload"
                     data-srcset="{{ asset('img/icons/valorant/screenshot2.png') }} 1x, {{ asset('img/icons/valorant/screenshot2@2x.png') }} 2x" alt="Valorant Wins Screenshot" />
                <img width="248" height="176" src="{{ asset('img/1x1.png') }}" class="lazyload"
                     data-srcset="{{ asset('img/icons/valorant/screenshot3.png') }} 1x, {{ asset('img/icons/valorant/screenshot3@2x.png') }} 2x" alt="Valorant Wins Screenshot" />
            </div>
        </div>
        <div class="letter">
            <div class="background-text">About Valorant Boosting</div>
            <h2>About <span>Valorant</span> ELO boost</h2>
            <p>Valorant elo boost service is when a professional Valorant gamer either plays from your account or
                together with you in a premade lobby. While playing with you can be more challenging since the booster
                also needs to carry you to your desired rank, since our Valorant boosters are professional level players
                it is not much of an issue. Even when given tough situations, our boosters win majority of the games.</p>
            <p>Our Valorant boosting service offers advantages unmatched by many other boosting sites -
                exceptionally skilled boosters, broad availability, properly vetted gamers for soft skills such as
                discretion and communication skills and much more. If you have tried Valorant boosting (also known as
                Valorant elo boost) with another boosting platform, you will most likely want to fully switch to us and
                our boosters due to the nature of how our boosts are executed. We proudly present ourselves as the most
                professional boosting service company in the market.</p>
            <p><a href="#calculate-boost" class="button full go">Calculate Valorant Boost Price</a></p>
        </div>
    </div>
    <div class="container">
        <div class="divider top bottom"></div>
    </div>
    <div class="container col-2">
        <div class="col get-out-of-hell-image">
            <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/valorant/valorant-circle.svg') }}" alt="Valorant Rank Circle" />
            <div class="get-out-of-hell-image-ring ring-1"></div>
            <div class="get-out-of-hell-image-ring ring-2"></div>
        </div>
        <div class="col">
            <h2>Rank up 4-6 divisions <span>per day</span></h2>
            <p>The average rank up tempo while using our services is around 4-6 divisions per day. Of course, these
                differ based on your league points, current division and availability if you have chosen lobby boost
                add-on. But overall, the Valorant boosting service we provide is one of the fastest also due to the
                fact that our win rates are incredibly high.</p>
            <a href="#calculate-boost" class="button go">Rank Up Now</a>
        </div>
    </div>
    <div class="container">
        <div class="divider top"></div>
    </div>
    <div class="container bananas cut-top">
        <div class="faq">
            <div class="background-text">Frequently Asked Questions</div>
            <h2>Frequently asked questions about <span>Valorant boosting</span></h2>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">Is Valorant ELO Boost safe?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">Yes. Our boosters do not use any cheats or exploits. They rely on their skills
                        and expertise on the game.</p>
                    <a href="#calculate-boost" class="button dark go">Try Valorant ELO Boost</a>
                </div>
            </div>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">Can I play with Eloking boosters together?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">Yes. By choosing the Lobby/DuoQ add-on in the Valorant boosting price calculator,
                        you will not need to share the account with the booster. Instead, the booster will ask you to
                        join his lobby and play with you, helping you to get the rank you desire.</p>
                    <a href="#calculate-boost" class="button dark go">Try Valorant Duoq Boost</a>
                </div>
            </div>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">How soon after placing the order we can play?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">It can depend based on the time of order but typically our boosters start
                        communicating with our customers within 10 minutes. If you want to start right away, feel free
                        to message in our live chat to check approximate starting times. Most likely, we will be able
                        to find a booster ready to play at your desired time due to the fact we have a large amount of
                        boosters working with us.</p>
                    <a href="#calculate-boost" class="button dark go">Try Boost Now</a>
                </div>
            </div>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">What happens if the booster loses a game?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">It depends on the order details. If it is a rank boost, the booster will play as
                        long as the goal is achieved. If you order win boost then losing a game means the booster will
                        play extra games. Each loss will be compensated with 2 wins to offset the loss. For example, if
                        you ordered 3 wins and on the 3rd game the booster lost the game, the booster will play 2 more
                        games - 1 to offset the loss and another one to fulfil the order.</p>
                    <a href="#calculate-boost" class="button dark go">Try Boost Now</a>
                </div>
            </div>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">Do you offer refunds for Valorant boost?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">We are the most flexible company for refunds. Order not yet started? We offer
                        refunds without any reasons. Changed your mind and just don't want to finalize the boost? No
                        problem, we can stop the boost mid-way and offer you a reasonable refund.</p>
                    <a href="#calculate-boost" class="button dark go">Order Valorant ELO Boost</a>
                </div>
            </div>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">Will anyone know I am being boosted?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">Not really. While there will be a notable difference in the skill of the booster
                        and you, the booster will not share any details about you and they will also not tell anyone
                        that you are being boosted. It is possible to also agree on certain things with the booster,
                        i.e., to have him play in offline mode if they play using your account. That kind of things are
                        available free of charge.</p>
                    <a href="#calculate-boost" class="button dark go">Order Valorant Boosting</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="divider top"></div>
    </div>
    <div class="video-modal-overlay">
        <div class="video-modal" id="video-modal">
            <button type="button" id="video-modal-close" class="forgot-password-btn-close-modal"><i>&times;</i></button>
            <iframe id="video-modal-frame" height="100%" width="100%" src="{{ asset('img/1x1.png') }}" data-src="https://www.youtube.com/embed/-Fr_hz8kGn0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
    @include('blog.partials.posts', ['category' => 'valorant'])
    @include('layout.partials.king-banner', ['type' => 'valorant'])
@endsection
@include('layout.partials.faq-scripts')
