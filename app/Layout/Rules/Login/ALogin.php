<?php
namespace App\Layout\Rules\Login;

use App\Layout\Rules\ALayout;

abstract class ALogin extends ALayout{

    protected string $urlLogin = "";
    protected bool $pageForgot = false;
    protected bool $formForgot = false;
    protected string $urlRedirect = "";   

    public function setUrlLogin(string $urlLogin):self{
        $this->urlLogin = $urlLogin;
        return $this;
    }
    public function setPageForgot(bool $bool):self{
        $this->pageForgot = $bool;
        return $this;
    }
    public function setFormForgot(bool $bool):self{
        $this->formForgot = $bool;
        return $this;
    }
    public function setUrlRedirect(string $urlRedirect):self{
        $this->urlRedirect = $urlRedirect;
        return $this;
    }

    public function setLocalisations(array $localisations):self{
        $this->localisation = $localisations;
        return $this;
    }
}