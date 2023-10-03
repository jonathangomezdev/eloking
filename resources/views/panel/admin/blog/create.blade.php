@extends('panel.layout.main')
@section('content')
    <div class="content panel-user-profile-edit">
        <div class="container inner">
            <h1>
                Blog
                <span>Post</span>
                <a href="{{ URL::to('/panel/blog') }}" class="move-back">
                    <img src="{{ asset('img/icons/arrow-right.svg') }}" alt="Arrow back"/>
                </a>
            </h1>
            <div class="container">
                <div class="blog edit">
                    <div class="table">
                        <x-blog-post-form :post="$post" :type="'create'" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
