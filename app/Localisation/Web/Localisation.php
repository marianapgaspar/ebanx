<?php

namespace App\Localisation\Web;

use App\Localisation\Rules\Localisation as RulesLocalisation;
use System\Server\Entities\Request;

class Localisation{

    public function change(Request $request, $code){
        RulesLocalisation::instance()->setLocalisationCode($code);

        response()->json(['success'=>true]);
    }
}