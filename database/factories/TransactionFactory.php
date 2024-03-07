<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends Factory<Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Model>
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = Card::factory(2)->create();
        return [
            'sender_card' => $users[0]->card_number,
            'receiver_card' => $users[1]->card_number,
            'amount' => $this->faker->numberBetween(1000, 50000000),
            'created_at' => $this->faker->dateTime()
        ];
    }
}
