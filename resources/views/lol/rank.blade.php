@extends('layout.main')
@section('content')
    <div class="main-background csgo-rank main-background--lol">
        <div class="container">
            <div class="top-block">
                <h1 class="short">Buy <span>LOL</span> Boost</h1>
                <p class="short">Trust ELO boosting for League of Legends to Challenger players with years of experience.</p>
                <a href="#calculate-boost" class="button top go">Calculate Boost Price</a>
                @if ($orderSummary)
                    <p class="last-order">⏱ Last Order - {{ $orderSummary }}</p>
                @endif
            </div>
            <div class="calculator" id="calculate-boost">
                <div class="blackbox blackbox-calculator-container">
                    @include('calculator.block', ['gameType' => 'lol'])
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
            <p>Our services are trusted by thousands of customers across the world.</p>
        </div>
        <div class="col">
            <div class="icon-bg green">
                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/5star-short.svg') }}" alt="Eloking boosters are experienced" />
            </div>
            <h3>Experienced</h3>
            <p>We have the best boosters available in the industry ready to take your game to the next level.</p>
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
            <div class="video-thumbnail play-video play-video--lol">
                <div class="logo">
                    <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/logo.svg') }}" alt="Eloking Logo" />
                </div>
                <div class="video-title">Boosting service explained</div>
                <div class="video-subtitle">by <span>Eloking</span></div>
                <div class="play-button"></div>
            </div>
        </div>
        <div class="col">
            <h2><span>League of Legends</span> boosting simplified</h2>
            <ol>
                <li>Choose between Win and Division boosting</li>
                <li>Select solo or duo queue</li>
                <li>Chat with your booster directly</li>
                <li>Track your order and match history</li>
            </ol>
            <a href="#calculate-boost" class="button go">Calculate Price</a>
        </div>
    </div>
    <div class="container">
        <div class="divider top bottom"></div>
    </div>
    <div class="container col-2">
        <div class="col">
            <h2>Professional <span>League of Legends</span> ELO boost</h2>
            <p>Our LOL ELO boosting service sets new standards in the market. Our elo boosters are the top players of
                League of Legends and operate across multiple regions. They are thoroughly vetted for their
                communication and attitude to ensure all Eloking customers receive a wonderful experience. That is why
                our boost retention rates are much higher than the market average.</p>
            <a href="#calculate-boost" class="button go">Order ELO Boosting</a>
        </div>
        <div class="col csgo-raise-rank-image">
            <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-srcset="{{ asset('img/lol-stack.png') }} 1x, {{ asset('img/lol-stack@2x.png') }} 2x" alt="lol rank"/>
        </div>
    </div>
    <div class="clear"></div>
    <div class="container">
        <div class="highlight">
            <h2>Highest <span>win rates</span> in the market</h2>
            <p>Since our League of Legends boosters are the most qualified in the market, our win rates for boosting
                jobs are incredibly high, surpassing 90% average.</p>
            <a href="#calculate-boost" class="button go">Try League Boosting</a>
            <div class="screenshots">
                <img width="248" height="176" src="{{ asset('img/1x1.png') }}" class="lazyload"
                     data-srcset="{{ asset('img/icons/lol/screenshot1.png') }} 1x, {{ asset('img/icons/lol/screenshot1@2x.png') }} 2x" alt="League of Legends Wins Screenshot" />
                <img width="248" height="176" src="{{ asset('img/1x1.png') }}" class="lazyload"
                     data-srcset="{{ asset('img/icons/lol/screenshot2.png') }} 1x, {{ asset('img/icons/lol/screenshot2@2x.png') }} 2x" alt="League of Legends Wins Screenshot" />
                <img width="248" height="176" src="{{ asset('img/1x1.png') }}" class="lazyload"
                     data-srcset="{{ asset('img/icons/lol/screenshot3.png') }} 1x, {{ asset('img/icons/lol/screenshot3@2x.png') }} 2x" alt="League of Legends Wins Screenshot" />
            </div>
        </div>
        <div class="letter">
            <div class="background-text">League of Legends Boosting</div>
            <h2>About <span>League of Legends</span> Boosting</h2>
            <p>League of Legends (LOL for short) boosting is when professional players help certain players rank up.
                The booster either plays from the customers' account or in a premade lobby. Since the skills of the
                boosters are among the top players in the world, the win probability for the teams change in a way that
                the enemy team has nearly no chance of winning. It is possible that the enemy team will also have a
                booster or professional player smurf but even that considered, Eloking booster team consists of the
                best boosters, ensuring high win rates even in such situations.</p>
            <p>LOL boosting by Eloking is an unmatched boosting service due to the mix of hard to achieve ingridients -
                incredibly skilled boosters with great communication skills and attitude, broad availability, the best
                website and much more. Our customer retention rates and reviews speak for themselves. We are proud to
                be the top choice for boosting in the market.</p>
            <p><a href="#calculate-boost" class="button full go">Calculate LOL  Boost Price</a></p>
        </div>
    </div>
    <div class="container">
        <div class="divider top bottom"></div>
    </div>
    <div class="container col-2">
        <div class="col get-out-of-hell-image get-out-of-hell-image--lol"> 
            <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-srcset="{{ asset('img/icons/lol/logo.png') }} 1x, {{ asset('img/icons/lol/logo@2x.png') }} 2x" alt="League of Legends Rank Circle" />
            <div class="get-out-of-hell-image-ring ring-1"></div>
            <div class="get-out-of-hell-image-ring ring-2"></div>
        </div>
        <div class="col">
            <h2>ELO Boost <span>24 hours</span> a day</h2>
            <p>We have boosters across the world, ensuring ELO boost 24 hours a day, every day. Just choose your
                current League of Legends rank, desired one and start your boost with us right after placing the order!
                We're fast in responses, fulfilling the orders and are available at all times, even holidays!</p>
            <a href="#calculate-boost" class="button go">Order ELO Boost</a>
        </div>
    </div>
    <div class="container">
        <div class="divider top"></div>
    </div>
    <div class="container bananas cut-top">
        <div class="faq">
            <img class="faq-towers faq-towers--top lazyload" src="{{ asset('img/1x1.png') }}" data-srcset="{{ asset('img/backgrounds/lol/towers/top.png') }} 1x, {{ asset('img/backgrounds/lol/towers/top@2x.png') }} 2x" alt="League of Legends ward" />
            <img class="faq-towers faq-towers--right lazyload" src="{{ asset('img/1x1.png') }}" data-srcset="{{ asset('img/backgrounds/lol/towers/right.png') }} 1x, {{ asset('img/backgrounds/lol/towers/right@2x.png') }} 2x" alt="League of Legends ward" />
            <img class="faq-towers faq-towers--left lazyload" src="{{ asset('img/1x1.png') }}" data-srcset="{{ asset('img/backgrounds/lol/towers/left.png') }} 1x, {{ asset('img/backgrounds/lol/towers/left@2x.png') }} 2x" alt="League of Legends ward" />
            <div class="background-text">Frequently Asked Questions</div>
            <h2>Frequently asked questions about <span>League of Legends</span> boost</h2>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">Is LOL ELO Boost safe?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">Yes. League boosting is safe and we have not encountered bans for this. It is
                        like playing with a friend who is much more skilled than the average player.</p>
                    <a href="#calculate-boost" class="button dark go">Calculate Boost Price</a>
                </div>
            </div>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">Can I play with ELO boosters together?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">Yes, of course. Simply choose the Lobby add-on in the lol boosting price
                        calculator.</p>
                    <a href="#calculate-boost" class="button dark go">Order Duo Queue Boost</a>
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
                <div class="question"><span itemprop="name">What is the refund policy for league boosting?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">We are the most flexible company for refunds. Order not yet started? We offer
                        refunds without any reasons. Changed your mind and just don't want to finalize the boost? No
                        problem, we can stop the boost mid-way and offer you a reasonable refund.</p>
                    <a href="#calculate-boost" class="button dark go">Start Your Boost</a>
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
                    <a href="#calculate-boost" class="button dark go">Order League Boost</a>
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
            <iframe id="video-modal-frame" height="100%" width="100%" src="{{ asset('img/1x1.png') }}" data-src="https://www.youtube.com/embed/IROPJtpFJVo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
    @include('blog.partials.posts', ['category' => 'lol'])
    @include('layout.partials.king-banner', ['type' => 'lol'])
@endsection
@include('layout.partials.faq-scripts')
