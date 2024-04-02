<?php

namespace App\Trigger\Rules;

use App\Layout\Rules\Components\AOrderedMap;
use App\Layout\Rules\Form\AForm;
use App\Trigger\Models\Triggers;
use App\Users\Models\UsersGroups;
use System\Models\AModel;

class Notification extends ATrigger{
    function createForm(AForm $form){
        $form->input('notification_link');
        $form->editor('notification_body');
        $map = $form->orderedMap('notification_users');
        $map->addOption('user','user')->addOption('users_groups','users_groups')->addOption('model','model');
        $map->setMap([AOrderedMap::SELECT_COMPONENT,AOrderedMap::INPUT_COMPONENT]);

        $form->showIf('class',Triggers::TRIGGER_CLASS_NOTIFICATION,['notification_link','notification_body','notification_users']);
    }

    function dispach(AModel $model,Triggers $trigger){

    }

    private function getUsersList(array $emailsCopys,AModel $model):array{
        $list = [];
        foreach($emailsCopys[0] as $key=>$emailConfig){
            if($emailConfig == 'user'){
                $list[] = $emailsCopys[1][$key];
                continue;
            }
            if($emailConfig == 'model'){
                $modelParamns = explode('.',$emailsCopys[1][$key]);
                $list[] = $model->{$emailsCopys[1][$key]};
                continue;
            }
            $users = UsersGroups::instance()->getByName($emailsCopys[1][$key])->getUsers();
            foreach($users as $user){
                $list[] =$user->id;
            }
        }
        return $list;
    }

    function populateModel(Triggers $model,array $post){

    }

    function populateForm(AForm $form,Triggers $model){

    }
}