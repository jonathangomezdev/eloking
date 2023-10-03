@extends('layout.main')
@section('content')
    <div class="main-background">
        <div class="container">
            <div class="top-block">
                <h1 class="short300">Leading elo <span>boosting</span> platform</h1>
                <p class="short300">Most trusted elo boosting service provider for <a href="{{ URL::to('/lol-boost') }}" title="lol boost" class="fancy">League of Legends</a>,
                <a href="{{ URL::to('/valorant-boost') }}" title="valorant boost" class="fancy">Valorant</a> and <a href="{{ URL::to('/csgo') }}" title="csgo boost" class="fancy">CS:GO</a>.</p>

                <div class="top-block__inner">
                    <a href="#choose-game" class="button top go">Select your game</a>
                    <button class="video-btn play-video">
                        <span>See How it Works</span>
                    </button>
                </div>

            </div>
            <div class="blackbox">
                @include('layout.partials.reviews')
            </div>
        </div>
    </div>
    <div class="container" id="choose-game">
        <h2 class="short">Select your game to begin your <span>elo boost</span></h2>
        <div class="select-type">
            <div class="selectbox-wrap">
                <div class="selectbox lol" onclick="location='{{ URL::to('/lol-boost') }}'">
                    <div class="game-icon"></div>
                    <span>League of Legends</span>
                    <div class="arrow">
                        <img class="lazyload" width="16" height="16" data-src="{{ asset('img/icons/arrow.svg') }}" src="{{ asset('img/1x1.png') }}" alt="Select game" />
                    </div>
                </div>
                <div class="backdrop lol"></div>
            </div>
            <div class="selectbox-wrap">
                <div class="selectbox valorant" onclick="location='{{ URL::to('/valorant-boost') }}'">
                    <div class="game-icon"></div>
                    <span>Valorant</span>
                    <div class="arrow">
                        <img class="lazyload" width="16" height="16" data-src="{{ asset('img/icons/arrow.svg') }}" src="{{ asset('img/1x1.png') }}" alt="Select game" />
                    </div>
                </div>
                <div class="backdrop valorant"></div>
            </div>
            <div class="selectbox-wrap">
                <div class="selectbox csgo" onclick="location='{{ URL::to('/csgo') }}'">
                    <div class="game-icon"></div>
                    <span>CS:GO</span>
                    <div class="arrow">
                        <img width="16" height="16" class="lazyload" data-src="{{ asset('img/icons/arrow.svg') }}" src="{{ asset('img/1x1.png') }}" alt="Select game" />
                    </div>
                </div>
                <div class="backdrop csgo"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="divider top bottom"></div>
    </div>
    <div class="container col-2">
        <div class="col">
            <div class="video-thumbnail play-video csgo">
                <div class="logo">
                    <img  class="lazyload"data-src="{{ asset('img/logo.svg') }}" width="17" height="32" src="{{ asset('img/1x1.png') }}" alt="Eloking Logo" />
                </div>
                <div class="video-title">How to purchase boost on Eloking?</div>
                <div class="video-subtitle">by <span>Eloking</span></div>
                <div class="play-button"></div>
            </div>
        </div>
        <div class="col">
            <h2>ELO <span>boosting</span> platform process</h2>
            <ol>
                <li>Choose the game you need more elo</li>
                <li>Choose the boost type</li>
                <li>Place your order</li>
                <li>Chat with a professional player</li>
                <li>The pro player helps you get more elo</li>
            </ol>
            <a href="#choose-game" class="button go">Select your game</a>
        </div>
    </div>
    <div class="container">
        <div class="divider top bottom"></div>
    </div>
    <div class="container col-3 values">
        <div class="col">
            <div class="icon-bg purple">
                <img width="18" height="22" src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/shield.svg') }}" alt="Eloking is trusted" />
            </div>
            <h3>Trusted</h3>
            <p>Eloking boosting service is already used by thousands of players across the world.</p>
        </div>
        <div class="col">
            <div class="icon-bg green">
                <img width="27" height="17" src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/5star-short.svg') }}" alt="Eloking boosters are experienced" />
            </div>
            <h3>Experienced</h3>
            <p>Among our boosters and coaches we have the top players in the world, including even current professional players.</p>
        </div>
        <div class="col">
            <div class="icon-bg red">
                <img width="20" height="19" src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/head.svg') }}" alt="Eloking boosters are friendly" />
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
            <h2>Truly <span>discreet</span> boosting provider</h2>
            <p>No one will know that you have used our elo boosting services. We value the privacy of our customers and
                understand how important it is to them. All data is secretly exchanged via Members area and we follow
                all the instructions given by the customer, for example, we can play in offline mode.</p>
            <a href="#choose-game" class="button go">Select your game</a>
        </div>
        <div class="col">
            <div class="review-quote">
                <div class="quote upper"></div>
                <p class="review">
                    I purchased <a href="{{ URL::to('/valorant-boost') }}" title="valorant boost" class="fancy">Valorant boost</a> from Eloking website.
                    The booster played with me and my friends. While playing with us he acted cool and like he had known
                    me for years. No one knew I was being boosted.
                </p>
                <div class="author">
                    <img class="photo lazyload" width="48" height="48" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('img/icons/anonymous-review.png') }}" alt="Anonymous Eloking customer" />
                    <img class="blurred-name lazyload" width="68" height="26" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('img/icons/blurred-name.png') }}" alt="Blurred customer name" />
                    <div class="name">
                        <span>Valorant Player</span>
                        <img class="rating-5star lazyload" width="39" height="21" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('img/icons/5star-short.svg') }}" alt="Service rated 5 stars" />
                    </div>
                </div>
                <div class="quote lower"></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="container">
        <div class="divider top"></div>
    </div>
    <div class="container">
        <div class="faq">
            <div class="background-text">Frequently Asked Questions</div>
            <h2>Frequently asked questions about <span>Eloking</span></h2>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">Why should I choose Eloking?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p>The boosting market is full of cheap low quality boosting and coaching providers where
                        professional players can only focus on quantity and therefore many boosts are left unfinished,
                        customers are being flamed on and overall the average experience is not good. With us it is a
                        completely different story - we're fully focused on customers and want all of our customers to
                        be long-term repetitive customers. Our boosters are compensated properly and we value quality
                        over quantity, therefore we strive to providing the best boosting and coaching experience in
                        the market.</p>
                    <p itemprop="text">There is only a handful of companies that can be called our competitors and when
                        being compared with them, we are almost always better on the price even though our boosters are
                        compensated the same or even more, making us an obvious choice for both - customers and
                        professional players.</p>
                    <a href="{{ URL::to('/about') }}" class="button dark">Read more about Eloking</a>
                </div>
            </div>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">How can I track my order?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">Upon placing an order, you will be able to view the order details and progress in
                        the Members area of this website. There you can chat with the booster, contact management if you
                        want to change anything as well as observe the overall progress. Also, you can always add the
                        streaming option to the boost and view the order being worked on real-time through a private
                        streaming link.</p>
                    <a href="{{ URL::to('/member/login') }}" class="button dark">Log in to access orders section</a>
                </div>
            </div>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">Is Eloking a registered company?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">Yes. While most boosting sites are operated by individuals, Eloking is an
                        official company Eloking Ltd., registered in Riga, Latvia. Registration number: 40203341307</p>
                    <a href="{{ URL::to('/about') }}" class="button dark">Read more about Eloking</a>
                </div>
            </div>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">Which regions does Eloking operate in?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">Our main market is all of Europe but we also have boosters available from North
                        America and Oceania. If you are not sure if we operate in your region, feel free to send us a
                        message in the live chat or through the contact us page.</p>
                    <a href="{{ URL::to('/about') }}" class="button dark">Read more about Eloking</a>
                </div>
            </div>
            <div class="faq-block" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="question"><span itemprop="name">What does ELO Boosting mean?</span></div>
                <div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">ELO are rank points which you need to earn to rank up. You get them by winning
                        games. ELO boosting is the process where you play with a professional player (smurf). Therefore,
                        you have incredibly high win-rate and you just gain ELO points until you rank up.</p>
                    <a href="{{ URL::to('/lol-boost') }}" title="lol elo boost" class="button dark">Try LOL ELO Boost</a>
                </div>
            </div>
        </div>
    </div>
    <div class="video-modal-overlay">
        <div class="video-modal" id="video-modal">
            <button type="button" id="video-modal-close" class="forgot-password-btn-close-modal"><i>&times;</i></button>
            <iframe id="video-modal-frame" height="100%" width="100%" src="{{ asset('img/1x1.png') }}" data-src="https://www.youtube.com/embed/IROPJtpFJVo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
    @include('layout.partials.king-banner')
@endsection
@include('layout.partials.faq-scripts')
