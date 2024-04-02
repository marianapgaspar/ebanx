<?php 
namespace System\Models\Validations;

use System\Models\Validations\AValidation;
use System\Models\AModel;

class Cnpj extends AValidation {

    function validate(string|int|float|AModel|null $data,AModel $model,string $field,array &$errors):bool{
    
        if (empty($data)){
            return true;
        }
        $cnpj = preg_replace('/[^0-9]/', '', (string) $data);
	
	    // Valida tamanho
        if (strlen($cnpj) != 14) {
            $errors[$field]=$this->message;
            return false;
        }
            
        // Verifica se todos os digitos são iguais
        if (preg_match('/(\d)\1{13}/', $cnpj)){
            $errors[$field]=$this->message;
            return false;

        }

        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto)){
            $errors[$field]=$this->message;
            return false;
        }

        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj[13] != ($resto < 2 ? 0 : 11 - $resto)) {
            $errors[$field]=$this->message;
            return false;
        }
        return true;
    }

}