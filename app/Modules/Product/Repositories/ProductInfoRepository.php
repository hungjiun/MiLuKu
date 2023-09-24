<?php


namespace App\Modules\Product\Repositories;

use App\Modules\Abstraction\Repositories\Repository;
use App\Modules\Product\Models\ProductInfo;
use Illuminate\Support\Facades\Log;

class ProductInfoRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return ProductInfo::class;
    }
}
