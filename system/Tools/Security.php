<?php
namespace System\Tools;

class Security{
    private string $salt = "";

    public function __construct(string $salt)
    {
        $this->salt = $salt.bin2hex(openssl_random_pseudo_bytes(22));
    }

    public function encrypt(string $string):string{
        return crypt($string,$this->salt);
    }

    public function verify(string $crypted, string $string):bool{
        return crypt($string, $crypted) == $crypted;
    }



}