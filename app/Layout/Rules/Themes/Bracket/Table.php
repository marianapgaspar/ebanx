<?php
namespace App\Layout\Rules\Themes\Bracket;

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

        if ($this->hasNavLinks()){
          $html .="<ul class='nav nav-tabs card-header-tabs'>";
          foreach($this->navLinks as $link){
            $html .= "
            <li class='nav-item'>
              <a class='nav-link {$this->setActive($link['url'])}' style='font-weight:normal' href='{$link['url']}'>{$this->getLayout()->getDictionary()->get($link['name'])}</a>
            </li>";            
          }
          $html .="</ul>";
        }

        $html .='
          
          </div>
          <div class="card-tools" style="float:right; margin: 5px;">';
          if($this->hasFilter()){
            $html .= '<button type="button" class="btn btn-outline-secondary float-right" id="filter">Filtros</button>';
          }
          $html .='
          
          </div>
          <div class="card-tools" style="float:right; margin: 5px;">';
          $script = '';
          if($this->filterField){
            $html .=
            '<div class="input-group">
              <input type="text" name="search" value="'.(isset($this->uri['search'])?$this->uri['search']:'').'" class="form-control" />
                <span class="input-group-btn">
                  <button class="btn bd bg-white tx-gray-600" type="button">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
            </div>';
            $queryString = $this->url.'?';
            if (!empty($this->uri)){
              foreach($this->uri as $key=>$value){
                if ($key == "page" || is_array($value) || $key == "search"){
                  continue;
                }
                $queryString .= $key."=".$value."&";
              }
            }
            $script='$(function(){$("[name=search]").on("change",function(){window.location.href="'.$queryString.'search="+$(this).val();})});';
          }
          $this->getLayout()->addScript($script);
          $html .= '</div>
        </div>
        <!-- /.card-header -->
        <div class="bd bd-gray-300 rounded table-responsive" style="overflow: auto;">
          <table class="table mg-b-0">
            <thead>
              <tr>';
              if($this->getLinks()){
                $html .= "<th></th>";
              }
              foreach($this->getColumns() as $column){
                $html .= "<th>";
                if(in_array($column,$this->ordenableColumns)){
                  if(isset($this->uri['orders'][$column])){
                    if($this->uri['orders'][$column]=="DESC"){
                      $newUri = $this->uri;
                      $newUri['orders'][$column]="ASC";
                      $html .= "<a class='pull-left' href='".$this->url."?".http_build_query($newUri)."'><i class='fa fa-caret-up'></i></a>";
                    }else{
                      $newUri = $this->uri;
                      unset($newUri['orders'][$column]);
                      $html .= "<a class='pull-left' href='".$this->url."?".http_build_query($newUri)."'><i class='fa fa-caret-down'></i></a>";
                    }
                  }else{
                    $newUri = $this->uri;
                    $newUri['orders'][$column]="DESC";
                    $html .= "<a class='pull-left' href='".$this->url."?".http_build_query($newUri)."'><i class='fa fa-sort'></i></a>";
                  }
                }
                $html .= "{$this->getLayout()->getDictionary()->get($column)}</th>";
              }
             
              $html .='</tr>
            </thead>
            <tbody>';
            foreach($this->getData() as $row){
                $html .= '<tr>';
                if($this->getLinks()){
                  $html .= "<td>";
                  foreach($this->getLinks() as $link){
                    if(isset($link['show']) &&!$link['show']($row)){
                      continue;
                    }
                    if($link['message']){
                      $html .= "<a class='btn ".$link['type']." btn-sm button-alert' href='javascript:void(0)'  data-message='{$link['message']($row)}' data-link='{$link['link']($row)}' {$link['attr']}><i class='{$link['icon']}'></i></a>";
                      continue;
                    }
                    $html .= "<a class='btn ".$link['type']." btn-sm' href='{$link['link']($row)}' {$link['attr']}><i class='{$link['icon']}'></i></a>";
                  }
                  $html .= "</td>";
                }
                foreach($this->getColumns() as $column){
                  if(isset($this->getCallbacks()[$column])){
                    $html .= "<td>{$this->getCallbacks()[$column]($row->{$column}, $row)}</td>";
                    continue;
                  }
                    $html .= "<td>{$row->{$column}}</td>";
                }
                
                $html .= '</tr>';
              }
              
             
              $html .='</tbody>
          </table>';
              if($this->hasPaginate){                
                $html .='
                <div class="card-footer clearfix">
                  <div class="row">
                    <div class="col-sm-12 col-md-5">
                      <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Mostrando '.$this->getPagination()->getPage()*$this->getPagination()->getPerPage().' à '.(($this->getPagination()->getPage()*$this->getPagination()->getPerPage())+$this->getPagination()->getPerPage()).' de '.$this->getPagination()->getCount().' entradas
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                      <div class="pagination pagination-md m-0 float-right" id="example2_paginate">
                        <ul class="pagination">
                          <li class="paginate_button page-item previous" id="example2_previous">
                            <a href="'.$this->getBeforeLink().'" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link"> < </a>
                          </li>';
                          foreach($this->getPagination()->getLinks() as $link){
                            $active = $link['page'] == $this->getPagination()->getPage()?'active':'';
                            $html .= '<li class="paginate_button page-item '.$active.'"><a href="'.$link['link'].'" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">'.($link['page']+1).'</a></li>';
                          }
                          $html .='
                          <li class="paginate_button page-item next" id="example2_next">
                            <a href="'.$this->getNextLink().'" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link"> > </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>';
              }
        $html .='<!-- /.card-body -->
      </div></div></div>';
      return $html.$this->modal();
    }

    public function prepare(){
      $this->getLayout()->addScript('$(function(){$(".button-alert").on("click",function(){
          $(".modal-table").find(".modal-message").html($(this).attr("data-message"));
          $(".modal-table").find(".accept-link").attr("href",$(this).attr("data-link"));
          $(".modal-table").modal("show");
      });});');
    }

    private function modal(){
      $html = '<div class="modal modal-table" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Alerta</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p class="modal-message">Modal body text goes here.</p>
                    </div>
                    <div class="modal-footer">
                      <a class="btn btn-primary accept-link">Sim</a>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                  </div>
                </div>
              </div>';
      return $html;
    }
}