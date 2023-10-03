@extends('panel.layout.main')
@section('content')
    <div class="content panel-action-edit panel-user-profile-edit">
        <div class="container inner header">
            <h1>
                Order
                <span>Edit</span>
                <a href="{{ URL::to('/panel/orders/' . $order->order_id) }}" class="move-back">
                    <img src="{{ asset('img/icons/arrow-right.svg') }}" alt="Arrow back" />
                </a>
            </h1>
            @if (session('success'))
                <div class="alert success">
                    <span>{{ session('success') }}</span>
                </div>
            @endif
        </div>
        <div class="container inner">
            <form action="{{ URL::to('/panel/orders/' . $order->order_id) }}" method="POST">
                <div class="table">
                    <div class="table-wrap">
                        <div class="row">
                            <div>
                                <input type="hidden" name="_method" value="PUT" />
                                @csrf

                                <div class="panel-subtitle">
                                    Order Details
                                </div>
                                <div class="profile-wrap">
                                    <div class="profile-wrap__cell">
                                        <label>Game Type</label>
                                        <div class="booster-selection-wrapper boost-type-select select2-trigger">
                                            <div class="booster-rank-selection-wrapper">
                                                <select
                                                    class="boost-type booster-rank-selection booster-rank-selection select2"
                                                    name="gametype">
                                                    <option @if($order->gametype === 'lol') selected @endif value="lol">League of Legends</option>
                                                    <option @if($order->gametype === 'csgo') selected @endif value="csgo">CS:GO</option>
                                                    <option @if($order->gametype === 'valorant') selected @endif value="valorant">Valorant</option>
                                                </select>
                                                <span class="dropdown-icon">
                                                    <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                                </span>
                                            </div>
                                        </div>
                                        @error('gametype') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="profile-wrap">
                                    <div class="profile-wrap__cell">
                                        <label>Status</label>
                                        <div class="booster-selection-wrapper boost-type-select select2-trigger">
                                            <div class="booster-rank-selection-wrapper">
                                                <select
                                                    class="boost-type booster-rank-selection booster-rank-selection select2"
                                                    name="status">
                                                    <option @if(\App\Order::STATUS_IN_PROGRESS === $order->status) selected @endif value="{{ \App\Order::STATUS_IN_PROGRESS }}">In Progress</option>
                                                    <option @if(\App\Order::STATUS_READY_FOR_PICKUP === $order->status) selected @endif value="{{ \App\Order::STATUS_READY_FOR_PICKUP }}">Ready for Pickup</option>
                                                    <option @if(\App\Order::STATUS_READY === $order->status) selected @endif value="{{ \App\Order::STATUS_READY }}">Ready</option>
                                                    <option @if(\App\Order::STATUS_PAYMENT_PENDING === $order->status) selected @endif value="{{ \App\Order::STATUS_PAYMENT_PENDING }}">Payment Pending</option>
                                                    <option @if(\App\Order::STATUS_COMPLETED === $order->status) selected @endif value="{{ \App\Order::STATUS_COMPLETED }}">Completed</option>
                                                    <option @if(\App\Order::STATUS_REFUNDED === $order->status) selected @endif value="{{ \App\Order::STATUS_REFUNDED }}">Refunded</option>
                                                    <option @if(\App\Order::STATUS_PAYMENT_FAILED === $order->status) selected @endif value="{{ \App\Order::STATUS_PAYMENT_FAILED }}">Payment Failed</option>
                                                </select>
                                                <span class="dropdown-icon">
                                                    <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                                </span>
                                            </div>
                                        </div>
                                        @error('status') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="panel-subtitle">
                                Addons
                            </div>
                            <div class="profile-wrap">
                                <div class="profile-wrap__cell">
                                    <div class="input-group">
                                        <label>Addons</label>
                                        <div class="multiple-check">
                                            <div class="multiple-check__cell">
                                                <input type="checkbox" name="addons[]" @if(isset($order->payload['options']) && in_array('duoq', $order->payload['options'])) checked @endif value="duoq" id="cb1" /><label for="cb1">DUO</label>
                                            </div>
                                            <div class="multiple-check__cell">
                                                <input type="checkbox" name="addons[]" @if(isset($order->payload['options']) && in_array('priority_order', $order->payload['options'])) checked @endif value="priority_order" id="cb2" /><label for="cb2">Priority Order</label>
                                            </div>
                                            <div class="multiple-check__cell">
                                                <input type="checkbox" name="addons[]" @if(isset($order->payload['options']) && in_array('appear_offline', $order->payload['options'])) checked @endif value="appear_offline" id="cb3" /><label for="cb3">Appear Offline</label>
                                            </div>
                                            <div class="multiple-check__cell">
                                                <input type="checkbox" name="addons[]" @if(isset($order->payload['options']) && in_array('live_stream', $order->payload['options'])) checked @endif value="live_stream" id="cb4" /><label for="cb4">Live Stream</label>
                                            </div>
                                            <div class="multiple-check__cell">
                                                <input type="checkbox" name="addons[]" @if(isset($order->payload['options']) && in_array('coaching', $order->payload['options'])) checked @endif value="coaching" id="cb5" /><label for="cb5">Coaching</label>
                                            </div>
                                            <div class="multiple-check__cell">
                                                <input type="checkbox" name="addons[]" @if(isset($order->payload['options']) && in_array('extra_win', $order->payload['options'])) checked @endif value="extra_win" id="cb6" /><label for="cb6">+1 Win</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="panel-subtitle">
                                Order Details
                            </div>
                            <div class="profile-wrap">
                                <div class="profile-wrap__cell">
                                    <label>Order Type</label>
                                    <div class="booster-selection-wrapper boost-type-select select2-trigger">
                                        <div class="booster-rank-selection-wrapper">
                                            <select
                                                class="boost-type booster-rank-selection booster-rank-selection select2"
                                                name="type">
                                                <option @if($order->type === 'rank') selected @endif value="rank">Rank</option>
                                                <option @if($order->type === 'win') selected @endif value="win">Win</option>
                                                <option @if($order->type === 'placement') selected @endif value="placement">Placement</option>
                                            </select>
                                            <span class="dropdown-icon">
                                                <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                            </span>
                                        </div>
                                    </div>
                                    @error('type') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="profile-wrap">
                                <div class="profile-wrap__cell">
                                    <label>Platform</label>
                                    <div class="booster-selection-wrapper boost-type-select select2-trigger">
                                        <div class="booster-rank-selection-wrapper">
                                            <select
                                                class="boost-type booster-rank-selection booster-rank-selection select2"
                                                name="platform">
                                                <option @if($order->platform === 'matchmaking') selected @endif value="matchmaking">Matchmaking</option>
                                                <option @if($order->platform === 'faceit') selected @endif value="faceit">Faceit</option>
                                                <option @if($order->platform === 'esea') selected @endif value="esea">ESEA</option>
                                            </select>
                                            <span class="dropdown-icon">
                                                <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                            </span>
                                        </div>
                                    </div>
                                    @error('platform') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="panel-subtitle">
                                Rank
                            </div>
                            <div class="profile-wrap">
                                <div class="profile-wrap__cell">
                                    <label>@if($order->type === 'placement') Prev. @else Current @endif Rank</label>
                                    <div class="booster-selection-wrapper boost-type-select select2-trigger">
                                        <div class="booster-rank-selection-wrapper">
                                            <select
                                                class="boost-type booster-rank-selection booster-rank-selection select2"
                                                name="currentRank">
                                                @foreach($ranks as $rank)
                                                    <option @if($order->payload['currentRank'] == $rank->sequence) selected @endif value="{{ $rank->sequence }}">{{ $rank->rank }}</option>
                                                @endforeach
                                            </select>
                                            <span class="dropdown-icon">
                                                <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                            </span>
                                        </div>
                                    </div>
                                    @error('currentRank') <span>{{ $message }}</span> @enderror
                                </div>
                                @if ($order->type === 'rank')
                                    <div class="profile-wrap__cell">
                                        <label>Desired Rank</label>
                                        <div class="booster-selection-wrapper boost-type-select select2-trigger">
                                            <div class="booster-rank-selection-wrapper">
                                                <select
                                                    class="boost-type booster-rank-selection booster-rank-selection select2"
                                                    name="desiredRank">
                                                    @foreach($ranks as $rank)
                                                        <option @if($order->payload['desiredRank'] == $rank->sequence) selected @endif value="{{ $rank->sequence }}">{{ $rank->rank }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="dropdown-icon">
                                                    <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                                </span>
                                            </div>
                                        </div>
                                        @error('desiredRank') <span>{{ $message }}</span> @enderror
                                    </div>
                                @elseif($order->type === 'placement')
                                    <div class="profile-wrap__cell">
                                        <label>Desired Placements</label>
                                        <div class="booster-selection-wrapper boost-type-select select2-trigger">
                                            <div class="booster-rank-selection-wrapper">
                                                <select
                                                    class="boost-type booster-rank-selection booster-rank-selection select2"
                                                    name="desiredRank">
                                                    @if($order->gametype === 'lol')
                                                        @foreach(range(1, 10) as $rank)
                                                            <option @if($rank == $order->payload['desiredRank']) selected @endif value="{{ $rank }}">{{ $rank }}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach(range(1, 5) as $rank)
                                                            <option @if($rank == $order->payload['desiredRank']) selected @endif value="{{ $rank }}">{{ $rank }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <span class="dropdown-icon">
                                                    <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                                </span>
                                            </div>
                                        </div>
                                        @error('desiredRank') <span>{{ $message }}</span> @enderror
                                    </div>
                                @elseif($order->type === 'win')
                                    <div class="profile-wrap__cell">
                                        <label>Desired Wins</label>
                                        <div class="booster-selection-wrapper boost-type-select select2-trigger">
                                            <div class="booster-rank-selection-wrapper">
                                                <select
                                                    class="boost-type booster-rank-selection booster-rank-selection select2"
                                                    name="desiredRank">
                                                    @foreach(range(1, 10) as $rank)
                                                        <option @if($rank == $order->payload['desiredRank']) selected @endif value="{{ $rank }}">{{ $rank }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="dropdown-icon">
                                                    <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                                </span>
                                            </div>
                                        </div>
                                        @error('desiredRank') <span>{{ $message }}</span> @enderror
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="panel-subtitle">
                                Amount
                            </div>
                            <div class="profile-wrap">
                                <div class="profile-wrap__cell">
                                    <label>Total Paid</label>
                                    <div class="input-group">
                                        <input type="number" step="0.01" name="total" value="{{ $order->total }}" class="panel-input"/>
                                        <div class="input-group__curr">
                                            €
                                        </div>
                                        @error('total') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="profile-wrap__cell">
                                    <label>Currency</label>
                                    <div class="booster-selection-wrapper boost-type-select select2-trigger">
                                        <div class="booster-rank-selection-wrapper">
                                            <select
                                                class="boost-type booster-rank-selection booster-rank-selection select2"
                                                name="currency">
                                                <option @if($order->currency === 'USD') selected @endif value="USD">USD</option>
                                                <option @if($order->currency === 'GBP') selected @endif value="GBP">GBP</option>
                                                <option @if($order->currency === 'EUR') selected @endif value="EUR">EUR</option>
                                            </select>
                                            <span class="dropdown-icon">
                                                <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                            </span>
                                        </div>
                                    </div>
                                    @error('currency') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="profile-wrap">
                                <div class="profile-wrap__cell">
                                    <label>Total Paid (EUR)</label>
                                    <div class="input-group">
                                        <input type="number" step="0.01" name="total_EUR" value="{{ $order->total_EUR }}" class="panel-input"/>
                                        <div class="input-group__curr">
                                            €
                                        </div>
                                        @error('total') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="profile-wrap__cell">
                                    <label>Booster Earning (EUR)</label>
                                    <div class="input-group">
                                        <input type="number" step="0.01" name="booster_earning_EUR" value="{{ $order->booster_earning_EUR }}" class="panel-input"/>
                                        <div class="input-group__curr">
                                            €
                                        </div>
                                        @error('booster_earning_EUR') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="profile-wrap">
                                <div class="profile-wrap__cell">
                                    <label>Order Total (EUR)</label>
                                    <div class="input-group">
                                        <input type="number" step="0.01" name="order_total_EUR" value="{{ $order->order_total_EUR }}" class="panel-input"/>
                                        <div class="input-group__curr">
                                            €
                                        </div>
                                        @error('order_total_EUR') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="profile-wrap" >
                                <div class="profile-wrap__cell profile-wrap__cell--full">
                                    <div class="input-group">
                                        <div class="multiple-check">
                                            <div class="multiple-check__cell">
                                                <input type="checkbox" name="inform_customer" id="cb11" /><label for="cb11">
                                                    Inform the customer about order change
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="inform_customer_message_wrapper" class="profile-wrap inform_customer_message_wrapper">
                                <div class="profile-wrap__cell profile-wrap__cell--full">
                                    <label for="inform_customer_message">Your Message</label>
                                    <div class="input-group">
                                        <textarea name="inform_customer_message" class="panel-input inform_customer_message" rows="40"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <button type="submit" class="panel-btn">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#cb11').on('change', (e) => {
                $('#inform_customer_message_wrapper').toggle('show')
            });
        });
    </script>
@endpush

