<?php

namespace App\Modules\System\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserRoleResource extends JsonResource
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
            'account' => data_get($resource, 'account', ''),
            'type' => data_get($resource, 'type', ''),
        ];
    }
}
