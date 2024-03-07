<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wage extends Model
{
    use HasFactory;
    protected $table = 'wages';

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class,'transaction_id', 'id');
    }
}
