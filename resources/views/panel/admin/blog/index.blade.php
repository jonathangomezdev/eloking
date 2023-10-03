@extends('panel.layout.main')
@section('content')
    <div class="content panel-action-edit">
        <div class="container inner header">
            <h1>Blog <span>Posts</span></h1>
            <a href="{{ URL::to('/panel/blog/create') }}" class="button red">Create New Post</a>
        </div>
        <div class="container">
            @if (session('success'))
                <div class="alert success">
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            <div class="table">
                <div class="filters">
                    <form id="filter-form" action="{{ URL::to('/panel/blog') }}" method="GET">
                        <input type="hidden" id="sortBy" name="sortBy" />
                        <input type="hidden" id="sortOrder" name="sortOrder" />
                        <div class="row">
                            <div class="booster-selection-wrapper mw240 boost-type-select select2-trigger">
                                <div class="booster-rank-selection-wrapper">
                                    <select
                                        onChange="this.form.submit()"
                                        class="boost-type booster-rank-selection booster-rank-selection select2"
                                        name="gametype">
                                        <option value="">Choose an option</option>
                                        <option @if(request('gametype') === 'lol') selected @endif value="lol">League Of Legends</option>
                                        <option @if(request('gametype') === 'valorant') selected @endif value="valorant">Valorant</option>
                                        <option @if(request('gametype') === 'csgo') selected @endif value="csgo">CS:GO</option>
                                    </select>
                                    <span class="dropdown-icon">
                                        <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                    </span>
                                </div>
                            </div>
                            <div class="booster-selection-wrapper mw240 boost-type-select select2-trigger">
                                <div class="booster-rank-selection-wrapper">
                                    <select
                                        onChange="this.form.submit()"
                                        class="boost-type booster-rank-selection booster-rank-selection select2"
                                        name="status">
                                        <option value="">Choose an option</option>
                                        <option @if(request('status') === \App\BlogPost::STATUS_DRAFT) selected @endif value="{{ \App\BlogPost::STATUS_DRAFT }}">Draft</option>
                                        <option @if(request('status') === \App\BlogPost::STATUS_PUBLISHED) selected @endif value="{{ \App\BlogPost::STATUS_PUBLISHED }}">Published</option>
                                    </select>
                                    <span class="dropdown-icon">
                                        <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                    </span>
                                </div>
                            </div>
                            <div class="search-input">
                                <img src="{{ asset('/img/panel/icons/search.svg') }}" alt="Search"
                                     class="search-input__icon">
                                <input id="search" type="search" class="search-input__search" value="{{ request('search') }}" name="search" placeholder="Search">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-wrap">
                    <div class="row table-head">
                        <div data-label="name" @if(request('sortBy')=='title' ) data-order="{{ request('sortOrder') }}" @else
                        data-order="asc" @endif class="cell double no-mw">Title</div>

                        <div data-label="role" @if(request('sortBy')=='status' ) data-order="{{ request('sortOrder') }}" @else
                        data-order="asc" @endif class="cell no-mw">Status</div>

                        <div data-label="id" @if(request('sortBy')=='id' ) data-order="{{ request('sortOrder') }}" @else
                        data-order="asc" @endif class="cell no-mw">ID</div>
                    </div>
                    @forelse($posts as $post)
                        <a class="row tooltip-link" data-tooltip="Click to Open"
                           href="{{ URL::to('/panel/blog/' . $post->id . '/edit') }}">
                            <div data-label="Title" class="cell double no-mw">
                                <div class="game-title">
                                    @if ($post->category == 'csgo')
                                        <img src="{{ asset('/img/icons/csgo/matchmaking.svg') }}" alt="cs:go"/>
                                    @elseif ($post->category == 'valorant')
                                        <img src="{{ asset('/img/icons/valorant.svg') }}" alt="valorant"/>
                                    @elseif ($post->category == 'lol')
                                        <img src="{{ asset('/img/icons/lol.svg') }}" alt="lol"/>
                                    @endif
                                </div>
                                <span class="text-white">{{ substr($post->title, 0, 30) }}</span>
                            </div>
                            <div data-label="Status" class="cell no-mw">
                                <div class="order-addons order-addons--active order-addons--large">
                                    <span>{{ ucfirst($post->status) }}</span>
                                </div>
                            </div>
                            <div data-label="ID" class="cell no-mw">
                                <span>#{{ $post->id }}</span>
                                <div class="rank-to img-grad hidden-cell last-arrow"></div>
                            </div>
                        </a>
                    @empty
                        <p class="p15-v">No blog posts found.</p>
                    @endforelse
                </div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
