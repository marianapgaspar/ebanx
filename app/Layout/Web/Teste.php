<?php
namespace App\Layout\Web;

use App\Layout\Rules\Layouts\Login\Login;
use App\Map\Models\Points;
use System\Server\Entities\Request;

class Teste{
    public function teste(Request $request,$nome){
        $dashboard = layout('Mapapon')->dashboard();
        $dashboard->setContents(view(url()->toPath("public/map/map.php")));
        response()->html($dashboard->html());
    }

    public function getPoints(Request $request,string $name){
        $result = Points::instance()->searchByProductName($name);
        $return = [];
        foreach($result as $row){
            $return[] = $row->toArray();
        }
        response()->json($return);
    }
}