@extends('layout.main')
@section('content')
    <div class="container top">
        <h1 class="center">{!! str_replace('News', '<span>News</span>', $title) !!}</h1>
        @include('blog.partials.navigation')

        @forelse($posts as $post)
            <div class="blog-item">
                <div class="image">
                    <div class="blog-category {{ $post->category }}"></div>
                    @if ($post->image)
                        <img class="lazyload" data-src="{{ $post->image }}" src="{{ asset('img/1x1.png') }}" alt="{{ ucfirst($post->title) }}" />
                    @else
                        <img class="lazyload" data-src="{{ asset('img/blog/no-image-' . $post->category . '.jpg') }}" src="{{ asset('img/1x1.png') }}" alt="No image" />
                    @endif
                </div>
                <div class="content">
                    <a href="/blog/{{ $post->slug }}" class="title">{{ ucfirst($post->title) }}</a>
                    <p>{{ substr(strip_tags($post->content), 0, 90) }}…</p>
                    <a href="/blog/{{ $post->slug }}" class="fancy after-arrow">Read More</a>
                </div>
            </div>
        @empty
            <p>No blog posts.</p>
        @endforelse
    </div>
    @include('layout.partials.king-banner')
@endsection
