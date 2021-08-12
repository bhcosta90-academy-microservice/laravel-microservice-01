<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreUpdateRequest as StoreUpdateRequest;
use App\Http\Resources\CompanyResource as Resource;
use App\Jobs\TesteJob;
use App\Models\Company as Repository;
use App\Services\CompanyService;
use App\Services\EvaluationService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $repository;

    protected $evaluationService;

    protected $companyService;

    public function __construct(Repository $repository, EvaluationService $evaluationService, CompanyService $companyService)
    {
        $this->repository = $repository;
        $this->evaluationService = $evaluationService;
        $this->companyService = $companyService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Resource::collection($this->companyService->getCompanies($request->filter ?: null));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateRequest $request)
    {
        $company = $this->companyService->createNewCompany($request->validated(), $request->image);

        TesteJob::dispatch();
        
        return new Resource($company);
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
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateRequest $request, $uuid)
    {
        $obj = $this->companyService->updateCompany($uuid, $request->validated(), $request->image);
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
