<?php

namespace App\Http\Controllers\Page\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /*
     *
     */
    public function __construct ()
    {

    }

    public function index()
    {
        // Log::info(__CLASS__ . '-' . __FUNCTION__ . '(' . __LINE__ . ')');
        $view = View()->make( 'web.product.index' );

        return $view;
    }

    public function category()
    {
        // Log::info(__CLASS__ . '-' . __FUNCTION__ . '(' . __LINE__ . ')');
        $view = View()->make( 'web.product.category' );

        return $view;
    }
}
