<?php
namespace System\Exceptions;
class SqlException extends \Exception{
    private string $sql;
    public function __construct(string $messageSql = "", int $code = 0,string $sql="")
    {

        $this->sql = $sql;
        $message = "Erro na consulta\n";
        $message .= "Número:$code\n";
        $message .= "Mensagem:$messageSql\n";
        $message .= "Query:$sql\n";
        parent::__construct($message, $code);
    }
}