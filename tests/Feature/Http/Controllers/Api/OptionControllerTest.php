<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Option;
use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\OptionController
 */
class OptionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $options = Option::factory()->count(3)->create();

        $response = $this->get(route('option.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OptionController::class,
            'store',
            \App\Http\Requests\OptionStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $answer = $this->faker->text;
        $status = $this->faker->boolean;
        $question = Question::factory()->create();

        $response = $this->post(route('option.store'), [
            'answer' => $answer,
            'status' => $status,
            'question_id' => $question->id,
        ]);

        $options = Option::query()
            ->where('answer', $answer)
            ->where('status', $status)
            ->where('question_id', $question->id)
            ->get();
        $this->assertCount(1, $options);
        $option = $options->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $option = Option::factory()->create();

        $response = $this->get(route('option.show', $option));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\OptionController::class,
            'update',
            \App\Http\Requests\OptionUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $option = Option::factory()->create();
        $answer = $this->faker->text;
        $status = $this->faker->boolean;
        $question = Question::factory()->create();

        $response = $this->put(route('option.update', $option), [
            'answer' => $answer,
            'status' => $status,
            'question_id' => $question->id,
        ]);

        $option->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($answer, $option->answer);
        $this->assertEquals($status, $option->status);
        $this->assertEquals($question->id, $option->question_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $option = Option::factory()->create();

        $response = $this->delete(route('option.destroy', $option));

        $response->assertNoContent();

        $this->assertModelMissing($option);
    }
}
