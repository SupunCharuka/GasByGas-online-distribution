<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Token extends Model
{
    protected $fillable = [
        'user_id',
        'gas_request_id',
        'token_number',
        'token_issued_at',
        'status',
    ];
    
    protected $casts = [
        'token_issued_at' => 'datetime',
    ];
    

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function gasRequest(): BelongsTo
    {
        return $this->belongsTo(GasRequest::class, 'gas_request_id');
    }

    public function expireTokens()
    {
        $tokens = Token::where('status', 'active')
            ->where('token_issued_at', '<', now()->subDays(2)) 
            ->get();

        foreach ($tokens as $token) {
            $token->update(['status' => 'expired']);
        }
    }
}
