<?php

namespace App\Modules\System\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserOrganizationResource extends JsonResource
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
            'name' => data_get($resource, 'name', ''),
            'type' => data_get($resource, 'type', ''),
        ];
    }
}
