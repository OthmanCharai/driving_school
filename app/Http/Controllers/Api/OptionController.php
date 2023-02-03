<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionStoreRequest;
use App\Http\Requests\OptionUpdateRequest;
use App\Http\Resources\OptionCollection;
use App\Http\Resources\OptionResource;
use App\Models\Option;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OptionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * @param Request $request
     * @return OptionCollection
     */
    public function index(Request $request): OptionCollection
    {
        $options = Option::all();

        return new OptionCollection($options);
    }

    /**
     * @param OptionStoreRequest $request
     * @return OptionResource
     */
    public function store(OptionStoreRequest $request): OptionResource
    {
        $option = Option::create($request->validated());

        return new OptionResource($option);
    }

    /**
     * @param Request $request
     * @param Option $option
     * @return OptionResource
     */
    public function show(Request $request, Option $option): OptionResource
    {
        return new OptionResource($option);
    }

    /**
     * @param OptionUpdateRequest $request
     * @param Option $option
     * @return OptionResource
     */
    public function update(OptionUpdateRequest $request, Option $option): OptionResource
    {
        $option->update($request->validated());

        return new OptionResource($option);
    }

    /**
     * @param Request $request
     * @param Option $option
     * @return JsonResponse
     */
    public function destroy(Request $request, Option $option): JsonResponse
    {
        $option->delete();

        return response()->json('question deleted with success',200)->setStatusCode(200);
    }
}
