<div class="calculator-title">
    <div class="w-lg-half-sm-full">
        <h2 class="boost-heading">Calculate the price of your <span>boost</span></h2>
    </div>
    <div class="w-lg-half-sm-full calculator-title__inner">
        <ul class="title-icons">
            <li class="title-icon tooltip-trigger info">
                <div class="tooltip">
                    <div class="tooltip-heading">
                        <img class="badge-info lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('/img/icons/info.svg') }}" alt="icon"/> Quality
                    </div>
                    <div class="tooltip-body">
                    <span>We guarantee the quality of the service by screening all our coaches personally for a wide
                        range of skills, qualifications, personality types, etc.</span>
                    </div>
                </div>
                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/guarantee.svg') }}" alt="icon"/>
            </li>
            <li class="title-icon tooltip-trigger security">
                <div class="tooltip">
                    <div class="tooltip-heading">
                        <img class="badge-info lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('/img/icons/info.svg') }}" alt="icon"/> Security
                    </div>
                    <div class="tooltip-body">
                        <span>Payments on Eloking are end to end encrypted and safe. We do not store your payment details.</span>
                    </div>
                </div>
                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/security.svg') }}" alt="icon"/>
            </li>
            <li class="title-icon tooltip-trigger trust">
                <div class="tooltip">
                    <div class="tooltip-heading">
                        <img class="badge-info lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('/img/icons/info.svg') }}" alt="icon"/> Trust
                    </div>
                    <div class="tooltip-body">
                        <span>Eloking is trusted by customers worldwide. We strive to deliver the best boosting service
                        in the market.</span>
                    </div>
                </div>
                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/trust.svg') }}" alt="icon"/>
            </li>
        </ul>
        <div class="boosters-online">
            <span class="boosters-online__number">
                {{ \App\User::countAllOnlineUsers() }}
            </span>
            Boosters Online
        </div>
    </div>
</div>
