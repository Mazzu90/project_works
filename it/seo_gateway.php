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

   
if ($lContenuto)
{
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
                veicoli.make as marcaContenuto,
                veicoli.model as modelloContenuto,
                veicoli.version as versioneContenuto,
                categorie.url as titoloCategoria
            from
                veicoli
                    inner join categorie
                        on veicoli.id_categoria = categorie.id 
                    where veicoli.id = '.$id;
    
    
    $rs = mysql_query($sql);
    if (mysql_num_rows($rs)>0)
    {
        $row=mysql_fetch_array($rs);
        $titoloCategoria=normalizzaTesto($row['titoloCategoria']);
        $titoloContenuto=normalizzaTesto($row['modelloContenuto'].'-'.$row['versioneContenuto']);
        $titoloMarca=normalizzaTesto($row['marcaContenuto']);
        $url = costantiP::BASE_URL.costantiP::LINGUA.'/'.$titoloMarca.'/'.$titoloContenuto.'_'.$id.'.htm';
        if ( (costantiP::URL_REWRITE_ATTIVO) &&  ($urlContenuto!=$titoloContenuto)  )
        {
            header ('HTTP/1.1 301 Moved Permanently');
            header('location: '.$url);
        }
    }    
    //qui devo cercare la pagina che deve impaginare il contenuto
    $paginaPHP=trovaPaginaContenuto(-1,$id);
} 
else
{
    
    // verifico che l'url chiamante sia corretto
    $sql = 'select titoloCategoria as titolo from categorie where id = '.$id;
    $rs = mysql_query($sql);
    if (mysql_num_rows($rs)>0)
    {
        $row=mysql_fetch_array($rs);
        $titolo = normalizzaTesto($row['titolo']);
        if ( (costantiP::URL_REWRITE_ATTIVO) && ($urlCategoria!=$titolo) )
        {
            $url = costantiP::BASE_URL.costantiP::LINGUA.'/'.$titolo.'_'.$id.'.htm';
            header ('HTTP/1.1 301 Moved Permanently');
            header('location: '.$url);
        }            
    }
    //qui devo cercare la pagina che deve impaginare la categoria
    $paginaPHP=trovaPaginaCategoria($id, $indicePaginazione, $linguaSeoGateway);
    
 
}

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
        //se la categoria è -1 siamo alla prima chiamata e quindi interrogo la categoria diretta del contenuto in esame.
        $sql = 'select
                categorie.id,
                categorie.pagina_contenuto as pagina_contenuto
                from
                    veicoli inner join categorie
                        on veicoli.id_categoria = categorie.id
                where
                    veicoli.id = '.$idContenuto;
        $rs = mysql_query($sql);
        $row=mysql_fetch_array($rs);
        
        return $row['pagina_contenuto'];    
             
    }
}

function trovaPaginaCategoria($id,$paginazione,$linguaSeoGateway)
{
    global $codiceErrore, $idCategoria, $pagina, $lingua;
    
    /*
    16/05/2013 Valerio e Matteo
    le variabili idCategoria, pagina e lingua che sono inserite nel global sono variabili che sono presenti nella pagina categoria.php che dovrebbe essere
    inclusa per stampare il relativo contenuto.
    Per fare in modo che queste due variabili (necessarie alla pagina categoria.php per estrarre dal db le informazioni)vengano valorizzate, le importiamo nella
    funzione attraverso il global.
    */
    $sql='';
    $paginaPHP='';
    $idCategoria = $id;
    $pagina=$paginazione;
    $lingua = $linguaSeoGateway;
    
    if ($idCategoria>0)
    {
        $sql = 'select id_categoria, pagina_categoria as pagina_categoria from categorie where id = '.$idCategoria;
        echo $sql;
        
        if (getRecord($sql,$row))
        {
            //qui è stato restituito il record che mi interessa
            if ($row['pagina_categoria']=='')
            {
                /* qui non ho specificato nessuna pagina in grado di stamparmi quindi interrogo il padre */
                $paginaPHP=trovaPaginaCategoria($row['id_categoria'],$lingua);
            }
            else
                $paginaPHP=$row['pagina_categoria'];
        }
        else
        {
            //qui non esiste alcun record per la categoria richiesta
            $codiceErrore=costantiP::COD_ERR_SEO_CATEGORIA_RECORD_NON_ESISTE;
            $paginaPHP='err_clickit.php';
        }
    }
    else
    {
        //qui non esiste alcun record per la categoria richiesta
        $codiceErrore=costantiP::COD_ERR_SEO_PAGINA_CATEGORIA_NON_IMPOSTATA;
        $paginaPHP='err_clickit.php';
    }
    
    return $paginaPHP;
    
}
?>