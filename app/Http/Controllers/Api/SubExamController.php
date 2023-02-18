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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SubExamController extends Controller
{

    public function __construct()
    {
       // $this->middleware('auth:api');
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


    public function score(Request $request)
    {
        $counter=0;
        $displayed_data=[];
        foreach ($request->data as $data){

            try {
                $sub_exam=SubExam::with('questions.options')->findOrFail($data['sub_exam_id']);
                foreach ($data['response'] as $response){
                   $question= $sub_exam->questions->filter(function ($item) use ($response){
                       return $item->options->where('id',$response['option_id'])->first();
                   })->first();
                   $option=$question->options->where('id',$response['option_id'])->first();
                   $displayed_data[$sub_exam->id][]=[
                     $question->id=>($option->status)?"true":"false"
                   ];

                    if($option->status)
                        $counter++;

                }

            }catch (NotFoundHttpException $e){
                return \response()->json($e->getMessage(),404);
            }
        }
        $displayed_data['score']=$counter;
        return response()->json($displayed_data);

    }
}
