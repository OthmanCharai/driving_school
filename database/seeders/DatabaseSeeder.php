<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Dropzon;
use App\Models\Exam;
use App\Models\Option;
use App\Models\Question;
use App\Models\SubExam;
use App\Models\User;
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
        // make options
         User::factory(10)->create();
         Exam::factory()
             ->has(SubExam::factory()
                 ->has(Question::factory()
                     ->has(Option::factory()->count(4))
                     ->count(2))
                 ->count(2))
             ->create();

         // make dropzons
        Exam::factory()
            ->has(SubExam::factory()
                ->has(Question::factory()
                    ->has(Option::factory()
                        ->has(Dropzon::factory(['question_id'=>Question::latest()->first()->pluck('id')[0]]))
                        ->count(1))
                    ->count(1))
                ->count(2))
            ->create();
        // has both
        Exam::factory()
            ->has(SubExam::factory()
                ->has(Question::factory()
                    ->has(Option::factory()
                        ->has(Dropzon::factory(['question_id'=>Question::query()->latest()->first()->pluck('id')[0]]))
                        ->count(1))
                    ->count(1))
                ->count(2))
            ->create();



    }
}
