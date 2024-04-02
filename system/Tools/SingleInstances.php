<?php
namespace System\Tools;

use App\Layout\Rules\Factory;

class SingleInstances{
    private static $layoutFactory = null;

    public static function getLayout(string $theme = 'AdminLTE'):Factory{
        if(is_null(self::$layoutFactory)){
            self::$layoutFactory = new Factory($theme);
        }
        return self::$layoutFactory;
    }
}
