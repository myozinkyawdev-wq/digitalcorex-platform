<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasTelegramAccount
{
    protected function telegramProfile(): Attribute
    {
        return Attribute::make(
            get: fn () => [
                'id' => $this->telegram_id,
                'username' => $this->telegram_username,
                'photo' => $this->telegram_photo_url,
            ]
        );
    }

    /**
     * Get the user's telegram identification.
     */
    public function getTelegramId(): ?string
    {
        return $this->telegram_id;
    }

    public function getTelegramUsername(): ?string
    {
        return $this->telegram_username;
    }

    public function getTelegramPhotoUrl(): ?string
    {
        return $this->telegram_photo_url;
    }
}