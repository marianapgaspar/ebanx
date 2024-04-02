<?php

namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Interfaces\ITheme;
use App\Layout\Rules\Login\ALogin;
use App\Localisation\Rules\Localisation;

class Login extends ALogin{
    function prepare(){
        $this->addCss(url()->toRoute('public/common/css/app.css'));
        $this->addCss(url()->toRoute('public/common/bracket/css/bracket.css'));

        $this->addJs(url()->toRoute('public/common/js/app.js'));
        $this->addJs(url()->toRoute('public/common/js/common.js'));
        $this->addJs(url()->toRoute('public/common/js/charts.js'));
        $this->addJs(url()->toRoute('public/common/js/jquery-3.5.1.min.js'));
        
        $this->setTitle('Login');
        $this->setTemplate(url()->toPath('public/layout/template/clear/login.php'));
   

    }

    public function html():string{

        $dictionary = Localisation::instance()->getDictionary();
        $dictionary->loadFile('login');
        $title = 'welcome_to_danica_software';
        $page = '';
        if($this->pageForgot){
            $title = 'forgot';
            $page = 'forgot';
            if($this->formForgot){
                $title = 'enter_the_new_password';
                $page = 'forgot_pass';
            }
            $this->setTitle($dictionary->get($title));
            $this->setTemplate(url()->toPath('public/layout/template/clear/forgot.php'));
        }
        return view($this->template,[
            'page'=>$page,
            'title'=>$title,
            'css'=>$this->css,
            'js'=>$this->js,
            'title'=>$this->title,
            'urlLogin'=>$this->urlLogin,
            'urlRedirect'=>$this->urlRedirect,
            'dictionary'=>$dictionary,
            'localisations'=>$this->localisation]);
    }
}