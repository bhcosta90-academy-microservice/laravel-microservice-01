<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    protected $repository;

    public function __construct(Category $repository)
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
        return CategoryResource::collection($this->repository->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreUpdateRequest $request)
    {
        $obj = $this->repository->create($request->validated());
        return new CategoryResource($obj);
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
        return new CategoryResource($obj);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $url
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryStoreUpdateRequest $request, $url)
    {
        $obj = $this->repository->where('url', $url)->firstOrFail();
        $obj->fill($request->validated());
        $obj->save();
        return new CategoryResource($obj);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $url
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
