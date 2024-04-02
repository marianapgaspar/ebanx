<?php

namespace App\Error\Web;

class Errors{

    public function notFound(){
        $error = layout()->error();
        $error->setError('404');

        response()->html($error->html(),404);
    }
    public function serverError(){
        $error = layout()->error();
        $error->setError('500');

        response()->html($error->html(),500);
    }
    public function noAuthentication(){
        $error = layout()->error();
        $error->setError('403');

        response()->html($error->html(),403);
    }
    public function permissionDenied(){
        $error = layout()->error();
        $error->setError('401');

        response()->html($error->html(),401);
    }
    public function construction(){
        $error = layout()->error();
        $error->setError('construction');

        response()->html($error->html());
    }
}