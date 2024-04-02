<?php
namespace App\Localisation\Rules;

use App\Localisation\Models\Localisation as ModelsLocalisation;

class Localisation{
    const LOCALISATION_SESSION_KEY = 'linguagem_atual';

    const DEFAULT_KEY = 'pt_BR';

    private ModelsLocalisation $model;
    public function __construct()
    {
        $this->model = ModelsLocalisation::instance();
    }
    public function setLocalisation(ModelsLocalisation $localisation){
        session()->set(self::LOCALISATION_SESSION_KEY,$localisation->code);
    }

    public function setLocalisationCode(string $code){
        $localisation = $this->model->getByCode($code);
        if(!$localisation->id){
            return;
        }
        $this->setLocalisation($localisation);
    }
    public function getLocalisation():ModelsLocalisation{
        $key = session()->get(self::LOCALISATION_SESSION_KEY);
        if(!$key){
            $key = self::DEFAULT_KEY;
        }
        return $this->model->getByCode($key);
    }

    public function getActives():array{
        return $this->model->getActives();
    }

    public function getDictionary():Dictionary{
        return new Dictionary($this->getLocalisation());
    }

    public static function instance():self{
        return new Localisation();
    }
}