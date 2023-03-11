<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionStoreRequest;
use App\Http\Requests\QuestionUpdateRequest;
use App\Http\Resources\QuestionCollection;
use App\Http\Resources\QuestionResource;
use App\Models\Dropzon;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:api');
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
    public function store(QuestionStoreRequest $request): QuestionResource
    {
        // dd($request->options);
        // create question fist
        // $file=$request->file('image');
        // $path=Storage::disk('public')->putFile('questions',$file);

        $question=Question::create([
            'question'=>$request->question,
            "image"=>'wtf',
            'sub_exam_id'=>$request->sub_exam_id,
            'type'=>$request->type
        ]);

        $items=($request->type=="options")?$request->options:$request->dropzones;

        foreach ($items as $item){
            $item= (object)$item;
            $option=Option::create([
                'answer'=>$item->answer,
                'status'=>(isset($item->status)&& $item->status!=null)?(int)$item->status:false,
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

        return new QuestionResource($question);
    }

    /**
     * @param QuestionUpdateRequest $request
     * @param Question $question
     * @return QuestionResource
     */
    public function update(QuestionUpdateRequest $request, Question $question): QuestionResource
    {
        dd($request);
        if($request->hasFile('image')){
            // $file = $request->file("image");
            // $path=Storage::disk('public')->putFile('questions', $file);
            // Storage::disk('public')->delete($question->image);
        }

        $question->update([
            'question'=>$request->question,
            // "image"=>$path,
            'sub_exam_id'=>$request->sub_exam_id,
            'type'=>$request->type
        ]);
        $items=($request->type=="options")?$request->options:$request->dropzones;
        foreach ($items as  $item){
            $item= (object)$item;
            $option=Option::findOrFail($item->option_id);

            $option->update([
                'answer'=>$item->answer,
                'status'=>(isset($item->status))?$item->status:false,
            ]);

            if($request->type=="dropzones"){
                $dropzone=Dropzon::findOrFail($item->dropzone_id);
                $dropzone->update([
                    'x_position'=>$item->x_position,
                    'y_position'=>$item->y_position
                ]);
                $question->load('dropzons');
            }

        }
        $question->load('options');
        return new QuestionResource($question);
    }

    /**
     * @param Request $request
     * @param Question $question
     * @return JsonResponse
     */
    public function destroy(Request $request, Question $question): JsonResponse
    {
        $question->delete(); // TODO UNCOMMENT

        return response()->json('question deleted with success',200)->setStatusCode(200);

    }


}
