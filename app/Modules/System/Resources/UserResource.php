<?php

namespace App\Modules\System\Resources;

use App\Modules\System\Constants\UserStatus;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class UserResource extends JsonResource
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
            'account' => data_get($resource, 'account', ''),
            'name' => data_get($resource, 'name', ''),
            'mobile' => data_get($resource, 'mobile', ''),
            'note' => data_get($resource, 'note', ''),
            'status' => data_get($resource, 'status', 0),
            'status_text' => UserStatus::getText(data_get($resource, 'status', 0)),
            'created_at' => (Carbon::parse(data_get($resource, 'created_at', null)))->format('Y-m-d H:i:s'),
            'updated_at' => (Carbon::parse(data_get($resource, 'updated_at', null)))->format('Y-m-d H:i:s'),
        ];
    }
}
