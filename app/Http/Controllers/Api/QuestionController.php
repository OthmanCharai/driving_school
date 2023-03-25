<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionStoreRequest;
use App\Http\Requests\QuestionUpdateRequest;
use App\Http\Resources\QuestionCollection;
use App\Http\Resources\QuestionResource;
use App\Http\Services\Minio\MinioServiceInterface;
use App\Http\Services\Question\QuestionServiceInterface;
use App\Models\Dropzon;
use App\Models\Image;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{


    public function __construct(public QuestionServiceInterface $questionService)
    {

    }

    /**
     * @param Request $request
     * @return QuestionCollection
     */
    public function index(Request $request): QuestionCollection
    {
        return $this->questionService->index($request);

    }


    /**
     * @param QuestionStoreRequest $request
     * @return QuestionResource
     */
    public function store(QuestionStoreRequest $request): QuestionResource
    {
        return $this->questionService->store($request);

    }

    /**
     * @param Request $request
     * @param Question $question
     * @return QuestionResource
     */
    public function show(Question $question): QuestionResource
    {
        return $this->questionService->show($question);
    }

    /**
     * @param QuestionUpdateRequest $request
     * @param Question $question
     * @return QuestionResource
     */
    public function update(QuestionUpdateRequest $request, Question $question): QuestionResource
    {
        return $this->questionService->update($request,$question);
    }

    /**
     * @param Request $request
     * @param Question $question
     * @return JsonResponse
     */
    public function destroy(Question $question): JsonResponse
    {
        return $this->questionService->destroy($question);
    }




}
