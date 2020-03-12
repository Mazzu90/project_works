<?php

namespace Config\Core\Entities;

use Config\Properties;

class Debugger{
    
    function __construct($object = 'DEBUG', $level = false){
        
        $this->level = ($level) ?: Properties::debug_level;
        $this->object = '<br><span style="color:black;"><b>'.$object.': </b>';
        //$this->generic(' debugger  CREATED');        
    }
    
    private $object;
    private $target_method;
    private $calling_method;
    private $entity;
    public  $level;
    
   
    public function tryingToCreate($entity = '', $calling_method='', $target_method = '', $target_object = false){
        
        if($this->level >= 3):
        
            $this->method = $target_method;
            $this->entity = $entity;
            if(!isset($target_object)) $target_object = $target_object;
            
            echo $this->object.'<span style="color:grey;"><i>'.$calling_method.' - </i></span>'.'<span style = "color:orange;"> Trying to create '.$entity.'...</span>'.'<span style="color:lightgrey;">('.$target_object.' @ <i>'.$target_method.'</i>)</span></span>';        
        
        endif;
    }
    
    public function creating($method = ''){
        
        if($this->level >= 3):
            echo $this->object.'<span style="color:grey;"><i> @ '.$method.' - </i>'.'<span style="color:orange;">Creating... </span></span></span>';  
        endif;
    }
    
    public function created(){
        
        if($this->level >= 3):
            echo $this->object.'<span style="color:grey;"><i># '.$this->method.' =  </i><span style = "color:green;">'.$this->entity.' Created!</span> </span></span>';
            unset($this->method);
            unset($this->entity); 
        endif;        
    }
    
    
    
    public function tryingToConstruct($entity = '', $method=''){       
        
        if($this->level >= 2):
            echo $this->object.'<span style="color:grey;"><i>'.$method.' - </i></span>'.'<span style = "color:salmon;"> Trying to construct '.$entity.'...</span></span>';        
        endif;
    }
    
    public function constructing(){
        
        if($this->level >= 2):
            echo $this->object.'<span style="color:red;">Constructing... </span></span>';  
        endif;
    }
    
    public function constructed(){
        
        if($this->level >= 2):
            echo $this->object.'<span style="color:blue;"><b> CONSTRUCTED!!! </b></span></span>';  
        endif;
    }
    
    
    
      

    
    public function tryingToSet($field = '', $method = ''){
        
        if($this->level >= 4):
            echo $this->object.'<span style="color:grey;"><i>@ '.$method.' - </i><span>'.'<span style="color:orange;">Trying To Set: '.$field.'</span></span>';
        endif; 
    }
    
    public function tryingToGet($field = '', $method = '', $object = ''){
        
        if($this->level >= 4):
            echo $this->object.'<span style="color:grey;">'.$object.'<i>@ '.$method.' - </i><span>'.'<span style="color:orange;">Trying To Get: '.$field.'</span></span>';
        endif;
    }
    
    
    
    public function generic($log = ''){
        
        if($this->level >= 1):
            echo $this->object.'<span>'.$log.'</span></span>';
        endif;
    }

    
       
    
}




?>