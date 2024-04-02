<?php 

namespace App\Users\Rules;

use App\Emitente\Models\Emitentes;
use App\Helpers\Models\Estabelec;
use App\Helpers\Models\Repres;
use App\Layout\Rules\Buttons\AButton;
use App\Layout\Rules\Components\AOrderedMap;
use App\Layout\Rules\Form\AForm;
use App\Users\Models\Sector;
use App\Users\Models\SectorResponsible;
use App\Users\Models\Users;
use System\Server\Entities\Auth;

class UserForm{
    private AForm $form;
    public function __construct(AForm $form)
    {
        $this->form = $form;
    }

    public function createForm(Auth $auth){
        $this->form->input('name',3)->addAttr('placeholder', 'Nome do usuário')->addAttr('maxlength',12);
        $this->form->input('nome_completo',3)->addAttr('maxlength',50);
        $this->form->input('email',3)->addAttr('type','email')->addAttr('maxlength', 40);
        $this->form->input('telefone',3)->addAttr("type", "text")->addAttr("maxlength", 20);
        
        $this->form->input('password',2)->addAttr('type','password');
        $this->form->input('password_repeat',2)->addAttr('type','password');
        $this->form->input('lembrete_senha',2);
        if ($auth->hasScope(Scopes::USERS)){
            $this->form->input('qt_dias_senha',2)->addAttr('type','number');
            $this->form->orderedMap('cod_estabel', 4)->addOption('', '--Selecione--')->addOptionsFromModels(Estabelec::instance()->result(),'cod_estabel',function($data){
                return $data->cod_estabel." - ".$data->nome;
            })->setMap([AOrderedMap::SELECT_COMPONENT]);
            $this->form->select('departamento_subordinado')->addOption('','--Selecione seu departamento--')->addOptionsFromModels(SectorResponsible::instance()->result(),'id',function($data){
                return $data->name." - ".Users::instance()->getById($data->responsible_id)->name;
            });
            $this->form->select2('id_group',3)
                ->ajax(url()
                ->toRoute('users/users-groups/get'),'name','id','name');
            $this->form->radio('ativo',3)->setFields(['Sim','Não'])->setValues('Sim');

            $this->form->append("linha",12)->setBody("<br><br><h5>Representantes</h5><hr>");
            $this->form->select2('cod_rep', 3)->addOption('', '--Selecione--')->addOptionsFromModels(Repres::instance()->result(),'cod_rep',function($data){
                return $data->cod_rep." - ".$data->nome;
            });
            $this->form->input("perc_desc_max",3)->addAttr("type", "number");
            $this->form->input("qtd_dias_prazo_medio_max",3)->addAttr("type", "number");
            $this->form->append("linha2")->setBody("<br><br><br><h5>Fornecedores</h5><hr>");
            $this->form->append("nada")->setBody("");

            $this->form->select2('cod_at', 3)->ajax(url()->toRoute('Emitente/getFornec'),'cod_emitente','cod_emitente','cod_emitente+" - "+item.nome_abrev', true);
            $this->form->select2('cod_fornecedor', 3)->ajax(url()->toRoute('Emitente/getFornec'),'cod_emitente','cod_emitente','cod_emitente+" - "+item.nome_abrev', true);
            
            $this->form->append("linha3",12)->setBody("<br><br><br><h5>Limites de compras</h5><hr>");
            $this->form->select("gerente",3)->addOption(0,"Não")->addOption(1,"Sim");
            $this->form->select("comprador",3)->addOption(0,"Não")->addOption(1,"Sim");
            $this->form->input("vlr_max_ped",3)->addAttr("type","number");
            $this->form->input("vlr_max_mes",3)->addAttr("type","number");
        }
    }

    public function addLinks(Users $user = null){
        $this->form->link('list',url()->toRoute('users/list'), AButton::BUTTON_SUCCESS);   
        if($user->id){
            $this->form->link('log',url()->toRoute('users/log/list/'.$user->id), AButton::BUTTON_SUCCESS);     
        }
          
    }

    public function addButtons(Users $user = null){
        if($user->id)
            $this->form->button('edit',AButton::BUTTON_WARNING); 
            else
            $this->form->button('save',AButton::BUTTON_SUCCESS);   
    }

    public function createScript(){
        $this->form->getLayout()->addScript('
        $("[name=password],[name=password_repeat]").on("change",function(){
            var pass_act = $("[name=password]").val();
            var pass_rep = $("[name=password_repeat]").val();     
            if(pass_act.length > 0 &&  pass_rep.length > 0 && pass_rep !=  pass_act){
                alert("Senhas diferentes");
                pass_rep.val("");
            } 
        });
        $("[name=comprador],[name=gerente]").on("change",function(){
            if($(this).val() == 1){
                $("#componente_vlr_max_ped").show();
                $("#componente_vlr_max_mes").show();
            } else {
                $("#componente_vlr_max_ped").hide()
                $("#componente_vlr_max_mes").hide()
            }
        });
        if($("[name=comprador]").val() == 1 || $("[name=gerente]").val() == 1){
            $("#componente_vlr_max_ped").show();
            $("#componente_vlr_max_mes").show();
        } else {
            $("#componente_vlr_max_ped").hide()
            $("#componente_vlr_max_mes").hide()
        }
       
        ');
    }
    public static function instance(AForm $form):UserForm{
        return new UserForm($form);
    }
}