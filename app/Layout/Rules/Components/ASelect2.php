<?php
namespace App\Layout\Rules\Components;

use System\Models\AModel;

abstract class ASelect2 extends ASelect{
    protected $idSelect2 = "";

    protected bool $ajax = false;
    protected bool $removable = false;

    protected string $searchKey = '';
    protected string $key = '';
    protected string $valueKey = '';
    protected array $selectedOptions = [];

    public function ajax(string $url,string $searchKey, string $key,string $valueKey, bool $removable = false):self{
        $this->ajax = true;
        $this->url = $url;
        $this->searchKey = $searchKey;
        $this->key = $key;
        $this->valueKey = $valueKey;
        $this->removable = $removable;
        return $this;
    }

    public function setSelectedOption(string $value,string $label):self{
        $this->selectedOptions[$value] = $label;
        return $this;
    }
}