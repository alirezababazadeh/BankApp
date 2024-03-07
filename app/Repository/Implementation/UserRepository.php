<?php

namespace App\Repository\Implementation;

use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function findById(int $id)
    {
        return User::query()->find($id)->first();
    }

    public function findTopUsers(int $userLimit, int $transactionsLimit, int $minutes): Collection|array
    {
        $tenMinutesAgo = Carbon::now()->subMinutes($minutes);

        $users = User::query()
            ->select(['users.id', 'users.name'])
            ->join('cards', 'users.id', '=', 'cards.user_id')
            ->join('transactions', 'cards.card_number', '=', 'transactions.sender_card')
            ->where('transactions.created_at', '>=', $tenMinutesAgo)
            ->groupBy('users.id')
            ->orderByDesc(DB::raw('COUNT(transactions.id)'))
            ->limit($userLimit)
            ->get();

        foreach ($users as $user) {
            $user->load(['transactions' => function ($query) {
                $query
                    ->latest()
                    ->limit(10);
            }]);
        }

        return $users;
    }
}
