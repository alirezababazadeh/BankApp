<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\User;
use App\Models\UserAccount;
use App\Traits\CardUtil;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends Factory<Card>
 */
class CardFactory extends Factory
{
    use CardUtil;

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Model>
     */
    protected $model = Card::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userAccount = UserAccount::factory()->create();
        return [
            'user_id' => $userAccount->user_id,
            'user_account_id' => $userAccount->id,
            'card_number' => $this->validFakeCard(),
        ];
    }

    private function validFakeCard(): string
    {
        $firstPart = $this->faker->numberBetween(4,6);
        $secondPart = $this->faker->numerify("##############");
        $sum = $this->calculateCardNumbersSum($firstPart . $secondPart);
        return $firstPart . $secondPart . $this->findControlNumber($sum);
    }

    private function findControlNumber(int $sum): int
    {
        if ($sum % 10 == 0) {
            return 0;
        }
        return 10 - ($sum % 10);
    }
}
