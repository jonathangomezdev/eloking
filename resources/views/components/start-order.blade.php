<a href="#" class="button" id="btnStartOrder">
    <span id="start-button-text">Start Order</span>
</a>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#btnStartOrder').click(() => {
                $.ajax({
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/panel/order/{{ $order->order_id }}/start',
                    success: (data) => {
                        window.location.reload();
                    },
                });
            });
        });
    </script>
@endpush
