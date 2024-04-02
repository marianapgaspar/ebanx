<?php declare(strict_types=1);
namespace System\Configs;
class DataBase{
    private string $host;
    private string $user;
    private string $password;
    private string $database;

    public function __construct(string $host = null,string $user = null,string $password = null,string $database = null)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
    }

    public function setHost(string $host){
        $this->host = $host;
    }
    public function getHost():string{
        return $this->host;
    }

    public function setUser(string $user){
        $this->user = $user;
    }
    public function getUser():string{
        return $this->user;
    }

    public function setPassword(string $password){
        $this->password = $password;
    }
    public function getPassword():string{
        return $this->password;
    }
    public function setDatabase(string $database){
        $this->database = $database;
    }
    public function getDatabase():string{
        return $this->database;
    }

    static function default():DataBase{
        return new DataBase(APP_DB_HOST,APP_DB_USER,APP_DB_PASSWORD,APP_DB_NAME);
    }
}