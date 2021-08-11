<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreUpdateRequest as StoreUpdateRequest;
use App\Http\Resources\CategoryResource as Resource;
use App\Models\Category as Repository;

class CategoryController extends Controller
{
    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Resource::collection($this->repository->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateRequest $request)
    {
        $obj = $this->repository->create($request->validated());
        return new Resource($obj);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $url
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $obj = $this->repository->where('url', $url)->firstOrFail();
        return new Resource($obj);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $url
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateRequest $request, $url)
    {
        $obj = $this->repository->where('url', $url)->firstOrFail();
        $obj->update($request->validated());
        return new Resource($obj);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $url
     * @return \Illuminate\Http\Response
     */
    public function destroy($url)
    {
        $this->repository->where('url', $url)->firstOrFail()->delete();
        return response()->noContent();
    }
}
