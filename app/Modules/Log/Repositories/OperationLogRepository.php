<?php


namespace App\Modules\Log\Repositories;

use App\Modules\Abstraction\Repositories\Repository;
use App\Modules\Log\Models\OperationLog;

class OperationLogRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return OperationLog::class;
    }
}
