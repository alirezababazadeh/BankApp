<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransferMoneyValidationTest extends TestCase
{
    public function test_ctc_invalid_sender_card(): void
    {
        $response = $this->post(
            '/api/v1/card-to-card',
            [
                "receiver_card" => "6037997368491990",
                "sender_card" => "5274121192627677",
                "amount" => "500000"
            ]
        );
        $response->assertStatus(422);
    }

    public function test_ctc_invalid_receiver_card(): void
    {
        $response = $this->post(
            '/api/v1/card-to-card',
            [
                "receiver_card" => "5037997368491990",
                "sender_card" => "6274121192627677",
                "amount" => "500000"
            ]
        );
        $response->assertStatus(422);
    }

    public function test_ctc_invalid_amount(): void
    {
        $response = $this->post(
            '/api/v1/card-to-card',
            [
                "receiver_card" => "6037997368491990",
                "sender_card" => "5274121192627677",
                "amount" => "500"
            ]
        );
        $response->assertStatus(422);
    }

    public function test_ctc_invalid_type(): void
    {
        $response = $this->post(
            '/api/v1/card-to-card',
            [
                "receiver_card" => "603799736849tt90",
                "sender_card" => "527412119262ww77",
                "amount" => "5009u"
            ]
        );
        $response->assertStatus(422);
    }

    public function test_ctc_invalid_card_length(): void
    {
        $response = $this->post(
            '/api/v1/card-to-card',
            [
                "receiver_card" => "60379973684990",
                "sender_card" => "52741211926277",
                "amount" => "5000"
            ]
        );
        $response->assertStatus(422);
    }
}
