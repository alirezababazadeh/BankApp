<?php

namespace App\Rules;

use App\Traits\CardUtil;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class ValidCardNumber implements ValidationRule
{
    use CardUtil;

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->isCardNumberValid($value)) {
            $fail(__('validation.ctc.valid_card', ['attribute' => $attribute]));
        }
    }
}
