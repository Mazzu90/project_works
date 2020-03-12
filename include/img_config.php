<?
/*istruzioni per l'uso:
per creare una nuova tipologia di ridimensionamento creare un elemento dell'array $elencoConfigurazioniImmagini
seguendo queste indicazioni:
$elencoConfigurazioniImmagini[IMG_AREA_PRIVATA_THUMB] = new TImgConfigurazione  (
                                                                                //1
                                                                                TImgConfigurazione::IMG_TYPE_CROP,
                                                                                //2
                                                                                75,
                                                                                //3
                                                                                75,
                                                                                //4
                                                                                TImgConfigurazione::IMG_DIR_ARCHIVIO_T,
                                                                                //5
                                                                                'A'
                                                                                );
1) 
definisce la tipologia di azione che deve essere fatta sull'immagine ed i parametri accettati sono:
    TImgConfigurazione::IMG_TYPE_CROP
    TImgConfigurazione::IMG_TYPE_IMG_RESIZE
    TImgConfigurazione::IMG_TYPE_IMG_REFLECTION
2) 
definisce la dimensione altezza del file finale; accetta un numero intero 
3) 
definisce la dimensione larghezza del file finale; accetta un numero intero 
4) 
definisce la directory all'interno della quale verranno memorizzati i file finali.
i parametri accettati sono: 
    TImgConfigurazione::IMG_DIR_ARCHIVIO_T -> archivio per le fotografie di piccole dimensioni
    TImgConfigurazione::IMG_DIR_ARCHIVIO_M -> archivio per le fotografie di medie dimensioni
    TImgConfigurazione::IMG_DIR_ARCHIVIO_B -> archivio per le fotografie di grandi dimensioni
5) 
    prefisso che verrà anteposto al nome del file. Questo parametro DEVE essere una lettera univoca per
    configurazione (non possono esistere due modelli di configurazione immagini con lo stesso prefisso
    altrimenti si rischia di sovrascrivere le immagini). La lettera deve essere una sola e maiuscola.
    
*/
$aPrefissi=array('D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
$prefT=-1;
$prefM=-1;
$prefB=-1;
define('IMG_CROP_GALLERY_ELENCO_COMPLETO',           101);
define('IMG_CROP_GALLERY_ELENCO_ESTRATTO',           102);
define('IMG_CROP_GALLERY_THUMBS',                    103);
define('IMG_CROP_GALLERY_CATEGORIE',                 104);
define('IMG_AREA_PUBBLICA_RESIZE_800600',            105);
define('IMG_CROP_CATEGORIE_BOX',                     106);
define('IMG_CROP_CATEGORIE_MENU',                    107);
define('IMG_CROP_CONTENUTO_LISTA',                   108);
define('IMG_RESIZE_CONTENUTO_DETTAGLIO',             109);
define('IMG_RESIZE_DETTAGLIO_PRODOTTO',              110);
define('IMG_RESIZE_CATEGORIA',                       111);
define('IMG_CROP_SLIDE',                             112);
define('IMG_RESIZE_CATEGORIA_WATERMARK',             113);
define('IMG_CROP_CATALOGHI',                         114);
define('IMG_CROP_CONTENUTO_DETTAGLIO',               115);
define('IMG_CROP_CONTENUTO_HOME',                    116);


$prefM++;                                                                                                                                                             
$elencoConfigurazioniImmagini[IMG_CROP_GALLERY_ELENCO_COMPLETO]                  = new TImgConfigurazione  (
                                                                                TImgConfigurazione::IMG_TYPE_CROP,
                                                                                238,
                                                                                609,
                                                                                TImgConfigurazione::IMG_DIR_ARCHIVIO_M,
                                                                                $aPrefissi[$prefM]
                                                                                );  
$prefT++;                                                                                                                                                              
$elencoConfigurazioniImmagini[IMG_CROP_GALLERY_ELENCO_ESTRATTO]                  = new TImgConfigurazione  (
                                                                                TImgConfigurazione::IMG_TYPE_CROP,
                                                                                50,
                                                                                50,
                                                                                TImgConfigurazione::IMG_DIR_ARCHIVIO_T,
                                                                                $aPrefissi[$prefT]
                                                                                );  
$prefT++;                                                                                                                                                              
$elencoConfigurazioniImmagini[IMG_CROP_GALLERY_THUMBS]                          = new TImgConfigurazione  (
                                                                                TImgConfigurazione::IMG_TYPE_CROP,
                                                                                95,
                                                                                95,
                                                                                TImgConfigurazione::IMG_DIR_ARCHIVIO_T,
                                                                                $aPrefissi[$prefT]
                                                                                );                                                                                
$prefT++;
$elencoConfigurazioniImmagini[IMG_CROP_GALLERY_CATEGORIE]                       = new TImgConfigurazione  (
                                                                                TImgConfigurazione::IMG_TYPE_CROP,
                                                                                250,
                                                                                250,
                                                                                TImgConfigurazione::IMG_DIR_ARCHIVIO_T,
                                                                                $aPrefissi[$prefT]
                                                                                );  
$prefB++;
$elencoConfigurazioniImmagini[IMG_AREA_PUBBLICA_RESIZE_800600]                  = new TImgConfigurazione  (
                                                                                TImgConfigurazione::IMG_TYPE_CROP,
                                                                                600,
                                                                                800,
                                                                                TImgConfigurazione::IMG_DIR_ARCHIVIO_B,
                                                                                $aPrefissi[$prefB]
                                                                                );
$prefB++;
$elencoConfigurazioniImmagini[IMG_CROP_SLIDE]                                   = new TImgConfigurazione  (
                                                                                TImgConfigurazione::IMG_TYPE_CROP,
                                                                                477,
                                                                                1920,
                                                                                TImgConfigurazione::IMG_DIR_ARCHIVIO_B,
                                                                                $aPrefissi[$prefB]
                                                                                );    
$prefM++;                                                                                                                                                              
$elencoConfigurazioniImmagini[IMG_CROP_CATEGORIE_BOX]                           = new TImgConfigurazione  (
                                                                                TImgConfigurazione::IMG_TYPE_CROP,
                                                                                300,
                                                                                400,
                                                                                TImgConfigurazione::IMG_DIR_ARCHIVIO_M,
                                                                                $aPrefissi[$prefM]
                                                                                );  
$prefT++;
$elencoConfigurazioniImmagini[IMG_CROP_CATEGORIE_MENU]                          = new TImgConfigurazione  (
                                                                                TImgConfigurazione::IMG_TYPE_CROP,
                                                                                50,
                                                                                50,
                                                                                TImgConfigurazione::IMG_DIR_ARCHIVIO_T,
                                                                                $aPrefissi[$prefT]
                                                                                ); 
$prefT++;
$elencoConfigurazioniImmagini[IMG_CROP_CONTENUTO_LISTA]                         = new TImgConfigurazione  (
                                                                                TImgConfigurazione::IMG_TYPE_CROP,
                                                                                270,
                                                                                270,
                                                                                TImgConfigurazione::IMG_DIR_ARCHIVIO_T,
                                                                                $aPrefissi[$prefT]
                                                                                ); 
$prefM++;
$elencoConfigurazioniImmagini[IMG_RESIZE_CONTENUTO_DETTAGLIO]                   = new TImgConfigurazione  (
                                                                                TImgConfigurazione::IMG_TYPE_RESIZE,
                                                                                550,
                                                                                550,
                                                                                TImgConfigurazione::IMG_DIR_ARCHIVIO_M,
                                                                                $aPrefissi[$prefM]
                                                                                ); 
$prefM++;
$elencoConfigurazioniImmagini[IMG_RESIZE_DETTAGLIO_PRODOTTO]                    = new TImgConfigurazione  (
                                                                                TImgConfigurazione::IMG_TYPE_RESIZE,
                                                                                900,
                                                                                1200,
                                                                                TImgConfigurazione::IMG_DIR_ARCHIVIO_M,
                                                                                $aPrefissi[$prefM]
                                                                                ); 
$prefM++;
$elencoConfigurazioniImmagini[IMG_RESIZE_CATEGORIA]                             = new TImgConfigurazione  (
                                                                                TImgConfigurazione::IMG_TYPE_RESIZE,
                                                                                609,
                                                                                238,
                                                                                TImgConfigurazione::IMG_DIR_ARCHIVIO_M,
                                                                                $aPrefissi[$prefM]
                                                                                );
$prefM++;
$elencoConfigurazioniImmagini[IMG_RESIZE_CATEGORIA_WATERMARK]                   = new TImgConfigurazione  (
                                                                                TImgConfigurazione::IMG_TYPE_WATERMARK,
                                                                                1000,
                                                                                220,
                                                                                TImgConfigurazione::IMG_DIR_ARCHIVIO_M,
                                                                                $aPrefissi[$prefM]
                                                                                );  
$prefT++;
$elencoConfigurazioniImmagini[IMG_CROP_CATALOGHI]                              = new TImgConfigurazione  (
                                                                                TImgConfigurazione::IMG_TYPE_CROP,
                                                                                329,
                                                                                250,
                                                                                TImgConfigurazione::IMG_DIR_ARCHIVIO_T,
                                                                                $aPrefissi[$prefT]
                                                                                ); 
$prefM++;
$elencoConfigurazioniImmagini[IMG_CROP_CONTENUTO_DETTAGLIO]                   = new TImgConfigurazione  (
                                                                                TImgConfigurazione::IMG_TYPE_CROP,
                                                                                300,
                                                                                450,
                                                                                TImgConfigurazione::IMG_DIR_ARCHIVIO_M,
                                                                                $aPrefissi[$prefM]
                                                                                ); 
$prefM++;
$elencoConfigurazioniImmagini[IMG_CROP_CONTENUTO_HOME]                         = new TImgConfigurazione  (
                                                                                TImgConfigurazione::IMG_TYPE_CROP,
                                                                                400,
                                                                                600,
                                                                                TImgConfigurazione::IMG_DIR_ARCHIVIO_M,
                                                                                $aPrefissi[$prefM]
                                                                                );                                                                                                                                                             
?>