@extends('panel.layout.main')
@section('content')
    <div class="inner-order">
        <div class="inner-order__left">
            <div class="order-container-wider">
                <div class="single-order-header">
                    <a href="#" class="inner-back" onclick="window.history.back()">
                        <img src="{{ asset('img/icons/arrow-right.svg') }}" alt="Arrow back" />
                    </a>
                    <h1>Order <span>#{{$order->order_id}}</span></h1>
                    @if (isset($order->payload['options']) && in_array('priority_order', $order->payload['options']))
                    <div class="info-bubble">
                        <div class="wrap">
                            <div class="heading">
                                <img src="{{ asset('img/icons/info.svg') }}" alt="Info"/>
                                <span>Info</span>
                            </div>
                            <div class="content">
                                This is a priority order and our team will push it in front of any other order we have.</div>
                        </div>
                        <div class="icon">
                            <img src="{{ asset('img/icons/info-bubble.svg') }}" alt="Info Bubble"/>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @if ($order->status === \App\Order::STATUS_PAYMENT_PENDING)
                <div>
                    <x-complete-order-payment :order="$order" />
                </div>
            @else
                <div class="panel-chat">
                    <x-messenger :order="$order" />
                </div>
            @endif
        </div>
        <div class="inner-order__right">
            <div class="action-header">
                <div class="order-container-small">
                    @if ($order->status !== \App\Order::STATUS_PAYMENT_PENDING)
                        <button class="dropdown-button">
                            <span>
                                Boost Actions
                            </span>
                            <div class="dropdown-wrap">
                                <ul class="dropdown-btns">
                                    @if ($order->order_total_EUR > $order->total_EUR)
                                        <li class="dropdown-btns__item">
                                            <a class="button" href="#" id="payNow">
                                                Pay missing  {{ currencyFormatted(convertToCurrency($order->order_total_EUR - $order->total_EUR, $order->currency), $order->currency, true) }}
                                            </a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasRole('admin'))
                                        <li class="dropdown-btns__item">
                                            <a class="button" href="{{ URL::to('/panel/order/' . $order->order_id . '/edit') }}">
                                                Edit Order
                                            </a>
                                        </li>
                                        @if($order->status !== \App\Order::STATUS_REFUNDED)
                                            <li class="dropdown-btns__item">
                                                <a class="button" href="#" id="btnRefund">
                                                    Refund Order
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                    @if(($order->booster() && !$order->isDropped() && $order->status != \App\Order::STATUS_COMPLETED && $order->status !== \App\Order::STATUS_REFUNDED) && auth()->user()->hasRole('admin'))
                                        <li class="dropdown-btns__item">
                                            <a class="button" href="#" id="btnDropOrder">
                                                Drop Order
                                            </a>
                                        </li>
                                    @endif
                                    @if (!($order->booster() && $order->booster()->id == auth()->id()) && !$order->isPayoutCreated())
                                        <li class="dropdown-btns__item">
                                            <a class="button" href="#" id="btnTipBooster">
                                                Tip Booster
                                            </a>
                                        </li>
                                    @endif
                                    @if(auth()->user()->hasRole('admin') && $order->booster() && $order->status !== \App\Order::STATUS_COMPLETED)
                                        <li class="dropdown-btns__item">
                                            <a class="button" href="{{ URL::to('/panel/order/' . $order->order_id . '/booster/unassigned') }}" >
                                                Remove Booster
                                            </a>
                                        </li>
                                    @endrole
                                    @if ($order->gametype !== 'csgo' && ($order->status == \App\Order::STATUS_READY || $order->status == \App\Order::STATUS_READY_FOR_PICKUP))
                                        @if (!($order->status == \App\Order::STATUS_COMPLETED || $order->status == \App\Order::STATUS_REFUNDED))
                                            @if(auth()->user()->hasRole('admin'))
                                                <li class="dropdown-btns__item">
                                                    <a class="button" href="#" id="addChampion">
                                                        Update
                                                        @if ($order->gametype === 'lol')
                                                            Champions
                                                        @else
                                                            Agents
                                                        @endif
                                                    </a>
                                                </li>
                                            @else
                                                <li class="dropdown-btns__item">
                                                    <a class="button" href="#" id="addChampion">
                                                        Select
                                                        @if ($order->gametype === 'lol')
                                                            Champions
                                                        @else
                                                            Agents
                                                        @endif
                                                    </a>
                                                </li>
                                            @endif
                                        @endif
                                    @endif
                                    @if (! $order->isCompleted() && (! isset($order->payload['options']) || !(isset($order->payload['options']) && in_array('duoq', $order->payload['options']))))
                                    <li class="dropdown-btns__item">
                                        <a class="button" href="#" id="btnAccountDetail">
                                            @if($order->user_id == auth()->id()) Share @endif Credentials
                                        </a>
                                    </li>
                                    @endif
                                    @if($order->status === \App\Order::STATUS_COMPLETED)
                                        @if($order->isDropped() && ($order->user_id === auth()->id() || auth()->user()->hasRole('admin')))
                                            @php $count = 1 @endphp
                                            @foreach(\App\Invoice::where('order_id', $order->id)->where('invoice_for', 'customer')->get() as $invoice)
                                                @if($invoice->total > 0)
                                                <li class="dropdown-btns__item">
                                                    <a class="button" target="_blank" href="{{ $order->getInvoiceDownloadLink('customer', $invoice->id) }}">
                                                        Download Invoice {{ $count }}
                                                    </a>
                                                </li>
                                                @endif
                                                @php $count++ @endphp
                                            @endforeach
                                        @else
                                            @php $invoice = \App\Invoice::where('order_id', $order->id)->where('invoice_for', 'customer')->first() @endphp
                                            @if($invoice)
                                                <li class="dropdown-btns__item">
                                                    <a class="button" target="_blank" href="{{ $order->getInvoiceDownloadLink('customer', $invoice->id) }}">
                                                        Download Invoice
                                                    </a>
                                                </li>
                                            @endif
                                        @endif
                                        @if(auth()->user()->hasRole('admin') || $order->isThisAssignedBooster(auth()->id()))
                                            @if($order->isDropped())
                                                @role('admin')
                                                    @php $count = 1 @endphp
                                                    @foreach(\App\Invoice::where('order_id', $order->id)->where('invoice_for', 'booster')->get() as $invoice)
                                                        @if ($invoice->total > 0)
                                                        <li class="dropdown-btns__item">
                                                            <a class="button" target="_blank" href="{{ $order->getInvoiceDownloadLink('booster', $invoice->id) }}">
                                                                Platform Invoice {{ $count  }}
                                                            </a>
                                                        </li>
                                                        @endif
                                                        @php $count++ @endphp
                                                    @endforeach
                                                @endrole
                                                @if($invoice = \App\Invoice::where('order_id', $order->id)->where('customer_id', auth()->id())->first())
                                                    <li class="dropdown-btns__item">
                                                        <a class="button" target="_blank" href="{{ $order->getInvoiceDownloadLink('booster', $invoice->id) }}">
                                                            Platform Invoice
                                                        </a>
                                                    </li>
                                                @endif
                                            @else
                                                @php $invoice = \App\Invoice::where('order_id', $order->id)->where('invoice_for', 'booster')->first() @endphp
                                                @if($invoice)
                                                    <li class="dropdown-btns__item">
                                                        <a class="button" target="_blank" href="{{ $order->getInvoiceDownloadLink('booster', $invoice->id) }}">
                                                            Platform Invoice
                                                        </a>
                                                    </li>
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                    @if($order->status === \App\Order::STATUS_READY && ($order->isThisAssignedBooster(auth()->id()) || auth()->user()->hasRole('admin')))
                                        <li class="dropdown-btns__item">
                                            <x-start-order :order="$order" />
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </button>
                        <div class="panel-subtitle">
                            @if($order->user_id == auth()->id())
                                Booster
                            @else
                                Customer
                            @endif
                                Information
                        </div>
                        <div class="booster-info">
                            @if(!$order->booster())
                                <div class="booster-info__title">Searching...</div>
                            @else
                                <div class="booster-info__title">Name</div>
                                <div class="booster-info__wrap">
                                    <div class="user-letter {{ strtolower(substr($order->booster()->username, 0, 1)) }}">
                                        @if($order->user_id == auth()->id())
                                            <span class="user-status-dot @if($order->booster()->isOnline()) online @else offline @endif"></span>
                                            {{ strtolower(substr($order->booster()->username, 0, 1)) }}
                                        @else
                                            <span class="user-status-dot @if($order->user->isOnline()) online @else offline @endif"></span>
                                            {{ strtolower(substr($order->user->username, 0, 1)) }}
                                        @endif
                                    </div>
                                    <div class="booster-info__name">
                                        @if($order->user_id == auth()->id())
                                            {{ $order->booster()->username }}
                                        @else
                                            {{ $order->user->username }}
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        @role('admin')
                            <x-move-to-order-log :order="$order" />
                        @endrole
                    @endif
                </div>
            </div>

            <div class="order-info">
                <div class="order-container-small">
                    <div class="panel-subtitle">
                        Order Information
                    </div>
                    <div class="details-info">
                        <div class="details-info__item">
                            <div class="details-info__title">Game</div>
                            <div class="details-info__holder">
                                <img src="{{ asset('img/icons/' . $order->gametype . '.svg') }}" alt="{{ strtoupper($order->gametype) }} Logo"/>
                                @if ($order->gametype === 'csgo')
                                    <span>CS:GO</span>
                                @elseif ($order->gametype === 'lol')
                                    <span>League of Legends</span>
                                @elseif ($order->gametype === 'valorant')
                                    <span>Valorant</span>
                                @endif
                            </div>
                        </div>
                        <div class="details-info__item">
                            <div class="details-info__title">Type</div>
                            <div class="details-info__holder">
                                @if ($order->type === 'rank')
                                    <div class="bubble spaced-thin flex">
                                        <img title="{{ $order->rankName('currentRank') }}" src="{{ asset('img/icons/'.$order->gametype.'/ranks/'.$order->platform.'/'.$order->payload['currentRank'].'.png') }}" alt="Rank" title="Rank"/>
                                        @if($order->gametype != 'csgo') <span>{{ $order->rankName('currentRank', true) }}</span> @endif
                                        <div class="rank-to"></div>
                                        <img title="{{ $order->rankName('desiredRank') }}" src="{{ asset('img/icons/'.$order->gametype.'/ranks/'.$order->platform.'/'.$order->payload['desiredRank'].'.png') }}" alt="Rank" title="Rank"/>
                                        @if($order->gametype != 'csgo') <span>{{ $order->rankName('desiredRank', true) }}&nbsp;</span> @endif
                                    </div>
                                @elseif($order->type === 'win')
                                    <div class="bubble spaced">
                                        <img title="{{ $order->rankName('currentRank') }}" src="{{ asset('img/icons/'.$order->gametype.'/ranks/'. $order->platform .'/'.$order->payload['currentRank'].'.png') }}" alt="Rank" title="Rank"/>
                                        <span>{{ $order->payload['desiredRank'] == 1 ? $order->payload['desiredRank'] . ' win' : $order->payload['desiredRank'] . ' wins' }}</span>
                                    </div>
                                @elseif($order->type === 'placement')
                                    <div class="bubble spaced">
                                        <span>Placement: </span>
                                        <span>{{ $order->payload['desiredRank'] == 1 ? $order->payload['desiredRank'] . ' game' : $order->payload['desiredRank'] . ' games' }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="details-info__item">
                            <div class="details-info__title">Status</div>
                            <div class="details-info__holder">
                                <div class="order-addons order-addons--large
                                    @if(str_contains($order->status, 'completed'))
                                    order-addons--completed
                                    @elseif(str_contains($order->status, 'pickup'))
                                    order-addons--pickup
                                    @elseif(str_contains($order->status, 'failed') || str_contains($order->status, 'pending') || str_contains($order->status, 'refunded'))
                                    order-addons--red
                                    @else
                                    order-addons--default
                                    @endif
                                    ">
                                    <span>{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $order->status)) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="details-info__item">
                            <div class="details-info__title">Region</div>
                            <div class="details-info__holder">
                                <span class="details-info__shining glow">
                                    <img src="{{ asset('img/icons/flags/'. strtolower($order->region) .'.svg') }}" onerror="src='{{ asset('img/icons/flags/glob.png') }}'" alt="Flag" title="{{ $order->getRegionName() }}"/>
                                </span>
                                <span>{{ $order->getRegionName() }}</span>
                            </div>
                        </div>
                        @if ($order->gametype !== 'csgo' && count($order->champions()) > 0)
                        <div class="details-info__item  @if ($order->champions()->count() > 7) details-info__item--start @endif">
                            <div class="details-info__title">Champ.</div>
                            <div class="details-info__holder">
                                <div class="stack">
                                    @if ($order->gametype == 'lol')
                                        @foreach ($order->champions() as $champion)
                                            <span class="details-info__shining glow info-bubble" style="z-index: {{$loop->count - $loop->index + 1}};">
                                                <div class="wrap">
                                                    <div class="content">
                                                        {{ $champion->name }}
                                                    </div>
                                                </div>
                                                <div class="champion-wrap">
                                                    <img src="{{ asset('img/champions/lol/' . $champion->getImageFileName()) }}" alt="Character"/>
                                                </div>
                                            </span>
                                        @endforeach
                                    @endif
                                    @if($order->gametype == 'valorant')
                                        @foreach ($order->champions() as $champion)
                                            <span class="details-info__shining glow tooltip-link info-bubble" data-tooltip="Click to Open" style="z-index: {{$loop->count - $loop->index + 1}};">
                                                <div class="wrap">
                                                    <div class="content">
                                                        {{ $champion->name }}
                                                    </div>
                                                </div>
                                                <div class="champion-wrap">
                                                    <img src="{{ asset('img/champions/valorant/' . $champion->getImageFileName()) }}" alt="Character"/>
                                                </div>
                                            </span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($order->isDropped() && $order->user_id != auth()->id())
                            <div class="details-info__item">
                                <div class="details-info__title">Drop Order</div>
                                <div class="details-info__holder">
                                <span class="details-info__shining glow">
                                    {{ $order->droppedComment() }}
                                </span>
                                </div>
                            </div>
                        @endif
                        @if ($order->type === 'placement')
                            <div class="details-info__item">
                                <div class="details-info__title">Prev. Rank</div>
                                <div class="details-info__holder">
                                    <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/'.$order->gametype.'/ranks/'. $order->platform .'/'.$order->payload['currentRank'].'.png') }}" alt="Rank"/>
                                    <span>{{ $order->rankName('currentRank') }}</span>
                                </div>
                            </div>
                        @endif
                        @if ($order->payload && (isset($order->payload['options']) || isset($order->payload['currentLp']) || isset($order->payload['queueType'])))
                        <div class="details-info__item">
                            <div class="details-info__title">Details</div>
                            <div class="details-info__holder">
                                @if ($order->payload && isset($order->payload['options']))
                                    @if (in_array('duoq', $order->payload['options']))
                                        <div class="order-addons order-addons--duo">
                                            <span>DUO</span>
                                        </div>
                                    @endif

                                    @if (in_array('appear_offline', $order->payload['options']))
                                        <div class="order-addons order-addons--party">
                                            <span>Appear Offline</span>
                                        </div>
                                    @endif

                                    @if (in_array('live_stream', $order->payload['options']))
                                        <div class="order-addons order-addons--stream">
                                            <span>Stream</span>
                                        </div>
                                    @endif

                                    @if (in_array('coaching', $order->payload['options']))
                                        <div class="order-addons order-addons--stream">
                                            <span>Coaching</span>
                                        </div>
                                    @endif

                                    @if (in_array('wingman', $order->payload['options']))
                                        <div class="order-addons order-addons--stream">
                                            <span>Wingman</span>
                                        </div>
                                    @endif

                                    @if (in_array('extra_win', $order->payload['options']))
                                        <div class="order-addons order-addons--lp">
                                            <span>+1 Win</span>
                                        </div>
                                    @endif

                                    @if (in_array('champions_roles', $order->payload['options']))
                                        <div class="order-addons order-addons--duo">
                                            @if ($order->gametype === 'lol')
                                                <span>Champions/Roles</span>
                                            @endif

                                            @if ($order->gametype === 'valorant')
                                                <span>Agents</span>
                                            @endif
                                        </div>
                                    @endif
                                @endif
                                @if($order->isDropped())
                                    @php $progressedLp = $order->getProgressedCurrentLp() ?? isset($order->payload['currentLp']); @endphp
                                    <div class="order-addons order-addons--lp">
                                        <span>{{ config('prices.currentLpDisplayTexts.' . $order->gametype . '.' . intval($progressedLp)) }}</span>
                                    </div>
                                @else
                                    @if(isset($order->payload['currentLp']) && !isset($order->payload['currentLPMaster']))
                                        <div class="order-addons order-addons--lp">
                                            <span>{{ config('prices.currentLpDisplayTexts.' . $order->gametype . '.' . intval($order->payload['currentLp'])) }}</span>
                                        </div>
                                    @endif
                                @endif
                                @if ($order->gametype === 'lol' && isset($order->payload['currentLPMaster']) && isset($order->payload['desiredLPMaster']))
                                    <div class="order-addons order-addons--lp">
                                        <span>LP {{ $order->payload['currentLPMaster'] }} to {{ $order->payload['desiredLPMaster'] }}</span>
                                    </div>
                                @endif
                                @if ($order->gametype === 'lol' && !isset($order->payload['currentLPMaster']) && isset($order->payload['desiredLPMaster']))
                                    <div class="order-addons order-addons--lp">
                                        <span>{{ $order->payload['desiredLPMaster'] }} LP in Master</span>
                                    </div>
                                @endif

                                @if (isset($order->payload['queueType']))
                                    <div class="order-addons order-addons--default">
                                        <span>{{ $order->payload['queueType'] }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if ($order->order_total_EUR > $order->total_EUR)
            <x-pay-more :order="$order" />
        @endif
        @if (auth()->user()->hasRole('admin'))
            <x-refund :order="$order" />
        @endif
        @if (! ($order->booster() && $order->booster()->id == auth()->id()))
            <x-booster-tip :order="$order" />
        @endif
        @if($order->booster())
            <x-drop-order :order="$order" :ranks="$ranks"></x-drop-order>
        @endif
        @if ($order->gametype !== 'csgo')
            <x-champions
                :order="$order"
                :lolChamps="$lolChamps"
                :valorantChamps="$valorantChamps"
                :champions="$champions"
            />
        @endif
        <x-game-account-details :order="$order" />
    </div>
    <div class="loading-wrap">
        <div class="loading-inner">
            <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select-champions, .select-agent').on('click', (e) => {
                $('#addChampion').trigger('click');
            })

            $('.game-credentials-modal-open').on('click', e => {
                $('#btnAccountDetail').trigger('click');
            })

            $('.leave-a-tip-modal').on('click', e => {
                console.log('trigger click');
                $('#btnTipBooster').trigger('click');
            })

            $('.contact-support-action').on('click', e => {
                window.LC_API.open_chat_window();
            })
        });
    </script>
@endpush
