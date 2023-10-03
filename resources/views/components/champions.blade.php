<div class="champions">
    <div class="modal-overlay" id="champion-modal">
        <div class="modal modal-bg modal-bg--wider modal-animation">
            <button type="button" id="modal-overlay-close" class="forgot-password-btn-close-modal"><i>&times;</i></button>
            <h2><span>Add</span>
                @if ($order->gametype === 'lol')
                    Champions
                @else
                    Agents
                @endif
            </h2>
            <div class="modal__content">
                <div class="modal__content__error" id="error"></div>
                <div class="modal__content__success" id="success"></div>
                <form action="">
                    @if ($order->gametype === 'valorant')
                        <span class="modal__content__text">You can have a minimum of 2 agents selected.</span>
                        <div class="modal__content__input_group">
                            <select id="champions" class="select2 modal__content__input_group__select" multiple>
                                @foreach ($valorantChamps as $champ)
                                    <option @if(in_array($champ->id, $champions->pluck('id')->toArray())) selected @endif value="{{ $champ->id }}">{{ $champ->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @if ($order->gametype === 'lol')
                        <span class="modal__content__text">You can have a minimum of 4 champions selected.</span>
                        <div class="modal__content__input_group">
                            <select id="champions" class="select2 modal__content__input_group__select" multiple>
                                @foreach ($lolChamps as $champ)
                                    <option @if(in_array($champ->id, $champions->pluck('id')->toArray())) selected @endif value="{{ $champ->id }}">{{ $champ->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <br />
                    <div class="champ-select-footer">
                        <button id="btnAddChampions" type="button" class="panel-btn">
                            Add
                            @if ($order->gametype === 'lol')
                                Champions
                            @else
                                Agents
                            @endif
                        </button>
                        <a class="button">
                            <span>
                                Cancel
                            </span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#addChampion').on('click', function(e) {
            $('#champion-modal').addClass('show');
            // Cloudflare Zaraz event
            zaraz.track('champ-popup-open',
                {
                    user_id: {!! auth()->id() !!}
                }
            );
        });

        function closeModal() {
            $('#champion-modal').removeClass('show');
        }

        $(document).keyup(function(e) {
            if (e.key === "Escape") { // escape key maps to keycode `27`
                closeModal();
            }
        });

        $('#champion-modal, #modal-overlay-close, .champ-select-footer a').on('click', function(e){
            e.stopPropagation();
            closeModal();
        })
        $('.modal').on('click', function(e){
            e.stopPropagation();
        })

        $('#btnAddChampions').on('click', function(e) {
            let gameType = '{{ $order->gametype }}'
            let method = '{{ count($champions) }}' == 0 ? 'POST' : 'PUT';
            let selectedChampions = $('#champions').val();

            $('#error').hide();

            if (gameType === 'lol' && selectedChampions.length < 4) {
                $('#error').text('You must at least have 4 champions selected')
                $('#error').show();
                $('.modal__content__text').hide();
                return;
            } else if (gameType === 'valorant' && selectedChampions.length < 2) {
                $('#error').text('You must at least have 2 champions selected')
                $('#error').show();
                $('.modal__content__text').hide();
                return;
            }

            $.ajax({
                url: '/panel/orders/{{ $order->id }}/champions',
                method: method,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    champions: selectedChampions,
                },
                success: res => {
                    $('#success').text('Champion selected successfully.')
                    $('#success').show();
                    setTimeout(() => {
                        closeModal();
                    }, 1000);
                },
                error: err => {
                    $('#error').text('Oops, Something went wrong.')
                    $('#error').show();
                    console.log('err', err)
                },
            });

            // Cloudflare Zaraz event
            zaraz.track('champ-submit',
                {
                    user_id: {!! auth()->id() !!},
                    champions: selectedChampions
                }
            );
        });
    })
</script>
@endpush
