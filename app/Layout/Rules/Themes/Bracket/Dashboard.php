<?php

namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Interfaces\ITheme;
use App\Layout\Rules\ALayout;
use App\Layout\Rules\Dashboard\ADashboard;
use App\Layout\Rules\Dashboard\Menu;
use App\Localisation\Rules\Dictionary;
use System\Server\Authentication;

class Dashboard extends ADashboard{
    public function html():string{
       
        return view($this->template,[
            'css'=>$this->css,
            'js'=>$this->js,
            'title'=>$this->title,
            'menu' =>$this->buildMenu($this->menu,$this->getDictionary()),
            'contents'=>$this->contents,
            'breadcrumb'=>$this->breadcrumb,
            'auth'=> Authentication::getSessionAuth(),
            'scripts'=>$this->scripts,
            'dictionary'=>$this->dictionary]);
    }
    function prepare(){
        // $this->addJs("https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js");
        $this->addJs("https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js");
        // $this->addJs("https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js");
        
        $this->addJs(url()->toRoute('public/common/bracket/js/jquery.js'));
        // $this->addJs(url()->toRoute('public/common/bracket/js/popper.js'));
        $this->addJs(url()->toRoute('public/common/bracket/js/bootstrap.js'));
        $this->addJs(url()->toRoute('public/common/bracket/js/perfect-scrollbar.jquery.js'));
        $this->addJs(url()->toRoute('public/common/bracket/js/moment.js'));
        $this->addJs(url()->toRoute('public/common/bracket/js/jquery-ui.js'));
        $this->addJs(url()->toRoute('public/common/bracket/js/jquery.switchButton.js'));
        $this->addJs(url()->toRoute('public/common/bracket/js/jquery.peity.js'));
        $this->addJs(url()->toRoute('public/common/bracket/js/highlight.pack.js'));
        $this->addJs(url()->toRoute('public/common/bracket/js/select2.min.js'));
        
       // $this->addJs(url()->toRoute('public/common/bracket/js/ckeditor.js'));
        $this->addJs(url()->toRoute('public/common/bracket/js/bracket.js'));

        $this->addCss(url()->toRoute('public/common/css/all.min.css'));
        $this->addCss(url()->toRoute('public/common/bracket/css/font-awesome.css'));
        $this->addCss(url()->toRoute('public/common/bracket/css/ionicons.css'));
        $this->addCss(url()->toRoute('public/common/bracket/css/perfect-scrollbar.css'));
        $this->addCss(url()->toRoute('public/common/bracket/css/jquery.switchButton.css'));
        $this->addCss(url()->toRoute('public/common/bracket/css/github.css'));
        $this->addCss(url()->toRoute('public/common/bracket/css/select2.min.css'));
        $this->addCss(url()->toRoute('public/common/bracket/css/bracket.css'));
        $this->addScript('$(window).on("beforeunload", function() {
            $(window).scrollTop(0);
        });');
        $this->setTemplate(url()->toPath('public/layout/template/bracket/dashboard.php'));
    }

    public function buildMenu(Menu $menu,Dictionary $dictionary):string{
        $menus = $menu->getMenus();

        $html = "<div class=\"br-sideleft-menu\">";
        foreach($menu->getMenus() as $menu){
            if($menu->scope && !Authentication::getSessionAuth()->hasScope($menu->scope)){
                continue;
            }
            if(count($menu->getChildren())){
                $html .= "<a href=\"{$menu->url}\" class=\"br-menu-link\">
                <div class=\"br-menu-item\">
                  <i class=\"menu-item-icon icon {$menu->icon} tx-20\"></i>
                  <span class=\"menu-item-label\">{$dictionary->get($menu->name)}</span>
                  <i class=\"menu-item-arrow fa fa-angle-down\"></i>
                </div>
              </a>";
              $html .="<ul class=\"br-menu-sub nav flex-column\" style=\"display: none;\">";
              $html .=$this->buildMenuRecursive($menu->getChildren(),$dictionary);
              $html .="</ul>";
            }else{
                $html .= "<a href=\"{$menu->url}\" class=\"br-menu-link\">
                <div class=\"br-menu-item\">
                  <i class=\"menu-item-icon icon ion-ios-home-outline tx-22\"></i>
                  <span class=\"menu-item-label\">{$dictionary->get($menu->name)}</span>
                </div>
              </a>";
            }

        }
        $html .= "</div>";
        return $html;
      
    }

    private function buildMenuRecursive(array $menus,Dictionary $dictionary):string{
        $html = "";
        foreach($menus as $menu){
            if($menu->scope && !Authentication::getSessionAuth()->hasScope($menu->scope)){
                continue;
            }
            $menuHtml = "";
            if(count($menu->getChildren())){
                $menuHtml .= "<li class=\"nav-item has-treeview\"><a href=\"javascript:void(0)\" class=\"nav-link\">
                {$dictionary->get($menu->name)} <i class=\"right fas fa-angle-left\"></i>";
            }else{
                $menuHtml .= "<li class=\"nav-item\"><a href=\"{$menu->url}\" class=\"nav-link\">
                {$dictionary->get($menu->name)}";
            }
            $menuHtml .= "</a>";
            if(count($menu->getChildren())){
                $menuHtml .= "<ul class=\"br-menu-sub nav nav-treeview\" style=\"display: none;\">";
                $menuHtml .= $this->buildMenuRecursive($menu->getChildren(),$dictionary);
                $menuHtml .= "</ul>";
            }
            $menuHtml .= "</li>";
            $html .= $menuHtml;
        }
        return $html;
    }
}