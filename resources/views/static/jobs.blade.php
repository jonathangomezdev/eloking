@extends('layout.main')
@section('content')
    <div class="container top">
        <h1 class="center">
            Work for <span>Eloking</span><div class="emoji">🎉</div>
        </h1>
    </div>
    <div class="container spacing-top">
        <div class="double-section">
            <div class="double-section__left">
                <img src="{{ asset('img/1x1.png') }}" class="lazyload"
                data-srcset="{{ asset('img/jobs/jobs-1.png') }} 1x, {{ asset('img/jobs/jobs-1@2x.png') }} 2x" alt="Jobs" />
            </div>
            <div class="double-section__right">
                <h2>Before you <br> <span>jump in</span>!</h2>
                <p>Eloking is on a mission to change the boosting game & it starts with us. We are always on the lookout
                    for the daring and ambitious boosters who are ready to challange the status quo of the gaming
                    world.</p>
                <a href="#jobs-form" class="button go">Apply Now!</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="divider top"></div>
    </div>
    <div class="container spacing-top">
        <div class="double-section">
            <div class="double-section__left">
                <h2>Some of the perks <br /> <span>Eloking</span> Boosters <br>Enjoy!</h2>
                <ol>
                    <li>Best compensation on the market</li>
                    <li>Timely payouts</li>
                    <li>Work according to your schedule</li>
                    <li>Transparent and understanding leadership</li>
                </ol>
                <a href="#jobs-form" class="button go">Apply Now!</a>
            </div>
            <div class="double-section__right">
                <img src="{{ asset('img/1x1.png') }}" class="lazyload"
                data-srcset="{{ asset('img/jobs/jobs-2.png') }} 1x, {{ asset('img/jobs/jobs-2@2x.png') }} 2x" alt="Jobs" />
            </div>
        </div>
    </div>
    <div class="container">
        <div class="divider top"></div>
    </div>
    <div class="container overflow">
        <div class="letter">
            <div class="background-text centered">Booster<br />Review</div>
            <div class="review-large">Eloking pays better, treats you better and are highly professional.</div>
            <div class="author">
                <img class="photo lazyload" src="{{ asset('img/1x1.png') }}" data-src="{{ asset('img/icons/image-hex0r.png') }}" alt="Eloking Booster" />
                <div class="name">
                    <div class="name__tag">hex0r-</div>
                    <span>Eloking booster</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="divider top"></div>
    </div>
    <div class="container spacing-top" id="jobs-form">
        <h2 class="center">Contact us <br />to <span>apply</span>!</h2>
        <form action="{{ URL::to('/contact') }}" method="POST" class="jobs-form">
            <div class="form-inputs-wrapper">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @csrf
                @captcha
                <div class="blackbox-input-group @error('name') has-feedback has-error @enderror">
                    <input type="text" class="blackbox-input" value="{{ old('name') }}" name="name" id="name" required />
                    <label for="name" class="blackbox-input-label">Name or Nickname</label>
                    @error('name') <div class="feedback error">{{ $message }}</div> @enderror
                </div>
                <div class="blackbox-input-group @error('email') has-feedback has-error @enderror">
                    <input type="email" class="blackbox-input fake-placeholder" value="{{ old('email') }}" name="email" id="email" placeholder="email" required />
                    <label for="email" class="blackbox-input-label">Email</label>
                    @error('email') <div class="feedback error">{{ $message }}</div> @enderror
                </div>
                <div class="blackbox-input-group @error('discord') has-feedback has-error @enderror">
                    <input type="text" class="blackbox-input" value="{{ old('discord') }}" name="discord" id="discord" required />
                    <label for="discord" class="blackbox-input-label">Discord</label>
                    @error('discord') <div class="feedback error">{{ $message }}</div> @enderror
                </div>
                <div class="blackbox-input-group @error('rank') has-feedback has-error @enderror">
                    <input type="text" class="blackbox-input" value="{{ old('rank') }}" name="rank" id="rank" required />
                    <label for="rank" class="blackbox-input-label">Rank</label>
                    @error('rank') <div class="feedback error">{{ $message }}</div> @enderror
                </div>
                 <div class="blackbox-input-group @error('boost_exp') has-feedback has-error @enderror">
                    <input type="text" class="blackbox-input" value="{{ old('boost_exp') }}" name="boost_exp" id="boost_exp" required />
                    <label for="boost_exp" class="blackbox-input-label">Boosting Experience</label>
                    @error('boost_exp') <div class="feedback error">{{ $message }}</div> @enderror
                </div>
                 <div class="blackbox-input-group @error('account_link') has-feedback has-error @enderror">
                    <input type="text" class="blackbox-input" value="{{ old('account_link') }}" name="account_link" id="account_link" required />
                    <label for="account_link" class="blackbox-input-label">Main account link</label>
                    @error('account_link') <div class="feedback error">{{ $message }}</div> @enderror
                </div>
                 <div class="blackbox-input-group textarea @error('message') has-feedback has-error @enderror">
                    <textarea class="blackbox-input" name="message" id="message" placeholder="Previous boosting or professional gaming experience and link to your main account" required>{{ old('message') }}</textarea>
                    <label for="message" class="blackbox-input-label">Message</label>
                    @error('message') <div class="feedback error">{{ $message }}</div> @enderror
                </div>
            </div>
            <button class="button" type="submit">Apply</button>
        </form>
    </div>
    @include('layout.partials.king-banner')
@endsection
