<?php
namespace App\Account\Web;

use App\Account\Models\Account;
use System\Exceptions\ValidationException;
use System\Server\Entities\Request;
use App\Layout\Rules\Buttons\AButton;
use System\Exceptions\SqlException;
use App\Account\Models\Balance as ModelBalance;

class Balance {
    public function reset(Request $request){
        response()->json("OK",200);
    }

    public function getBalance(Request $request){
        try{
            $account_id = $request->get("account_id");
            $account = Account::instance()->getById($account_id);
            if (!$account->id){
                response()->json("0",404);
            }
        } catch(ValidationException $e){
            response()->json(["errors"=>$e->getErrors()],422);
        } catch (SqlException $e) {
            response()->json(["sql"=>$e->getMessage()],500);
        } 
    }
   
    public function event(Request $request){
        try{
            $balance = ModelBalance::instance();
            $balance->setValues($request->posts());
            $account = Account::instance()->getById($balance->destination);
            if (!$account->id){
                $account->id = $balance->destination;
                $account->amount = $balance->amount;
                $account->insert();
            }
            $balance->insert();
            response()->json(json_encode(["destination"=>[["id"=>"100"], ["balance"=>10]]]),201);
        } catch(ValidationException $e){
            response()->json(["errors"=>$e->getErrors()],422);
        } catch (SqlException $e) {
            response()->json(["sql"=>$e->getMessage()],500);
        } 
    }
}