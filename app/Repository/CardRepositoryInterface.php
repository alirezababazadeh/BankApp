<?php

namespace App\Repository;

use App\Models\Card;
use Illuminate\Database\Eloquent\Model;

interface CardRepositoryInterface
{
    public function findByCardNumber(string $cardNumber);
}
