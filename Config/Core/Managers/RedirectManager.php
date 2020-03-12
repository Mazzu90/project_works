<?php

namespace Config\Core\Managers;

use Config\Core\Entities\Debugger;


class RedirectManager{
    
    public static function getPageIdx($request_url){

        $method = 'getPageIndex()';
        $debug = new Debugger('REDIRECT MANAGER');       
        
        $debug->tryingToSet('archive', $method);
        $archive = PageManager::getPublishedPages();
        
        foreach($archive as $page=>$properties ):
            
            //$debug->generic('Url: '.$properties->url);
            $debug->tryingToGet('url', $method);
            if($properties->url == "/$request_url")
                return $properties->idx;       
        
        endforeach;
        
        return 1;
    }
    
}


