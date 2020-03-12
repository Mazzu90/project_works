<?php 

namespace Config\Core\Properties;

use Config\Core\Entities\Debugger;
use Config\SiteMap;

class PageProperties{
    
    private $debug;    

    const page_namespace = 'Config\\Pages\\';
    private static $page;
    private static $properties;
    private $default_name; 
    
    
    public function __construct($page, $properties){
        
        $this->debug = new Debugger('PAGE PROPERTIES');
        $method = '__construct()';
                    
        $this->debug->constructing();
        
        self::$page = strtolower($page); 
        $this->debug->generic(self::$page);
        
        if($properties):
                    
            $this->debug->tryingToSet('title', $method);
            $this->title = $properties['title'] ?: SiteMap::default_title;            
            
            $this->debug->tryingToSet('description', $method);
            $this->description = $properties['description'] ?: SiteMap::default_description;
            
            $this->debug->tryingToSet('keywords', $method);
            $this->keywords = $properties['keywords'] ?: SiteMap::default_keywords;
            
            $this->debug->tryingToSet('name', $method);
            $this->name = $properties['name'] ?: (str_replace('_', ' ', self::$page));
            
            $this->debug->tryingToSet('idx', $method);
            $this->idx = $properties['idx'] ?: constant('Config\SiteMap::'.self::$page.'_idx');
            //$this->generic('idx: '.$this->idx);
            
            $this->debug->tryingToSet('url', $method);
            $this->url = $this->chooseUrl($properties['rewrited_url']);       
            
            $this->debug->tryingToSet('hide_in_navbar', $method);
            $this->hide_in_navbar = $properties['hide_in_navbar'] ?: false;
            
            $this->debug->tryingToSet('nav_element_type', $method);
            $this->nav_element_type = $properties['nav_element_type'] ?: null;

            $this->debug->tryingToSet('hide_in_footer_links', $method);
            $this->hide_in_footer_links = $properties['hide_in_footer_links'] ?: false;
            
            $this->debug->tryingToSet('published', $method);
            $this->unpublished = $properties['unpublish'] ?: false;
            
            $this->debug->tryingToSet('page', $method);
            $this->class = $properties['page'] ?: $this->defaultClass(); 
            $this->debug->generic($this->class);          
        
        else:

            $this->defaultPage($page);
        
        endif;
        
        $this->debug->constructed();
    }
    
    private function chooseUrl($rewrited_url = null){
        
        $direct_link = SiteMap::direct_link.$this->idx; 
        
        if(SiteMap::url_rewrite):
            if($rewrited_url):
                return  $rewrited_url;
            else:    
                return '/'.self::$page;
            endif;
        else:
            return $direct_link;
        endif;
    }
    
    private function defaultPage(){
        
        $method = 'defaultPage()';
        
        $this->debug->tryingToSet('title', $method);
        $this->title = SiteMap::default_title;
        
        $this->debug->tryingToSet('description', $method);
        $this->description = SiteMap::default_description;
        
        $this->debug->tryingToSet('keywords', $method);
        $this->keywords = SiteMap::default_keywords;
        
        $this->debug->tryingToSet('name', $method);
        $this->name = strtoupper(str_replace('-', ' ', self::$page));
        
        $this->debug->tryingToSet('idx', $method);
        $this->debug->generic('constant: '.'Config\SiteMap::'.self::$page.'_idx =  '.constant('Config\SiteMap::'.self::$page.'_idx'));
        $this->idx = constant('Config\SiteMap::'.str_replace('-','_', self::$page).'_idx');
        //$this->generic('idx: '.$this->idx);
        
        $this->debug->tryingToSet('url', $method);
        $this->url = $this->chooseUrl();       
        
        $this->debug->tryingToSet('hide_in_navbar', $method);
        $this->hide_in_navbar = false;
        
        $this->debug->tryingToSet('nav_element_type', $method);
        $this->nav_element_type = null;
        
        $this->debug->tryingToSet('hide_in_footer_links', $method);
        $this->hide_in_footer_links = false;
        
        $this->debug->tryingToSet('unpublished', $method);
        $this->unpublish = false;
        
        $this->debug->tryingToSet('class', $method);
        $this->class = $this->defaultClass(); 

        $this->debug->constructed();       
    }
    
    private function defaultClass(){
        
        $page = str_replace('-', ' ', self::$page);
        $page = ucwords($page);
        
        return self::page_namespace.str_replace(' ', '', $page);       
        
    }

}

?>