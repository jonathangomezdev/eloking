<div class="booster-tip">
    <div class="modal-overlay tipAmountModal">
        <div class="modal modal-bg modal-animation">
            <button type="button" id="modal-overlay-close" class="forgot-password-btn-close-modal"><i>&times;</i></button>
            <h2><span>Leave a </span>Tip</h2>
            <div class="input-group">
                <input type="number" placeholder="Amount" step="0.01" name="amount" id="booster-tip-amount" required class="panel-input"/>
                <div class="input-group__curr">
                    {{ getCurrencySymbol($order->currency) }}
                </div>
            </div>
            <button type="button" id="btnProcessTipBooster" class="panel-btn">
                Tip Booster 👏
            </button>
        </div>
    </div>
    <div class="modal-overlay boosterTipModal">
        <div class="modal checkout">
            <div class="modal-content">
                <button class="modal-close-btn" id="modal-close-checkout-btn">
                    <img src="{{ asset('img/1x1.png') }}" data-src="{{ asset('img/close-modal.svg') }}" class="lazyload" alt="icon"/>
                    <span id="modal-close-checkout-btn-text">Cancel</span>
                </button>
                <div class="checkout-form">
                    <form id="tip-form">
                        <div id="tip-error"></div>
                        <div id="tip-payment-element">
                            <!--Stripe.js injects the Payment Element -->
                        </div>
                        <div class="totals-wrapper">
                            <div class="left-bar"></div>
                            <div>
                                <div class="totals">
                                    <div class="grand-total">
                                        <h4>Total Price: <span id="tip-price"></span></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="button" id="tip-submit-button" class="submit-button">
                            <span id="btnTipPayLoadingText" class="btnPayLoadingText">Loading...</span>
                            <span id="btnTipPayNowText">Pay Now</span>
                        </button>
                    </form>
                    <div id="tip-completed" class="payment-completed">
                        <h1>Thank you.</h1>
                        <p>Payment successfully completed.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function(){
            function closeModal() {
                $('.tipAmountModal').removeClass('show');
            }

            $(document).keyup(function(e) {
                if (e.key === "Escape") { // escape key maps to keycode `27`
                    closeModal();
                }
            });

            $('.tipAmountModal, #modal-overlay-close').on('click', function(e){
                e.stopPropagation();
                closeModal();
            })

            $('.modal').on('click', function(e){
                e.stopPropagation();
            })

            function checkoutLoading() {
                $('.loading-wrap').toggleClass('show')
            }

            function showCheckout() {
                $('.boosterTipModal').addClass('show show--opacity');
                setTimeout(function () {
                    checkoutLoading();
                    $('.modal-overlay').removeClass('show--opacity');
                    $('.boosterTipModal .modal').addClass('modal-animation--long');
                }, 3000);
            }

            let stripe = '';

            $('#btnProcessTipBooster').click(async () => {
                checkoutLoading();
                $('.tipAmountModal').removeClass('show');
                let intentResponse = await getPaymentIntent();

                $('#tip-price').text(intentResponse.amountFormatted);

                $.getScript( "https://js.stripe.com/v3/" )
                    .done(function( script, textStatus ) {
                        stripe = Stripe("{{ env('STRIPE_KEY') }}");
                        loadStripe(intentResponse.intent);
                        showCheckout();
                    })

            })

            $('#tip-modal-close-btn').click(() => {
                $('.tipAmountModal').removeClass('show');
            })

            $('#btnTipBooster').click(() => {
                $('.tipAmountModal').addClass('show');
                // Cloudflare Zaraz event
                zaraz.track('tip-popup-open',
                    {
                        user_id: {!! auth()->id() !!}
                    }
                );
            })

            $('#tip-submit-button').click(async function() {
                setBtnLoading(true);

                let tipError = $('#tip-error');
                tipError.removeClass('show');

                const response = await stripe.confirmPayment({
                    elements,
                    confirmParams: {
                        return_url: window.location.href + '?status=tip-completed'
                    },
                    redirect: 'if_required',
                });
                if (response.error && (response.error.type === "card_error" || response.error.type === "validation_error")) {
                    tipError.text(response.error.message);
                    tipError.addClass('alert error show');
                    setBtnLoading(false);
                } else if (response.paymentIntent && response.paymentIntent.status === 'succeeded') {
                    setTipPaymentCompleted(response.paymentIntent);
                } else {
                    tipError.text('Something went wrong. Please try again later.');
                    tipError.addClass('alert error show');
                    setBtnLoading(false);
                }
            });

            $('#close-tip-modal, #modal-close-checkout-btn').click(() => {
                $('.boosterTipModal').removeClass('show');
                $('.boosterTipModal .modal').removeClass('modal-animation--long');
                if (tipPaymentCompleted) {
                    window.location.reload();
                }
            });

            function setTipPaymentCompleted(paymentIntent) {
                $.ajax({
                    url: '/panel/order/{{ $order->id }}/booster-tip/completed',
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        paymentIntent: paymentIntent.id,
                    },
                    success: res => showThankYou(),
                    error: err => console.log('err', err)
                })
            }

            var tipPaymentCompleted = false;
            function showThankYou() {
                $('#tip-form').hide();
                $('#tip-completed').show();
                $('#modal-close-checkout-btn-text').text('Close');
                tipPaymentCompleted = true;
            }

            function setBtnLoading(state) {
                if (state) {
                    $('#tip-submit-button').prop('disabled', true);
                    $('#btnTipPayLoadingText').show();
                    $('#btnTipPayNowText').hide();
                } else {
                    $('#tip-submit-button').prop('disabled', false);
                    $('#btnTipPayLoadingText').hide();
                    $('#btnTipPayNowText').show();
                }
            }

            function getPaymentIntent() {
                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: '/panel/order/{{ $order->id }}/booster-tip/paymentIntent',
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            amount: $('#booster-tip-amount').val()
                        },
                        success: res => resolve(res),
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
                paymentElement.mount("#tip-payment-element");
            }
        })
    </script>
@endpush
