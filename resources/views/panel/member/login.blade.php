@extends('layout.main')
@section('content')
    <div class="login-page container">

        @if (request('order_success'))
            <div class="order_success">
                <span>Order placed successfully. Email address {{ request('email') }} already has an account so please log in to access your order</span>
            </div>
        @endif

        <div class="blackbox">
            <div class="login-form-wrapper">
                <div class="form-heading">
                    <span class="form-title">
                        Member <br> Login
                    </span>
                </div>
                <form action="{{ route('auth.login') }}" method="POST">
                    <div class="form-inputs-wrapper">
                        @csrf
                        @captcha
                        <div class="blackbox-input-group @error('username') has-feedback has-error @enderror @error('email') has-feedback has-error @enderror">
                            <input type="text" class="blackbox-input" value="{{ old('username') }}" name="username" id="login-name" autofocus required/>
                            <label for="login-name" class="blackbox-input-label">Email or username</label>
                            @error('username') <div class="feedback error">{{ $message }}</div> @enderror
                            @error('email') <div class="feedback error">{{ $message }}</div> @enderror
                        </div>

                        <div class="blackbox-input-group @error('password') has-feedback has-error @enderror">
                            <input type="password" class="blackbox-input fake-placeholder" name="password" id="password" placeholder="Password" required/>
                            <label for="password" class="blackbox-input-label">Password</label>
                            @error('password') <div class="feedback error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="button login-button">
                                <div>
                                    Login
                                </div>
                            </button>

                            {{-- <ul class="login-social-icons">
                                <li>
                                    <a href="#" class="google-icon">
                                        <img src="{{ asset('/img/icons/google.svg') }}" alt="Google logo"/>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="facebook-icon">
                                        <img src="{{ asset('/img/icons/fb.svg') }}" alt="Facebook logo"/>
                                    </a>
                                </li>
                            </ul> --}}
                            <div class="bottom-actions">
                                <div>
                                    <a href="#" class="fancy forgot-password">Forgot Password?</a>
                                </div>
                            </div>
                        </div>
                        <div class="login-tip">
                            Member area can be accessed after the first purchase. 
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @include('layout.partials.king-banner')
        @include('layout.partials.forgot-password-modal')
    </div>
@endsection
