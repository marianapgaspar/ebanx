<?php
namespace App\Layout\Rules\Dashboard;

use App\Layout\Models\Menu as ModelsMenu;
use App\Layout\Rules\AMenu;

class Menu extends AMenu{
    


    public function __construct()
    {
        $this->prepare();
    }

  

    private function prepare(){
        $classes = $this->getMenusClasses();
        ksort($classes);
        foreach($classes as $class){
            $class->load($this);
        }
    }

    private function getMenusClasses():array{
        $files = glob(APP_DIR."/app/*/Menus/Dashboard.php");
        $classes = [];
        foreach($files as $file){
            $file = str_replace(APP_DIR."/app/",'',$file);
            $path = explode('/',$file);
            $className = "App\\{$path[0]}\Menus\Dashboard";
            $classes[$className] = new $className;
        }
        return $classes;
    }
}