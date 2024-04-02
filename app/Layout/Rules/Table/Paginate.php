<?php

namespace App\Layout\Rules\Table;

use System\DataBase\QueryFactory;
use System\Models\TableModel;

class Paginate{

    private TableModel $model;

    private int $page = 0;
    private int $perPage = 20;

    private int $count = 0;

    private $totalPages = 0;

    private array $links = [];

    private array $uri = [];

    private string $url = '';

    public function create(TableModel $model,string $url,int $page,int $perPage = 20,array $uri = [])
    {
        $this->sql = QueryFactory::mysqli();
        $this->model = $model;
        $this->page = $page;
        $this->perPage = $perPage;
        $this->uri = $uri;
        $this->url = $url;
        $this->prepare();
        $this->createLinks();
    }

    private function prepare(){
        $this->count = $this->model->count();
        $this->totalPages = ceil($this->count/$this->perPage);
    }

    public function getData():array{
        $this->model->query()->limit($this->page*$this->perPage,$this->perPage);
        return $this->model->result();
    }

    private function createLinks(){
        $begin = $this->page - 3;
        $end = $this->page + 3;

        if($this->page > $this->totalPages - 3){
            $begin = $this->totalPages - 6;
        }
        if($this->page < 3){
            $end = 6;
        }

        if($begin < 0){
            $begin = 0;
        }
        if($end > $this->totalPages){
            $end = $this->totalPages;
        }

        for($i = $begin; $i < $end; $i++){
            $this->uri['page'] = $i;
            $this->links[] = ['page'=>$i,'link'=>$this->url.'?'.http_build_query($this->uri)];
        }

    }

    public function getPage():int{
        return $this->page;
    }
    public function getPerPage():int{
        return $this->perPage;
    }
    public function getCount():int{
        return $this->count;
    }
    public function getLinks():array{
        return $this->links;
    }
}