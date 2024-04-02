<?php
namespace App\Users\Rules;

use App\Users\Models\Users;
use App\Users\Rules\Authentication\Authentication;

class Scopes{
    #usuarios
    const USERS = 'users';
    const USERS_GROUPS = 'users_groups';
    const SETOR = 'setor';

    const HOME = "home";

    #clientes
    const CLIENTE = 'cliente';
    const CLIENTE_FINANCEIRO = 'cliente_financeiro';
    const CLIENTE_COMERCIAL = 'cliente_comercial';
    const CLIENTE_VISUALIZA_EXCECAO = 'cliente_visualiza_excecao';
    const CLIENTE_CADASTRA_EXCECAO = 'cliente_cadastra_excecao';
    const CLIENTE_DELETA_EXCECAO = 'cliente_deleta_excecao';
    const CLIENTE_EXCLUIR = 'cliente_excluir';
    const CLIENTE_EXCLUIR_DOCUMENTO = "cliente_excluir_documento";
    const CLIENTE_SERASA = "cliente_serasa";
    const CLIENTE_CONFIGURACOES = "cliente_configuracoes";
    const CLIENTE_HISTORICO = "cliente_historico";
    const CLIENTE_EXCLUIR_CONTATO = 'cliente_excluir_contato';
    const CONSULTA_SALDO = 'consulta_saldo';
    const CONSULTA_SALDO_DETALHE = 'consulta_saldo_detalhe';

    #pedidos
    const PEDIDO = 'pedido';
    const PEDIDO_FINANCEIRO = 'pedido_financeiro';
    const PEDIDO_COMERCIAL = 'pedido_comercial';
    const PEDIDO_APROVACAO_EXCECAO = 'pedido_aprovaca_excecao';
    const PEDIDO_REABRIR = 'pedido_reabrir';
    const PEDIDO_CONFIGURACOES = 'pedido_configuracoes';

    #treinamentos
    const TREINAMENTOS = 'treinamentos';
    const TREINAMENTOS_ADM = 'treinamentos_adm';
    const TREINAMENTOS_PROVAS = 'treinamentos_provas';

    #engenharia
    const ENG_MENU = 'eng_menu';
    const ENG_ENSAIO = 'eng_ensaio';
    const ENG_ENSAIO_CONFERENTE = 'eng_ensaio_conferente';
    const ENG_ENSAIO_APROVACAO = 'eng_ensaio_aprovacao';
    const ENG_ETIQUETA_PROVISORIA = "eng_etiqueta_provisoria";
    const ENG_ETIQUETA_EMBALAGEM = "eng_etiqueta_embalagem";
    const ENG_ETIQUETA_ITEM = "eng_etiqueta_item";
    const ENG_ETIQUETA_ITEM_INSERIR = "eng_etiqueta_item_inserir";
    const ENG_ETIQUETA_ITEM_APROVACAO = 'eng_etiqueta_item_aprovacao';
    const ENG_ETIQUETA_ITEM_HOMOLOGACAO = 'eng_etiqueta_item_homologacao';
    const ENG_ETIQUETA_ITEM_SEQUENIAL = 'eng_etiqueta_item_sequencial';
    const ENG_ETIQUETA_ITEM_RESUMIDA = 'eng_etiqueta_item_resumida';
    const ENG_CONFIGURACOES = "eng_configuracoes";
    const ENG_DOCUMENTOS = "eng_documentos";
    const ENG_DOCUMENTOS_INSERE = "eng_documentos_insere";
    const ENG_TTR = "eng_ttr";
    const ENG_TTR_ATUALIZA = "eng_ttr_atualiza_eletromecanica";
    const ENG_TTR_RESUMIDA = "eng_ttr_resumida_eletr";
    const ENG_FAIXA_ESTATOR = "eng_faixa_estator";
    
    const MANUFATURA = 'manufatura';
    const MANUFATURA_CADASTROS = 'manufatura_cadastros';
    const MANUFATURA_METAS = 'manufatura_metas';

