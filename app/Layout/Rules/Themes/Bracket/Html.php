<?php

namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Rules\Components\AHtml;

class Html extends AHtml{
    public function html():string{
        return $this->text;
    }
}