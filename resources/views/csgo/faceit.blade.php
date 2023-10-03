@extends('layout.main')
@section('content')
    <div class="main-background faceit-page main-background--csgo-faceit">
        <div class="container">
            <div class="top-block">
                <h1 class="short"><span>Faceit</span> Boost Service</h1>
                <p class="short">Reach your desired Faceit level and elo points with the help of our elo boosters.
                We guarantees a 100% legal Faceit boost service in really short time.</p>
                <a href="#calculate-boost" class="button top go">Calculate Boost Price</a>
                @if ($orderSummary)
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
    <div class="faceit-page">
        <div class="container col-3 values spacing-top">
            <div class="col">
                <div class="icon-bg purple">
                    <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/shield.svg') }}" alt="Eloking is trusted" />
                </div>
                <h3>Secure</h3>
                <p>Faceit boost service by Eloking is trusted world-wide and used by players that are even Faceit level 10 players.</p>
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
                <p>Out boosters are possibly the friendliest boosters you will encounter while playing Faceit matches.</p>
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
            <div class="col how-it-works">
                <h2>How does <span>Faceit</span> Boosting work?</h2>
                <ol>
                    <li>Choose the boost details in the calculator</li>
                    <li>Place your order</li>
                    <li>Get contacted by pro player</li>
                    <li>The pro player helps you reach your goal</li>
                </ol>
                <a href="#calculate-boost" class="button go">Order Faceit Boost Now</a>
            </div>
        </div>
        <div class="container">
            <div class="divider top bottom"></div>
        </div>
        <div class="container col-2">
            <div class="col">
                <h2>Reach your desired level in <span>Faceit</span></h2>
                <p class="reach-desired-level-text">Playing CS:GO on Faceit can easily get tough as after reaching a certain skill level, most players switch from matchmaking, form teams or join premade lobbies where they use various strategies to gain even slightest advantages. Playing solo against these is tough, unless you have a true professional in your team - a booster from Eloking. With the help of our Faceit boosters, you will get your desired level in Faceit with ease.</p>
                <a href="#calculate-boost" class="button go">Try Faceit Level Boosting</a>
            </div>
            <div class="col csgo-raise-rank-image">
                <img src="{{ asset('img/1x1.png') }}" class="lazyload"
                     data-srcset="{{ asset('img/faceit-stack.png') }} 1x, {{ asset('img/faceit-stack@2x.png') }} 2x" alt="Faceit Boost by Eloking" />
            </div>
        </div>
        <div class="clear"></div>
        <div class="container">
            <div class="highlight">
                <h2><span>Eloking</span> boosters team consists of elite high-elo players</h2>
                <p class="elite-pro-description">Boosters from other sites often fall in the shadows when playing with or against our boosters. Our top boosters have more than 4k elo in Faceit, That's more than s1mple has!</p>
                <a href="#calculate-boost" class="button go">Try Faceit Boosting Service</a>
                <div class="screenshots">
                    <img width="248" height="176" src="{{ asset('img/1x1.png') }}" class="lazyload"
                         data-srcset="{{ asset('img/icons/csgo/screenshot-faceit1.png') }} 1x, {{ asset('img/icons/csgo/screenshot-faceit1@2x.png') }} 2x" alt="Faceit Rank Up Games" />
                    <img width="248" height="176" src="{{ asset('img/1x1.png') }}" class="lazyload"
                         data-srcset="{{ asset('img/icons/csgo/screenshot-faceit2.png') }} 1x, {{ asset('img/icons/csgo/screenshot-faceit2@2x.png') }} 2x" alt="Faceit Wins Screenshot" />
                    <img width="248" height="176" src="{{ asset('img/1x1.png') }}" class="lazyload"
                         data-srcset="{{ asset('img/icons/csgo/screenshot-faceit3.png') }} 1x, {{ asset('img/icons/csgo/screenshot-faceit3@2x.png') }} 2x" alt="Faceit Win Streak" />
                </div>
            </div>
            <div class="letter">
                <div class="background-text">Eloking Faceit Boost</div>
                <h2>About Eloking <span>Faceit</span> Boost</h2>
                <p>The main advantage we offer for Faceit boosting service is the exceptional skill level of our players. By having a proper business setup where everything happens legally and the players themselves are rewarded for their exceptional service, we have accumulated the best Faceit boosters in the market. Friendly attitude, discreet approach and occasional tips to improve are just a few of the many benefits you get when choosing Eloking for Faceit Boost.</p>
                <p>It is no secret that it is against Faceit rules to boost accounts. Sometimes, boosters can get banned for these services from Faceit and sometimes also elo rollbacks can happen. That is why we offer Elo insurance. Meaning, if any of your matches get canceled and your elo is decreased, we will help you get it back free of charge. Even taking that into consideration, elo rollbacks are incredibly rare. We have seen that happening only a handful of times during our boosting experience for many years. And boosters typically get bans only when they do that blatantly and share that with other people in chat. Since our boosters are careful, they haven't received any bans in Faceit while doing this daily since 2019. None of our customers ever received a Faceit ban for boosting service.</p>
                <p><a href="#calculate-boost" class="button full go">Calculate Faceit Boost Price</a></p>
            </div>
        </div>
        <div class="container">
            <div class="divider top bottom"></div>
        </div>
        <div class="container col-2">
            <div class="col">
                <img src="{{ asset('img/1x1.png') }}" class="lazyload"
                     data-srcset="{{ asset('img/faceit-stack-wins.png') }} 1x, {{ asset('img/faceit-stack-wins@2x.png') }} 2x" alt="Faceit win streak" />
            </div>
            <div class="col">
                <h2>Have a <span>streak</span> of bad games?</h2>
                <p class="streak-description">When you have a few bad days, you might feel demotivated and frustrated. It can happen with anyone and sometimes all it takes to break that is a few good wins. Order Faceit win boosting to regain your confidence and put yourself back on track!</p>
                <a href="#calculate-boost" class="button go">Try Faceit Boost Now</a>
            </div>
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
                <div class="question"><span itemprop="name">Is Faceit Boosting safe?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">Yes. While it is against the rules of Faceit, none of our customers have received a ban for that. It is the same as you would play with a friend of yours which is allowed by Faceit officially. They allow even level 1 players to play with level 10.</p>
                    <a href="#calculate-boost" class="button dark go">Try Faceit Boost Now</a>
                </div>
            </div>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">How much Faceit elo do you get per win?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">Typically around +25 elo per win but it depends on both team composures and average elo in each team. Sometimes it can be less and other times the reward is higher, but the average is around 25 elo points per win.</p>
                    <a href="#calculate-boost" class="button dark go">Try Faceit Boost</a>
                </div>
            </div>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">How soon after placing the order we can play?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">It can depend based on the time of order but typically our boosters start communicating with our customers within 10 minutes. If you want to start right away, feel free to message in our live chat to check approximate starting times. Most likely, we will be able to find a booster ready to play at your desired time due to the fact we have a large amount of boosters working with us.</p>
                    <a href="#calculate-boost" class="button dark go">Order Faceit Boost</a>
                </div>
            </div>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">What happens if the booster loses a game?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">It can depend based on the time of order but typically our boosters start communicating with our customers within 10 minutes. If you want to start right away, feel free to message in our live chat to check approximate starting times. Most likely, we will be able to find a booster ready to play at your desired time due to the fact we have a large amount of boosters working with us.</p>
                    <a href="#calculate-boost" class="button dark go">Order Faceit ELO Boosting</a>
                </div>
            </div>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">What is the refund policy for Faceit boosting?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">We are the most flexible company for refunds. Order not yet started? We offer refunds without any reasons. Changed your mind and just don't want to finalize the boost? No problem, we can stop the boost mid-way and offer you a reasonable refund.</p>
                    <a href="#calculate-boost" class="button dark go">Try Faceit Boosting Service</a>
                </div>
            </div>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">Do you offer any guarantees?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">Yes. We guarantee that your order will be fulfilled, otherwise we offer full refunds. On top of that, we offer Faceit ELO guarantee, meaning that if you get an elo rollback where some elo points you gained with our help are lost, we will get them back for you.</p>
                    <a href="#calculate-boost" class="button dark go">Try Faceit Boost</a>
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
