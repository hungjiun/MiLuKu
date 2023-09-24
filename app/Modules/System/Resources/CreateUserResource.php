<?php

namespace App\Modules\System\Resources;

use App\Modules\System\Constants\UserStatus;
use App\Http\Resources\UserOrganizationResource;
use App\Http\Resources\UserRoleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateUserResource extends JsonResource
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
            'name' => data_get($resource, 'name', ''),
            'mobile' => data_get($resource, 'mobile', ''),
            'note' => data_get($resource, 'note', ''),
            'status' => data_get($resource, 'status', 0),
            'status_text' => UserStatus::getTitle(data_get($resource, 'status', 0)),
            'created_at' => $resource->created_at->format('Y-m-d H:i:s'),
            //'updated_at' => $resource->updated_at->format('Y-m-d H:i:s'),
            'organizations' => UserOrganizationResource::collection(data_get($resource, 'organizations', [])),
            'roles' => UserRoleResource::collection(data_get($resource, 'roles', []))
        ];
    }
}
