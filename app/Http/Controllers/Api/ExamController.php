<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamStoreRequest;
use App\Http\Requests\ExamUpdateRequest;
use App\Http\Resources\ExamCollection;
use App\Http\Resources\ExamResource;
use App\Http\Services\Minio\MinioService;
use App\Http\Services\Minio\MinioServiceInterface;
use App\Models\Exam;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ExamController extends Controller
{
    public function __construct(public MinioServiceInterface $minioService)
    {
    }

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
    public function store(ExamStoreRequest $request)
    {

        $data=$this->minioService->storeFile($request,'exam');

        $exam = Exam::create([
            'name'=>$request->name,
            "is_free"=>$request->is_free,
            "image"=>$data['path']
        ]);
        $exam->image=$data['url'];
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
        $data=$this->minioService->getFile($exam->image);
        $exam->image=$data['url'];

        return new ExamResource($exam);
    }

    /**
     * @param ExamUpdateRequest $request
     * @param Exam $exam
     * @return ExamResource
     */
    public function update(ExamUpdateRequest $request, Exam $exam): ExamResource
    {
        $info=$request->validated();
        if($request->hasFile('image')){
            $data=$this->minioService->updateFile($request,$exam->image,'exams');
           $info=array_merge($info,['image'=>$data['path']]);
        }

        $exam->update($info);
        $exam->image=($data['url'])?$data['url']:$exam->image;
        return new ExamResource($exam);
    }

    /**
     * @param Request $request
     * @param Exam $exam
     * @return JsonResponse
     */
    public function destroy(Request $request, Exam $exam): JsonResponse
    {
        $this->minioService->deleteFile($exam->image);
        $exam->delete();
        return response()->json('exam deleted with success','200',)->setStatusCode(200);
    }
}
