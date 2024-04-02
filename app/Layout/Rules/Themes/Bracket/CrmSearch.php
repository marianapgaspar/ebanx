<?php
namespace App\Layout\Rules\Themes\Bracket;

use App\CRM\Models\Emitentes;

use App\Layout\Rules\Components\ACrmSearch;
use App\Localisation\Rules\Localisation;
use App\Layout\Rules\Components\ASelect2;

class CrmSearch extends ACrmSearch{

    private $imgLoading = '/public/common/img/search_loading_1.gif';
    private $show = 'no';
    public function html():string{
        
        if($this->searchModal==true){
            $this->show = $this->searchModalShow ? 'yes': $this->show;
            return $this->modal();  
        }else{
            return $this->search();
        }             
    }

    private function modal():string{
        return '        
        <div id="modalSearch" class="modal fade" data-show="'.$this->show.'">
        <div class="modal-dialog modal-full" role="document">
          <div class="modal-content tx-size-sm">            
            <div class="modal-body pd-0">'.$this->search().'</div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary tx-size-xs" data-dismiss="modal">x Sair</button>
            </div>
          </div>
        </div><!-- modal-dialog -->
      </div>';
    }

    private function search():string{
        $htmlCadastro = $this->htmlCadastro();
        $htmlCredito = $this->htmlCredito();   
        $htmlPedido = $this->htmlPedido();   
        $htmlNf = $this->htmlNf();   
        $htmlFinanceiro = $this->htmlFinanceiro();   
        $htmlContato = $this->htmlContato();   

        $layout = $this->getLayout();

        $dataIni = layout()->date($layout,'dtIni')
            ->addAttr('placeholder','Data Início')
            ->addAttr('data-mask','00/00/0000')
            ->addAttr('value',date('01/m/Y'));

        $dataIni->setShowLabel(false);
        $dataFim = layout()->date($layout,'dtFim')
        ->addAttr('placeholder','Data Fim')
        ->addAttr('data-mask','00/00/0000')
        ->addAttr('value',date('d/m/Y'));

        $dataFim->setShowLabel(false);

        if($this->searchCodEmitente > 0){
            $dados = Emitentes::instance()->getById($this->searchCodEmitente);
        
            $selectEmitente = layout()->input($layout,'selectEmitenteInput')
                ->setValue($dados->nome_abrev)
                ->addAttr('disabled',true);
    
            $hideSelectEmitente = layout()
                ->input($layout,'selectEmitente')
                ->setValue($dados->cod_emitente)
                ->addAttr('type','hidden');
         
            $selectEmitente->setShowLabel(false);
            $hideSelectEmitente->setShowLabel(false);

            $hideInput = $hideSelectEmitente->html();
        }else{
            $selectEmitente = layout()->select2($layout,'selectEmitente')
            ->addAttr('placeholder','Clientes')       
            ->ajax(url()->toRoute('CRM/people/get'),'nome_abrev','cod_emitente','nome_abrev');
            
            $selectEmitente->setShowLabel(false);
            $hideInput ='';
        }


        return '
        <div class="bg-gray-100 bd">
            <div class="row mg-x-0 pd-t-15 bg-gray-400 ">
                <div class="col-md-4">
                <h2 class="mg-t-2 tx-uppercase tx-bold tx-spacing--2 tx-inverse tx-poppins mg-l-10">CONSULTAR</h2></div>       
                 '.$hideInput.'  
                <div class="col-md-4">  '.$selectEmitente->html().'  </div>  
                <div class="col-md-2"> '.$dataIni->html().' </div>       
                <div class="col-md-2"> '.$dataFim->html().'</div>       
            </div>       

            <div class="bd-t">
                <ul class="nav nav-gray-600 active-info tx-uppercase tx-12 tx-medium tx-spacing-2 flex-column flex-sm-row" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#navCadastro" role="tab">Cadastro</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#navCredito" role="tab">Crédito</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#navPedido" role="tab">Pedidos</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#navNf" role="tab">Notas Fiscais</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#navFinanceiro" role="tab">Contas a receber</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#navContato" role="tab">Contatos</a></li>
                </ul>
            </div>  
        </div>
        <div class="tab-content">
            <div class="tab-pane fade active show py-3 px-4" id="navCadastro" role="tabpanel" aria-labelledby="navCadastro">
                <div class="init pd-y-10">
                    <img src="'.$this->imgLoading.'" width="150" style="display: block;  margin-left: auto; margin-right: auto">
                </div>
                <div class="info" style="display:none">
                '.$htmlCadastro.' 
                </div>     
            </div>
            <div class="tab-pane fade" id="navCredito" role="tabpanel" aria-labelledby="navCredito">
                <div class="init pd-y-10">
                    <img src="'.$this->imgLoading.'" width="150" style="display: block;  margin-left: auto; margin-right: auto">
                </div>
                <div class="info" style="display:none">
                '.$htmlCredito.' 
                </div> 
            </div>      
            <div class="tab-pane fade" id="navPedido" role="tabpanel" aria-labelledby="navPedido">
                <div class="init pd-y-10">
                    <img src="'.$this->imgLoading.'" width="150" style="display: block;  margin-left: auto; margin-right: auto">
                </div>
                <div class="info" style="display:none">
                '.$htmlPedido.' 
                </div> 
            </div>      
            <div class="tab-pane fade" id="navNf" role="tabpanel" aria-labelledby="navNf">
                <div class="init pd-y-10">
                    <img src="'.$this->imgLoading.'" width="150" style="display: block;  margin-left: auto; margin-right: auto">
                </div>
                <div class="info" style="display:none">
                '.$htmlNf.' 
                </div> 
            </div>      
            <div class="tab-pane fade" id="navFinanceiro" role="tabpanel" aria-labelledby="navFinanceiro">
                <div class="init pd-y-10">
                    <img src="'.$this->imgLoading.'" width="150" style="display: block;  margin-left: auto; margin-right: auto">
                </div>
                <div class="info" style="display:none">
                '.$htmlFinanceiro.' 
                </div> 
            </div>      
            <div class="tab-pane fade" id="navContato" role="tabpanel" aria-labelledby="navContato">
            '.$htmlContato.' 
            </div>      
        </div>

      ';
    }

