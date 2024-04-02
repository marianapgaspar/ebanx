<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require "vendor/autoload.php";
require "config.php";
require "system/Tools/Functions.php";
use System\Server\Controller;
use System\Tools\Time;
if(isset($_SERVER['REDIRECT_URL'])){
    $uri = explode('/',trim($_SERVER['REDIRECT_URL'],'/'));
    if($uri && reset($uri) == 'public'){
        include(url()->toPath($_SERVER['REDIRECT_URL']));
        exit;
    }
}
Time::updateDateTime();
$controler = new Controller(isset($_SERVER['REDIRECT_URL'])?$_SERVER['REDIRECT_URL']:'Home',$_SERVER['REQUEST_METHOD']);
$controler->dispatch();

