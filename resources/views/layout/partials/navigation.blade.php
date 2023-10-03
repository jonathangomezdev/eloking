@php
    $showCompanyMenu = false;
@endphp

<div class="navigation gameselect">
    <div class="dropdown">
        @if (request()->is('csgo*') || session('game.visited') === 'csgo')
            <span class="active">CS:GO</span>
        @elseif (request()->is('lol*') || session('game.visited') === 'lol')
            <span class="active">League of Legends</span>
        @elseif (request()->is('valorant-boost*') || session('game.visited') === 'valorant')
            <span class="active">Valorant</span>
        @else
            <span>Select Game</span>
        @endif

        <div class="submenu">
            <a href="{{ URL::to('/lol-boost') }}" class="link lol {{ (request()->is('lol*') || session('game.visited') === 'lol') ? 'active' : '' }}">
                <span class="title">League of Legends</span>
                <span>Get the division you desire</span>
            </a>
            <a href="{{ URL::to('/valorant-boost') }}" class="link valorant {{ (request()->is('valorant*') || session('game.visited') === 'valorant') ? 'active' : '' }}">
                <span class="title">Valorant</span>
                <span>Boost your Valorant rank</span>
            </a>
            <a href="{{ URL::to('/csgo') }}" class="link csgo {{ (request()->is('csgo*') || session('game.visited') === 'csgo') ? 'active' : '' }}">
                <span class="title">CS:GO</span>
                <span>Most efficient CS:GO boosting</span>
            </a>
        </div>
    </div>
</div>

<div class="navigation">
    @if (request()->is('csgo*') || session('game.visited') === 'csgo')
        <a href="{{ URL::to('/csgo/rank-boost') }}" {!! (request()->is('csgo/rank-boost*')) ? 'class="active"' : '' !!}>Rank Boost</a>
        <a href="{{ URL::to('/csgo/faceit-boost') }}" {!! (request()->is('csgo/faceit-boost*')) ? 'class="active"' : '' !!}>Faceit Boost</a>
        <a href="{{ URL::to('/csgo/esea-boost') }}" {!! (request()->is('csgo/esea-boost*')) ? 'class="active"' : '' !!}>ESEA Boost</a>
        @php
            $showCompanyMenu = true;
        @endphp
    @elseif (request()->is('lol*') || session('game.visited') === 'lol')
        <a href="{{ URL::to('/lol-boost') }}" {!! (request()->is('lol-boost*')) ? 'class="active"' : '' !!}>LOL Boost</a>
        <a href="{{ URL::to('/about') }}" {!! (request()->is('about')) ? 'class="active"' : '' !!}>About us</a>
        <a href="{{ URL::to('/blog') }}" {!! (request()->is('blog*')) ? 'class="active"' : '' !!}>Blog</a>
        <a href="{{ URL::to('/jobs') }}" {!! (request()->is('jobs*')) ? 'class="active"' : '' !!}>Jobs</a>
        <a href="{{ URL::to('/contact') }}" {!! (request()->is('contact*')) ? 'class="active"' : '' !!}>Contact Us</a>
    @elseif (request()->is('valorant-boost*') || session('game.visited') === 'valorant')
        <a href="{{ URL::to('/valorant-boost') }}" {!! (request()->is('valorant-boost*')) ? 'class="active"' : '' !!}>Valorant Boost</a>
        <a href="{{ URL::to('/about') }}" {!! (request()->is('about')) ? 'class="active"' : '' !!}>About us</a>
        <a href="{{ URL::to('/blog') }}" {!! (request()->is('blog*')) ? 'class="active"' : '' !!}>Blog</a>
        <a href="{{ URL::to('/jobs') }}" {!! (request()->is('jobs*')) ? 'class="active"' : '' !!}>Jobs</a>
        <a href="{{ URL::to('/contact') }}" {!! (request()->is('contact*')) ? 'class="active"' : '' !!}>Contact Us</a>
    @else
        <a href="{{ URL::to('/lol-boost') }}">League of Legends</a>
        <a href="{{ URL::to('/valorant-boost') }}">Valorant</a>
        <a href="{{ URL::to('/csgo') }}">CS:GO</a>
        @php
            $showCompanyMenu = true;
        @endphp
    @endif

    @if (request()->is('csgo*') || $showCompanyMenu)
            <div class="dropdown">
                <span>Company</span>
                <div class="submenu">
                    <a href="{{ URL::to('/about') }}" class="link people">
                        <span class="title">About us</span>
                        <span>Learn more about Eloking</span>
                    </a>
                    <a href="{{ URL::to('/blog') }}" class="link news">
                        <span class="title">Blog</span>
                        <span>Gaming related news</span>
                    </a>
                    <a href="{{ URL::to('/jobs') }}" class="link work">
                        <span class="title">Jobs</span>
                        <span>Work for Eloking</span>
                    </a>
                    <a href="{{ URL::to('/contact') }}" class="link support">
                        <span class="title">Contact Us</span>
                        <span>Get in touch with Eloking</span>
                    </a>
                </div>
            </div>
    @endif
</div>
