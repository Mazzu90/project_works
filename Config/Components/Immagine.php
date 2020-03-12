<?php 

namespace Config\Components;

use Config\Core\Entities\Component;
use Config\Core\Query\Basic;
use Config\Core\Entities\Debugger;

class Immagine extends Component{
    
    private $debug;

    public function __construct($obj = false)
    {
        $this->debug = new Debugger('IMMAGINE');
        $method = '__construct()';
        $this->debug->constructing();

        $this->debug->tryingToConstruct('Component', $method);
        parent::__construct();

        $this->debug->generic("show fields after Components Constructor:");
        //print_r($this->show_fields);
        
        //recupero l'id per la ricerca
        if($obj):
            $this->debug->generic("obj != false, setting Immagine for research");
            $this->id_veicolo = new Basic($this->table, 'id_veicolo');
            $this->id_veicolo->value = $obj->id;
        endif;
        
        $this->debug->constructed();
    }
    
    //RICHIESTO DA COMPONENTE
    public static function getTable()
    {
        return 'immagini';
    }
    
    //RICHIESTO DA COMPONENTE
    public static function getClass()
    {
       return __NAMESPACE__.'\Immagine';
    }   
    
}


