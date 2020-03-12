<?php

namespace Config\Core\Managers;

use Config\Core\Entities\Debugger;
use Config\Core\Factories\PageFactory;
use Config\Core\Properties\PageProperties;
use Config\SiteMap;

class PageManager{
    
    private $debug;
    private $archive = array();   
    
    private static $instance;    
    public static $published_pages;
    public static $navbar_elements = array();
    public static $footer_elements = array();    
    
    public static $last_idx = 0;    
    
    private function __construct(){        
            
        $this->debug = new Debugger('PAGE MANAGER');
        $method = '__construct()';   
        
        $this->debug->constructing(); 
        
        $this->debug->tryingToSet('archive', $method);      
        $this->archive = SiteMap::$pages_archive;
        
        $this->debug->tryingToCreate('ARCHIVE', $method, 'createArchive()');
        $this->createArchive();
        
        $this->debug->constructed();          
    }
    
    private function createArchive(){   
        
        $method = 'createArchive()';
        
        $this->debug->creating($method);
        
        $pages_name = array_keys($this->archive);
        $i=0;
        
        foreach($this->archive as $page):
            
            $this->debug->generic($page);
            
            $this->debug->tryingToSet('this->properties', $method);            
            $properties = (count($page)>0)? $page : false;
            
            $this->debug->tryingToSet('this->page', $method); 
            $page = $pages_name[$i];
            
            $this->debug->tryingToCreate('PAGE PROPERTIES', $method);           
            $pp = new PageProperties($page, $properties);            
            $this->addToLists($pp);
            
            $i++;
            
        endforeach;
        
        ksort(self::$navbar_elements);
        ksort(self::$footer_elements);
        
        echo $this->debug->created();     
    }
        
    private function addToLists($page){
        
        if(!$page->unpublished): 
            
            self::$published_pages[$page->idx] = $page;
            
            if(!$page->hide_in_navbar) self::$navbar_elements[$page->idx] = $page;
        
            if(!$page->hide_in_footer_links) self::$footer_elements[$page->idx] = $page;

            if($page->idx > self::$last_idx) self::$last_idx = $page->idx;
        
        endif;
    }
    
    
    public function getArchive(){
        
        return $this->archive;
    }   
    
    public static function getInstance(){     
        
        self::$instance;
        
        if(self::$instance)
            return self::$instance;
        else  
           self::$instance = new PageManager();
           
        return self::$instance;    
        
    }
    
    public static function getPage($page_idx){

        self::getInstance();
        return PageFactory::createPage(self::$published_pages[$page_idx]);
    }

    public static function getPublishedPages(){

        self::getInstance();
        return self::$published_pages;
    }
    
}


?>