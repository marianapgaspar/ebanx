<?php

namespace App\Layout\Rules\Dashboard;

use App\Layout\Rules\ALayout;
use App\Layout\Rules\Dashboard\Themes\Clear;
use App\Localisation\Rules\Localisation;

abstract class ADashboard extends ALayout{

    protected array $breadcrumb = [];
    protected Menu $menu;
    protected string $contents = '';
    public function __construct()
    {
        parent::__construct();
        $this->dictionary->loadFile('dashboard_menu');
        $this->menu = new Menu();
        $breadcrumb[url()->toRoute('home')] = 'Home';
    }

    public function loadDefaultMenu():self{
        $this->menu = new Menu();
        return $this;
    }

    public function setContents(string $contents):self{
        $this->contents .= $contents;
        return $this;
    }

    public function addBreadcrumb(string $url, string $key):self{
        $breadcrumb[$url] = $this->dictionary->get($key);
        return $this;
    }

}