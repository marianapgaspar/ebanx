<?php
namespace System\Exceptions;
class SqlConnectionException extends \Exception{
    public function __construct(string $messageSql = "", int $code = 0)
    {
        $message = "Erro de conexão mysql \n";
        $message .= "Número:$code\n";
        $message .= "Mensagem:$messageSql\n";
        parent::__construct($message, $code);
    }
}