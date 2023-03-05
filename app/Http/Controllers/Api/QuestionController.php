<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionStoreRequest;
use App\Http\Requests\QuestionUpdateRequest;
use App\Http\Resources\QuestionCollection;
use App\Http\Resources\QuestionResource;
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
        // create question fist
        $file=$request->file('image');
        $path=Storage::disk('public')->putFile('questions',$file);
        $question=Question::create(array_merge(['image'=>$path],$request->validated()));

        // options
        if($request->type=='options'){
            $options=[];
            foreach (json_decode($request->options) as $option){
                $options[]=[
                    'answer'=>$option->answer,
                    'status'=>$option->status,
                    'question_id'=>$question->id
                ];
            }
            Db::table('options')->insert($options);
        }
        //dropzone
        if($request->type=='options'){

        }
        $question = Question::create($request->validated());

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
        return new QuestionResource($question);
    }

    /**
     * @param QuestionUpdateRequest $request
     * @param Question $question
     * @return QuestionResource
     */
    public function update(QuestionUpdateRequest $request, Question $question): QuestionResource
    {
        $question->update($request->validated());

        return new QuestionResource($question);
    }

    /**
     * @param Request $request
     * @param Question $question
     * @return JsonResponse
     */
    public function destroy(Request $request, Question $question): JsonResponse
    {
        // $question->delete(); // TODO UNCOMMENT

        return response()->json('question deleted with success',200)->setStatusCode(200);

    }
}
