<?
include('include_dir.php');
include($percorsoLingua.'include/include.php');



session_start();

//se non esistono le sessioni le creo vuote
if(!isset($_SESSION['marca']))
{
    $_SESSION['marca']='';
}
if(!isset($_SESSION['modello']))
{
    $_SESSION['modello']='-1';
}
if(!isset($_SESSION['prezzo']))
{
    $_SESSION['prezzo']='';
}
if(!isset($_SESSION['carrozzeria']))
{
    $_SESSION['carrozzeria']='';
}

if(!isset($_SESSION['cambio']))
{
    $_SESSION['cambio']='';
}

if(!isset($_SESSION['carburante']))
{
    $_SESSION['carburante']='';
}

if(!isset($_SESSION['benzina']))
{
    $_SESSION['benzina']='';
}

if(!isset($_SESSION['diesel']))
{
    $_SESSION['diesel']='';
}

if(!isset($_SESSION['gpl']))
{
    $_SESSION['gpl']='';
}

if(!isset($_SESSION['metano']))
{
    $_SESSION['metano']='';
}

if(!isset($_SESSION['elettrica']))
{
    $_SESSION['elettrica']='';
}

if(!isset($_SESSION['ibrida']))
{
    $_SESSION['ibrida']='';
}

if(!isset($_SESSION['neopatentati']))
{
    $_SESSION['neopatentati']='';
}

if(!isset($_SESSION['ecologic']))
{
    $_SESSION['ecologic']='';
}

if(!isset($_SESSION['citycar']))
{
    $_SESSION['citycar']='';
}
if(!isset($_SESSION['prezzoDa']))
{
    $_SESSION['prezzoDa']='';
}
if(!isset($_SESSION['prezzoA']))
{
    $_SESSION['prezzoA']='';
}
if(!isset($_SESSION['annoDa']))
{
    $_SESSION['annoDa']='';
}
if(!isset($_SESSION['annoA']))
{
    $_SESSION['annoA']='';
}
if(!isset($_SESSION['kmDa']))
{
    $_SESSION['kmDa']='';
}
if(!isset($_SESSION['kmA']))
{
    $_SESSION['kmA']='';
}
if(!isset($_SESSION['cambio']))
{
    $_SESSION['cambio']='';
}
if(!isset($_SESSION['porte']))
{
    $_SESSION['porte']='';
}
if(!isset($_SESSION['nPostiDa']))
{
    $_SESSION['nPostiDa']='';
}
if(!isset($_SESSION['nPostiA']))
{
    $_SESSION['nPostiA']='';
}
if(!isset($_SESSION['potenza']))
{
    $_SESSION['potenza']='';
}
if(!isset($_SESSION['potenzaDa']))
{
    $_SESSION['potenzaDa']='';
}
if(!isset($_SESSION['potenzaA']))
{
    $_SESSION['potenzaA']='';
}
if(!isset($_SESSION['abs']))
{
    $_SESSION['abs']='';
}
if(!isset($_SESSION['clima']))
{
    $_SESSION['clima']='';
}
if(!isset($_SESSION['fari']))
{
    $_SESSION['fari']='';
}
if(!isset($_SESSION['cruise']))
{
    $_SESSION['cruise']='';
}
if(!isset($_SESSION['classeEmissioni']))
{
    $_SESSION['classeEmissioni']='';
}

$grafica=new Tgrafica(false,false);
$pagina = isset($_GET['pagina'])?$_GET['pagina']:1;
$nContenutiDaEstrarre = 10;
$numeroRecordPerPagina = 10; 

//$start = $_POST['start'];
//$limit2 = $_POST['limit'];
//echo '<hr>'.$start;
//echo $limit2.'<hr />';
$start = isset($_GET['start'])?$_GET['start']:'';
$limit2 = isset($_GET['limit'])?$_GET['limit']:'';
$start = isset($_POST['start'])?$_POST['start']:'0';
$limit2 = isset($_POST['limit'])?$_POST['limit']:'10';

$marca = isset($_POST['marca'])?$_POST['marca']:'';
$marca = isset($_GET['marca'])?$_GET['marca']:$marca;
$modello = isset($_POST['modello'])?$_POST['modello']:'';
$modello = isset($_GET['modello'])?$_GET['modello']:$modello;
//

isset($_GET['prezzo'])?$_SESSION['prezzo'] = $_GET['prezzo']:$_SESSION['prezzo']=$_SESSION['prezzo'];
isset($_GET['prezzo'])?$prezzo=$_GET['prezzo']:$prezzo=$_SESSION['prezzo'];
isset($_GET['carrozzeria'])?$_SESSION['carrozzeria'] = $_GET['carrozzeria']:$_SESSION['carrozzeria']=$_SESSION['carrozzeria'];
isset($_GET['carrozzeria'])?$carrozzeria=$_GET['carrozzeria']:$carrozzeria=$_SESSION['carrozzeria'];

