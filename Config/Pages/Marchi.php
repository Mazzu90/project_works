<?php             
                
namespace Config\Pages;                    

use Config\Components\Immagine;
use Config\Core\Entities\Debugger;
use Config\Core\Entities\Page;  
use Config\Components\Veicolo;       
use Config\ComponentsMap;
use Config\Components\HtmlGenerator;
use Config\Template\ResearchForm;

class Marchi extends Page{                                   
    
    public function show(){
        $method = "show()";
            
        //$generator = new HtmlGenerator();
        //$generator->stampaLista(new Veicolo(ComponentsMap::show_idx));

        //$list = Veicolo::getDistinct(array('id_marca', 'make'), 'make DESC');
        //var_dump($list);

        //$list = Veicolo::getCount('id');
        //var_dump($list);


        //$_REQUEST[ComponentsMap::veicolo_idx]['range']['km']['min'] = '1000';

        //$list = Veicolo::getList();
        //var_dump($list);

        //$list = Immagine::getList();
        //$list = Immagine::getListBy('id_veicolo', 3821);
        //$list = Veicolo::getListBy('id', 3980);
        //var_dump($list);
        //echo $list;
        //$lista_marchi = Veicolo::getDistinct('make');
        $core_object = ComponentsMap::veicolo_idx;

        $configurations = array(

            'make' => array(//non funzionante
                'options' => Veicolo::getDistinct(array('id_marca', 'make'), ' make ASC'),
            ),



            1 =>array(
                'name' => "1['model']",
                'id' => 'model',
                'options' => Veicolo::getDistinct(array('id_modello', 'model'), ' model ASC'),
            ),

        );

        print_r($configurations[0]);

        $form = new ResearchForm();
        $form->createSelect('TEST', $configurations);

    }
}
?>