@extends('layout.main')
@section('content')
    <div class="main-background main-background--csgo-rank">
        <div class="container">
            <div class="top-block">
                <h1 class="short">Buy <span>CS:GO</span> rank boosting</h1>
                <p class="short">Matchmaking rank boost will help you get the CS:GO rank you desire. Only professional
                    players execute boosting services.</p>
                <a href="#calculate-boost" class="button top go">Calculate Boost Price</a>
                @if (! is_null($orderSummary))
                    <p class="last-order">⏱ Last Order - {{ $orderSummary }}</p>
                @endif
            </div>
            <div class="calculator" id="calculate-boost">
                <div class="blackbox blackbox-calculator-container">
                    @include('calculator.block', ['gameType' => 'csgo'])
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
                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/shield.svg') }}" alt="Eloking is trusted" />
            </div>
            <h3>Trusted</h3>
            <p>Eloking boosting service is already used by thousands of players across the world.</p>
        </div>
        <div class="col">
            <div class="icon-bg green">
                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/5star-short.svg') }}" alt="Eloking boosters are experienced" />
            </div>
            <h3>Experienced</h3>
            <p>Among our boosters and coaches we have the top players in the world, including even current professional players.</p>
        </div>
        <div class="col">
            <div class="icon-bg red">
                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/head.svg') }}" alt="Eloking boosters are friendly" />
            </div>
            <h3>Friendly</h3>
            <p>Zero tolerance for toxicity and incredibly high standards are just some of the many reasons to choose us among the competition.</p>
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
            <h2>What is the <span>rank boosting</span> process?</h2>
            <ol>
                <li>Choose csgo rank boost details</li>
                <li>Place your order</li>
                <li>Chat with Global Elite booster</li>
                <li>The pro player helps you reach your desired goal</li>
            </ol>
            <a href="#calculate-boost" class="button go">Order Matchmaking Boost Now</a>
        </div>
    </div>
    <div class="container">
        <div class="divider top bottom"></div>
    </div>
    <div class="container col-2">
        <div class="col">
            <h2>Raise your rank to <span>Global Elite</span> easily</h2>
            <p>Are you going through an abysmal losing streak, being tired of cheaters while your teammates not making
                the cut? If you’ve had any of these thoughts for a competitive online game, then you're spending your
                time for nothing. What makes a competitive game truly special is the joy you get from progression, and
                that's where the help of our boosting services come in.</p>
            <a href="#calculate-boost" class="button go">Get Global Elite Rank</a>
        </div>
        <div class="col csgo-raise-rank-image">
            <img src="{{ asset('img/1x1.png') }}" class="lazyload"
                 data-srcset="{{ asset('img/csgo-raise-rank-easily.png') }} 1x, {{ asset('img/csgo-raise-rank-easily@2x.png') }} 2x" alt="Raise CS:GO Rank in Matchmaking" />
        </div>
    </div>
    <div class="clear"></div>
    <div class="container">
        <div class="highlight">
            <h2><span>Eloking</span> boosters are Global Elite players often with additional experience in the
                professional scene</h2>
            <p>Need to rank up from Silver to Supreme or Global Elite? Easy, even with lobby feature our boosters can
                do that.</p>
            <a href="#calculate-boost" class="button go">Try CS:GO Rank Boosting Service</a>
            <div class="screenshots">
                <img width="248" height="176" src="{{ asset('img/1x1.png') }}" class="lazyload"
                     data-srcset="{{ asset('img/icons/csgo/screenshot1.png') }} 1x, {{ asset('img/icons/csgo/screenshot1@2x.png') }} 2x" alt="CS:GO Rank Up Screenshot" />
                <img width="248" height="176" src="{{ asset('img/1x1.png') }}" class="lazyload"
                     data-srcset="{{ asset('img/icons/csgo/screenshot2.png') }} 1x, {{ asset('img/icons/csgo/screenshot2@2x.png') }} 2x" alt="CS:GO Faceit Wins Screenshot" />
                <img width="248" height="176" src="{{ asset('img/1x1.png') }}" class="lazyload"
                     data-srcset="{{ asset('img/icons/csgo/screenshot3.png') }} 1x, {{ asset('img/icons/csgo/screenshot3@2x.png') }} 2x" alt="CS:GO ESEA Wins Screenshot" />
            </div>
        </div>
        <div class="letter">
            <div class="background-text">About CS:GO Rank Boosting</div>
            <h2>About Eloking <span>CS:GO</span> rank boosting</h2>
            <p>Our matchmaking rank boosting is nothing like boosting from other sites. When you buy rank boosting from
                us you will feel much different. Boosters at Eloking are top notch professional Counter-Strike: Global
                Offensive players that are vetted for personality to ensure the best possible experience for our
                customers. The whole process is streamlined and simple to follow, account credentials can be exchanged
                securely and we usually start boosting service in minutes from receiving the order.</p>
            <p>With pristine reputation, buying rank boost by Eloking is the obvious choice. Simply select your current
                matchmaking rank, the desired one and any extras you like and instantly see the cost of the service.
                From there it takes just a few clicks to place the order and get contacted by the professional CS:GO
                booster that has extensive experience in the game and can carry you to reach your desired rank.</p>
            <p>The high profiles of our boosters come with another benefit - all CS:GO boosting orders are completed
                incredibly fast since the win rates are astonishing. No bots or cheats are used, just thousands of
                hours experience playing the game professionally.</p>
            <p><a href="#calculate-boost" class="button full go">Calculate Rank Boost Price</a></p>
        </div>
    </div>
    <div class="container">
        <div class="divider top bottom"></div>
    </div>
    <div class="container col-2">
        <div class="col get-out-of-hell-image">
            <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/global-elite.svg') }}" alt="icon" />
            <div class="get-out-of-hell-image-ring ring-1"></div>
            <div class="get-out-of-hell-image-ring ring-2"></div>
        </div>
        <div class="col">
            <h2>Get out of <span>ELO HELL 😖</span></h2>
            <p>Simply stuck in the elo hell and cannot get back to your previous rank? Order a few wins or rank boost to
                get back to your previous rank. Optionally, add coaching extra to ensure you return to your rank with
                improved skills.</p>
            <a href="#calculate-boost" class="button go">Raise Your Rank</a>
        </div>
    </div>
    <div class="container">
        <div class="divider top"></div>
    </div>
    <div class="container bananas cut-top">
        <div class="faq">
            <div class="background-text">Frequently Asked Questions</div>
            <h2>Frequently asked questions about <span>Eloking</span></h2>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">Is CS:GO Rank Boosting safe?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">Yes. It is the same as you would be friends with a much better player than you
                        and he played either from your account or with you. Firstly, noone will ever know that you
                        ordered the boosting service. Secondly, if you do not choose the lobby/duo queue option to play
                        with the booster, we have the highest data transfer security in the industry.</p>
                    <a href="#calculate-boost" class="button dark go">Try Rank Boosting</a>
                </div>
            </div>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">How much does CS:GO boosting cost?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">The price can be as low as 3.00 EUR but it depends on the current and desired
                        rank, as well as takes into consideration the optional add-ons you want to add. To calculate
                        the boosting cost, just use the calculator above for a precise estimate. </p>
                    <a href="#calculate-boost" class="button dark go">Calculate CS:GO Boost Price</a>
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
                    <a href="#calculate-boost" class="button dark go">Start Rank Boosting</a>
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
                    <a href="#calculate-boost" class="button dark go">Order Rank Boost</a>
                </div>
            </div>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">What is the refund policy for rank boosting?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">We are the most flexible company for refunds. Order not yet started? We offer
                        refunds without any reasons. Changed your mind and just don't want to finalize the boost? No
                        problem, we can stop the boost mid-way and offer you a reasonable refund.</p>
                    <a href="#calculate-boost" class="button dark go">Try Matchmaking Boost</a>
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
            <iframe id="video-modal-frame" height="100%" width="100%" src="{{ asset('img/1x1.png') }}" data-src="https://www.youtube.com/embed/cJBGJJjx9lk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
    @include('blog.partials.posts', ['category' => 'csgo'])
    @include('layout.partials.king-banner', ['type' => 'csgo'])
@endsection
@include('layout.partials.faq-scripts')