    #Compras
    const COMPRAS = 'compras';
    const COMPRAS_REQUISICAO = 'compras_requisicao';
    const COMPRAS_REQUISICAO_GERENTE = 'compras_requisicao_gerente';
    const COMPRAS_REQUISICAO_COMPRAS = 'compras_requisicao_compras';
    const COMPRAS_REQUISICAO_DIRETOR = 'compras_requisicao_diretor';
    const COMPRAS_NECESSIDADE_COMPRA = 'compras_necessidade_compra';
    const COMPRAS_ORDEM_COMPRA = 'compras_ordem_compra';
    const COMPRAS_SALDO_ESTOQUE = 'compras_saldo_estoque';
    const COMPRAS_NECESSIDADE_FABRICA = 'compras_necessidade_fabrica';
    const COMPRAS_PEDIDO_COMPR = 'compras_pedido_compr';
    const COMPRAS_PEDIDO_COMPR_APROVACAO = 'compras_pedido_compr_aprovacao';
    const COMPRAS_PEDIDO_COMPR_REABRIR = 'compras_pedido_compr_reabrir';
    const COMPRAS_RELATORIOS = 'compras_relatorios';

    #Qualidade
    const QUALIDADE = 'qualidade';
    const QUALIDADE_ORD_PROD = 'qualidade_ord_prod';
    const QUALIDADE_PLANEJA_ORD_PROD = "qualidade_planeja_ord_prod";
    const QUALIDADE_TESTE = 'qualidade_teste';
    const QUALIDADE_TESTE_FORCAR = 'qualidade_teste_forcar';
    const QUALIDADE_TESTE_EXCLUIR = 'qualidade_teste_excluir';
    const QUALIDADE_VALIDA_EMBALAGEM = 'qualidade_valida_embalagem';
    const QUALIDADE_GRAFICO_DEFEITO = 'qualidade_grafico_defeito';
    const QUALIDADE_GRAFICO_ITEM_DEFEITO = 'qualidade_grafico_item_defeito';
    const QUALIDADE_GRAFICO_TESTE_HORA = 'qualidade_grafico_teste_hora';
    const QUALIDADE_GRAFICO_EMBALAGEM_HORA = 'qualidade_grafico_embalagem_hora';
    const QUALIDADE_TESTES_EMBALAGENS = "qualidade_testes_embalagens";
    const QUALIDADE_EXPORTAR_EMBALAGEM = "qualidade_exportar_embalagens";
    const QUALIDADE_CONFIGURACOES = "qualidade_configuracoes";

    #configurações portal
    const CONFIGURACOES = "configuracoes";
    const CONFIGURACOES_INTEGRACAO = "conficuracoes_integracao";
    const CONFIGURACOES_EMAIL = "conficuracoes_email";
    const CONFIGURACOES_TRIGGERS = "conficuracoes_triggers";
    const CHAMADOS = "chamados";
    const CONFIGURACOES_SUPORTE = "conficuracoes_suporte";
    const CONFIGURACOES_RESPONDE_CHAMADOS = "conficuracoes_responde_suporte";
    const DESENVOLVEDORES = "desenvolvedores";

     #assistencia
     const ASSISTENCIA_MENU = 'assistencia_menu';
     const ASSISTENCIA = 'assistencia';
     const ASSISTENCIA_FABRICA = 'assistencia_fabrica';
     const ASSISTENCIA_NF = 'assistencia_nf';
     const ASSISTENCIA_NF_CONF = 'assistencia_nf_conf';
     const ASSISTENCIA_NF_FIN = 'assistencia_nf_fin';
     const ASSISTENCIA_RELATORIOS = 'assistencia_relatorios';
     const ASSISTENCIA_GRAFICOS = 'assistencia_graficos';
     const ASSISTENCIA_CONFIGURACOES = 'assistencia_configuracoes';
     const ASSISTENCIA_EXCLUIR_ORDEM_SERVICO = 'assistencia_excluir_ordem_servico';
    
    #Metas
    const METAS = 'metas';
    const METAS_COMERCIAL = 'metas_comercial';
    const METAS_MANUFATURA = 'metas_manufatura';
    