    private function htmlCadastro():string{
        return   
       '
       <div id="msgCadastro"></div>
       <div class="table-search-cadastro">
            <div class="row">
                <div class="col-sm-2 pd-l-2">
                    <span class="title">Código</span>
                    <span class="text" id="cod_emitente">...</span>
                </div>

                <div class="col-sm-2 pd-l-2">
                    <span class="title">Cliente</span>
                    <span class="text" id="nome_abrev">...</span>
                </div>

                <div class="col-sm-4 pd-l-2">
                    <span class="title">Nome</span>
                    <span class="text" id="nome_emit">...</span>
                </div>

                <div class="col-sm-2 pd-l-2">
                    <span class="title">CNPJ</span>
                    <span class="text" id="cnpj">...</span>
                </div>

                <div class="col-sm-3 pd-l-2">
                    <span class="title">Insc. Estadual</span>
                    <span class="text" id="ins_estadual">...</span>
                </div>
            </div>

            <div class="row mg-t-4">
                <div class="col-sm-2 pd-l-2">
                    <span class="title">cod_rep</span>
                    <span class="text" id="cod_rep">...</span>
                </div>

                <div class="col-sm-3 pd-l-2">
                    <span class="title">Nome Repres</span>
                    <span class="text nome_abrev">...</span>
                </div>

                <div class="col-sm-3 pd-l-2">
                    <span class="title">Ramo de Atividade</span>
                    <span class="text" id="ramo_atividade">...</span>
                </div>

                <div class="col-sm-2 pd-l-2">
                    <span class="title">Suframa</span>
                    <span class="text" id="cod_suframa">...</span>
                </div>
            </div>

            <div class="row mg-t-4">

                <div class="col-sm-2 pd-l-2">
                    <span class="title">Região</span>
                    <span class="text" id="nome_ab_reg">...</span>
                </div>             

                <div class="col-sm-2 pd-l-2">
                    <span class="title">Micro Região</span>
                    <span class="text" id="nome_mic_reg">...</span>
                </div>           
            </div>
            <hr>
            <div class="row mg-t-4">
                <div class="col-sm-4 pd-l-2">
                    <span class="title">Endereço</span>
                    <span class="text" id="endereco" colspan="2">...</span>
                </div>             

                <div class="col-sm-2 pd-l-2">
                    <span class="title">Bairro</span>
                    <span class="text" id="bairro">...</span>
                </div>  

                <div class="col-sm-2 pd-l-2">
                    <span class="title">CEP</span>
                    <span class="text" id="cep">...</span>
                </div>  
            </div>  
            <div class="row mg-t-4">
                <div class="col-sm-2 pd-l-2">
                    <span class="title">Cidade</span>
                    <span class="text" id="cidade" colspan="2">...</span>
                </div>  

                <div class="col-sm-2 pd-l-2">
                    <span class="title">UF</span>
                    <span class="text" id="estado">...</span>
                </div> 

                <div class="col-sm-2 pd-l-2">
                    <span class="title">Pais</span>
                    <span class="text" id="pais">...</span>
                </div>  
            </div>
            <hr>
            <div class="row mg-t-4">
                <div class="col-sm-2 pd-l-2">
                    <span class="title">Caixa Postal</span>
                    <span class="text" id="caixa_postal ">...</span>
                </div>

                <div class="col-sm-3 pd-l-2">
                    <span class="title">e-Mail</span>
                    <span class="text" id="email_emit ">...</span>
                </div>          

                <div class="col-sm-2 pd-l-2">
                    <span class="title">Telefone</span>
                    <span class="text" id="telefone  ">...</span>
                </div>          

                <div class="col-sm-2 pd-l-2">
                    <span class="title">Telefone</span>
                    <span class="text" id="telefone_2">...</span>
                </div> 

                <div class="col-sm-2 pd-l-2">
                    <span class="title">Ramal</span>
                    <span class="text" id="ramal">...</span>
                </div>   
            </div> 
            <hr>
            <div class="row mg-t-4">
                <div class="col-sm-4 pd-l-2">
                    <span class="title">e-Mail NFE</span>
                    <span class="text" id="e_mail_nfe">...</span>            
                </div>    
                
                <div class="col-sm-4 pd-l-2">
                    <span class="title">Home Page</span>
                    <span class="text" id="home_page">...</span>            
                </div>    

                <div class="col-sm-4 pd-l-2">
                    <span class="title">Observações</span>
                    <span class="text" id="obs_implant">...</span>            
                </div>               
            </div> 
        </div>              
        ';      
    }

