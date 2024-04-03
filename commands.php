<?php

require "vendor/autoload.php";
require "config.php";
require "system/Tools/Functions.php";
use System\Migration\Migration;
use System\Tools\Time;

Time::updateDateTime();
$action = $argv[1];
excecuteAction($action,$argv);

function excecuteAction($action,$argv){
    switch($action){
        case 'migrate':
            migrate();
            break;
        case 'create:migration':
            createMigration($argv[2],$argv[3]);
            break;
        case 'create:model':
            createModel($argv[2],$argv[3]);
            break;
        case 'create:controller':
            createController($argv[2],$argv[3]);
            break;
        case 'create:route':
            createRoute($argv[2],$argv[3]);
            break;
        case 'create:all':
            // createMigration($argv[2],$argv[3]);
            createModel($argv[2],$argv[3]);
            createController($argv[2],$argv[3]);
            createRoute($argv[2],$argv[3]);
            break;
        case 'create:form':
            createForm($argv[2],$argv[3]);
            break;
        case 'utf-8':
            utf8_converter();
            break;
    }
}

function migrate(){
    (new Migration)->update();
}
function createMigration($module,$table){
    $className = "M".date("YmdHis")."Create".getclassname($table)."Table";
    $template = file_get_contents(__DIR__."/templates/migration.template");
    $template = str_replace(["{{module_name}}","{{class_name}}","{{table_name}}"],[$module,$className,$table],$template);
    file_put_contents(__DIR__."/app/$module/Migration/$className.php",$template);
}
function getclassname($tableName){
    $tablenamearray = explode("_",$tableName);
    foreach($tablenamearray as &$name){
        $name = ucfirst($name);
    }
    $tableName = implode("",$tablenamearray);
    return $tableName;
}

function createModel($module,$table){
    $mysql = new \mysqli('172.30.0.3','root','toor','ebanx');
    $result =  $mysql->query("SHOW COLUMNS FROM $table");
    $data = [];
    $primarys = [];
    while ($row =$result->fetch_assoc() ) {
        $data[] = $row['Field'];
        if($row['Key']=="PRI"){
            $primarys[] = $row['Field'];
        }
    }
    $id = $primarys[0];
    $fields = '"'.implode('","',$data).'"';
    $primarys = '"'.implode('","',$primarys).'"';
    $className = getclassname($table);
    $template = file_get_contents(__DIR__."/templates/model.template");
    $template = str_replace(["{{module_name}}","{{class_name}}","{{table_name}}","{{fields}}","{{primary_keys}}","{{id}}"],
    [$module,$className,$table,$fields,$primarys,$id],$template);
    file_put_contents(__DIR__."/app/$module/Models/$className.php",$template);
}
function createController($module,$table){
    $mysql = new \mysqli('172.30.0.3','root','toor','ebanx');
    $result =  $mysql->query("SHOW COLUMNS FROM $table");
    $data = [];
    $primarys = [];
    while ($row =$result->fetch_assoc() ) {
        $data[] = $row['Field'];
        if($row['Key']=="PRI"){
            $primarys[] = $row['Field'];
        }
    }
    $id = $primarys[0];
    $fields = '"'.implode('","',$data).'"';
    $primarys = '"'.implode('","',$primarys).'"';
    $className = getclassname($table);
    $template = file_get_contents(__DIR__."/templates/controller.template");
    $template = str_replace(["{{module_name}}","{{class_name}}","{{table_name}}","{{fields}}","{{primary_keys}}","{{id}}"],
    [$module,$className,$table,$fields,$primarys,$id],$template);
    file_put_contents(__DIR__."/app/$module/Web/$className.php",$template);
}
function createRoute($module, $table){
    $file = __DIR__."/app/$module/Routes/Web.php";
    $mysql = new \mysqli('172.30.0.3','root','toor','ebanx');
    $result =  $mysql->query("SHOW COLUMNS FROM $table");
    $data = [];
    $primarys = [];
    while ($row =$result->fetch_assoc() ) {
        $data[] = $row['Field'];
        if($row['Key']=="PRI"){
            $primarys[] = $row['Field'];
        }
    }
    $fields = '"'.implode('","',$data).'"';
    $primarys = '"'.implode('","',$primarys).'"';
    $className = getclassname($table);
    $template = file_get_contents(__DIR__."/templates/route.template");
    $template = str_replace(["{{module_name}}","{{class_name}}","{{table_name}}","{{fields}}","{{primary_keys}}"],
    [$module,$className,$table,$fields,$primarys],$template);
    if (!file_exists($file)){
        file_put_contents($file, $template);
    } 
}
function createForm($module,$table){
    $mysql = new \mysqli('172.30.0.3','root','toor','ebanx');
    $result =  $mysql->query("SHOW COLUMNS FROM $table");
    $data = [];
    $primarys = [];
    $inputs = "";
    while ($row =$result->fetch_assoc() ) {
        $data[] = $row['Field'];
        $inputs .= '$this->form->input("'.$row['Field'].'",2);';
        if($row['Key']=="PRI"){
            $primarys[] = $row['Field'];
        }
    }
    $id = $primarys[0];
    $fields = '"'.implode('","',$data).'"';
    $primarys = '"'.implode('","',$primarys).'"';
    $className = getclassname($table)."Form";
    $template = file_get_contents(__DIR__."/templates/form.template");
    $template = str_replace(["{{module_name}}","{{class_name}}","{{table_name}}","{{fields}}","{{primary_keys}}","{{id}}","{{inputs}}"],
    [$module,$className,$table,$fields,$primarys,$id,$inputs],$template);
    file_put_contents(__DIR__."/app/$module/Rules/$className.php",$template);
}
function utf8_converter(){
    $mysql = new \mysqli(APP_DB_HOST,APP_DB_USER,APP_DB_PASSWORD,APP_DB_NAME);
    $result =  $mysql->query("SHOW TABLES");
   
    while ($row =$result->fetch_assoc() ) {
        $mysql->query("ALTER TABLE {$row['Tables_in_danica']} CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
    }
}
