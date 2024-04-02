<?php
namespace System\Migration\Interfaces;

interface IMigration{
    
    public function up():string;

    public function down():string;

    public function getDatetime():string;

}