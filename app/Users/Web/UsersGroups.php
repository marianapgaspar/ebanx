<?php
namespace App\Users\Web;

use App\Layout\Rules\Buttons\AButton;
use App\Layout\Rules\Components\Buttons\Button;
use App\Layout\Rules\Components\Form\AjaxForm;
use App\Layout\Rules\Components\Table\Table;
use App\Layout\Rules\Dashboard\Dashboard;
use App\Users\Models\Users;
use App\Users\Models\UsersGroups as ModelsUsersGroups;
use App\Users\Rules\Scopes;
use System\Exceptions\ValidationException;
use System\Server\Entities\Request;

class UsersGroups{

    public function table(Request $request){
        $dashboard = layout()->dashboard();
        $dashboard->getDictionary()->loadFile('users');
        $dashboard->setTitle($dashboard->getDictionary()->get("group"));
        $table = layout()->table($dashboard);

        $table->setColumns(['id','name']);
        $table->searchFields(['id','name']);
        $table->paginate(ModelsUsersGroups::instance(),url()->toRoute('users/users-groups/list'),(int)$request->get("page"),10,$request->gets());
        $table->addButton(layout()->button($dashboard,'add',AButton::BUTTON_PRIMARY)
            ->addAttr('onclick','window.location.href=\''.url()->toRoute('users/users-groups/form')."'")
            ->addAttr('type','button'));
        $table->addLink('btn-info','fas fa-pencil-alt',function($user){
            return url()->toRoute("users/users-groups/form/{$user->id}");
        });

        $table->addLink('btn-outline-secondary','fas fa-trash',function($user){
            return url()->toRoute("users/users-groups/delete/{$user->id}");
        },function($user){
            return "Deseja deletar este grupo?";
        },function($user){
            if (!empty(Users::instance()->getIdGroup($user->id))) {
                return false;
            } else {
                return true;
            }
        });

        $table->addButton(layout()->button($dashboard,'users', AButton::BUTTON_OUTLINE_SECONDARY)->addAttr('onclick','window.location.href=\''.url()->toRoute('users/list')."'")->addAttr('type','button'));
        $dashboard->setContents( $table->html());

        response()->html($dashboard->html());
    }

    public function formAdd(){
        $dashboard = layout()->dashboard();
        $dashboard->getDictionary()->loadFile('users');
        $dashboard->setTitle($dashboard->getDictionary()->get("scopes"));
        $dashboard->addBreadcrumb(url()->toRoute('users/users-groups/list'), "scopes")
            ->addBreadcrumb(url()->toRoute('users/users-groups/form'), "add");
            
        
        $form = layout()->form($dashboard,url()->toRoute('users/users-groups/add'),"POST",true)->setAjax(true);
        $form->input('name',12);

        $form->checkbox('scopes_configuracoes_portal',3)->setFields(array_combine(Scopes::getScopesByTheme('CONFIGURACOES-PORTAL'),Scopes::getScopesByTheme('CONFIGURACOES-PORTAL')));
        $form->checkbox('scopes_clientes',3)->setFields(array_combine(Scopes::getScopesByTheme('CLIENTES'),Scopes::getScopesByTheme('CLIENTES')));
        $form->checkbox('scopes_treinamentos',3)->setFields(array_combine(Scopes::getScopesByTheme('TREINAMENTOS'),Scopes::getScopesByTheme('TREINAMENTOS')));
        $form->checkbox('scopes_manufatura',3)->setFields(array_combine(Scopes::getScopesByTheme('MANUFATURA'),Scopes::getScopesByTheme('MANUFATURA')));
        $form->checkbox('scopes_metas',3)->setFields(array_combine(Scopes::getScopesByTheme('METAS'),Scopes::getScopesByTheme('METAS')));
        $form->checkbox('scopes_pedidos',3)->setFields(array_combine(Scopes::getScopesByTheme('PEDIDOS'),Scopes::getScopesByTheme('PEDIDOS')));
        $form->checkbox('scopes_engenharia',3)->setFields(array_combine(Scopes::getScopesByTheme('ENGENHARIA'),Scopes::getScopesByTheme('ENGENHARIA')));
        $form->checkbox('scopes_compras',3)->setFields(array_combine(Scopes::getScopesByTheme('COMPRAS'),Scopes::getScopesByTheme('COMPRAS')));
        $form->checkbox('scopes_qualidade',3)->setFields(array_combine(Scopes::getScopesByTheme('QUALIDADE'),Scopes::getScopesByTheme('QUALIDADE')));
        $form->checkbox('scopes_assistencia',3)->setFields(array_combine(Scopes::getScopesByTheme('ASSISTENCIA'),Scopes::getScopesByTheme('ASSISTENCIA')));

        $form->button('save',AButton::BUTTON_SUCCESS);
        $form->link('Lista',url()->toRoute('users/users-groups/list'),AButton::BUTTON_SUCCESS);        
        
       
        $dashboard->setContents( $form->html());

        response()->html($dashboard->html());
    }

