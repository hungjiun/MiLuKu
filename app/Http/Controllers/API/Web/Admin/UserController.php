<?php

namespace App\Http\Controllers\API\Web\Admin;

use App\Http\Controllers\Controller;
use App\Modules\System\Services\UserService;
use App\Http\Responses\ECResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * \App\Modules\System\Services\UserService
     */
    protected $userService;

    /*
     *
     */
    public function __construct (UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getUsers(Request $request)
    {

        $result = $this->userService->search($request->all());
        return new ECResponse($result);
    }
}
