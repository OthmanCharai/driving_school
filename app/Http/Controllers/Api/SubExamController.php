<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubExamStoreRequest;
use App\Http\Requests\SubExamUpdateRequest;
use App\Http\Resources\SubExamCollection;
use App\Http\Resources\SubExamResource;
use App\Models\Image;
use App\Models\Score;
use App\Models\SubExam;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use function PHPUnit\Framework\isNull;

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
        $perPage = $request->input('perPage', 10); // number of items per page, default 10
        $currentPage = $request->input('page', 1); // current page number, default 1
        $searchTerm = $request->input('q', ''); // search term, default empty string
        $query = SubExam::with([]);

        if ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        $exams = $query->paginate($perPage, ['*'], 'page', $currentPage);

        return new SubExamCollection($exams);
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


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function score(Request $request)
    {
        $counter=0;
        $subExamScore= 0;
        $displayed_data=[];
        $passedExam = true;

        foreach ($request->data as $data){
            try {
                $sub_exam=SubExam::with(['questions.options','questions.dropzons'])->findOrFail($data['sub_exam_id']);
                foreach ($data['response'] as $response){
                    if($response['type']=='images'){
                        $imageID = $response['option_id'];
                        if ($imageID == null){
                            $isRightImage = false;
                        }else{
                            $image=Image::find($imageID);
                            $isRightImage = $image->status ? true : false;
                        }
                        if ($isRightImage){
                            $counter++;
                            $subExamScore++;
                        }
                        $displayed_data['subExams'][$sub_exam->name]['answers'][]=[
                            $isRightImage
                        ];
                    }
                    else if(isset($response['type']) && $response['type']=='dropzones'){
                        $question= $sub_exam->questions->where('id',$response['question_id'])->first();
                        $sub_score=false;
                        if(count($response['options'])){
                            foreach ($response['options'] as $item){
                                $dropzone=$question->dropzons->where('id',$item['dropzone_id'])->first();
                                ($dropzone->option_id==$item['option_id'])?$sub_score=true:$sub_score=false;
                            }
                            if($sub_score){
                                $counter++;
                                $subExamScore++;
                            }
                        }else{
                            $sub_score=false;
                        }
                        $displayed_data['subExams'][$sub_exam->name]['answers'][]=[
                            $sub_score
                        ];
                    }else{
                        if($response['option_id']==null){

                            $displayed_data['subExams'][$sub_exam->name]['answers'][]=[
                                "false"
                            ];
                        }
                        if($response['option_id']!=null){
                            $question= $sub_exam->questions->filter(function ($item) use ($response){
                                return $item->options->where('id',$response['option_id'])->first();
                            })->first();

                            $option=$question->options->where('id',$response['option_id'])->first();
                            //dd($option);
                            $displayed_data['subExams'][$sub_exam->name]['answers'][]=[

                                ($option->status)?"true":"false"
                            ];
                            if($option->status){
                                $subExamScore++;
                                $counter++; // total note
                            }
                        }
                    }
                }
                $displayed_data['subExams'][$sub_exam->name]['minScore']= $sub_exam->note;
                if ($subExamScore < $sub_exam->note){
                    $passedExam = false;
                }
                $subExamScore = 0;
            }catch (NotFoundHttpException $e){
                return \response()->json($e->getMessage(),404);
            }
        }
        $displayed_data['score']=$counter;
        $displayed_data['created_at']=now()->toDateString();
        $displayed_data['passedExam']=$passedExam;


        $score=Score::create(['score'=>json_encode($displayed_data)]);
        return response()->json(['data'=>$score],200);
    }

    /**
     * @param Score $score
     * @return JsonResponse
     */
    public function get_score(Score $score): JsonResponse
    {

        return \response()->json(json_decode($score->score),200);
    }
}
