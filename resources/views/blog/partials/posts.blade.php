@php
    // TODO: Refactor to controller
    if (isset($category)) {
        $posts = \App\BlogPost::where('category', $category)->take(3)->latest()->get();
    } else {
        $posts = \App\BlogPost::take(3)->latest()->get();
    }

    if ($category == 'csgo') {
        $game = 'CS:GO';
    } else if ($category == 'valorant') {
        $game = 'Valorant';
    } else if ($category == 'lol') {
        $game = 'League of Legends';
    } else {
        $game = '';
    }
@endphp
@if ($posts)
    <div class="container blog bomb">
        <h2 class="short">Read our <span>{{ $game }}</span> boosting news</h2>
        <div class="select-type">
        @foreach($posts as $post)
                <div class="selectbox content">
                    @if ($post->image)
                        <img width="328" height="182" src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ $post->image }}" alt="{{ ucfirst($post->title) }}" />
                    @else
                        <img width="328" height="182" src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('img/blog/no-image-' . $post->category . '.jpg') }}" alt="No image" />
                    @endif
                    <div class="blog-category {{ $post->category }}"></div>
                    <a href="/blog/{{ $post->slug }}" class="title">{{ ucfirst($post->title) }}</a>
                    <p>{{ substr(strip_tags($post->content), 0, 90) }}…</p>
                    <a href="/blog/{{ $post->slug }}" class="fancy after-arrow">Read More</a>
                </div>
        @endforeach
        </div>
    </div>
@endif
