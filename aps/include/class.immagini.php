<?
/*
 VERSIONE LIBRERIA 1.1
 *
 
05/08/2011 versione 1.1 valerio
quando deve fare un crop, al termine elimina la fotografia nella cartella temp altrimenti richia di avere problemi 
 * a sovrascrivere il file temporaneo.
 * 
 */
include($percorso.$percorsoAP.'resizeimg/ThumbLib.inc.php');
define('IMG_RESIZE', 1);
define('IMG_REFLECTION', 1);
define('IMG_CROP', 1);
 
/*
qui la definizione delle tipologie immagine previste per l'area privata. Le tipologie immagine previste
 * per l'area pubblica sono nel file ./include/img_config.php
 */
define('IMG_AREA_PRIVATA_CROP_THUMB',          1);
define('IMG_AREA_PRIVATA_CROP_SMALL',          2);
$elencoConfigurazioniImmagini[IMG_AREA_PRIVATA_CROP_THUMB]                      = new TImgConfigurazione  (
                                                                                TImgConfigurazione::IMG_TYPE_CROP,
                                                                                100,
                                                                                100,
                                                                                TImgConfigurazione::IMG_DIR_ARCHIVIO_T,
                                                                                'A'
                                                                                );
$elencoConfigurazioniImmagini[IMG_AREA_PRIVATA_CROP_SMALL]                      = new TImgConfigurazione  (
                                                                                TImgConfigurazione::IMG_TYPE_CROP,
                                                                                150,
                                                                                150,
                                                                                TImgConfigurazione::IMG_DIR_ARCHIVIO_T,
                                                                                'B'
                                                                                );
