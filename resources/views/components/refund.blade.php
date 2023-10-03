<div class="refund">
    <div class="modal-overlay refundModal">
        <div class="modal modal-bg modal-animation">
            <button type="button" id="modal-overlay-close" class="forgot-password-btn-close-modal"><i>&times;</i></button>
            <h2><span>Create</span> Refund</h2>
            <form action="{{ URL::to('/panel/order/' . $order->order_id . '/refund') }}" method="POST">
                @csrf
                @if($order->payment_gateway === \App\Order::PAYPAL_GATEWAY)
                    <p>
                        PayPal doesn't allow partial refund. Only full refunds are allowed.
                    </p>
                    <br>
                @endif
                <p></p>
                <div class="input-group">
                    <div class="multiple-check">
                        <div class="multiple-check__cell">
                            <input id="fullRefund" @if($order->payment_gateway === \App\Order::PAYPAL_GATEWAY) disabled @endif type="checkbox" checked name="fullRefund" />
                            <label for="fullRefund">
                                Refund Full Amount
                            </label>
                        </div>
                    </div>
                    @error('fullRefund') {{ $message }} @enderror
                </div>
                <div class="input-group">
                    <div class="multiple-check">
                        <div class="multiple-check__cell">
                            <input id="offlineRefund" type="checkbox" name="offlineRefund" />
                            <label for="offlineRefund">
                                Offline Refund
                            </label>
                        </div>
                    </div>
                    @error('offlineRefund') {{ $message }} @enderror
                </div>
                <div class="input-group hidden" id="refundAmount">
                    <input type="number" placeholder="Amount" step="0.01" class="panel-input" maxlength="{{ $order->total_EUR }}" name="amount" />
                    <div class="input-group__curr">
                        €
                    </div>
                    @error('amount') {{ $message }} @enderror
                </div>
                <button class="panel-btn">Refund 😢</button>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#btnRefund').click(function() {
                $('.refundModal').addClass('show');
            })

            function closeModal() {
                $('.refundModal').removeClass('show');
            }

            $(document).keyup(function(e) {
                if (e.key === "Escape") { // escape key maps to keycode `27`
                    closeModal();
                }
            });

            $('.refundModal, #modal-overlay-close').on('click', function(e){
                e.stopPropagation();
                closeModal();
            })
            $('.modal').on('click', function(e){
                e.stopPropagation();
            })

            $('#fullRefund').click(function() {
                if ($(this).is(':checked')) {
                    $('#refundAmount').hide();
                } else {
                    $('#refundAmount').show();
                }
            })
        });
    </script>
@endpush
