<div class="game-account-details">
    @if (! ($order->payload && isset($order->payload->options) && $order->payload->options['duoq']))
        <div class="modal-overlay accountDetailsModal">
            <div class="modal modal-bg modal-animation">
                <button type="button" id="modal-overlay-close" class="forgot-password-btn-close-modal"><i>&times;</i></button>
                <h2><span>Game</span> Credentials</h2>
                @if ($order->gameAccountDetails && ($order->user_id === auth()->id() || auth()->user()->hasRole('admin') || auth()->id() === $order->booster()->id))
                <ul>
                    @if($order->gameAccountDetails->username)
                    <li>
                        @if ($order->gametype === 'csgo' && $order->platform === 'faceit' && $order->gameAccountDetails->username)
                            Steam Username: {{ decrypt($order->gameAccountDetails->username) }}
                        @else
                            Username: {{ decrypt($order->gameAccountDetails->username) }}
                        @endif
                        <a class="colored" id="usernameCopy">
                            Copy
                        </a>
                    </li>
                    @endif
                    @if($order->gameAccountDetails->password)
                    <li>
                        @if ($order->gametype === 'csgo' && $order->platform === 'faceit')
                            Steam Password: ********
                        @else
                            Password: ********
                        @endif
                        <a class="colored" id="passwordCopy">
                            Copy
                        </a>
                    </li>
                    @endif
                    @if ($order->gametype === 'csgo' && $order->platform === 'faceit' && $order->gameAccountDetails->faceit_email)
                        <li>
                            Faceit Email: {{ decrypt($order->gameAccountDetails->faceit_email) }}
                            <a class="colored" id="faceitEmailCopy">
                                Copy
                            </a>
                        </li>
                        <li>
                            Faceit Password: ********
                            <a class="colored" id="faceitPasswordCopy">
                                Copy
                            </a>
                        </li>
                    @endif

                    @if ($order->user_id === auth()->id())
                        <li>
                            <form action="{{ URL::to('/panel/orders/' . $order->id . '/gameAccount/' . $order->gameAccountDetails->id) }}" method="POST">
                                <input type="hidden" name="_method" value="DELETE" />
                                @csrf
                                <button type="submit" class="panel-btn">Delete / Update</button>
                            </form>
                        </li>
                    @endif
                </ul>
                @elseif($order->user_id === auth()->id())
                    <form action="{{ URL::to('/panel/orders/' . $order->id . '/gameAccount') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            @if ($order->gametype === 'csgo')
                                <label for="username">Steam Username</label>
                            @else
                                <label for="username">Username</label>
                            @endif
                            <input type="text" name="username" placeholder="Enter your Username" class="panel-input"/>
                        </div>
                        <div class="input-group">
                            @if ($order->gametype === 'csgo')
                                <label for="password">Steam Password</label>
                            @else
                                <label for="password">Password</label>
                            @endif
                                <input type="password" name="password" placeholder="Enter your Password" class="panel-input"/>
                        </div>
                        @if($order->platform === 'faceit')
                            <div class="input-group">
                                <label for="faceit_email">Faceit Email</label>
                                <input type="text" name="faceit_email" placeholder="Enter your faceit email" class="panel-input" required/>
                            </div>
                            <div class="input-group">
                                <label for="faceit_password">Faceit Password</label>
                                <input type="password" name="faceit_password" placeholder="Enter your faceit password" class="panel-input" required/>
                            </div>
                        @endif
                        <button class="panel-btn">Add Game Credentials</button>
                    </form>
                @else
                    <h4 class="p15-v">Credentials not shared.</h4>
                @endif
            </div>
        </div>
    @endif
</div>
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            function closeModal() {
                $('.accountDetailsModal').removeClass('show');
            }

            $(document).keyup(function(e) {
                if (e.key === "Escape") { // escape key maps to keycode `27`
                    closeModal();
                }
            });

            $('.accountDetailsModal, #modal-overlay-close').on('click', function(e){
                e.stopPropagation();
                closeModal();
            })
            $('.modal').on('click', function(e){
                e.stopPropagation();
            })

            $('#usernameCopy').on('click', function(e) {
                @if($order->gameAccountDetails && $order->gameAccountDetails->username)
                    copyTextToClipboard(e, "{{ !$order->gameAccountDetails ?: decrypt($order->gameAccountDetails->username) }}");
                @endif
            });

            $('#passwordCopy').on('click', function(e) {
                @if($order->gameAccountDetails && $order->gameAccountDetails->password)
                    copyTextToClipboard(e, "{{ !$order->gameAccountDetails ?: decrypt($order->gameAccountDetails->password) }}");
                @endif
            });

            $('#faceitEmailCopy').on('click', function(e) {
                @if($order->gameAccountDetails && $order->gameAccountDetails->faceit_email)
                    copyTextToClipboard(e, "{{ !$order->gameAccountDetails ?: decrypt($order->gameAccountDetails->faceit_email) }}");
                @endif
            });

            $('#faceitPasswordCopy').on('click', function(e) {
                @if($order->gameAccountDetails && $order->gameAccountDetails->faceit_password)
                    copyTextToClipboard(e, "{{ !$order->gameAccountDetails ?: decrypt($order->gameAccountDetails->faceit_password) }}");
                @endif
            });

            $('#btnAccountDetail').click(function() {
                $('.accountDetailsModal').addClass('show');
                // Cloudflare Zaraz event
                zaraz.track('creds-popup-open',
                    {
                        user_id: {!! auth()->id() !!}
                    }
                );
            });

            $('#modal-overlay-close').click(function() {
                $('.accountDetailsModal').removeClass('show');
            })

            function fallbackCopyTextToClipboard(e, text) {
                let textArea = document.createElement("textarea");
                textArea.value = text;

                // Avoid scrolling to bottom
                textArea.style.top = "0";
                textArea.style.left = "0";
                textArea.style.position = "fixed";

                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();

                try {
                    let successful = document.execCommand('copy');
                    if (successful) {
                        $(e.target).text('Copied');
                        setTimeout(() => $(e.target).text('Copy'), 500);
                    }
                } catch (err) {
                    console.error('Fallback: Oops, unable to copy', err);
                }

                document.body.removeChild(textArea);
            }

            function copyTextToClipboard(e, text) {
                if (!navigator.clipboard) {
                    fallbackCopyTextToClipboard(e, text);
                    return;
                }
                navigator.clipboard.writeText(text).then(function() {
                    $(e.target).text('Copied!');
                    setTimeout(() => $(e.target).text('Copy'), 500);
                }, function(err) {
                    console.log('err', err)
                });
            }
        })
    </script>
@endpush
