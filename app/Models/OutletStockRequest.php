<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OutletStockRequest extends Model
{
    protected $fillable = [
        'outlet_id',
        'empty_cylinders',
        'filled_cylinders',
        'requested_cylinders',
        'status',
    ];

    public function outlet(): BelongsTo
    {
        return $this->belongsTo(Outlet::class);
    }
}
