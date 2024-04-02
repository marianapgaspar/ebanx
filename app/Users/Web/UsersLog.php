<?php 

namespace App\Users\Web;

use App\Users\Models\UsersLog as ModelLog;
use System\Server\Entities\Request;
use App\Layout\Rules\Buttons\AButton;
use System\Tools\Time;

class UsersLog {
    public function table(Request $request,int $userId){

        $dashboard = layout()->dashboard();
        $dashboard->setTitle('Logs');
        $dashboard->getDictionary()->loadFile('users');

        $table = layout()->table($dashboard);
        $table->setColumns(["dt_emis","nome_user","assunto","narrativa"]);
        $table->setOrdenableColumns(["dt_emis","nome_user","assunto","narrativa"]);

        $userLog  = ModelLog::instance();
        $userLog->query()->where('codigo','=',$userId);
        if (!$request->get("orders")){
            $userLog->query()->orderBy("dt_emis","desc");
        }
        $table->paginate($userLog,url()->toRoute('users/log/list/'.$userId),(int)($request->get('page')),100,$request->gets());
        $table->addCallback('dt_emis',function($column){
            return date("d/m/Y", strtotime($column));
        });
        $table->addButton(layout()->button($dashboard,'Voltar', AButton::BUTTON_PRIMARY)->addAttr('onclick','window.location.href=\''.url()->toRoute('users/form/'.$userId)."'")->addAttr('type','button'));
        $dashboard->setContents($table->html());
        response()->html($dashboard->html());
    }
}