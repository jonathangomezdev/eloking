@extends('layout.main')
@section('content')
    <div class="main-background main-background--csgo-esea">
        <div class="container">
            <div class="top-block">
                <h1 class="short"><span>ESEA</span> Rank Boosting</h1>
                <p class="short">Rank up to your desired rank in ESEA with Eloking ESEA boost service fast and easy.</p>
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
    <div class="container col-3 values spacing-top">
        <div class="col">
            <div class="icon-bg purple">
                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/shield.svg') }}" alt="Eloking is trusted" />
            </div>
            <h3>Secure</h3>
            <p>Our ESEA boost service is confidential and discreet, ensuring proper privacy for our customers.</p>
        </div>
        <div class="col">
            <div class="icon-bg green">
                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/5star-short.svg') }}" alt="Eloking boosters are experienced" />
            </div>
            <h3>Experienced</h3>
            <p>Among our boosters are professional players with A+, G, S ranks and HLTV profiles.</p>
        </div>
        <div class="col">
            <div class="icon-bg red">
                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/head.svg') }}" alt="Eloking boosters are friendly" />
            </div>
            <h3>Friendly</h3>
            <p>We believe the ESEA boosting process should be enjoyable so our team is friendly and helpful.</p>
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
            <h2>How does <span>ESEA</span> Boosting work?</h2>
            <ol>
                <li>Choose the boost details in the calculator</li>
                <li>Place your order</li>
                <li>Get contacted by pro player</li>
                <li>The pro player helps you reach your desired goal</li>
            </ol>
            <a href="#calculate-boost" class="button go">Try ESEA Boost</a>
        </div>
    </div>
    <div class="container">
        <div class="divider top bottom"></div>
    </div>
    <div class="container col-2">
        <div class="col">
            <h2>Reach your desired rank in <span>ESEA</span></h2>
            <p>Deranked because of a bad team composition? ESEA Boosting by Eloking is a fast and easy way to reach the rank you had before or even a higher one. Our professional booster team consists of world-class players ready to help you get the rank you desire and coach you along the way.</p>
            <a href="#calculate-boost" class="button go">Try ESEA Boost Now</a>
        </div>
        <div class="col csgo-raise-rank-image">
            <img src="{{ asset('img/1x1.png') }}" src="{{ asset('img/1x1.png') }}" class="lazyload" data-srcset="{{ asset('img/csgo-esea-stack.png') }} 1x, {{ asset('img/csgo-esea-stack@2x.png') }} 2x" alt="ESEA Wins in Rank S" />
        </div>
    </div>
    <div class="clear"></div>
    <div class="container">
        <div class="highlight esea">
            <h2>Possibly the best <span>ESEA</span> rank boosting service
                in the world</h2>
            <p>Friendly and extremely qualified boosters with extensive boosting experience are just a few of the the reasons why our boosting service is possibly the best one in the market.</p>
            <a href="#calculate-boost" class="button go">Order ESEA Boosting Service</a>
            <div class="esea screenshots">
                <img width="248" height="176" src="{{ asset('img/1x1.png') }}" class="lazyload" data-srcset="{{ asset('img/icons/csgo/screenshot-esea1.png') }} 1x, {{ asset('img/icons/csgo/screenshot-esea1@2x.png') }} 2x" alt="CS:GO ESEA Wins" />
                <img width="248" height="176" src="{{ asset('img/1x1.png') }}" class="lazyload"
                     data-srcset="{{ asset('img/icons/csgo/screenshot-esea2.png') }} 1x, {{ asset('img/icons/csgo/screenshot-esea2@2x.png') }} 2x" alt="CS:GO ESEA Win Streak" />
                <img width="248" height="176" src="{{ asset('img/1x1.png') }}" class="lazyload"
                     data-srcset="{{ asset('img/icons/csgo/screenshot-esea3.png') }} 1x, {{ asset('img/icons/csgo/screenshot-esea3@2x.png') }} 2x" alt="CS:GO ESEA Match History" />
            </div>
        </div>
        <div class="letter">
            <div class="background-text">Eloking ESEA Boosting</div>
            <h2>About <span>ESEA</span> Boost by Eloking</h2>
            <P>Boosting service in ESEA is always more challenging than on regular matchmaking of CS:GO since the player base on this platform is much more experienced and teamwork is of high importance at the top ranks in ESEA. This is where our boosters' exceptional skill level comes to play. We don't use any hacks, bots or any other low quality solution for the boosting. Our highly experienced developers use purely their skills to carry you to higher ranks, even when climbing for the highest ranks.
            </P>
            <P>On top of the carrying, boosters often coach the players in the game to help them be more impactful in the games as well as to help them stay at the reached rank when they get there. There is an option to get extensive coaching as part of the boosting process for players that want to seriously step up their game and become much more better CS:GO players.</P>
            <p><a href="#calculate-boost" class="button full go">Calculate ESEA Boost Price</a></p>
        </div>
    </div>
    <div class="container">
        <div class="divider top bottom"></div>
    </div>
    <div class="container col-2">
        <div class="col get-out-of-hell-image">
            <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/esea-circle.svg') }}" alt="Rank A+ in ESEA CS:GO" />
            <div class="get-out-of-hell-image-ring ring-1"></div>
            <div class="get-out-of-hell-image-ring ring-2 esea"></div>
        </div>
        <div class="col">
            <h2>Want to reach A+ rank in <span>ESEA</span> ?</h2>
            <p>With our ESEA rank boost service you can get the rank you wish without the hassle of trial, error and thousands of hours spent. Our pro players will help you reach the rank you desire in the ESEA ranking system, whether it is just one rank up or all the way up to A+ rank.</p>
            <a href="#calculate-boost" class="button go">Try ESEA Boosting</a>
        </div>
    </div>
    <div class="container">
        <div class="divider top"></div>
    </div>
    <div class="container bananas cut-top">
        <div class="faq">
            <div class="background-text">Frequently Asked Questions</div>
            <h2>Frequently asked questions about <span>ESEA</span> rank boosting</h2>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">Is ESEA Rank Boosting safe?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">Yes. While it is against the rules of ESEA to do boosting as a business, none of our customers have received a ban for that. Only boosters accounts are at risk but even they haven't received a ban for that. It is pretty much the same as you would play with a friend of yours which is allowed by ESEA officially.</p>
                    <a href="#calculate-boost" class="button dark go">Order ESEA Boosting</a>
                </div>
            </div>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">How can you guarantee such good win rates?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">With an exceptionally skilled booster team. Our boosters do not cheat or use any illegal exploits. They are just playing and using their hard earned skill that they gathered from playing the game for thousands of hours. By hiring only the best of the best, we ensure that our customers receive exceptionally good win rates.</p>
                    <a href="#calculate-boost" class="button dark go">Try ESEA Boosting</a>
                </div>
            </div>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">How soon after placing the order we can play?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">It can depend based on the time of order but typically our boosters start communicating with our customers within 10 minutes. If you want to start right away, feel free to message in our live chat to check approximate starting times. Most likely, we will be able to find a booster ready to play at your desired time due to the fact we have a large amount of boosters working with us.</p>
                    <a href="#calculate-boost" class="button dark go">Order ESEA Boosting</a>
                </div>
            </div>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">What happens if the booster loses a game?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">It depends on the order details. If it is a level boost, the booster will play as long as the goal is achieved. If you order win boost then losing a game means the booster will play extra games. Each loss will be compensated with 2 wins to offset the loss. For example, if you ordered 3 wins and on the 3rd game the booster lost the game, the booster will play 2 more games - 1 to offset the loss and another one to fulfil the order.</p>
                    <a href="#calculate-boost" class="button dark go">Try ESEA Boosting Service</a>
                </div>
            </div>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">What is the refund policy for ESEA boosting?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">We are the most flexible company for refunds. Order not yet started? We offer
                        refunds without any reasons. Changed your mind and just don't want to finalize the boost? No
                        problem, we can stop the boost mid-way and offer you a reasonable refund.</p>
                    <a href="#calculate-boost" class="button dark go">Order ESEA Boosting</a>
                </div>
            </div>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">Do you offer any guarantees?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">Yes. We guarantee that your order will be fulfilled, otherwise we offer full refunds. On top of that, we offer ESEA ELO guarantee, meaning that if you get an elo rollback where some elo points you gained with our help are lost, we will get them back for you. Typically, this does not happen with ESEA games but we have this guarantee just in case.</p>
                    <a href="#calculate-boost" class="button dark go">Order ESEA Boost</a>
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
