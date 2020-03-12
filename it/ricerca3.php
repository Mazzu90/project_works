<?
include('include_dir.php');
include($percorsoLingua.'include/include.php');
session_start();



if(isset($_GET['r']) && $_GET['r']==1)
{
    $_SESSION = array(); //se arriva il parametro di reset, distruggo le sessioni e resetto
}

if(isset($_GET))
{
    $_SESSION = array();  //se arriva un nuovo GET, distruggo le sessioni e imposto i nuovi parametri di ricerca
}



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
/*isset($_SESSION['marca'])?$_SESSION['marca']=$_SESSION['marca']:'';
isset($_SESSION['prezzo'])?$_SESSION['prezzo']=$_SESSION['prezzo']:'';
isset($_SESSION['carrozzeria'])?$_SESSION['carrozzeria']=$_SESSION['carrozzeria']:'';
isset($_SESSION['cambio'])?$_SESSION['cambio']=$_SESSION['cambio']:'';
isset($_SESSION['benzina'])?$_SESSION['benzina']=$_SESSION['benzina']:'';
isset($_SESSION['diesel'])?$_SESSION['diesel']=$_SESSION['diesel']:'';
isset($_SESSION['gpl'])?$_SESSION['gpl']=$_SESSION['gpl']:'';
isset($_SESSION['metano'])?$_SESSION['metano']=$_SESSION['metano']:'';
isset($_SESSION['elettrica'])?$_SESSION['elettrica']=$_SESSION['elettrica']:'';
isset($_SESSION['ibrida'])?$_SESSION['ibrida']=$_SESSION['ibrida']:'';*/

//echo 'prezzoDa'.$_SESSION['prezzoDa'].'<br />';
//echo 'prezzo'.$_SESSION['prezzo'].'<br />';
//echo 'carrozzeria'.$_SESSION['carrozzeria'].'<br />';


$grafica=new Tgrafica(false,false);

$pagina = isset($_GET['pagina'])?$_GET['pagina']:1;
$nContenutiDaEstrarre = 0;
$numeroRecordPerPagina = 10; 

//se ho ricevuto qualcosa in post imposto la sessione con quel valore e la relativa variabile che userò per la query
isset($_GET['prezzo'])?$_SESSION['prezzo'] = $_GET['prezzo']:$_SESSION['prezzo']=$_SESSION['prezzo'];
isset($_GET['prezzo'])?$prezzo=$_GET['prezzo']:$prezzo=$_SESSION['prezzo'];
isset($_GET['carrozzeria'])?$_SESSION['carrozzeria'] = $_GET['carrozzeria']:$_SESSION['carrozzeria']=$_SESSION['carrozzeria'];
isset($_GET['carrozzeria'])?$carrozzeria=$_GET['carrozzeria']:$carrozzeria=$_SESSION['carrozzeria'];
isset($_GET['marca'])?$_SESSION['marca'] = $_GET['marca']:$_SESSION['marca']=$_SESSION['marca'];
isset($_GET['marca'])?$marca=$_GET['marca']:$marca=$_SESSION['marca'];
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
isset($_GET['modello'])?$_SESSION['modello'] = $_GET['modello']:$_SESSION['modello']=$_SESSION['modello'];
isset($_GET['modello'])?$modello=$_GET['modello']:$modello=$_SESSION['modello'];

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

 
$grafica->titolo='Auto usate - Brescia - AUTOUNICA srl';
$grafica->description='Autovetture usate in offerta - comprale da AUTOUNICA srl';
$grafica->keywords='auto usate, veicoli usati, vendita auto usate Brescia';
$grafica->codicePagina=costantiP::CP_TUTTELEAUTO;
$grafica->codiceBody='page1';

$grafica->paint();
unset($grafica);


