<?php 

namespace Config;

use Config\Core\Properties\ConnectionProperties;

class Properties{
    

        
        const db_host = 'prod-mysql2';
        const db_name = 'simone';
        const db_user = 'autounica';
        const db_password = '6ejZHsQwcX8795y5';
        const db_encoding = 'utf8';

    
    /*
    DEBUG LEVELS (fino a)):
    
    -1 = SPENTO;
    1 = GENERICI;
    2 = COSTRUTTORI;
    3 = METODI;
    4 = CAMPI;
    
    Il livello si pu� impostare anche in ogni singola classe, quindi se qualcosa non va come 
    ci si aspetta controllare anche se il debug della classe di cui si vogliono i log 
    sia al livello giusto oppure, se al contrario si vogliono solo i log di una determinata classe, 
    oppure log a livello diverso di quella classe, settare il livello direttamente dove serve   
    */
        
    const debug_level = 4;
    
    /*------------------CONST_CLIENTE---------------  */
    
    //PRODUZIONE
    //CONST BASE_URL = 'https://www.autounica.com/';
    
    //SVILUPPO
    const base_url = 'http://simone.clickitsolutions.it/';
    
    const titolo_generale = 'AUTOVETTURE';
    const ragione_sociale = 'AUTOVETTURE';
    const indirizzo = 'via autovetture, brescia';
    const indirizzo2 = "";
    const telefono = "+39 030 1324587";
    const fax = "+39 030 12345678";
    const mobile = "+39 334 123456879";
    const mobile2 = "+39 348 123456789";
    const piva = 'registro imprese di brescia - c.f. e p.iva 123456789';
    const cfiscale = "";
    
    const url_rewrite_attivo = false;
    
    const email = 'info@AUTOVETTURE.xxx'; //albini@clickitsolutions.it
    //const email = 'albini@clickitsolutions.it';
    const email_contatto_noreply = 'noreply@autovetture.xxx';
    
    const lingua = 'it';
    
    const numero_record_pagina_small    = 3;
    const numero_record_pagina_medium   = 4;
    const numero_record_pagina_large    = 8;
    const numero_record_pagina_xlarge   = 1200;
    
    
    //elenco codici pagina
    
    const cp_nessuno       = 0;
    const cp_homepage      = 1;
    const cp_tutteleauto   = 2;
    const cp_chisiamo      = 3;
    const cp_servizi       = 4;
    const cp_officina      = 5;
    const cp_compriamo     = 6;
    const cp_marchi		   = 7;
    const cp_contatti      = 8;
    const cp_stampa        = 9;
    
    
    
    const gds_screenshot_sitiweb    = 4;
    
    const categoria_slidehome				   = 2;
    const categoria_rassegna_stampa            = 28;
    const categoria_immobili_vincolati         = 119;
    const categoria_residenziale_direzionale   = 128;
    const categoria_spazi_pubblici             = 129;
    const categoria_sostenibilita              = 122;
    
    
    const tipologia_prodotti                   = 2;
    
    /*------------------fine const_cliente---------------  */
    /*------------------costanti-------------------------- */
    
    
    const img_percorso_base         = '../archivio_img/';
    const add_percorso_base_area_pubblica         = '../archivio_doc/';
    const img_percorso_originale    = 'img_o/';
    const img_percorso_temp         = 'temp/';
    
    const cod_err_seo_categoria_record_non_esiste                               = 1000;
    const cod_err_seo_pagina_categoria_non_impostata                            = 1010;
    const cod_err_seo_contenuto_record_non_esiste                               = 1020;
    const cod_err_seo_pagina_contenuto_non_impostata                            = 1030;
    const cod_err_seo_pagina_richiesta_file_non_esiste                          =1040;
    
    /*------------------fne costanti--------------- ------ */
}

?>