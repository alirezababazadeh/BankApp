<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class UserAccount extends Model
{
    use HasFactory;
    protected $table = 'user_accounts';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class, 'user_account_id', 'id');
    }
}
