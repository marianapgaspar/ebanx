<?php
require "config.php";
$module = $argv[1];
$table = $argv[2];

$mysql = new \mysqli(APP_DB_HOST,APP_DB_USER,APP_DB_PASSWORD,APP_DB_NAME);


$result =  $mysql->query("SHOW COLUMNS FROM $table");
$data = '';
$primarys = [];
while ($row =$result->fetch_assoc() ) {

   $data .= getMethod($row['Field'],$row["Type"]);
   if($row['Key']=='PRI'){
        $data .=";";
        $primarys[] = $row['Field'];
   }else{
        $data .="->nullable(true);";
   }
   $data .=PHP_EOL;
}
if($primarys){
    $data .= '$table->primaryKey("'.implode(', ',$primarys).'");'.PHP_EOL;
}
$className = getclassname($table);
$template = file_get_contents(__DIR__."/templates/migration_import.template");
$template = str_replace(["{{module_name}}","{{class_name}}","{{table_name}}","{{table_field}}","{{date_time}}"],[$module,$className,$table,$data,date('Y-m-d H:i:s')],$template);
file_put_contents(__DIR__."/app/$module/Migration/$className.php",$template);

function getMethod($field,$type){
    if($type=='int'){
        return '$table->addInt("'.$field.'")';
    }
    if(strpos($type,'varchar')!==false){
        $size = str_replace(['varchar(',')'],'',$type);
        return '$table->addVarchar("'.$field.'")->size("'.$size.'")';
    }
    if(strpos($type,'float')!==false){
        $size = str_replace(['float(',')'],'',$type);
        return '$table->addFloat("'.$field.'")->size("'.$size.'")';
    }
    if(strpos($type,'tinyint')!==false){
        $size = str_replace(['tinyint(',')'],'',$type);
        return '$table->addTinyint("'.$field.'")';
    }
    if($type=='date'){
        return '$table->addDate("'.$field.'")';
    }
    if($type=='time'){
        return '$table->addTime("'.$field.'")';
    }
    if(strpos($type,'decimal')!==false){
        $size = str_replace(['decimal(',')'],'',$type);
        return '$table->addDecimal("'.$field.'")->size("'.$size.'")';
    }
    if(strpos($type,'datetime')!==false){
        return '$table->addDatetime("'.$field.'")';
    }
    if(strpos($type,'text')!==false){
        return '$table->addText("'.$field.'")';
    }
}
function getclassname($tableName){
    $tablenamearray = explode("_",$tableName);
    foreach($tablenamearray as &$name){
        $name = ucfirst($name);
    }
    $tableName = implode("",$tablenamearray);
    return "Create".$tableName."Table";
}
