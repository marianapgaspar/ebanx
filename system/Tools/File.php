<?php
namespace System\Tools;
class File{
    private string $tempName = '';
    private string $extension = '';

    public function __construct(string $key)
    {
        $file = $_FILES[$key];
        $this->extension = strstr($file['name'],'.');//pega o final do arquivo pdf, png...
        $this->tempName = $file['tmp_name'];
       return $this;
       
    }

    public function saveTo($path,$fileName):string{  
        if(strlen($this->extension)>0 && $this->tempName){
            if (strtolower($this->extension) == ".exe"){
                return "";
            }
            $pathParts = explode('/',trim($path,'/'));
            $pathString = '';
            foreach($pathParts as $pathPart){
                $pathString .='/'.$pathPart;
                if(!is_dir($pathString)){
                    mkdir($pathString, 755, true);
                }
            }
            $fileName = trim($path,'/').'/'.$fileName.$this->extension;
            /**
             * Incluído validação da extesão para mitigação de erros dos arquivos enviados
             * @author Felipe Corassari
             */

            
            file_put_contents('/'.$fileName,file_get_contents($this->tempName));
            return str_replace(APP_DIR,'','/'.$fileName);
            
        }else{
            
            return '';
       } 

    }
    
    public static function instance(string $name):self{
        return new File($name);
    }
}