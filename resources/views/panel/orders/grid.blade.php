@extends('panel.layout.main')
@section('content')
<div class="tooltip"></div>
<div class="content">
    <div class="container inner header">
        <h1>My <span>Orders</span></h1>
        <a href="#" id="btnNewOrder" class="button">New Order</a>
        <div class="modal-overlay selectGameTypeModal">
            <div class="modal modal-bg modal-animation">
                <button type="button" id="modal-overlay-close" class="forgot-password-btn-close-modal"><i>&times;</i></button>
                <h2><span>Choose your </span>game</h2>
                <div class="game-select">
                    <a href="{{ URL::to('/panel/orders/create?gameType=lol') }}" class="game-select__link game-select__link--lol">
                        <div class="game-select__title">
                            League of Legends
                        </div>
                        <div class="game-select__subtitle">
                            Get the division you desire
                        </div>
                    </a>
                    <a href="{{ URL::to('/panel/orders/create?gameType=valorant') }}" class="game-select__link game-select__link--val">
                        <div class="game-select__title">
                            Valorant
                        </div>
                        <div class="game-select__subtitle">
                            Boost your Valorant rank
                        </div>
                    </a>
                    <a href="{{ URL::to('/panel/orders/create?gameType=csgo') }}" class="game-select__link game-select__link--cs">
                        <div class="game-select__title">
                            CS:GO
                        </div>
                        <div class="game-select__subtitle">
                            Most efficient CS:GO boosting
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-order">
        @role('admin')
        <div class="table">
            <div class="filters">
                <form id="filter-form" action="{{ URL::to('/panel/orders') }}" method="GET">
                    <input type="hidden" id="sortBy" name="sortBy" />
                    <input type="hidden" id="sortOrder" name="sortOrder" />
                    <div class="row">
                        <div class="booster-selection-wrapper mw240 boost-type-select select2-trigger">
                            <div class="booster-rank-selection-wrapper">
                                <select
                                    onChange="this.form.submit()"
                                    class="boost-type booster-rank-selection booster-rank-selection select2"
                                    name="gameType">
                                    <option value="">Choose an option</option>
                                    <option @if(request('gameType') === 'lol') selected @endif value="lol">League Of Legends</option>
                                    <option @if(request('gameType') === 'valorant') selected @endif value="valorant">Valorant</option>
                                    <option @if(request('gameType') === 'csgo') selected @endif value="csgo">CS:GO</option>
                                </select>
                                <span class="dropdown-icon">
                                    <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                </span>
                            </div>
                        </div>
                        <div class="booster-selection-wrapper mw240 boost-type-select select2-trigger">
                            <div class="booster-rank-selection-wrapper">
                                <select
                                    onChange="this.form.submit()"
                                    class="boost-type booster-rank-selection booster-rank-selection select2"
                                    name="type">
                                    <option value="">Choose an option</option>
                                    <option @if(request('type') === 'placement') selected @endif value="placement">Placement</option>
                                    <option @if(request('type') === 'rank') selected @endif value="rank">Rank</option>
                                    <option @if(request('type') === 'win') selected @endif value="win">Win</option>
                                </select>
                                <span class="dropdown-icon">
                                    <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                </span>
                            </div>
                        </div>
                        <div class="search-input">
                            <img src="{{ asset('/img/panel/icons/search.svg') }}" alt="Search"
                                 class="search-input__icon">
                            <input id="search" type="search" class="search-input__search" value="{{ request('search') }}" name="search" placeholder="Search">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endrole
        <div class="re-table-wrap">
            <table class="re-table">
                <tr class="re-table__row">
                    <th class="re-table__h">
                        <div>
                            ID
                        </div>
                    </th>
                    <th class="re-table__h">
                        <div>                            
                            Type
                        </div>    
                    </th>
                    <th class="re-table__h">
                        <div>
                            Details
                        </div>
                    </th>
                    <th class="re-table__h">
                        <div>
                            Price
                        </div>
                    </th>
                    <th class="re-table__h re-table__h--max">
                        <div>
                            Status
                        </div>
                    </th>
                    <th class="re-table__h re-table__h--last">
                        <div></div>
                    </th>
                </tr>
                @forelse ($orders as $order)
                    <x-order-table-row :order="$order" page="orders" />
                @empty
                    <tr class="re-table__row">
                        <td class="re-table__cell" colspan="6">
                            <p class="p15-v">No completed orders</p>
                        </td>
                    </tr>
                @endforelse
            </table>
            {{ $orders->links() }}
        </div>
    </div>
</div>
<div class="content">
    <div class="container inner header">
        <h2>Completed <span>Orders</span></h2>
    </div>
    <div class="container">
        <div class="re-table-wrap">
            <table class="re-table">
                <tr class="re-table__row">
                    <th class="re-table__h">
                        <div>
                            ID
                        </div>
                    </th>
                    <th class="re-table__h">
                        <div>                            
                            Type
                        </div>    
                    </th>
                    <th class="re-table__h">
                        <div>
                            Details
                        </div>
                    </th>
                    <th class="re-table__h">
                        <div>
                            Price
                        </div>
                    </th>
                    <th class="re-table__h re-table__h--max">
                        <div>
                            Status
                        </div>
                    </th>
                    <th class="re-table__h re-table__h--last">
                        <div></div>
                    </th>
                </tr>
                @forelse ($completedOrders as $order)
                    <x-order-table-row :order="$order" page="orders" area="completedOrders"></x-order-table-row>
                @empty
                    <tr class="re-table__row">
                        <td class="re-table__cell" colspan="6">
                            <p class="p15-v">No completed orders</p>
                        </td>
                    </tr>
                @endforelse
            </table>
            {{ $completedOrders->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#btnNewOrder').click(() => {
                $('.selectGameTypeModal').addClass('show');
            });

            $('.selectGameTypeModal .modal-bg').on('click', function(event) {
                event.stopPropagation();
            })

            $('#modal-overlay-close, .selectGameTypeModal').on('click', function(event) {
                hideGameSelect();
            })

            $(document).keyup(function(e) {
                if (e.key === "Escape") { // escape key maps to keycode `27`
                    hideGameSelect();
                }
            });

            function hideGameSelect() {
                $('.selectGameTypeModal').removeClass('show');
            }
        });
    </script>
@endpush
