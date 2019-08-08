<?php

namespace App\Http\Controllers;

use DB;
use App\Menu;
use Illuminate\Http\Request;
use App\Helpers\FunctionHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class RoleController extends Controller
{
    /**
     * Menampilkan Treeview Role beserta action dan permission dari User yang sedang login
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Auth::user()->role_id;

        $moduls = Menu::where('parent_id', 0)->get();

        $html = '';
        for ($i=0; $i < count($moduls); $i++) {
            $menus = Menu::where('parent_id', $moduls[$i]->id)->get();

            $actions = DB::table('user_permission')
                        ->where('role_id', $role)
                        ->where('menu_id', $moduls[$i]->id)
                        ->get();

            $modul_html = '';
            $menu_html = '';
            $action_html = '';
            $view = '';

            if (count($menus) == 0) {
                $modul_html .=  '<div class="checkbox">'.
                                    '<i class="'.$moduls[$i]->icon.'"></i> '.
                                    '<span>'. $moduls[$i]->name .'</span>'.
                                    '<ul>';

                for ($j=0; $j < count($actions); $j++) {
                    $menu_html .= '<div class="checkbox">'.
                                    '<input type="checkbox" value="'. $actions[$j]->id .'" checked>'.
                                    '<span>'. $actions[$j]->action .'</span>'.
                                  '</div>';
                }

                $view .= $modul_html . $menu_html . '</ul></div>';
            }

            if (count($menus) > 0) {
                $modul_html .=  '<div class="checkbox">'.
                                    '<i class="'.$moduls[$i]->icon.'"></i> '.
                                    '<span>'.$moduls[$i]->name.'</span>'.
                                    '<ul>';

                for ($k=0; $k < count($menus); $k++) {
                    $menu_html .= '<div class="checkbox">'.
                                    '<i class="'.$menus[$k]->icon.'"></i> '.
                                    '<span>'. $menus[$k]->name .'</span>'.
                                    $this->action($menus[$k]->id);
                }

                $view .= $modul_html . $menu_html . '</ul></div>';
            }

            $html .= $view;
        }


        return view('moduls.setting.roles', ['html' => $html]);
    }

    /**
     * Function untuk menampilkan action dari tiap-tiap menu
     *
     * @return \Illuminate\Http\Response
     */
    public function action($menus)
    {
        $role = Auth::user()->role_id;

        $html = '<ul>';
            $actions = DB::table('user_permission')
                        ->where('role_id', $role)
                        ->where('menu_id', $menus)
                        ->get();

            for ($j=0; $j < count($actions); $j++) {
                if ($actions[$j]->status == 1) {
                    $html .=  '<div class="checkbox">'.
                                '<input type="checkbox" value="'. $actions[$j]->id .'" checked>'.
                                '<span>'.$actions[$j]->action.'</span>'.
                              '</div>';
                } else {
                    $html .=  '<div class="checkbox">'.
                                '<input type="checkbox" value="'. $actions[$j]->id .'">'.
                                '<span>'.$actions[$j]->action.'</span>'.
                              '</div>';
                }
            }

        $html .= '</ul>';

        return $html;
    }
}
