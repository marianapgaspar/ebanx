<?php
namespace App\Users\Models;


use System\Models\TableModel;


class UsersLog extends TableModel{
    protected string $table = "user_log";
    protected array $fields = ["codigo","dt_emis","nome_user","assunto","narrativa"];
    protected array $primaryKeys = ["codigo"];  
    
    public function setDtCriacao(string $dt_criacao):self{
        $this->dt_criacao = $dt_criacao;
        return $this;
    }
    
    public function setAssunto(string $assunto):self{
        $this->assunto = $assunto;
        return $this;
    }

    public function setNarrativa(string $narrativa):self{
        $this->narrativa = $narrativa;
        return $this;
    }
}