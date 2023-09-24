<?php

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Arr;

if (! function_exists('portal_asset')) {
    function portal_asset($path, $secure = null)
    {
        $routes = app('router')->getRoutes();
        // The URL generator needs the route collection that exists on the router.
        // Keep in mind this is an object, so we're passing by references here
        // and all the registered routes will be available to the generator.
        app()->instance('routes', $routes);

        $urlGenerator = new UrlGenerator(
            $routes, app()->rebinding(
                'request', function ($app, $request) {
                    app('url')->setRequest($request);
                }
            ), config('portal.asset_url')
        );
        return $urlGenerator->asset($path, $secure);
    }
}

if (! function_exists('array_flatten')) {
    function array_flatten($array)
    {
        return Arr::flatten($array);
    }
}

if (! function_exists('getIP'))
{
    /**
     * Get the real IP address from visitors proxy. e.g. Cloudflare
     *
     * @return string IP
     */
    function getIP()
    {
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }

        // Sometimes the `HTTP_CLIENT_IP` can be used by proxy servers
        $ip = @$_SERVER['HTTP_CLIENT_IP'];
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
           return $ip;
        }

        // Sometimes the `HTTP_X_FORWARDED_FOR` can contain more than IPs
        $forward_ips = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        if ($forward_ips) {
            $all_ips = explode(',', $forward_ips);

            foreach ($all_ips as $ip) {
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)){
                    return $ip;
                }
            }
        }

        return $_SERVER['REMOTE_ADDR'];
    }
}
