@extends('panel.layout.main')
@section('content')
<div class="tooltip"></div>
<div class="content">
    <div class="container inner header">
        <h1>Orders <span>Log</span></h1>
        <a href="{{ asset('/panel/order-log/cleanup') }}" class="button">Delete All</a>
    </div>
    <div class="container">
        @if (session('success'))
            <div class="alert success">
                <span>{{ session('success') }}</span>
            </div>
        @endif
        <div class="table">
            <div class="table-wrap">
                <div class="row table-head">
                    <div data-label="ID" class="cell">ID</div>
                    <div data-label="Customer" class="cell double">Customer</div>
                    <div data-label="Type" class="cell double">Type</div>
                    <div data-label="Details" class="cell double">Details</div>
                    <div data-label="Amount" class="cell">Amount</div>
                    <div class="cell text-right"></div>
                </div>
                @forelse ($orders as $order)
                    <x-order-table-row :order="$order" page="log" area="log" />
                @empty
                    <p class="p15-v">All Cleaned up</p>
                @endforelse
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
