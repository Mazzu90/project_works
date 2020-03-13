<?php

namespace Config;

final class ComponentsMap{
    
    const default_namespace = 'Config\Components\\';
    
    //identificativo oggetto veicolo
    const veicolo_idx = 1;
    const optional_idx = 2;
    const immagine_idx = 3;
    const oggetto_idx = 4;
    
    //identificativi costruttori
    const show_idx = -1;
    const custom_var_idx = 2; //component
    const search_idx = 3;
    const distinct_search_idx = 4;
    const count_search_idx = 5;

    //identificativi query
    const return_current_obj_idx = 0;
    const return_dynamic_obj_idx = 1;
    const return_array_idx = 2;
    const return_single_field_idx = 3;

    public static $components = array(
        
        'Veicolo' => array(        
            
            'table' => 'veicoli',        

            'query_parameters' => array(
                'limit' => 2,
                'offset' => null,
                'order'=> 'prezzo DESC'
            ),
        
            'show_fields' => array(                
                'id',
                'make',
                'model',
                'version',
                'img',
                'km',
                'registration_date',
                'alimentazione', 
                'kwatt',
                'gearbox',
                'colore',
                'interni',
                'telaio',
                'prezzo',
                'neopatentati',
                'emission_class',
                'body',
                'seats',
                'doors'
            ),
            
            'search_fields' => array(               
                'id_marca',
                'id_modello'
            ),
            
            'suggested_unset_order' => array(
                0 => 'id_modello',
                1 => 'id_marca',
                2 => 'id',
                3 => 'registration_date',
                4 => 'km',
                5 => 'alimentazione'
            
            ),
            
            'labels' => array(
                
                1 => array(
                    'print' => true,
                    'condition' => 'alimentazione == 4',             
                    'file_name' => 'gpl200',
                    'venduta' => false
                ),
                0 => array(
                    'print' => true,
                    'condition' => 'neopatentati == 1 ',
                    'file_name' => 'neopatentati200',
                    'venduta' => false
                ),
                2 => array(
                    'print' => false,
                    'condition' => 'venduta == "1" ',
                    'file_name' => 'venduta200',
                    'venduta' => true
                ),
                          
            ),           
            
        
        ),
                       
                
        'Immagine' => array(

            'table' => 'immagini',
            'query_limit' => 2,
        
            'show_fields' => array(                
                'id', 
                'img', 
                'img_big', 
                'img_hd', 
                'titolo'
            ), 
            
            'search_fields' =>array(
                'id_veicolo',
            ),
        
        ),
                
        
        
        'Optional' => array(

            'table' => 'optional',
            'show_fields' => array(
                'id_veicolo',
            ), 
            
            'search_fields' =>array(                
                'titolo0',
                'titolo1',
                'titolo2',
                'titolo3',
            ),
        
        ),       
        
    );


}
?>