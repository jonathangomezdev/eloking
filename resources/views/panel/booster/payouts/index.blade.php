@extends('panel.layout.main')
@push('head')
    <link rel="stylesheet" href="{{ asset('/css/daterangepicker.css') }}" />
@endpush
@section('content')
@if (session('success'))
    <div class="alert success">
        <span>{{ session('success') }}</span>
    </div>
@endif
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('accountant'))
    <div class="content payout-page">
        <div class="table">
            <div class="filters">
                <form id="booster-filter-form" action="{{ URL::to('/panel/booster/payouts') }}" method="GET">
                    @foreach(request()->all() as $key => $value)
                        @if(!in_array($key, ['boosterId']))
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}" />
                        @endif
                    @endforeach
                    <div class="row">
                        <div class="booster-selection-wrapper mw240 boost-type-select select2-trigger">
                            <div class="booster-rank-selection-wrapper">
                                <select
                                    onChange="this.form.submit()"
                                    class="boost-type booster-rank-selection booster-rank-selection select2-searchable"
                                    name="boosterId">
                                    <option value="">Choose an option</option>
                                    @foreach ($boosters as $booster)
                                        <option @if($booster->id == request('boosterId')) selected @endif value="{{ $booster->id }}">{{ $booster->username }}</option>
                                    @endforeach
                                </select>
                                <span class="dropdown-icon">
                                    <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="container inner header">
            <h1>Completed <span>Orders</span></h1>
        </div>
        <div class="table">
            <div class="filters">
                <form id="filter-form" action="{{ URL::to('/panel/booster/payouts') }}" method="GET">
                    @foreach(request()->all() as $key => $value)
                        @if(!in_array($key, ['dates', 'search']))
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}" />
                        @endif
                    @endforeach
                    <div class="row">
                        <div class="filter-left">
                            <div class="date-range-picker-wrapper space-right">
                                <input type="text" class="date-range-picker" value="{{ request('dates') ?? now()->startOfMonth()->format('m/d/Y') . ' - ' . now()->endOfMonth()->format('m/d/Y') }}" name="dates" />
                            </div>
                            <div class="search-input">
                                <img src="{{ asset('/img/panel/icons/search.svg') }}" alt="Search"
                                     class="search-input__icon">
                                <input id="search" type="search" class="search-input__search" value="{{ request('search') }}" name="search" placeholder="Search">
                            </div>
                            <a href="#" onclick="submitForm('#filter-form')" class="button">Filter</a>
                        </div>

                        <div id="createPayoutButtonWrapper" class="createPayoutButtonWrapper">
                            <a href="#" id="btnCreatePayout" class="button primary">
                                Create Payout
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="container payout-page">
            @if(auth()->user()->hasRole('admin'))
                <div class="re-table-wrap">
                    <table class="re-table re-table--fixed">
                        <tr class="re-table__row">
                            <th class="re-table__h">
                                <div>
                                    ID
                                </div>
                            </th>
                            <th class="re-table__h">
                                <div>
                                    Date
                                </div>
                            </th>
                            <th class="re-table__h">
                                <div>
                                    Customer
                                </div>
                            </th>
                            <th class="re-table__h">
                                <div>
                                    Booster Earning
                                </div>
                            </th>
                        </tr>
                        @forelse($completedOrders as $order)
                            <tr class="re-table__row">
                                <td data-label="ID" class="re-table__cell">
                                    <a href="javascript:void();">
                                        @if(request()->boosterId)
                                        <label for="selector-{{ $order->id }}" class="checkmark-wrapper">
                                            <input type="checkbox" class="order-checkbox" value="{{ $order->id }}" id="selector-{{ $order->id }}" />
                                            <span class="checkmark-input"></span>
                                        </label>
                                        @endif
                                        @if ($order->gametype === 'valorant')
                                            <img src="{{ asset('img/icons/valorant.svg') }}" alt="Valorant Logo"/>
                                        @endif

                                        @if ($order->gametype === 'csgo')
                                            <img src="{{ asset('img/icons/csgo.svg') }}" alt="CS:GO Logo"/>
                                        @endif

                                        @if ($order->gametype === 'lol')
                                            <img src="{{ asset('img/icons/lol.svg') }}" alt="lol Logo"/>
                                        @endif
                                        <span class="id">#{{ $order->order_id }} @if($order->isDropped()) * @endif</span>
                                    </a>
                                </td>
                                <td data-label="Date" class="re-table__cell">
                                    <a href="javascript:void();">
                                        <span>{{ $order->created_at->format('d/m/Y') }}</span>
                                    </a>
                                </td>
                                <td data-label="Customer" class="re-table__cell">
                                    <a href="javascript:void();">
                                        <div class="user-letter {{ $order->user->firstLetter() }}">
                                            {{ $order->user->firstLetter() }}
                                        </div>
                                        <span>{{ $order->user->name }}</span>
                                    </a>
                                </td>
                                <td data-label="Booster Earning" class="re-table__cell">
                                    <a href="javascript:void();">
                                        <span class="colored">
                                            {{ currencyFormatted($order->payout_eligible, 'EUR', true) }}
                                            @if(!$order->isOrderDropper(request('boosterId')) && $order->totalTip(true) > 0)
                                                (Tip : {{currencyFormatted($order->totalTip(true), "EUR", true)}})
                                            @endif
                                        </span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="re-table__row">
                                <td class="re-table__cell" colspan="6">
                                    <p class="p15-v">
                                        There are no completed orders for payout.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                        @if($completedOrders->count() > 0)
                            <tr class="re-table__row">
                                <td class="re-table__cell" colspan="2">
                                    <a href="javascript:void();"></a>
                                </td>
                                <td data-label="total" class="re-table__cell">
                                    <a href="javascript:void();">
                                        Total:
                                    </a>
                                </td>
                                <td data-label="Total" class="re-table__cell">
                                    <a href="javascript:void();">
                                        <span class="colored">
                                            @php
                                                $totalTips = 0;
                                                $completedOrders->each(function($order) use (&$totalTips) {
                                                    if (!$order->isDropped() && $order->totalTip() > 0) {
                                                        $totalTips += (float)$order->totalTip();
                                                    }
                                                });
                                            @endphp
                                            {{ currencyFormatted(($completedOrders->sum('payout_eligible') + $totalTips), 'EUR', true) }}
                                        </span>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
            @else
                <div class="no-booster-selected">
                    Please search for a booster to load all completed orders.
                </div>
            @endif
        </div>
    </div>
