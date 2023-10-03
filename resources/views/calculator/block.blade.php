@include('calculator.partials.top')
<form id="calculator">
    @csrf
    <div class="booster-form-wrapper">
        <div class="w-lg-half-sm-full booster-selection-wrapper platform-wrapper select2-trigger">
            <div class="booster-icon">
                @if ($gameType == 'csgo')
                    <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/csgo/matchmaking.svg') }}" alt="cs:go icon"/>
                @elseif ($gameType == 'valorant')
                    <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/valorant.svg') }}" alt="valorant icon"/>
                @elseif ($gameType == 'lol')
                    <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/lol.svg') }}" alt="lol icon"/>
                @endif
            </div>
            <div class="w-full booster-input-group">
                <label for="platform">Platform</label>
                <div class="booster-rank-selection-wrapper">
                    <select id="platform" class="platform booster-rank-selection select2" name="platform">
                        @if ($gameType == 'csgo')
                            <option value="matchmaking" {{ str_contains(Request::path(), 'rank') ? 'selected' : ''}}>
                                Matchmaking
                            </option>
                            <option value="faceit" {{ str_contains(Request::path(), 'faceit') ? 'selected' : ''}}>
                                Faceit
                            </option>
                            <option value="esea" {{ str_contains(Request::path(), 'esea') ? 'selected' : ''}}>ESEA
                            </option>
                        @elseif ($gameType == 'valorant')
                            <option value="matchmaking">Valorant</option>
                        @elseif ($gameType == 'lol')
                            <option value="matchmaking">League of Legends</option>
                        @endif
                    </select>
                    <span class="dropdown-icon">
                        <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="dropdown icon"/>
                    </span>
                </div>
            </div>
        </div>
        <div class="w-lg-half-sm-full booster-selection-wrapper boost-type-select select2-trigger">
            <div class="w-full booster-input-group">
                <label for="platform">Boost type</label>
                <div class="booster-rank-selection-wrapper">
                    <select id="boost-type" class="boost-type booster-rank-selection select2" name="boost-type">
                        <option value="rank">By
                            @switch($gameType)
                                @case('csgo')
                                    Rank
                                    @break
                                @case('valorant')
                                @case('lol')
                                    Division
                                    @break
                            @endswitch
                        </option>
                        <option value="win">By Wins</option>
                        <option value="placement">Placement Matches</option>
                    </select>
                    <span class="dropdown-icon">
                        <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="dropdown icon"/>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="booster-form-wrapper">
        <div id="rank-wrapper" class="w-lg-half-sm-full booster-selection-wrapper select2-trigger">
            <div class="booster-icon">
                <img src="{{ asset('img/1x1.png') }}" data-src="{{ asset('/img/icons/' . $gameType . '/ranks/matchmaking/5.png') }}" class="rank-image lazyload" alt="icon"/>
            </div>
            <div class="w-full booster-input-group">
                <label for="rank">Current
                    @switch($gameType)
                        @case('csgo')
                            Rank
                            @break
                        @case('valorant')
                        @case('lol')
                            Division
                            @break
                    @endswitch
                </label>
                <div class="booster-rank-selection-wrapper">
                    <select id="rank" class="rank booster-rank-selection select2 current-rank" name="rank">
                        @foreach ($ranks as $rank)
                            @if ($rank->final_rank)
                                <option value="{{ $rank->sequence }}" class="final-rank"
                                        disabled="disabled">{{ $rank->rank }}</option>
                            @else
                                <option value="{{ $rank->sequence }}">{{ $rank->rank }}</option>
                            @endif
                        @endforeach
                    </select>
                    <span class="dropdown-icon">
                        <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="dropdown icon"/>
                    </span>
                </div>
            </div>
        </div>

        <div id="desired-rank-wrapper" class="desired-rank w-lg-half-sm-full booster-selection-wrapper select2-trigger">
            <div class="booster-icon">
                <img src="{{ asset('img/1x1.png') }}" data-src="{{ asset('/img/icons/' . $gameType . '/ranks/matchmaking/10.png') }}" class="rank-image lazyload" alt="icon"/>
            </div>
            <div class="w-full booster-input-group">
                <label for="desired_rank">Desired
                    @switch($gameType)
                        @case('csgo')
                            Rank
                            @break
                        @case('valorant')
                        @case('lol')
                            Division
                            @break
                    @endswitch
                </label>
                <div class="booster-rank-selection-wrapper">
                    <select id="desired-rank" class="booster-rank-selection select2 desired-rank" name="desired_rank">
                        @foreach ($ranks as $rank)
                            <option value="{{ $rank->sequence }}">{{ $rank->rank }}</option>
                        @endforeach
                    </select>
                    <span class="dropdown-icon">
                        <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="dropdown icon"/>
                    </span>
                </div>
            </div>
        </div>
        <div id="desired-wins-wrapper" class="w-lg-half-sm-full hidden desired-wins booster-selection-wrapper select2-trigger">
            <div class="w-full booster-input-group">
                <label for="desired-wins">Desired Wins</label>
                <div class="booster-rank-selection-wrapper">
                    <select id="desired-wins" class="booster-rank-selection select2" name="desired-wins">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                    <span class="dropdown-icon">
                        <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="dropdown icon"/>
                    </span>
                </div>
            </div>
        </div>
    </div>

    @if ($gameType == 'valorant' || $gameType == 'lol')
        <div class="booster-form-wrapper">
            <div class="w-lg-half-sm-full booster-selection-wrapper select2-trigger current-lp-custom hidden current-lp-master-wrapper">
                <label>Current LP</label>
                <div class="input-group">
                    <input type="number" class="booster-rank-selection current_lp_master" placeholder="eg. 240" name="current_lp_master">
                </div>
            </div>

            <div id="current-lp-wrapper" class="w-lg-half-sm-full booster-selection-wrapper select2-trigger booster-selection-wrapper-middle">
                <div class="w-full booster-input-group">
                    <label for="rank">Current LP</label>
                    <div class="booster-rank-selection-wrapper">
                        <select id="current-lp" class="rank booster-rank-selection select2" name="current-lp">
                            <option value="1">LP 0 - 20</option>
                            <option value="2">LP 21 - 40</option>
                            <option value="3">LP 41 - 60</option>
                            <option value="4">LP 61 - 80</option>
                            <option value="5">LP 81 - 100</option>
                        </select>
                        <span class="dropdown-icon">
                            <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                        </span>
                    </div>
                </div>
            </div>

            <div class="w-lg-half-sm-full booster-selection-wrapper select2-trigger hidden current-lp-custom desired-lp-master-wrapper booster-selection-wrapper-middle">
                <label>Desired LP</label>
                <div class="input-group">
                    <input type="number" class="booster-rank-selection desired_lp_master" placeholder="eg. 400" name="desired_lp_master">
                </div>
            </div>

            <div id="region-wrapper" class="w-lg-half-sm-full booster-selection-wrapper @if ($gameType == 'lol') booster-selection-wrapper-middle @endif select2-trigger">
                <div class="w-full booster-input-group">
                    <label for="region">Region</label>
                    <div class="booster-rank-selection-wrapper">
                        <select id="region" class="rank booster-rank-selection select2" name="region">
                            @if ($gameType == 'lol')
                                <option @if(session('user.region') === 'West Europe') selected @endif value="euw">EU West</option>
                                <option @if(session('user.region') === 'North America') selected @endif value="na">North America</option>
                                <option @if (session('user.region') === 'East Europe' || session('user.region') === 'North Europe') selected @endif value="eune">EU Nordic & East</option>
                                <option @if(session('user.country') === 'JP') selected @endif value="JP">Japan</option>
                                <option @if(session('user.region') === 'oceania') selected @endif value="oce">Oceania</option>
                                <option @if(session('user.country') === 'TW') selected @endif value="TW">Taiwan</option>
                                <option @if(session('user.country') === 'TR') selected @endif value="tur">Turkey</option>
                                <option @if(session('user.country') === 'RU') selected @endif value="rus">Russia</option>
                                <option @if(session('user.country') === 'BR') selected @endif value="bra">Brazil</option>
                                <option @if(session('user.country') === 'sea') selected @endif value="sea">South East Asia</option>
                                <option @if(session('user.region') === 'Latin America North') selected @endif value="lan">Latin America North</option>
                                <option @if(session('user.region') === 'Latin America South') selected @endif value="las">Latin America South</option>
                            @elseif ($gameType == 'valorant')
                                <option @if(str_contains(session('user.region'), "Europe")) selected @endif value="eu">Europe</option>
                                <option @if(session('user.country') === 'JP') selected @endif value="JP">Japan</option>
                                <option @if(session('user.region') === 'North America') selected @endif value="na">North America</option>
                                <option @if(session('user.country') === 'TW') selected @endif value="TW">Taiwan</option>
                                <option @if(session('user.country') === 'TR') selected @endif value="tur">Turkey</option>
                                <option @if(session('user.country') === 'RU') selected @endif value="rus">Russia</option>
                                <option @if(session('user.country') === 'sea') selected @endif value="sea">South East Asia</option>
                                <option @if(session('user.region') === 'Latin America North') selected @endif value="lan">Latin America North</option>
                                <option @if(session('user.region') === 'Latin America South') selected @endif value="las">Latin America South</option>
                                <option @if(session('user.region') == 'oceania') @endif value="oce">Oceania</option>
                            @endif
                        </select>
                        <span class="dropdown-icon">
                            <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                        </span>
                    </div>
                </div>
            </div>

            @if ($gameType == 'lol')
            <div id="queue-type-wrapper" class="w-lg-half-sm-full booster-selection-wrapper select2-trigger">
                <div class="w-full booster-input-group">
                    <label for="queue-type">Queue Type</label>
                    <div class="booster-rank-selection-wrapper">
                        <select id="queue-type" class="rank booster-rank-selection select2" name="queue-type">
                            <option value="solo/duo">Solo/Duo</option>
                            <option value="flex">Flex</option>
                        </select>
                        <span class="dropdown-icon">
                            <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                        </span>
                    </div>
                </div>
            </div>
            @endif
        </div>
    @endif

    <div class="addons">
        <div class="all-checkmark-wrapper">
            <label for="play_with_booster" class="checkmark-wrapper">
                <input id="play_with_booster" type="checkbox" name="options[]" value="duoq"/>
                <span class="checkmark"><img src="{{ asset('/img/icons/checkmark.png') }}" alt="icon"/></span>
                <span class="checkmark-text">Play with Booster</span>
                <span class="checkmark-badge red">Hot</span>
                <div class="tooltip-trigger">
                    <div class="tooltip">
                        <div class="tooltip-heading">
                            <img class="badge-info lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('/img/icons/info.svg') }}" alt="icon"/> Info
                        </div>
                        <div class="tooltip-body">
                            <span>You will not need to share your account credentials with the booster. Instead, the
                                booster will play together with you in a shared lobby.</span>
                        </div>
                    </div>
                    <img class="badge-info" src="{{ asset('/img/icons/info-v2.svg') }}" alt="icon"/>
                </div>
            </label>
            <label class="checkmark-wrapper" for="priority_order">
                <input type="checkbox" id="priority_order" name="options[]" value="priority_order"/>
                <span class="checkmark"><img src="{{ asset('/img/icons/checkmark.png') }}" alt="icon"/></span>
                <span class="checkmark-text">Priority Order</span>
                <div class="tooltip-trigger">
                    <div class="tooltip">
                        <div class="tooltip-heading">
                            <img class="badge-info lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('/img/icons/info.svg') }}" alt="icon"/> Info
                        </div>
                        <div class="tooltip-body">
                            <span>The order will be prioritized over non-priority orders and usually these are completed
                            around 2 times faster.</span>
                        </div>
                    </div>
                    <img class="badge-info" src="{{ asset('/img/icons/info-v2.svg') }}" alt="icon"/>
                </div>
            </label>
            <label class="checkmark-wrapper" for="1_win">
                <input id="1_win" type="checkbox" name="options[]" value="extra_win"/>
                <span class="checkmark"><img src="{{ asset('/img/icons/checkmark.png') }}" alt="icon"/></span>
                <span class="checkmark-text">+1 Win</span>
                <div class="tooltip-trigger">
                    <div class="tooltip">
                        <div class="tooltip-heading">
                            <img class="badge-info lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('/img/icons/info.svg') }}" alt="icon"/> Info
                        </div>
                        <div class="tooltip-body">
                            <span>After finishing the boost, the booster will get you one extra win.</span>
                        </div>
                    </div>
                    <img class="badge-info" src="{{ asset('/img/icons/info-v2.svg') }}" alt="icon"/>
                </div>
            </label>
            <label class="checkmark-wrapper" for="appear_offline">
                <input type="checkbox" id="appear_offline" name="options[]" value="appear_offline"/>
                <span class="checkmark"><img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/checkmark.png') }}" alt="icon"/></span>
                <span class="checkmark-text">Appear offline</span>
                <span class="checkmark-badge">Free</span>
                <div class="tooltip-trigger">
                    <div class="tooltip">
                        <div class="tooltip-heading">
                            <img class="badge-info lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('/img/icons/info.svg') }}" alt="icon"/> Info
                        </div>
                        <div class="tooltip-body">
                            <span>The booster will play with offline mode enabled so your friends are not aware that
                                there is another person playing on your account.</span>
                        </div>
                    </div>
                    <img class="badge-info" src="{{ asset('/img/icons/info-v2.svg') }}" alt="icon"/>
                </div>
            </label>
            <label class="checkmark-wrapper" for="coaching">
                <input id="coaching" type="checkbox" name="options[]" value="coaching"/>
                <span class="checkmark"><img src="{{ asset('/img/icons/checkmark.png') }}" alt="icon"/></span>
                <span class="checkmark-text">Coaching</span>
                <div class="tooltip-trigger">
                    <div class="tooltip">
                        <div class="tooltip-heading">
                            <img class="badge-info lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('/img/icons/info.svg') }}" alt="icon"/> Info
                        </div>
                        <div class="tooltip-body">
                            <span>The booster will suggest ways to improve your skill in game during the execution of
                                this order.</span>
                        </div>
                    </div>
                    <img class="badge-info" src="{{ asset('/img/icons/info-v2.svg') }}" alt="icon"/>
                </div>
            </label>
            <label class="checkmark-wrapper" for="live_stream">
                <input type="checkbox" id="live_stream" name="options[]" value="live_stream"/>
                <span class="checkmark"><img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/checkmark.png') }}" alt="icon"/></span>
                <span class="checkmark-text">Live Stream</span>
                <div class="tooltip-trigger">
                    <div class="tooltip">
                        <div class="tooltip-heading">
                            <img class="badge-info lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('/img/icons/info.svg') }}" alt="icon"/> Info
                        </div>
                        <div class="tooltip-body">
                            <span>The booster will send you a private link to a live stream where you can watch the
                                booster fulfilling your order.</span>
                        </div>
                    </div>
                    <img class="badge-info" src="{{ asset('/img/icons/info-v2.svg') }}" alt="icon"/>
                </div>
            </label>
            @if ($gameType === 'lol' || $gameType === 'valorant')
                <label class="checkmark-wrapper" for="champions_roles">
                    <input type="checkbox" id="champions_roles" name="options[]" value="champions_roles"/>
                    <span class="checkmark"><img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/checkmark.png') }}" alt="icon"/></span>
                    <span class="checkmark-text">
                        @if($gameType === 'lol')
                            Champions/Roles
                        @endif
                        @if($gameType === 'valorant')
                            Agents
                        @endif
                    </span>
                    <span class="checkmark-badge">Free</span>
                    <div class="tooltip-trigger">
                        <div class="tooltip">
                            <div class="tooltip-heading">
                                <img class="badge-info lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('/img/icons/info.svg') }}" alt="icon"/> Info
                            </div>
                            <div class="tooltip-body">
                                <span>
                                    @if ($gameType === 'lol')
                                        You can select champions, agree on roles and communicate other preferences free of charge. Champion selection is available after the order is made.
                                    @endif
                                    @if ($gameType === 'valorant')
                                        You can select agents and communicate other preferences free of charge. Agent selection is available after the order is made.
                                    @endif
                                </span>
                            </div>
                        </div>
                        <img class="badge-info" src="{{ asset('/img/icons/info-v2.svg') }}" alt="icon"/>
                    </div>
                </label>
            @endif
            @if ($gameType == 'csgo')
                <label class="checkmark-wrapper" for="wingman">
                    <input type="checkbox" id="wingman" name="options[]" value="wingman"/>
                    <span class="checkmark"><img src="{{ asset('/img/icons/checkmark.png') }}"/></span>
                    <span class="checkmark-text">Wingman</span>
                    <div class="tooltip-trigger">
                        <div class="tooltip">
                            <div class="tooltip-heading">
                                <img class="badge-info lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('/img/icons/info.svg') }}" alt="icon" alt="icon" /> Info
                            </div>
                            <div class="tooltip-body">
                            <span>The order will be done within the Wingman mode (2 vs 2) in CS:GO.</span>
                            </div>
                        </div>
                        <img class="badge-info" src="{{ asset('/img/icons/info-v2.svg') }}" alt="icon"/>
                    </div>
                </label>
            @endif
        </div>
    </div>

    <div class="totals-wrapper">
        <div class="left-bar"></div>
        <div class="w-lg-half-sm-full">
            <div class="totals">
                <div class="grand-total">
                    <h4>Total Price: <span class="amount total-price-wrapper"></span></h4>
                </div>
                <p class="price-supporting-text">Estimated Competitor Price: <span class="competitor-price"></span>
                    &#x1F92E;</p>
            </div>
            <div class="totals-error">
                <div class="error-message">Placement matches are unavailable for Faceit.</div>
            </div>
        </div>
        <div class="w-lg-half-sm-full">
            <button type="button" class="button start-boost-now">
                Start Boost Now
            </button>
        </div>
    </div>
