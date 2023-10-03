@extends('layout.main')
@section('content')
    <div class="container top">
        <h1 class="center">About <span>Us</span></h1>
    </div>
    <div class="container top overflow">
        <div class="triple-image">
            <div class="image-large chair"></div>
            <div class="image-small vr"></div>
            <div class="image-small lol"></div>
        </div>
    </div>
    <div class="container">
        <div class="letter">
            <div class="background-text centered">About<br />Eloking</div>
            <h2>Our <span>Story</span></h2>
            <p>Eloking venture started when 3 passionate gamers with different backgrounds saw the flaws in the
                boosting industry - poor customer service, boosters not treated well, low quality websites and boosting
                service with toxic players. While the gaming, ecommerce and IT industries were growing, boosting
                service providers seemed to be years behind, therefore leaving many customers and boosters deal with
                various issues.</p>
            <p>The core team of Eloking are united by the passion of gaming while coming in each with a background that
                greatly helps to provide the best in class boosting services. Chris from our core team has exceptional
                UI and UX experience, therefore allowing us to be ahead of the competition with the experience on-site.
                Muhammad was a <a href="{{ URL::to('/valorant-boost') }}">Valorant booster</a> for many years and with
                his experience in this niche he is now the voice of customers and boosters within the company. And
                Arthur is the third member of the core team that brings expertise in ecommerce and business with his
                background of running multiple 7-figure companies that provide great additional value to its employees
                and customers.</p>
            <p>At Eloking, we understand the importance of our customers, boosters and their experience with us as a
                company. We are on the path of disrupting the whole boosting niche by a true quality service that is
                unmatched by any of our competitors. Our true passion of gaming and exceptional skillset is what will
                help us achieve that.</p>
        </div>
    </div>
    <div class="container">
        <div class="divider top bottom"></div>
    </div>
    <div class="container col-3 values spacing-top">
        <div class="col">
            <div class="icon-bg purple">
                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/hand-okay.svg') }}" alt="We care" />
            </div>
            <h3>Care</h3>
            <p>Procedures and rules are made for people, not other way round. We deeply care in what our customers and
                boosters have to say whether it is good or bad feedback. We listen and react to continuously improve
                our service.</p>
        </div>
        <div class="col">
            <div class="icon-bg green">
                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/transparency.svg') }}" alt="We are transparent" />
            </div>
            <h3>Transparency</h3>
            <p>We believe that any business needs to be transparent in order to provide a quality service. Transparency
                helps us connect with our customers and boosters at a deeper level, therefore understand their needs
                much more thoroughly.</p>
        </div>
        <div class="col">
            <div class="icon-bg red">
                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/head.svg') }}" alt="We are efficient" />
            </div>
            <h3>Efficiency</h3>
            <p>We hire the best boosters in the market to achieve incredibly high win rates and be the most efficient
                boosting company out there. Even though some boosts interfere with competitive integrity of games,
                boosting niche is here to stay. Therefore, we want to limit the interference and be as efficient as
                possible.</p>
        </div>
    </div>
    <div class="container">
        <div class="divider top"></div>
    </div>
    <div class="container overflow">
        <div class="letter">
            <div class="background-text centered">Customer<br />Review</div>
            <div class="review-large">I purchased <a href="{{ URL::to('/valorant-boost') }}">Valorant boost</a> from Eloking website. The booster played with me and my friends.
                While playing with us he acted cool and like he had known me for years. Noone knew I was being
                boosted.</div>
            <div class="author">
                <img class="photo lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('img/icons/anonymous-review.png') }}" alt="Anonymous Eloking customer" />
                <img class="blurred-name lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('img/icons/blurred-name.png') }}" alt="Blurred customer name" />
                <div class="name">
                    <span>Valorant Player</span>
                    <img class="rating-5star lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('img/icons/5star-short.svg') }}" alt="Service rated 5 stars" />
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="blackbox">
            @include('layout.partials.reviews')
        </div>
    </div>
    <div class="container">
        <h2>Our<br />Management <span>Team</span></h2>
        <div class="about-people">
            <div class="person">
                <div class="photo">
                    <img src="{{ asset('img/1x1.png') }}" class="lazyload"
                         data-srcset="{{ asset('img/icons/person-arturs.png') }} 1x, {{ asset('img/icons/person-arturs@2x.png') }} 2x" alt="Profile Picture">
                    <img class="flag lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('img/icons/flag-latvia.svg') }}" alt="Latvian Flag">
                </div>
                <div class="name">
                    <div class="full-name"><a href="https://www.linkedin.com/in/arturs-kruze/" rel="nofollow">Arthur K.</a></div>
                    <div class="position">Chief Executive Officer</div>
                </div>
            </div>
            <div class="person">
                <div class="photo">
                    <img src="{{ asset('img/1x1.png') }}" class="lazyload"
                         data-srcset="{{ asset('img/icons/person-muhammad.png') }} 1x, {{ asset('img/icons/person-muhammad@2x.png') }} 2x" alt="Profile Picture">
                    <img class="flag lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('img/icons/flag-egypt.svg') }}" alt="Egyptian Flag">
                </div>
                <div class="name">
                    <div class="full-name"><a href="https://www.linkedin.com/in/muhammad-nagi-41701b217/" rel="nofollow">Muhammad N.</a></div>
                    <div class="position">Chief Operations Officer</div>
                </div>
            </div>
            <div class="person">
                <div class="photo">
                    <img src="{{ asset('img/1x1.png') }}" class="lazyload"
                         data-srcset="{{ asset('img/icons/person-kristaps.png') }} 1x, {{ asset('img/icons/person-kristaps@2x.png') }} 2x" alt="Profile Picture">
                    <img class="flag lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('img/icons/flag-latvia.svg') }}" alt="Latvian Flag">
                </div>
                <div class="name">
                    <div class="full-name"><a href="https://www.linkedin.com/in/kristapskruze/" rel="nofollow">Kristaps K.</a></div>
                    <div class="position">Creative Director</div>
                </div>
            </div>
            <div class="person">
                <div class="photo">
                    <img src="{{ asset('img/1x1.png') }}" class="lazyload"
                         data-srcset="{{ asset('img/icons/person-neven.png') }} 1x, {{ asset('img/icons/person-neven@2x.png') }} 2x" alt="Profile Picture">
                    <img class="flag lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('img/icons/flag-canada.svg') }}" alt="Canadian Flag">
                </div>
                <div class="name">
                    <div class="full-name"><a href="https://www.linkedin.com/in/nevenzeremski/" rel="nofollow">Neven Z.</a></div>
                    <div class="position">Advisory Board</div>
                </div>
            </div>
        </div>
    </div>
    @include('layout.partials.king-banner')
@endsection
