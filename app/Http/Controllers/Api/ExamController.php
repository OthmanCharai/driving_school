<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamStoreRequest;
use App\Http\Requests\ExamUpdateRequest;
use App\Http\Resources\ExamCollection;
use App\Http\Resources\ExamResource;
use App\Models\Exam;
use App\Models\Question;
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

        $perPage = $request->input('perPage', 10); // number of items per page, default 10
        $currentPage = $request->input('page', 1); // current page number, default 1
        $searchTerm = $request->input('q', ''); // search term, default empty string
        $query = Exam::with('users');

        if ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        $exams = $query->paginate($perPage, ['*'], 'page', $currentPage);

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
        $exam->update($request->validated());

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
