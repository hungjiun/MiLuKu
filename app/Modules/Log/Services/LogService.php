<?php

namespace App\Modules\Log\Services;

use App\Modules\Log\Repositories\OperationLogRepository;

class LogService
{
    protected $operationLogRepository;

    public function __construct(OperationLogRepository $operationLogRepository)
    {
        $this->operationLogRepository = $operationLogRepository;
    }
}
