<?php             
                
namespace Config\Pages;                    

use Config\Core\Entities\Debugger; 
use Config\Core\Entities\Page;  
use Config\Components\Veicolo;       
use Config\ComponentsMap;
use Config\Components\HtmlGenerator;
use Config\Template\ResearchForm;

class Marchi extends Page{                                   
    
    public function show(){
        $method = "show()";
            
        $generator = new HtmlGenerator();
        //$generator->stampaLista(new Veicolo(ComponentsMap::show_idx));
        //$lista_marchi = Veicolo::getDistinct('make');

        //print_r($lista_marchi);

        $configurations = array(

            0 => array(
                'name' => "1['make']",
                'id' => 'make',
                'options' => Veicolo::getDistinct(array('id_marca', 'make'), ' field_1 ASC'),
            ),

            1 =>array(
                'name' => "1['model']",
                'id' => 'model',
                'options' => Veicolo::getDistinct(array('id_modello', 'model'), ' field_1 ASC'),
            )
        );


        $form = new ResearchForm();
        $form->createSelect('TEST', $configurations);

    }
}
?>