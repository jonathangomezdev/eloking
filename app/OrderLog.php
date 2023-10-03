<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    protected $fillable = [
        'order_id', 'gametype', 'booster_earning_EUR', 'platform',
        'type', 'region', 'total_EUR', 'total_refunded_EUR', 'total',
        'currency', 'payload', 'user_id', 'comments',
    ];

    protected $casts = [
        'payload' => 'array',
        'comments' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function booster()
    {
        return null;
    }

    public function totalTip()
    {
        return 0;
    }

    public function champions()
    {
        return Champion::whereIn('id', function($query) {
            return $query->select('champion_id')->from('order_champions')->where('order_id', $this->id);
        })->get();
    }

    public function rankName($type = 'currentRank', $short = false)
    {
        if (!$this->payload[$type]) {
            return '';
        }

        $rankSequence = $this->payload[$type];

        $rank = Rank::whereType($this->type)->where('gametype', $this->gametype)->wherePlatform($this->platform)->whereSequence($rankSequence)->first();

        if ($rank) {
            if ($short) {
                return explode(' ', $rank->rank)[1];
            }

            return $rank->rank;
        }

        return '';
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

    public function isDropped()
    {
        return false;
    }
}
