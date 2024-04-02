<?php
namespace App\Trigger\Rules;

use App\Layout\Rules\Form\AForm;
use App\Trigger\Models\Triggers;
use System\Models\AModel;

abstract class ATrigger{
    abstract function createForm(AForm $form);

    abstract function dispach(AModel $model,Triggers $trigger);

    abstract function populateModel(Triggers $model,array $post);

    abstract function populateForm(AForm $form,Triggers $model);
}