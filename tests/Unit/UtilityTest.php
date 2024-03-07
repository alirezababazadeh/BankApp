<?php

namespace Tests\Unit;

use App\Traits\CardUtil;
use PHPUnit\Framework\TestCase;

class UtilityTest extends TestCase
{
    use CardUtil;

    public function test_valid_card_number(): void
    {
        $this->assertTrue($this->isCardNumberValid("6628941537361952"));
    }

    public function test_invalid_card_number(): void
    {
        $this->assertFalse($this->isCardNumberValid("6628943537361952"));
    }
}
