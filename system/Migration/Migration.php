<?php
namespace System\Migration;

use App\Migration\Models\Settings;
use System\Exceptions\SqlException;
use System\Exceptions\ValidationException;
use System\Migration\Models\MigrationModel;
use System\Server\Routes;
use System\Tools\Time;

class Migration{

    private MigrationModel $model;

    public function __construct()
    {
        $this->model = MigrationModel::instance();
        (new MigrationTable)->up();
    }
    public function update(){        
        $migrations = $this->model->result();
        $classes = $this->getMigrationClasses($migrations);
        usort($classes,function($data,$data2){
            if(strtotime($data['instance']->getDatetime())>strtotime($data2['instance']->getDatetime())){
                return 1;
            }elseif(strtotime($data['instance']->getDatetime())==strtotime($data2['instance']->getDatetime())){
                return 0;
            }else{
                return -1;
            }
        });
        foreach($classes as $file=>$class){
            try{
                echo  PHP_EOL.$class['className'].PHP_EOL;
                echo $class['instance']->up(); 
                echo PHP_EOL.'------------------------------------------------'.PHP_EOL;

                $model =  MigrationModel::instance()->getByFile(str_replace("\\","\\\\\\",$class["className"]));
                $model->file = $class['className'];
                $model->hash = $class['hash'];
                $model->insert_at = Time::getDateTime()->format('Y-m-d H:i:s');
                $model->save();
            }catch(\Exception $e){
                echo $e->getMessage();
                break;
            }
            
        }
    }

    public function webUpdate(){
        try {
            $migrating = Settings::instance()->getById("migrating");
            $migrating->valor = 1;
            $migrating->save();
            $migrations = $this->model->result();
            $classes = $this->getMigrationClasses($migrations);
            usort($classes,function($data,$data2){
                if(strtotime($data['instance']->getDatetime())>strtotime($data2['instance']->getDatetime())){
                    return 1;
                }elseif(strtotime($data['instance']->getDatetime())==strtotime($data2['instance']->getDatetime())){
                    return 0;
                }else{
                    return -1;
                }
            });
            $message = "";
            foreach($classes as $file=>$class){
                try{
                    $message = $class['instance']->up() ? $class['instance']->up() : ""; 
                    $model =  MigrationModel::instance()->getByFile(str_replace("\\","\\\\\\",$class["className"]));
                    $model->file = $class['className'];
                    $model->hash = $class['hash'];
                    $model->insert_at = Time::getDateTime()->format('Y-m-d H:i:s');
                    $model->save();
                }catch(\Exception $e){
                    $message = "Erro na classe ".$class['className']."/".$e->getMessage();
                    break;
                }

            }
            $migrating = Settings::instance()->getById("migrating");
            $migrating->valor = 0;
            $migrating->save();
            if ($message){
                response()->json(['message'=>$message],500);
            }
        } catch (ValidationException $e){
            response()->json(['message'=>$e->getMessage()],500);

        } catch (SqlException $e){
            response()->json(['message'=>$e->getMessage()],500);

        }
    }
    private function getMigrationClasses(array $migrations):array{
        $files = glob(APP_DIR."/app/*/Migration/*.php");
        $classes = [];
        $migrationsClasses = array_map(function($data){return $data->file;},$migrations);
        $migrationsHashs = array_map(function($data){return $data->hash;},$migrations);
        foreach($files as $file){
            $fileRelative = str_replace(APP_DIR."/app/",'',$file);
            $path = explode('/',$fileRelative);
            $className = "App\\{$path[0]}\Migration\\".basename($fileRelative,'.php');
            $hash = hash('sha256',file_get_contents($file));
            if(in_array($className,$migrationsClasses)){
                if($migrationsHashs[array_search($className,$migrationsClasses)] == $hash)
                continue;
            }
            $classes[] = ['instance'=>new $className,'className'=>$className,'hash'=>$hash];
        }
        return $classes;
    }
}