/*
note:
questo file contiene la classe che elabora le immagini ridimensionandole, croppandole o facendo il reflect.
La definizione dei modelli di configurazione è nel file ./aps/include/img_config.php per quanto riguarda 
i modelli utilizzati nell'area privata e nel file ./[LINGUA]/include_cliente/img_config_cliente.php per 
quanto riguarda i modelli di configurazione utilizzati in tutto il sito pubblico. 
In fase di cancellazione immagine l'area privata si occupa di caricare sia i modelli relativi all'aps che
quelli relativi al sito internet per essere sicuri di cancellare TUTTI i file generati automaticamente.
istruzioni per l'uso:
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
class TImgConfigurazione
{
    
    CONST IMG_TYPE_RESIZE = 1;    
    CONST IMG_TYPE_CROP = 2;    
    CONST IMG_TYPE_REFLECTION = 3;
    CONST IMG_TYPE_WATERMARK = 4;      
    CONST IMG_DIR_ARCHIVIO_T = 'img_t';    
    CONST IMG_DIR_ARCHIVIO_M = 'img_m';    
    CONST IMG_DIR_ARCHIVIO_B = 'img_b';    
    var $tipologiaDiRidimensionamento;
    var $nomeFileOriginale;
    var $altezza;
    var $larghezza;
    var $dirSalvataggio;
    var $prefissoFileDestinazione;
    
    function __construct(   $tipologiaDiRidimensionamento,
                            $altezza,
                            $larghezza,
                            $dirSalvataggio,
                            $prefissoFileDestinazione
                        )
    {
        $this->tipologiaDiRidimensionamento=$tipologiaDiRidimensionamento;
        $this->altezza=$altezza;
        $this->larghezza=$larghezza;
        $this->dirSalvataggio=$dirSalvataggio;
        $this->prefissoFileDestinazione=$prefissoFileDestinazione;
    }                        
}
function imgPriv($configurazione,$fileOriginale,$ritorno=Timg::RESTITUISCI_TAG_IMG)
{
    if (file_exists(costanti::IMG_PERCORSO_BASE.costanti::IMG_PERCORSO_ORIGINALE.$fileOriginale) )
    {
        $img = new Timg();
        $risultato = $img->generaImmagine($configurazione,$fileOriginale,$ritorno,Timg::IMG_AREA_PRIVATA,'thumbs','','');
        echo exec('rm '.costanti::IMG_PERCORSO_BASE.costanti::IMG_PERCORSO_TEMP.'*');
        unset($img);
        return $risultato;
    }
}
function imgPubb($configurazione,$fileOriginale,$ritorno=Timg::RESTITUISCI_TAG_IMG,$classHTML='thumbs',$alt='',$title='')
{
    //echo 'AAA'.costantiP::IMG_PERCORSO_BASE.costantiP::IMG_PERCORSO_ORIGINALE.$fileOriginale;
    if (file_exists(costantiP::IMG_PERCORSO_BASE.costantiP::IMG_PERCORSO_ORIGINALE.$fileOriginale) )
    {
        $img = new Timg();
        $risultato = $img->generaImmagine($configurazione,$fileOriginale,$ritorno,Timg::IMG_AREA_PUBBLICA,$classHTML,$alt,$title);
        echo exec('rm '.costantiP::IMG_PERCORSO_BASE.costantiP::IMG_PERCORSO_TEMP.'*');
        unset($img);
        return $risultato;
    }
}
function cancellaFileImmagine($nomeFotografia)
{
    global $elencoConfigurazioniImmagini;
    
    try 
    {
        $nomeFileTemp=costanti::IMG_PERCORSO_BASE.costanti::IMG_PERCORSO_ORIGINALE.$nomeFotografia;
        if (is_file($nomeFileTemp) && file_exists($nomeFileTemp))
            unlink($nomeFileTemp);
        foreach($elencoConfigurazioniImmagini as $elemento)
        {
            $nomeFileTemp=costanti::IMG_PERCORSO_BASE.$elemento->dirSalvataggio.'/'.$elemento->prefissoFileDestinazione.'_'.$nomeFotografia;
            if (is_file($nomeFileTemp) && file_exists($nomeFileTemp))
                unlink($nomeFileTemp);
        }
        $risultato = true;
    } catch (Exception $e) 
    {
        $risultato = false;
    }    
    return $risultato;
}
function salvaFileImmagine(&$dati,$imgCodiceSezione)
{
    $fileDestinazione = $imgCodiceSezione.pad0($dati['id'],costanti::IMG_LEN_NOME_FILE).'.jpg';
    
    if (trim($dati['foto']['tmp_name'])!='')
    {
        if (cancellaFileImmagine($fileDestinazione))
        {
            $fileOriginale=$dati['foto']['tmp_name'];
            $FilePercorsoDestinazione= costanti::IMG_PERCORSO_BASE.costanti::IMG_PERCORSO_ORIGINALE.$fileDestinazione;
            $caricamentoOk=move_uploaded_file($fileOriginale,$FilePercorsoDestinazione);
            if ( ($caricamentoOk) && (file_exists($FilePercorsoDestinazione)) )
            {
                $dati['foto']['nomeFile']=$fileDestinazione;
                @chmod($FilePercorsoDestinazione,0777);
            }
        }
    }
    else
    {
        $caricamentoOk=true;
        $fileTemp = costanti::IMG_PERCORSO_BASE.costanti::IMG_PERCORSO_ORIGINALE.$fileDestinazione;
        if (file_exists($fileTemp))
            $dati['foto']['nomeFile']=$fileDestinazione;
        else
            $dati['foto']['nomeFile']='';        
    }
    return $caricamentoOk;
}
class Timg
{
    var $area;
    CONST RESTITUISCI_TAG_IMG=1;
    CONST RESTITUISCI_URL_IMG=2;
    
    CONST IMG_AREA_PRIVATA = 1;
    CONST IMG_AREA_PUBBLICA = 2;
    
    
    function __construct()
    {
        
    }
    
    function preparaImmagineTemporanea($nomeFileOriginale,$configurazione)
    {
        if ($this->area==Timg::IMG_AREA_PRIVATA)
        {
            $cFilePerCrop=costanti::IMG_PERCORSO_BASE.costanti::IMG_PERCORSO_ORIGINALE.$nomeFileOriginale;
            $cFileTempPerCrop=costanti::IMG_PERCORSO_BASE.costanti::IMG_PERCORSO_TEMP.$nomeFileOriginale;
        }
        else
        {
            $cFilePerCrop=costantiP::IMG_PERCORSO_BASE.costantiP::IMG_PERCORSO_ORIGINALE.$nomeFileOriginale;
            $cFileTempPerCrop=costantiP::IMG_PERCORSO_BASE.costantiP::IMG_PERCORSO_TEMP.$nomeFileOriginale;
        }
        
        list($width, $height, $type, $attr) = getimagesize($cFilePerCrop);
        $dimWxCrop=0;
        $dimHxCrop=0;
        $this->ridimensionamentoProporzionalePerCrop($width, $height, $configurazione->larghezza, $configurazione->altezza,$dimWxCrop,$dimHxCrop);
             
        $thumb = PhpThumbFactory::create($cFilePerCrop);
        $thumb->resize($dimWxCrop, $dimHxCrop);
        $thumb->save($cFileTempPerCrop, 'jpg');
        
        return $cFileTempPerCrop;        
    }
    
    function generaImmagine($configurazione,$fileOriginale,$ritorno,$area,$classHTML,$alt,$title)
    {
        global $percorso;
        $this->area=$area;
        if ($this->area==Timg::IMG_AREA_PRIVATA)
        {
            $fileDestinazione = $configurazione->prefissoFileDestinazione.'_'.$fileOriginale;
            $percorsoImmagineOriginale = costanti::IMG_PERCORSO_BASE.costanti::IMG_PERCORSO_ORIGINALE;
            $percorsoImmagineDestinazione = costanti::IMG_PERCORSO_BASE.$configurazione->dirSalvataggio.'/';
            $percorsoImmagineURL=costanti::BASE_URL_ROOT.'archivio_img/'.$configurazione->dirSalvataggio.'/';
            $fileDestinazioneCompleto = $percorsoImmagineDestinazione.$fileDestinazione;
        } 
        else
        {
            $fileDestinazione = $configurazione->prefissoFileDestinazione.'_'.$fileOriginale;
            $percorsoImmagineOriginale = costantiP::IMG_PERCORSO_BASE.costantiP::IMG_PERCORSO_ORIGINALE;
            $percorsoImmagineDestinazione = costantiP::IMG_PERCORSO_BASE.$configurazione->dirSalvataggio.'/';
            $percorsoImmagineURL=costantiP::BASE_URL.'archivio_img/'.$configurazione->dirSalvataggio.'/'  ;          
            $fileDestinazioneCompleto = $percorsoImmagineDestinazione.$fileDestinazione;
        }
        
        
        //verifico che l'immagine richiesta non esista e se non esiste la creo
        if (!file_exists($fileDestinazioneCompleto))
        {
            
            //--------------------------------------
            
            if ($configurazione->tipologiaDiRidimensionamento==TImgConfigurazione::IMG_TYPE_CROP)
                {
                    $this->preparaImmagineTemporanea($fileOriginale,$configurazione);
                    if ($this->area==Timg::IMG_AREA_PRIVATA)
                        $percorsoImmagineOriginale = costanti::IMG_PERCORSO_BASE.costanti::IMG_PERCORSO_TEMP;
                    else                
                        $percorsoImmagineOriginale = costantiP::IMG_PERCORSO_BASE.costantiP::IMG_PERCORSO_TEMP;            
                }
            
            //--------------------------------------
            
            
            try 
            {
                $thumb = PhpThumbFactory::create($percorsoImmagineOriginale.$fileOriginale);
                
                switch($configurazione->tipologiaDiRidimensionamento)
                {
                    case TImgConfigurazione::IMG_TYPE_RESIZE:
                    $thumb->resize($configurazione->larghezza, $configurazione->altezza);
                    break;
                    case TImgConfigurazione::IMG_TYPE_CROP:
                    $thumb->cropFromCenter($configurazione->larghezza, $configurazione->altezza);
                    break;
                    case TImgConfigurazione::IMG_TYPE_REFLECTION:
                    $thumb->adaptiveResize($configurazione->larghezza, $configurazione->altezza)->createReflection(40, 40, 80, true, '#a4a4a4');
                    break;
                    case TImgConfigurazione::IMG_TYPE_WATERMARK:
                    $watermark = dirname(__FILE__).'/../images/watermark.png';//$watermark = dirname(__FILE__).'/../images/watermark.png';
                    $thumb->resize($configurazione->larghezza, $configurazione->altezza);
                    $thumb->createWatermark($watermark, 5, 5); /* margin bottom 10px and margin right 10px */
                    break;
               }
                
                $thumb->save($fileDestinazioneCompleto, 'jpg');
                unset($thumb);
                
                if ($configurazione->tipologiaDiRidimensionamento==TImgConfigurazione::IMG_TYPE_CROP)
                {
                    if (file_exists($percorsoImmagineOriginale.$fileOriginale))
                        unlink($percorsoImmagineOriginale.$fileOriginale);
                }
            }            
            catch (Exception $e) 
            {
                die($e);
            }
        }
        if ($ritorno == Timg::RESTITUISCI_TAG_IMG)
            return "<img src='".$percorsoImmagineURL.$fileDestinazione."' class='".$classHTML."' alt='".$alt."' title='".$title."' />";
        else
            return $percorsoImmagineURL.$fileDestinazione;
    }
    function ridimensionamentoProporzionalePerCrop ($lOrig, $hOrig, $lCrop, $hCrop,&$lRisultato,&$hRisultato)
    {
        /*
        questa funzione accetta le dimensioni originali della fotografia e restituisce
        le dimensioni proporzionali minime e ottimali per il crop più ampio possibile effettuato al centro.
        */
        $rappOriginale = $hOrig/$lOrig;
        $rappCrop = $hCrop/$lCrop;
        
        if ($rappOriginale < 1) // se l'immagine è orizzontale 
            {
             if ($rappCrop < 1) //e il crop è orizzontale
                  {
                     if ($rappOriginale > $rappCrop) // verifichiamo quale delle 2 è meno quadrata
                     {
                     $lRisultato = $lCrop;
                     $hRisultato = $lCrop*$hOrig/$lOrig;
                     }
                     else
                     {
                     $hRisultato = $hCrop;
                     $lRisultato = $hCrop*$lOrig/$hOrig;
                     }
                  }
             else   //se il crop è verticale  
                     {
                     $hRisultato = $hCrop;
                     $lRisultato = $hCrop*$lOrig/$hOrig; //e calcolo l' - Altezza proporzionale
                     }
                }
              
        else //quindi il rapporto inferiore a 1, immagine verticale
          {
              if ($rappCrop < 1) //e il crop è orizzontale
                 {
                 $lRisultato = $lCrop;
                 $hRisultato = $hOrig*$lCrop/$lOrig;
                 }
             else   //se il crop è verticale  
                  {
                         if ($rappOriginale < $rappCrop) // verifichiamo quale delle 2 è meno quadrata
                         {
                         $hRisultato = $hCrop;
                         $lRisultato = $lOrig*$hCrop/$hOrig;
                         }
                         else
                         {
                         $lRisultato = $lCrop;
                         $hRisultato = $hOrig*$lCrop/$lOrig;
                         }
                }
        }
         $lRisultato = intval($lRisultato*1.02);
         $hRisultato = intval($hRisultato*1.02);
    }
}
?>