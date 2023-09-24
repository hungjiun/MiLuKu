<?php

namespace App\Http\Controllers\Page\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /*
     *
     */
    public function __construct ()
    {

    }

    public function index()
    {
        $view = View()->make( 'web.index' );

        return $view;
    }

    public function login()
    {
        $view = View()->make( 'web.login' );

        return $view;
    }
}
