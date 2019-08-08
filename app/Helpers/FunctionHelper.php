<?php
namespace App\Helpers;

use DB;
use Illuminate\Support\Facades\Auth;

class FunctionHelper{

    public static function checkMenu($url)
    {
        $role = Auth::user()->role_id;

        $check = DB::table('user_permission')->leftJoin('menus', 'menus.id', 'user_permission.menu_id')
                ->where('role_id', $role)
                ->where('url', $url)
                ->where('status', 1)
                ->first();

        if (isset($check->url)) {
            return true;
        }

        return false;
    }

    public static function checkAction($action)
    {
        $role = Auth::user()->role_id;

        $check = DB::table('user_permission')
                ->where('role_id', $role)
                ->where('action', $action)
                ->where('status', 1)
                ->first();

        if (isset($check->action)) {
            return true;
        }

        return false;
    }
}
