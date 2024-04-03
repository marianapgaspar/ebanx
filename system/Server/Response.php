<?php
namespace System\Server;
class Response{

    const HTTP_STATUS = [
        '422'=>'422 Unprocessable Entity',
        '404'=>'404 Not Found',
        '401'=>'401 Unauthorized',
        '403'=>'403 Forbidden',
        '200'=>'200 OK',
        '500'=>'500 Internal Server Error'
    ];
    public function html($contents, $httpCode = 200){
        header($_SERVER['SERVER_PROTOCOL'] . ' '.self::HTTP_STATUS[$httpCode], true, $httpCode);
        exit($contents);
    }

    public function json($contents, $httpCode = 200){
        header($_SERVER['SERVER_PROTOCOL'] . ' '.self::HTTP_STATUS[$httpCode], true, $httpCode);
        header('Content-Type: application/json');
        exit($contents);
    }

    public function redirect($url){
        header("Location: $url");
        exit;
    }
    
}