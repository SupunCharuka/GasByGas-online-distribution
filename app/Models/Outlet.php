<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Outlet extends Model
{
    protected $fillable = [
        'name',
        'district',
        'address',
        'contact_number',
        'stock',
    ];
    
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
