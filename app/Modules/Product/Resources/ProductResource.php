<?php

namespace App\Modules\Product\Resources;

use App\Modules\Product\Constants\ProductStatus;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $resource = $this->resource;

        return [
            'id' => data_get($resource, 'id', 0),
            'product_code' => data_get($resource, 'product_code', ''),
            'display_order' => data_get($resource, 'display_order', 0),
            'open' => data_get($resource, 'open', 0),
            'status' => data_get($resource, 'status', 0),
            'status_text' => ProductStatus::getText(data_get($resource, 'status', 0)),
            'created_at' => (Carbon::parse(data_get($resource, 'created_at', null)))->format('Y-m-d H:i:s'),
            'updated_at' => (Carbon::parse(data_get($resource, 'updated_at', null)))->format('Y-m-d H:i:s'),
        ];
    }
}
