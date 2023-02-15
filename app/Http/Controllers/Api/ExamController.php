<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamStoreRequest;
use App\Http\Requests\ExamUpdateRequest;
use App\Http\Resources\ExamCollection;
use App\Http\Resources\ExamResource;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class ExamController extends Controller
{


    /**
     * @param Request $request
     * @return ExamCollection
     */
    public function index(Request $request): ExamCollection
    {
        $exams = Exam::with('users')->get();

        return new ExamCollection($exams);
    }

    /**
     * @param ExamStoreRequest $request
     * @return ExamResource
     */
    public function store(ExamStoreRequest $request): ExamResource
    {
        $exam = Exam::create($request->validated());

        return new ExamResource($exam);
    }

    /**
     * @param Request $request
     * @param Exam $exam
     * @return ExamResource
     */
    public function show(Request $request, Exam $exam): ExamResource
    {
        $exam->load('sub_exams');
        return new ExamResource($exam);
    }

    /**
     * @param ExamUpdateRequest $request
     * @param Exam $exam
     * @return ExamResource
     */
    public function update(ExamUpdateRequest $request, Exam $exam): ExamResource
    {
        $exam->update($request->validated());

        return new ExamResource($exam);
    }

    /**
     * @param Request $request
     * @param Exam $exam
     * @return Response
     */
    public function destroy(Request $request, Exam $exam): Response
    {

        $exam->delete();

        return response()->json('exam deleted with success','200',)->setStatusCode(200);
    }
}
