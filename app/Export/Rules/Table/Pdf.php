<?php


namespace App\Export\Rules\Table;
ini_set('memory_limit', '256M');
use Dompdf\Dompdf;
use Jurosh\PDFMerge\PDFMerger;

class  Pdf{

       public static function export(array $headers, array $datas, string $file){
              $arquivo = $file;
              $pdf = "<h3>".$arquivo."</h3>";
              $pdf.= "<table style='font-family:tahoma;'><thead><tr>";
              foreach($headers as $value){
                     $pdf.= "<th bgcolor='E0E0E0'>".strtoupper($value)."</th>";
              }
              $pdf.="</tr></thead>";
                     foreach ($datas as $key => $value) {
                     $pdf.= "<tbody><tr>";
                     foreach ($datas[$key] as $data){

                            $pdf .= '<td>'.$data.'</td>';
                     }; 
                     $pdf.= "</tr></tbody>";                     
                     } 
              $pdf.= "</table>";
              $dompdf = new Dompdf();
              $dompdf->loadHtml($pdf);
              $dompdf->setPaper('A4', 'portrait');
              $dompdf->render();
              $dompdf->stream($arquivo.".pdf");
       } 
}