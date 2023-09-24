<?php

namespace App\Modules\System\Services;

use App\Exceptions\MMRMException;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Modules\System\Repositories\PermissionApiRepository;
use App\Modules\System\Constants\Role as RoleConstants;
use App\Modules\System\Constants\RoleType as RoleTypeConstants;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PermissionApiService
{
    protected $permissionApiRepository;

    public function __construct(PermissionApiRepository $permissionApiRepository)
    {
        $this->permissionApiRepository = $permissionApiRepository;
    }

    public function search($request)
    {
        //處理搜尋的參數
        $query = $this->_searchParameterQuery($request);

        $searchResult = $this->permissionApiRepository->searchPermissionApi(
            $query['where'],
            $query['sort_by'],
            $query['order'],
            $query['page'],
            $query['number_per_page']
        );

        return $searchResult;
    }

    private function _searchParameterQuery($request)
    {
        $query = [];
        $query['where'] = [];
        $query['role'] = null;
        foreach ($request as $key => $value) {
            switch ($key) {
                case 'sort_by':
                    $query['sort_by'] = $value;
                    break;
                case 'order':
                    $query['order'] = $value;
                    break;
                case 'page':
                    $query['page'] = $value;
                    break;
                case 'number_per_page':
                    $query['number_per_page'] = $value;
                    break;
                default:
                    if (!is_null($value)) {
                        $query['where'][] = [$key, $value];
                    }
                    break;
            }
        }

        return $query;
    }

    public function find(int $id)
    {
        return $this->permissionApiRepository->findPermissionApi($id);
    }
}
