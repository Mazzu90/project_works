<?php             
                
namespace Config\Pages;                    

use Config\Core\Entities\Debugger; 
use Config\Core\Entities\Page;                     

class Contatti extends Page{                                   
    
    public function show(){
        $method = "show()";
     
        echo 'ciao', get_class($this), 'ciao';                               
    }
}
?>