<?php

namespace App\Traits;

trait CardUtil
{
    public function isCardNumberValid(string $cardNumber): bool
    {
        if (!in_array($cardNumber[0], [4, 5, 6])) {
            return false;
        }
        $sum = $this->calculateCardNumbersSum($cardNumber);
        return $sum % 10 == 0;
    }

    public function calculateCardNumbersSum(string $cardNumber): int
    {
        $sum = 0;
        for ($i = 0; $i < strlen($cardNumber); $i++) {
            if ($i % 2 == 0) {
                $modifiedVal = intval($cardNumber[$i]) * 2;
                if ($modifiedVal > 9) {
                    $modifiedVal -= 9;
                }
                $sum += $modifiedVal;
            } else {
                $sum += intval($cardNumber[$i]);
            }
        }
        return $sum;
    }
}
