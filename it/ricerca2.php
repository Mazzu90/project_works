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
    $_SESSION = array();  //se arriva un nuovo POST, distruggo le sessioni e imposto i nuovi parametri di ricerca
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
/*
echo 'marca'.$_SESSION['marca'].'<br />';
echo 'prezzo'.$_SESSION['prezzo'].'<br />';
echo 'carrozzeria'.$_SESSION['carrozzeria'].'<br />';
*/

$grafica=new Tgrafica(false,false);

$pagina = isset($_GET['pagina'])?$_GET['pagina']:1;
$nContenutiDaEstrarre = 0;
$numeroRecordPerPagina = 10; 

//se ho ricevuto qualcosa in post imposto la sessione con quel valore e la relativa variabile che userò per la query
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
isset($_GET['marca'])?$_SESSION['marca'] = $_GET['marca']:$_SESSION['marca']=$_SESSION['marca'];
isset($_GET['marca'])?$marca=$_GET['marca']:$marca=$_SESSION['marca'];
isset($_GET['modello'])?$_SESSION['modello'] = $_GET['modello']:$_SESSION['modello']=$_SESSION['modello'];
isset($_GET['modello'])?$modello=$_GET['modello']:$modello=$_SESSION['modello'];
isset($_GET['neopatentati'])?$_SESSION['neopatentati'] = $_GET['neopatentati']:$_SESSION['neopatentati']=$_SESSION['neopatentati'];
isset($_GET['neopatentati'])?$neopatentati=$_GET['neopatentati']:$neopatentati=$_SESSION['neopatentati'];
isset($_GET['citycar'])?$_SESSION['citycar'] = $_GET['citycar']:$_SESSION['citycar']=$_SESSION['citycar'];
isset($_GET['citycar'])?$citycar=$_GET['citycar']:$citycar=$_SESSION['citycar'];
isset($_GET['prezzoDa'])?$_SESSION['prezzoDa'] = $_GET['prezzoDa']:$_SESSION['prezzoDa']=$_SESSION['prezzoDa'];
isset($_GET['prezzoDa'])?$prezzoDa=$_GET['prezzoDa']:$prezzoDa=$_SESSION['prezzoDa'];
isset($_GET['prezzoA'])?$_SESSION['prezzoA'] = $_GET['prezzoA']:$_SESSION['prezzoA']=$_SESSION['prezzoA'];
isset($_GET['prezzoA'])?$prezzoA=$_GET['prezzoA']:$prezzoA=$_SESSION['prezzoA'];

$grafica->titolo='Auto usate - Brescia - AUTOUNICA srl';
$grafica->description='Autovetture usate in offerta - comprale da AUTOUNICA srl';
$grafica->keywords='auto usate, veicoli usati, vendita auto usate Brescia';
$grafica->codicePagina=costantiP::CP_TUTTELEAUTO;
$grafica->codiceBody='page1';

$grafica->paint();
unset($grafica);


