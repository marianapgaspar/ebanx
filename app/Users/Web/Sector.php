<?php

namespace App\Users\Web;

use App\Layout\Rules\Buttons\AButton;
use App\Users\Models\Sector as ModelsSector;
use App\Users\Models\SectorResponsible;
use App\Users\Models\SectorSubordinates;
use App\Users\Models\Users;
use System\Exceptions\ValidationException;
use System\Server\Entities\Request;

class Sector
{
    public function table(Request $request)
    {
        $dashboard = layout()->dashboard();
        $dashboard->getDictionary()->loadFile('modulos');

        $table = layout()->table($dashboard);
        $table->setColumns(["id","name","responsible_id"]);
        $table->searchFields(["id","name","responsible_id"]);
        $table->paginate(SectorResponsible::instance(),url()->toRoute('users/sector/list'),(int) $request->get('page'),10,$request->gets());

        $table->addLink('btn-outline-primary','fas fa-pencil-alt',function($model){
            return url()->toRoute("users/sector/form/{$model->id}");
        });

        $table->addLink('btn-outline-secondary','fas fa-trash',function($model){
            return url()->toRoute("users/sector/delete/{$model->id}");
        },function($model){
            return "deseja deletar o setor: ".$model->name;
        }, function($model){
            if (!empty(SectorSubordinates::instance()->getByResponsibleResult($model->id))) {
                return false;
            } else {
                return true;
            }
        });

        $table->addCallback('responsible_id', function($column){
            if ($column){
                return Users::instance()->getById($column)->nome_completo;
            }
            return "";
        });
        $table->addButton(layout()->button($dashboard,'add', AButton::BUTTON_PRIMARY)->addAttr('onclick','window.location.href=\''.url()->toRoute('users/sector/form')."'")->addAttr('type','button'));
        
        $dashboard->setContents($table->html());

        response()->html($dashboard->html());
    }

    public function addForm()
    {
        $dashboard = layout()->dashboard();
        $dashboard->getDictionary()->loadFile('modulos');

        $form = layout()->form($dashboard,url()->toRoute('users/sector/add'),"POST",true)->setAjax(true);
        $form->input('name',6);
        $form->select2('responsible_id',6)->addOptionsFromModels(Users::instance()->result(), 'id','nome_completo');
        $form->button('save',AButton::BUTTON_SUCCESS);
        $form->link('list',url()->toRoute('users/sector/list'), AButton::BUTTON_SUCCESS); 

        $dashboard->setContents($form->html());

        response()->html($dashboard->html());

    }
    public function add(Request $request):void{
        $user = SectorResponsible::instance();
        $user->setValues($request->posts());
        try{
            $user->insert();
            response()->json(['success'=>true],200);
        }catch(ValidationException $e){
            response()->json(["errors"=>$e->getErrors()],422);
        }
    }

    public function updateForm(Request $request,int $id)
    {

        $sector = SectorResponsible::instance()->getById($id);
        $dashboard = layout()->dashboard();
        $dashboard->getDictionary()->loadFile('modulos');

        $form = layout()->form($dashboard,url()->toRoute('users/sector/update/'.$id),"POST",true);
        $form->input('name',6);
        $form->select2('responsible_id',6)->addOptionsFromModels(Users::instance()->result(), 'id','nome_completo');

        $form->loadData($sector);

        $form->link('list',url()->toRoute('users/sector/list'), AButton::BUTTON_SUCCESS); 
        $form->link('sector',url()->toRoute('users/sector/form/'.$id), AButton::BUTTON_SUCCESS); 
        $form->button('save',AButton::BUTTON_SUCCESS);


        $dashboard->setContents($form->html());
        response()->html($dashboard->html());

    }
    public function update(Request $request,int $id):void{
        $user = SectorResponsible::instance()->getById($id);
        $user->setValues($request->posts());
        try{
            $user->save();
            
        }catch(ValidationException $e){
            response()->json(["errors"=>$e->getErrors()],422);
        }
        response()->json(['success'=>true],200);
    }
    public function delete (Request $request, int $id): void{
        try {
            SectorResponsible::instance()->getById($id)->delete();
            response()->redirect(url()->toRoute('users/sector/list'));
        } catch(ValidationException $e){
            response()->json(["errors"=>$e->getErrors()],422);
        } 
    }
}