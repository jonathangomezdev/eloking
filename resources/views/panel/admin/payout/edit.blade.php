@extends('panel.layout.main')
@section('content')
    <div class="content panel-user-profile-edit">
        <div class="container inner">
            <h1>
                Payout
                <span>#{{ $payout->id }}</span>
                <a href="{{ URL::to('/panel/booster/payouts') }}" class="move-back">
                    <img src="{{ asset('img/icons/arrow-right.svg') }}" alt="Arrow back" />
                </a>
            </h1>
            @if (session('success'))
                <div class="alert success">
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            <form action="{{ URL::to('/panel/payout/' . $payout->id) }}" method="POST">
                <div class="table">
                    <div class="table-wrap">
                        <div class="row">
                            <div>
                                <input type="hidden" name="_method" value="PUT" />
                                @csrf

                                <div class="panel-subtitle">
                                    Profile Information
                                </div>
                                <div class="profile-wrap">
                                    <div class="profile-wrap__cell">
                                        <div class="input-group">
                                            <label>Payout Amount (EUR)</label>
                                            <input type="text" value="{{ $payout->payout_amount_eur }}" @if($payout->status === \App\BoosterPayout::STATUS_PAYOUT_COMPLETED) disabled @endif name="payout_amount_eur" required/>
                                            @error('payout_amount_eur')
                                                <small class="error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-wrap">
                                    <div class="profile-wrap__cell">
                                        <div class="input-group">
                                            <label>Payout Fee (EUR)</label>
                                            <input type="text" value="{{ $payout->fee }}" name="fee" />
                                            @error('fee')
                                            <small class="error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-wrap">
                                    <div class="profile-wrap__cell profile-wrap__cell--full">
                                        <div class="input-group">
                                            <label>Note</label>
                                            <textarea class="panel-input" name="note" class="input" rows="10" >{{ $payout->note }}</textarea>
                                            @error('note')
                                            <small class="error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-wrap">
                                    <div class="profile-wrap__cell">
                                        <div class="input-group">
                                            <label>Status</label>
                                            <div class="booster-selection-wrapper boost-type-select select2-trigger">
                                                <div class="booster-rank-selection-wrapper">
                                                    <select @if($payout->status === \App\BoosterPayout::STATUS_PAYOUT_COMPLETED) disabled @endif name="status" id="status" class="boost-type booster-rank-selection booster-rank-selection select2" required>
                                                        <option @if(\App\BoosterPayout::STATUS_PAYOUT_PENDING === $payout->status) selected @endif value="{{ \App\BoosterPayout::STATUS_PAYOUT_PENDING }}">Pending</option>
                                                        <option @if(\App\BoosterPayout::STATUS_PAYOUT_REVIEW === $payout->status) selected @endif value="{{ \App\BoosterPayout::STATUS_PAYOUT_REVIEW }}">Review</option>
                                                        <option @if(\App\BoosterPayout::STATUS_PAYOUT_PROGRESS === $payout->status) selected @endif value="{{ \App\BoosterPayout::STATUS_PAYOUT_PROGRESS }}">In Progress</option>
                                                        <option @if(\App\BoosterPayout::STATUS_PAYOUT_COMPLETED === $payout->status) selected @endif value="{{ \App\BoosterPayout::STATUS_PAYOUT_COMPLETED }}">Completed</option>
                                                        <option @if(\App\BoosterPayout::STATUS_PAYOUT_FAILED === $payout->status) selected @endif value="{{ \App\BoosterPayout::STATUS_PAYOUT_FAILED }}">Failed</option>
                                                    </select>
                                                    <span class="dropdown-icon">
                                                        <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                                    </span>
                                                </div>
                                            </div>
                                            @error('status')
                                                <small class="error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <div class="panel-subtitle">
                                    Orders
                                </div>
                                <div class="input-group">
                                    <div class="multiple-check">
                                        @foreach($payout->orders() as $order)
                                            <div class="multiple-check__cell">
                                                <a href="{{ URL::to('/panel/orders/' . $order->order_id) }}" class="text-white">
                                                    #{{ $order->order_id }} - {{ $order->user->name }} @if($order->isDropped()) (Dropped) @endif
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($payout->status <> \App\BoosterPayout::STATUS_PAYOUT_COMPLETED)
                            <div class="row">
                                <button type="submit" class="button primary payout-save-changes-button">
                                    Save Changes
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
