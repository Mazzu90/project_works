<?
    namespace include_cliente;
    
    class costantiSTDP extends costanti
    {
        /*
         questa classe contiene tutte le costanti standard relative all'area pubblica
         albero di ereditarietà:
         aps/include/costanti.php -> aps/include_cliente/const_cliente.php 
         */
        //costanti per archivio immagini
        CONST IMG_PERCORSO_BASE         = '../archivio_img/';
        CONST ADD_PERCORSO_BASE_AREA_PUBBLICA         = '../archivio_doc/';
        CONST IMG_PERCORSO_ORIGINALE    = 'img_o/';
        CONST IMG_PERCORSO_TEMP         = 'temp/';
        
        CONST COD_ERR_SEO_CATEGORIA_RECORD_NON_ESISTE                               = 1000;    
        CONST COD_ERR_SEO_PAGINA_CATEGORIA_NON_IMPOSTATA                            = 1010;
        CONST COD_ERR_SEO_CONTENUTO_RECORD_NON_ESISTE                               = 1020;    
        CONST COD_ERR_SEO_PAGINA_CONTENUTO_NON_IMPOSTATA                            = 1030;    
        CONST COD_ERR_SEO_PAGINA_RICHIESTA_FILE_NON_ESISTE                          = 1040; //QUESTO ERRORE DICE CHE NEL DB è IMPOSTATA UNA PAGINA CHE DOVREBBE ESSERE USATA PER L'IMPAGINAZIONE DEL CONTENUTO / CATEGORIA MA NON ESISTE FISICAMENTE IL FILE.    
    }
?>
