@push('scripts')
    <script type="text/javascript">
        jQuery(document).ready(function() {
            /* FAQ Show/hide functionality */
            if ($('.faq').length) {
                let faqBlocks = $('.faq .faq-block');
                faqBlocks.addClass('closed');
                faqBlocks.find('.question').on('click', function(){
                    $(this).parent('.faq-block').toggleClass('closed');
                });
            }
        });
    </script>
@endpush

@push('html-attributes')
    itemscope itemtype="https://schema.org/FAQPage"
@endpush
