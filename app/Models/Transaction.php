<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';

    public function sender(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'sender_card', 'card_number');
    }

    public $timestamps = false;
}
