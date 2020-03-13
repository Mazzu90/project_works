<?php             
                
namespace Config\Pages;                    

use Config\Components\Immagine;
use Config\Core\Entities\Debugger;
use Config\Core\Entities\Page;                     

class Servizi extends Page{                                   
    
    public function show(){
        $method = "show()";

        $list = Veicolo::getListBy('id', '3972');
        var_dump($list);
    }
}
?>