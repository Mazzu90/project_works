<?php 

namespace Config\Components;

use Config\Utils\Util;
use Config\Utils\Data;
use Config\Core\Entities\Debugger;

class Etichetta{
    
    public $field;
    public $venduta;
    public $file_name;
    public $condition;
    public $print;
    public $path = '../../images/';
    private $debug;
    
    public function __construct($print, $condition, $file_name, $venduta = false){

        $this->debug = new Debugger("ETICHETTA");
        $method = '__construct()';
        $this->debug->constructing();

        $this->print = $print;
        $this->condition = 'if($obj->'.$condition.') return true; else return false;';
        $this->file_name = $this->path.$file_name.'.png';
        $this->venduta = $venduta;

        $this->debug->constructed();
    }
    
    public function setList($obj){
       
        $list = array();
        $tot_labels = count($obj->labels);

        for($i = 0; $i<$tot_labels; $i++):
            
            $elm = $obj->labels[$i];
            $label = new Etichetta($elm['print'], $elm['condition'], $elm['file_name'], $elm['venduta']);
            $list[] = $label;
        
        endfor;
    
        return $list;
    }
    
    public static function getEtichetta($obj)
    {        
        $list = self::setList($obj);
        $toPrint = false;
        
        foreach($list as $label):
        
            if($label->print && eval($label->condition)):
                
                if($label->venduta)
                      $label->venduta = 'venduta';

                $toPrint = $label;
            
            endif;
        
        endforeach;

        return $toPrint ?: false;
    }
      
}


?>