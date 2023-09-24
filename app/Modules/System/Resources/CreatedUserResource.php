<?php

namespace App\Modules\System\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CreatedUserResource extends JsonResource
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
            'user_id' => data_get($resource, 'id', 0),
            'account' => data_get($resource, 'account', ''),
            'name' => data_get($resource, 'name', '')
        ];
    }
}
