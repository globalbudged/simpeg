<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use App\Http\Requests\StoreBagianRequest;
use App\Http\Requests\UpdateBagianRequest;

class BagianController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBagianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBagianRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bagian  $bagian
     * @return \Illuminate\Http\Response
     */
    public function show(Bagian $bagian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBagianRequest  $request
     * @param  \App\Models\Bagian  $bagian
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBagianRequest $request, Bagian $bagian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bagian  $bagian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bagian $bagian)
    {
        //
    }
}
