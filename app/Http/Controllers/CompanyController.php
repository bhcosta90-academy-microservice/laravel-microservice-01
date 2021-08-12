<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreUpdateRequest as StoreUpdateRequest;
use App\Http\Resources\CompanyResource as Resource;
use App\Models\Company as Repository;
use App\Services\EvaluationService;

class CompanyController extends Controller
{
    protected $repository;

    protected $evaluationService;

    public function __construct(Repository $repository, EvaluationService $evaluationService)
    {
        $this->repository = $repository;
        $this->evaluationService = $evaluationService;
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
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $body = json_decode($this->evaluationService->getEvaluation($uuid));
        $obj = $this->repository->where('uuid', $uuid)->firstOrFail();
        return (new Resource($obj))->additional([
            'data' => [
                'evaluations' => $body->data
            ]
        ]);
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
