<?php

namespace App\Layout\Rules\Themes\Bracket;

use App\Layout\Interfaces\ITheme;
use App\Layout\Rules\Treetable\ATreetable;

class Treetable extends ATreetable {
    public function html():string{
      $html = "
      <div class='card pd-0 bd-0 shadow-base'>
        <table class='table tree table-hover'>
          <thead class='thead-colored thead-danger'>
            <tr>
              ";
              foreach ($this->columns as $column){
                $html.="
                <th> {$column}</th>";
              }
            $html.="
            </tr>
          </thead>";
          $html.="<tbody>";
          $html.=$this->buildTreetable($this->dados);
          $html.="</tbody>
        </table>
      </div>

      ";
      $this->getLayout()->addScript("
        $('.tree').treegrid({
          initialState:'collapsed'
        });
      ");
     
      return $html;
      
    }
    public function buildTreetable(array $dados):string{
      $html = '';
      $id = 0;
      foreach($dados as $table){     
        $id ++;
          if(count($table->getChildren())){
            $html .= $this->tableFather($table->getDados(),$id);
            $retorno = $this->buildTreetableRecursive($table->getChildren(),$id);
            $html .=$retorno['html']; 
            $id = $retorno['id'];
          }else{
            $html .= $this->tableFather($table->getDados(),$id);
          }

      }
      return $html;
  }
  private function buildTreetableRecursive(array $tables,$id):array{
      $html = "";
      $father = $id;
      foreach($tables as $table){
        $id ++;
          $tableHtml = "";
          if(count($table->getChildren())){
            $tableHtml .= $this->tableFather($table->getDados(),$id,$father); 
          }else{
            $tableHtml .= $this->tableChild($table->getDados(),$id,$father);
          }
          if(count($table->getChildren())){
            $retorno = $this->buildTreetableRecursive($table->getChildren(),$id);
            $tableHtml .= $retorno['html']; 
            $id = $retorno['id'];
          }
          $html .= $tableHtml;
      }
      $dados['id'] = $id;
      $dados['html'] = $html;
      return $dados;
  }
  public function tableFather(array $dados, int $id, int $father = null):string {
    $html = '';
    $classFather = '';
    if ($father){
      $classFather = " treegrid-parent-{$father}";
    }
    $html .= "
      <tr class='treegrid-{$id}{$classFather}'>";
        foreach ($dados as $value) {
          $html .= "<td>{$value}</td>";
        };
    $html .=' </tr>';
    return $html;
  }
  public function tableChild(array $dados, int $id, int $father):string {
    $html = '';
    $html .= "
      <tr class='treegrid-{$id} treegrid-parent-{$father}'>";
        foreach ($dados as $value) {
          $html .= "<td>{$value}</td>";
        };
    $html .=' </tr>';
    return $html;
  }
  public function prepare(){
    $this->layout->addJs(url()->toRoute('public/common/plugins/maxazan-jquery-treegrid-447d662/js/jquery.treegrid.js'));
    // $this->layout->addJs(url()->toRoute('public/common/plugins/maxazan-jquery-treegrid-447d662/js/jquery.treegrid.bootstrap3.js'));
    $this->layout->addCss(url()->toRoute('public/common/plugins/maxazan-jquery-treegrid-447d662/css/jquery.treegrid.css'));
  }
}