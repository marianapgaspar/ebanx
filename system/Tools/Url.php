<?php

namespace System\Tools;

class Url{
    private string $baseUrl = '';
    private string $appDir = '';

    public function __construct(string $url, string $appDir)
    {
        $this->setBaseUrl($url);
        $this->appDir = $appDir;
    }
    public function setBaseUrl(string $url){
        $this->baseUrl = $url;
    }

    public function toRoute(string $route, array $uri = []):string{
        if (empty($uri)){
            return trim($this->baseUrl,'/').'/'.trim($route,'/');
        } else {
            $uriString = http_build_query($uri);
            return trim($this->baseUrl,'/').'/'.trim($route,'/').'?'.$uriString;
        }
    }

    public function toPath(string $path):string{
        return '/'.trim($this->appDir,'/').'/'.trim($path,'/');
    }
    
}