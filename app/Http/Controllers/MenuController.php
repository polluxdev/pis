<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use App\Helpers\FunctionHelper;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan halaman home setelah login dengan menu sesuai role yang sedang login
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $menus = Menu::where('parent_id', 0)->get();

        $html = '';
        for ($i=0; $i < count($menus); $i++) {
            $child = Menu::where('parent_id', $menus[$i]->id)->get();
            $modul = '';
            $menu = '';
            $view = '';

            $checkModul = FunctionHelper::checkMenu($menus[$i]->url);
            if ($checkModul) {
                if (count($child) == 0) {
                    $modul .= '<li>'.
                                  '<a href="#" onclick="changeMenu('."'".$menus[$i]->url."'".')">'.
                                      '<i class="'.$menus[$i]->icon.'"></i>'.
                                      '<span>'.$menus[$i]->name.'</span>'.
                                  '</a>'.
                              '</li>';

                    $view .= $modul;
                }
                if (count($child) > 0) {
                    $modul .= '<li class="treeview">'.
                                  '<a href="#">'.
                                      '<i class="'.$menus[$i]->icon.'"></i>'.
                                      '<span>'.$menus[$i]->name.'</span>'.
                                      '<i class="fa fa-angle-left pull-right"></i>'.
                                  '</a>'.
                                  '<ul class="treeview-menu">';

                    for ($j=0; $j < count($child); $j++) {
                        $checkMenu = FunctionHelper::checkMenu($child[$j]->url);
                        if ($checkMenu) {
                            $menu .= '<li id="sub-menu"><a href="#" onclick="changeMenu('."'".$child[$j]->url."'".')"><i class="'.$child[$j]->icon.'"></i>'.$child[$j]->name.'</a></li>';
                        }
                    }

                    $view .= $modul.$menu.'</ul></li>';
                }
                $html .= $view;
            }
        }

        return view('layouts.main', ['html' => $html, 'user' => $user]);
    }
}
