<?php

namespace App\Modules\System\Services;

use App\Exceptions\ECException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use App\Modules\System\Repositories\UserRepository;
use App\Modules\System\Repositories\LoginLogRepository;
use App\Modules\System\Constants\UserStatus as UserStatusConstants;
use App\Modules\System\Constants\LoginStatus as LoginStatusConstants;
use App\Modules\System\Resources\LoginUserResource;
use App\Modules\System\Resources\UserResource;
use Laravel\Sanctum\PersonalAccessToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserService
{
    use AuthenticatesUsers;

    protected $userRepository;
    protected $loginLogRepository;

    public function __construct(
        UserRepository $userRepository,
        LoginLogRepository $loginLogRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->loginLogRepository = $loginLogRepository;
    }

    public function login($request)
    {
        $login = Auth::attempt([
            'account' 	=> $request['account'],
            'password' 	=> $request['password'],
            'status'    => UserStatusConstants::ENABLE
        ]);

        if ($login) {
            $this->loginLogRepository->createLoginLog([
                'user_id'   => Auth::id(),
                'account'   => $request['account'],
                'ip_addr'   => getIP() ?? $request->ip(),
                'status'    => LoginStatusConstants::SUCCESS,
            ]);
            return [
                'api_token' => $this->_getApiToken(),
                'user'      => new UserResource(Auth::user()),
                'rtnurl'    => '/web'
            ];
        } else {
            $this->loginLogRepository->createLoginLog([
                'user_id' => 0,
                'account' => $request['account'],
                'ip_addr' => getIP() ?? $request->ip(),
                'status' => LoginStatusConstants::FAIL,
            ]);
        }

        return $login;
    }

    public function logout($token)
    {
        $user = Auth::user();
        /* $user->api_token = null;
        $user->save(); */
        //auth()->user()->tokens()->delete();
        PersonalAccessToken::findToken($token)->delete();
        return true;
    }

    private function _getApiToken()
    {
        $token = auth()->user()->createToken(
            'API Token',
            ['*'],
            Carbon::now()->addDays(env('API_TOKEN_EXPIRED', 1)))->plainTextToken;
            //Carbon::now()->addMinute())->plainTextToken;

        return $token;
    }

    /* public function search($request)
    {
        //處理搜尋的參數
        $query = $this->_searchParameterQuery($request);

        $searchResult = $this->userRepository->searchUser(
            $query['where'],
            $query['sort_by'],
            $query['order'],
            $query['page'],
            $query['number_per_page']
        );

        return $searchResult;
    } */
    public function search($request)
    {
        $draw = data_get($request, 'draw', 0);
        $start = data_get($request, 'start', 0);
        $length = data_get($request, 'length', 0);
        $orderIndex = data_get($request, 'order.0.column', 0);
        $orderDir = data_get($request, 'order.0.dir', 'asc');
        $columns = data_get($request, 'columns', []);
        $sortColumn = data_get($request, "columns.{$orderIndex}.name", '');

        /* Log::info(__CLASS__ . '-' . __FUNCTION__ . '(' . __LINE__ . ') draw - '. $draw);
        Log::info(__CLASS__ . '-' . __FUNCTION__ . '(' . __LINE__ . ') start - '. $start);
        Log::info(__CLASS__ . '-' . __FUNCTION__ . '(' . __LINE__ . ') length - '. $length);
        Log::info(__CLASS__ . '-' . __FUNCTION__ . '(' . __LINE__ . ') orderIndex - '. $orderIndex);
        Log::info(__CLASS__ . '-' . __FUNCTION__ . '(' . __LINE__ . ') orderDir - '. $orderDir);
        Log::info(__CLASS__ . '-' . __FUNCTION__ . '(' . __LINE__ . ') sortColumn - '. $sortColumn); */

        $count = $this->userRepository->query()->count();
        $query = $this->userRepository->query();
        if (!empty($sortColumn)) {
            $query->orderBy($sortColumn, $orderDir);
        }
        $result = $query->limit($length)
                        ->offset($start)
                        ->select(
                            'id',
                            'account',
                            'name',
                            'note',
                            'status',
                            'updated_by',
                            'created_at',
                            'updated_at'
                        )->get();

        return [
            "draw" => $draw,
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
            "data" => UserResource::collection($result)
        ];
    }

    private function _searchParameterQuery($request)
    {
        $query = [];
        $query['where'] = [];
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
                case 'status':
                    if (!empty($value)) {
                        $query['where'][] = [$key, $value];
                    }
                    break;
                case 'account':
                    if (!is_null($value) && (Str::length($value) > 0)) {
                        $query['where'][] = [$key, 'like', '%'.$value.'%'];
                    }
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
        return $this->userRepository->findUser($id);
    }

    public function create(array $request)
    {
        DB::beginTransaction();
        $request['password']    = bcrypt($request['password']);
        $request['created_by']  = Auth::id();
        $request['updated_by']  = Auth::id();
        $request['status'] = UserStatusConstants::ENABLE;
        $insertResult = $this->userRepository->createUser($request);
        if (!$insertResult) {
            DB::rollBack();
            return $insertResult;
        }

        DB::commit();
        return $insertResult;
    }

    public function update(array $request)
    {
        DB::beginTransaction();

        $updateUser = $this->userRepository->findUser($request['id']);

        $updateUser->name = $request['name'];
        if (isset($request['email'])) {
            $updateUser->email  = $request['email'];
        }
        if (isset($request['mobile'])) {
            $updateUser->mobile  = $request['mobile'];
        }
        if (isset($request['note'])) {
            $updateUser->note = $request['note'];
        }
        $updateUser->status = $request['status'];
        $updateUser->updated_by = Auth::id();

        $updateResult = $updateUser->save();
        if (!$updateResult) {
            DB::rollBack();
            return $updateResult;
        }

        DB::commit();
        return $updateResult;
    }

    public function updatePassword(array $request)
    {
        DB::beginTransaction();

        $update['password'] = bcrypt($request['password']);

        $updateResult = $this->userRepository->updateUser($request['id'], $update);
        if (!$updateResult) {
            DB::rollBack();
            return $updateResult;
        }

        DB::commit();
        return $updateResult;
    }

    public function updateMyData(array $request)
    {
        DB::beginTransaction();

        $user = Auth::user();
        $user->name = $request['name'];
        if (isset($request['email'])) {
            $user->email = $request['email'];
        }
        if (isset($request['mobile'])) {
            $user->mobile = $request['mobile'];
        }
        if (isset($request['note'])) {
            $user->note = $request['note'];
        }
        $user->updated_by = Auth::id();

        if (!$user->save()) {
            DB::rollBack();
            return $user;
        }

        DB::commit();
        return $user;
    }

    public function updateMyPassword(array $request)
    {
        DB::beginTransaction();

        $update = [
            'password'   => bcrypt($request['new_password']),
            'updated_by' => Auth::id()
        ];

        $updateResult = $this->userRepository->updateUser(Auth::id(), $update);
        if (!$updateResult) {
            DB::rollBack();
            return $updateResult;
        }

        DB::commit();
        return $updateResult;
    }

    public function updateStatus(array $request)
    {
        DB::beginTransaction();
        $update = [
            'status'        => $request['status'],
            'updated_by'    => Auth::id()
        ];

        $updateResult = $this->userRepository->updateUser($request['id'], $update);
        if (!$updateResult) {
            DB::rollBack();
            return $updateResult;
        }

        DB::commit();
        return $updateResult;
    }


    public function getUsersInfo(array $userIds)
    {
        $users = $this->userRepository->findUsers($userIds);
        $userInfos = collect($users)->map(function($user){
            return [
                'user_id' =>  $user->id,
                'account' => $user->account,
                'name' => $user->name,
                'status' => $user->status,
            ];
        });

        return $userInfos;
    }
}
