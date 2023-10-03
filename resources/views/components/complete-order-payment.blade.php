<div class="order-failed-payment text-white">
    Please make payment to complete this order.
    <div>
        <button id="payNowBtn" class="button primary pay-now-button">Pay now</button>
    </div>
</div>
<div class="modal-overlay completeOrderPaymentModal">
    <div class="modal checkout">
        <div class="modal-content">
            <button class="modal-close-btn" id="modal-close-checkout-btn">
                <img src="{{ asset('img/1x1.png') }}" data-src="{{ asset('img/close-modal.svg') }}" class="lazyload" alt="icon"/>
                Cancel
            </button>
        </div>
        <div class="checkout-form">
            <div id="payment-complete-error" class="alert alert-error"></div>
            <form id="payment-complete-form">
                <div id="payment-complete-element">
                    <!--Stripe.js injects the Payment Element -->
                </div>
                <div class="totals-wrapper">
                    <div class="left-bar"></div>
                    <div>
                        <div class="totals">
                            <div class="grand-total">
                                <h4>Total Price: <span class="amount total-price-wrapper">{{ currencyFormatted($order->total, $order->currency) }}</span></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <button id="complete-form-submit-button" class="submit-button">
                    <span id="btnPayCompleteLoadingText" class="btnPayLoadingText">Loading...</span>
                    <span id="btnPayNowCompleteText">Pay Now</span>
                </button>
            </form>
            <div id="payment-completed" class="payment-completed">
                <h1>Thank you.</h1>
                <p>Payment successfully completed.</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            function checkoutLoading() {
                $('.loading-wrap').toggleClass('show')
            }

            function showCheckout() {
                $('.completeOrderPaymentModal').addClass('show show--opacity');
                setTimeout(function () {
                    checkoutLoading();
                    $('.completeOrderPaymentModal').removeClass('show--opacity');
                    $('.completeOrderPaymentModal .modal').addClass('modal-animation--long');
                }, 5000);
            }

            let stripe = '';

            $('#payNowBtn').click(async function() {
                checkoutLoading();
                $.getScript( "https://js.stripe.com/v3/" )
                    .done(function( script, textStatus ) {
                        stripe = Stripe("{{ env('STRIPE_KEY') }}");
                        getPayNowIntent();
                        showCheckout();
                    })
            });

            var paymentCompleted = false;

            $('#modal-close-checkout-btn').click(function() {
                if (paymentCompleted) {
                    window.location.reload();
                }
                $('.completeOrderPaymentModal').removeClass('show');
                $('.completeOrderPaymentModal .modal').removeClass('modal-animation--long');
            });

            function getPayNowIntent() {
                $.ajax({
                    url: '/panel/order/{{ $order->order_id }}/complete-order/intent',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: res => {
                        if (res.intent) {
                            loadStripe(res.intent);
                        }
                    },
                    error: err => console.log(err),
                })
            }

            var elements;
            function loadStripe(intent) {
                elements = stripe.elements({
                    clientSecret: intent.client_secret,
                    appearance: {
                        theme: 'night',
                    }
                });

                let paymentElement = elements.create("payment");
                paymentElement.mount("#payment-complete-element");

                return elements;
            }

            $(document).on('submit', '#payment-complete-form', handlePaymentSubmit)
            async function handlePaymentSubmit(e) {
                e.preventDefault();
                setBtnLoading(true);

                const response = await stripe.confirmPayment({
                    elements,
                    confirmParams: {
                        return_url: window.location.href + '?order_id={{ $order->order_id }}'
                    },
                    redirect: 'if_required',
                });

                if (response.error && (response.error.type === "card_error" || response.error.type === "validation_error")) {
                    if (error.decline_code === 'insufficient_funds') {
                        $('#payment-complete-error').text('Your card has insufficient funds.');
                    } else {
                        $('#payment-complete-error').text('Something went wrong. Please check your card details and try again.');
                    }
                    $('#payment-complete-error').show();
                    setBtnLoading(false);
                    return;
                }
                if (response.paymentIntent.status === 'succeeded') {
                    setPaymentCompleted(response.paymentIntent)
                }
            }

            function setBtnLoading(state) {
                if (state) {
                    $('#complete-form-submit-button').prop('disabled', true);
                    $('#btnPayCompleteLoadingText').show();
                    $('#btnPayNowCompleteText').hide();
                } else {
                    $('#complete-form-submit-button').prop('disabled', false);
                    $('#btnPayCompleteLoadingText').hide();
                    $('#btnPayNowCompleteText').show();
                }
            }

            function setPaymentCompleted(paymentIntent) {
                $.ajax({
                    url: '/api/order/{{ $order->order_id }}/success',
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        payment_id: paymentIntent.id,
                        order_id: "{{ $order->order_id }}",
                    },
                    success: res => {
                        paymentCompleted = true;
                        showThankYou();
                    },
                    error: err => console.log(err)
                })
            }

            function showThankYou() {
                $('#payment-complete-form').hide();
                $('#payment-completed').show();
            }
        });
    </script>
@endpush
