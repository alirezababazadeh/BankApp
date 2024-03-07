<?php

namespace App\Logic;

use App\Events\CTCTransaction;
use App\Models\Card;
use App\Models\Transaction;
use App\Models\Wage;
use App\Repository\CardRepositoryInterface;
use App\Traits\Properties;
use Exception;
use Illuminate\Support\Facades\DB;

class CTCTransferLogic
{
    use Properties;

    private string $senderCard;
    private string $receiverCard;
    private int $amount;

    public function __construct(
        private readonly CardRepositoryInterface $cardRepository,
        string                                   $senderCard,
        string                                   $receiverCard,
        int                                      $amount)
    {
        $this->senderCard = $senderCard;
        $this->receiverCard = $receiverCard;
        $this->amount = $amount;
    }

    /**
     * @throws Exception
     */
    public function transfer(): void
    {
        DB::beginTransaction();
        try {
            $senderCard = $this->cardRepository->findByCardNumber($this->senderCard);
            $senderAccount = $senderCard->userAccount;

            $receiverCard = $this->cardRepository->findByCardNumber($this->receiverCard);
            $receiverAccount = $receiverCard->userAccount;

            $senderAccount->balance -= $this->amount;
            $senderAccount->balance -= $this->WAGE;
            $senderAccount->save();

            $receiverAccount->balance += $this->amount;
            $receiverAccount->save();

            $transaction = new Transaction();
            $transaction->sender_card = $this->senderCard;
            $transaction->receiver_card = $this->receiverCard;
            $transaction->amount = $this->amount;
            $transaction->created_at = now();
            $transaction->save();

            $wage = new Wage();
            $wage->transaction_id = $transaction->id;
            $wage->wage_amount = $this->WAGE;
            $wage->save();
            DB::commit();
            CTCTransaction::dispatch($senderCard->user_id, $receiverCard->user_id, $transaction->amount);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
