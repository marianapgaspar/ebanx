<?php

namespace App\Layout\Rules\Themes\AdminLTE;

use App\Layout\Interfaces\ITheme;
use App\Layout\Rules\Login\ALogin;
use App\Localisation\Rules\Localisation;

class Login extends ALogin{
    function prepare(){
        $this->addCss(url()->toRoute('public/common/css/app.css'));

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
        return view($this->template,[
            'css'=>$this->css,
            'js'=>$this->js,
            'title'=>$this->title,
            'urlLogin'=>$this->urlLogin,
            'urlRedirect'=>$this->urlRedirect,
            'dictionary'=>$dictionary,
            'localisations'=>$this->localisation]);
    }
}