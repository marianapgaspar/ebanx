<?php

namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Rules\Buttons\AButton;
use App\Layout\Rules\Components\AReport;

class Report extends AReport {
    public function html():string{
            $html = '
            <div class="card shadow-base bd-0">
                <div class="card-header bg-transparent pd-20">
                    <h6 class="card-title tx-uppercase tx-12 mg-b-0">'.$this->title.'</h6>
                </div>
                <table class="table table-responsive mg-b-0 tx-12">
                    <thead>
                        <tr class="tx-10">';
                        foreach($this->columns as $array){
                            $html .= '<th>' . htmlspecialchars($array) . '</th>';
                        }
                        $html.= '
                        </tr>
                    </thead>';
                    foreach ($this->data as $key => $value) {
                        $html.= "<tbody><tr>";
                          foreach ($this->data[$key] as $data){
      
                                  $html .= '<td>'.$data.'</td>';
                        }; 
                      $html.= "</tr></tbody>";                     
                     } 
                        $html.= '
                </table>
            </div>
            ';
      return $html;
    }
    function prepare(){

    }
      
}