    public function add(Request $request){
        $user = ModelsUsersGroups::instance();     
        $user->name = $request->post('name');
        
        //escopos        
        $scopes_configuracoes_portal  = is_null($request->post('scopes_configuracoes_portal'))  ? array() : (array)($request->post('scopes_configuracoes_portal'));
        $scopes_clientes  = is_null($request->post('scopes_clientes'))  ? array() : (array)($request->post('scopes_clientes'));
        $scopes_treinamentos  = is_null($request->post('scopes_treinamentos'))  ? array() : (array)($request->post('scopes_treinamentos'));
        $scopes_manufatura  = is_null($request->post('scopes_manufatura'))  ? array() : (array)($request->post('scopes_manufatura'));
        $scopes_metas  = is_null($request->post('scopes_metas'))  ? array() : (array)($request->post('scopes_metas'));
        $scopes_pedidos  = is_null($request->post('scopes_pedidos'))  ? array() : (array)($request->post('scopes_pedidos'));
        $scopes_engenharia  = is_null($request->post('scopes_engenharia'))  ? array() : (array)($request->post('scopes_engenharia'));
        $scopes_compras  = is_null($request->post('scopes_compras'))  ? array() : (array)($request->post('scopes_compras'));
        $scopes_qualidade  = is_null($request->post('scopes_qualidade'))  ? array() : (array)($request->post('scopes_qualidade'));
        $scopes_qualidade  = is_null($request->post('scopes_assistencia'))  ? array() : (array)($request->post('scopes_assistencia'));
        $scopes_home = ['home'];
   
        $scopes =  array_merge($scopes_configuracoes_portal??[], $scopes_clientes??[],  $scopes_treinamentos??[],  $scopes_manufatura??[],  $scopes_metas??[],  $scopes_engenharia??[],  $scopes_pedidos??[],  $scopes_compras??[],  $scopes_qualidade??[], $scopes_home);        
        $user->prepareScopes($scopes);
      
        try{
            $user->validate();
        }catch(ValidationException $e){
            response()->json(['errors'=>$e->getErrors()],422);
        }
        $user->id = ModelsUsersGroups::instance()->getLast()+1; 
        $user->insert();
        response()->json(['success'=>true]);
    }

    
    public function formUpdate(Request $request,int $id):void{
        $user = ModelsUsersGroups::instance()->getById($id);

        $dashboard = layout()->dashboard();        
        $dashboard->getDictionary()->loadFile('users');
        $dashboard->setTitle("Alterar grupo - ".$user->name);
        
        $form = layout()
            ->form($dashboard,url()
            ->toRoute('users/users-groups/update/'.$id),"POST",true)
            ->setAjax(true);
            
        $form->input('name',12);
        $form->checkbox('scopes_configuracoes_portal',3)
            ->setValue(explode(' ',$user->scope))
            ->setFields(array_combine(Scopes::getScopesByTheme('CONFIGURACOES-PORTAL'),Scopes::getScopesByTheme('CONFIGURACOES-PORTAL')));

        $form->checkbox('scopes_clientes',3)
            ->setValue(explode(' ',$user->scope))
            ->setFields(array_combine(Scopes::getScopesByTheme('CLIENTES'),Scopes::getScopesByTheme('CLIENTES')));
        
        $form->checkbox('scopes_treinamentos',3)
            ->setValue(explode(' ',$user->scope))
            ->setFields(array_combine(Scopes::getScopesByTheme('TREINAMENTOS'),Scopes::getScopesByTheme('TREINAMENTOS')));
        
         $form->checkbox('scopes_manufatura',3)
            ->setValue(explode(' ',$user->scope))
            ->setFields(array_combine(Scopes::getScopesByTheme('MANUFATURA'),Scopes::getScopesByTheme('MANUFATURA')));

        $form->checkbox('scopes_metas',3)
            ->setValue(explode(' ',$user->scope))
            ->setFields(array_combine(Scopes::getScopesByTheme('METAS'),Scopes::getScopesByTheme('METAS')));

        $form->checkbox('scopes_pedidos',3)
        ->setValue(explode(' ',$user->scope))
        ->setFields(array_combine(Scopes::getScopesByTheme('PEDIDOS'),Scopes::getScopesByTheme('PEDIDOS')));

        $form->checkbox('scopes_engenharia',3)
            ->setValue(explode(' ',$user->scope))
            ->setFields(array_combine(Scopes::getScopesByTheme('ENGENHARIA'),Scopes::getScopesByTheme('ENGENHARIA')));

        $form->checkbox('scopes_compras',3)
            ->setValue(explode(' ',$user->scope))
            ->setFields(array_combine(Scopes::getScopesByTheme('COMPRAS'),Scopes::getScopesByTheme('COMPRAS')));
        
        $form->checkbox('scopes_qualidade',3)
            ->setValue(explode(' ',$user->scope))
            ->setFields(array_combine(Scopes::getScopesByTheme('QUALIDADE'),Scopes::getScopesByTheme('QUALIDADE')));

        $form->checkbox('scopes_assistencia',3)
            ->setValue(explode(' ',$user->scope))
            ->setFields(array_combine(Scopes::getScopesByTheme('ASSISTENCIA'),Scopes::getScopesByTheme('ASSISTENCIA')));
        
        

        $form->loadData($user);
        $form->button('save',AButton::BUTTON_SUCCESS);
        $form->link('Lista',url()->toRoute('users/users-groups/list'),AButton::BUTTON_SUCCESS);   
        $form->link('users-group',url()->toRoute('users/users-groups/form/'.$id),AButton::BUTTON_SUCCESS);   

        $dashboard->setContents( $form->html());
        response()->html($dashboard->html());
    }