    private function htmlPedido():string{
        return   
       '
        <div id="msgPedido"></div>
        <table class="table-search table-search-pedido table table-striped table-bordered" style="width: 99.9%">
            <thead>
                <tr>
                    <th>Estab</th>
                    <th>Nr. Pedido</th>
                    <th>Dt Implant</th>
                    <th>Dt Entrega</th>
                    <th>Item</th>
                    <th style="text-align: left !important;">Descricao</th>
                    <th>Qt ped</th>
                    <th>Qt Atend</th>
                    <th>Valor Pedido</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>               
        ';      
    }    

    private function htmlNf():string{
        return   
       '
        <div id="msgNf"></div>
        <table class="table-search table-hover table-search-nf table table-striped table-bordered" style="width: 99.9%">
            <thead>
                <tr>
                    <th>Estab</th>
                    <th>Série</th>
                    <th>Nr Nota</th>
                    <th>Dt Emis</th>
                    <th>Nr Pedido</th>
                    <th>Item</th>
                    <th style="text-align: left !important;">Descricao</th>
                    <th>Qt ped</th>
                    <th>Qt Atend</th>
                    <th>Vlr Nota Fiscal</th>
                    <th>Status</th>
                    <th>Transportadora</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>               
        ';      
    }     

    private function htmlCredito():string{
        return   
       '
        <table class="table-search  table table-striped table-bordered" style="width: 99.9%">
            <tbody>
                <tr style="text-align:center; font-weight: bold;">
                    <th>Limite Disponivel</th>
                    <th>Títulos abertos</th>
                    <th>Cŕedito disponível</th>
                    <th>Dt limite crédito</th>
                </tr>

                <tr style="text-align:center;">
                    <td id="lim_credito">...</td>
                    <td id="total_aberto">...</td>
                    <td id="credito_disponivel">...</td>
                    <td id="dt_lim_cred">...</td>
                </tr>
                
                <tr>
                    <td colspan="4"><br></td>
                </tr>

                <tr style="text-align:center; font-weight: bold;">
                    <th>Dt Fim crédito</th>
                    <th>Limite de crédito</th>
                    <th>Dt última venda</th>
                    <th>Valor ultima NF</th>
                </tr>

                <tr style="text-align:center;">
                    <td id="dt_fim_cred">...</td>
                    <td id="moeda_libcre">...</td>
                    <td id="dt_ult_venda">...</td>
                    <td id="vl_ult_nota">...</td>
                </tr>    
                <tr>
                    <th>Condição Pagamento</th>
                    <td class="text-left" colspan="3" id="cond_descricao"></td>
                </tr>                           
               
            </tbody>
        </table>               
        ';      
    }    
    private function htmlFinanceiro():string{
        return   
       '
       <div id="msgFinanceiro"></div>
       <table class="table-search table-hover table-search-financeiro table table-striped table-bordered" style="width: 99.9%">
           <thead>
               <tr>
                   <th>Empresa</th>
                   <th>Estab</th>
                   <th>Esp Doc</th>
                   <th>Titulo</th>
                   <th>Parcela</th>
                   <th>Série</th>
                   <th>Vencimento</th>
                   <th>Valor</th>          
               </tr>
           </thead>
           <tbody>
               
           </tbody>
       </table>              
        ';      
    }    

    private function htmlContato():string{
        return   
       '
       <div id="msgContato"></div>
       <table class="table-search table-hover table-search-contato table table-striped table-bordered" style="width: 99.9%">
           <thead>
               <tr>
                   <th>Assunto</th>
                   <th>Data do contato</th>
                   <th>Contato cliente</th>
                   <th>Responsável</th>
                   <th>Tipo de contato</th>
                   <th>Situação</th>              
               </tr>
           </thead>
           <tbody>
               
           </tbody>
       </table>              
        ';      
    }      

    public function prepare()
    {
        $this->getLayout()->addJs(\url()->toRoute('public/common/js/crmSearch.js'));
        $this->getLayout()->addCss(\url()->toRoute('public/common/css/crmsearch.css'));
    }
}