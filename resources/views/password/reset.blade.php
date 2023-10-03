@extends('layout.main')
@section('content')
    <div class="container">
        <div class="password-reset">
            <h2>Forgot Password?</h2>
            @if($errors->any())
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            @endif
            <form action="{{ URL::to('/password/reset') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $email }}" name="email" />
                <input type="hidden" value="{{ $token }}" name="token" />
                <div class="blackbox-input-group">
                    <input type="password" class="blackbox-input @error('password') has-feedback has-error @enderror" name="password" id="password" required/>
                    <label for="password" class="blackbox-input-label">Password</label>
                    @error('password') <span class="feedback error">{{ $message }}</span> @enderror
                </div>
                <div class="blackbox-input-group">
                    <input type="password" class="blackbox-input" name="password_confirmation" id="password_confirm" required/>
                    <label for="password_confirm" class="blackbox-input-label">Confirm Password</label>
                    @error('password_confirmation') <div class="error">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="button">
                    Reset Password
                </button>
            </form>
        </div>
    </div>
@endsection
