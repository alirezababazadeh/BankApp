<?php

namespace App\Notification\Sms;

interface SmsPartyInterface
{
    public function sendTo(string $phoneNumber, string $message);
}