    public static function getAllScopes():array{
        return [
            self::USERS,
            self::USERS_GROUPS,
            self::SETOR,
            
            self::HOME,
            
            self::CLIENTE,
            self::CLIENTE_FINANCEIRO,
            self::CLIENTE_COMERCIAL,
            self::CLIENTE_VISUALIZA_EXCECAO,
            self::CLIENTE_CADASTRA_EXCECAO,
            self::CLIENTE_DELETA_EXCECAO,
            self::CLIENTE_EXCLUIR,
            self::CLIENTE_EXCLUIR_DOCUMENTO,
            self::CLIENTE_SERASA,
            self::CLIENTE_CONFIGURACOES,
            self::CLIENTE_HISTORICO,
            self::CLIENTE_EXCLUIR_CONTATO,
            self::CONSULTA_SALDO,
            self::CONSULTA_SALDO_DETALHE,

            self::ASSISTENCIA,
            self::ASSISTENCIA_FABRICA,

            self::PEDIDO,
            self::PEDIDO_FINANCEIRO,
            self::PEDIDO_COMERCIAL,
            self::PEDIDO_CONFIGURACOES,
            self::PEDIDO_REABRIR,
            self::PEDIDO_APROVACAO_EXCECAO,

            self::TREINAMENTOS,
            self::TREINAMENTOS_ADM,
            self::TREINAMENTOS_PROVAS,

            self::MANUFATURA,
            self::MANUFATURA_CADASTROS,
            self::MANUFATURA_METAS,
            
            self::COMPRAS,
            self::COMPRAS_REQUISICAO,
            self::COMPRAS_REQUISICAO_GERENTE,
            self::COMPRAS_REQUISICAO_COMPRAS,
            self::COMPRAS_REQUISICAO_DIRETOR,
            self::COMPRAS_NECESSIDADE_COMPRA,
            self::COMPRAS_ORDEM_COMPRA,
            self::COMPRAS_SALDO_ESTOQUE,
            self::COMPRAS_NECESSIDADE_FABRICA,
            self::COMPRAS_PEDIDO_COMPR,
            self::COMPRAS_PEDIDO_COMPR_REABRIR,
            self::COMPRAS_PEDIDO_COMPR_APROVACAO,
            self::COMPRAS_RELATORIOS,

            self::ENG_MENU,
            self::ENG_ENSAIO,
            self::ENG_ENSAIO_CONFERENTE,
            self::ENG_ENSAIO_APROVACAO,
            self::ENG_ETIQUETA_PROVISORIA,
            self::ENG_ETIQUETA_EMBALAGEM,
            self::ENG_ETIQUETA_ITEM,
            self::ENG_ETIQUETA_ITEM_INSERIR,
            self::ENG_ETIQUETA_ITEM_APROVACAO,
            self::ENG_ETIQUETA_ITEM_HOMOLOGACAO,
            self::ENG_ETIQUETA_ITEM_RESUMIDA,
            self::ENG_ETIQUETA_ITEM_SEQUENIAL,
            self::ENG_CONFIGURACOES,
            self::ENG_TTR,
            self::ENG_TTR_ATUALIZA,
            self::ENG_TTR_RESUMIDA,
            self::ENG_FAIXA_ESTATOR,
            self::ENG_DOCUMENTOS,
            self::ENG_DOCUMENTOS_INSERE,

            self::QUALIDADE,
            self::QUALIDADE_ORD_PROD,
            self::QUALIDADE_PLANEJA_ORD_PROD,
            self::QUALIDADE_TESTE,
            self::QUALIDADE_TESTE_EXCLUIR,
            self::QUALIDADE_TESTE_FORCAR,
            self::QUALIDADE_VALIDA_EMBALAGEM,
            self::QUALIDADE_GRAFICO_DEFEITO,
            self::QUALIDADE_GRAFICO_TESTE_HORA,
            self::QUALIDADE_GRAFICO_EMBALAGEM_HORA,
            self::QUALIDADE_TESTES_EMBALAGENS,
            self::QUALIDADE_GRAFICO_ITEM_DEFEITO,
            self::QUALIDADE_CONFIGURACOES,
            self::QUALIDADE_EXPORTAR_EMBALAGEM,

            self::METAS,
            self::METAS_COMERCIAL,
            self::METAS_MANUFATURA,

            self::DESENVOLVEDORES,
            self::CONFIGURACOES,
            self::CONFIGURACOES_EMAIL,
            self::CONFIGURACOES_SUPORTE,
            self::CHAMADOS,
            self::CONFIGURACOES_RESPONDE_CHAMADOS
        ];
    }

