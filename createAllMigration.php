<?php
$mysql = new \mysqli('172.30.0.3','root','toor','danica');
createAll();

function create($module,$table,$date_gedarop){

global $mysql;


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
$template = str_replace(["{{module_name}}","{{class_name}}","{{table_name}}","{{table_field}}","{{date_time}}"],[$module,$className,$table,$data,$date_gedarop],$template);
file_put_contents(__DIR__."/app/$module/Migration/$className.php",$template);
}
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
        return '$table->addTinyint("'.$field.'")->size("'.$size.'")';
    }
    if($type=='date'){
        return '$table->addDate("'.$field.'")';
    }
    if($type=='time'){
        return '$table->addTime("'.$field.'")';
    }
    if($type=='text'){
        return '$table->addText("'.$field.'")';
    }
    if($type=='json'){
        return '$table->addJson("'.$field.'")';
    }
    if(strpos($type,'decimal')!==false){
        $size = str_replace(['decimal(',')'],'',$type);
        return '$table->addDecimal("'.$field.'")->size("'.$size.'")';
    }
    if(strpos($type,'char')!==false){
        $size = str_replace(['char(',')'],'',$type);
        return '$table->addChar("'.$field.'")->size("'.$size.'")';
    }
    if(strpos($type,'datetime')!==false){
        return '$table->addDatetime("'.$field.'")';
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
function createAll(){
    $oldMigrations = glob(__DIR__.'/app/*/Migration/*.php');

    foreach($oldMigrations as $migration){
        $path = explode('/',$migration);
        $modulo=$path[5];
        $nomeArquvivo = str_replace('M','',strstr($path[7],'Create',true));
        if(!$nomeArquvivo){
            continue;
        }
        $dataGerada = DateTime::createFromFormat('YmdHis',$nomeArquvivo)->format('Y-m-d H:i:s');
        $matches = [];
        preg_match("/mysqli\('[a-zA-Z_]*'/",file_get_contents($migration), $matches, PREG_OFFSET_CAPTURE);
        $table = trim(trim(str_replace('mysqli(','',$matches[0][0]),"'"),'"');
        create($modulo,$table,$dataGerada);
        unlink($migration);
    }
}