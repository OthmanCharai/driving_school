<?php

namespace Database\Seeders;

use App\Models\Dropzon;
use App\Models\Exam;
use App\Models\Option;
use App\Models\Question;
use App\Models\SubExam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamDropzonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // has both
        Exam::factory()
            ->has(SubExam::factory()
                ->has(Question::factory()
                    ->has(Option::factory()
                        ->count(4)
                        )
                    ->count(4)
                   )
                ->count(4)
                )
        ->count(4)->create();

    }
}
