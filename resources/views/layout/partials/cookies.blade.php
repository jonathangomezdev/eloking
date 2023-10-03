<div class="cookies-notice-wrapper">
    <div class="cookies-notice">
        <p>This website uses cookies to improve user experience. By using our website you consent to all cookies in
            accordance with our <a href="{{ URL::to('/privacy-policy') }}">Privacy Policy</a>.</p>
        <button class="cookies-accept">Accept</button>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/jquery.cookie.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        setTimeout(function() {
            if ($.cookie('cookies-notice') !== 'accepted') {
                $('.cookies-notice-wrapper').addClass('visible');
            }

            $('.cookies-accept').on('click',function(){
                $.cookie('cookies-notice', 'accepted', { expires: 365, path: '/' }); // Cookie will expire in one year
                $('.cookies-notice-wrapper').removeClass('visible');
            });
        }, 500);
    });
</script>
@endpush
