<?php
namespace System\Tools;

class Session{

    private static $session = null;
    public function prepare(){
        session_start();
    }

    public function get(string $key){
        return isset($_SESSION[$key])?$_SESSION[$key]:null;
    }

    public function set(string $key,string $value){
        $_SESSION[$key] = $value;
    }

    public static function instance(){
        if(self::$session !== null){
            return self::$session;
        }
        self::$session =  new Session;
        self::$session->prepare();
        return self::$session;
    }
    
}