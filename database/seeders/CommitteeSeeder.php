<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Committee;

class CommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $committees = [
            ['position_order' => 1, 'name' => 'Mr. Md. Sahabuddin Ahmed', 'position' => 'President'],
            ['position_order' => 2, 'name' => 'Mr. Nazrul Islam Bhuiyan', 'position' => 'Senior Vice-President'],
            ['position_order' => 3, 'name' => 'Mr. Kabir Ahmed Bhuiyan', 'position' => 'Vice-President'],
            ['position_order' => 4, 'name' => 'Mr. Md. Jannat Hossain', 'position' => 'Vice-President'],
            ['position_order' => 5, 'name' => 'Mr. Sakhawat Hossain', 'position' => 'Vice-President'],
            ['position_order' => 6, 'name' => 'Mr. Md. Abul Kalam Azad', 'position' => 'General Secretary'],
            ['position_order' => 7, 'name' => 'Mr. Elias Kamal', 'position' => 'Joint General Secretary'],
            ['position_order' => 8, 'name' => 'Mr. H. M. Kawser Ahmed', 'position' => 'Organizing Secretary'],
            ['position_order' => 9, 'name' => 'Mr. Saddam Islam', 'position' => 'Organizing Secretary'],
            ['position_order' => 10, 'name' => 'Mr. Md. Shafinur Islam', 'position' => 'Publicity, Publication & Office Secretary'],
            ['position_order' => 11, 'name' => 'Mr. Md. Abu Jafar Nahid', 'position' => 'Finance Secretary'],
            ['position_order' => 12, 'name' => 'Mr. Md. Sazzad Hossain', 'position' => 'Assistant Finance Secretary'],
            ['position_order' => 13, 'name' => 'Mr. Md. Raqibul Islam', 'position' => 'Social Welfare Secretary'],
            ['position_order' => 14, 'name' => 'Mr. Atik Hasan', 'position' => 'Sports & Cultural Secretary'],
            ['position_order' => 15, 'name' => 'Mr. Saleh Arif', 'position' => 'International Affairs Secretary'],
            ['position_order' => 16, 'name' => 'Mr. Md. Iqbal Hossain', 'position' => 'Information & Technology Secretary'],
            ['position_order' => 17, 'name' => 'Mr. Mainuddin Majumder', 'position' => 'Executive Member'],
            ['position_order' => 18, 'name' => 'Mr. Shakil Ahmed', 'position' => 'Executive Member'],
            ['position_order' => 19, 'name' => 'Mr. Tarequr Rahman Munna', 'position' => 'Executive Member'],
            ['position_order' => 20, 'name' => 'Ms. Tasnim Akter', 'position' => 'Executive Member'],
            ['position_order' => 21, 'name' => 'Mr. Shahin Shekh', 'position' => 'Executive Member'],
        ];

        foreach ($committees as $committee) {
            Committee::updateOrCreate(
                ['name' => $committee['name']],
                $committee
            );
        }    }
}