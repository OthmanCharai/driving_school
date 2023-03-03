<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamStoreRequest;
use App\Http\Requests\ExamUpdateRequest;
use App\Http\Resources\ExamCollection;
use App\Http\Resources\ExamResource;
use App\Models\Exam;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
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

        $file=$request->file('image');
        $path=Storage::disk('public')->putFile('exams',$file);
        $exam = Exam::create([
            'name'=>$request->name,
            "is_free"=>$request->is_free,
            "image"=>$path
        ]);
        return new ExamResource($exam);
    }

    /**
     * @param Request $request
     * @param Exam $exam
     * @return ExamResource
     */
    public function show(Request $request, Exam $exam): ExamResource
    {
        $exam->image=Storage::disk('public')->url(
            $exam->image
        );
        $exam->load(['subExam.questions.options','subExam.questions.dropzons']);

        return new ExamResource($exam);
    }

    /**
     * @param ExamUpdateRequest $request
     * @param Exam $exam
     * @return ExamResource
     */
    public function update(ExamUpdateRequest $request, Exam $exam): ExamResource
    {

        $file = $request->file("image");

        $path=Storage::disk('public')->putFile('exams', $file);

        Storage::disk('public')->delete($exam->image);

        $exam->update(array_merge($request->validated(),['image'=>$path]));

        return new ExamResource($exam);
    }

    /**
     * @param Request $request
     * @param Exam $exam
     * @return JsonResponse
     */
    public function destroy(Request $request, Exam $exam): JsonResponse
    {
        $exam->delete();
        return response()->json('exam deleted with success','200',)->setStatusCode(200);
    }
}
