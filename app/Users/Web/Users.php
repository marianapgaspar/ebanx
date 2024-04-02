<?php
namespace App\Users\Web;

use App\Emitente\Models\Emitentes;
use App\Helpers\Models\Repres;
use App\Layout\Rules\Buttons\AButton;
use App\Users\Models\SectorResponsible;
use App\Users\Models\SectorSubordinates;
use App\Users\Rules\UserForm;
use App\Users\Models\Users as UsersModel;
use App\Users\Models\UsersGroups;
use App\Users\Models\UsersLog;
use App\Users\Rules\Scopes;
use System\Exceptions\ValidationException;
use System\Server\Entities\Request;

class Users{

    public function table(Request $request):void{
        $dashboard = layout()->dashboard();
        $dashboard->getDictionary()->loadFile('users');
        $dashboard->setTitle($dashboard->getDictionary()->get("users"));
        $dashboard->addBreadcrumb(url()->toRoute('users'), "users");
        //Instanciando tabela
        $table = layout()->table($dashboard);
        $table->setColumns(['id','email','name','id_group','ativo']);
        $table->searchFields(['id','email','name']);
        $table->setOrdenableColumns(['id','email','name','id_group','ativo']);
        //criando filtros
        $filter = $table->filter(url()->toRoute('users/list'));
        $filter->input('name',2);
        $filter->select2('Permissões',2)->ajax(url()->toRoute('users/users-groups/get'),'name','id','name');
        $filter->select2('sector',2)->addOption('','--Selecione--')->addOptionsFromModels(SectorResponsible::instance()->result(),'id','name');
        $filter->select2('cod_rep', 3)->addOption('', '--Selecione--')->addOptionsFromModels(Repres::instance()->result(),'cod_rep',function($data){
            return $data->cod_rep." - ".$data->nome;
        });
        $filter->select2('cod_at', 3)->ajax(url()->toRoute('Emitente/getFornec'),'cod_emitente','cod_emitente','cod_emitente+" - "+item.nome_abrev', true);
        $filter->select2('cod_fornecedor', 3)->ajax(url()->toRoute('Emitente/getFornec'),'cod_emitente','cod_emitente','cod_emitente+" - "+item.nome_abrev', true);
      
        $filter->loadDataArray($request->gets());
        $users = UsersModel::instance()->filter($request->gets());
        if ($request->get('sector')){
            $users->getSuborinadosBySector($request->get('sector'));
        }
        if ($request->get('Permissões')){
            $users->query()->where("id_group","=",$request->get("Permissões"));
        }
        /*$users->get();
        var_dump($users->query()->lastQuery());
        die;*/
        //Aplicando paginação e filtros
        $table->paginate($users,url()->toRoute('users/list'),(int)($request->get('page')),100,$request->gets());

        $table->addCallback('ativo',function($column){
            if ($column == 0){
                return '<button class="btn btn-danger rounded-circle btn-xs"><i class="fa fa-close"></i></button>';
            } else{
                return '<button class="btn btn-success rounded-circle btn-xs"><i class="fa fa-check"></i></button>';
            } 
        });

        //adicionando links laterais
        $table->addLink('btn-outline-primary','fas fa-pencil-alt',function($user){
            return url()->toRoute("users/form/{$user->id}");
        });
        $table->addLink('btn-outline-secondary','fas fa-file',function($model){
            return "javascript:getModal(".$model->id.")";
        });
        $table->addLink('btn-outline-secondary','fas fa-trash',function($user){
            return url()->toRoute("users/delete/{$user->id}");
        },function($user){
            return "deseja deletar o usuario: ".$user->name;
        },function($user){
            if (SectorResponsible::instance()->getByResponsible($user->id)->sector_id > 0) {
                return false;
            } else {
                return true;
            }
        });

        
        //Adicionando callback na coluna (substitui o dado)
        $table->addCallback('id_group',function($column){
            return UsersGroups::instance()->getById($column)->name;
        });

        //adicionando Botões
        $table->addButton(layout()->button($dashboard,'add', AButton::BUTTON_PRIMARY)->addAttr('onclick','window.location.href=\''.url()->toRoute('users/form')."'")->addAttr('type','button'));

        $modal = layout()->modal($dashboard);    
        $modal->setTitle('Confirma a cópia do usuário');
        $modal->setId('copy');
        $modal->setSize('lg');//md//sm//lg//full  
        $form = layout()->form($dashboard,url()->toRoute("Users/copy"),"POST",true)->setAjax(true);
        $form->input("user_name",12)->addAttr("maxlength",12);  
        $form->input("email",12)->addAttr('type','email')->addAttr('maxlength', 40);  
        $form->hidden("user_id",12);  
        $form->button("save",AButton::BUTTON_INFO);

        $modal->setBody($form->html());  
        $modal->getLayout()->addScript('
        function getModal(user_id){
            $("#copy").modal({
                show: true
            });
            $("[name=user_id]").val(user_id)
        }
        ');
        $dashboard->setContents( $table->html().$modal->html());
        response()->html($dashboard->html());
    }

    /**
     * Formulario add
     *
     * @return void
     */
    public function formAdd(Request $request):void{
        $user = UsersModel::instance();
        $dashboard = layout()->dashboard();
        $dashboard->getDictionary()->loadFile('users');
        $dashboard->setTitle($dashboard->getDictionary()->get("add"));
        $dashboard->addBreadcrumb(url()->toRoute('users'), "users")
            ->addBreadcrumb(url()
            ->toRoute('users/form'), "add");

        $form = layout()->form($dashboard,url()->toRoute('users/add'),"POST",false)->setAjax(true);
        $formRules = UserForm::instance($form);
        $formRules->createForm($request->getAuth());
        $formRules->addLinks($user);
        $formRules->addButtons($user);

        $dashboard->setContents($form->html());
        response()->html($dashboard->html());
    }

    
    public function formUpdate(Request $request,int $id):void{
        $user = UsersModel::instance()->getById($id);
        $grp = UsersGroups::instance()->getById($user->id_group);

        $dashboard = layout()->dashboard();                
        $dashboard->getDictionary()->loadFile('users');
        $dashboard->setTitle($dashboard->getDictionary()->get("edit").' - '.$user->name);
        $dashboard->addBreadcrumb(url()->toRoute('users'), "users")->addBreadcrumb(url()->toRoute('users/form'), "add");
       
        $form = layout()->form($dashboard,url()->toRoute('users/update/'.$id),"POST",false)->setAjax(true);
        $formRules = UserForm::instance($form);
        $formRules->createForm($request->getAuth());
        $formRules->addLinks($user);
        $formRules->addButtons($user);
        $formRules->createScript();

        $form->loadData($user);
        $form->getInput('password')->setValue('');
        $form->getInput('name')->addAttr('disabled', true);
        $ativo = $user->ativo==1?'Sim':'Não';
        if ($request->getAuth()->hasScope(Scopes::USERS)){
            $sectorSubordinate = SectorSubordinates::instance();
            $sectorSubordinate->query()->where('subordinate_id','=',$id);
            // $sectorSubordinateArray = array_map(function($data){return $data->responsible_sector_id;},$sectorSubordinate->result());
            if (SectorSubordinates::instance()->getDpto($user->id)->id){
                $form->getInput('departamento_subordinado')->setSelectedOption(SectorSubordinates::instance()->getDpto($user->id)->id,  SectorSubordinates::instance()->getDpto($user->id)->name);
            }
            $form->getInput('id_group')->setSelectedOption($grp->id,$grp->name);
            $form->getInput('ativo')->setValues($ativo);
            if ($user->cod_estabel){
                $form->getInput('cod_estabel')->setValue($user->getEstabel());
            }
            $user->getEstabelByUser($user->id);
            if ($user->cod_at && Emitentes::instance()->getByCodEmitente($user->cod_at)->nome_abrev){
                $form->getInput('cod_at')->setSelectedOption($user->cod_at,$user->cod_at." - ".Emitentes::instance()->getByCodEmitente($user->cod_at)->nome_abrev);
            }
            if ($user->cod_fornecedor && Emitentes::instance()->getByCodEmitente($user->cod_fornecedor)->nome_abrev){
                $form->getInput('cod_fornecedor')->setSelectedOption($user->cod_fornecedor,$user->cod_fornecedor." - ".Emitentes::instance()->getByCodEmitente($user->cod_fornecedor)->nome_abrev);
            }
        }
        
        $dashboard->setContents( $form->html());
        response()->html($dashboard->html());
    }

    public function add(Request $request):void{
        $model = UsersModel::instance();
        $data = $request->posts();
        // unset($data['departamento_subordinado']);
        if (!$request->post("cod_at")){
            unset($data['cod_at']);
        }
        if (!$request->post("cod_fornecedor")){
            unset($data['cod_fornecedor']);
        }
        if (!$request->post("cod_rep")){
            unset($data['cod_rep']);
        }
        $model->setValues($data);
        
        if ($model->password != $model->password_repeat) {
            response()->json(['message'=>'Favor repetir a senha corretamente'], 422);  
        }
        $model->formatDatas($request);
        try{
            $model->validateSave();                

            $nextUser =  UsersModel::instance()->getLast()+1;
            $model->setId($nextUser);      
            $model->insert();

            $user = UsersModel::instance()->getById($nextUser);
            if ($request->getAuth()->hasScope(Scopes::USERS) && $request->post('departamento_subordinado')){
                $model->addSectorSubordinate($request->post('departamento_subordinado'));
            }             

            
            $this->addLog($request,true, $user);
            response()->json(['redirect'=>'form/'.$user->id]);
            
        }catch(ValidationException $e){
            response()->json(["errors"=>$e->getErrors()],422);
        }
        response()->json(['success'=>true],200);
    }

    public function update(Request $request,int $id):void{
        try{            
            $model = UsersModel::instance()->getById($id);
            $oldUser = UsersModel::instance()->getById($id);
            $model->formatUpdate($request, $oldUser);
            $model->validateUpdate();
            $model->save();
            if ($request->getAuth()->hasScope(Scopes::USERS) && $request->post('departamento_subordinado')){
                $model->addSectorSubordinate($request->post('departamento_subordinado'));
            }            
            $this->addLog($request,false,UsersModel::instance()->getById($id));
            response()->redirect(url()->toRoute('users/form/'.$model->id));
        }catch(ValidationException $e){
            response()->json(["errors"=>$e->getErrors()],422);
        }
    }
    
    public function delete (Request $request, int $id): void{
        try {
            UsersModel::instance()->getById($id)->delete();
            response()->redirect(url()->toRoute('users/list'));
        } catch(ValidationException $e){
            response()->json(["errors"=>$e->getErrors()],422);
        } 
    }
    public function copy(Request $request):void {
        try {
            $name = $request->post("user_name");
            $email = $request->post("email");
            $antigo = UsersModel::instance()->getById($request->post("user_id"));
            if (!$name || !$email){
                response()->json(['message'=>'Favor inserir todos os campos.'], 422); 
            }
            if (UsersModel::instance()->getByName($name)->id){
                response()->json(['message'=>'Já existe usuário com esse nome.'], 422); 
            }
            if (UsersModel::instance()->getByEmail($email)->id){
                response()->json(['message'=>'Já existe usuário com esse e-mail.'], 422); 
            }
            $novo = $antigo;
            $novoId = $novo->getLast() +1;
            $novo->id = $novoId;
            $novo->name = $name;
            $novo->email = $email;
            $novo->insert();
            $dpto = SectorSubordinates::instance()->getDpto($request->post("user_id"));
            $novo->addSectorSubordinate($dpto->id);
            $this->addLog($request,true, $novo);
            response()->json(['redirect'=>url()->toRoute('users/form/'.$novoId)]);
        } catch(ValidationException $e){
            response()->json(["errors"=>$e->getErrors()],422);
        } 
    }
    protected function addLog(Request $request, bool $add,UsersModel $user){
        $log = UsersLog::instance();
        $log->codigo= $user->id;
        $log->nome_user= $request->getAuth()->getName();
        $log->dt_emis = date('Y-m-d H:i:s');
        if($add==true){
            $log->assunto= 'Criação do registro de Usuário';
            $log->narrativa = 'Usuário implantado no portal';
        }else{
            $log->assunto = 'Alteração do registro do usuário';
            $log->narrativa = 'Usuário alterado no portal';
        }
        try {
            $log->insert();
        } catch(ValidationException $e){
            response()->json(["errors"=>$e->getErrors()],422);
        } 
    }
    public function get(Request $request){
        $representantes = UsersModel::instance();
        $representantes->query()->like('name',"%".$request->get('name')."%");
        $representantes->query()->limit(10);
        $data = $representantes->result();
        $return = [];
        foreach($data as $row){
            $return[] = $row->toArray();
        }
        response()->json($return,200);
    }
    public function getByGerente(Request $request, int $idGerente){
        $models = UsersModel::instance()->getSuborinados($idGerente);
        $gerentes = UsersModel::instance()->getGerente($idGerente);
        $result = [];
        foreach($models as $model){
            $result[] = $model->toArray();
        }
        foreach($gerentes as $gerente){
            $result[] = $gerente->toArray();
        }
        response()->json($result,200);
    }
    public function getById(Request $request, string $id){
        $models = UsersModel::instance()->getByIdResult($id);
        $result = [];
        foreach($models as $model){
            $result[] = $model->toArray();
        }
        response()->json($result,200);
    }
    public function getByName(Request $request, string $name){
        $emitente = UsersModel::instance()->getByName($name);

        response()->json($emitente->toArray(), 200);
    }
}