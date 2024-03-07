<?php

namespace Database\Seeders;

use App\Models\Wage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Wage::factory()
            ->count(50)
            ->create();
    }
}
