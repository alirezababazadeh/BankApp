<?php

namespace App\Notification\Sms;

use Exception;
use Kavenegar\KavenegarApi;

class KavenegarParty implements SmsPartyInterface
{
    private string $apiKey;
    private string $sender;

    public function __construct()
    {
        $this->apiKey = config('app.api_key.sms.kavenegar');
        $this->sender = config('app.sender.sms');
    }

    public function sendTo(string $phoneNumber, string $message): void
    {
        $knPhoneNumber = '+' . $phoneNumber;
        $api = new KavenegarApi($this->apiKey);
        try {
            $api->Send($this->sender, $knPhoneNumber, $message);
        } catch (Exception $exception) {
            print_r($exception->getMessage());
        }
    }
}
