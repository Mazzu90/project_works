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
                marca.id,
                marca.titolo
            from
                marca
             where marca.titolo_normalizzato = "'.$urlCategoria.'"';
    
    $rs = mysql_query($sql);
    if (mysql_num_rows($rs)>0)
    {
        $row=mysql_fetch_array($rs);
        $titoloCategoria=normalizzaTesto($row['titolo']);
        //$titoloContenuto=normalizzaTesto($row['modelloContenuto'].'-'.$row['versioneContenuto']);
        //$titoloMarca=normalizzaTesto($row['marcaContenuto']);
        $url = costantiP::BASE_URL.costantiP::LINGUA.'/'.$urlCategoria.'/';
        if ( (costantiP::URL_REWRITE_ATTIVO) &&  ($urlCategoria!=$titoloCategoria)  )
        {
            header ('HTTP/1.1 301 Moved Permanently');
            header('location: '.$url);
        }
    }    
    //qui devo cercare la pagina che deve impaginare il contenuto
    $paginaPHP=trovaPaginaContenuto(-1,$id);



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
    if ($idCategoria==-1)
    {
        return 'marche.php';       
    }
}


?>