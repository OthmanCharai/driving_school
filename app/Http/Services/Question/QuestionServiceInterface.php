<?php

namespace App\Http\Services\Question;

use App\Http\Resources\QuestionCollection;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface QuestionServiceInterface
{

    /**
     * @param Request $request
     * @return QuestionResource
     */
    public function store(Request $request):QuestionResource;


    /**
     * @param Request $request
     * @return QuestionResource
     */
    public function update(Request $request,Question $question):QuestionResource;

    /**
     * @return QuestionResource
     * Index
     */
    public function index(Request $request):QuestionCollection;

    /**
     * @param Question $question
     * @return QuestionResource
     */
    public function show(Question $question):QuestionResource;

    /**
     * @param Question $question
     * @return JsonResponse
     */
    public function destroy(Question $question):JsonResponse;

}
