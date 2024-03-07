<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    public function fetchTopUsersWithTransactions(UserRepositoryInterface $userRepository): JsonResponse
    {
        $collections = $userRepository->findTopUsers(3, 10, 480);
        return response()->json($collections);
    }
}
