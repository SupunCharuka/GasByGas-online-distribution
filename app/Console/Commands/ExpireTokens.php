<?php

namespace App\Console\Commands;

use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpireTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tokens:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire tokens that have passed their valid period';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $expirationTime = Carbon::now()->subWeek(2); 

        $expiredTokens = Token::where('status', 'active')
            ->where('token_issued_at', '<', $expirationTime)
            ->update(['status' => 'expired']);

        $this->info("Expired $expiredTokens tokens.");
    }
}
