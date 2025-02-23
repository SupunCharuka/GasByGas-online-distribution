<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Outlet extends Model
{
    protected $fillable = [
        'name',
        'district_id',
        'address',
        'contact_number',
        'stock',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function stockRequests(): HasMany
    {
        return $this->hasMany(OutletStockRequest::class);
    }

    public function getTotalEmptyCylindersAttribute()
    {
        return $this->stockRequests()->sum('empty_cylinders');
    }
}