isset($_GET['cambio'])?$_SESSION['cambio'] = $_GET['cambio']:$_SESSION['cambio']=$_SESSION['cambio'];
isset($_GET['cambio'])?$cambio=$_GET['cambio']:$cambio=$_SESSION['cambio'];
isset($_GET['benzina'])?$_SESSION['benzina'] = $_GET['benzina']:$_SESSION['benzina']=$_SESSION['benzina'];
isset($_GET['benzina'])?$benzina=$_GET['benzina']:$benzina=$_SESSION['benzina'];
isset($_GET['diesel'])?$_SESSION['diesel'] = $_GET['diesel']:$_SESSION['diesel']=$_SESSION['diesel'];
isset($_GET['diesel'])?$diesel=$_GET['diesel']:$diesel=$_SESSION['diesel'];
isset($_GET['gpl'])?$_SESSION['gpl'] = $_GET['gpl']:$_SESSION['gpl']=$_SESSION['gpl'];
isset($_GET['gpl'])?$gpl=$_GET['gpl']:$gpl=$_SESSION['gpl'];
isset($_GET['metano'])?$_SESSION['metano'] = $_GET['metano']:$_SESSION['metano']=$_SESSION['metano'];
isset($_GET['metano'])?$metano=$_GET['metano']:$metano=$_SESSION['metano'];
isset($_GET['elettrica'])?$_SESSION['elettrica'] = $_GET['elettrica']:$_SESSION['elettrica']=$_SESSION['elettrica'];
isset($_GET['elettrica'])?$elettrica=$_GET['elettrica']:$elettrica=$_SESSION['elettrica'];
isset($_GET['ibrida'])?$_SESSION['ibrida'] = $_GET['ibrida']:$_SESSION['ibrida']=$_SESSION['ibrida'];
isset($_GET['ibrida'])?$ibrida=$_GET['ibrida']:$ibrida=$_SESSION['ibrida'];


isset($_GET['neopatentati'])?$_SESSION['neopatentati'] = $_GET['neopatentati']:$_SESSION['neopatentati']=$_SESSION['neopatentati'];
isset($_GET['neopatentati'])?$neopatentati=$_GET['neopatentati']:$neopatentati=$_SESSION['neopatentati'];
isset($_GET['citycar'])?$_SESSION['citycar'] = $_GET['citycar']:$_SESSION['citycar']=$_SESSION['citycar'];
isset($_GET['citycar'])?$citycar=$_GET['citycar']:$citycar=$_SESSION['citycar'];
isset($_GET['ecologic'])?$_SESSION['ecologic'] = $_GET['ecologic']:$_SESSION['ecologic']=$_SESSION['ecologic'];
isset($_GET['ecologic'])?$ecologic=$_GET['ecologic']:$ecologic=$_SESSION['ecologic'];

isset($_GET['prezzoDa'])?$_SESSION['prezzoDa'] = $_GET['prezzoDa']:$_SESSION['prezzoDa']=$_SESSION['prezzoDa'];
isset($_GET['prezzoDa'])?$prezzoDa=$_GET['prezzoDa']:$prezzoDa=$_SESSION['prezzoDa'];
isset($_GET['prezzoA'])?$_SESSION['prezzoA'] = $_GET['prezzoA']:$_SESSION['prezzoA']=$_SESSION['prezzoA'];
isset($_GET['prezzoA'])?$prezzoA=$_GET['prezzoA']:$prezzoA=$_SESSION['prezzoA'];

isset($_GET['annoDa'])?$_SESSION['annoDa'] = $_GET['annoDa']:$_SESSION['annoDa']=$_SESSION['annoDa'];
isset($_GET['annoDa'])?$annoDa=$_GET['annoDa']:$annoDa=$_SESSION['annoDa'];
isset($_GET['annoA'])?$_SESSION['annoA'] = $_GET['annoA']:$_SESSION['annoA']=$_SESSION['annoA'];
isset($_GET['annoA'])?$annoA=$_GET['annoA']:$annoA=$_SESSION['annoA'];