</form>

@if ($gameType === 'lol')
    <img class="calculator-leafs calculator-leafs--bottom lazyload" src="{{ asset('img/1x1.png') }}" data-srcset="{{ asset('img/backgrounds/lol/leaf-bottom.png') }} 1x, {{ asset('img/backgrounds/lol/leaf-bottom@2x.png') }} 2x" alt="leaf" />
    <img class="calculator-leafs calculator-leafs--right lazyload" src="{{ asset('img/1x1.png') }}" data-srcset="{{ asset('img/backgrounds/lol/leaf-right.png') }} 1x, {{ asset('img/backgrounds/lol/leaf-right@2x.png') }} 2x" alt="leaf" />
@endif

<div class="loading-wrap">
    <div class="loading-inner">
        <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
</div>
<div class="modal-overlay">
    <div class="modal checkout">
        <div class="modal-content">
            <button class="modal-close-btn" id="modal-close-checkout-btn">
                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/close-modal.svg') }}" alt="icon"/>
                Cancel
            </button>
            <div id="checkout" class="checkout-form">
                <form id="payment-form">
                    <div class="payment-error">There was an error while processing your payment. Please try again
                        later.
                    </div>
                    @if (env('ENABLE_PAYPAL'))
                    <button type="button" class="pay-with-paypal-button" id="pay-with-paypal">
                        <span class="leftside">
                            <span class="paypal-logo">
                                <img src="{{ asset('/img/icons/paypal.png') }}" />
                            </span>
                                Pay with PayPal
                        </span>
                        <span class="rightside-arrow">
                            <img src="{{ asset('/img/icons/arrow-right-green.png') }}" />
                        </span>
                    </button>
                    <div class="separator">
                        <span></span>
                        <span>
                            Or Pay Another Way
                        </span>
                        <span></span>
                    </div>
                    @endif
                    <div id="payment-element">
                        <!--Stripe.js injects the Payment Element -->
                    </div>

                    <div class="input-group @if(auth()->check()) hidden @endif">
                        <label>
                            Email
                            <div class="tooltip-trigger">
                                <div class="tooltip">
                                    <div class="tooltip-heading">
                                        <img class="badge-info lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('/img/icons/info.svg') }}" alt="icon"/> Info
                                    </div>
                                    <div class="tooltip-body">
                                        <span>Your order will be assigned to account with this email address. If you do not have an account, it will be created for you.</span>
                                    </div>
                                </div>
                                <img class="badge-info lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('/img/icons/info.svg') }}" alt="icon"/>
                            </div>
                        </label>
                        <input type="email" @if(auth()->check()) disabled value="{{ auth()->user()->email }}"
                               @endif name="email" class="customer-email" placeholder="Email Address" required/>
                    </div>
                    <div class="totals-wrapper">
                        <div class="left-bar"></div>
                        <div>
                            <div class="totals">
                                <div class="grand-total">
                                    <h4>Total Price: <span id="checkout-price"></span></h4>
                                </div>
                                <p class="price-supporting-text">Estimated Competitor Price: <span class="competitor-price"></span>
                                    &#x1F92E;</p>
                            </div>
                        </div>
                    </div>
                    <button class="button submit-button">
                        <span id="button-text">Purchase Boost</span>
                    </button>
                    <div id="payment-message" class="hidden"></div>
                </form>
                <div class="footer-message">
                    <p>Secure Checkout Provided by</p>
                    <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/stripe-logo.png') }}" alt="Stripe logo"/>
                </div>
            </div>
            <div class="payment-completed">
                <div class="title center">Order successful!</div>
                <p class="center">Set your password and let's begin.</p>
                <form id="password-save-form" class="password-save-form">
                    @csrf
                    <input type="hidden" id="order_id"/>
                    <div id="newAccountPasswordInputWrapper" class="blackbox-input-group">
                        <input type="password" class="blackbox-input" name="password" id="password-save" autofocus
                               required />
                        <label for="password-save" class="blackbox-input-label">Set your password</label>
                        <div id="newAccountPasswordInputErrorWrapper"></div>
                    </div>
                    <button class="button">Proceed</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://www.paypalobjects.com/api/checkout.js" async></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            $('#calculator #platform, #calculator #boost-type').on('change', function() {
                updateSelectValues();
            });

            $('#calculator select, #calculator input').on('change', function() {
                calculateAndUpdatePrice();
            });

            function calculateAndUpdatePrice() {
                let gameType = '{{ $gameType  }}',
                    platform = $('select.platform').val(),
                    boostType = $('select.boost-type').val(),
                    currentRank = parseInt($('select.rank').val()),
                    desiredRank = parseInt($('select#desired-rank').val()),
                    desiredWins = parseInt($('select#desired-wins').val());

                updateCalculator();
                updateRankImages(gameType, platform, currentRank, desiredRank, boostType);

                let options = getOptionsValue();
                calculatePrice(gameType, platform, boostType, currentRank, desiredRank, desiredWins, options);
            }

            function getOptionsValue() {
                let calculator = $('#calculator'),
                    options = [];

                calculator.find(".addons input:checked").each(function () {
                    options.push($(this).val());
                });

                return options;
            }

            function updateCalculator() {
                let calculator = $('#calculator'),
                    boostPlatform = calculator.find('select#platform').val(),
                    boostType = calculator.find('select.boost-type').val(),
                    gameType = '{{ $gameType  }}';

                if (boostType === 'rank') {
                    calculator.find('.desired-wins').addClass('hidden');
                    calculator.find('.desired-rank').removeClass('hidden');


                    if ($('select.rank').val() === calculator.find('.rank .final-rank').val()) {
                        calculator.find('.rank').val($('select.rank option:not(.final-rank)').last().val());
                    }
                    calculator.find('.rank .final-rank').prop('disabled', true);

                    if (gameType == 'lol') {
                        if($('select#rank').val() == 25) {
                            $('.current-lp-master-wrapper').show();
                            $('#current-lp-wrapper').hide();
                            calculator.find('input[value=duoq]').prop('checked', false).parent('label').hide();
                            calculator.find('input[value=extra_win]').prop('checked', false).parent('label').hide();
                        } else {
                            $('.current-lp-master-wrapper').hide();
                            $('#current-lp-wrapper').show();
                            calculator.find('input[value=duoq]').parent('label').show();
                            calculator.find('input[value=extra_win]').parent('label').show();
                        }

                        if($('#desired-rank').val() == 25) {
                            $('.desired-lp-master-wrapper').show();
                            if ($('.desired_lp_master').val() > 0) {
                                calculator.find('input[value=duoq]').prop('checked', false).parent('label').hide();
                            }
                        } else {
                            $('.desired-lp-master-wrapper').hide();
                            if (! $('select#rank').val() == 25) {
                                calculator.find('input[value=duoq]').parent('label').show();
                            }
                        }
                    }

                } else if (boostType === 'win' || boostType === 'placement') {
                    calculator.find('.desired-rank').addClass('hidden');
                    calculator.find('.desired-wins').removeClass('hidden');
                    calculator.find('.rank .final-rank').prop('disabled', false);

                    $('.current-lp-master-wrapper').hide();
                    $('.desired-lp-master-wrapper').hide();

                    if (gameType === 'lol' && $('select#rank').val() == 25) {
                        calculator.find('input[value=duoq]').parent('label').hide();
                    } else {
                        calculator.find('input[value=duoq]').parent('label').show();
                    }
                }

                if (boostPlatform === 'matchmaking') {
                    calculator.find('input[value=wingman]').parent('label').show();
                } else {
                    calculator.find('input[value=wingman]').prop('checked', false).parent('label').hide();
                }

                if (boostPlatform === 'esea') {
                    if ("{{ strtoupper(session('user.regionCode')) }}" === 'NA') {
                        calculator.find('input[value=duoq]').prop('checked', false).parent('label').hide();
                    }
                }

                if (boostPlatform === 'esea') {
                    let currentRank = calculator.find('#rank').val()
                    let desiredRank = calculator.find('#desired-rank').val()
                    if (boostType == 'rank' && (currentRank > 9 || desiredRank > 10)) {
                        calculator.find('input[value=duoq]').prop('checked', false).parent('label').hide();
                    } else if (boostType == 'win' && (currentRank > 9)) {
                        calculator.find('input[value=duoq]').prop('checked', false).parent('label').hide();
                    } else {
                        calculator.find('input[value=duoq]').prop('checked', false).parent('label').show();
                    }
                }

                if (calculator.find('input[value=duoq]').is(':checked')) {
                    calculator.find('input[value=live_stream]').prop('checked', false).parent('label').hide();
                    calculator.find('input[value=appear_offline]').prop('checked', false).parent('label').hide();
                    calculator.find('input[value=coaching]').parent('label').show();
                } else {
                    calculator.find('input[value=coaching]').prop('checked', false).parent('label').hide();
                    calculator.find('input[value=appear_offline]').parent('label').show();
                    calculator.find('input[value=live_stream]').parent('label').show();
                }
            }

            function updateRankImages(gameType, platform = null, currentRank, desiredRank, boostType) {
                let url = '{{ asset('/img/icons') }}' + '/' + gameType + '/ranks/',
                    extension = '@2x.png';

                if (platform.length > 0) {
                    url = url + platform + '/';

                    if (gameType === 'csgo' && platform === 'matchmaking') {
                        $('img.rank-image').removeClass('vertical');

                        if (boostType === 'placement') {
                            currentRank = 0;
                        }
                    } else {
                        $('img.rank-image').addClass('vertical');
                    }
                }

                let rankImage = url + currentRank + extension,
                    desiredRankImage = url + desiredRank + extension;

                $('#rank-wrapper img.rank-image').attr('src', rankImage);
                $('#desired-rank-wrapper img.rank-image').attr('src', desiredRankImage);
            }

            function updateSelectValues() {
                let calculator = $('#calculator'),
                    boostPlatform = calculator.find('select#platform').val(),
                    boostType = calculator.find('select.boost-type').val();

                swapOptions(boostType, boostPlatform);
            }

            function swapOptions(type, platform = null) {
                let calculator = $('#calculator'),
                    allowedTypes = new Array('placement', 'rank', 'win'),
                    allowedPlatforms = new Array('matchmaking', 'faceit', 'esea'),
                    gameType = '{{ $gameType  }}';

                if (gameType === 'lol' || gameType === 'valorant') {
                    calculator.find('#rank-wrapper label').text('Current Division');
                    calculator.find('#desired-wins-wrapper label').text('Desired Wins');
                    calculator.find('#current-lp-wrapper').removeClass('invisible');
                }

                if (type === 'placement') {
                    calculator.find('#desired-wins-wrapper label').text('Number of Games');

                    let placementOptions = $('<option value="0" selected="selected">Unranked</option>'),
                        wins = 5;

                    if (gameType === 'csgo') {
                        calculator.find('#rank').empty().append(placementOptions);
                    } else {
                        calculator.find('#rank').prepend(placementOptions);
                    }

                    if (gameType === 'lol' || gameType === 'valorant') {
                        calculator.find('#rank-wrapper label').text('Last Season Rank');
                        calculator.find('#current-lp-wrapper').addClass('invisible');
                    }

                    if ((gameType === 'csgo' && platform === 'matchmaking') ||
                        (gameType === 'lol' && platform === 'matchmaking')) {
                        wins = 10;
                    }

                    if (gameType === 'lol') {
                        let grandmaster = $('<option value="26">Grandmaster</option>')
                        let challenger = $('<option value="27">Challenger</option>')
                        calculator.find('#rank').append(grandmaster);
                        calculator.find('#rank').append(challenger);
                    }

                    if (gameType === 'valorant') {
                        let radiant = $('<option value="22">Radiant</option>')
                        calculator.find('#rank').append(radiant);
                    }

                    generateWinOptions(wins);
                } else {
                    if ($.inArray(type, allowedTypes) !== -1 && $.inArray(platform, allowedPlatforms) !== -1) {
                        let rank = calculator.find('#rank').empty(),
                            desiredRank = calculator.find('#desired-rank').empty(),
                            allRanks = {!! json_encode($ranks) !!};

                        $.each(allRanks, function (el, obj) {
                            if (obj.platform === platform && obj.type === type) {
                                if (obj.final_rank === 1) {
                                    rank.append($('<option value="' + obj.sequence + '" class="final-rank" disabled="disabled">' + obj.rank + '</option>'));
                                } else {
                                    rank.append($('<option value="' + obj.sequence + '">' + obj.rank + '</option>'));
                                }

                                desiredRank.append($('<option value="' + obj.sequence + '">' + obj.rank + '</option>'));
                            }
                        });

                        if (type === 'win') {
                            let wins = 5;

                            if (gameType === 'lol') {
                                wins = 10;
                            }

                            generateWinOptions(wins);

                            if (gameType === 'lol' || gameType === 'valorant') {
                                calculator.find('#current-lp-wrapper').addClass('invisible');
                            }
                        }

                        if (platform === 'matchmaking') {
                            calculator.find('#rank').val(5);
                            calculator.find('#desired-rank').val(10);
                        } else if (platform === 'faceit') {
                            calculator.find('#rank').val(3);
                            calculator.find('#desired-rank').val(5);
                        } else if (platform === 'esea') {
                            calculator.find('#rank').val(5);
                            calculator.find('#desired-rank').val(8);
                        }
                    }
                }
            }

            function generateWinOptions(count) {
                let desiredWinsSelect = $('#calculator #desired-wins');

                desiredWinsSelect.empty();

                for (let i = 1; i <= count; i++) {
                    if (i === count) {
                        desiredWinsSelect.append($('<option value="' + i + '" selected="selected">' + i + '</option>'));
                    } else {
                        desiredWinsSelect.append($('<option value="' + i + '">' + i + '</option>'));
                    }
                }
            }

            function generateLpOptions(start) {
                let currentLpSelect = $('#calculator #current-lp'),
                    start2 = start + 20,
                    val = currentLpSelect.val();

                if ((start === 0 && currentLpSelect.text().indexOf('LP 0') > -1) ||
                    (start === 100 && currentLpSelect.text().indexOf('LP 100') > -1)
                    ) {
                    return;
                }

                currentLpSelect.empty();

                for (let i = 1; i <= 5; i++) {
                    if (i === val) {
                        currentLpSelect.append($('<option value="' + i + '" selected="selected">LP ' + start + ' - ' + start2 + '</option>'));
                    } else {
                        currentLpSelect.append($('<option value="' + i + '">LP ' + start + ' - ' + start2 + '</option>'));
                    }

                    start = start2 + 1;
                    start2 = start2 + 20;
                }
            }

            function showError(message) {
                if (message.length > 0) {
                    $('.totals-wrapper .totals').addClass('hidden');
                    $('.totals-wrapper .totals-error .error-message').text(message);
                    $('.totals-wrapper .totals-error').addClass('visible');
                    $('.start-boost-now').prop('disabled', true);
                } else {
                    $('.totals-wrapper .totals').removeClass('hidden');
                    $('.totals-wrapper .totals-error').removeClass('visible');
                    $('.start-boost-now').prop('disabled', false);
                }
            }

            function calculatePrice(gameType, platform, boostType, currentRank, desiredRank, desiredWins, options) {
                showError(false);

                if (boostType === 'rank') {
                    if (gameType === 'valorant') {
                        if ($('#rank').val() === '20') {
                            generateLpOptions(100);
                        } else {
                            generateLpOptions(0);
                        }
                    }

                    if (currentRank >= desiredRank) {
                        if(! (gameType == 'lol' && currentRank == 25 && desiredRank == 25)) {
                            showError('Current rank must be smaller than the desired rank.');
                            return null;
                        }
                    }
                    if (gameType === 'lol') {
                        if ($('.current-rank').val() == 25) {
                            $('.current-lp-master-wrapper').show();
                            let currentLpMaster = parseInt($('.current_lp_master').val());
                            let desiredLpMaster = parseInt($('.desired_lp_master').val());

                            if (currentLpMaster < 0 && currentLpMaster > 850) {
                                showError('Invalid LP provided');
                                return null;
                            }

                            if (desiredLpMaster < 0 && desiredLpMaster > 850) {
                                showError('Invalid LP provided');
                                return null;
                            }

                            if (currentLpMaster && !(desiredLpMaster)) {
                                showError('Current LP cannot be larger than desired LP.');
                                return null;
                            }

                            if (currentLpMaster > desiredLpMaster) {
                                showError('Current LP cannot be larger than desired LP.');
                                return null;
                            }
                        }
                    }
                }

                if (boostType === 'win') {
                    if (desiredWins > 0 && desiredWins <= 10 && gameType == 'lol') {
                        desiredRank = desiredWins;
                    }else if (desiredWins > 0 && desiredWins <= 5) {
                        desiredRank = desiredWins;
                    } else {
                        showError('Incorrect win amount.');
                        return null;
                    }

                    if ($('input[value=extra_win]').is(":checked")) {
                        showError('Extra win cannot be selected when boost type is set to wins.');
                        return null;
                    }

                } else if (boostType === 'placement') {
                    if (desiredWins > 0 && desiredWins <= 10) {
                        desiredRank = desiredWins;
                    } else {
                        showError('Incorrect win amount.');
                        return null;
                    }
                }

                if (boostType === 'placement' && gameType === 'csgo' && platform === 'faceit') {
                    showError('Placement boosting not available for Faceit.');
                    return null;
                }

                @if ($gameType == 'valorant' || $gameType == 'lol')
                    let currentLp = parseInt($('select#current-lp').val());
                @endif

                $.ajax({
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/api/rank/calculate',
                    data: {
                        'gametype': gameType,
                        'platform': platform,
                        'type': boostType,
                        'currentRank': currentRank,
                        'desiredRank': desiredRank,
                        @if ($gameType == 'valorant' || $gameType == 'lol')
                        'currentLp': currentLp,
                        @endif
                        @if($gameType == 'lol')
                            'currentLPMaster': $('.current_lp_master').val(),
                            'desiredLPMaster': $('.desired_lp_master').val(),
                        @endif
                        'options': options
                    },
                    success: function (data) {
                        $('.start-boost-now').prop('disabled', false);
                        $('.totals .grand-total .amount').text(data.total_formatted);
                        $('.totals .competitor-price').text(data.total_competitor_formatted);
                        $('#checkout-price').text(data.total_formatted);
                    }
                });
            }

            updateSelectValues();
            calculateAndUpdatePrice();

            function checkoutLoading() {
                $('.loading-wrap').toggleClass('show')
            }

            function showCheckout() {
                $('.modal-overlay').addClass('show show--opacity');
                setTimeout(function () {
                    checkoutLoading();
                    $('.modal').addClass('modal-animation--long');
                    $('.modal-overlay').removeClass('show--opacity');
                }, 3000);
            }

            let stripe = '';

            $('.start-boost-now').on('click', function (e) {
                e.preventDefault();
                $.getScript( "https://js.stripe.com/v3/" )
                    .done(function( script, textStatus ) {
                        stripe = Stripe("{{ env('STRIPE_KEY') }}");
                        // Cloudflare Zaraz event
                        @if(auth()->id())
                        zaraz.track('begin-checkout', { user_id: {!! auth()->id() !!} });
                        @else
                        zaraz.track('begin-checkout');
                        @endif

                        $('body').addClass('overlay');
                        checkoutLoading();
                        initialize().then(() => {
                            showCheckout()
                        })
                    })
            });

            var elements;
            var paymentElement;

            // Fetches a payment intent and captures the client secret
            async function initialize() {
                return new Promise((resolve, reject) => {
                    let gameType = '{{ $gameType  }}',
                        platform = $('select.platform').val(),
                        boostType = $('select.boost-type').val(),
                        currentRank = parseInt($('select.rank').val()),
                        desiredRank = parseInt($('select#desired-rank').val()),
                        desiredWins = parseInt($('select#desired-wins').val()),
                        options = getOptionsValue(),
                        currentLp = '';

                    if (boostType === 'win') {
                        desiredRank = desiredWins;
                    } else if(boostType === 'placement' && (desiredWins > 0 && desiredWins <= 10)) {
                        desiredRank = desiredWins;
                    }

                    if (gameType === 'lol' || gameType === 'valorant') {
                        currentLp = parseInt($('select#current-lp').val());
                    }

                    $.ajax({
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '/api/checkout/intent',
                        data: {
                            'gametype': gameType,
                            'platform': platform,
                            'type': boostType,
                            'currentRank': currentRank,
                            'desiredRank': desiredRank,
                            'options': options,
                            @if($gameType === 'valorant' || $gameType === 'lol')
                                'currentLp' : currentLp,
                            @endif
                            @if($gameType == 'lol')
                            'currentLPMaster': $('.current_lp_master').val(),
                            'desiredLPMaster': $('.desired_lp_master').val(),
                            @endif
                        },
                        success: function (data) {
                            elements = stripe.elements({
                                clientSecret: data.intent.client_secret,
                                appearance: {
                                    theme: 'night',
                                }
                            });

                            paymentElement = elements.create("payment");
                            paymentElement.mount("#payment-element");

                            resolve(data);
                        },
                        error: err => reject(err)
                    })
                });
            }


            $(document).on('submit', '#payment-form', handlePaymentSubmit)

            async function handlePaymentSubmit(e) {
                e.preventDefault();
                checkoutLoading();
                let email = $('.customer-email').val();

                let customer = await getCustomer(email)
                let order = await createOrder(customer)

                $('#order_id').val(order.order_id);

                const response = await stripe.confirmPayment({
                    elements,
                    confirmParams: {
                        return_url: window.location.href + '?order_id=' + order.order_id
                    },
                    redirect: 'if_required',
                });

                if (response.error && (response.error.type === "card_error" || response.error.type === "validation_error")) {
                    setLoading(false);
                    $('.payment-error').show();
                    $('#checkout').show();
                    showCheckout();
                    return;
                }
                if (response.paymentIntent.status === 'succeeded') {
                    setLoading(false);
                    setPaymentSuccessfulState(response.paymentIntent, customer, order);
                }
            }

            function setPaymentSuccessfulState(paymentIntent, customer, order) {
                $.ajax({
                    type: 'put',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/api/order/' + order.order_id + '/success',
                    data: {
                        order_id: order.order_id,
                        payment_id: paymentIntent.id
                    },
                    success: function (data) {
                        // Cloudflare Zaraz event
                        zaraz.ecommerce('Order Completed',
                            {
                                currency: order.currency,
                                total: order.total,
                                order_id: order.id,
                            }
                        );

                        let isUserLoggedIn = '{{ auth()->check() }}';
                        if (isUserLoggedIn) {
                            window.location.href = '/panel/orders?status=order_success';
                            return;
                        }

                        if (data.user.active) {
                            window.location.href = '/member/login?order_success=true&email=' + customer.email;
                        } else {
                            showCheckout();
                            $('#checkout').hide();
                            $('.password-save-form').css({'display': 'flex'});
                            $('.payment-completed').show();
                        }
                    },
                    error: function (err) {
                        console.log('error', err)
                        showCheckout();
                    }
                });
            }

            async function getCustomer(email) {
                return new Promise((resolve, reject) => {
                    $.ajax({
                        type: 'get',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '/api/customer',
                        data: {
                            email,
                        },
                        success: (data) => resolve(data),
                        error: (err) => reject(err)
                    })
                })
            }

            async function createOrder(customer) {
                return new Promise((resolve, reject) => {
                    let gameType = '{{ $gameType  }}',
                        platform = $('select.platform').val(),
                        boostType = $('select.boost-type').val(),
                        currentRank = parseInt($('select.rank').val()),
                        desiredRank = parseInt($('select#desired-rank').val()),
                        desiredWins = parseInt($('select#desired-wins').val()),
                        options = getOptionsValue(),
                        region = "{{ session('user.country') }}",
                        currentLp = '',
                        queueType = '';

                    if (boostType === 'win') {
                        desiredRank = desiredWins;
                    } else if(boostType === 'placement' && (desiredWins > 0 && desiredWins <= 10)) {
                        desiredRank = desiredWins;
                    }

                    if (gameType === 'csgo') {
                        region = "{{ session('user.regionCode') }}";
                    } else {
                        region = $('#region').val();
                        currentLp = parseInt($('select#current-lp').val());
                        queueType = $('select#queue-type').val();
                    }

                    $.ajax({
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '/api/order',
                        data: {
                            'gametype': gameType,
                            'platform': platform,
                            'type': boostType,
                            'currentRank': currentRank,
                            'desiredRank': desiredRank,
                            'currentLp' : currentLp,
                            'options': options,
                            'customer_id': customer.id,
                            'region': region,
                            'queueType' : queueType,
                            @if($gameType == 'lol')
                            'currentLPMaster': $('.current_lp_master').val(),
                            'desiredLPMaster': $('.desired_lp_master').val(),
                            @endif
                        },
                        success: (data) => resolve(data),
                        error: (err) => reject(err)
                    })
                });
            }

            $('.password-save-form').on('submit', function (e) {
                e.preventDefault();

                $('#newAccountPasswordInputWrapper').remove('has-feedback has-error');
                $('#newAccountPasswordInputErrorWrapper').hide();

                $.ajax({
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/api/customer',
                    data: {
                        'order_id': $('#order_id').val(),
                        'password': $('#password-save').val(),
                    },
                    success: (data) => {
                        window.location.href = '/panel/orders'
                    },
                    error: (err) => {
                        if (err.status === 422 && err.responseJSON.errors.hasOwnProperty('password')) {
                            $('#newAccountPasswordInputWrapper').addClass('has-feedback has-error');
                            $('#newAccountPasswordInputErrorWrapper').addClass('feedback error');
                            $('#newAccountPasswordInputErrorWrapper').text(err.responseJSON.errors.password[0]);
                            $('#newAccountPasswordInputErrorWrapper').show();
                        }
                    }
                });
            });

            function setLoading(state) {
                if (state) {
                    $('#isLoading').show();
                } else {
                    $('#isLoading').hide();
                }
            }

            /*Checkout modal close */

            $(".modal.checkout").click(function(event){
                event.stopPropagation();
            });

            $('#modal-close-checkout-btn').on('click', function() {
                // Cloudflare Zaraz event
                @if(auth()->id())
                zaraz.track('close-checkout', { user_id: {!! auth()->id() !!} });
                @else
                zaraz.track('close-checkout');
                @endif

                checkoutModalClose();
            });

            function checkoutModalClose() {
                if ($('.modal-overlay').hasClass('show')) {
                    $('body').removeClass('overlay');
                    $('.modal').removeClass('modal-animation--long');
                    $('.modal-overlay').removeClass('show')
                }
            }

            window.paypalCheckoutReady = function () {
                paypal.checkout.setup("{{ env('PAYPAL_MERCHANT_ID') }}", {
                    environment: '{{ env('PAYPAL_MODE') }}',
                    buttons: ['pay-with-paypal'],
                    click: function (event) {
                        event.preventDefault()

                        let gameType = '{{ $gameType  }}',
                            platform = $('select.platform').val(),
                            boostType = $('select.boost-type').val(),
                            currentRank = parseInt($('select.rank').val()),
                            desiredRank = parseInt($('select#desired-rank').val()),
                            desiredWins = parseInt($('select#desired-wins').val()),
                            options = getOptionsValue();

                        @if ($gameType == 'valorant' || $gameType == 'lol')
                            let currentLp = parseInt($('select#current-lp').val());
                            let region = $('#region').val();
                        @else
                            let region = "{{ session('user.regionCode') }}";
                        @endif

                        if (boostType === 'win') {
                            desiredRank = desiredWins;
                        } else if(boostType === 'placement' && (desiredWins > 0 && desiredWins <= 10)) {
                            desiredRank = desiredWins;
                        }

                        paypal.checkout.initXO();

                        $.ajax({
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '/set-paypal-express-checkout',
                            data: {
                                'gametype': gameType,
                                'platform': platform,
                                'type': boostType,
                                'currentRank': currentRank,
                                'desiredRank': desiredRank,
                                'options': options,
                                'returnUrl': window.location.href,
                                'region': region,
                                @if ($gameType == 'valorant' || $gameType == 'lol')
                                    'currentLp': currentLp,
                                @endif
                                @if($gameType == 'lol')
                                'currentLPMaster': $('.current_lp_master').val(),
                                'desiredLPMaster': $('.desired_lp_master').val(),
                                @endif
                            },
                            success:(res) => {
                                let paypalOrderId = res['id'];

                                paypal.checkout.startFlow(paypalOrderId);
                            },
                            error: (err) => {
                                paypal.checkout.closeFlow();
                            }
                        })
                    }
                });
            }

            let orderId = "{{session('PAYPAL_ORDER_ID')}}";

            if (orderId) {
                $.ajax({
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/paypal/intent/validate',
                    success: async (res) => {
                        if (res.success) {
                            let customer = res.customer;
                            let order = res.order;
                            let isUserLoggedIn = '{{ auth()->check() }}';
                             // Cloudflare Zaraz event
                            zaraz.ecommerce('Order Completed',
                                {
                                    currency: order.currency,
                                    total: order.total,
                                    order_id: order.id,
                                }
                            );
                            
                            if (isUserLoggedIn) {
                                window.location.href = '/panel/orders?status=order_success';
                                return;
                            }

                            if (customer.active) {
                                window.location.href = '/member/login?order_success=true&email=' + customer.email;
                            } else {
                                $('#order_id').val(order.order_id);
                                showCheckout();
                                $('#checkout').hide();
                                checkoutLoading();
                                $('.password-save-form').css({'display': 'flex'});
                                $('.payment-completed').show();
                            }
                        } else {
                            showCheckout();
                            checkoutLoading();
                            $('.payment-error').show();
                        }
                    },
                    error: err => console.log('err', err)
                })
            }
        });
    </script>
@endpush
