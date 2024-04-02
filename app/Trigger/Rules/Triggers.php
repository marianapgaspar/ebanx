<?php
namespace App\Trigger\Rules;

use App\Trigger\Models\Triggers as ModelsTriggers;
use System\Models\AModel;

class Triggers{
    public function getInstances():array{
        return [
            ModelsTriggers::TRIGGER_CLASS_FILE=>new File(),
            ModelsTriggers::TRIGGER_CLASS_EMAIL=>new Email()
        ];
    }

    public function getInstance(string $key):ATrigger{
        switch($key){
            case ModelsTriggers::TRIGGER_CLASS_EMAIL:
                return new Email();
            case ModelsTriggers::TRIGGER_CLASS_FILE:
                return new File();
        }
    }

    public function dispachTriggers(string $triger,AModel $model){
        $triggers = ModelsTriggers::instance()->getByTrigger($triger);
        foreach($triggers as $triggerModel){
            $this->getInstance($triggerModel->class)->dispach($model,$triggerModel);
        }
    }

    public static function instance():self{
        return new Triggers();
    }
}