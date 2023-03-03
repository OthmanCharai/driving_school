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
         $this->call([
             DropzonSeeder::class,

             ExamDropzonesSeeder::class,

         ]);







    }
}
