<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDropzonRequest;
use App\Http\Requests\UpdateDropzonRequest;
use App\Http\Resources\DropzonCollection;
use App\Http\Resources\DropzonResource;
use App\Models\Dropzon;
use App\Models\Option;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class DropzonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return DropzonCollection
     */
    public function index(): DropzonCollection
    {
        $dropzones = Dropzon::all();

        return new DropzonCollection($dropzones);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDropzonRequest $request
     * @return DropzonResource
     */
    public function store(StoreDropzonRequest $request): DropzonResource
    {
        $dropzone=Dropzon::create($request->validated());
        return new DropzonResource($dropzone);
    }

    /**
     * Display the specified resource.
     *
     * @param Dropzon $dropzon
     * @return DropzonResource
     */
    public function show(Dropzon $dropzon): DropzonResource
    {
        return new DropzonResource($dropzon);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDropzonRequest $request
     * @param Dropzon $dropzon
     * @return DropzonResource
     */
    public function update(UpdateDropzonRequest $request, $dropzon): DropzonResource
    {
        $dropzon=Dropzon::findOrFail($dropzon);

        $dropzon->update($request->validated());

        return new DropzonResource($dropzon);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Dropzon $dropzon
     * @return JsonResponse
     */
    public function destroy($dropzon): JsonResponse
    {
        //
        $dropzon=Dropzon::findOrFail($dropzon);
        $dropzon->delete();
        return \response()->json('dropzone was deleted with success',200);


    }
}
