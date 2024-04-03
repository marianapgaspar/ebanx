<?php 

namespace System\Tools;

use DateTime;

class Uteis {
    /**
     * Funcao Mascara
     *
     * @param [type] $mask
     * @param [type] $str
     * @return void
     * Ajustado  em 29/09 - tratamento de erro (quando coloca mais numeros que a mascara)
     */
    public static function mask(string $mask,string $str = null){
        if (!$str){
            return "";
        }
        $countMask = substr_count($mask, '#');
        if(strlen($str)>0){
            $c= preg_replace("/[^0-9]/", "",$str);
            $str = str_replace(" ","",$c);

            for($i=0;$i<strlen($str);$i++){
               if($countMask >=($i+1)){
                    $mask[strpos($mask,"#")] = $str[$i];
                }
            }
            return $mask;
        }else{
            return $str;
        }
    }
    public static function isCnpj(string $cnpj):bool{
        $verify = preg_replace('/[^0-9]/', '', (string) $cnpj);
	    // Valida tamanho
        if (strlen($verify) != 14) {
            return false;
        }
        return true;
    }
    public static function isCpf(string $cpf):bool{
        $verify = preg_replace( '/[^0-9]/is', '', $cpf );            
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($verify) != 11) {
          return false;
        }
        return true;
    }
    public static function dataPT(){
        $date = DateTime::createFromFormat('Ymd', date('Ymd'));
        $day = $date->format("l");
        $daynum = $date->format("j");
        $month = $date->format("F");
        $year = $date->format("Y");
         
        switch($day)
        {
        case "Monday": $day = "Segunda-Feira"; break;
        case "Tuesday": $day = "Terça-Feira"; break;
        case "Wednesday": $day = "Quarta-Feira"; break;
        case "Thursday": $day = "Quinta-Feira"; break;
        case "Friday": $day = "Sexta-Feira"; break;
        case "Saturday": $day = "Sábado"; break;
        case "Sunday": $day = "Domingo"; break;
        default: $day = "Unknown"; break;
        }
         
        switch($month)
        {
        case "January": $month = "Janeiro"; break;
        case "February": $month = "Fevereiro"; break;
        case "March": $month = "Março"; break;
        case "April": $month = "Abril"; break;
        case "May": $month = "Maio"; break;
        case "June": $month = "Junho"; break;
        case "July": $month = "Julho"; break;
        case "August": $month = "Agosto"; break;
        case "September": $month = "Setembro"; break;
        case "October": $month = "Outubro"; break;
        case "November": $month = "Novembro"; break;
        case "December": $month = "Dezembro"; break;
        default: $month = "Unknown"; break;
        }
         
        return $day.', '.$daynum . " de " . $month . " de " . $year;
    } 

    public static function traduzMes(int $month){
        switch($month){
            case 1: $month = 'Janeiro';break;
            case 2: $month = 'Fevereiro';break;
            case 3: $month = 'Março';break;
            case 4: $month = 'Abril';break;
            case 5: $month = 'Maio';break;
            case 6: $month = 'Junho';break;
            case 7: $month = 'Julho';break;
            case 8: $month = 'Agosto';break;
            case 9: $month = 'Setembro';break;
            case 10: $month = 'Outubro';break;
            case 11: $month = 'Novembro';break;
            case 12: $month = 'Dezembro';break;      
        }
        return $month;
    }      
    
    public static function parseTemplate (string $view, array $params = null):string {

        if ( !file_exists($view) ) {
            throw new \Exception("Template ".$view."  não encontrado");
        }

        // carrega template para varável
        $string = file_get_contents ($view);

        // substitue variáveis de template
        $parse_string = preg_replace_callback('/(~[^~]{1,}~)/', function($v) use (&$params) {
            return $params[str_replace("~", "", $v[1])];
        },$string);

        // retorna string parseada
        return $parse_string;
    }
    public static function each($array){
        $key = key($array);
        $value = current($array);
        $each = is_null($key) ? false : [
            1        => $value,
            'value'    => $value,
            0        => $key,
            'key'    => $key,
        ];
        next($array);
        return $each;
    }
    public static function getRandonColors(int $quantidade):array{
        $cores = [];
        for ($i = 0; $i <= $quantidade; $i++) {
            array_push($cores, Uteis::getCorBonita($i));
        }
        return $cores;
    }
    public static function getCorBonita(int $n):string{
        $cores = ['#FF7F50', '#FFD700', '#F0E68C', '#D8BFD8', '#B0E0E6','#fc574c', '#f59f00', '#00d89a', '#00bdf1', '#3ef200', '#FF00FF', '#EE82EE', '#CD5C5C', '#DB7093', '#00CED1', '#20B2AA', '#008B8B', '#7FFFD4', '#66CDAA', '#5F9EA0', '#2F4F4F', '#00FA9A', '#00FF7F', '#90EE90', '#8FBC8F', '#3CB371', '#2E8B57', '#006400', '#008000', '#228B22', '#32CD32', '#00FF00', '#7FFF00', '#ADFF2F', '#9ACD32', '#6B8E23', '#556B2F', '#808000', '#BDB76B', '#DAA520', '#B8860B', '#8B4513', '#A0522D', '#BC8F8F', '#CD853F', '#D2691E', '#F4A460', '#DEB887'];
        return $cores[$n];
    }
}
