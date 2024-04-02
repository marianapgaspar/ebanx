<?php
namespace App\Trigger\Models;

use System\DataBase\Entities\Conditionals;
use System\Models\TableModel;

class Triggers extends TableModel{

    const CONCLUIR_EMITENTE_FINANCEIRO = 'concluir_emitente_financeiro';
    const CONCLUIR_EMITENTE_FINANCEIRO_EXCECAO = 'concluir_emitente_financeiro_excecao';
    const CONCLUIR_EMITENTE_COMERCIAL = 'concluir_emitente_comercial';
    const REABRIR_EMITENTE = 'reabrir_emitente';
    const APROVAR_EMITENTE_FINANCEIRO = 'aprovar_emitente_financeiro';
    const REPROVAR_EMITENTE_FINANCEIRO = 'reprovar_emitente_financeiro';
    const REAVALIAR_EMITENTE_FINANCEIRO = 'reavaliar_emitente_financeiro';
    const SUBMETER_DIRETORIA_EMITENTE_FINANCEIRO = 'submeter_diretoria_emitente_financeiro';
    const APROVAR_EMITENTE_COMERCIAL = 'aprovar_emitente_comercial';
    const REPROVAR_EMITENTE_COMERCIAL = 'reprovar_emitente_comercial';
    const APROVAR_EMITENTE_REAVALIA_CREDITO = 'aprovar_emitente_reavalia_credito';
    const REPROVAR_EMITENTE_REAVALIA_CREDITO = 'reprovar_emitente_reavalia_credito';
    const SUBMETE_DIRETORIA_EMITENTE_REAVALIA_CREDITO = 'submete_diretoria_emitente_reavalia_credito';
    
    const LAUDO_ASSISTENCIA = 'laudo_assistencia';
    const REJEITA_FABRICA = 'rejeita_fabrica';
    const APROVA_FABRICA = 'aprova_fabrica';
    const REPROVA_FABRICA = 'reprova_fabrica';
    const ENGREGUE_ASSISTENCIA = 'entregue_assistencia';
    const CONCLUIR_ASSISTENCIA = 'concluir_assistencia';

    const CREDITO_VENCIDO = 'credito_vencido';
    const CREDITO_A_VENCER = 'credito_a_vencer';

    const RECUPERAR_SENHA = 'recuperar_senha';
    const CRIA_CHAMADO = 'cria_chamado';
    const RESPONDE_CHAMADO = 'responde_chamado';
    const ENVIAR_EMAIL_AGENDA = 'enviar_email_agenda';

    const CONCLUIR_PEDIDO_EXCECAO = 'concluir_pedido_excecao';
    const SUBMETER_DIRETORIA_PEDIDO_FINANCEIRO = "submeter_diretoria_pedido_financeiro";
    const APROVAR_PEDIDO_COMERCIAL = "aprovar_pedido_comercial";
    
    const CONCLUIR_REQUISICAO = "concluir_requisicao";
    const REJEITA_REQUISICAO_GERENTE = "rejeita_requisicao_gerente";
    const REPROVA_REQUISICAO_GERENTE = "reprova_requisicao_gerente";
    const ACEITA_REQUISICAO_GERENTE = "aceita_requisicao_gerente";
    const SALVA_REQUISICAO_COMPRADOR = "salva_requisicao_comprador";
    const REJEITA_REQUISICAO_COMPRADOR = "rejeita_requisicao_comprador";
    const REPROVA_REQUISICAO_COMPRADOR = "reprova_requisicao_comprador";
    const ACEITA_REQUISICAO_COMPRADOR = "aceita_requisicao_comprador";
    const SUBMETE_DIRETORIA_REQUISICAO = "submete_diretoria_requisicao";
    const INTEGRACAO_REQUISICAO = "integracao_requisicao";

    const CONCLUI_PEDIDO_COMPRA = "conclui_pedido_compra";
    const APROVA_PEDIDO_COMPRA = "aprova_pedido_compra";
    const REPROVA_PEDIDO_COMPRA = "reprova_pedido_compra";

    const QUALIDADE_RESERVAS = "qualidade_reservas";
    const TNG_COMERCIAL = 'tng_comercial';

