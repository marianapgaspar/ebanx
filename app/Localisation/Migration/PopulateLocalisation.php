<?php
namespace App\Localisation\Migration;

use App\Localisation\Models\Localisation;
use System\Migration\Interfaces\IMigration;

class PopulateLocalisation implements IMigration{
    public function up():string{
       $localisation = Localisation::instance();
       $localisation->id = 1;
       $localisation->active = 1;
       $localisation->code = 'pt_BR';
       $localisation->image = 'public/localisation/images/pt_BR.png';
       $localisation->save();

       $localisation = Localisation::instance();
       $localisation->id = 2;
       $localisation->code = 'en_US';
       $localisation->active = 1;
       $localisation->image = 'public/localisation/images/en_US.png';
       $localisation->save();

       return "localisation polulated";
    }
    public function down():string{
        return "teste migracao";
    }
    public function getDatetime():string{
        return "2021-01-25 09:35:00";
    }
}