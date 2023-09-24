<?php

namespace App\Http\Controllers\Page\Portal;

use App\Http\Controllers\Controller;
use InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class PortalController extends Controller
{
    public function index()
    {
        return view('portal.index')->with('breadcrumb', []);
    }

    public function home()
    {
        return view('portal.home')->with('breadcrumb', []);
    }

    public function html($html)
    {
        try {
            return view('portal.' . str_replace('.html', '', $html))->with('breadcrumb', []);
        } catch (InvalidArgumentException $exception) {
            abort(404);
        }
    }

    public function email($html)
    {
        try {
            return view('mail.' . str_replace('.html', '', $html));
        } catch (InvalidArgumentException $exception) {
            abort(404);
        }
    }
}
