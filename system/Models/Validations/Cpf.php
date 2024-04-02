<?php 
namespace System\Models\Validations;

use System\Models\Validations\AValidation;
use System\Models\AModel;

class Cpf extends AValidation {

    function validate(string|int|float|AModel|null $data,AModel $model,string $field,array &$errors):bool{
    
        if (empty($data)){
            return true;
        }
        
        $cpf = preg_replace( '/[^0-9]/is', '', $data );
            
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            $errors[$field]=$this->message;
        return false;
        }
    
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            $errors[$field]=$this->message;
        return false;
        }
    
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                $errors[$field]=$this->message;
                return false;
            }
        }

        return true;
    }

}