<?php

namespace App\Http\Requests;

use App\Repository\CardRepositoryInterface;
use App\Rules\InputAmountBoundary;
use App\Rules\SameCards;
use App\Rules\SufficientSenderBalance;
use App\Rules\ValidCardNumber;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class CardToCardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'sender_card' => [
                'bail',
                'required',
                'numeric',
                'digits:16',
                new ValidCardNumber(),
                'exists:cards,card_number',
                new SufficientSenderBalance(app(CardRepositoryInterface::class))
            ],
            'receiver_card' => [
                'bail',
                'required',
                'numeric',
                'digits:16',
                new ValidCardNumber(),
                'exists:cards,card_number',
                new SameCards()
            ],
            'amount' => [
                'bail',
                'required',
                'numeric',
                new InputAmountBoundary()
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            'sender_card' => 'Sender Card Number',
            'receiver_card' => 'Receiver Card Number'
        ];
    }
}
