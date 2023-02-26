<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDropzonRequest;
use App\Http\Requests\UpdateDropzonRequest;
use App\Models\Dropzon;

class DropzonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDropzonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDropzonRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dropzon  $dropzon
     * @return \Illuminate\Http\Response
     */
    public function show(Dropzon $dropzon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dropzon  $dropzon
     * @return \Illuminate\Http\Response
     */
    public function edit(Dropzon $dropzon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDropzonRequest  $request
     * @param  \App\Models\Dropzon  $dropzon
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDropzonRequest $request, Dropzon $dropzon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dropzon  $dropzon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dropzon $dropzon)
    {
        //
    }
}
