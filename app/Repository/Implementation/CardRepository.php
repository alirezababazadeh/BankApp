<?php

namespace App\Repository\Implementation;

use App\Models\Card;
use App\Repository\CardRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CardRepository implements CardRepositoryInterface
{
    public function findByCardNumber(string $cardNumber): ?Model
    {
        return Card::with(['userAccount'])
            ->firstWhere('card_number', $cardNumber);
    }
}
