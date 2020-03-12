<?
/*
TODO: cercare qualcosa per injection o come si scrive!!!!
*/
require_once('include_dir.php');
require_once($percorsoLingua.'include/include.php');
$lInclude=true;
$lUrlRewrite=true;

$grafica=new Tgrafica(false,false);

$linguaSeoGateway = (isset($_GET['lingua']) )?$_GET['lingua']:'';

$urlCategoria=(isset($_GET['urlCA']))?$_GET['urlCA']:'';
$urlContenuto=(isset($_GET['urlCO']))?$_GET['urlCO']:'';
$indicePaginazione=(isset($_GET['paginazione']))?$_GET['paginazione']:'';


$lContenuto=($urlContenuto!='');
$id=(isset($_GET['id']) )?$_GET['id']:0;

/*
echo $linguaSeoGateway.'<br />';
echo $urlCategoria.'<br />';
echo $urlContenuto.'<br />';
echo $id.'<br />';
echo $lContenuto.'<br />';
*/
$codiceErrore=0;

   

   /* $sql = 'select 
                contenuti.titolo_'.costantiP::LINGUA.' as titoloContenuto,
                categorie_contenuti.titolo_'.costantiP::LINGUA.' as titoloCategoria
            from
                contenuti
                    inner join categorie_contenuti
                        on contenuti.id_categoria = categorie_contenuti.id 
                    where contenuti.id = '.$id;
    */
    $sql = 'select 
                modelli.id AS id_modello,
                modelli.titolo AS titolo_modello,
                modelli.titolo_normalizzato AS titolo_modello_normalizzato ,
                marca.titolo AS titolo_marca,
                marca.titolo_normalizzato AS titolo_marca_normalizzato
            from
                modelli
            inner join marca
            on modelli.id_categoria = marca.id
             where modelli.titolo_normalizzato = "'.$urlContenuto.'"';
    
    $rs = mysql_query($sql);
    if (mysql_num_rows($rs)>0)
    {
        $row=mysql_fetch_array($rs);
        $titoloCategoria=normalizzaTesto($row['titolo_marca']);
        $titoloContenuto=normalizzaTesto($row['titolo_modello']);
        //$titoloContenuto=normalizzaTesto($row['modelloContenuto'].'-'.$row['versioneContenuto']);
        //$titoloMarca=normalizzaTesto($row['marcaContenuto']);
        $url = costantiP::BASE_URL.costantiP::LINGUA.'/'.$titoloCategoria.'/'.$titoloContenuto.'/';
        if ( (costantiP::URL_REWRITE_ATTIVO) &&  ($urlContenuto!=$titoloContenuto)  )
        {
            header ('HTTP/1.1 301 Moved Permanently');
            header('location: '.$url);
        }
    }    
    //qui devo cercare la pagina che deve impaginare il contenuto
    $paginaPHP=trovaPaginaContenuto(-1,-1);



if (file_exists($paginaPHP))
    require_once($paginaPHP);
else
{
    $codiceErrore=costantiP::COD_ERR_SEO_PAGINA_RICHIESTA_FILE_NON_ESISTE;
    $paginaPHP='err_clickit.php';
    require_once($paginaPHP);
}
          
unset($grafica);

function trovaPaginaContenuto($idCategoria,$idContenuto)
{
    if ($idContenuto==-1)
    {
        return 'modelli.php';       
    }
}


?>