<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Exam;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ExamController
 */
class ExamControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $exams = Exam::factory()->count(3)->create();

        $response = $this->get(route('exam.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ExamController::class,
            'store',
            \App\Http\Requests\ExamStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $name = $this->faker->name;

        $response = $this->post(route('exam.store'), [
            'name' => $name,
        ]);

        $exams = Exam::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $exams);
        $exam = $exams->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $exam = Exam::factory()->create();

        $response = $this->get(route('exam.show', $exam));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ExamController::class,
            'update',
            \App\Http\Requests\ExamUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $exam = Exam::factory()->create();
        $name = $this->faker->name;

        $response = $this->put(route('exam.update', $exam), [
            'name' => $name,
        ]);

        $exam->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $exam->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $exam = Exam::factory()->create();

        $response = $this->delete(route('exam.destroy', $exam));

        $response->assertNoContent();

        $this->assertModelMissing($exam);
    }
}