function corpo_pagina()
{global $prezziVeicoli, $prezzo, $prezzoDa, $prezzoA, $carrozzeria, $cambio, $benzina, $diesel, $gpl, $metano, $elettrica, $ibrida, $marca, $modello, $neopatentati, $citycar,  $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina ;

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

    if ($cambio!='')
            {
                switch ($cambio) {
                case 1:
                    $checkedCambio1='checked="checked"';
                    break;
                case 2:
                    $checkedCambio2='checked="checked"';
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

                    <div class="b-search__main-type col-lg-4 col-sm-5 col-xs-12 pl-none pr-no-phone">
                    	<div class="col-lg-12 col-sm-12 col-xs-12">
    
                            <aside id="filtri" class="b-items__aside">
                                <h2 class="s-title no-phone">RICERCA AVANZATA</h2>
                                <div class="accordion" id="refine">
									<div class="visible-phone">
										<div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#refine" href="#refine-search">
												<footer class="b-items__aside-main-footer">	
													<button type="submit" class="btn m-btn mt-none mb-md" style="width: 100%;">RICERCA AVANZATA <span class="fa fa-angle-down" style="margin-left: 0px;"></span> </button>
												</footer>
											</a>
										</div>
									</div>
								</div>
								<div id="refine-search" class="accordion-body collapse in">
                                
                                <div id="posizione" class="b-items__aside-main">
                                    <form action="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/ricerca.php" method="GET" id="formRicerca">
                                        <div class="b-items__aside-main-body">
                                            <!--
                                            <div class="b-items__aside-main-body-item codicePrezzi">
                                                <label>FASCIA DI PREZZO</label>
                                                
                                               	<? $filtroAttivo=($prezzo==1)?' active ':'' ?>
                                                <div class="col-xs-6 col-md-6 pl-none" >
													<div class="b-search-item-custom <?echo $filtroAttivo?>" data-id="1">
														<div class="b-search-item-custom-value"><span>da €.</span><br>0</div>
														<div class="b-search-item-custom-divider"></div>
														<div class="b-search-item-custom-value"><span>a €.</span><br>5<sup>.000</sup></div>
													</div>
												</div>

												<? $filtroAttivo=($prezzo==2)?' active ':'' ?>
                                                <div class="col-xs-6 col-md-6 pr-none">
													<div class="b-search-item-custom <?echo $filtroAttivo?>" data-id="2">
														<div class="b-search-item-custom-value"><span>da €.</span><br>5<sup>.000</sup></div>
														<div class="b-search-item-custom-divider"></div>
														<div class="b-search-item-custom-value"><span>a €.</span><br>10<sup>.000</sup></div>
													</div>
												</div>

												<? $filtroAttivo=($prezzo==3)?' active ':'' ?>
                                                <div class="col-xs-6 col-md-6 pl-none" >
													<div class="b-search-item-custom <?echo $filtroAttivo?>" data-id="3">
														<div class="b-search-item-custom-value"><span>da €.</span><br>10<sup>.000</sup></div>
														<div class="b-search-item-custom-divider"></div>
														<div class="b-search-item-custom-value"><span>a €.</span><br>15<sup>.000</sup></div>
													</div>
												</div>

												<? $filtroAttivo=($prezzo==4)?' active ':'' ?>
                                                <div class="col-xs-6 col-md-6 pr-none">
													<div class="b-search-item-custom <?echo $filtroAttivo?>"  data-id="4">
														<div class="b-search-item-custom-value"><span>da €.</span><br>15<sup>.000</sup></div>
														<div class="b-search-item-custom-divider"></div>
														<div class="b-search-item-custom-value"><span>a €.</span><br>20<sup>.000</sup></div>
													</div>
												</div>

												<? $filtroAttivo=($prezzo==5)?' active ':'' ?>
                                                <div class="col-xs-6 col-md-6 pl-none">
													<div class="b-search-item-custom <?echo $filtroAttivo?>"  data-id="5">
														<div class="b-search-item-custom-value2"><span>oltre</span><br>20<sup>.000</sup></div>
													</div>
												</div> 
                                                
                                                      
                                                        
                                            </div>
                                            <br clear="all"><br>
                                            -->
                                            <div class="b-items__aside-main-body-item">
                                             <label>Prezzo:</label>
                                                <div class="col-xs-6 pr-none pl-none">
                                                <select name="prezzoDa" class="m-select filter" id="prezzoDa">
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
                                                    <span class="fa fa-angle-down fa-4x"></span>
												  </div>
                                                  
                                                  <div class="col-xs-6 pr-none pl-none">
                                                        <select name="prezzoA" class="m-select filter" id="prezzoA">
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
                                                            <span class="fa fa-angle-down fa-4x"></span>
    												  </div>
                                                  
                                            
                                            </div>

                                            <br clear="all"><br> 


                                            <div class="b-items__aside-main-body-item">
                                                <label>MARCA</label>
                                                <div>
                                                    <select name="marca" class="m-select filter" id="marca">

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
                                                    <span class="fa fa-angle-down fa-4x"></span>
                                                </div>
                                            </div>

                                            <div class="b-items__aside-main-body-item">
                                                <label>MODELLO</label>
                                                <div>
                                                    <select name="modello" class="m-select filter" id="modello2">
                                                    <option value="-1">Scegli Modello...</option>
                                                    </select>
                                                    <span class="fa fa-angle-down fa-4x"></span>
                                                </div>
                                             </div>


                                            <div class="b-items__aside-main-body-item">
                                                <label>CARROZZERIA</label>
                                                <div>
                                                    <select name="carrozzeria" class="m-select filter">

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
                                                    <span class="fa fa-angle-down fa-4x"></span>
                                                </div>
                                            </div>

                                            <div class="b-items__aside-main-body-item">
                                                <label>TIPOLOGIA DI CAMBIO</label>
                                                   
                                                    <div class="col-xs-6 pl-none">
                                                        <input id="type5" type="radio" name="cambio" value="1" <?echo $checkedCambio1?>/>
                                                        <label for="type5" class="b-search__main-type-svg"></label>
                                                        <h5><label for="type5">A</label></h5>
                                                    </div>
                                                    
                                                    <div class="col-xs-6 pr-none">
                                                        <input id="type6" type="radio" name="cambio" value="2" <?echo $checkedCambio2?> />
                                                        <label for="type6" class="b-search__main-type-svg"></label>
                                                        <h5><label for="type6">M</label></h5>
                                                    </div>
                                            </div>

                                            <br clear="all"><br>

                                             <div class="b-items__aside-main-body-item">
                                                <label>ALIMENTAZIONE</label>
                                                
                                                    <div class="col-xs-6 pl-none">
                                                        <input id="type7" type="checkbox" name="benzina" value="true" <?echo $checkedBenzina?> />
                                                        <label for="type7" class="b-search__main-type-svg"></label>
                                                        <h5><label for="type7">BENZINA</label></h5>
                                                    </div>

                                                    <div class="col-xs-6 pr-none">
                                                        <input id="type8" type="checkbox" name="diesel" value="true" <?echo $checkedDiesel?> />
                                                        <label for="type8" class="b-search__main-type-svg"></label>
                                                        <h5><label for="type8">DIESEL</label></h5>
                                                    </div>
                                                    
                                                    <div class="col-xs-6 pl-none">
                                                        <input id="type9" type="checkbox" name="gpl" value="true" <?echo $checkedGpl?> />
                                                        <label for="type9" class="b-search__main-type-svg"></label>
                                                        <h5><label for="type9">GPL</label></h5>
                                                    </div>

                                                    <div class="col-xs-6 pr-none">
                                                        <input id="type10" type="checkbox" name="metano" value="true" <?echo $checkeMetano?> />
                                                        <label for="type10" class="b-search__main-type-svg"></label>
                                                        <h5><label for="type10">METANO</label></h5>
                                                    </div>
                                                    
                                                    <div class="col-xs-6 pl-none">
                                                        <input id="type11" type="checkbox" name="elettrica" value="true" <?echo $checkedElettrica?> />
                                                        <label for="type11" class="b-search__main-type-svg"></label>
                                                        <h5><label for="type11">ELETTR.</label></h5>
                                                    </div>

                                                    <div class="col-xs-6 pr-none">
                                                        <input id="type12" type="checkbox" name="ibrida" value="true" <?echo $checkedIbrida?> />
                                                        <label for="type12" class="b-search__main-type-svg"></label>
                                                        <h5><label for="type12">IBRIDA</label></h5>
                                                    </div>		
                                               
                                            </div>
                                        </div>
                                         <br clear="all"><br>
                                        <footer class="b-items__aside-main-footer">
                                            <!--<a class="f-left mt-sm reset" href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/ricerca.php?r=1"><span class="icon-aperta-quadra"></span>RESET FILTRI<span class="icon-chiusa-quadra"></span></a>-->
                                            <button type="submit" class="btn m-btn f-right mt-none" style="width: 100%;">CERCA</button><br />
                                        </form>
										<!--<form action="ricerca.php" method="GET">
											<input type="hidden" id="neopantentati" name="neopatentati" value="1" />
											<button type="submit" class="btn m-btn m-btm-gradient2 f-right mt-md">AUTO X NEOPATENTATI</button>
										</form><br />-->
                                        </footer>
                                    </div>
                            </aside>
                        </div>
                    </div>

                    

                    <div class="col-lg-8 col-sm-7 col-xs-12 pr-none pl-none">

                      <? define('FIRST', 0);
                        define('LIMIT', 10);?>
                        
                        <input type="hidden" id="first" value="<?php echo FIRST; ?>" />
                        <input type="hidden" id="limit" value="<?php echo LIMIT; ?>" />

                        <?
                        
                           //GENERO ELENCO AUTO...
                          list($elencoAuto, $nRecord) = estraiVeicoli2($prezzo, $prezzoDa, $prezzoA, $carrozzeria, $cambio, $benzina, $diesel, $gpl, $metano, $elettrica, $ibrida, $marca, $modello, $neopatentati, $citycar, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina, FIRST,LIMIT);
                          
                          
                                      
                          //SE NON HO VEICOLI CHE CORRISPONDONO ALLA RICHIESTA...
                          if (!$elencoAuto || $elencoAuto =='')
                          {
                            echo '<div class="col-lg-12" style="background-color:#87d0ef"><h1>Nessun annuncio disponibile per i criteri di ricerca selezionati</h1>';  
                            echo '<h2>Ecco alcune proposte alternative</h2></div>'; 
                             //GENERO ELENCO AUTO...
                            $elencoAuto = estraiVeicoliSimili($prezzo,  $prezzoDa, $prezzoA, $carrozzeria, $cambio, $benzina, $diesel, $gpl, $metano, $elettrica, $ibrida, $marca, $modello, $neopatentati, $citycar, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina, FIRST,LIMIT);
 
                          }
                        
                        
                        ?>
                        
                        <div id="elencoauto" class="scroll">

                          <?

                          
                          
                          //ALTRIMENTI STAMPO ELENCO AUTO
                          foreach ($elencoAuto as $veicolo) {

                            if (costantiP::URL_REWRITE_ATTIVO)
                                    {
                                        $path = costantiP::BASE_URL.costantiP::LINGUA.'/'.normalizzaTesto($veicolo['make']).'/'.normalizzaTesto($veicolo['model']).'-'.normalizzaTesto($veicolo['version']).'_'.$veicolo['id'].'.htm';
                                    }
                                    else
                                    {
                                        $path = costantiP::BASE_URL.costantiP::LINGUA.'/dettaglio-auto.php?id='.$veicolo['id'];                                
                                    }

                                                                     ?>

                          <div class="col-lg-12 col-sm-12 col-xs-12 mb-xl pr-none pl-none post-id" id="<?echo $veicolo['id']?>">
                            <div class="b-items__cars-one  " data--delay="0.5s">
                                    <div class="col-lg-8 col-sm-12 col-xs-12"  >
                                        <h3 class="mb-none"><?echo $veicolo['make'].' '.$veicolo['model']?></h3>
                                        <h4 class="mt-none"><?echo $veicolo['version']?></h4>
                                        <div id="auto_<?echo $veicolo['id']?>" class="carousel slide"  data-ride="carousel" data-interval="false" >

              

            

                                              <!-- Wrapper for slides -->

                                              <div class="carousel-inner" role="listbox" >
                                                <div class="item active">

                                                

                                                <?      /*
                                                        1 - benzina
                                                        2 - diesel
                                                        3 - ibrida
                                                        4 - gpl
                                                        5 - metano
                                                        6 - elettrica
                                                        */

                                           $etichetta = false;

                                           

                                           switch ($veicolo['alimentazioneCodice']) {

                                                                case 200000000:
                                                                    $venduta = '';
                                                                    $imgOverlay = 'diesel200';
                                                                    $etichetta = true;
                                                                    break;

                                                                case 3:
                                                                    $venduta = '';
                                                                    $imgOverlay = 'ibrida200';
                                                                    $etichetta = true;
                                                                    break;

                                                                case 4:
                                                                    $venduta = '';
                                                                    $imgOverlay = 'gpl200';
                                                                    $etichetta = true;
                                                                    break;

                                                                case 5:
                                                                    $venduta = '';
                                                                    $imgOverlay = 'metano200';
                                                                    $etichetta = true;
                                                                    break;

                                                                case 6:
                                                                    $venduta = '';
                                                                    $imgOverlay = 'elettrica200';
                                                                    $etichetta = true;
                                                                    break;

                                                                case 10000000: 
                                                                    $venduta = '';
                                                                    $imgOverlay = 'benzina200';
                                                                    $etichetta = true;
                                                                    break;
                                                            }

                                            if($veicolo['neopatentati']==1)
                                                                {   
                                                                    $venduta = '';
                                                                    $imgOverlay = 'neopatentati200';
                                                                    $etichetta = true;
                                                                }


                                            if ($veicolo['telaio']!='')
                                                                {   
                                                                    $venduta = 'venduta';
                                                                    $imgOverlay = 'venduta200';
                                                                    $etichetta = true;
                                                                }

                                                        ?>

                                            <?

                                            

                                             if ($etichetta)
                                             {

                                                ?>
                                                <!--  linguetta in overlay -->
                                                <a href="<?echo $path?>" class="<?echo $venduta?>">
                                                	<span class="<?echo $venduta?>"></span>
                                                </a>

                                                <span class="etichettaCorner  m-premium">
                                                	<img src="../../images/<?echo $imgOverlay?>.png" class="img-responsive"/>
                                                </span>
                                                <?
                                             }
                                            ?> 

                                                <!-- immagine principale-->
                                                 <a class="details" href="<?echo $path?>">
                                                  <img src="<?echo $veicolo['img']?>" alt='auto01' class="img-responsive"/>
                                                 </a>    

                                                </div>

                                            <?

                                                    $sql = 'select immagini.* from immagini where immagini.id_veicolo = '.$veicolo['id'].' limit 1,3';
                                                     $immaginiVeicolo = '';
                                                     $result=mysql_query($sql);

                                                       while ($rowImmagini=mysql_fetch_assoc($result)) {
                                                                $immagineVeicolo['id']=$rowImmagini['id'];
                                                                $immagineVeicolo['img']=$rowImmagini['img'];
                                                                $immagineVeicolo['imgBig']=$rowImmagini['img_big'];
                                                                $immagineVeicolo['titolo']=$rowImmagini['titolo'];
                                                                $immaginiVeicolo[]=$immagineVeicolo; 
                                                            }

                                            foreach ($immaginiVeicolo as $imgV) {

                                                ?>    

                                               <div class="item">
                                                <a class="details" href="<?echo $path?>">
                                                 <img src="<?echo $imgV['imgBig']?>" alt='<?echo $imgV['titolo']?>' class="img-responsive"/>
                                                 </a>
                                               </div>

                                            <? 

                                                }

                                            ?>

											<div class="item">
												<a class="details" href="<?echo $path?>">
													<img src="../images/scopri.png" class="img-responsive"/>
												</a>
											</div>

                                             </div>

                                              <!-- Left and right controls -->
                                              <a class="left carousel-control" href="#auto_<?echo $veicolo['id']?>" role="button" data-slide="prev">
                                                <span class="fa m-control-left" aria-hidden="true" ></span>
                                                <span class="sr-only">Previous</span>
                                              </a>

                                              <a class="right carousel-control" href="#auto_<?echo $veicolo['id']?>" role="button" data-slide="next">
                                                <span class="fa m-control-right" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                              </a>

                                            </div>

                                        <!--
                                        <section class="b-modal">
                                            <div class="modal fade" id="myModal<?echo $veicolo['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel<?echo $veicolo['id']?>"><?echo $veicolo['make'].''.$veicolo['model']?> <?echo $veicolo['version']?></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="<?echo costanti::IMG_PERCORSO_BASE.costanti::IMG_PERCORSO_ORIGINALE.$veicolo['img']?>" alt='auto01' class="img-responsive"/>
                                                        </div>
                                                    <script type="text/javascript">		
                                                    	//$(document).ready(function(){ $('#features').jshowoff({ speed:1000, links: false, controls: true }); });
                                                        $(document).ready(function(){ $('#auto_<?echo $veicolo['id']?>').jshowoff({ 
                                    					cssClass: 'thumbFeatures',
                                    					effect: 'fade'
                                    				}); });
                                                    </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>

                                        <a data-toggle="modal" data-target="#myModal<?echo $veicolo['id']?>" href="#" class="b-items__cars-one-img-video"><span class="fa fa-search fa-2x"></span></a>

                                        <!--b-modal-->

                                    </div>

                                    <div class="col-lg-4 col-sm-12 col-xs-12 mt-elenco-auto">

                                        <header class="b-items__cars-one-info-header s-lineTopLeft s-lineDownLeft mb-elenco-auto"><span><?echo number_format($veicolo['prezzo'],0,',','.')?> €</span></header>

                                        <div class="b-items__cars-one-info">

                                            <p class="icon-carinfo km mb-sm larg50"><?echo number_format($veicolo['km'],0,',','.')?> Km</p>
                                            <p class="icon-carinfo data mb-sm larg50"><?echo estraiDataAuto($veicolo['registration_date'])?></p>
                                            <p class="icon-carinfo alimentazione mb-sm larg50"><?echo $veicolo['alimentazione']?></p>
                                            <? $cavalli = $veicolo['kwatt']*1000/735.49875 ?>
                                            <p class="icon-carinfo potenza mb-sm larg50"><?echo $veicolo['kwatt']?> KW / <?echo round($cavalli,0)?> CV</p>
                                            <p class="icon-carinfo cambio mb-sm hidd larg50"><?echo $veicolo['gearbox']?></p>
                                            <p class="icon-carinfo colore mb-sm hidd larg50"><?echo $veicolo['colore']?></p>
                                            <p class="icon-carinfo interni mb-none hidd larg50"><?echo $veicolo['interni']?></p>

                                        </div>
                                        
                                        <footer class="b-items__aside-main-footer" style="margin-top: 15px;">	
												<button type="submit" onclick="window.location='<?echo $path?>'" class="btn m-btn m-btm-azzurro  mt-none mb-md" style="width: 100%;">DETTAGLIO <span class="fa fa-plus" style="margin-left: 0px;"></span> </button>
											</footer>

                                    </div>
                                </div>
                            </div>


                            <?
                          }
                            ?>

                        <div class="pagina" id="2"></div>   
                        </div><!-- //elenco auto -->
                        <?
                        
                        
                        
                        ?>
                        <div class="ajax-load text-center" style="display:none">

                            <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
                        
                        </div>
                    </div>

                    <br /><br />

					</div>
				</div>
			</div>
		</section><!--b-items-->

    <?

}

function HeaderAggiuntivi()

{
    ?>
    <?
}

function scriptFooterAggiuntivi()

{global $modello, $pagina;

    ?>

   <!-- <script src="../js/infscroll.js"></script> 
   <script src="../js/jquery.jscroll.js"></script>-->
       <script type="text/javascript">
            $(window).scroll(function() {
                if($(window).scrollTop() + $(window).height() >= $(document).height()) {
                    var last_id = $(".pagina:last").attr("id");
                    alert (last_id);
                    loadMoreData(last_id);
                    
                }
            });
            function loadMoreData(last_id){
              $.ajax(
                    {
                        url: 'ricerca2-ajax.php?pagina='+last_id,
                        type: "get",
                        beforeSend: function()
                        {
                            $('.ajax-load').show();
                        }
                    })
                    .done(function(data)
                    {
                        $('.ajax-load').hide();
                        $("#elencoauto").append(data);
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError)
                    {
                          alert('server not responding...');
                    });
            }
        
     
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

        $(document).ready(function() {
            
            /*
            $('.scroll').jscroll({
                autoTriggerUntil: 3
            });
            */

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
                        },
                        error: function()
                        {
                        alert("Chiamata fallita, si prega di riprovare..."); //sempre meglio impostare una callback in caso di fallimento
                        }
                    });

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
                        },
                        error: function()
                        {
                        alert("Chiamata fallita, si prega di riprovare..."); //sempre meglio impostare una callback in caso di fallimento
                        }
                    });
                 });   

         

         

         $(window).bind('load', function() {

            if ($(this).width() < 767) {

                $('#refine-search').removeClass('in');
                $('#refine-search').addClass('out');
                $('#refine').addClass('show');

             } else {

                $('#refine-search').removeClass('out');
                $('#refine-search').addClass('in');
                $('#refine').addClass('hidden');

            }

        });

         
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

    <?

}

?>

