<?php 

namespace App\Layout\Rules\Errors;

use App\Layout\Rules\ALayout;

abstract class AErrors extends ALayout{
    protected array $error = [];

    public function setError(string $error):self {
        $this->dictionary->loadFile('error');
        $this->error=[
        '404' => ['message' => $this->dictionary->get('not-found'), 'image'=>'not-found.png', 'active'=>false],
        '500' => ['message' => $this->dictionary->get('server-error'), 'image'=>'server-error.png', 'active'=>false],
        '403' => ['message' => $this->dictionary->get('no-authentication'), 'image'=>'no-authentication.png', 'active'=>false],
        '401' => ['message' => $this->dictionary->get('permission-denied'), 'image'=>'permission-denied.png', 'active'=>false],
        'construction' => ['message' => $this->dictionary->get('under-construction'), 'image'=>'under-construction.png', 'active'=>false]
        ];
        $this->error[$error]['active']=true;
        return $this;
    }
}
