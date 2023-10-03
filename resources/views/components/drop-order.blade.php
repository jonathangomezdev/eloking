<div class="drop-order-wrapper">
    <div class="modal-overlay dropOrderModal">
        <div class="modal">
            <button type="button" id="drop-order-modal-overlay-close" class="forgot-password-btn-close-modal"><i>&times;</i></button>
            <div class="modal__content">
                <h2>Are you sure?</h2>
                <p>10% of this order's earning will be removed from your payout.</p>
                <br>
                <form action="{{ URL::to('/panel/order/' . $order->order_id . '/booster/drop') }}" method="POST">
                    @csrf
                        @if ($order->type === 'rank')
                            <div class="profile-wrap">
                                <div class="profile-wrap__cell">
                                    <label>Progressed Rank</label>
                                    <div class="booster-selection-wrapper boost-type-select select2-trigger">
                                        <div class="booster-rank-selection-wrapper">
                                            <select
                                                class="boost-type booster-rank-selection booster-rank-selection select2"
                                                name="progressed_rank" required>
                                                <option value="">Choose an option</option>
                                                @foreach($ranks as $rank)
                                                    @if ($rank->sequence <= $order->payload['desiredRank'])
                                                        <option value="{{ $rank->sequence }}">{{ $rank->rank }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <span class="dropdown-icon">
                                            <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                        </span>
                                        </div>
                                    </div>
                                    @error('desiredRank') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>
                        @else
                        <div class="profile-wrap">
                            <div class="profile-wrap__cell">
                                <label>
                                    @if($order->type === 'placement')
                                        Placement
                                    @else
                                        Desired Wins
                                    @endif
                                </label>
                                <div class="booster-selection-wrapper boost-type-select select2-trigger">
                                    <div class="booster-rank-selection-wrapper">
                                        <select
                                            class="boost-type booster-rank-selection booster-rank-selection select2"
                                            name="progressed_rank">
                                            @foreach(range(1, 5) as $rank)
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
                        </div>
                    @endif
                    @if($order->gametype === 'valorant' || $order->gametype === 'lol')
                        <div class="profile-wrap">
                            <div class="profile-wrap__cell">
                                <label>Current LP</label>
                                <div class="booster-selection-wrapper boost-type-select select2-trigger">
                                    <div class="booster-rank-selection-wrapper">
                                        <select
                                            class="boost-type booster-rank-selection booster-rank-selection select2"
                                            name="current_lp" required>
                                            <option value="">Choose an option</option>
                                            <option @if(isset($order->payload['currentLp']) && $order->payload['currentLp'] == 1) selected @endif value="1">LP 0 - 20</option>
                                            <option @if(isset($order->payload['currentLp']) && $order->payload['currentLp'] == 2) selected @endif value="2">LP 21 - 40</option>
                                            <option @if(isset($order->payload['currentLp']) && $order->payload['currentLp'] == 3) selected @endif value="3">LP 41 - 60</option>
                                            <option @if(isset($order->payload['currentLp']) && $order->payload['currentLp'] == 4) selected @endif value="4">LP 61 - 80</option>
                                            <option @if(isset($order->payload['currentLp']) && $order->payload['currentLp'] == 5) selected @endif value="5">LP 81 - 100</option>
                                        </select>
                                        <span class="dropdown-icon">
                                            <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                        </span>
                                    </div>
                                </div>
                                @error('currentLp') <span>{{ $message }}</span> @enderror
                            </div>
                        </div>
                    @endif
                    @role('admin')
                    <div class="profile-wrap">
                        <div class="profile-wrap__cell profile-wrap__cell--full">
                            <div class="input-group">
                                <div class="multiple-check">
                                    <div class="multiple-check__cell">
                                        <input type="checkbox" name="no_penalty" id="cb12" /><label for="cb12">
                                            No Penalty
                                        </label>
                                    </div>
                                </div>
                                @error('no_penalty')
                                <small class="error">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @endrole
                    <div class="profile-wrap">
                        <div class="profile-wrap__cell reason-textarea">
                            <label>Reason</label>
                            <div class="input-group">
                                <textarea name="reason" class="panel-input" required></textarea>
                                @error('total') <span>{{ $message }}</span> @enderror
                            </div>
                            @error('desiredRank') <span>{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div>
                        <button class="button primary btn-confirm-drop">
                            Confirm Drop
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#btnDropOrder').click(function() {
                $('.dropOrderModal').toggleClass('flex');
            })
            $('#drop-order-modal-overlay-close').click(e => {
                $('.dropOrderModal').toggleClass('flex');
            })
        });
    </script>
@endpush
