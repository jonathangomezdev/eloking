<div class="order-comment">
    <h1>Order Comment</h1>
    <div class="order-comment__wrapper">
        @forelse(\App\OrderComment::where('order_id', $order->id)->latest()->get() as $comment)
            <div class="order-comment__wrapper__text">
                {{ $comment->created_at->diffForHumans() }} -
                {{ $comment->comment }}

                <ol>
                @foreach(\App\OrderCommentAttachment::where('order_comment_id', $comment->id)->get() as $attachment)
                    <li>
                        <a download="{{ $attachment->filename }}" href="{{ URL::to(str_replace('public', 'storage', $attachment->location)) }}">
                            Download {{ $attachment->filename }}
                        </a>
                    </li>
                @endforeach
                </ol>
            </div>
        @empty
            <div class="order-comment__wrapper__text">
                No comments yet.
            </div>
        @endforelse
    </div>
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('booster'))
        <form action="{{ URL::to('/panel/booster/order/' . $order->id . '/comment') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <input type="file" multiple name="attachments">
                @error('attachments') {{ $message }} @enderror
            </div>
            @if ($order->status != \App\Order::STATUS_COMPLETED)
                <label>
                    <input type="checkbox" name="orderCompleted"> Order Completed
                    @error('orderCompleted') {{ $message }} @enderror
                </label>
            @endif
            <div>
                <input type="text" class="order-comment__send_input" name="comment" placeholder="Enter Your Comment" />
                @error('comment') {{ $message }} @enderror
                <button>Submit</button>
            </div>
        </form>
    @endif
</div>
