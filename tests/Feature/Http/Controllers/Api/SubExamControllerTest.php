<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Exam;
use App\Models\SubExam;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\SubExamController
 */
class SubExamControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $subExams = SubExam::factory()->count(3)->create();

        $response = $this->get(route('sub-exam.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\SubExamController::class,
            'store',
            \App\Http\Requests\SubExamStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $name = $this->faker->name;
        $exam = Exam::factory()->create();

        $response = $this->post(route('sub-exam.store'), [
            'name' => $name,
            'exam_id' => $exam->id,
        ]);

        $subExams = SubExam::query()
            ->where('name', $name)
            ->where('exam_id', $exam->id)
            ->get();
        $this->assertCount(1, $subExams);
        $subExam = $subExams->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $subExam = SubExam::factory()->create();

        $response = $this->get(route('sub-exam.show', $subExam));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\SubExamController::class,
            'update',
            \App\Http\Requests\SubExamUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $subExam = SubExam::factory()->create();
        $name = $this->faker->name;
        $exam = Exam::factory()->create();

        $response = $this->put(route('sub-exam.update', $subExam), [
            'name' => $name,
            'exam_id' => $exam->id,
        ]);

        $subExam->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $subExam->name);
        $this->assertEquals($exam->id, $subExam->exam_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $subExam = SubExam::factory()->create();

        $response = $this->delete(route('sub-exam.destroy', $subExam));

        $response->assertNoContent();

        $this->assertModelMissing($subExam);
    }
}
