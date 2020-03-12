<?
$arrayLingue=array('IT','EN','ES','FR','DE');

class costantiSTD
{
    CONST NOME_APPLICAZIONE = 'Area Privata';
    

    CONST ADD_TIPOLOGIA_GALLERY = 1;
    CONST ADD_TIPOLOGIA_TUTTI_FILE = 2;
    
    /*COSTANTI LUNGHEZZE INPUT TYPE*/
    CONST FFORM_LENMAX_BREVE                = 100;
    CONST FFORM_LENMAX_MEDIO                = 150;
    CONST FFORM_LENMAX_MEDIO_LUNGHETTO      = 200;
    CONST FFORM_LENMAX_LUNGO                = 250;

    /*COSTANTI VALIDAZIONE DATI FORM NEWS*/
    CONST FFORM_NESSUN_ERRORE                                       = 0;
    CONST FFORM_TITOLO_NON_COMPILATO                                = 1;
    CONST FFORM_DESC_BREVE_NON_COMPILATO                            = 2;
    CONST FFORM_DATA_INIZIO_PUBBLICAZIONE_NON_VALIDA                = 3;
    CONST FFORM_DATA_FINE_PUBBLICAZIONE_NON_VALIDA                  = 4;
    CONST FFORM_IMG_TIPO_NON_VALIDO                                 = 5;
    CONST FFORM_IMG_DIM_NON_VALIDA                                  = 6;
    CONST FFORM_IMG_NOME_NON_VALIDO                                 = 7;
    CONST FFORM_IMG_ERRORE_CARICAMENTO_FILE                         = 8;
    CONST FFORM_EMAIL_NON_VALIDA                                    = 9;
    CONST FFORM_UTENTE_NON_COMPILATO                                = 10;
    CONST FFORM_UTENTE_NON_VALIDO                                   = 11;

    CONST CANCELLA_ADD                                              = 1;
    CONST CANCELLA_FOTO                                             = 2;
    CONST CANCELLA_CONTENUTO                                        = 3;
    CONST CANCELLA_CATEGORIA                                        = 4;
    CONST CANCELLA_CONTATTO                                         = 6;
    CONST CANCELLA_ATTRIBUTO                                        = 7;
    CONST CANCELLA_ATTRIBUTOCONTENUTO                               = 8;
    CONST CANCELLA_AGENTE                                           = 9;
    CONST CANCELLA_GALLERIACONTENUTO                                = 10;
    
     CONST COD_ERR_SEO_PAGINA_RICHIESTA_FILE_NON_ESISTE=1;
    /*
     * queste costanti sono nel file include/versione.php
    CONST VERSIONE              = 0;
    CONST SOTTOVERSIONE         = 1;
    CONST RILASCIO              = 0;
    CONST DATA_RILASCIO         = '22/04/2011';
     * 
     */
    CONST COPYRIGHT             = 'Click IT snc';
    CONST LINK_COPYRIGHT        = 'http://www.clickitsolutions.it';

    CONST ICO_MODIFICA                      = 'report_edit.png';
    CONST ICO_CANCELLA                      = 'report_delete.png';
    CONST ICO_GALLERY_DETTAGLI              = 'images.png';
    CONST ICO_SET_PRINCIPALE                = 'star.png';

    /*COSTANTI PER IMMAGINI*/

    CONST IMG_LEN_NOME_FILE         = 7;
    CONST IMG_DIM_MAX               = 25000000; //DIMENSIONE IN BYTE
    CONST IMG_COD_NEWS              = 1;
    CONST IMG_COD_EVENTI            = 2;
    CONST IMG_COD_GALLERY           = 3;
    CONST IMG_COD_CATALOGO          = 4;
    CONST IMG_COD_PRODOTTI          = 5;
    CONST IMG_COD_TIPOLOGIE         = 6;
    CONST IMG_COD_AREA_DOWNLOAD     = 7;
    CONST IMG_COD_ATTRIBUTI         = 8;
/*
    AD ESEMPIO:

                12345678
    file news:  10002564.jpg
                T_10002564.jpg
                M_10002564.jpg
  */

    CONST IMG_PERCORSO_BASE         = '../archivio_img/';
    CONST IMG_PERCORSO_ORIGINALE    = 'img_o/';
    CONST IMG_PERCORSO_TEMP         = 'temp/';    
    
    CONST ADD_PERCORSO_BASE         = '../../archivio_doc/';
    
}

/*
 TODO
 
 - aggiungere i parametri di ricerca e il filtro di ordinamento. 
  
 */


?>