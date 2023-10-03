<?php

namespace App;

use App\Http\Controllers\OrderController;
use App\Traits\Filters\OrderFilters;
use \App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use OrderFilters;

    protected $fillable = [
        'order_id',
        'user_id',
        'total_EUR',
        'payload',
        'status',
        'total',
        'currency',
        'type',
        'gametype',
        'type',
        'platform',
        'payment_id',
        'payment_gateway',
        'booster_earning_EUR',
        'total_refunded_EUR',
        'region',
        'completed_at',
        'order_total_EUR',
    ];

    protected $casts = [
        'payload' => 'json',
        'payload.options' => 'json',
    ];

    /**
     * After following hours. System will take orders in pending status in orders table, and
     * move them to order log table.
     */
    const GARBAGE_COLLECT_PENDING_ORDER_AFTER_HOURS = 48;

    /**
     * After following hours. System will not allow anyone to communicate through chat.
     */
    const COMPLETED_ORDER_CHAT_CLOSE_AFTER_HOURS = 24;

    const DROP_PENALTY = 10; // %

    // Payment Status
    const STATUS_PAYMENT_FAILED     = 'payment_failed';
    const STATUS_PAYMENT_PENDING    = 'pending';
    const STATUS_READY_FOR_PICKUP   = 'ready_for_pickup'; // ready for booster to pickup
    const STATUS_READY              = 'ready'; // booster picked it but haven't started on it yet
    const STATUS_IN_PROGRESS        = 'in_progress';
    const STATUS_COMPLETED          = 'completed';
    const STATUS_REFUNDED           = 'refunded';

    const PAYPAL_GATEWAY            = 'paypal';
    const STRIPE_GATEWAY            = 'stripe';

    public static function boot()
    {
        parent::boot();
        //once created/inserted successfully this method fired, so I tested foo
        static::created(function (Order $order) {
            $orderId = null;
            while(true) {
                $orderId = $order->getUniqueOrderId($order);
                if (! Order::whereOrderId($orderId)->exists()) {
                    break;
                }
            }
            $order->order_id = $orderId;
            $order->save();
        });
    }

    public function getUniqueOrderId(Order $order)
    {
        if ($order->order_id) {
            return $order->order_id;
        }

        $prefix = '';
        switch ($order->gametype) {
            case 'csgo':
                $prefix = 'CS';
                break;
            case 'lol':
                $prefix = 'LL';
                break;
            case 'valorant':
                $prefix = 'VL';
                break;
        }

        return $prefix . rand(pow(10, 5-1), pow(10, 5)-1);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getOrderSummary($gametype, $platform = 'matchmaking')
    {
        try {
            $order = Order::where('gametype', $gametype)
                ->where('platform', $platform)
                ->latest()
                ->first();

            $orderSummary = null;
            if ($order && $order->created_at->diffInHours(now()) < 24) {
                $order->boostFrom = Rank::getRankBySequence($gametype, $platform, $order->payload['currentRank']);
                $order->boostTo = Rank::getRankBySequence($gametype, $platform, $order->payload['desiredRank']);
                if ($order->type == 'win') {
                    $orderSummary = $order->payload['desiredRank'] . " win". ($order->payload['desiredRank'] > 1 ? 's' : '') . " in {$order->boostFrom['rank']} ". $order->created_at->diffForHumans();
                } else if ($order->type == 'placement') {
                    $orderSummary = $order->payload['desiredRank'] . ' placement games ' . $order->created_at->diffForHumans();
                } else {
                    $orderSummary = $order->boostFrom['rank'] . ' to ' . $order->boostTo['rank'] . ' ' . $order->created_at->diffForHumans();
                }
            }
            return $orderSummary;
        } catch (\Exception $ex) {
            \Log::debug($ex);
        }
        return null;
    }

    public function booster()
    {
        $boosterOrder = BoosterOrder::where('order_id', $this->id)->where('active', true)->latest()->first();
        if (!$boosterOrder) {
            return null;
        }
        return $boosterOrder->booster;
    }

    public function scopeIncomplete($query)
    {
        return $query
            ->where('status', '<>', Order::STATUS_PAYMENT_FAILED)
            ->where('status', '<>', Order::STATUS_COMPLETED)
            ->where('status', '<>', Order::STATUS_REFUNDED);
    }

    public function scopeCompleted($query)
    {
        return $query->whereIn('status', [Order::STATUS_REFUNDED, Order::STATUS_COMPLETED]);
    }

    public function isCompleted()
    {
        return $this->status === Order::STATUS_COMPLETED;
    }

    public function gameAccountDetails()
    {
        return $this->hasOne(GameAccountDetails::class);
    }

    public function champions()
    {
        return Champion::whereIn('id', function($query) {
            return $query->select('champion_id')->from('order_champions')->where('order_id', $this->id);
        })->get();
    }

    public function chatRoom()
    {
        return $this->hasOne(ChatRoom::class);
    }

    public function scopeReadyForPickup($query)
    {
        return $query->where('status', Order::STATUS_READY_FOR_PICKUP);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function getInvoiceDownloadLink($for = 'customer', $invoiceId)
    {
        return \URL::to('/panel/order/' . $this->order_id . '/invoice/' . $for . '/' . $this->order_id .'-invoice.pdf?invoice_id=' . $invoiceId);
    }

    public function calculatePrice()
    {
        return (new Rank())
            ->calculate(
                $this->gametype,
                $this->platform,
                $this->type,
                intval($this->payload['currentRank']),
                intval($this->payload['desiredRank']),
                isset($this->payload['options']) ? $this->payload['options'] : [],
                $this->payload['currentLp'],
                $this->payload['currentLPMaster'] ?? null,
                $this->payload['desiredLPMaster'] ?? null
            );
    }

    public function totalTip($inEur = false, $withFee = true)
    {
        $total = Payment::where('order_id', $this->id)->where('type', 'tip')->sum($inEur ? 'amount_EUR' : 'amount');

        if (!$total) {
            return 0;
        }

        if (! $withFee) {
            return round($total, 2);
        }

        return round(($total / 100) * 95, 2); // We take 5 percent processing fee.
    }

    public function rankName($type = 'currentRank', $short = false)
    {

        if (! isset($this->payload[$type]) && !$this->isDropped()) {
            return '';
        }

        if ($type == 'progressed_rank' && $this->isDropped()) {
            $rankSequence = BoosterOrder::where('order_id', $this->id)->whereNotNull('drop_comment')->first()->progressed_rank;
        } else {
            $rankSequence = $this->payload[$type];
        }

        $type = $this->type;
        if ($this->type === 'placement') {
            $type = 'rank';
        }

        $rank = Rank::whereType($type)->where('gametype', $this->gametype)->wherePlatform($this->platform)->whereSequence($rankSequence)->first();

        if ($rank) {
            if ($short) {
                try {
                    return explode(' ', $rank->rank)[1];
                } catch (\Exception $e) {
                    return $rank->rank;
                }
            }

            return $rank->rank;
        }

        return '';
    }

    public static function byOrderId($orderId)
    {
        return Order::whereOrderId($orderId)->first();
    }

    /**
     * It will copy order to order log
     * @return \App\OrderLog
     */
    public function copyToLog()
    {
        return OrderLog::create($this->toArray());
    }

    /**
     * It will move order to log and delete this order
     * @return \App\OrderLog
     */
    public function moveToLog()
    {
        $log = $this->copyToLog();
        $this->delete();

        return $log;
    }

    /**
     * It will allow you to call method name from query to get only allowed game for allowed booster games
     * @param  Builder $query
     * @return Builder
     */
    public function scopeAllowedGameForBooster($query)
    {
        if (! BoosterGameRestriction::where('user_id', auth()->id())->exists()) {
            return $query;
        }

        return $query->whereIn('gametype', BoosterGameRestriction::select('game')->where('user_id', auth()->id())->get());
    }

    /**
     * It will return true or false if the user is or not assigned to order in question
     * @param $userId
     * @return mixed
     */
    public function isThisAssignedBooster($userId)
    {
        return BoosterOrder::where('order_id', $this->id)->where('booster_id', $userId)->exists();
    }

    /**
     * It will return formatted version of game type name
     * @return string|void
     */
    public function getGameType()
    {
        switch ($this->gametype) {
            case 'lol':
                return 'League of Legends';
            case 'csgo':
                return 'CS:GO';
            case 'valorant':
                return 'Valorant';
        }
    }

    public function getRegionName()
    {
        switch(strtolower($this->region)) {
            case 'rus':
                return 'Russia';
            case 'bra':
                return 'Brazil';
            case 'lan':
                return 'Latin America North';
            case 'las':
                return 'Latin America South';
            case 'tur':
                return 'Turkey';
            case 'eune':
                return 'EU Nordic & East';
            case 'eu':
                return 'Europe';
            case 'euw':
                return 'West Europe';
            case 'eue':
                return 'East Europe';
            case 'eun':
                return 'North Europe';
            case 'na':
                return 'North America';
            case 'sea':
                return 'South East Asia';
            case 'jp':
                return 'Japan';
            case 'tw':
                return 'Taiwan';
            case 'us':
                return 'USA';
            case 'oce':
                return 'Oceania';
            default:
                return $this->region ?? 'Planet Earth';
        }
    }

    public function isPayoutCreated()
    {
        return BoosterPayoutOrder::whereOrderId($this->id)->exists();
    }

    public function isDropped()
    {
        $booster = BoosterOrder::where('order_id', $this->id)->whereNotNull('drop_comment')->latest()->first();
        if (! $booster) {
            return false;
        }
        return $booster->drop_comment || $booster->progressed_rank;
    }

    public function droppedComment()
    {
        $booster = BoosterOrder::where('order_id', $this->id)->whereNotNull('drop_comment')->latest()->first();

        return $booster ? $booster->drop_comment : '';
    }

    public function getProgressedRank()
    {
        $booster = BoosterOrder::where('order_id', $this->id)->whereNotNull('drop_comment')->latest()->first();

        return $booster ? $booster->progressed_rank : '';
    }

    public function getProgressedCurrentLp()
    {
        $booster = BoosterOrder::where('order_id', $this->id)->whereNotNull('drop_comment')->latest()->first();

        return $booster ? $booster->current_lp : '';
    }

    public function isDuo()
    {
        return isset($this->payload['options']) && in_array('duoq', $this->payload['options']);
    }

    public function isEUR()
    {
        return strtoupper($this->currency) === 'EUR';
    }

    /**
     * Get all booster's orders
     * @param $query
     * @param $boosterId
     * @return mixed
     */
    public function scopeBoosterOrders($query, $boosterId)
    {
        return $query->whereIn('id', function($q) use ($boosterId) {
            return $q->select('order_id')->from('booster_orders')->where('booster_id', $boosterId);
        });
    }

    /**
     * It will exclude all completed orders for which payout has been created.
     * @param $query
     * @param $boosterId
     * @return mixed
     */
    public function scopeOrdersNotYetPaid($query, $boosterId)
    {
        return $query->whereNotIn('id', function($q) use ($boosterId) {
            return $q->select('order_id')->from('booster_payout_orders')->whereIn('booster_payout_id', function ($clause) use ($boosterId) {
                return $clause->select('id')->from('booster_payouts')->where('booster_id', $boosterId);
            });
        });
    }

    public function isOrderDropper($boosterId)
    {
        if (! $this->isDropped()) {
            return false;
        }

        return BoosterOrder::where('order_id', $this->id)->where('booster_id', $boosterId)->whereNotNull('drop_comment')->exists();
    }
}
