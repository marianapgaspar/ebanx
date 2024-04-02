<?php
namespace System\Models\Validations;

use System\Models\AModel;

abstract class AValidation{

    protected string $message = '';

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    abstract function validate(string|int|float|AModel|null $data,AModel $model,string $field, array &$errors):bool;

    public function getMessage():string{
        return $this->message;
    }
    public static function instance(string $message):self{
        $class = get_called_class();
        return new $class($message);
    }
}