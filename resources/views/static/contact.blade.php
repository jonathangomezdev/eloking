@extends('layout.main')
@section('content')
    <div class="container top">
        <h1 class="center">
            Contact <span>Us</span><div class="emoji">🎉</div>
        </h1>
    </div>
    <div class="container top">
        <div class="contact-page">
            <div>
                <form action="{{ URL::to('/contact') }}" method="POST">
                    @csrf
                    @captcha
                    <div class="input-wrapper">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="blackbox-input-group @error('name') has-feedback has-error @enderror">
                            <input type="text" class="blackbox-input" value="{{ old('name') }}" name="name" id="name" required/>
                            <label for="name" class="blackbox-input-label">Name or Nickname</label>
                            @error('name') <div class="feedback error">{{ $message }}</div> @enderror
                        </div>
                        <div class="blackbox-input-group @error('email') has-feedback has-error @enderror">
                            <input type="email" class="blackbox-input fake-placeholder" value="{{ old('email') }}" name="email" id="email" placeholder="email" required/>
                            <label for="email" class="blackbox-input-label">Email</label>
                            @error('email') <div class="feedback error">{{ $message }}</div> @enderror
                        </div>
                        <div class="blackbox-input-group textarea @error('message') has-feedback has-error @enderror">
                            <textarea class="blackbox-input" name="message" id="message" required>{{ old('message') }}</textarea>
                            <label for="message" class="blackbox-input-label">Message</label>
                            @error('message') <div class="feedback error">{{ $message }}</div> @enderror
                        </div>

                        <button class="button submit-button">
                            Contact Us
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('layout.partials.king-banner')
@endsection
