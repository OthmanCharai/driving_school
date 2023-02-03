<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Exam;
use App\Models\Option;
use App\Models\Question;
use App\Models\SubExam;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();
         Exam::factory()
             ->has(SubExam::factory()
                 ->has(Question::factory()
                     ->has(Option::factory()->count(4))
                     ->count(20))
                 ->count(10))
             ->create();


    }
}
