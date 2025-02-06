<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GasRequest extends Model
{
    protected $fillable = [
        'user_id',
        'outlet_id',
        'quantity',
        'status',
        'expected_pickup_date',
    ];

    protected $casts = [
        'expected_pickup_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function outlet(): BelongsTo
    {
        return $this->belongsTo(Outlet::class);
    }

    public function token(): HasOne
    {
        return $this->hasOne(Token::class, 'gas_request_id');
    }
}
