@if($order->chatRoom)
    <ul class="messages" id="message-box">
        @foreach ($order->chatRoom->messages()->take(20)->with('attachments')->latest()->get()->sortBy('created_at') as $message)
            @if($message->is_comment && (auth()->user()->hasRole('booster') || auth()->user()->hasRole('admin')))
                <li id="message-id-{{$message->id}}" class="messages__item  @if($message->user_id === auth()->id()) sent @endif" data-message="{{ $message->message }}">
                    <div class="order-container">
                        <div class="message">
                            <div class="message__icon">
                                <div class="user-letter s">E</div>
                            </div>
                            <div class="message__wrap">
                                <div class="message__header">
                                    <div class="message__username">{{ $message->sender->username }}</div>
                                    <div class="message__time">{{ $message->created_at->diffForHumans() }}</div>
                                </div>
                                <div class="message__text message__comment">{{ $message->message }}</div>
                                @if ($message->attachments->count() > 0)
                                <div class="message__attachments">
                                    <ul>
                                        @foreach($message->attachments as $attachment)
                                            <li><a class="button" download="{{ $attachment->name }}" href="{{ $attachment->getLocation() }}" >Download {{ $attachment->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </li>
            @elseif(! $message->is_comment)
                <li id="message-id-{{$message->id}}" class="messages__item  @if($message->user_id === auth()->id()) sent @endif" data-message="{{ $message->message }}">
                    <div class="order-container">
                        <div class="message">
                            <div class="message__icon">
                                <div class="user-letter {{ substr($message->sender->username, 0, 1) }}">
                                    @if($message->sender->isBOT())
                                        <span class="user-status-dot online"></span>
                                    @else
                                        <span class="user-status-dot @if($message->sender->isOnline()) online @else offline @endif"></span>
                                    @endif
                                    {{ substr($message->sender->username, 0, 1) }}
                                </div>
                            </div>
                            <div class="message__wrap">
                                <div class="message__header">
                                    <div class="message__username">{{ $message->sender->username }}</div>
                                    <div class="message__time">{{ $message->created_at->diffForHumans() }}</div>
                                </div>
                                <div class="message__text">
                                    @if($message->sender->isBot())
                                        {!! $message->message !!}
                                    @else
                                        {{ $message->message }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endif
        @endforeach
    </ul>
    @if ($order->chatRoom->active)
        <div class="order-container">
            <div class="messenger__send__typing" id="typingBox"></div>
            <div id="send-form-error" class="hidden">
                <small id="error-message" class="error"></small>
            </div>
            <form class="send-message " id="messengerSendForm">
                <input type="text" onkeyup="whisperTyping()" placeholder="Enter message here..." class="send-message__input" id="messenger_send_input" required autocomplete="off">
                <button id="sendMessageInput" class="send-message__btn">
                    <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/panel/icons/chat.svg') }}" alt="Send message"/>
                </button>
            </form>
            @if(auth()->user()->hasRole('booster') || auth()->user()->hasRole('admin'))
                <div class="messenger__checkmarks">
                    <label for="asOrderComment">
                        <input type="checkbox" name="asComment" id="asOrderComment" />
                        <span class="checkmark-input"></span> As Order Comment
                    </label>
                    @if(!$order->status !== \App\Order::STATUS_COMPLETED)
                    <label id="markOrderCompletedWrapper" class="hidden">
                        <input type="checkbox" name="markOrderCompleted" id="markOrderCompleted" />
                        <span class="checkmark-input"></span> Mark Order as completed
                    </label>
                    @endif
                    <div class="file-upload">
                        <input class="hidden" type="file" name="attachments" id="attachments" />
                    </div>
                </div>
            @endif
        </div>
    @endif

@push('scripts')
    <script type="text/javascript">
        const channel = window.Echo.private('order.room.{{ $order->chatRoom->id }}');
        channel.listen('.App\\Events\\NewMessageEvent', function(e) {
            let message = '<li class="messages__item ' + (e.sender_id == window.App.user.id ? 'sent' : '') + '">';
            message += '<div class="order-container"><div class="message"><div class="message__icon">';
            message += '<div class="user-letter ' + e.sender_initial + '"><span class="user-status-dot online"></span>' + e.sender_initial + '</div>';
            message += '</div><div class="message__wrap"><div class="message__header">';
            message += '<div class="message__username">' + e.sender_username + '</div>';
            message += '<div class="message__time">' + e.created_at + '</div>';
            message += '</div>';
            message += '<div class="message__text">' + e.message + '</div>';
            message += '</div> </div></div></li>';

            $('#message-box').append(message);
            scrollToBottom();
        });

        channel.listenForWhisper('typing', (e) => {
            $('#typingBox').text(e.sender_name + ' is typing...');
            $('#typingBox').css({'opacity' : 1});
            setTimeout(() => {
                $('#typingBox').css({'opacity' : 0});
            }, 3000);
        })

        function whisperTyping() {
            channel.whisper('typing', {
                'sender_id' : {{auth()->id()}},
                'sender_name' : "{{ auth()->user()->username ?? auth()->user()->name }}",
            })
        }

        function scrollToBottom() {
            let div = document.getElementById('message-box');
            $('#message-box').animate({
                scrollTop: div.scrollHeight - div.clientHeight
            }, 100);
        }

        let edit = false;
        let messageToBeUpdated = null;
        function updateMessage(messageId) {
            let elm = $('#message-id-' + messageId);
            let message = elm.data('message');
            $('#messenger_send_input').val(message);
            edit = true;
            messageToBeUpdated = messageId;
        }

        $(document).ready(function() {
            scrollToBottom();

           $('#messengerSendForm').on('submit', function(e) {
               e.preventDefault();
               $('#sendMessageInput').attr('disabled', true);
               let url = '/panel/chat-room/{{ $order->chatRoom->id }}/message';

               @if(auth()->user()->hasRole('booster') || auth()->user()->hasRole('admin'))
                   let asComment = $('input[name="asComment"]').is(":checked");
                   let orderCompleted = $("input[name='markOrderCompleted']").is(":checked")
                   let file = $('input[name="attachments"]')[0].files[0];
               @else
                   let asComment = false;
                   let orderCompleted = false;
                   let file = null;
               @endif

               if (edit) {
                   url = '/panel/chat-room/{{ $order->chatRoom->id }}/message/' + messageToBeUpdated;
               }

               @if (auth()->user()->hasRole('admin'))
                   let isAdmin = true;
               @else
                   let isAdmin = false;
               @endif

               if (orderCompleted && !isAdmin && !file) {
                    $('#error-message').text('You need to upload file/image as proof of order being completed.');
                    $('#send-form-error').show();
                    setTimeout(() => {
                        $('#error-message').text('');
                        $('#send-form-error').hide();
                    }, 3000);
                    return;
               } else {
                    $('#error-message').text('');
                    $('#send-form-error').hide();
               }

                let formData = new FormData;
                formData.append('message', $('#messenger_send_input').val());
                formData.append('asComment', asComment ? 1 : 0);
                formData.append('markOrderCompleted', orderCompleted ? 1 : 0);
                formData.append('attachments', file);

               $.ajax({
                   type: edit ? 'PUT' : 'post',
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                   url: url,
                   data: formData,
                   cache: false,
                   contentType: false,
                   processData: false,
                   success: res => {
                       $('#messenger_send_input').val('');
                       edit = false;
                       messageToBeUpdated = null;
                       if (asComment) {
                           window.location.reload();
                       }
                       $('#sendMessageInput').attr('disabled', false);
                   },
                   error: err => {
                       console.log('err', err);
                   }
               })
           });

           $('#asOrderComment').change(function() {
               @if($order->status === \App\Order::STATUS_COMPLETED)
                   let isOrderCompleted = true;
               @else
                   let isOrderCompleted = false;
               @endif

               if (! isOrderCompleted) {
                   $('#markOrderCompletedWrapper').toggleClass('inline-flex');
                }
           })

           $('input[name="markOrderCompleted"]').change(function() {
               $('#attachments').toggleClass('show');
           })
        });
    </script>
@endpush
@endif