function corpo_pagina()
{global $kWatt, $postiSedere, $prezziVeicoli, $annoDa, $annoA, $kmDa, $kmA, $potenzaDa, $potenzaA, $potenza, $classeEmissioni, $carburante, $abs, $cruise, $clima, $fari, $nPostiDa, $nPostiA, $kmVeicoli, $prezzo, $prezzoDa, $prezzoA, $carrozzeria, $nPorte, $cambio, $benzina, $diesel, $gpl, $metano, $elettrica, $ibrida, $marca, $modello, $neopatentati, $citycar, $ecologic, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina ;

        $checkedPrezzo1='';
        $checkedPrezzo2='';
        $checkedPrezzo3='';
        $checkedPrezzo4='';
        $checkedPrezzo5='';

    //preparo i bottoni attivi o meno  
       if ($prezzo>0)
            {       
                switch ($prezzo) {
                    case 1:
                        $checkedPrezzo1='checked="checked"';
                        $prezzoDa = '';
                        $prezzoA = '5000';
                        break;
                    case 2:
                        $checkedPrezzo2='checked="checked"';
                        $prezzoDa = '5000';
                        $prezzoA = '10000';
                        break;
                    case 3:
                        $checkedPrezzo3='checked="checked"';
                        $prezzoDa = '10000';
                        $prezzoA = '15000';
                        break;
                    case 4:
                        $checkedPrezzo4='checked="checked"';
                        $prezzoDa = '15000';
                        $prezzoA = '20000';
                        break;
                    case 5:
                        $checkedPrezzo5='checked="checked"';
                        $prezzoDa = '20000';
                        $prezzoA = '';
                        break;
                }
            }

    

    $checkedCambio1='';
    $checkedCambio2='';

    /*if ($cambio!='')
            {
                switch ($cambio) {
                case 1:
                    $checkedCambio1='checked="checked"';
                    break;
                case 2:
                    $checkedCambio2='checked="checked"';
                    break;
                case 3:
                    $checkedCambio3='checked="checked"';
                    break;
            }
        }
    */    
    $checkedPosti1='';
    $checkedPosti2='';
    $checkedPosti3='';
    $checkedPosti4='';
    
    if ($nPorte!='')
            {
                switch ($nPorte) {
                case 1:
                    $checkedPorte1='checked="checked"';
                    break;
                case 2:
                    $checkedPorte2='checked="checked"';
                    break;
                case 3:
                    $checkedPorte3='checked="checked"';
                    break;
                case 4:
                    $checkedPorte4='checked="checked"';
                    break;
            }
        }   

    $checkedBenzina='';
    if ($benzina==true)
        $checkedBenzina ='checked="checked"';

    $checkedDiesel = '';
    if ($diesel==true)
        $checkedDiesel ='checked="checked"';

    $checkedGpl='';
    if ($gpl==true)
        $checkedGpl ='checked="checked"';

    $checkeMetano = '';
    if ($metano==true)
        $checkeMetano ='checked="checked"';

    $checkedElettrica='';
    if ($elettrica==true)
        $checkedElettrica ='checked="checked"';

    $checkedIbrida = '';
    if ($ibrida==true)
        $checkedIbrida ='checked="checked"';
?>

    <section class="b-items">
			<div class="container">
				<div class="row b-bottom">

                    <div class="b-search__main-type col-lg-3 col-xs-12 pl-none pr-no-phone">
						
                    	<div class="col-lg-12 col-sm-12 col-xs-12">
							
							<form method="GET" id="formRicerca">
							
							<!--FILTRO 1**************************************************************-->
    
                            <aside class="b-items__aside">
                                <h2 class="s-title"><i class="icon-magnifier icon icon-2x"></i> FILTRI</h2>
                                <div class="accordion" id="refine">
									<div class="">
										<div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#refine" href="#refine-search1">
												<button type="submit" class="btn m-btn filter mt-none mb-md">
													DATI PRINCIPALI
													<i class="icon-arrow-down icon icon-2x"></i>
												</button>
											</a>
										</div>
									</div>
								</div>
								
								<div id="refine-search1" class="accordion-body collapse in">
                                
                                <div class="b-items__aside-main">
                                    
                                        <div class="b-items__aside-main-body">
											
											<div class="b-items__aside-main-body-item">
                                                <label>MARCA</label>
                                                <div>
                                                
                                                    <select name="marca" class="m-select filter dark" id="marca">

                                              <?
                                                      
                                                      $query = 'SELECT  marca.id,
                                                                        marca.titolo
                                                                FROM
                                                                        marca
                                            		            WHERE 
                                                                        marca.id in (select distinct id_marca from veicoli where veicoli.pubblicato = 1)
                                                                ORDER BY titolo ASC
                                                         ';

                                                        //echo $query;
                                                        $result=mysql_query($query);

                                                        $selectedMake = '';
                                                            if ($marca == '')
                                                                {
                                                                    $selectedMake = 'selected="selected"';
                                                                }
                                                            echo '<option value="" '.$selectedMake.'>Tutto</option>';


                                                        while ($row=mysql_fetch_assoc($result)) {
                                                            if ($marca == $row['id'])
                                                                    {
                                                                        $selectedMake = 'selected="selected"';
                                                                    }
                                                                    else
                                                                    {
                                                                        $selectedMake = '';
                                                                    }

                                                            echo '<option value="'.$row['id'].'" '.$selectedMake.'>'.$row['titolo'].'</option>';
                                                		 }

                                                ?>

                                                    </select>
                                                    <i class="icon-arrow-down icon icon-2x"></i>
                                                </div>
                                            </div>

                                            <div class="b-items__aside-main-body-item">
                                                <label>MODELLO</label>
                                                <div>
                                                    <select name="modello" class="m-select filter dark auto_submit_filter" id="modello2">
                                                    <option value="-1">Scegli Modello...</option>
                                                    </select>
                                                    <i class="icon-arrow-down icon icon-2x"></i>
                                                </div>
                                             </div>


                                            <div class="b-items__aside-main-body-item">
                                                <label>CARROZZERIA</label>
                                                <div>
                                                    <select name="carrozzeria" class="m-select filter dark auto_submit_filter">

                                                        <?
                                                            $query = 'select distinct
                                                                        veicoli.body from 
                                                                            veicoli 
                                                                        where
                                                                            veicoli.pubblicato = 1 
                                                                        order by 
                                                                            veicoli.body asc';
                                                            $result=mysql_query($query);
                                                           	$selectedBody = '';
                                                            if ($carrozzeria == '')
                                                                {
                                                                    $selectedBody = 'selected="selected"';
                                                                }
                                                            echo '<option value="" '.$selectedBody.'>Tutto</option>';
                                                            while ($row=mysql_fetch_assoc($result)) {
                                                                if ($carrozzeria == $row['body'])
                                                                {
                                                                    $selectedBody = 'selected="selected"';
                                                                }
                                                                else
                                                                {
                                                                    $selectedBody = '';
                                                                }
                                                                echo '<option value="'.$row['body'].'" '.$selectedBody.'>'.$row['body'].'</option>';
                                                    		 }

                                                        ?>

                                                    </select>
                                                    <i class="icon-arrow-down icon icon-2x"></i>
                                                </div>
                                            </div>
											
                                            <div class="b-items__aside-main-body-item">
                                             <label>Anno:</label>
                                                <div class="col-xs-6 pr-none pl-none mb-xxl">
                                                <select name="annoDa" class="m-select filter dark auto_submit_filter" id="annoDa">
													<?
                                                    $selectedAnno = '';
                                                    $anni = getArrayAnni();
                                                    echo '<option value="" '.$selectedAnno.'>Da</option>';
                                                    foreach ($anni as $anno) {
                                                      
                                                        if ($annoDa == $anno)
                                                                {
                                                                    $selectedAnno = 'selected="selected"';
                                                                }
                                                                else
                                                                {
                                                                    $selectedAnno = '';
                                                                }
                                                                echo '<option value="'.$anno.'" '.$selectedAnno.'>'.$anno.'</option>';
                                                        
                                                      }
                                                    
                                                    ?>
                                                    </select>
                                                    <i class="icon-arrow-down icon icon-2x"></i>
												  </div>
                                                  
                                                  <div class="col-xs-6 pr-none pl-none mb-xxl">
													<select name="annoA" class="m-select filter dark auto_submit_filter" id="annoA">
														<?
														$selectedAnno = '';
                                                            echo '<option value="" '.$selectedAnno.'>A</option>';
                                                            foreach ($anni as $anno) {
                                                              
                                                                if ($annoA == $anno)
                                                                        {
                                                                            $selectedAnno = 'selected="selected"';
                                                                        }
                                                                        else
                                                                        {
                                                                            $selectedAnno = '';
                                                                        }
                                                                        echo '<option value="'.$anno.'" '.$selectedAnno.'>'.$anno.'</option>';
                                                                
                                                              }

														?>
														</select>
														<i class="icon-arrow-down icon icon-2x"></i>
												  </div>
												
                                            </div>
											
											<div class="b-items__aside-main-body-item">
                                             <label>Prezzo:</label>
                                                <div class="col-xs-6 pr-none pl-none mb-xxl ">
                                                <select name="prezzoDa" class="m-select filter dark auto_submit_filter" id="prezzoDa">
													<?
                                                    $selectedPrice = '';
                                                    echo '<option value="" '.$selectedPrice.'>Da</option>';
                                                    foreach ($prezziVeicoli as $prezzoV) {
                                                      
                                                        if ($prezzoV == $prezzoDa)
                                                                {
                                                                    $selectedPrice = 'selected="selected"';
                                                                }
                                                                else
                                                                {
                                                                    $selectedPrice = '';
                                                                }
                                                                echo '<option value="'.$prezzoV.'" '.$selectedPrice.'>'.$prezzoV.'</option>';
                                                        
                                                      }
                                                    
                                                    ?>
                                                    </select>
                                                    <i class="icon-arrow-down icon icon-2x"></i>
												  </div>
                                                  
                                                  <div class="col-xs-6 pr-none pl-none mb-xxl">
													<select name="prezzoA" class="m-select filter dark auto_submit_filter" id="prezzoA">
														<?
														$selectedPrice = '';
														echo '<option value="" '.$selectedPrice.'>A</option>';
														foreach ($prezziVeicoli as $prezzoV) {

															if ($prezzoV == $prezzoA)
																	{
																		$selectedPrice = 'selected="selected"';
																	}
																	else
																	{
																		$selectedPrice = '';
																	}
																	echo '<option value="'.$prezzoV.'" '.$selectedPrice.'>'.$prezzoV.'</option>';

														  }

														?>
														</select>
														<i class="icon-arrow-down icon icon-2x "></i>
												  </div>
												
                                            </div>
											
											
											<div class="accordion" id="refine">
												<div class="">
													<div class="accordion-heading">
														<label>RISPARMIO</label> <i class="icon-info icon"></i>
														<a class="accordion-toggle" data-toggle="collapse" data-parent="#refine" href="#seleziona-occasioni">
															<button type="submit" class="btn m-btn filter blue mt-none mb-sm">
																SELEZIONA OCCASIONI
																<i class="icon-arrow-down icon icon-2x"></i>
															</button>
														</a>
													</div>
												</div>
											</div>
											
											<div id="seleziona-occasioni" class="accordion-body collapse out">
												<div class="b-items__aside-main-body-item">
													<label class="check_filter light_blue1 auto_submit_filter"><p>Risparmi Oltre € 2.000</p>
													   <input type="checkbox" name="risparmia" value="2000">
													  <span class="checkmark_filter"></span>
													</label>
													<label class="check_filter light_blue2 auto_submit_filter"><p>Risparmi Oltre € 5.000</p>
													   <input type="checkbox" name="risparmia" value="5000">
													  <span class="checkmark_filter"></span>
													</label>
													<label class="check_filter light_blue3 auto_submit_filter"><p>Risparmi Oltre € 9.000</p>
													   <input type="checkbox" name="risparmia" value="9000">
													  <span class="checkmark_filter"></span>
													</label>
												 </div>
											</div>
											
											
											<div class="b-items__aside-main-body-item mt-lg">
                                                <label>CARBURANTE</label>
                                                <div>
                                                    
													<select name="carburante" class="m-select filter dark auto_submit_filter" id="carburante">
                                                    <?
                                                    $selected = '';
                                                    $selected = ($carburante==-1 ? 'selected="selected"' : '');?>
                                                    <option value="-1" <?echo $selected?> >Tutto</option>
                                                    <?$selected = ($carburante==1 ? 'selected="selected"' : '');?>
                                                    <option value="1" <?echo $selected?> >Benzina</option>
                                                    <?$selected = ($carburante==2 ? 'selected="selected"' : '');?>
                                                    <option value="2" <?echo $selected?> >Diesel</option>
                                                    <?$selected = ($carburante==3 ? 'selected="selected"' : '');?>
                                                    <option value="3" <?echo $selected?> >Elettrica/Benzina</option>
                                                    <?$selected = ($carburante==4 ? 'selected="selected"' : '');?>
                                                    <option value="4" <?echo $selected?> >Benzina/GPL</option>
                                                    <?$selected = ($carburante==5 ? 'selected="selected"' : '');?>
                                                    <option value="5" <?echo $selected?> >Benzina/Metano</option>
                                                    <?$selected = ($carburante==6 ? 'selected="selected"' : '');?>
                                                    <option value="6" <?echo $selected?> >Elettrica</option>
                                                    
                                                    </select>
                                                    <i class="icon-arrow-down icon icon-2x"></i>
                                                </div>
                                             </div>
											
											<div class="b-items__aside-main-body-item">
                                             <label>KILOMETRAGGIO</label>
                                                <div class="col-xs-6 pr-none pl-none mb-xxl">
                                                <select name="kmDa" class="m-select filter dark auto_submit_filter" id="kmDa">
													<?
                                                    $selectedKm = '';
                                                    echo '<option value="" '.$selectedKm.'>Da</option>';
                                                    foreach ($kmVeicoli as $kmV) {
                                                      
                                                        if ($kmV == $kmDa)
                                                                {
                                                                    $selectedKm = 'selected="selected"';
                                                                }
                                                                else
                                                                {
                                                                    $selectedKm = '';
                                                                }
                                                                echo '<option value="'.$kmV.'" '.$selectedKm.'>'.$kmV.'</option>';
                                                        
                                                      }
                                                    
                                                    ?>
                                                    </select>
                                                    <i class="icon-arrow-down icon icon-2x"></i>
												  </div>
                                                  
                                                  <div class="col-xs-6 pr-none pl-none mb-xxl">
													<select name="kmA" class="m-select filter dark auto_submit_filter" id="kmA">
														<?
                                                            $selectedKm = '';
                                                            echo '<option value="" '.$selectedKm.'>Da</option>';
                                                            foreach ($kmVeicoli as $kmV) {
                                                              
                                                                if ($kmV == $kmA)
                                                                        {
                                                                            $selectedKm = 'selected="selected"';
                                                                        }
                                                                        else
                                                                        {
                                                                            $selectedKm = '';
                                                                        }
                                                                        echo '<option value="'.$kmV.'" '.$selectedKm.'>'.$kmV.'</option>';
                                                                
                                                              }
                                                            
                                                            ?>
														</select>
														<i class="icon-arrow-down icon icon-2x"></i>
												  </div>
												
                                            </div>
											
											<div class="b-items__aside-main-body-item">
                                             <label>POTENZA</label>
												
												<div class="col-xs-4 pr-none pl-none mb-sm">
                                                <select name="potenza" class="m-select filter dark" id="potenza">
													<?
                                                    $selected = ($potenza=='KW' ? 'selected="selected"' : '');
                                                    echo '<option value="KW" '.$selected.'>KW</option>';
                                                    $selected = ($potenza=='CV' ? 'selected="selected"' : '');
                                                    echo '<option value="CV" '.$selected.'>CV</option>';
                                                    
                                                    
                                                    ?>
                                                    </select>
                                                    <i class="icon-arrow-down icon icon-2x"></i>
												  </div>
												
                                                <div id="potenza2">
                                                <div class="col-xs-4 pr-none pl-none mb-sm">
                                                <select name="potenzaDa" class="m-select filter dark auto_submit_filter" id="potenzaDa">
													<?
                                                    $selectedPotDa = '';
                                                    echo '<option value="" '.$selectedPotDa.'>Da</option>';
                                                    foreach ($kWatt as $kW) {
                                                        
                                                        if($potenza=='CV')
                                                            $kW = round($kW*1.35962);
                                                        
                                                        if ($kW == $potenzaDa)
                                                                {
                                                                    $selectedPotDa = 'selected="selected"';
                                                                }
                                                                else
                                                                {
                                                                    $selectedPotDa = '';
                                                                }
                                                                echo '<option value="'.$kW.'" '.$selectedPotDa.'>'.$kW.'</option>';
                                                     }
                                                    
                                                    ?>
                                                    </select>
                                                    <i class="icon-arrow-down icon icon-2x"></i>
												  </div>
                                                  
                                                  <div class="col-xs-4 pr-none pl-none mb-sm">
													<select name="potenzaA" class="m-select filter dark auto_submit_filter" id="potenzaA">
													<?
                                                    $selectedPotA = '';
                                                    echo '<option value="" '.$selectedPotA.'>A</option>';
                                                    foreach ($kWatt as $kW) {
                                                        
                                                        if($potenza=='CV')
                                                            $kW = round($kW*1.35962);
                                                      
                                                        if ($kW == $potenzaA)
                                                                {
                                                                    $selectedPotA = 'selected="selected"';
                                                                }
                                                                else
                                                                {
                                                                    $selectedPotA = '';
                                                                }
                                                                echo '<option value="'.$kW.'" '.$selectedPotA.'>'.$kW.'</option>';
                                                     }
                                                    
                                                    ?>
														</select>
														<i class="icon-arrow-down icon icon-2x"></i>
												  </div>
                                                  </div><!-- ptenze -->
												
                                            </div>
											
											<div class="b-items__aside-main-body-item" style="clear: left;">
												<?
                                                 if ($neopatentati!='')
                                                    $checkedNP = 'checked="checked"';
                                                 ?>
                                                <label class="check_filter green auto_submit_filter"><p>NEOPATENTATI</p>
													   <input type="checkbox" name="neopatentati" value="on" <?echo $checkedNP ?>/>
													  <span class="checkmark_filter"></span>
													</label>
											 </div>
											
											<div class="b-items__aside-main-body-item mt-lg">
                                                <label>CAMBIO</label>
                                                <div>
                                                    <select name="cambio" class="m-select filter dark auto_submit_filter" id="cambio">
                                                    <option value="-1">Tutto</option>
                                                    <?
                                                        $selectedCambio = ($cambio=='1' ? 'selected="selected"' : '');
                                                        echo '<option value="1" '.$selectedCambio.'>Automatico</option>';
                                                        $selectedCambio = ($cambio=='2' ? 'selected="selected"' : '');
                                                        echo '<option value="2" '.$selectedCambio.'>Manuale</option>';
                                                        $selectedCambio = ($cambio=='3' ? 'selected="selected"' : '');
                                                        echo '<option value="3" '.$selectedCambio.'>Sequenziale</option>';
                                                        ?>
                                                   
                                                    </select>
                                                    <i class="icon-arrow-down icon icon-2x"></i>
                                                </div>
                                             </div>
											
                                            <div class="b-items__aside-main-body-item">
                                                <label style="margin-bottom: 0px;">N. PORTE</label>
                                                   
                                                    <div class="col-xs-3 pl-none pr-none mb-xxl ">
                                                        <input id="type1" class="auto_submit_filter" type="radio" name="porte" value="1" <?echo $checkedPorte1?>/>
                                                        <label for="type1" class="b-search__main-type-svg"></label>
                                                        <h6><label for="type1">TUTTO</label></h6>
                                                    </div>
                                                    
                                                    <div class="col-xs-3 pl-none pr-none mb-xxl">
                                                        <input id="type2" class="auto_submit_filter" type="radio" name="porte" value="2" <?echo $checkedPorte2?> />
                                                        <label for="type2" class="b-search__main-type-svg"></label>
                                                        <h6><label for="type2">2/3</label></h6>
                                                    </div>
												
													<div class="col-xs-3 pl-none pr-none mb-xxl">
                                                        <input id="type3" class="auto_submit_filter" type="radio" name="porte" value="3" <?echo $checkedPorte3?> />
                                                        <label for="type3" class="b-search__main-type-svg"></label>
                                                        <h6><label for="type3">4/5</label></h6>
                                                    </div>
												
													<div class="col-xs-3 pl-none pr-none mb-xxl">
                                                        <input id="type4" class="auto_submit_filter" type="radio" name="porte" value="4" <?echo $checkedPorte4?> />
                                                        <label for="type4" class="b-search__main-type-svg"></label>
                                                        <h6><label for="type4">6/7</label></h6>
                                                    </div>
                                            </div>
											
											<div class="b-items__aside-main-body-item">
                                             <label>N. POSTI</label>
                                                <div class="col-xs-6 pr-none pl-none mb-xxl">
                                                <select name="nPostiDa" class="m-select filter dark auto_submit_filter" id="nPostiDa">
													<?
                                                    $selectedPostoDa = '';
                                                    echo '<option value="" '.$selectedPostoDa.'>Da</option>';
                                                    foreach ($postiSedere as $posto) {
                                                      
                                                        if ($posto == $nPostiDa)
                                                                {
                                                                    $selectedPostoDa = 'selected="selected"';
                                                                }
                                                                else
                                                                {
                                                                    $selectedPostoDa = '';
                                                                }
                                                                echo '<option value="'.$posto.'" '.$selectedPostoDa.'>'.$posto.'</option>';
                                                        
                                                      }
                                                    
                                                    ?>
                                                    </select>
                                                    <i class="icon-arrow-down icon icon-2x"></i>
												  </div>
                                                  
                                                  <div class="col-xs-6 pr-none pl-none mb-xxl">
													<select name="nPostiA" class="m-select filter dark auto_submit_filter" id="nPostiA">
															<?
                                                            $selectedPostoA = '';
                                                            echo '<option value="" '.$selectedPostoA.'>A</option>';
                                                            foreach ($postiSedere as $posto) {
                                                              
                                                                if ($posto == $nPostiA)
                                                                        {
                                                                            $selectedPostoA = 'selected="selected"';
                                                                        }
                                                                        else
                                                                        {
                                                                            $selectedPostoA = '';
                                                                        }
                                                                        echo '<option value="'.$posto.'" '.$selectedPostoA.'>'.$posto.'</option>';
                                                                
                                                              }
                                                            
                                                            ?>
														</select>
														<i class="icon-arrow-down icon icon-2x"></i>
												  </div>
												
                                            </div>
                                            
                                        </div> <!--close b-items__aside-main-body-->
                                    </div> <!--b-items__aside-main-->
								</div> <!--close accordion-body-->
                            </aside><!--close filter 1-->
								
							<!--FILTRO 2**************************************************************-->	
								
							<aside class="b-items__aside">
                                <div id="refine" class="accordion">
									<div class="">
										<div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#refine" href="#refine-search2">
												<button type="submit" class="btn m-btn filter mt-none mb-md">
													EQUIPAGGIAMENTO
													<i class="icon-arrow-down icon icon-2x"></i>
												</button>
											</a>
										</div>
									</div>
								</div>
								 <?
                                if ($abs == 'on' || $cruise == 'on' || $clima == 'on' || $fari == 'on')
                                            {
                                                $classeOptional = 'in';
                                            }
                                            else
                                            {
                                                $classeOptional = 'out';
                                            }
                                
                                
                                ?>
								<div id="refine-search2" class="accordion-body collapse <?echo $classeOptional?>">
									<div class="b-items__aside-main">
										<div class="b-items__aside-main-body">


										<div class="b-items__aside-main-body-item">
											<label class="check_filter default"><p>ABS</p>
                                             <?
                                             if ($abs=='on')
                                                $checkedABS = 'checked="checked'
                                             ?>
											   <input type="checkbox" name="abs" class="auto_submit_filter" <?echo $checkedABS?> value="on">
											  <span class="checkmark_filter"></span>
											</label>
                                            <?
                                             if ($cruise=='on')
                                                $checkedCruise = 'checked="checked'
                                             ?>
											<label class="check_filter default"><p>Cruise Control</p>
											   <input type="checkbox" name="cruise" class="auto_submit_filter" <?echo $checkedCruise?> value="on">
											  <span class="checkmark_filter"></span>
											</label>
                                            <?
                                             if ($clima=='on')
                                                $checkedClima= 'checked="checked'
                                             ?>
											<label class="check_filter default"><p>Climatizzatore</p>
											   <input type="checkbox" name="clima" class="auto_submit_filter" <?echo $checkedClima?> value="on">
											  <span class="checkmark_filter"></span>
											</label>
                                            <?
                                             if ($fari=='on')
                                                $checkedFari = 'checked="checked'
                                             ?>
											<label class="check_filter default"><p>Fari LED</p>
											   <input type="checkbox" name="fari" class="auto_submit_filter" <?echo $checkedFari?> value="on">
											  <span class="checkmark_filter"></span>
											</label>
										 </div>



										</div> <!--close b-items__aside-main-body-->
									</div> <!--b-items__aside-main-->
								</div> <!--close accordion-body-->
                            </aside><!--close filter 2-->
								
							
							<!--FILTRO 3**************************************************************-->	
								
							<aside class="b-items__aside">
                                <div id="refine" class="accordion">
									<div class="">
										<div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#refine" href="#refine-search3">
												<button type="submit" class="btn m-btn filter mt-none mb-none">
													CLASSE EMISSIONI
													<i class="icon-arrow-down icon icon-2x"></i>
												</button>
											</a>
										</div>
									</div>
								</div>
								
                                <?
                                if ($classeEmissioni != '')
                                            {
                                                $collapseEmissioni = 'in';
                                            }
                                            else
                                            {
                                                $collapseEmissioni = 'out';
                                            }
                                
                                
                                ?>
								<div id="refine-search3" class="accordion-body collapse <?echo $collapseEmissioni?>">
                                
                                <div class="b-items__aside-main">
                                    
                                        <div class="b-items__aside-main-body">
											
											<div class="b-items__aside-main-body-item">
                                                <div>
                                                    <select name="classeEmissioni" class="m-select filter dark auto_submit_filter" id="classeEmissioni"> 
<?
                                                            $query = 'select distinct
                                                                        veicoli.emission_class from 
                                                                            veicoli 
                                                                        where
                                                                            veicoli.pubblicato = 1 
                                                                        order by 
                                                                            veicoli.emission_class asc';
                                                            $result=mysql_query($query);
                                                           	
                                                               $selectedClasseEmissioni = '';
                                                            if ($classeEmissioni == '')
                                                                {
                                                                    $selectedClasseEmissioni = 'selected="selected"';
                                                                }
                                                            echo '<option value="" '.$selectedClasseEmissioni.'>Tutto</option>';
                                                            while ($row=mysql_fetch_assoc($result)) {
                                                                if ($classeEmissioni == $row['emission_class'])
                                                                {
                                                                    $selectedClasseEmissioni = 'selected="selected"';
                                                                }
                                                                else
                                                                {
                                                                    $selectedClasseEmissioni = '';
                                                                }
                                                                echo '<option value="'.$row['emission_class'].'" '.$selectedClasseEmissioni.'>'.emissionDecode($row['emission_class']).'</option>';
                                                    		 }

                                                        ?>

                                                    </select>
                                                    <i class="icon-arrow-down icon icon-2x"></i>
                                                </div>
                                            </div>

                                        
                                            
                                        </div> <!--close b-items__aside-main-body-->
                                    </div> <!--b-items__aside-main-->
								</div> <!--close accordion-body-->
                            </aside><!--close filter 3-->
								
								
							</form>	
                        </div>
                    </div> <!--CLOSE FILTER COL ************************************************-->

                    

                    <div class="col-lg-9 col-xs-12 pr-none pl-none">
                                <? define('FIRST', 0);
                                 define('LIMIT', 10);?>
                                <input type="hidden" id="first" name="first" value="<?php echo FIRST+10; ?>" />
                                <input type="hidden" id="limit" name="limit" value="<?php echo LIMIT; ?>" />
                       
                        <!--
                        <input type="hidden" id="first" name="first" value="<?php echo FIRST+10; ?>" />
                        <input type="hidden" id="limit" name="limit" value="<?php echo LIMIT; ?>" />
                        -->
                        <?
                        
                           //GENERO ELENCO AUTO...
                          //list($elencoAuto, $nRecord) = estraiVeicoli2($prezzo, $prezzoDa, $prezzoA, $carrozzeria, $cambio, $benzina, $diesel, $gpl, $metano, $elettrica, $ibrida, $marca, $modello, $neopatentati, $citycar, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina, FIRST,LIMIT);
 
                          list($elencoAuto, $nRecord) = estraiVeicoli_2018($marca, $modello, $carrozzeria, $annoA, $annoDa, $prezzoDa, $prezzoA, $carburante, $kmDa, $kmA, $potenza, $potenzaDa, $potenzaA, $neopatentati, $cambio, $nPorte, $nPostiDa, $nPostiA, $abs, $cruise, $clima, $fari, $classeEmissioni, $citycar,  $ecologic, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina,FIRST,LIMIT, $debug='0');

                          //SE NON HO VEICOLI CHE CORRISPONDONO ALLA RICHIESTA...
                          $titoloPagina = "";
                          if (!$elencoAuto || $elencoAuto =='')
                          {
                            ?>
                                    <div class="col-md-12 b-sorryBar bg-light_blue white" id="sorryBar">
            							<div class="col-md-3"><img src="<?echo costantiP::BASE_URL?>images/icon-sorry.svg" class="b-sorryBar_icon" /></div>
            							<div class="col-md-9">
            								<h1 class="mb-none">SORRY</h1>
            								<h3 class="mt-none">OGGI NON ABBIAMO AUTO CHE CORRISPONDONO<br>
            								ESSATTAMENTE AI TUOI CRITERI DI RICERCA.</h3>
            								<h3 class="mt-none" style="font-weight: 200;">Prova a modificare o cancellare i tuoi filtri oppure dai un'occhiata a queste occasioni simili, potrebbero piacerti e soddisfare la tua ricerca.</h3>
            							</div>
            							<div class="b-sorryBar_close"><a href="#"><img src="<?echo costantiP::BASE_URL?>images/icon-closesheet2.svg" /></a></div>
            						</div>
                            <? 
                             //GENERO ELENCO AUTO...
                            $elencoAuto = estraiVeicoliSimili($prezzoDa, $prezzoA, $carrozzeria, $cambio, $carburante, $citycar, $neopatentati, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina,FIRST,LIMIT, $debug='0');
                             
                          }
                          else
                          {
                            $titoloPagina = "<h4>".$nRecord." ANNUNCI TROVATI PER LA TUA RICERCA</h4>";
                          }
                        
                        
                        ?>
						
						
						
						<div class="col-md-12 b-activeFilter">
							<?echo $titoloPagina;
                                linguette($marca, $modello, $carrozzeria, $annoA, $annoDa, $prezzoDa, $prezzoA, $carburante, $kmDa, $kmA, $potenza, $potenzaDa, $potenzaA, $neopatentati, $cambio, $nPorte, $nPostiDa, $nPostiA, $abs, $cruise, $clima, $fari, $classeEmissioni, $citycar,  $ecologic);
                            ?>
							
						</div>
                        
                        <div id="elencoauto" class="scroll">

                          <?
 
                         /* //ALTRIMENTI STAMPO ELENCO AUTO
                          foreach ($elencoAuto as $veicolo) {

                            
                                        stampaSchedaVeicolo($veicolo);

                            
                          }*/
                            ?>
                            
                            
                        </div><!-- //elenco auto -->
                        <div id="loader" style="visibility: hidden;">Loading..</div>
                    </div>

                    <br clear="all">
					
					

					</div>
				</div>
			</div>
		</section><!--b-items-->

		<section class="b-featured light_blue">
			<div class="container">
				<div class="col-xs-6">
					<img src="../../images/icon-tipiaceauto.png" class="img-responsive"/>
				</div>
				<div class="col-xs-6">
					<h1 class="mb-none mt-none">TI PIACE UNA DI QUESTE AUTO?</h1>
					<h1 class="mb-none mt-none">CI PENSIAMO NOI A CHIAMARTI</h1>
					<h3 class="mb-none mt-none">Lasciaci il tuo numero di telefono, ti chiameremo<br>
					prima possibile per dare risposta a tutte le tue<br>
					domande o per fissare un appuntamento in sede.</h3>
					<br /><br />
					<!--<div class="link"><a href="">SCOPRI DI PIÃ¹ ></a></div>-->
				</div>

				<br clear="all">

				<form id="contactForm"  class="s-form">

					<div class="col-xs-6">
						<input type="text" placeholder="NOME E COGNOME *" value="" name="name" id="name"  required="required"/>
					</div>

					<div class="col-xs-6">
						<input type="text" placeholder="TELEFONO *" value="" name="telefono" id="telefono"/>

						<div class="col-md-12 col-xs-12 p-none">
							<div class="col-md-7 col-xs-12 p-none">
								<p class="mb-xs" style="color: #FFF;">* Campi Obbligatori</p>
								<label class="check_privacy lightblue"><p>Ho letto l'informativa sulla privacy<br>e acconsento al trattamento dei dati.</p>
								   <input type="checkbox" name="privacy" value="privacy">
								  <span class="checkmark"></span>
								</label>
							</div>
							<div class="col-md-5 col-xs-12 p-none">
								 <button type="submit" class="btn m-btn light f-right mt-sm mb-md">INVIA</button>
							</div>
						</div>
					</div>

				</form>

			</div>
		</section><!--b-featured-->

		<section class="b-featured preFooter">
			<div class="container">
				<div class="col-xs-12">
					<h2 class="title">PERCHè SCEGLIERE AUTOUNICA</h2>
				</div>
			</div>	
		</section>

		<? preFooter() ?>

    <?

}

