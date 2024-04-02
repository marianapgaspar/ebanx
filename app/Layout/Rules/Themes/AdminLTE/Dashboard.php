<?php

namespace App\Layout\Rules\Themes\AdminLTE;

use App\Layout\Interfaces\ITheme;
use App\Layout\Rules\ALayout;
use App\Layout\Rules\Dashboard\ADashboard;
use App\Layout\Rules\Dashboard\Menu;
use App\Localisation\Rules\Dictionary;

class Dashboard extends ADashboard{
    public function html():string{
       
        return view($this->template,[
            'css'=>$this->css,
            'js'=>$this->js,
            'title'=>$this->title,
            'menu' =>$this->buildMenu($this->menu,$this->getDictionary()),
            'contents'=>$this->contents,
            'scripts'=>$this->scripts,
            'dictionary'=>$this->dictionary]);
    }
    function prepare(){
        $this->addJs(url()->toRoute('public/common/js/jquery.min.js'));
        $this->addJs(url()->toRoute('public/common/js/bootstrap.bundle.min.js'));

        $this->addJs(url()->toRoute('public/common/js/adminlte.min.js'));
        $this->addJs(url()->toRoute('public/common/js/demo.js'));



        $this->addCss(url()->toRoute('public/common/css/all.min.css'));
        $this->addCss(url()->toRoute('public/common/css/adminlte.min.css'));
        $this->addCss(url()->toRoute('public/common/css/ionicons.min.css'));

        $this->setTemplate(url()->toPath('public/layout/template/clear/dashboard.php'));
    }

    public function buildMenu(Menu $menu,Dictionary $dictionary):string{
        $menus = $menu->getMenus();

        $html = "<ul class=\"nav nav-pills nav-sidebar flex-column\" data-widget=\"treeview\" role=\"menu\" data-accordion=\"false\">";
        $html .= $this->buildMenuRecursive($menu->getMenus(),$dictionary);
        $html .= "</ul>";
        return $html;
      
    }

    private function buildMenuRecursive(array $menus,Dictionary $dictionary):string{
        $html = "";
        foreach($menus as $menu){
            $menuHtml = "";
            if(count($menu->getChildren())){
                $menuHtml .= "<li class=\"nav-item has-treeview\"><a href=\"javascript:void(0)\" class=\"nav-link\">
                <i class=\"nav-icon fas fa-th\"></i>
                <p>{$dictionary->get($menu->name)} <i class=\"right fas fa-angle-left\"></i></p>";
            }else{
                $menuHtml .= "<li class=\"nav-item\"><a href=\"{$menu->url}\" class=\"nav-link\">
                <i class=\"nav-icon fas fa-th\"></i>
                <p>{$dictionary->get($menu->name)}</p>";
            }
            $menuHtml .= "</a>";
            if(count($menu->getChildren())){
                $menuHtml .= "<ul class=\"nav nav-treeview\" style=\"display: none;\">";
                $menuHtml .= $this->buildMenuRecursive($menu->getChildren(),$dictionary);
                $menuHtml .= "</ul>";
            }
            $menuHtml .= "</li>";
            $html .= $menuHtml;
        }
        return $html;
    }
}