@php
    $type = $type ?? null;
    switch($type) {
        case 'csgo':
            $title = 'It\'s time for you to be the <span>best</span>.';
            $buttonText = 'Crush your enemies!';
            $buttonUrl = '#calculate-boost';
            break;
        case 'csgo-home':
            $title = 'It\'s time for you to be the <span>best</span>.';
            $buttonText = 'Choose platform';
            $buttonUrl = '#choose-platform';
            break;
        case 'valorant':
            $title = 'It\'s time for you to be the <span>best</span>.';
            $buttonText = 'Smash ranks!';
            $buttonUrl = '#calculate-boost';
            break;
        case 'lol':
            $title = 'It\'s time for you to be the <span>best</span>.';
            $buttonText = 'Dominate the game!';
            $buttonUrl = '#calculate-boost';
            break;
        default:
            $title = 'It\'s time for you to be the <span>best</span>.';
            $buttonText = 'Smash ranks!';
            $buttonUrl = '#choose-game';
    }
@endphp

<div class="container">
    <div class="promo-king">
        <div class="content">
            <div class="text">{!! $title !!}</div>
            <a href="{{ $buttonUrl }}" class="button go">{{ $buttonText }}</a>
        </div>
    </div>
</div>
