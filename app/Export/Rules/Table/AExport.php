<?php

namespace App\Export\Rules\Table;

abstract class AExport{
    protected array $columns =[];

    protected array $data = [];

    public function __construct(array $columns, array $data)
    {
        $this->columns = $columns;
        $this->data = $data;
    }

    abstract function export(string $file);

    public static function instance(array $columns, array $data):AExport{
        $namespace = get_called_class();
        return new $namespace($columns,$data);
    }
}