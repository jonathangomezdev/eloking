@extends('layout.main')
@section('content')
    <div class="container top blog-post">
        @include('blog.partials.navigation')
        <h1>{{ ucfirst($post->title) }}</h1>
        <p>{!! $post->content !!}</p>
    </div>
    @include('layout.partials.king-banner')
@endsection
