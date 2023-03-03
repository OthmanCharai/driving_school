<?php

namespace Database\Seeders;

use App\Models\Dropzon;
use App\Models\Exam;
use App\Models\Option;
use App\Models\Question;
use App\Models\SubExam;
use Illuminate\Database\Seeder;

class DropzonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $exams=Exam::factory()
            ->has(SubExam::factory()
                ->has(Question::factory()
                    ->count(10)
                    ->has(Option::factory()
                        ->count(4)
                       )
                    )
                ->count(4)
                )
            ->count(1)
            ->create();
        $questions=Question::with('options')->get();

        foreach ($questions as $question){
            foreach ($question->options as $option){

                Dropzon::factory(['question_id'=>$question->id,'option_id'=>$option->id])->create();
            }
        }

    }
}
