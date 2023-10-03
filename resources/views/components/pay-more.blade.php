<div class="modal-overlay payMoreModal">
    <div class="modal checkout">
        <div class="modal-content">
            <button class="modal-close-btn" id="modal-close-checkout-btn">
                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/close-modal.svg') }}" alt="Close icon"/>
                Cancel
            </button>
        </div>
        <div class="checkout-form">
            <div id="payment-error" class="alert alert-error"></div>
            <form id="payment-form">
                <div id="payment-element">
                    <!--Stripe.js injects the Payment Element -->
                </div>
                <div class="totals-wrapper">
                    <div class="left-bar"></div>
                    <div>
                        <div class="totals">
                            <div class="grand-total">
                                <h4>Total Price: <span id="checkout-price"></span></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <button id="submit-button" class="submit-button">
                    <span id="btnPayLoadingText" class="btnPayLoadingText">Loading...</span>
                    <span id="btnPayNowText">Pay Now</span>
                </button>
            </form>
            <div id="payment-completed" class="payment-completed">
                <h1>Thank you.</h1>
                <p>Payment successfully completed.</p>
                <br>
                <button id="close-modal" class="panel-btn">Close</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    jQuery(document).ready(function () {

        function checkoutLoading() {
            $('.loading-wrap').toggleClass('show')
        }

        function showCheckout() {
            $('.payMoreModal').addClass('show show--opacity');
            setTimeout(function () {
                checkoutLoading();
                $('.modal-overlay').removeClass('show--opacity');
                $('.payMoreModal .modal').addClass('modal-animation--long');
            }, 3000);
        }

        let stripe = '';

        $('#payNow').click(async function() {
            checkoutLoading()
            let intent = await getPayNowIntent();

            $.getScript( "https://js.stripe.com/v3/" )
                .done(function( script, textStatus ) {
                    stripe = Stripe("{{ env('STRIPE_KEY') }}");
                    loadStripe(intent);
                    showCheckout();
                })
        });
        $('#modal-close-checkout-btn').click(function() {
            $('.payMoreModal').removeClass('show');
            $('.payMoreModal .modal').removeClass('modal-animation--long');
        });

        $('#close-modal').click(function() {
            $('.payMoreModal').removeClass('show');
            $('.payMoreModal .modal').removeClass('modal-animation--long');
            window.location.reload();
        });

        function getPayNowIntent() {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: '/panel/order/{{ $order->id }}/extra-payment/intent',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: res => {
                        if (res.intent) {
                            $('#checkout-price').text(res.totalformatted);
                            resolve(res.intent)
                        } else {
                            reject(res.message)
                        }
                    },
                    error: err => reject(err),
                })
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
            paymentElement.mount("#payment-element");

            return elements;
        }

        function setBtnLoading(state) {
            if (state) {
                $('#submit-button').prop('disabled', true);
                $('#btnPayLoadingText').show();
                $('#btnPayNowText').hide();
            } else {
                $('#submit-button').prop('disabled', false);
                $('#btnPayLoadingText').hide();
                $('#btnPayNowText').show();
            }
        }

        $(document).on('submit', '#payment-form', handlePaymentSubmit)
        async function handlePaymentSubmit(e) {
            e.preventDefault();
            setBtnLoading(true);

            const response = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    return_url: window.location.href + '?order_id={{ $order->id }}'
                },
                redirect: 'if_required',
            });

            if (response.error && (response.error.type === "card_error" || response.error.type === "validation_error")) {
                if (error.decline_code === 'insufficient_funds') {
                    $('#payment-error').text('Your card has insufficient funds.');
                } else {
                    $('#payment-error').text('Something went wrong. Please check your card details and try again.');
                }
                $('#payment-error').show();
                setBtnLoading(false);
                return;
            }
            if (response.paymentIntent.status === 'succeeded') {
                setExtraPaymentCompleted(response.paymentIntent)
            }
        }

        function setExtraPaymentCompleted(paymentIntent) {
            $.ajax({
                url: '/panel/order/{{ $order->id }}/extra-payment/completed',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    paymentIntent: paymentIntent.id,
                },
                success: res => {
                    showThankYou();
                },
                error: err => console.log(err)
            })
        }

        function showThankYou() {
            $('#payment-form').hide();
            $('#payment-completed').show();
        }
    });

</script>
@endpush
