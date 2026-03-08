<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembershipFeeSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fees = [
            ['name' => 'General', 'fee' => 500],
            ['name' => 'Life', 'fee' => 10000],
            ['name' => 'Associate', 'fee' => 1000],
        ];

        foreach ($fees as $fee) {
            \App\Models\MembershipFeeSetting::updateOrCreate(['name' => $fee['name']], ['fee' => $fee['fee']]);
        }
    }
}
