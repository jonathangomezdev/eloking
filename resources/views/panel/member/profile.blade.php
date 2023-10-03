@extends('panel.layout.main')
@section('content')
    <div class="content panel-user-profile-edit">
        <div class="container inner">
            <h1>
                My
                <span>Profile</span>
                <a href="{{ URL::to('/panel/orders') }}" class="move-back">
                    <img src="{{ asset('img/icons/arrow-right.svg') }}" alt="Arrow back" />
                </a>
            </h1>
            @if (session('success'))
                <div class="alert success">
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            <form action="{{ URL::to('/panel/profile') }}" method="POST">
                <div class="table">
                    <div class="table-wrap">
                        <div class="row">
                            <div>
                                <input type="hidden" name="_method" value="PUT" />
                                @csrf

                                <div class="panel-subtitle">
                                    Profile Information
                                </div>
                                <div class="profile-wrap">
                                    <div class="profile-wrap__cell">
                                        <div class="input-group">
                                            <label>Name</label>
                                            <input type="text" value="{{ $user->name }}" name="name" required/>
                                            @error('name')
                                                <small class="error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="profile-wrap__cell">
                                        <div class="input-group">
                                            <label>Email</label>
                                            <input type="text" value="{{ $user->email }}" name="email" required/>
                                            @error('email')
                                                <small class="error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-wrap">
                                    <div class="profile-wrap__cell">
                                        <div class="input-group">
                                            <label>Username</label>
                                            <input type="text" value="{{ $user->username }}" name="username"/>
                                            @error('username')
                                                <small class="error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <div class="panel-subtitle">
                                    Notifications
                                </div>
                                <div class="profile-wrap">
                                    <div class="profile-wrap__cell profile-wrap__cell--full">
                                        <div class="input-group">
                                            <div class="multiple-check">
                                                <div class="multiple-check__cell">
                                                    <input type="checkbox" @if($user->allow_notification_sound) checked @endif name="allow_notification_sound" id="cb1" /><label for="cb1">
                                                        Allow Notification Sounds
                                                    </label>
                                                </div>
                                            </div>
                                            @error('allow_notification_sound')
                                            <small class="error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-wrap">
                                    <div class="profile-wrap__cell profile-wrap__cell--full">
                                        <div class="input-group">
                                            <div class="multiple-check">
                                                <div class="multiple-check__cell">
                                                    <input type="checkbox" @if($user->allow_email_notifications) checked @endif name="allow_email_notifications" id="cb2" /><label for="cb2">
                                                        Email notifications
                                                    </label>
                                                </div>
                                            </div>
                                            @error('allow_notification_sound')
                                            <small class="error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-wrap">
                                    <div class="profile-wrap__cell profile-wrap__cell--full">
                                        <div class="input-group">
                                            <div class="multiple-check">
                                                <div class="multiple-check__cell">
                                                    <input type="checkbox" @if($user->allow_notifications_in_discord) checked @endif name="allow_notifications_in_discord" id="cb3" /><label for="cb3">
                                                        Enable Notifications in Discord
                                                    </label>
                                                </div>
                                            </div>
                                            @error('allow_notifications_in_discord')
                                            <small class="error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <div class="panel-subtitle">
                                    Password
                                </div>
                                <div class="profile-wrap">
                                    <div class="profile-wrap__cell">
                                        <div class="input-group">
                                            <label>Change Password</label>
                                            <input type="password" name="password" placeholder="New Password"/>
                                            @error('password')
                                                <small class="error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('booster'))
                            <div class="row">
                            <div>
                                <div class="panel-subtitle">Booster details</div>
                                <div class="panel-description">This information will be displayed only in platform
                                    generated invoices to comply with legal requirements. In case you are a legal entity
                                    or require to charge a specific VAT rate, please define that below.</div>
                                <div class="profile-wrap">
                                    <div class="profile-wrap__cell">
                                        <div class="input-group">
                                            <label>Street</label>
                                            <input type="text" name="street" value="{{ $user->street }}" placeholder="eg. 123 Main st."/>
                                            @error('street')
                                                <small class="error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="profile-wrap__cell">
                                        <div class="input-group">
                                            <label>City</label>
                                            <input type="text" name="city" value="{{ $user->city }}" placeholder="eg. Miami"/>
                                            @error('city')
                                                <small class="error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-wrap">
                                    <div class="profile-wrap__cell">
                                        <div class="input-group">
                                            <label>State - Optional</label>
                                            <input type="text" name="state" value="{{ $user->state }}" placeholder="eg. Florida"/>
                                            @error('state')
                                                <small class="error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="profile-wrap__cell">
                                        <div class="input-group">
                                            <label>Country</label>
                                            <div class="booster-selection-wrapper boost-type-select select2-trigger">
                                                <div class="booster-rank-selection-wrapper">
                                                    <select name="country" id="country" class="boost-type booster-rank-selection booster-rank-selection select2-searchable">
                                                        <option value="">Choose country</option>
                                                        @foreach(getCountryNames() as $code => $name)
                                                            <option @if($user->country == $code) selected @endif value="{{ $code }}">{{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="dropdown-icon">
                                                        <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                                    </span>
                                                    @error('country')
                                                        <small class="error">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-wrap">
                                    <div class="profile-wrap__cell">
                                        <div class="input-group">
                                            <label>Postcode / ZIP</label>
                                            <input type="text" value="{{ $user->postcode }}" name="postcode" placeholder="eg. 23552"/>
                                            @error('postcode')
                                            <small class="error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="profile-wrap__cell">
                                        <div class="input-group">
                                            <label>Company Name - Optional</label>
                                            <input type="text" value="{{ $user->company_name }}" name="company_name" placeholder="eg. Acme Inc."/>
                                            @error('company_name')
                                            <small class="error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-wrap">
                                <div class="profile-wrap__cell">
                                    <div class="input-group">
                                        <label>VAT Rate (%) - Optional</label>
                                        <input type="text" value="{{ $user->vat_rate }}" name="vat_rate" placeholder="eg. 18.23"/>
                                        @error('vat_rate')
                                        <small class="error">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="profile-wrap__cell">
                                    <div class="input-group">
                                        <label>VAT Number - Optional</label>
                                        <input type="text" value="{{ $user->vat_number }}" name="vat_number" placeholder="eg. VA24556754"/>
                                        @error('vat_rate')
                                        <small class="error">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <div class="panel-subtitle">Payout Details</div>
                                <div class="panel-description"><strong>Please be Careful</strong>. Incorrect values could lead to sending payout to incorrect account. Please double check the values you enter. You can update this information only once. After first update this information will be frozen. You will need to contact admin for any changes after first update.</div>
                                <div class="profile-wrap">
                                    <div class="profile-wrap__cell">
                                        <div class="input-group">
                                            <label>Preferred payout method</label>
                                            <div class="booster-selection-wrapper boost-type-select select2-trigger">
                                                <div class="booster-rank-selection-wrapper">
                                                    <select name="payout_method" id="payout_method" class="boost-type booster-rank-selection booster-rank-selection select2" @if($user->payoutMethod()) disabled @endif>
                                                        <option value="">Choose method</option>
                                                        <option @if($user && $user->payoutMethod() && $user->payoutMethod()->method === 'paypal') selected @endif value="paypal">PayPal</option>
                                                        <option @if($user && $user->payoutMethod() && $user->payoutMethod()->method === 'bank_transfer') selected @endif value="bank_transfer">Bank Transfer</option>
                                                    </select>
                                                    <span class="dropdown-icon">
                                                        <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                                    </span>
                                                    @error('payout_method')
                                                    <small class="error">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="paypalMethodWrapper" class="profile-wrap {{ $user->payoutMethod('payout_method') === 'paypal' ? '' : 'hide' }}">
                                    <div class="profile-wrap__cell">
                                        <div class="input-group">
                                            <label>PayPal Email Address</label>
                                            <input type="text" value="{{ !($user->payoutMethod('payout_method') === 'paypal') ? '' : $user->payoutMethod('paypal_email') }}" name="paypal_email" placeholder="eg. my-paypal@email.com" @if($user->payoutMethod()) disabled @endif/>
                                            @error('paypal_email')
                                            <small class="error">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div id="bankMethodWrapper" class="{{ $user->payoutMethod('payout_method') === 'bank_transfer' ? '' : 'hide' }}" >
                                    <div class="profile-wrap">
                                        <div class="profile-wrap__cell">
                                            <div class="input-group">
                                                <label>Bank Name</label>
                                                <input type="text" value="{{ $user->payoutMethod('bank_name') ?? '' }}" name="bank_name" placeholder="eg. Wells Fargo Bank" @if($user->payoutMethod()) disabled @endif />
                                                @error('bank_name')
                                                <small class="error">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="profile-wrap__cell">
                                            <div class="input-group">
                                                <label>Bank Address</label>
                                                <input type="text" value="{{ $user->payoutMethod('bank_address') ?? '' }}" name="bank_address" placeholder="eg. 123 Main St. Miami, Florida" @if($user->payoutMethod()) disabled @endif />
                                                @error('bank_address')
                                                <small class="error">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-wrap">
                                        <div class="profile-wrap__cell">
                                            <div class="input-group">
                                                <label>Recipient full name</label>
                                                <input type="text" value="{{ $user->payoutMethod('recipient_full_name') ?? '' }}" name="recipient_full_name" placeholder="eg. John S. Doe" @if($user->payoutMethod()) disabled @endif />
                                                @error('recipient_full_name')
                                                <small class="error">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="profile-wrap__cell">
                                            <div class="input-group">
                                                <label>IBAN</label>
                                                <input type="text" value="{{ $user->payoutMethod('iban') ?? '' }}" name="iban" placeholder="eg. LV80 BANK XXXX XXXX XXXX X" @if($user->payoutMethod()) disabled @endif />
                                                @error('iban')
                                                <small class="error">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-wrap">
                                        <div class="profile-wrap__cell">
                                            <div class="input-group">
                                                <label>SWIFT/BIC</label>
                                                <input type="text" value="{{ $user->payoutMethod('swift_bic') ?? '' }}" name="swift_bic" placeholder="eg. NOSCCATTXXX" @if($user->payoutMethod()) disabled @endif />
                                                @error('swift_bic')
                                                <small class="error">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-wrap">
                                        <div class="profile-wrap__cell">
                                            <div class="input-group">
                                                <label>Bank Country</label>
                                                <div class="booster-selection-wrapper boost-type-select select2-trigger">
                                                    <div class="booster-rank-selection-wrapper">
                                                        <select name="bank_country" id="bank_country" class="boost-type booster-rank-selection booster-rank-selection select2-searchable" @if($user->payoutMethod()) disabled @endif >
                                                            <option value="">Choose country</option>
                                                            @foreach(getCountryNames() as $code => $name)
                                                                <option @if($user->payoutMethod('bank_country') === $code) selected @endif value="{{ $code }}">{{ $name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="dropdown-icon">
                                                    <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                                </span>
                                                        @error('bank_country')
                                                        <small class="error">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-wrap">
                                        <div class="profile-wrap__cell">
                                            <div class="input-group">
                                                <label>Recipient Country</label>
                                                <div class="booster-selection-wrapper boost-type-select select2-trigger">
                                                    <div class="booster-rank-selection-wrapper">
                                                        <select name="recipient_country" id="recipient_country" class="boost-type booster-rank-selection booster-rank-selection select2-searchable" @if($user->payoutMethod()) disabled @endif >
                                                            <option value="">Choose country</option>
                                                            @foreach(getCountryNames() as $code => $name)
                                                                <option @if($user->payoutMethod('recipient_country') === $code) selected @endif value="{{ $code }}">{{ $name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="dropdown-icon">
                                                        <img src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                                    </span>
                                                        @error('recipient_country')
                                                        <small class="error">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <button type="submit" class="panel-btn">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#payout_method').change(e => {
                let val = $(e.target).val() // $(this) doesn't work
                if (val === 'paypal') {
                    $('#paypalMethodWrapper').show();
                } else {
                    $('#paypalMethodWrapper').hide();
                }
                if (val === 'bank_transfer') {
                    $('#bankMethodWrapper').show();
                } else {
                    $('#bankMethodWrapper').hide();
                }
            });
        });
    </script>

@endpush
