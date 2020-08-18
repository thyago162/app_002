<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Services\LojaService;
use Illuminate\Http\Request;

class LojaController extends Controller
{
    protected $service;

    public function __construct(LojaService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = $this->service->allData();

        return response()->json(compact('response'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->service->storeData($request->all());

        return response()->json(compact('response'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = $this->service->showData($id);

        return response()->json(compact('response'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = $this->service->updateData($id, $request->all());

        return response()->json(compact('response'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->service->destroyData($id);

        return response()->json(compact('response'));
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function produtos($id)
    {
        $response = $this->service->produtosData($id);

        return response()->json(compact('response'));
    }

}