    public static function getScopesByTheme(string $theme):array{
        $arr['CONFIGURACOES-PORTAL'] = [
            self::CONFIGURACOES,
            self::CONFIGURACOES_EMAIL,
            self::USERS,
            self::USERS_GROUPS,
            self::SETOR
        ];
        $arr['HOME'] = [
            self::HOME
        ];
        $arr['CLIENTES'] = [
            self::CLIENTE,
            self::CLIENTE_FINANCEIRO,
            self::CLIENTE_COMERCIAL,
            self::CLIENTE_EXCLUIR,
            self::CLIENTE_EXCLUIR_DOCUMENTO,
            self::CLIENTE_SERASA,
            self::CLIENTE_VISUALIZA_EXCECAO,
            self::CLIENTE_CADASTRA_EXCECAO,
            self::CLIENTE_DELETA_EXCECAO,
            self::CLIENTE_CONFIGURACOES,
            self::CLIENTE_HISTORICO,
            self::CLIENTE_EXCLUIR_CONTATO,
            self::CONSULTA_SALDO,
            self::CONSULTA_SALDO_DETALHE
        ];

        $arr['ASSISTENCIA'] = [
            self::ASSISTENCIA_MENU,
            self::ASSISTENCIA,
            self::ASSISTENCIA_FABRICA,
            self::ASSISTENCIA_NF,
            self::ASSISTENCIA_NF_CONF,
            self::ASSISTENCIA_NF_FIN,
            self::ASSISTENCIA_RELATORIOS,
            self::ASSISTENCIA_GRAFICOS,
            self::ASSISTENCIA_CONFIGURACOES,
            self::ASSISTENCIA_EXCLUIR_ORDEM_SERVICO
        ];
        
        $arr['PEDIDOS'] = [
            self::PEDIDO,
            self::PEDIDO_FINANCEIRO,
            self::PEDIDO_COMERCIAL,
            self::PEDIDO_REABRIR,
            self::PEDIDO_CONFIGURACOES,
            self::PEDIDO_APROVACAO_EXCECAO
        ];

        $arr['TREINAMENTOS'] = [
            self::TREINAMENTOS,
            self::TREINAMENTOS_ADM,
            self::TREINAMENTOS_PROVAS
        ];

        $arr['MANUFATURA'] = [
            self::MANUFATURA,
            self::MANUFATURA_CADASTROS,
            self::MANUFATURA_METAS,
        ];
        $arr['METAS'] = [
            self::METAS,
            self::METAS_COMERCIAL,
            self::METAS_MANUFATURA,
        ];
        $arr['ENGENHARIA'] = [
            self::ENG_MENU,
            self::ENG_ENSAIO,
            self::ENG_ENSAIO_CONFERENTE,
            self::ENG_ENSAIO_APROVACAO,
            self::ENG_ETIQUETA_PROVISORIA,
            self::ENG_ETIQUETA_EMBALAGEM,
            self::ENG_ETIQUETA_ITEM,
            self::ENG_ETIQUETA_ITEM_INSERIR,
            self::ENG_ETIQUETA_ITEM_APROVACAO,
            self::ENG_ETIQUETA_ITEM_HOMOLOGACAO,
            self::ENG_ETIQUETA_ITEM_SEQUENIAL,
            self::ENG_ETIQUETA_ITEM_RESUMIDA,
            self::ENG_TTR,
            self::ENG_TTR_ATUALIZA,
            self::ENG_TTR_RESUMIDA,
            self::ENG_FAIXA_ESTATOR,
            self::ENG_DOCUMENTOS,
            self::ENG_DOCUMENTOS_INSERE,
        ];
        $arr['COMPRAS'] = [
            self::COMPRAS,
            self::COMPRAS_REQUISICAO,
            self::COMPRAS_REQUISICAO_GERENTE,
            self::COMPRAS_REQUISICAO_COMPRAS,
            self::COMPRAS_REQUISICAO_DIRETOR,
            self::COMPRAS_NECESSIDADE_COMPRA,
            self::COMPRAS_ORDEM_COMPRA,
            // self::COMPRAS_SALDO_ESTOQUE,
            self::COMPRAS_NECESSIDADE_FABRICA,
            self::COMPRAS_PEDIDO_COMPR,
            self::COMPRAS_PEDIDO_COMPR_APROVACAO,
            self::COMPRAS_PEDIDO_COMPR_REABRIR,
            self::COMPRAS_RELATORIOS
        ];
        $arr['QUALIDADE'] = [
            self::QUALIDADE,
            self::QUALIDADE_ORD_PROD,
            self::QUALIDADE_TESTE,
            self::QUALIDADE_TESTE_FORCAR,
            self::QUALIDADE_TESTE_EXCLUIR,
            self::QUALIDADE_VALIDA_EMBALAGEM,
            self::QUALIDADE_GRAFICO_DEFEITO,
            self::QUALIDADE_GRAFICO_TESTE_HORA,
            self::QUALIDADE_GRAFICO_EMBALAGEM_HORA,
            self::QUALIDADE_GRAFICO_ITEM_DEFEITO,
            self::QUALIDADE_CONFIGURACOES,
            self::QUALIDADE_TESTES_EMBALAGENS,
            self::QUALIDADE_EXPORTAR_EMBALAGEM
        ];
        return $arr[$theme];
    }    
}