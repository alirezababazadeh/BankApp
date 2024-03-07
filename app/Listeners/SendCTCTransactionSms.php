<?php

namespace App\Listeners;

use App\Events\CTCTransaction;
use App\Notification\Sms\SmsPartyInterface;
use App\Repository\UserRepositoryInterface;
use App\Traits\Properties;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCTCTransactionSms implements ShouldQueue, ShouldHandleEventsAfterCommit
{
    use Properties;

    private SmsPartyInterface $smsParty;

    /**
     * The name of the queue the job should be sent to.
     *
     */
    public ?string $queue = 'queue:ctc:transactions:sms';

    /**
     * The number of times the queued listener may be attempted.
     *
     */
    public int $tries = 5;
    /**
     * Create the event listener.
     */
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        SmsPartyInterface                        $smsParty)
    {
        $this->smsParty = $smsParty;
    }

    /**
     * Handle the event.
     */
    public function handle(CTCTransaction $event): void
    {
        $senderPhone = $this->userRepository->findById($event->getSender())->phone_number;
        $receiverPhone = $this->userRepository->findById($event->getReceiver())->phone_number;

        $this->smsParty->sendTo(
            $senderPhone,
            __(
                'notification.sms.ctc_transaction.sender',
                ['amount' => $event->getTransactionAmount() + $this->WAGE]
            )
        );

        $this->smsParty->sendTo(
            $receiverPhone,
            __(
                'notification.sms.ctc_transaction.receiver',
                ['amount' => $event->getTransactionAmount()]
            )
        );
    }
}
