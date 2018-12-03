<?php

namespace App\Traits;

use App\ConfirmationToken;

trait HasConfirmationTokens
{
    public function confirmationToken()
    {
        return $this->hasOne(ConfirmationToken::class);
    }

    public function generateConfirmationToken()
    {
        $this->confirmationToken()->create([
            'token' => $token = str_random(200),
            'expires_at' => $this->getConfirmationTokenExpiry()
        ]);

        return $token;
    }

    protected function getConfirmationTokenExpiry()
    {
        return $this->freshTimestamp()->addMinutes(10);
    }
}