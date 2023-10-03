<tr class="re-table__row @if($page !== 'log') tooltip-link @endif" @if($page !== 'log') data-tooltip="Click to Open" @endif>
    <td data-label="ID" class="re-table__cell {{ $page != 'jobs' ?: 'double' }}">
        <a href="{{ @(!isset($area) || ($area != 'pickup') && $page !== 'log') ? URL::to('/panel/orders/'.$order->order_id) : 'javascript:void();' }}">
            @if ($order->gametype == 'csgo')
                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/csgo/matchmaking.svg') }}" alt="icon"/>
            @elseif ($order->gametype == 'valorant')
                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/valorant.svg') }}" alt="icon"/>
            @elseif ($order->gametype == 'lol')
                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/lol.svg') }}" alt="icon"/>
            @endif
            <span class="id">#{{ $order->order_id }}</span>
        </a>
    </td>
    @if($page == 'log')
        <td data-label="Customer" class="re-table__cell">
            <a href="{{ @(!isset($area) || ($area != 'pickup') && $page !== 'log') ? URL::to('/panel/orders/'.$order->order_id) : 'javascript:void();' }}">
                {{ $order->user->email }} (#{{ $order->user_id }})
            </a>
        </td>
    @endif
    <td data-label="Type" class="re-table__cell">
        <a href="{{ @(!isset($area) || ($area != 'pickup') && $page !== 'log') ? URL::to('/panel/orders/'.$order->order_id) : 'javascript:void();' }}">
            @if ($order->type === 'rank')
                <div class="bubble spaced-thin flex">
                    @if ($order->isDropped() && $order->user_id != auth()->id())
                        <img src="{{ asset('img/1x1.png') }}" title="{{ $order->rankName('progressed_rank') }}" class="lazyload" data-src="{{ asset('img/icons/'.$order->gametype.'/ranks/'.$order->platform.'/'.$order->getProgressedRank().'.png') }}" alt="Rank" title="Rank"/> @if($order->gametype != 'csgo') <span>{{ $order->rankName('currentRank', true) }}</span> @endif
                    @else
                        <img src="{{ asset('img/1x1.png') }}" title="{{ $order->rankName('currentRank') }}" class="lazyload" data-src="{{ asset('img/icons/'.$order->gametype.'/ranks/'.$order->platform.'/'.$order->payload['currentRank'].'.png') }}" alt="Rank" title="Rank"/> @if($order->gametype != 'csgo') <span>{{ $order->rankName('currentRank', true) }}</span> @endif
                    @endif
                    <div class="rank-to"></div>
                    <img src="{{ asset('img/1x1.png') }}" title="{{ $order->rankName('desiredRank') }}" class="lazyload" data-src="{{ asset('img/icons/'.$order->gametype.'/ranks/'.$order->platform.'/'.$order->payload['desiredRank'].'.png') }}" alt="Rank" title="Rank"/> @if($order->gametype != 'csgo') <span>{{ $order->rankName('desiredRank', true) }}&nbsp;</span> @endif
                </div>
            @elseif($order->type === 'win')
                <div class="bubble spaced">
                    <img src="{{ asset('img/1x1.png') }}" title="{{ $order->rankName('currentRank') }}" class="lazyload" data-src="{{ asset('img/icons/'.$order->gametype.'/ranks/'. $order->platform .'/'.$order->payload['currentRank'].'.png') }}" alt="Rank" title="Rank"/>
                    <span>{{ $order->payload['desiredRank'] == 1 ? $order->payload['desiredRank'] . ' win' : $order->payload['desiredRank'] . ' wins' }}</span>
                </div>
            @elseif($order->type === 'placement')
                <div class="bubble spaced">
                    <span>Placement: </span>
                    <span>{{ $order->payload['desiredRank'] == 1 ? $order->payload['desiredRank'] . ' game' : $order->payload['desiredRank'] . ' games' }}</span>
                </div>
            @endif
        </a>
    </td>
    <td data-label="Details" class="re-table__cell">
        <a href="{{ @(!isset($area) || ($area != 'pickup') && $page !== 'log') ? URL::to('/panel/orders/'.$order->order_id) : 'javascript:void();' }}">
            <div class="bubble spaced-thin flex">
                <div class="details-info">
                    <div class="details-info__item">
                        <div class="details-info__title">Game:</div>
                        <div class="details-info__holder">
                            <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/' . $order->gametype . '.svg') }}" alt="{{ strtoupper($order->gametype) }} Logo"/>
                            @if ($order->gametype === 'csgo')
                                <span>CS:GO</span>
                            @elseif ($order->gametype === 'lol')
                                <span>League of Legends</span>
                            @elseif ($order->gametype === 'valorant')
                                <span>Valorant</span>
                            @endif
                        </div>
                    </div>
                    @if ($order->type === 'placement')
                        <div class="details-info__item">
                            <div class="details-info__title">Prev. Rank:</div>
                            <div class="details-info__holder">
                                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/'.$order->gametype.'/ranks/'. $order->platform .'/'.$order->payload['currentRank'].'.png') }}" alt="Rank"/>
                                <span>{{ $order->rankName('currentRank') }}</span>
                            </div>
                        </div>
                    @endif
                    <div class="details-info__item">
                        <div class="details-info__title">Region:</div>
                        <div class="details-info__holder">
                            <span class="details-info__shining glow">
                                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/flags/'. strtolower($order->region) .'.svg') }}" onerror="src='{{ asset('img/icons/flags/glob.png') }}'" alt="Flag" title="{{ $order->getRegionName() }}"/>
                            </span>
                            <span>{{ $order->getRegionName() }}</span>
                        </div>
                    </div>
                    @if ($order->gametype !== 'csgo' && count($order->champions()) > 0)
                    <div class="details-info__item @if ($order->champions()->count() > 8) details-info__item--start @endif">
                        <div class="details-info__title">Champions:</div>
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
                                            <img src="{{ asset('img/1x1.png') }}" class="lazyload" title="{{ $champion->name }}" data-src="{{ asset('img/champions/lol/' . $champion->getImageFileName()) }}" alt="Character"/>
                                        </div>
                                    </span>
                                    @endforeach
                                @endif
                                @if($order->gametype == 'valorant')
                                    @foreach ($order->champions() as $champion)
                                    <span class="details-info__shining glow info-bubble" style="z-index: {{$loop->count - $loop->index + 1}};">
                                        <div class="wrap">
                                            <div class="content">
                                                {{ $champion->name }}
                                            </div>
                                        </div>
                                        <div class="champion-wrap">
                                            <img src="{{ asset('img/1x1.png') }}" class="lazyload" title="{{ $champion->name }}" data-src="{{ asset('img/champions/valorant/' . $champion->getImageFileName()) }}" alt="Character" />
                                        </div>
                                    </span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    @if ($order->payload && (isset($order->payload['options']) || isset($order->payload['currentLp']) || isset($order->payload['currentLPMaster']) || isset($order->payload['desiredLPMaster']) || isset($order->payload['queueType'])))
                        <div class="details-info__item details-info__item--start">
                            <div class="details-info__title">Details:</div>
                            <div class="details-info__holder">
                                @if ($order->payload && isset($order->payload['options']))
                                    @if (in_array('duoq', $order->payload['options']))
                                        <div class="order-addons order-addons--duo">
                                            <span>DUO</span>
                                        </div>
                                    @endif

                                    @if (in_array('appear_offline', $order->payload['options']))
                                        <div class="order-addons order-addons--default">
                                            <span>Appear Offline</span>
                                        </div>
                                    @endif

                                    @if (in_array('live_stream', $order->payload['options']))
                                        <div class="order-addons order-addons--stream">
                                            <span>Stream</span>
                                        </div>
                                    @endif

                                    @if (in_array('coaching', $order->payload['options']))
                                        <div class="order-addons order-addons--orange">
                                            <span>Coaching</span>
                                        </div>
                                    @endif

                                    @if (in_array('wingman', $order->payload['options']))
                                        <div class="order-addons order-addons--stream">
                                            <span>Wingman</span>
                                        </div>
                                    @endif

                                    @if (in_array('extra_win', $order->payload['options']))
                                        <div class="order-addons order-addons--pickup">
                                            <span>+1 Win</span>
                                        </div>
                                    @endif

                                    @if (in_array('champions_roles', $order->payload['options']))
                                        <div class="order-addons order-addons--white">
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

                                @if(isset($order->payload['queueType']))
                                    <div class="order-addons order-addons--default">
                                        <span>{{ $order->payload['queueType'] }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                    @if ($order->isDropped() && $order->user_id != auth()->id())
                        @if($order->type === 'rank')
                            <div class="details-info__item">
                                <div class="details-info__title">Orig. Rank:</div>
                                <div class="details-info__holder">
                                    <div class="bubble spaced-thin flex">
                                        <img src="{{ asset('img/1x1.png') }}" title="{{ $order->rankName('currentRank') }}" class="lazyload" data-src="{{ asset('img/icons/'.$order->gametype.'/ranks/'.$order->platform.'/'.$order->payload['currentRank'].'.png') }}" alt="Rank" title="Rank"/> @if($order->gametype != 'csgo') <span>{{ $order->rankName('currentRank', true) }}</span> @endif
                                        <div class="rank-to"></div>
                                        <img src="{{ asset('img/1x1.png') }}" title="{{ $order->rankName('desiredRank') }}" class="lazyload" data-src="{{ asset('img/icons/'.$order->gametype.'/ranks/'.$order->platform.'/'.$order->payload['desiredRank'].'.png') }}" alt="Rank" title="Rank"/> @if($order->gametype != 'csgo') <span>{{ $order->rankName('desiredRank', true) }}&nbsp;</span> @endif
                                    </div>
                                </div>
                            </div>
                        @elseif($order->type === 'win')
                            <div class="details-info__item">
                                <div class="details-info__title">Orig. Win:</div>
                                <div class="details-info__holder">
                                    <div class="bubble spaced">
                                        <img src="{{ asset('img/1x1.png') }}" title="{{ $order->rankName('currentRank') }}" class="lazyload" data-src="{{ asset('img/icons/'.$order->gametype.'/ranks/'. $order->platform .'/'.$order->payload['currentRank'].'.png') }}" alt="Rank" title="Rank"/>
                                        <span>{{ $order->getProgressedRank() == 1 ? $order->getProgressedRank() . ' win' : $order->getProgressedRank() . ' wins' }}</span>
                                    </div>
                                </div>
                            </div>
                        @elseif($order->type === 'placement')
                            <div class="details-info__item">
                                <div class="details-info__title">Orig. Placement:</div>
                                <div class="details-info__holder">
                                    <div class="bubble spaced">
                                        <span>Placement: </span>
                                        <span>{{ $order->getProgressedRank() == 1 ? $order->getProgressedRank() . ' game' : $order->getProgressedRank() . ' games' }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                <span class="glow">
                    <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/flags/'. strtolower($order->region) .'.svg') }}" onerror="src='{{ asset('img/icons/flags/glob.png') }}'" alt="Flag" class="details-flag" title="{{ $order->getRegionName() }}"/>
                </span>
                <div class="stack stack--short">
                    @if ($order->gametype == 'lol')
                        @foreach ($order->champions() as $champion)
                            @if ($loop->index < 4)
                                <span class="glow" style="z-index: {{4 - $loop->index}};">
                                    <div class="champion-wrap">
                                        <img src="{{ asset('img/1x1.png') }}" title="{{ $champion->name }}" class="lazyload" data-src="{{ asset('img/champions/lol/' . $champion->getImageFileName()) }}" alt="Character"/>
                                    </div>
                                </span>
                            @endif
                        @endforeach
                    @endif
                    @if($order->gametype == 'valorant')
                        @foreach ($order->champions() as $champion)
                            @if ($loop->index < 4)
                                <span class="glow" style="z-index: {{4 - $loop->index}};">
                                    <div class="champion-wrap">
                                        <img src="{{ asset('img/1x1.png') }}" title="{{ $champion->name }}" class="lazyload" data-src="{{ asset('img/champions/valorant/' . $champion->getImageFileName()) }}" alt="Character"/>
                                    </div>
                                </span>
                            @endif
                        @endforeach
                    @endif
                    @if($order->champions()->count() > 4)
                        <span class="champ-count">
                           +{{$order->champions()->count() - 4}}
                        </span>
                    @endif
                </div>
                @if ($order->payload && isset($order->payload['options']))
                    @if (in_array('duoq', $order->payload['options']))
                        <div class="order-addons order-addons--duo first">
                            <span>DUO</span>
                        </div>
                    @endif
                @endif
                <div class="icon-plus">
                    <div class="icon-plus-content"></div>
                </div>
            </div>
        </a>
    </td>
    @if($page != 'jobs')
        <td data-label="Price" class="re-table__cell">
            <a href="{{ @(!isset($area) || ($area != 'pickup') && $page !== 'log') ? URL::to('/panel/orders/'.$order->order_id) : 'javascript:void();' }}">
                <span class="colored">{{ currencyFormatted($order->total, $order->currency, true) }}</span>
                @if ($order->totalTip() > 0)
                    &#8203; (+<span>{{ currencyFormatted($order->totalTip(), $order->currency, true) }}</span>)
                @endif
            </a>
        </td>
    @endif
    @if((!isset($area) || ($area != 'pickup' && $page != 'log')) && $page !== 'orders')
        <td data-label="Booster" class="re-table__cell">
            <a href="{{ @(!isset($area) || ($area != 'pickup') && $page !== 'log') ? URL::to('/panel/orders/'.$order->order_id) : 'javascript:void();' }}">
                @if(!$order->booster())
                    <span>Searching</span>
                @else
                    <div class="user-letter {{ strtolower(substr($order->booster()->username, 0, 1)) }}">{{ strtolower(substr($order->booster()->username, 0, 1)) }}</div>
                    <span>{{ substr($order->booster()->username, 0, 14) }}</span>
                @endif
            </a>
        </td>
    @endif
    @if(auth()->user()->hasRole('booster') && $order->status == \App\Order::STATUS_READY_FOR_PICKUP && $page == 'jobs')
        <td data-label="Action" class="re-table__cell">
            <a href="{{ @(!isset($area) || ($area != 'pickup') && $page !== 'log') ? URL::to('/panel/orders/'.$order->order_id) : 'javascript:void();' }}">
                <form action="{{ URL::to('/panel/booster/order/' . $order->id . '/pickup') }}" method="POST">
                    @csrf
                    <button>
                        Pick Up
                    </button>
                </form>
            </a>
        </td>
    @endif
    @if(auth()->user()->hasRole('booster') && $page == 'jobs' && $page !== 'log')
        <td data-label="Earning" class="re-table__cell">
            <a href="{{ @(!isset($area) || ($area != 'pickup') && $page !== 'log') ? URL::to('/panel/orders/'.$order->order_id) : 'javascript:void();' }}">
                @if($order->isDropped() && $order->user_id != auth()->id())
                    <div class="earning-breakdown-wrapper">
                        <div class="popup">
                            <table>
                                <tr>
                                    <td>Prev. Booster Earned : </td>
                                    <td>
                                        {{ currencyFormatted(\App\Service\BoosterPayoutService::calculateOrderPayout($order, \App\BoosterOrder::where('order_id', $order->id)->whereNotNull('drop_comment')->latest()->first()->booster_id), 'EUR', true) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>You'll Earn : </td>
                                    <td>
                                        {{ currencyFormatted(\App\Service\BoosterPayoutService::calculateOrderPayout($order, auth()->id()), 'EUR', true) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Total Earning :
                                    </td>
                                    <td>
                                        {{ currencyFormatted($order->booster_earning_EUR, 'EUR', true) }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <span class="colored">
                            {{ currencyFormatted(\App\Service\BoosterPayoutService::calculateOrderPayout($order, auth()->id()), 'EUR', true) }}
                        </span>
                    </div>
                @else
                    <span class="colored">{{ currencyFormatted($order->booster_earning_EUR, 'EUR', true) }}</span>
                @endif
            </a>
        </td>
    @endif
    @if(!isset($area) || ($area != 'pickup' && $page != 'log'))
        <td data-label="Status" class="re-table__cell">
            <a href="{{ @(!isset($area) || ($area != 'pickup') && $page !== 'log') ? URL::to('/panel/orders/'.$order->order_id) : 'javascript:void();' }}">
                <div class="order-addons order-addons--large order-addons--single
                            @if(str_contains($order->status, 'completed'))
                            order-addons--completed
                            @elseif(str_contains($order->status, 'pickup'))
                            order-addons--pickup
                            @elseif(str_contains($order->status, 'ready'))
                            order-addons--stream
                            @elseif(str_contains($order->status, 'progress'))
                            order-addons--lp
                            @elseif(str_contains($order->status, 'pending'))
                            order-addons--orange
                            @elseif(str_contains($order->status, 'refunded'))
                            order-addons--inactive
                            @elseif(str_contains($order->status, 'failed'))
                            order-addons--red
                            @else
                            order-addons--default
                            @endif
                ">
                    <span>{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $order->status)) }}</span>
                </div>
            </a>
        </td>
    @endif
    @if($page !== 'log')
        <td class="re-table__cell text-right">
            <a href="{{ @(!isset($area) || ($area != 'pickup') && $page !== 'log') ? URL::to('/panel/orders/'.$order->order_id) : 'javascript:void();' }}">
                <div class="rank-to img-grad hidden-cell last-arrow"></div>
                @if (isset($order->payload['options']) && in_array('priority_order', $order->payload['options']))
                    <div class="info-bubble @if($order->isCompleted()) gray @endif">
                        <div class="wrap">
                            <div class="heading">
                                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/info.svg') }}" alt="Info"/>
                                <span>Info</span>
                            </div>
                            <div class="content">
                                This is a priority order and our team will push it in front of any other order we have.</div>
                        </div>
                        <div class="icon">
                            <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/info-bubble.svg') }}" alt="Info Bubble"/>
                        </div>
                    </div>
                @endif
                @if ($order->isDropped() && $order->user_id != auth()->id())
                    <div class="info-bubble info-bubble--dropped @if($order->isCompleted()) gray @endif">
                        <div class="wrap">
                            <div class="heading">
                                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/info.svg') }}" alt="Info"/>
                                <span>Info</span>
                            </div>
                            <div class="content">
                                {{ $order->droppedComment() }}
                            </div>
                        </div>
                        <div class="icon">
                            <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/icons/dropped.svg') }}" alt="Info Bubble Dropped"/>
                        </div>
                    </div>
                @endif
            </a>
        </td>
    @endif
</tr>

@push('scripts')
    <script type="text/javascript">
        function changeOrderStatus(e, orderId) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/panel/orders/' + orderId + '/status',
                method: 'PUT',
                data: {
                    status: e.target.value,
                },
            })
        }
    </script>
@endpush
