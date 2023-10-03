<?php

namespace App;

use App\Notifications\ResetPasswordNotification;
use App\Traits\Filters\UserFilters;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\URL;
use Laravel\Cashier\Billable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable,
        UserFilters,
        HasRoles,
        Billable,
        SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'active', 'company_name', 'street',
        'city', 'state', 'country', 'postcode', 'vat_rate', 'vat_number', 'allow_notification_sound', 'discord',
        'allow_email_notifications', 'last_seen_at', 'allow_coaching_orders', 'max_allowed_platforms', 'max_allowed_pickups',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $cache = [];

    public function boosterGameRestrictions()
    {
        return $this->hasMany(BoosterGameRestriction::class, 'user_id', 'id');
    }

    public function firstLetter()
    {
        $name = strtolower($this->name ?? '');
        if ($name) {
            return substr($name, 0, 1);
        }
        return substr(strtolower($this->email), 0, 1);
    }

    public function payouts()
    {
        return $this->belongsTo(BoosterPayout::class, 'id', 'booster_id');
    }

    public function boosting()
    {
        return $this->hasMany(BoosterOrder::class, 'booster_id', 'id');
    }

    public function chatRooms()
    {
        return $this->hasManyThrough(ChatRoom::class, ChatRoomMember::class, 'user_id', 'id');
    }

    public static function bot()
    {
        if (! User::whereName('Eloking BOT')->exists()) {
            Artisan::call('db:seed', ['--class' => 'ElokingChatBotSeeder']);
        }

        return User::whereName('Eloking BOT')->first();
    }

    public static function generateUsername($email)
    {
        $originalUsername = explode('@', $email)[0];
        $username = $originalUsername;

        $count = 1;
        while(User::whereUsername($username)->exists()) {
            $username = $originalUsername . $count;
            $count++;
        }

        return $username;
    }

    public function isOnline()
    {
        return now()->diffInMinutes($this->last_seen_at) <= 5;
    }

    public static function countAllOnlineUsers()
    {
        return User::whereBetween('last_seen_at', [now()->subMinutes(10)->seconds(0)->toDateTimeString(), now()->seconds(59)->toDateTimeString()])->count() + 15;
    }

    /**
     * Send a password reset notification to the user.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $url = URL::to('/password/reset?token=' . $token . '&email=' . $this->email);

        $this->notify(new ResetPasswordNotification($url));
    }

    public function isBot()
    {
        return $this->name == 'Eloking BOT';
    }

    /**
     * @param null $field
     * @return mixed|null
     */
    public function payoutMethod($field = null)
    {
        if (! isset($this->cache['payoutMethod'])) {
            $methods = UserPayoutMethod::where('user_id', $this->id)->where('active', UserPayoutMethod::STATUS_ACTIVE)->first();
            $this->cache['payoutMethod'] = $methods;
        } else {
            $methods = $this->cache['payoutMethod'];
        }

        if (!$methods || !$field) {
            return $methods;
        }

        if (isset($methods->details[$field])) {
            return $methods->details[$field];
        }

        return null;
    }
}
