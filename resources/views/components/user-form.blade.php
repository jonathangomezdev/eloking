<div class="table-wrap">
    <div class="row">
        <div>
            @if ($type === 'edit')
                <input type="hidden" name="_method" value="PUT" />
                <input type="hidden" name="user_id" value="{{ $user->id }}">
            @endif
            @csrf

            <div class="panel-subtitle">
                Profile Information
            </div>
            <div class="profile-wrap">
                <div class="profile-wrap__cell">
                    <div class="input-group">
                        <label>Name <span class="required">*</span></label>
                        <input type="text" value="{{ $type == 'edit' ? $user->name : old('name') }}" name="name" required/>
                        @error('name')
                            <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="profile-wrap__cell">
                    <div class="input-group">
                        <label>Email <span class="required">*</span></label>
                        <input type="text" value="{{ $type == 'edit' ? $user->email : old('email') }}" name="email" required/>
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
                        <input type="text" value="{{ $type == 'edit' ? $user->username : old('username') }}" name="username"/>
                        @error('username')
                        <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="profile-wrap__cell">
                    <div class="input-group">
                        <label>Discord</label>
                        <input type="text" value="{{ $type == 'edit' ? $user->discord : old('discord') }}" name="discord"/>
                        @error('discord')
                        <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="profile-wrap">
                <div class="profile-wrap__cell">
                    <div class="input-group">
                        <label>Active <span class="required">*</span></label>
                        <div class="booster-selection-wrapper boost-type-select select2-trigger">
                            <div class="booster-rank-selection-wrapper">
                                <select
                                    class="boost-type booster-rank-selection booster-rank-selection select2"
                                    name="active">
                                    <option @if($type == 'edit' && $user->active) selected @endif value="1">Yes</option>
                                    <option @if($type == 'edit' && !$user->active) selected @endif value="0">No</option>
                                </select>
                                <span class="dropdown-icon">
                                    <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                </span>
                            </div>
                        </div>
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
                                <input type="checkbox" @if($type == 'edit' && $user->allow_notification_sound) checked @endif name="allow_notification_sound" id="cb1" /><label for="cb1">
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
                                <input type="checkbox" @if($type == 'edit' && $user->allow_email_notifications) checked @endif name="allow_email_notifications" id="cb2" /><label for="cb2">
                                    Allow Email Notifications
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
                                <input type="checkbox" @if($type == 'edit' && $user->allow_notifications_in_discord) checked @endif name="allow_notifications_in_discord" id="cb3" /><label for="cb3">
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
                        <label>
                            @if($type == 'edit')
                                Change
                            @else
                                Create
                            @endif

                        Password @if($type === 'create') <span class="required">*</span> @endif </label>
                        <input type="password" name="password" placeholder="New Password" @if($type === 'create') required @endif/>
                        @error('password')
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
                Access
            </div>
            <div class="profile-wrap">
                <div class="profile-wrap__cell profile-wrap__cell--full">
                    <div class="input-group">
                        <label>Roles</label>
                        <div class="multiple-check">
                            <div class="multiple-check__cell">
                                <input type="checkbox" name="roles[]" @if($type == 'edit' && $user->hasRole('admin')) checked @endif value="admin" id="cb4" /><label for="cb4">Admin</label>
                            </div>
                            <div class="multiple-check__cell">
                                <input type="checkbox" name="roles[]" @if($type == 'edit' && $user->hasRole('booster')) checked @endif value="booster" id="cb5" /><label for="cb5">Booster</label>
                            </div>

                            <div class="multiple-check__cell">
                                <input type="checkbox" name="roles[]" @if($type == 'edit' && $user->hasRole('accountant')) checked @endif value="accountant" id="cb6" /><label for="cb6">Accountant</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile-wrap show-when-role-booster @if($type == 'edit' && $user->hasRole('booster')) show @endif">
                <div class="profile-wrap__cell profile-wrap__cell--full">
                    <div class="input-group">
                        <label>Booster is allowed to boost in</label>
                        <div class="multiple-check">
                            <div class="multiple-check__cell">
                                <input type="checkbox" value="csgo" name="gameRestrictions[]" @if($type == 'edit' && $user->boosterGameRestrictions()->where('game', 'csgo')->exists()) checked @endif id="bb1" /><label for="bb1">CS:GO</label>
                            </div>
                            <div class="multiple-check__cell">
                                <input type="checkbox" value="valorant" name="gameRestrictions[]" @if($type == 'edit' && $user->boosterGameRestrictions()->where('game', 'valorant')->exists()) checked @endif id="bb2" /><label for="bb2">Valorant</label>
                            </div>
                            <div class="multiple-check__cell">
                                <input type="checkbox" value="lol" name="gameRestrictions[]" @if($type == 'edit' && $user->boosterGameRestrictions()->where('game', 'lol')->exists()) checked @endif id="bb3" /><label for="bb3">League of Legends</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile-wrap show-when-role-booster @if($type == 'edit' && $user->hasRole('booster')) show @endif" >
                <div class="profile-wrap__cell profile-wrap__cell--full">
                    <div class="input-group">
                        <div class="multiple-check">
                            <div class="multiple-check__cell">
                                <input type="checkbox" @if($type == 'edit' && $user->allow_coaching_orders) checked @endif name="allow_coaching_orders" id="cb10" /><label for="cb10">
                                    Allow Coaching Orders
                                </label>
                            </div>
                        </div>
                        @error('allow_coaching_orders')
                        <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="profile-wrap show-when-role-booster @if($type == 'edit' && $user->hasRole('booster')) show @endif">
                <div class="profile-wrap__cell">
                    <div class="input-group">
                        <label>Maximum Allowed Platforms</label>
                        <input type="text" name="max_allowed_platforms" value="{{ isset($user) ? $user->max_allowed_platforms : 1 }}" placeholder="eg. 2" />
                        @error('max_allowed_platforms')
                            <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="profile-wrap__cell">
                    <div class="input-group">
                        <label>Maximum Allowed Pickup</label>
                        <input type="text" name="max_allowed_pickups" value="{{ isset($user) ? $user->max_allowed_pickups : 3 }}" placeholder="eg. 5" />
                        @error('max_allowed_pickups')
                            <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row show-when-role-booster @if($type == 'edit' && $user->hasRole('booster')) show @endif">
        <div>
            <div class="panel-subtitle">Booster details</div>
            <div class="panel-description">This information will be displayed only in platform generated invoices to
                comply with legal requirements. In case you are a legal entity or require to charge a specific VAT
                rate, please define that below.</div>
            <div class="profile-wrap">
                <div class="profile-wrap__cell">
                    <div class="input-group">
                        <label>Company Name - Optional</label>
                        <input type="text" name="company_name" value="{{ $type == 'edit' ? $user->company_name : '' }}" placeholder="eg. Acme Inc."/>
                        @error('company_name')
                        <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="profile-wrap__cell">
                    <div class="input-group">
                        <label>Street</label>
                        <input type="text" name="street" value="{{ $type == 'edit' ? $user->street : '' }}" placeholder="eg. 123 Main st"/>
                        @error('street')
                        <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="profile-wrap">
                <div class="profile-wrap__cell">
                    <div class="input-group">
                        <label>City</label>
                        <input type="text" name="city" value="{{ $type == 'edit' ? $user->city : '' }}" placeholder="eg. Miami"/>
                        @error('city')
                        <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="profile-wrap__cell">
                    <div class="input-group">
                        <label>State - Optional</label>
                        <input type="text" name="state" value="{{ $type == 'edit' ? $user->state : '' }}" placeholder="eg. Florida"/>
                        @error('state')
                        <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="profile-wrap">
                <div class="profile-wrap__cell">
                    <div class="input-group">
                        <label>Country</label>
                        <div class="booster-selection-wrapper boost-type-select select2-trigger">
                            <div class="booster-rank-selection-wrapper">
                                <select name="country" id="country" class="boost-type booster-rank-selection booster-rank-selection select2-searchable">
                                    <option value="">Choose Country</option>
                                    @foreach(getCountryNames() as $code => $name)
                                        <option @if($type === 'edit' && $user->country == $code) selected @endif value="{{ $code }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <span class="dropdown-icon">
                                    <img src="{{ asset('img/1x1.png') }}" class="lazyload" data-src="{{ asset('/img/icons/dropdown-icon.png') }}" alt="icon"/>
                                </span>
                                @error('country')
                                    <small class="error">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-wrap__cell">
                    <div class="input-group">
                        <label>Postcode / ZIP</label>
                        <input type="text" name="postcode" value="{{ $type == 'edit' ? $user->postcode : '' }}" placeholder="eg. SDAS 23A"/>
                        @error('postcode')
                        <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="profile-wrap">
                <div class="profile-wrap__cell">
                    <div class="input-group">
                        <label>VAT Rate (%) - Optional</label>
                        <input type="text" name="vat_rate" value="{{ $type == 'edit' ? $user->vat_rate : '' }}" placeholder="eg. 12.31"/>
                        @error('vat_rate')
                        <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="profile-wrap__cell">
                    <div class="input-group">
                        <label>VAT Number - Optional</label>
                        <input type="text" name="vat_number" value="{{ $type == 'edit' ? $user->vat_number : '' }}" placeholder="eg. AS233435"/>
                        @error('vat_number')
                        <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row show-when-role-booster @if($type == 'edit' && $user->hasRole('booster')) show @endif">>
        <div>
            <div class="panel-subtitle">Payout Details</div>
            <div class="panel-description"><strong>Please be Careful</strong>. Incorrect values could lead to sending payout to incorrect account. Please double check the values you enter. You can update this information only once. After first update this information will be frozen. You will need to contact admin for any changes after first update.</div>
            <div class="profile-wrap">
                <div class="profile-wrap__cell">
                    <div class="input-group">
                        <label>Preferred payout method</label>
                        <div class="booster-selection-wrapper boost-type-select select2-trigger">
                            <div class="booster-rank-selection-wrapper">
                                <select name="payout_method" id="payout_method" class="boost-type booster-rank-selection booster-rank-selection select2" >
                                    <option value="">Choose method</option>
                                    <option @if(isset($user) && $user->payoutMethod('payout_method') === 'paypal') selected @endif value="paypal">PayPal</option>
                                    <option @if(isset($user) && $user->payoutMethod('payout_method') === 'bank_transfer') selected @endif value="bank_transfer">Bank Transfer</option>
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
            <div id="paypalMethodWrapper" class="profile-wrap {{ isset($user) && $user->payoutMethod('payout_method') === 'paypal' ? '' : 'hide' }}">
                <div class="profile-wrap__cell">
                    <div class="input-group">
                        <label>PayPal Email Address</label>
                        <input type="text" value="{{ !( isset($user) && $user->payoutMethod('payout_method') === 'paypal') ? '' : $user->payoutMethod('paypal_email') }}" name="paypal_email" placeholder="eg. my-paypal@email.com" />
                        @error('paypal_email')
                        <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div id="bankMethodWrapper" class="{{ isset($user) && $user->payoutMethod('payout_method') === 'bank_transfer' ? '' : 'hide' }}" >
                <div class="profile-wrap">
                    <div class="profile-wrap__cell">
                        <div class="input-group">
                            <label>Bank Name</label>
                            <input type="text" value="{{ isset($user) && $user->payoutMethod('bank_name') ? $user->payoutMethod('bank_name') : '' }}" name="bank_name" placeholder="eg. Wells Fargo Bank"  />
                            @error('bank_name')
                            <small class="error">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="profile-wrap__cell">
                        <div class="input-group">
                            <label>Bank Address</label>
                            <input type="text" value="{{ isset($user) && $user->payoutMethod('bank_address') ? $user->payoutMethod('bank_address') : '' }}" name="bank_address" placeholder="eg. 123 Main St. Miami, Florida" />
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
                            <input type="text" value="{{ isset($user) && $user->payoutMethod('recipient_full_name') ? $user->payoutMethod('recipient_full_name') : '' }}" name="recipient_full_name" placeholder="eg. John S. Doe" />
                            @error('recipient_full_name')
                            <small class="error">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="profile-wrap__cell">
                        <div class="input-group">
                            <label>IBAN</label>
                            <input type="text" value="{{ isset($user) && $user->payoutMethod('iban') ? $user->payoutMethod('iban') : '' }}" name="iban" placeholder="eg. LV80 BANK XXXX XXXX XXXX X" />
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
                            <input type="text" value="{{ isset($user) && $user->payoutMethod('swift_bic') ? $user->payoutMethod('swift_bic') : '' }}" name="swift_bic" placeholder="eg. NOSCCATTXXX" />
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
                                    <select name="bank_country" id="bank_country" class="boost-type booster-rank-selection booster-rank-selection select2-searchable" >
                                        <option value="">Choose country</option>
                                        @foreach(getCountryNames() as $code => $name)
                                            <option @if(isset($user) && $user->payoutMethod('bank_country') === $code) selected @endif value="{{ $code }}">{{ $name }}</option>
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
                                    <select name="recipient_country" id="recipient_country" class="boost-type booster-rank-selection booster-rank-selection select2-searchable" >
                                        <option value="">Choose country</option>
                                        @foreach(getCountryNames() as $code => $name)
                                            <option @if(isset($user) && $user->payoutMethod('recipient_country') === $code) selected @endif value="{{ $code }}">{{ $name }}</option>
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
    <div class="row">
        <button type="submit" class="panel-btn">
            @if($type === 'create')
                Create User
            @else
                Save Changes
            @endif
        </button>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#cb5').change(function(){
                $('.show-when-role-booster').toggleClass('show');
            })

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
