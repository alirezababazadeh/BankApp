<?php

namespace App\Rules;

use App\Models\Card;
use App\Repository\CardRepositoryInterface;
use App\Traits\Properties;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class SufficientSenderBalance implements DataAwareRule, ValidationRule
{
    use Properties;
    private array $inputs;

    public function __construct(
        private readonly CardRepositoryInterface $cardRepository
    )
    {
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $card = $this->cardRepository->findByCardNumber($value);
        if ($card->userAccount->balance < intval($this->inputs['amount']) + $this->WAGE) {
            $fail(__('validation.ctc.insufficient_balance', ['attribute' => $attribute]));
        }
    }

    public function setData(array $data): void
    {
        $this->inputs = $data;
    }
}