@endrole
    @if(auth()->user()->hasRole('booster') || auth()->user()->hasRole('admin'))
        <div class="content payout-page">
            <div class="container inner header">
                <div>
                    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('accountant'))
                        <h2>Payouts <span>History</span></h2>
                    @else
                        <h1><span>My</span> Payouts</h1>
                    @endif
                </div>
                <div>
                    <div class="table">
                        <div class="filters payouts-history-wrapper">
                            <form id="history-filter-form" action="{{ URL::to('/panel/booster/payouts') }}" method="GET">
                                @foreach(request()->all() as $key => $value)
                                    @if(!in_array($key, ['historyDates', 'historySearch']))
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}" />
                                    @endif
                                @endforeach
                                <div class="row">
                                    <div class="filter-left">
                                        <div class="date-range-picker-wrapper space-right">
                                            <input type="text" value="{{ request('historyDates') ?? now()->startOfMonth()->format('m/d/Y') . ' - ' . now()->endOfMonth()->format('m/d/Y') }}" class="date-range-picker" name="historyDates" />
                                        </div>
                                        <div class="search-input">
                                            <img src="{{ asset('/img/panel/icons/search.svg') }}" alt="Search"
                                                 class="search-input__icon">
                                            <input type="search" class="search-input__search" value="{{ request('historySearch') }}" name="historySearch" placeholder="Search">
                                        </div>
                                        <a href="#" onclick="submitForm('#history-filter-form')" class="button">Filter</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="re-table-wrap">
                    <table class="re-table re-table--fixed">
                        <tr class="re-table__row">
                            <th class="re-table__h">
                                <div>
                                    ID
                                </div>
                            </th>
                            <th class="re-table__h">
                                <div>
                                    Date
                                </div>
                            </th>
                            <th class="re-table__h">
                                <div>
                                    Status
                                </div>
                            </th>
                            <th class="re-table__h">
                                <div>
                                    Amount
                                </div>
                            </th>
                        </tr>
                        @forelse($payouts as $payout)
                            <tr class="re-table__row">
                                <td data-label="ID" class="re-table__cell">
                                    @role('admin')
                                        <a href="{{ URL::to('/panel/payout/' . $payout->id) }}">
                                    @else
                                        <a href="javascript:void();" class="default">
                                    @endrole
                                        <span class="id">#{{ $payout->id }}</span>
                                        </a>
                                </td>
                                <td data-label="Date" class="re-table__cell">
                                    @role('admin')
                                        <a href="{{ URL::to('/panel/payout/' . $payout->id) }}">
                                    @else
                                        <a href="javascript:void();" class="default">
                                    @endrole
                                        <span>{{ $payout->created_at->format('d/m/Y') }}</span>
                                        </a>
                                </td>
                                <td data-label="Status" class="re-table__cell">
                                    @role('admin')
                                        <a href="{{ URL::to('/panel/payout/' . $payout->id) }}">
                                    @else
                                        <a href="javascript:void();" class="default">
                                    @endrole
                                        <span class="table-status-last">{{ ucfirst($payout->status) }}</span>
                                        </a>
                                </td>
                                <td data-label="Amount" class="re-table__cell">
                                    @role('admin')
                                        <a href="{{ URL::to('/panel/payout/' . $payout->id) }}">
                                    @else
                                            <a href="javascript:void();" class="default">
                                    @endrole
                                    <span class="colored">{{ currencyFormatted($payout->payout_amount_eur, 'EUR', true) }}</span>
                                    @role('admin')
                                        <div class="rank-to img-grad hidden-cell last-arrow"></div>
                                    @endrole
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="re-table__row">
                                <td class="re-table__cell" colspan="6">
                                    <p class="p15-v">
                                        No Payouts found!
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                        @if($payouts->count() > 0)
                            <tr class="re-table__row">
                                <td class="re-table__cell" colspan="2">
                                    <a href="javascript:void();"></a>
                                </td>
                                <td data-label="total" class="re-table__cell">
                                    <a href="javascript:void();">
                                        Total:
                                    </a>
                                </td>
                                <td data-label="Total" class="re-table__cell">
                                    <a href="javascript:void();">
                                        <span class="colored">
                                            {{ currencyFormatted(($payouts->sum('payout_amount_eur')), 'EUR', true) }}
                                        </span>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    </table>
                    {{ $payouts->appends(request()->all())->links() }}
                </div>
            </div>
        </div>
    @endif
