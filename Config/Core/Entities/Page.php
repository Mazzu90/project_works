<?php 

namespace Config\Core\Entities;

use Config\Core\Entities\Debugger;

abstract class Page{
    
    public $properties;
    
    public function __construct($properties){        
            
        $this->debug = new Debugger('PAGE/'.$properties->name);
        $method = '__construct()';
        
        $this->debug->constructing();            
        
        $this->debug->tryingToSet('$this->properties',$method);
        $this->properties = $properties;
        
        $this->debug->constructed();
    }

}


?>