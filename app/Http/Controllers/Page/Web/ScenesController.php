<?php

namespace App\Http\Controllers\Page\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ScenesController extends Controller
{
    /*
     *
     */
    public function __construct ()
    {

    }

    public function banner()
    {
        // Log::info(__CLASS__ . '-' . __FUNCTION__ . '(' . __LINE__ . ')');
        $view = View()->make( 'web.scenes.banner' );

        return $view;
    }

    public function footer()
    {
        // Log::info(__CLASS__ . '-' . __FUNCTION__ . '(' . __LINE__ . ')');
        $view = View()->make( 'web.scenes.footer' );

        return $view;
    }
}