function HeaderAggiuntivi()

{
    ?>
    <?
}

function scriptFooterAggiuntivi()

{global $modello;

    ?>

   <script src="../js/infscroll.js"></script> 
   <!-- <script src="../js/jquery.jscroll.js"></script>-->
   

     <script>
     
        function submitForm(e){
                     
                    //alert('filtro');
                    //get the action-url of the form
                    var actionurl = 'ricerca-ajax.php';
                    
                    //e.preventDefault();
                            
                    //do your own request an handle the results
                    $.ajax({
                            url: actionurl,
                            type: 'get',
                            dataType: 'html',
                            data: $("#formRicerca").serialize(),
                            success: function(msg) {
                                $("#elencoauto").html(msg);//stampa i risultati dentro la seconda select
                                
                            }
                    });
                };
     
        $(function() {                       //run when the DOM is ready
              $(".b-search-item-custom").click(function() {
                $('.b-search-item-custom.active').removeClass('active');//use a class, since your ID gets mangled
                $(this).addClass("active");      //add the class to the clicked element
                
                
                var prezzo = $('.codicePrezzi .active').data("id");
                $( "#codicePrezzo" ).remove();
                    var input = $("<input>")
                       .attr("type", "hidden")
                       .attr("id", "codicePrezzo")
                       .attr("name", "prezzo").val(prezzo);
                       $('#formRicerca').append($(input));
               
              });
            });
           
               $(function() {                       //run when the DOM is ready
                  $(".b-sorryBar_close").click(function() {
                    $("#sorryBar").fadeOut( 250, function() {
                        // Animation complete.
                      });    
                });  
             });


                 /* submit if elements of class=auto_submit_item in the form changes */
                $(function() {
                   $(".auto_submit_item").change(function() {
                    $("#risultati").html('AAAAAAAAAAAAAAA');//stampa i risultati dentro la seconda select
                        
                   
                   });
                   
                 });
                 
                   
                   
                    /* submit if elements of class=pippo in the form changes */
                   $(function() {
                   $(".auto_submit_filter").change(function(e) {
                    
                    submitForm(e);
                        
                   
                   });
                   
                 });

        $(document).ready(function() {
                    
                    /*$('.scroll').jscroll({
                        autoTrigger: true
                    });*/
            
            

                //recupero variabile "discriminante"
                var marca = $("#marca").val();
                var modello = <?echo $modello?>;

                //chiamata ajax

                        $.ajax({
        
                        type: "POST",
        
                        url: "select-modello.php",
        
                        data: "marca=" + marca +"&modello=" +modello,
                        dataType: "html",
        
                        success: function(msg)
                        {
                            $("#modello2").html(msg);//stampa i risultati dentro la seconda select
                            //$("#formRicerca").submit();
                        },
                        error: function()
                        {
                        alert("Chiamata fallita, si prega di riprovare..."); //sempre meglio impostare una callback in caso di fallimento
                        }
                    });
                    
                    //recupero variabile "discriminante"
                        var potenza = $("#potenza").val();
                        var potenzaDa = $("#potenzaDa").val();
                        var potenzaA = $("#potenzaA").val();
                        //chiamata ajax
                        //alert ('potenzaDa: '.potenzaDa);
        
                        $.ajax({
                        type: "POST",
                        url: "select-potenza.php",
                        data: "potenza=" + potenza +"&potenzaDa=" + potenzaDa + "&potenzaA=" + potenzaA,
                        dataType: "html",
        
                        success: function(msg)
                        {
                            $("#potenza2").html(msg);//stampa i risultati dentro la seconda select
                        },
                        error: function()
                        {
                        alert("Chiamata fallita, si prega di riprovare..."); //sempre meglio impostare una callback in caso di fallimento
                        }
                    });
                    
                    submitForm();

            //al cambio di valore della select attivo questa procedura

            $('#marca').change(function() {

                        //recupero variabile "discriminante"
                        var marca = $("#marca").val();
                        var modello = '';
                        //chiamata ajax
        
                        $.ajax({
                        type: "POST",
                        url: "select-modello.php",
                        data: "marca=" + marca +"&modello=" +modello,
                        dataType: "html",
        
                        success: function(msg)
                        {
                            $("#modello2").html(msg);//stampa i risultati dentro la seconda select
                            submitForm();
                            //$("#formRicerca").submit();
                        },
                        error: function()
                        {
                        alert("Chiamata fallita, si prega di riprovare..."); //sempre meglio impostare una callback in caso di fallimento
                        }
                    });
                 });   
                 
            $('#potenza').change(function() {

                        //recupero variabile "discriminante"
                        var potenza = $("#potenza").val();
                        var potenzaDa = $("#potenzaDa").val();
                        var potenzaA = $("#potenzaA").val();
                        //chiamata ajax
                        
                        $.ajax({
                        type: "POST",
                        url: "select-potenza.php",
                         data: "potenza=" + potenza +"&potenzaDa=" + potenzaDa + "&potenzaA=" + potenzaA,
                        dataType: "html",
        
                        success: function(msg)
                        {
                            $("#potenza2").html(msg);//stampa i risultati dentro la seconda select
                        },
                        error: function()
                        {
                        alert("Chiamata fallita, si prega di riprovare..."); //sempre meglio impostare una callback in caso di fallimento
                        }
                    });
                 }); 

         
                
               
         

         //$(window).bind('load', function() {

           // if ($(this).width() < 767) {

            //    $('#refine-search').removeClass('in');
            //    $('#refine-search').addClass('out');
            //    $('#refine').addClass('show');

            // } else {
			
            //    $('#refine-search').removeClass('out');
            //    $('#refine-search').addClass('in');
            //    $('#refine').addClass('hidden');

           // }

       // });

         
		// Window Scrool Animation

		/*$().ready(function() {
		  var $scrollingDiv = $("#filtri");
	      var $mTop = $("0");
			
		
		  $(window).scroll(function(){ 
			$scrollingDiv.stop().animate({"marginTop": ($(window).scrollTop() + 00) + "px"}, 1000);
		  });
		});
        
        
              $.fn.scrollPosReaload = function(){
                if (localStorage) {
                    var posReader = localStorage["posStorage"];
                    if (posReader) {
                        $(window).scrollTop(posReader);
                        localStorage.removeItem("posStorage");
                    }
                    $(this).click(function(e) {
                        localStorage["posStorage"] = $(window).scrollTop();
                    });
        
                    return true;
                }
        
                return false;
            }*/
});
        </script>
           <script>
 var updateQueryStringParam = function (key, value) {

    var baseUrl = [location.protocol, '//', location.host, location.pathname].join(''),
        urlQueryString = document.location.search,
        newParam = key + '=' + value,
        params = '?' + newParam;

    // If the "search" string exists, then build params from it
    if (urlQueryString) {
        var updateRegex = new RegExp('([\?&])' + key + '[^&]*');
        var removeRegex = new RegExp('([\?&])' + key + '=[^&;]+[&;]?');

        if( typeof value == 'undefined' || value == null || value == '' ) { // Remove param if value is empty
            params = urlQueryString.replace(removeRegex, "$1");
            params = params.replace( /[&;]$/, "" );

        } else if (urlQueryString.match(updateRegex) !== null) { // If param exists already, update it
            params = urlQueryString.replace(updateRegex, "$1" + newParam);

        } else { // Otherwise, add it to end of query string
            params = urlQueryString + '&' + newParam;
        }
    }

    // no parameter was set so we don't need the question mark
    params = params == '?' ? '' : params;

    window.history.replaceState({}, "", baseUrl + params);
};
  
  </script>
       

    <?

}

?>

