<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = ['user_id', 'business_name', 'business_registration_number', 'certificate_file', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
