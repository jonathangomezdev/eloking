@extends('panel.layout.main')
@section('content')
    <div class="content">
        <div class="container inner header">
            <h1>Booster <span>{{ $booster->name }}</span></h1>
            <a href="{{ URL::to('/panel/booster/'.$booster->id.'/payouts/create') }}" class="button">Add Payout</a>
        </div>
        <div class="floating-button"></div>
        <div class="container inner booster-details-page">
            <div class="payout-title">
                <h3>Payouts</h3>
            </div>
            <div class="payouts-wrapper">
                <div class="payout-box">
                    <h4>Pending: {{ $booster->payouts->totalPending() }}</h4>
                </div>
                <div class="payout-box">
                    <h4>Progress: {{ $booster->payouts->totalProgress() }}</h4>
                </div>
                <div class="payout-box">
                    <h4>Review: {{ $booster->payouts->totalReview() }}</h4>
                </div>
                <div class="payout-box">
                    <h4>Completed: {{ $booster->payouts->totalCompleted() }}</h4>
                </div>
            </div>
        </div>
    </div>
@endsection
