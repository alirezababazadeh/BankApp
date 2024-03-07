<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class SameCards implements DataAwareRule, ValidationRule
{
    private array $inputs;

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value == $this->inputs['sender_card']) {
            $fail(__('validation.ctc.same_card', ['attribute' => $attribute, 'other' => 'sender_card']));
        }
    }

    public function setData(array $data): void
    {
        $this->inputs = $data;
    }
}
