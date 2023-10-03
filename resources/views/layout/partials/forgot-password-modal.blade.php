<div class="modal-overlay">
    <div class="modal forgot-password modal-animation">
        <div class="modal-content">
            <button type="button" class="forgot-password-btn-close-modal">
                <i>&times;</i>
            </button>
            <div class="forgot-password-wrapper">
                <div class="form-wrapper">
                    <h2>Forgot <span>Password?</span></h2>
                    <div class="description">
                        In order to reset your password enter the email you used during your sign up
                    </div>
                    <div id="password-status" class="alert"></div>
                    <form id="forgotPasswordForm" action="{{ URL::to('/password/email/verify') }}" method="POST">
                        @csrf
                        <div class="blackbox-input-group">
                            <input type="email" class="blackbox-input" name="email" id="forgot-email" required/>
                            <label for="forgot-email" class="blackbox-input-label">Email</label>
                            <button type="submit" class="button">
                                <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset("/img/icons/send.svg") }}" alt="icon"/>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="image-wrapper">
                    <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset("/img/forgot-password.png") }}" alt="icon"/>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        jQuery(document).ready(function() {
            let
                forgotButton = $('a.forgot-password'),
                forgotPasswordModal = $('.modal-overlay'),
                forgotPasswordClose = $('.forgot-password-btn-close-modal');

            function hideForgetPasswordModal() {
                forgotPasswordModal.removeClass('show');
            }

            forgotButton.on('click', function(e) {
                e.preventDefault();
                forgotPasswordModal.addClass('show');
            })

            forgotPasswordClose.on('click', function() {
                hideForgetPasswordModal();
            })

            $('.forgot-password .modal-content').on('click', function(event) {
                event.stopPropagation();
            })

            forgotPasswordModal.on('click', function(event) {
                hideForgetPasswordModal();
            })

            $(document).keyup(function(e) {
                if (e.key === "Escape") { // escape key maps to keycode `27`
                    hideForgetPasswordModal();
                }
            });

            $('#forgotPasswordForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: {
                        email: $('#forgot-email').val(),
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        $('#password-status').text(response.message);
                        $('#forgotPasswordForm, .description').hide();
                        $('#password-status').show()
                    },
                    error: function (err) {
                        $('#password-status').text('Something went wrong. Please try again later');
                        $('#forgotPasswordForm, .description').hide();
                        $('#password-status').show()
                    }
                })
            })
        })
    </script>
@endpush
