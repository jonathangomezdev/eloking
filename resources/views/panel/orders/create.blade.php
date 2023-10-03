@extends('panel.layout.main')
@section('content')
    <div class="content no-border-bottom">
        <div class="container inner header">
            <h1>Create <span>Order</span></h1>
        </div>
        <div class="calculator" id="calculate-boost">
            <div class="blackbox blackbox-calculator-container">
            @include('calculator.block', ['gameType' => request()->gameType, 'ranks' => $ranks])
        </div>
    </div>
@endsection
