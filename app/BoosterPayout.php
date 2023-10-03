<?php

namespace App;

use App\Traits\Filters\BoosterPayoutFilters;
use Illuminate\Database\Eloquent\Model;

class BoosterPayout extends Model
{
    use BoosterPayoutFilters;

    protected $fillable = [
        'booster_id', 'payout_amount_eur', 'status', 'fee', 'paid_at', 'booster_payout_id', 'note',
    ];

    const STATUS_PAYOUT_PENDING = 'pending';
    const STATUS_PAYOUT_PROGRESS = 'in_progress';
    const STATUS_PAYOUT_FAILED = 'payout_failed';
    const STATUS_PAYOUT_COMPLETED = 'completed';
    const STATUS_PAYOUT_REVIEW = 'review';

    public function orders()
    {
        return Order::find(BoosterPayoutOrder::select('order_id')->where('booster_payout_id', $this->id)->get()->pluck('order_id')->toArray());
    }

    public function booster()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeRestrictRoleAccess($query)
    {
        if (!auth()->user()->hasRole('admin')) {
            return $query->where('booster_id', auth()->id());
        }
    }

    public function totalPending()
    {
        return $this->getPayoutAmount(BoosterPayout::STATUS_PAYOUT_PENDING);
    }

    public function totalProgress()
    {
        return $this->getPayoutAmount(BoosterPayout::STATUS_PAYOUT_REVIEW);
    }

    public function totalReview()
    {
        return $this->getPayoutAmount(BoosterPayout::STATUS_PAYOUT_REVIEW);
    }

    public function totalCompleted()
    {
        return $this->getPayoutAmount(BoosterPayout::STATUS_PAYOUT_COMPLETED);
    }

    public function getPayoutAmount($status)
    {
        $payoutAmountEur = $this
                ->where('status', $status)
                ->where('created_at', '>', now()->subDays(90))
                ->sum('payout_amount_eur');
        return currencyFormatted($payoutAmountEur, 'EUR');
    }
}
