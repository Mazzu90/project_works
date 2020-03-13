<?php 

namespace Config;

final class SiteMap{    
    
    const root = 'http://simone.clickitsolutions.it/';
    const language = 'it';
            
    const url_rewrite = true;
    
    const img_percorso_base  = '/archivio_img/';
    const add_percorso_base_area_pubblica  = '/archivio_doc/';
    const img_percorso_originale  = '/img_o/';
    const img_percorso_temp  = '/temp/';
       
    const home_idx = 1;
    const chi_siamo_idx = 2;
    const ricerca_auto_idx = 8;
    const servizi_idx = 3;
    const officina_idx = 4;
    const compriamo_idx = 5;
    const contatti_idx = 7;
    const marchi_idx = 6;    
    const garanzia_idx = 9;
    const privacy_idx = 10;
    const cookie_idx = 11;
    const faq_idx = 12;
    
    const direct_link = '/it/main.php?idx='; 
    
    const default_title = 'SIMONE autovetture - oltre 200 auto usate';
    const default_description = 'Presso il nostro Autosalone puoi trovare un\'esposizione aperta al pubblico dove visionare, in una struttura di oltre 2.000 mq coperti, oltre 200 autovetture usate';
    const default_keywords = 'vetture usate, compravendita auto usate, veicoli aziendali, km0';
       
    
    public static $pages_archive = array(

        'ciao' => array(

        ),


        'officina' => array(

        ),
        
        'home' => array(
            'hide_in_footer_links' => true,

        ),
        
        'ricerca-auto' => array(

        ),
        
        'chi-siamo' => array(

        ),
        
        'servizi' => array(

        ),
        
        'contatti' => array(

        ),
        
        'compriamo' => array(
 
        ), 
        
        'marchi' => array(

        ),
        
        'garanzia' => array(
            'hide_in_navbar' => true,
            'name' => 'ESTENSIONE DI GARANZIA',

        ),
        
        
        'privacy' => array(
            'hide_in_navbar' => true,
            'name' => 'Privacy',
       ),
        
        
        'cookie' => array(
            'hide_in_navbar' => true,
            'name' => 'Cookie',
        ),
        

        'faq' => array(
            'hide_in_navbar' => true,
            'name' => 'Faq',
        ),

        
        /*'home' => array(
            'idx' => self::home_idx,
            'class' => 'Config\Pages\Home',
            'title' => self::default_title,
            'description' => 'Presso il nostro Autosalone puoi trovare un\'esposizione aperta al pubblico dove visionare, in una struttura di oltre 2.000 mq coperti, oltre 200 autovetture usate',
            'keywords' => 'vetture usate, compravendita auto usate, veicoli aziendali, km0',
            'name' => 'HOME',
            'rewrited_url' => '/home',
            'show_in_navbar?' => true,
            'nav_element_type' => null,
            'show_in_footer_links?' => true,
            'to_publish?' => true
        ),
        
        'ricerca_auto' => array(
            'idx' => self::ricerca_auto_idx,
            'class' => 'Config\Pages\Ricerca',
            'title' => self::default_title,
            'description' => self::default_description,
            'keywords'=> self::default_keywords,
            'name' => 'RICERCA AUTO',
            'rewrited_url' => '/ricerca',
            'show_in_navbar?' => true,
            'nav_element_type' => null,
            'show_in_footer_links?' => true,
            'to_publish?' => true
        ),
        
        'chi_siamo' => array(
            'idx' => self::chi_siamo_idx,
            'class' => 'Config\Pages\ChiSiamo',
            'name' => 'CHI SIAMO',
            'rewrited_url' => '/chi_siamo',
            'show_in_navbar?' => true,
            'nav_element_type' => null,
            'show_in_footer_links?' => true,
            'to_publish?' => true
        ),
        
        'servizi' => array(
            'idx' => self::servizi_idx,
            'class' => 'Config\Pages\Servizi',
            'name' => 'SERVIZI',
            'rewrited_url' => '/servizi',
            'show_in_navbar?' => true,
            'nav_element_type' => null,
            'show_in_footer_links?' => true,
            'to_publish?' => true
        ),
        
        'contatti' => array(
            'idx' => self::contatti_idx,
            'class' => 'Config\Pages\Contatti',
            'name' => 'CONTATTI',
            'rewrited_url' => '/contatti',
            'show_in_navbar?' => true,
            'nav_element_type' => null,
            'show_in_footer_links?' => true,
            'to_publish?' => true
        ),
        
        'compriamo' => array(
            'idx' => self::compriamo_idx,
            'class' => 'Config\Pages\Compriamo',
            'name' => 'COMPRIAMO',
            'rewrited_url' => '/compriamo',
            'show_in_navbar?' => true,
            'nav_element_type' => null,
            'show_in_footer_links?' => true,
            'to_publish?' => true   
        ), 
        
        'marchi' => array(
            'idx' => self::marchi_idx,
            'class' => 'Config\Pages\Marchi',
            'name' => 'MARCHI',
            'rewrited_url' => '/compriamo',
            'show_in_navbar?' => true,
            'nav_element_type' => null,
            'show_in_footer_links' => true,
            'to_publish' => true  
        ),
        
         'garanzia' => array(
            'idx' => self::garanzia_idx,
            'rewrited_url' => '/servizi#garanzia',
            'name' => 'ESTENSIONE DI GARANZIA',
            'show_in_footer_links?' => true,
            'to_publish?' => true
        ),
        
        
         'privacy' => array(
            'idx' => self::privacy_idx,
            'rewrited_url' => '/privacy',
            'name' => 'Privacy Policy',
            'show_in_footer_links?' => true,
            'to_publish?' => true
        ),
        
        
         'cookie' => array(
            'idx' => self::cookie_idx,
            'rewrited_url' => '/cookie',
            'name' => 'Utilizzo dei cookie',
            'show_in_footer_links?' => true,
            'to_publish?' => true
        ),
        
        
         'faq' => array(
            'idx' => self::faq_idx,
            'rewrited_url' => '/faq',
            'name' => 'FAQ',
            'show_in_footer_links?' => true,
            'to_publish?' => true
        ), */    
    );
       
}

?>