<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionStoreRequest;
use App\Http\Requests\QuestionUpdateRequest;
use App\Http\Resources\QuestionCollection;
use App\Http\Resources\QuestionResource;
use App\Http\Services\Minio\MinioServiceInterface;
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


    public function __construct(public MinioServiceInterface $minioService)
    {
    }

    /**
     * @param Request $request
     * @return QuestionCollection
     */
    public function index(Request $request): QuestionCollection
    {
        $perPage = $request->input('perPage', 10); // number of items per page, default 10
        $currentPage = $request->input('page', 1); // current page number, default 1
        $searchTerm = $request->input('q', ''); // search term, default empty string
        $query = Question::with('options');

        if ($searchTerm) {
            $query->where('question', 'like', '%' . $searchTerm . '%');
        }

        $questions = $query->paginate($perPage, ['*'], 'page', $currentPage);

        return new QuestionCollection($questions);
    }


    /**
     * @param QuestionStoreRequest $request
     * @return QuestionResource
     */
    public function store(QuestionStoreRequest $request)
    {
        $data=$this->minioService->storeFile($request->file('image'),'questions');
        $question=Question::create([
            'question'=>$request->question,
            "image"=>$data['path'],
            'sub_exam_id'=>$request->sub_exam_id,
            'type'=>$request->type
        ]);

        if($request->type=="options"){
            $items=$request->options;
        }elseif ($request->type=="dropzones"){
            $items=$request->dropzones;
        }else {

            $data=$this->minioService->bulkStore($request,$request->answer_image_index,'questions/images');
            $question->images()->saveMany($data);
            $question->load('images');
            return new QuestionResource($question);
        }
        foreach ($items as $item){
            $item= (object)$item;
            $flag=false;
            if((isset($item->status)&& $item->status!=null)){
                $flag=($item->status=="true")?1:0;
            }

            $option=Option::create([
                'answer'=>$item->answer,
                'status'=>$flag,
                'question_id'=>$question->id
            ]);
            if($request->type=='dropzones'){
                $option->dropzon()->save(new Dropzon([
                    'x_position'=>$item->x_position,
                    'y_position'=>$item->y_position,
                    'question_id'=>$question->id
                ]));
                $question->load('dropzons');
            }
        }
        $question->load('options');

        return new QuestionResource($question);
    }

    /**
     * @param Request $request
     * @param Question $question
     * @return QuestionResource
     */
    public function show(Request $request, Question $question): QuestionResource
    {
        $question->load('options');
        $question->load('dropzons');
        $question->load('images');

        return new QuestionResource($question);
    }

    /**
     * @param QuestionUpdateRequest $request
     * @param Question $question
     * @return QuestionResource
     */
    public function update(QuestionUpdateRequest $request, Question $question): QuestionResource
    {
        $info=$request->validated();
        if($request->hasFile('image')){
           $data=$this->minioService->updateFile($request->file('image'),$question->image,'questions');
           $info=array_merge($info,['image'=>$data['path']]);
        }
        $question->update($info);
        if($request->type=="images"){
            foreach ($request->images as $newImage){
                $image=Image::firstOrFail($newImage->id);
                if($newImage->hasFile('image')){
                    $data=$this->minioService->updateFile($newImage->file('image'),$image->url,'questions/images');
                    $image->url=$data['path'];
                }
                $image->status=$newImage->status??$image->status;
                $image->save();
            }
        }else{
            $items=($request->type=="options")?$request->options:$request->dropzones;
            foreach ($items as  $item){
                $item= (object)$item;
                $option=Option::findOrFail($item->id);

                $option->update([
                    'answer'=>$item->answer,
                    'status'=>(isset($item->status))?$item->status:false,
                ]);

                if($request->type=="dropzones"){
                    $dropzone=Dropzon::findOrFail($item->id);
                    $dropzone->update([
                        'x_position'=>$item->x_position,
                        'y_position'=>$item->y_position
                    ]);
                    $question->load('dropzons');
                }
            }
            $question->load('options');
        }

        return new QuestionResource($question);
    }

    /**
     * @param Request $request
     * @param Question $question
     * @return JsonResponse
     */
    public function destroy(Request $request, Question $question): JsonResponse
    {
        if(count($question->images)>0){
            foreach ($question->images as $image){
                $this->minioService->deleteFile($image->url);
            }
        }
        $this->minioService->deleteFile($question->image);
        $question->delete(); // TODO UNCOMMENT

        return response()->json('question deleted with success',200)->setStatusCode(200);

    }




}
