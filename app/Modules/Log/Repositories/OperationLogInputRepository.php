<?php


namespace App\Modules\Log\Repositories;

use App\Modules\Abstraction\Repositories\Repository;
use App\Modules\Log\Models\OperationLogInput;

class OperationLogInputRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return OperationLogInput::class;
    }
}
