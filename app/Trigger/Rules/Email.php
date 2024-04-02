<?php

namespace App\Trigger\Rules;

use App\Email\Models\EmailConfig;
use App\Email\Models\Emails;
use App\Layout\Rules\Components\AOrderedMap;
use App\Layout\Rules\Form\AForm;
use App\Trigger\Models\Triggers;
use App\Users\Models\SectorResponsible;
use App\Users\Models\SectorSubordinates;
use App\Users\Models\Users;
use App\Users\Models\UsersGroups;
use System\Models\AModel;

class Email extends ATrigger{
    public function createForm(AForm $form)
    {
        $form->input('email_subject');
        $form->editor('email_body');
        $form->select2('email_config')->addOptionsFromModels(EmailConfig::instance()->result(),'id',function($model){
            return $model->id." - ".$model->name;
        });
        $map = $form->orderedMap('email_copys');
        $map->addOption('email','email')->addOption('users_groups','users_groups')->addOption('model','model')->addOption("setor","setor");
        $map->setMap([AOrderedMap::SELECT_COMPONENT,AOrderedMap::INPUT_COMPONENT]);
        $map = $form->orderedMap('email_attachments');
        $map->addOption('model_array','model_array')->addOption('pre_defined','pre_defined');
        $map->setMap([AOrderedMap::SELECT_COMPONENT,AOrderedMap::INPUT_COMPONENT]);
        $form->showIf('class',Triggers::TRIGGER_CLASS_EMAIL,['email_body','email_copys','email_subject','email_config','email_attachments']);
    }
    public function dispach(AModel $model,Triggers $trigger)
    {
        $object = json_decode($trigger->config);
        $emailList = $this->getEmailList($object->email_copys,$model);
        $modelEmail = Emails::instance();
        $modelEmail->config_id = $object->email_config;
        foreach($emailList as $email){
            if (!$email){
                continue;
            }
            $modelEmail->addAddress($email);
            
        }
        
        $modelEmail->subject(
            // $object->email_subject
            preg_replace_callback('/{[0-9a-zA-Z_]*}/',function($match) use ($model){
                $match = str_replace(['{','}'],'',$match[0]);
                return $model->{$match};
            },$object->email_subject)
        );
        $modelEmail->body(
            preg_replace_callback('/{[0-9a-zA-Z_]*}/',function($match) use ($model){
                $match = str_replace(['{','}'],'',$match[0]);
                return $model->{$match};
            },base64_decode($object->email_body))
        );
        $attachmentList = $object->email_attachments ? $this->getAttachmentsList($object->email_attachments,$model) : [];
        
        foreach($attachmentList as $attachment){
            if (!$attachment){
                continue;
            }
            $file = preg_replace_callback('/{[0-9a-zA-Z_]*}/',function($match) use ($model){
                $match = str_replace(['{','}'],'',$match[0]);
                return $model->{$match};
            },$attachment);
            if (file_exists($file)){
                $modelEmail->addAttachments($file);
            }
        }
        $modelEmail->created_at = date("Y-m-d H:i:s");
        if ($modelEmail->bcc){
            $modelEmail->insert();
        }
        
    }

    private function getEmailList(array $emailsCopys,AModel $model):array{
        $list = [];
        foreach($emailsCopys[0] as $key=>$emailConfig){
            if($emailConfig == 'email'){
                $list[] = $emailsCopys[1][$key];
                continue;
            }
            if($emailConfig == 'model'){
                $methods = explode('.',$emailsCopys[1][$key]);
                $list[] = $model->{$emailsCopys[1][$key]};
                continue;
            }
            if ($emailConfig == 'users_groups'){
                $users = [];
                $usersGroup = UsersGroups::instance()->getByName($emailsCopys[1][$key]);
                if ($usersGroup->id){
                    $users = $usersGroup->getUsers();
                }
                foreach($users as $user){
                    $list[] =$user->email;
                }
            }
            if ($emailConfig == 'setor'){
                $setor = SectorResponsible::instance()->getByName($emailsCopys[1][$key]);
                if (!$setor->responsible_id){
                    continue;
                }
                $subordinados = SectorSubordinates::instance()->getByResponsibleResult($setor->id);
                foreach ($subordinados as $subordinado) {
                    $user = Users::instance()->getById($subordinado->subordinate_id);
                    if ($user->ativo){
                        $list[] = $user->email;
                    }
                }
            }
        }
        return $list;
    }
    private function getAttachmentsList(array $emailAttachments,AModel $model):array{
        $list = [];
        foreach($emailAttachments[0] as $key=>$fileConfig){
            if($fileConfig == 'pre_defined'){
                $list[] = $emailAttachments[1][$key];
                continue;
            }
            if ($model->{$emailAttachments[1][$key]}){
                $docs = explode(';', $model->{$emailAttachments[1][$key]});
                foreach ($docs as $doc){
                    $list[] = $doc;
                }
            }            
        }
        return $list;
    }

    function populateModel(Triggers $model,array $post){
        $object = new \stdClass;
        $object->email_body = base64_encode($post['email_body']);
        $object->email_copys = $post['email_copys'];
        $object->email_config = $post['email_config'];
        $object->email_subject = $post['email_subject'];
        $object->email_attachments = array_key_exists('email_attachments', $post) ? $post['email_attachments'] : "";

        $model->config = json_encode($object);
    }
    function populateForm(AForm $form,Triggers $model){
        $object = json_decode($model->config);
        $form->getInput('email_body')->setValue(base64_decode($object->email_body));
        $form->getInput('email_copys')->setValue($object->email_copys);
        $form->getInput('email_config')->setValue($object->email_config);
        $form->getInput('email_subject')->setValue($object->email_subject);
        if ($object->email_attachments) {
            $form->getInput('email_attachments')->setValue($object->email_attachments);
        }
    }
}