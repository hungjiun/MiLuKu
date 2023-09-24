<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    /*
     *
     */
    public function __construct ()
    {

    }

    public function index()
    {
        $view = View()->make( 'web.projects' );

        //$menu = collect(config('miluku.menu'));
        $menu = json_decode(json_encode(config('miluku.menu')));

        Log::info(__CLASS__ . '-' . __FUNCTION__ . '(' . __LINE__ . ') - ' . json_encode($menu));

        $view->with('menu', $menu);

        return $view;
    }
}
