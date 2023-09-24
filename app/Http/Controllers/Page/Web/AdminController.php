<?php

namespace App\Http\Controllers\Page\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /*
     *
     */
    public function __construct ()
    {

    }

    public function manager()
    {
        // Log::info(__CLASS__ . '-' . __FUNCTION__ . '(' . __LINE__ . ')');
        $view = View()->make( 'web.admin.manager' );

        return $view;
    }
}
