@extends('panel.layout.main')
@section('content')
    <div class="content">
        <div class="container inner header">
            <h1>Ready For <span>Pickup</span></h1>
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
                                Action
                            </div>
                        </th>
                        <th class="re-table__h re-table__h--max">
                            <div>
                                Earnings
                            </div>
                        </th>
                        <th class="re-table__h re-table__h--last">
                            <div></div>
                        </th>
                    </tr>
                    @forelse ($orders as $order)
                        <x-order-table-row :order="$order" page="jobs" area="pickup" />
                    @empty
                        <tr class="re-table__row">
                            <td class="re-table__cell" colspan="6">
                                <p class="p15-v">No jobs open for pickup.</p>
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
            <h2>My <span>Jobs</span></h2>
        </div>
        @if (session('success'))
            <div class="alert success">
                <span>{{ session('success') }}</span>
            </div>
        @endif
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
                                Booster
                            </div>
                        </th>
                        <th class="re-table__h re-table__h--max">
                            <div>
                                Earnings
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
                    @forelse ($pickedUpOrders as $order)
                        <x-order-table-row :order="$order" page="jobs" />
                    @empty
                        <tr class="re-table__row">
                            <td class="re-table__cell" colspan="6">
                                <p class="p15-v">No jobs in progress.</p>
                            </td>
                        </tr>
                    @endforelse
                </table>
                {{ $pickedUpOrders->links() }}
            </div>
        </div>
    </div>
@endsection
