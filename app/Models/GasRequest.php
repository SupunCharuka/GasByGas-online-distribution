<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GasRequest extends Model
{
    protected $fillable = [
        'user_id',
        'outlet_id',
        'quantity',
        'status',
        'token',
        'expected_pickup_date',
    ];

  
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function outlet(): BelongsTo
    {
        return $this->belongsTo(Outlet::class);
    }
}
