<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class InputAmountBoundary implements ValidationRule
{
    private int $MIN = 1000;
    private int $MAX = 50000000;

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value < $this->MIN || $value > $this->MAX) {
            $fail(__(
                    'validation.ctc.amount_boundary',
                    ['attribute' => $attribute, 'min' => $this->MIN, 'max' => $this->MAX]
                )
            );
        }
    }
}
