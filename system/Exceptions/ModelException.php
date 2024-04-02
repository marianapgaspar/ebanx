<?php
namespace System\Exceptions;
use System\Models\TraitModel;
class ModelException extends \Exception{

    private TraitModel $model;

    public function __construct(string $msg,TraitModel $model)
    {
        parent::__construct($msg);
        $this->model = $model;
    }
    public function getModel():TraitModel{
        return $this->model;
    }
}

