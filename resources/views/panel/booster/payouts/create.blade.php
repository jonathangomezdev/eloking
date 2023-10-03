@extends('panel.layout.main')
@section('content')
    <div class="content">
        <div class="container inner header">
            <h1>Booster <span>{{ $user->name }}</span></h1>
            <a href="{{ URL::to('/panel/booster/'.$user->id) }}" class="button">Cancel</a>
        </div>
        <div class="floating-button"></div>
        <div class="container inner booster-details-page">
            <div class="payout-title">
                <h3>Create Payout</h3>

                @if(session('success'))
                    <h2>{{ session('success') }}</h2>
                @endif
                <form class="form" action="{{ URL::to('/panel/booster/'.$user->id.'/payouts') }}" method="POST">
                    @csrf

                    <div class="form-row">
                        <div class="col">
                            <span>Amount (EUR)</span>
                        </div>
                        <div class="col">
                            <div class="input-group">
                                <input type="hidden" name="booster_id" value="{{ $user->id }}" />
                                <input type="number" step="0.01" value="{{ old('amount') }}" name="payout_amount_eur" required/>
                                @error('payout_amount_eur')
                                <small class="error">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <span>Booster Picked Order</span>
                        </div>
                        <div class="col">
                            <div class="input-group">
                                <select name="order_id" required>
                                    <option value="">Choose Order</option>
                                    @foreach ($user->boosting as $boosterOrder)
                                        <option value="{{ $boosterOrder->order->id }}">{{ $boosterOrder->order->user->name }} (#{{ $boosterOrder->order->id }})</option>
                                    @endforeach
                                </select>
                                @error('order_id')
                                <small class="error">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <span>Status</span>
                        </div>
                        <div class="col">
                            <div class="input-group">
                                <select name="status" required>
                                    <option value="">Choose Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="payout_failed">Payout Failed</option>
                                    <option value="completed">Completed</option>
                                    <option value="review">Review</option>
                                </select>
                                @error('order_id')
                                <small class="error">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col"></div>
                        <div class="col save-changes-button">
                            <button type="submit" class="button">
                                <div>
                                    Save Changes
                                </div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
