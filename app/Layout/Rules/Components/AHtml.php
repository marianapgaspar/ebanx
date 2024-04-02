<?php 

namespace App\Layout\Rules\Components;

use App\Layout\Rules\Components\AInput;

abstract class AHtml extends AInput {
    protected string $body = '';

    public function setBody(string $body):self {
        $this->text = $body;
        return $this;
    }
}