isset($_GET['carburante'])?$_SESSION['carburante'] = $_GET['carburante']:$_SESSION['carburante']=$_SESSION['carburante'];
isset($_GET['carburante'])?$carburante=$_GET['carburante']:$carburante=$_SESSION['carburante'];
/*isset($_GET['cambio'])?$_SESSION['cambio'] = $_GET['cambio']:$_SESSION['cambio']=$_SESSION['cambio'];
isset($_GET['cambio'])?$cambio=$_GET['cambio']:$cambio=$_SESSION['cambio'];*/
isset($_GET['porte'])?$_SESSION['porte'] = $_GET['porte']:$_SESSION['porte']=$_SESSION['porte'];
isset($_GET['porte'])?$nPorte=$_GET['porte']:$nPorte=$_SESSION['porte'];

isset($_GET['nPostiDa'])?$_SESSION['nPostiDa'] = $_GET['nPostiDa']:$_SESSION['nPostiDa']=$_SESSION['nPostiDa'];
isset($_GET['nPostiDa'])?$nPostiDa=$_GET['nPostiDa']:$nPostiDa=$_SESSION['nPostiDa'];
isset($_GET['nPostiA'])?$_SESSION['nPostiA'] = $_GET['nPostiA']:$_SESSION['nPostiA']=$_SESSION['nPostiA'];
isset($_GET['nPostiA'])?$nPostiA=$_GET['nPostiA']:$nPostiA=$_SESSION['nPostiA'];

isset($_GET['potenza'])?$_SESSION['potenza'] = $_GET['potenza']:$_SESSION['potenza']=$_SESSION['potenza'];
isset($_GET['potenza'])?$potenza=$_GET['potenza']:$potenza=$_SESSION['potenza'];
isset($_GET['potenzaDa'])?$_SESSION['potenzaDa'] = $_GET['potenzaDa']:$_SESSION['potenzaDa']=$_SESSION['potenzaDa'];
isset($_GET['potenzaDa'])?$potenzaDa=$_GET['potenzaDa']:$potenzaDa=$_SESSION['potenzaDa'];
isset($_GET['potenzaA'])?$_SESSION['potenzaA'] = $_GET['potenzaA']:$_SESSION['potenzaA']=$_SESSION['potenzaA'];
isset($_GET['potenzaA'])?$potenzaA=$_GET['potenzaA']:$potenzaA=$_SESSION['potenzaA'];

isset($_GET['kmDa'])?$_SESSION['kmDa'] = $_GET['kmDa']:$_SESSION['kmDa']=$_SESSION['kmDa'];
isset($_GET['kmDa'])?$kmDa=$_GET['kmDa']:$kmDa=$_SESSION['kmDa'];
isset($_GET['kmA'])?$_SESSION['kmA'] = $_GET['kmA']:$_SESSION['kmA']=$_SESSION['kmA'];
isset($_GET['kmA'])?$kmA=$_GET['kmA']:$kmA=$_SESSION['kmA'];

isset($_GET['abs'])?$_SESSION['abs'] = $_GET['abs']:$_SESSION['abs']=$_SESSION['abs'];
isset($_GET['abs'])?$abs=$_GET['abs']:$abs=$_SESSION['abs'];
isset($_GET['cruise'])?$_SESSION['cruise'] = $_GET['cruise']:$_SESSION['cruise']=$_SESSION['cruise'];
isset($_GET['cruise'])?$cruise=$_GET['cruise']:$cruise=$_SESSION['cruise'];
isset($_GET['clima'])?$_SESSION['clima'] = $_GET['clima']:$_SESSION['clima']=$_SESSION['clima'];
isset($_GET['clima'])?$clima=$_GET['clima']:$clima=$_SESSION['clima'];
isset($_GET['fari'])?$_SESSION['fari'] = $_GET['fari']:$_SESSION['fari']=$_SESSION['fari'];
isset($_GET['fari'])?$fari=$_GET['fari']:$fari=$_SESSION['fari'];

isset($_GET['classeEmissioni'])?$_SESSION['classeEmissioni'] = $_GET['classeEmissioni']:$_SESSION['classeEmissioni']=$_SESSION['classeEmissioni'];
isset($_GET['classeEmissioni'])?$classeEmissioni=$_GET['classeEmissioni']:$classeEmissioni=$_SESSION['classeEmissioni'];

//$grafica->paint();
//unset($grafica);
echo 'modello'.$modello;

list($elencoAuto, $nRecord) = estraiVeicoli_2018($marca, $modello, $carrozzeria, $annoA, $annoDa, $prezzoDa, $prezzoA, $carburante, $kmDa, $kmA, $potenza, $potenzaDa, $potenzaA, $neopatentati, $cambio, $nPorte, $nPostiDa, $nPostiA, $abs, $cruise, $clima, $fari, $classeEmissioni, $citycar,  $ecologic, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina,$start,$limit2, $debug='0');
 
            foreach ($elencoAuto as $veicolo) {

                            stampaSchedaVeicolo($veicolo);

                          }

                            

                            ?>



