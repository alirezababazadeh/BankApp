<?php

namespace App\Repository;

interface UserRepositoryInterface
{
    public function findById(int $id);
    public function findTopUsers(int $userLimit, int $transactionsLimit, int $minutes);
}
