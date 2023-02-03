<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubExamStoreRequest;
use App\Http\Requests\SubExamUpdateRequest;
use App\Http\Resources\SubExamCollection;
use App\Http\Resources\SubExamResource;
use App\Models\SubExam;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubExamController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * @param Request $request
     * @return SubExamCollection
     */
    public function index(Request $request): SubExamCollection
    {
        $subExams = SubExam::with(["questions",'exam'])->get();



        return new SubExamCollection($subExams);
    }

    /**
     * @param SubExamStoreRequest $request
     * @return SubExamResource
     */
    public function store(SubExamStoreRequest $request): SubExamResource
    {
        $subExam = SubExam::create($request->validated());

        return new SubExamResource($subExam);
    }

    /**
     * @param Request $request
     * @param SubExam $subExam
     * @return SubExamResource
     */
    public function show(Request $request, SubExam $subExam): SubExamResource
    {
        return new SubExamResource($subExam);
    }

    /**
     * @param SubExamUpdateRequest $request
     * @param SubExam $subExam
     * @return SubExamResource
     */
    public function update(SubExamUpdateRequest $request, SubExam $subExam): SubExamResource
    {
        $subExam->update($request->validated());

        return new SubExamResource($subExam);
    }

    /**
     * @param Request $request
     * @param SubExam $subExam
     * @return JsonResponse
     */
    public function destroy(Request $request, SubExam $subExam): JsonResponse
    {
        $subExam->delete();

        return response()->json('sub exam deleted with success',200)->setStatusCode(200);
    }
}