    const ASSISTENCIA_NF = "assistencia_nf";
    const ASSISTENCIA_NF_CONF_APROV = "assistencia_nf_conf_aprov";
    const ASSISTENCIA_NF_FIN_APROV = "assistencia_nf_fin_aprov";
    const ASSISTENCIA_NF_CONF_REPROV = "assistencia_nf_conf_reprov";
    const ASSISTENCIA_NF_FIN_REPROV = "assistencia_nf_fin_reprov";

    const TRIGGERS = [
        self::CONCLUIR_EMITENTE_FINANCEIRO,
        self::CONCLUIR_EMITENTE_COMERCIAL,
        self::CONCLUIR_EMITENTE_FINANCEIRO_EXCECAO,
        self::REABRIR_EMITENTE,
        self::APROVAR_EMITENTE_FINANCEIRO,
        self::REPROVAR_EMITENTE_FINANCEIRO,
        self::REAVALIAR_EMITENTE_FINANCEIRO,
        self::SUBMETER_DIRETORIA_EMITENTE_FINANCEIRO,
        self::APROVAR_EMITENTE_COMERCIAL,
        self::REPROVAR_EMITENTE_COMERCIAL,
        self::CREDITO_VENCIDO,
        self::CREDITO_A_VENCER,
        self::RECUPERAR_SENHA,
        self::CRIA_CHAMADO,
        self::RESPONDE_CHAMADO,
        self::APROVAR_EMITENTE_REAVALIA_CREDITO,
        self::REPROVAR_EMITENTE_REAVALIA_CREDITO,
        self::SUBMETE_DIRETORIA_EMITENTE_REAVALIA_CREDITO,
        self::ENVIAR_EMAIL_AGENDA,
        self::CONCLUIR_PEDIDO_EXCECAO,
        self::SUBMETER_DIRETORIA_PEDIDO_FINANCEIRO,
        self::APROVAR_PEDIDO_COMERCIAL,
        self::CONCLUIR_REQUISICAO,
        self::REJEITA_REQUISICAO_GERENTE,
        self::REPROVA_REQUISICAO_GERENTE,
        self::ACEITA_REQUISICAO_GERENTE,
        self::SALVA_REQUISICAO_COMPRADOR,
        self::REJEITA_REQUISICAO_COMPRADOR,
        self::REPROVA_REQUISICAO_COMPRADOR,
        self::ACEITA_REQUISICAO_COMPRADOR,
        self::SUBMETE_DIRETORIA_REQUISICAO,
        self::INTEGRACAO_REQUISICAO,
        self::APROVA_PEDIDO_COMPRA,
        self::REPROVA_PEDIDO_COMPRA,
        self::QUALIDADE_RESERVAS,
        self::LAUDO_ASSISTENCIA,
        self::ASSISTENCIA_NF,
        self::ASSISTENCIA_NF_CONF_APROV,
        self::ASSISTENCIA_NF_FIN_APROV,
        self::ASSISTENCIA_NF_CONF_REPROV,
        self::ASSISTENCIA_NF_FIN_REPROV,
        self::REJEITA_FABRICA,
        self::APROVA_FABRICA,
        self::ENGREGUE_ASSISTENCIA,
        self::CONCLUIR_ASSISTENCIA,
        self::REPROVA_FABRICA,
        self::CONCLUI_PEDIDO_COMPRA
    ];

    const TRIGGER_CLASS_EMAIL = 'trigger_class_email';
    const TRIGGER_CLASS_FILE = 'trigger_class_file';
    const TRIGGER_CLASS_NOTIFICATION = 'trigger_class_notification';

    const TRIGGERS_CLASSES = [
        self::TRIGGER_CLASS_EMAIL,
        self::TRIGGER_CLASS_FILE,
        self::TRIGGER_CLASS_NOTIFICATION
    ];

    protected string $table = "triggers";
    protected array $fields = ["id","trigger_class","class","config"];
    protected array $primaryKeys = ["id"];

    public function getById(int $id):self{
        $this->queryFactory->where('id','=',$id);
        return $this->get();
    }
    public function getByTrigger(string $trigger):array{
        $this->queryFactory->where('trigger_class','=',$trigger);
        return $this->result();
    }
    public function newId(){
        $model = clone $this;
        $model->query()->clearSelect();
        $model->query()->select(['max(id) as id']);
        $model->get();
        return $model->id + 1;
    }   
}