@endsection
@push('scripts')
    <script src="{{ asset('/js/moment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/daterangepicker.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        function statusUpdateForm(e, payoutId) {
            let payoutStatus    = e.target.value;

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/panel/booster/payout/'+payoutId+'/status',
                method: 'PUT',
                data: {
                    'status' : payoutStatus
                },
                error: err => {
                    console.log('err', err)
                }
            })
        }

        $('input[type="checkbox"]').click(() => {
            let checkboxes = $('.order-checkbox:checkbox:checked');
            if (checkboxes.length > 0) {
                $('#createPayoutButtonWrapper').show();
            } else {
                $('#createPayoutButtonWrapper').hide();
            }
        })

        $('#btnCreatePayout').click(function() {
            let checkboxes = $('.order-checkbox:checkbox:checked');
            let orderIds = [];
            for (let i = 0;i < checkboxes.length;i++) {
                orderIds.push($(checkboxes[i]).val());
            }

            if (orderIds.length === 0) {
                return;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/panel/booster/{{ request()->boosterId }}/payouts',
                method: 'POST',
                data: {
                    orderIds: orderIds,
                    boosterId: "{{ request()->boosterId }}"
                },
                success: e => window.location.reload(),
                error: (err) => {
                    console.log('err', err)
                }
            })
        });

        function submitForm(id) {
            $(id).submit();
        }

        $(document).ready(function() {
            $('input[name="dates"]').daterangepicker();
            $('input[name="historyDates"]').daterangepicker();
        });
    </script>
@endpush