    public function update(Request $request,int $id):void{
        $user = ModelsUsersGroups::instance()->getById($id);
        $user->setName($request->post('name'));
        //escopos
        $scopes_configuracoes_portal = (array)($request->post('scopes_configuracoes_portal'));
        $scopes_clientes = (array)($request->post('scopes_clientes'));
        $scopes_treinamentos = (array)($request->post('scopes_treinamentos'));
        $scopes_manufatura = (array)($request->post('scopes_manufatura'));
        $scopes_metas = (array)($request->post('scopes_metas'));
        $scopes_pedidos = (array)($request->post('scopes_pedidos'));
        $scopes_engenharia = (array)($request->post('scopes_engenharia'));
        $scopes_compras = (array)($request->post('scopes_compras'));
        $scopes_qualidade = (array)($request->post('scopes_qualidade'));
        $scopes_assistencia = (array)($request->post('scopes_assistencia'));
        $scopes_home = ['home'];
        $scopes =  array_merge($scopes_configuracoes_portal, $scopes_clientes, $scopes_treinamentos,$scopes_manufatura,$scopes_metas,$scopes_engenharia,$scopes_pedidos,$scopes_compras,$scopes_qualidade,$scopes_home,$scopes_assistencia); 
               
        $user->prepareScopes($scopes);
        try{
            $user->validate();
            $user->save();       
            response()->json(['success'=>true]);
        }catch(ValidationException $e){
            response()->json(["errors"=>$e->getErrors()],422);
        }
    }

    public function delete (Request $request, int $id): void{
        try {
            ModelsUsersGroups::instance()->getById($id)->delete();
            response()->redirect(url()->toRoute('users/users-groups/list'));
        } catch(ValidationException $e){
            response()->json(["errors"=>$e->getErrors()],422);
        } 
    }

    public function get(Request $request){
        $representantes = ModelsUsersGroups::instance();
        $representantes->query()->like('name',"%".$request->get('name')."%")->where("name","<>","Desenvolvedores");
        $representantes->query()->limit(10);
        $data = $representantes->result();
        $return = [];
        foreach($data as $row){
            $return[] = $row->toArray();
        }
        response()->json($return,200);
    }    
}