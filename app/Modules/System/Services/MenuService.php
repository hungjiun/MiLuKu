<?php

namespace App\Modules\System\Services;

class MenuService
{
    private $data;

    public function __construct()
    {
    }

    public function getMenuData()
    {

        $this->data = self::flatten(json_decode(json_encode($this->getTableData())), 'submenu');

        return $this->data;
    }

    public function getMenuIds()
    {

        $menu = self::flatten(json_decode(json_encode($this->getTableData())), 'submenu');

        return $menu->pluck('id')->toArray();
    }

    public function getOpenedData()
    {
        $menu = self::flatten(json_decode(json_encode($this->getTableData())), 'submenu');

        $filtered = $menu->reject(function ($var, $key) {
            return $var->open == 0;
        });

        return $filtered;
    }

    public function getOpenedMenuIds()
    {
        $menu = self::flatten(json_decode(json_encode($this->getTableData())), 'submenu');

        $filtered = $menu->reject(function ($var, $key) {
            return $var->open == 0;
        });

        return $filtered->pluck('id')->toArray();
    }

    public function getTableData()
    {
        return config('miluku.menu');
    }

    public function getViewData()
    {
        $sysMenu = $this->getMenuData();
        $menu = $sysMenu->where('open', '=', 1)->where('parent_id', '=', 0);
        foreach ($menu as $key => $var) {
            if ($var->sub_menu) {
                $var->second = $sysMenu->where('open', '=', 1)->where('parent_id', '=', $var->id);
                foreach ($var->second as $key2 => $var2) {
                    if ($var2->sub_menu) {
                        $var2->third = $sysMenu->where('open', '=', 1)->where('parent_id', '=', $var2->id);
                    }
                }
            }
        }
        return $menu;
    }

    static function flatten($input, $key) {
        $output = [];

        // For each object in the array
        foreach ($input as $object) {

            // separate its children
            $children = isset($object->$key) ? $object->$key : [];
            $object->$key = [];

            // and add it to the output array
            $output[] = $object;

            // Recursively flatten the array of children
            $children = self::flatten($children, $key);

            //  and add the result to the output array
            foreach ($children as $child) {
                $output[] = $child;
            }
        }
        return collect($output);
    }
}
