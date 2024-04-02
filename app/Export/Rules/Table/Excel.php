<?php

namespace App\Export\Rules\Table;

class  Excel{

    public static function export(array $headers, array $datas, string $arquivo){
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Type: application/vnd.ms-excel');
        header("Content-type: application/force-download");
        header('Content-Disposition: attachment;filename="'.$arquivo.'.xls"');
        $xlsx = "<h3>".$arquivo."</h3>";
        $xlsx.= "<table style='font-family:tahoma;'><thead><tr>";
        foreach($headers as $value){
               $xlsx.= "<th bgcolor='E0E0E0'>".($value)."</th>";
        }
        $xlsx.="</tr></thead>";
                 foreach ($datas as $key => $value) {
                  $xlsx.= "<tbody><tr>";
                    foreach ($datas[$key] as $data){

                            $xlsx .= '<td>'.$data.'</td>';
                  }; 
                $xlsx.= "</tr></tbody>";                     
               } 
        $xlsx.= "</table>";
        echo "\xEF\xBB\xBF"; // UTF-8 BOM
        echo $xlsx;
        } 

        public static function exportHtml(array $headers, $html, string $arquivo){
              header('Content-Transfer-Encoding: binary');
              header('Expires: 0');
              header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
              header('Pragma: public');
              header('Content-Type: application/vnd.ms-excel');
              header("Content-type: application/force-download");
              header('Content-Disposition: attachment;filename="'.$arquivo.'.xls"');
              $xlsx = "<h3>".$arquivo."</h3>";
              $xlsx.= "<table style='font-family:tahoma;'><thead><tr>";
              foreach($headers as $value){
                     $xlsx.= "<th bgcolor='E0E0E0'>".($value)."</th>";
              }
              $xlsx.="</tr></thead>";
              $xlsx.= "<tbody'>".$html."</tbody>";
              $xlsx.= "</table>";    
              echo "\xEF\xBB\xBF"; // UTF-8 BOM
              echo $xlsx;
              } 
                  
    
}
	
