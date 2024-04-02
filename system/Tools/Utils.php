<?php
namespace System\Tools;

class Utils{
    public static function view(string $path, array $paramns = []){
        extract($paramns);
        $view = '';
        ob_start();
        require $path;
        $view = ob_get_contents();
        ob_end_clean();
        return $view;
    }
}