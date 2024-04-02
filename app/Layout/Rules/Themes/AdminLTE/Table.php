<?php
namespace App\Layout\Rules\Themes\AdminLTE;

use App\Layout\Rules\Table\ATable;

class Table extends ATable{
    public function html():string{


        $html = '';
        if($this->hasFilter()){
          $html .= $this->getFilter()->addAttr('style','display:none')->html();
          $this->getLayout()->addScript('
              $("#filter").on("click",function(){
                  if($("#'.$this->getFilter()->getId().'").css("display")=="none"){
                    $("#'.$this->getFilter()->getId().'").show(250);
                    return;
                  }
                  $("#'.$this->getFilter()->getId().'").hide(250);
              });
          ');
        }
        $html .=  '<div class="card">
        <div class="card-header">
        
          <div class="card-tools" style="float:left">
            
            ';

        foreach($this->getButtons() as $button){
          $html .= $button->html();
          
        }

        $html .='
          
          </div>
          <div class="card-tools" style="float:right">';
          if($this->hasFilter()){
            $html .= '<button type="button" class="btn btn-success" id="filter">Filtros</button>';
          }
          $html .= '</div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-head-fixed text-nowrap">
            <thead>
              <tr>';
              if($this->getLinks()){
                $html .= "<th></th>";
              }
              foreach($this->getColumns() as $column){
                $html .= "<th>{$this->getLayout()->getDictionary()->get($column)}</th>";
              }
             
              $html .='</tr>
            </thead>
            <tbody>';
            foreach($this->getData() as $row){
                $html .= '<tr>';
                if($this->getLinks()){
                  $html .= "<td>";
                  foreach($this->getLinks() as $link){
                      $html .= "<a class='btn ".$link['type']." btn-sm' href='{$link['link']($row)}'><i class='{$link['icon']}'></i></a>";
                  }
                  $html .= "</td>";
                }
                foreach($this->getColumns() as $column){
                  if(isset($this->getCallbacks()[$column])){
                    $html .= "<td>{$this->getCallbacks()[$column]($row->{$column})}</td>";
                    continue;
                  }
                    $html .= "<td>{$row->{$column}}</td>";
                }
                
                $html .= '</tr>';
              }
              
             
              $html .='</tbody>
          </table>
        
        <div class="card-footer clearfix"><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing '.$this->getPagination()->getPage()*$this->getPagination()->getPerPage().' to '.(($this->getPagination()->getPage()*$this->getPagination()->getPerPage())+$this->getPagination()->getPerPage()).' of '.$this->getPagination()->getCount().' entries</div></div><div class="col-sm-12 col-md-7"><div class="pagination pagination-md m-0 float-right" id="example2_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>';
        foreach($this->getPagination()->getLinks() as $link){
          $active = $link['page'] == $this->getPagination()->getPage()?'active':'';
          $html .= '<li class="paginate_button page-item '.$active.'"><a href="'.$link['link'].'" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">'.($link['page']+1).'</a></li>';
        
        }
   
        $html .='<li class="paginate_button page-item next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div>
        <!-- /.card-body -->
      </div></div></div>';
      return $html;
    }
}