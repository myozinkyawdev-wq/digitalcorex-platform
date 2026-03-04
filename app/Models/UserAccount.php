<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAccount extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'account_platform_id',
        'account_id',
        'name',
        'username',
        'photo_url',
        'account_url',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function accountPlatform(): BelongsTo
    {
        return $this->belongsTo(AccountPlatform::class);
    }

    public function getUserId(): string
    {
        return $this->user_id;
    }
    
    public function getAccountPlatformId(): string
    {
        return $this->account_platform_id;
    }

    public function getAccountId(): string
    {
        return $this->account_id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPhotoUrl(): string
    {
        return $this->photo_url;
    }

    public function getAccountUrl(): string
    {
        return $this->account_url;
    }
}
