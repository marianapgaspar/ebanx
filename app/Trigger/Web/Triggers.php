<?php
namespace App\Trigger\Web;

use App\Layout\Rules\Buttons\AButton;
use App\Trigger\Models\Triggers as ModelsTriggers;
use App\Trigger\Rules\File;
use App\Trigger\Rules\Triggers as RulesTriggers;
use System\Exceptions\ValidationException;
use System\Server\Entities\Request;

class Triggers{
    public function table(Request $request){
        $dashboard = layout()->dashboard();
        $dashboard->getDictionary()->loadFile('desenvolvedores');

        $table = layout()->table($dashboard);
        $table->setColumns(["id","trigger_class","class"]);
        $table->paginate(ModelsTriggers::instance()->filter($request->gets()),url()->toRoute('trigger/list'),(int)($request->get('page')),100,$request->gets());
        $table->addLink('btn-outline-primary','fas fa-pencil-alt',function($user){
            return url()->toRoute("trigger/update/{$user->id}");
        });
        $table->addButton(layout()->button($dashboard,'add', AButton::BUTTON_PRIMARY)->addAttr('onclick','window.location.href=\''.url()->toRoute('trigger/add')."'")->addAttr('type','button'));
        
        $dashboard->setContents( $table->html());

        response()->html($dashboard->html());
    }

    public function formAdd(){
        $dashboard = layout()->dashboard();
        $dashboard->getDictionary()->loadFile('desenvolvedores');
        $dictionary = $dashboard->getDictionary();

        $form = layout()->form($dashboard,url()->toRoute('trigger/add'),"POST",true);
        $selectTrigger = $form->select2('trigger_class');
        foreach(ModelsTriggers::TRIGGERS as $trigger){
            $selectTrigger->addOption($trigger,$dictionary->get($trigger));
        }
        $selectClass = $form->select2('class');
        foreach(ModelsTriggers::TRIGGERS_CLASSES as $trigger){
            $selectClass->addOption($trigger,$dictionary->get($trigger));
        }
        foreach(RulesTriggers::instance()->getInstances() as $instance){
            $instance->createForm($form);
        }
        $form->button('save',AButton::BUTTON_SUCCESS);
        $dashboard->setContents( $form->html());
        response()->html($dashboard->html());

    }

    public function add(Request $request){
        $instance = ModelsTriggers::instance();
        $instance->trigger_class = $request->post('trigger_class');
        $instance->class = $request->post('class');
        RulesTriggers::instance()->getInstance($request->post('class'))->populateModel($instance,$request->posts());
        try{
            $instance->id = ModelsTriggers::instance()->newId();
            $instance->insert();
            response()->redirect(url()->toRoute('trigger/list'));
        }catch(ValidationException $e){
            response()->json(['errors'=>$e->getErrors()],422);
        }
    }

    public function formUpdate(Request $request,int $id){
        $dashboard = layout()->dashboard();
        $dashboard->getDictionary()->loadFile('desenvolvedores');
        $dictionary = $dashboard->getDictionary();

        $triggerModel = ModelsTriggers::instance()->getById($id);
        $form = layout()->form($dashboard,url()->toRoute('trigger/update/'.$id),"POST",true);
        $selectTrigger = $form->select2('trigger_class');
        foreach(ModelsTriggers::TRIGGERS as $trigger){
            $selectTrigger->addOption($trigger,$dictionary->get($trigger));
        }
        $selectTrigger->setValue($triggerModel->trigger_class);
        $selectClass = $form->select2('class');
        foreach(ModelsTriggers::TRIGGERS_CLASSES as $trigger){
            $selectClass->addOption($trigger,$dictionary->get($trigger));
        }
        $selectClass->setValue($triggerModel->class);

        foreach(RulesTriggers::instance()->getInstances() as $key=>$instance){
            $instance->createForm($form);
            if($key == $triggerModel->class){
                $instance->populateForm($form,$triggerModel);
            }
        }
        $form->button('save',AButton::BUTTON_SUCCESS);
        $form->link('list',url()->toRoute('trigger/list'), AButton::BUTTON_SUCCESS);   
        $dashboard->setContents( $form->html());
        response()->html($dashboard->html());
    }
    public function update(Request $request,int $id){
        $instance = ModelsTriggers::instance()->getById($id);
        $instance->trigger_class = $request->post('trigger_class');
        $instance->class = $request->post('class');
        RulesTriggers::instance()->getInstance($request->post('class'))->populateModel($instance,$request->posts());
        try{
            $instance->save();
            response()->json(['success'=>true]);
        } catch (ValidationException $e){
            response()->json(['errors'=>$e->getErrors()],422);
        }
    }


}