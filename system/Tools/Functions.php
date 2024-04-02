<?php

use App\Layout\Rules\Factory;
use System\Tools\Session;
use System\Tools\SingleInstances;

function view(string $path, array $paramns = []):string{
    return System\Tools\Utils::view($path,$paramns);
}
function url():System\Tools\Url{
    return new System\Tools\Url(APP_URL,APP_DIR);
}

function security():System\Tools\Security{
    return new System\Tools\Security(APP_SALT);
}

function auth():System\Server\Authentication{
    return new System\Server\Authentication(App\Users\Rules\Authentication\Authentication::class);
}

function session():System\Tools\Session{
    return System\Tools\Session::instance();
}

function response():System\Server\Response{
    return new System\Server\Response();
}

function obfuscateJs(string $js):string{
    return (new \Tholu\Packer\Packer($js, 'Normal', true, false, true))->pack();
}
function layout(string $theme = 'Bracket'):Factory{
    return SingleInstances::getLayout($theme);
}
function uri() {
    return isset($_SERVER['REDIRECT_URL'])? $_SERVER['REDIRECT_URL'] : '';
}
function isProd()
{
    return defined('APP_ENV') && (APP_ENV == 'APP_PROD');

   
}
