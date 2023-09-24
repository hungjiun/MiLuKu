<?php

namespace App\Http\Controllers\API\Web;

use App\Http\Controllers\Controller;
use App\Modules\System\Services\UserService;
use App\Http\Requests\Web\User\UserLoginRequest;
use App\Exceptions\ECException;
use App\Http\Responses\ECResponse;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    protected $userService;

    /*
     *
     */
    public function __construct (UserService $userService)
    {
        $this->userService = $userService;
    }

    public function userLogin(UserLoginRequest $request)
    {
        $result = $this->userService->login($request->all());
        throw_unless(
            $result,
            new ECException(
                trans('api.ERROR_CODE.AUTH_INCORRECT_USERNAME_OR_PASSWORD'),
                ECException::ERROR_CODE_AUTH_INCORRECT_USERNAME_OR_PASSWORD
            )
        );
        return new ECResponse($result);
    }
}
