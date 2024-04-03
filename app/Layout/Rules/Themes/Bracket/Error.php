<?php

namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Rules\Errors\AErrors;

class Error extends AErrors {
    function prepare(){
        $this->addCss(url()->toRoute('public/common/css/error.css'));
        $this->setTitle('Login');
        $this->setTemplate(url()->toPath('public/layout/template/error/error.php'));
    }

    public function html():string{
        return view($this->template,[
            'css'=>$this->css,
            'js'=>$this->js,
            'text'=>$this->title,
            'error'=>$this->error,            
            'dictionary'=>$this->dictionary]);
    }    
}