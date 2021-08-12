<?php

namespace App\Services;

use Costa\MicroService\Services\Traits\ConsumeExternalService;

class EvaluationService
{
    use ConsumeExternalService;

    protected $token;
    protected $url;

    public function __construct()
    {
        $this->token = config('services.micro_02.token');
        $this->url = config('services.micro_02.url');
    }

    public function getEvaluation(string $company)
    {
        return $this->request('get', "/evaluations/{$company}");
    }
}