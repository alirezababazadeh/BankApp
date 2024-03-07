<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardToCardRequest;
use App\Logic\CTCTransferLogic;
use App\Models\Transaction;
use App\Repository\CardRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class MoneyTransferController extends Controller
{
    public function transferByCTC(CardRepositoryInterface $cardRepository, CardToCardRequest $request): JsonResponse
    {
        $validateData = $request->validated();
        try {
            (new CTCTransferLogic(
                $cardRepository,
                $validateData['sender_card'],
                $validateData['receiver_card'],
                $validateData['amount']
            ))->transfer();
            return response()->json(
                ['message' => 'Success'],
                Response::HTTP_CREATED
            );
        } catch (\Exception $exception) {
            return response()->json(
                ['message' => $exception->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
