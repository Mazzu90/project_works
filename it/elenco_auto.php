<?
include('include_dir.php');
include($percorsoLingua.'include/include.php');
session_start();

if(isset($_GET['r']) && $_GET['r']==1)
{
    $_SESSION = array(); //se arriva il parametro di reset, distruggo le sessioni e resetto
}
if(isset($_POST))
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
    $_SESSION['modello']='';
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
$grafica->titolo='';
$grafica->keywords='';
$grafica->description='';
$grafica->codicePagina=costantiP::CP_TUTTELEAUTO;
$grafica->codiceBody='page1';

$pagina = isset($_GET['pagina'])?$_GET['pagina']:1;
$nContenutiDaEstrarre = 0;
$numeroRecordPerPagina = 10; 


//se ho ricevuto qualcosa in post imposto la sessione con quel valore e la relativa variabile che userò per la query
isset($_POST['prezzo'])?$_SESSION['prezzo'] = $_POST['prezzo']:$_SESSION['prezzo']=$_SESSION['prezzo'];
isset($_POST['prezzo'])?$prezzo=$_POST['prezzo']:$prezzo=$_SESSION['prezzo'];

isset($_POST['carrozzeria'])?$_SESSION['carrozzeria'] = $_POST['carrozzeria']:$_SESSION['carrozzeria']=$_SESSION['carrozzeria'];
isset($_POST['carrozzeria'])?$carrozzeria=$_POST['carrozzeria']:$carrozzeria=$_SESSION['carrozzeria'];

isset($_POST['cambio'])?$_SESSION['cambio'] = $_POST['cambio']:$_SESSION['cambio']=$_SESSION['cambio'];
isset($_POST['cambio'])?$cambio=$_POST['cambio']:$cambio=$_SESSION['cambio'];

isset($_POST['benzina'])?$_SESSION['benzina'] = $_POST['benzina']:$_SESSION['benzina']=$_SESSION['benzina'];
isset($_POST['benzina'])?$benzina=$_POST['benzina']:$benzina=$_SESSION['benzina'];

isset($_POST['diesel'])?$_SESSION['diesel'] = $_POST['diesel']:$_SESSION['diesel']=$_SESSION['diesel'];
isset($_POST['diesel'])?$diesel=$_POST['diesel']:$diesel=$_SESSION['diesel'];

isset($_POST['gpl'])?$_SESSION['gpl'] = $_POST['gpl']:$_SESSION['gpl']=$_SESSION['gpl'];
isset($_POST['gpl'])?$gpl=$_POST['gpl']:$gpl=$_SESSION['gpl'];

isset($_POST['metano'])?$_SESSION['metano'] = $_POST['metano']:$_SESSION['metano']=$_SESSION['metano'];
isset($_POST['metano'])?$metano=$_POST['metano']:$metano=$_SESSION['metano'];

isset($_POST['elettrica'])?$_SESSION['elettrica'] = $_POST['elettrica']:$_SESSION['elettrica']=$_SESSION['elettrica'];
isset($_POST['elettrica'])?$elettrica=$_POST['elettrica']:$elettrica=$_SESSION['elettrica'];

isset($_POST['ibrida'])?$_SESSION['ibrida'] = $_POST['ibrida']:$_SESSION['ibrida']=$_SESSION['ibrida'];
isset($_POST['ibrida'])?$ibrida=$_POST['ibrida']:$ibrida=$_SESSION['ibrida'];

isset($_POST['marca'])?$_SESSION['marca'] = $_POST['marca']:$_SESSION['marca']=$_SESSION['marca'];
isset($_POST['marca'])?$marca=$_POST['marca']:$marca=$_SESSION['marca'];

isset($_POST['modello'])?$_SESSION['modello'] = $_POST['modello']:$_SESSION['modello']=$_SESSION['modello'];
isset($_POST['modello'])?$modello=$_POST['modello']:$modello=$_SESSION['modello'];

isset($_POST['neopatentati'])?$_SESSION['neopatentati'] = $_POST['neopatentati']:$_SESSION['neopatentati']=$_SESSION['neopatentati'];
isset($_POST['neopatentati'])?$neopatentati=$_POST['neopatentati']:$neopatentati=$_SESSION['neopatentati'];

$grafica->paint();
unset($grafica);

function corpo_pagina()
{global $prezzo, $carrozzeria, $cambio, $benzina, $diesel, $gpl, $metano, $elettrica, $ibrida, $marca, $modello, $neopatentati, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina ;
    
        $checkedPrezzo1='';
        $checkedPrezzo2='';
        $checkedPrezzo3='';
        $checkedPrezzo4='';
    //preparo i bottoni attivi o meno  
       if ($prezzo>0)
    {
        
        
        switch ($prezzo) {
            case 1:
                $checkedPrezzo1='checked="checked"';
                break;
            case 2:
                $checkedPrezzo2='checked="checked"';
                break;
            case 3:
                $checkedPrezzo3='checked="checked"';
                break;
            case 4:
                $checkedPrezzo4='checked="checked"';
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

		<section class="b-items b-search s-shadow">
			<div class="container">
				<div class="row b-bottom">
                	
                    <div class="b-search__main-type col-lg-4 col-sm-5 col-xs-12 pl-none">
                    	<div class="col-lg-12 col-sm-12 col-xs-12">
                     
                            <aside class="b-items__aside">
                               <div id="posizione">
                                <h2 class="s-title">TROVA LA TUA AUTO</h2>
                                <div class="b-items__aside-main">
                                    <form class="b-search__main" action="elenco_auto.php" method="POST">
                                        <div class="b-items__aside-main-body">
                                            <div class="b-items__aside-main-body-item">
                                                <label>FASCIA DI PREZZO</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-12 pl-none pr-xs">
                                                    <input id="type1" type="radio" name="prezzo" value="1" <?echo $checkedPrezzo1?> />
                                                    <label for="type1" class="b-search__main-type-svg"></label>
                                                    <h5><label for="type1">fino a 5.000 €</label></h5>
                                                </div>
                                                <div class="col-lg-6 col-sm-6 col-xs-12 pl-xs pr-none">
                                                	<input id="type2" type="radio" name="prezzo" value="2" <?echo $checkedPrezzo2?>/>
                                                    <label for="type2" class="b-search__main-type-svg"></label>
                                                    <h5><label for="type2">da 5.000 € a 10.000 €</label></h5>
                                                </div>
                                                <div class="col-lg-6 col-sm-6 col-xs-12 pl-none pr-xs">
                                                	<input id="type3" type="radio" name="prezzo" value="3" <?echo $checkedPrezzo3?>/>
                                                    <label for="type3" class="b-search__main-type-svg"></label>
                                                    <h5><label for="type3">da 10.000 € a 15.000 €</label></h5>
                                                </div>
                                                <div class="col-lg-6 col-sm-6 col-xs-12 pl-xs pr-none">
                                                	<input id="type4" type="radio" name="prezzo" value="4" <?echo $checkedPrezzo4?>/>
                                                    <label for="type4" class="b-search__main-type-svg"></label>
                                                    <h5><label for="type4">oltre i 15.000 €</label></h5>
                                                </div>        
                                            </div>
                                            
                                            <br clear="all"><br>
                                            
                                            <div class="b-items__aside-main-body-item">
                                                <label>MARCA</label>
                                                <div>
                                                    <select name="marca" class="m-select filter" id="marca">
                                                
                                              <?
                                                      $query = 'select distinct
                                                                    veicoli.make from 
                                                                        veicoli 
                                                                    where
                                                                        veicoli.pubblicato = 1 
                                                                    order by 
                                                                        veicoli.make asc';
                                                        
                                                        $result=mysql_query($query);
                                                        
                                                        $selectedMake = '';
                                                            if ($marca == '')
                                                                {
                                                                    $selectedMake = 'selected="selected"';
                                                                }
                                                            echo '<option value="" '.$selectedMake.'>Tutto</option>';
                                                       	
                                                        while ($row=mysql_fetch_assoc($result)) {
                                                            if ($marca == $row['make'])
                                                                    {
                                                                        $selectedMake = 'selected="selected"';
                                                                    }
                                                                    else
                                                                    {
                                                                        $selectedMake = '';
                                                                    }
                                                            
                                                            echo '<option value="'.$row['make'].'" '.$selectedMake.'>'.$row['make'].'</option>';
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
                                                <div class="col-lg-6 col-sm-6 col-xs-12 pl-none pr-none">
                                                    <div class="col-lg-6 col-sm-6 col-xs-12 pl-none">
                                                        <input id="type5" type="radio" name="cambio" value="1" <?echo $checkedCambio1?>/>
                                                        <label for="type5" class="b-search__main-type-svg"></label>
                                                        <h5><label for="type5">A</label></h5>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-12 pl-none">
                                                        <input id="type6" type="radio" name="cambio" value="2" <?echo $checkedCambio2?> />
                                                        <label for="type6" class="b-search__main-type-svg"></label>
                                                        <h5><label for="type6">M</label></h5>
                                                    </div>	
                                                </div>
                                            </div>
                                            
                                            <br clear="all"><br>
                                           
                                             <div class="b-items__aside-main-body-item">
                                                <label>ALIMENTAZIONE</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-12 pl-none pr-none">
                                                    <div class="col-lg-6 col-sm-6 col-xs-12 pl-none">
                                                        <input id="type7" type="checkbox" name="benzina" value="true" <?echo $checkedBenzina?> />
                                                        <label for="type7" class="b-search__main-type-svg"></label>
                                                        <h5><label for="type7">BENZINA</label></h5>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-12 pl-none">
                                                        <input id="type8" type="checkbox" name="diesel" value="true" <?echo $checkedDiesel?> />
                                                        <label for="type8" class="b-search__main-type-svg"></label>
                                                        <h5><label for="type8">DIESEL</label></h5>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-6 col-xs-12 pl-none pr-none">
                                                    <div class="col-lg-6 col-sm-6 col-xs-12 pl-none">
                                                        <input id="type9" type="checkbox" name="gpl" value="true" <?echo $checkedGpl?> />
                                                        <label for="type9" class="b-search__main-type-svg"></label>
                                                        <h5><label for="type9">GPL</label></h5>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-12 pl-none pr-none">
                                                        <input id="type10" type="checkbox" name="metano" value="true" <?echo $checkeMetano?> />
                                                        <label for="type10" class="b-search__main-type-svg"></label>
                                                        <h5><label for="type10">METANO</label></h5>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-6 col-xs-12 pl-none pr-none">
                                                    <div class="col-lg-6 col-sm-6 col-xs-12 pl-none">
                                                        <input id="type11" type="checkbox" name="elettrica" value="true" <?echo $checkedElettrica?> />
                                                        <label for="type11" class="b-search__main-type-svg"></label>
                                                        <h5><label for="type11">ELETTR.</label></h5>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-12 pl-none">
                                                        <input id="type12" type="checkbox" name="ibrida" value="true" <?echo $checkedIbrida?> />
                                                        <label for="type12" class="b-search__main-type-svg"></label>
                                                        <h5><label for="type12">IBRIDA</label></h5>
                                                    </div>		
                                                </div>
                                            </div>
                                            
                                            
                                            
                                        </div>
                                        
                                         <br clear="all"><br>
                                        <footer class="b-items__aside-main-footer">
                                            <a class="f-left mt-sm reset" href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/elenco_auto.php?r=1"><span class="icon-aperta-quadra"></span>RESET FILTRI<span class="icon-chiusa-quadra"></span></a>
                                            
                                            <button type="submit" class="btn m-btn f-right mt-none mb-md">CERCA</button><br />
                                            </form>
                                            
                                            <form class="b-search__main" action="elenco_auto.php" method="POST">
                                                <input type="hidden" id="neopantentati" name="neopatentati" value="1" />
                                                <button type="submit" class="btn m-btn m-btm-gradient2 f-right mt-md">AUTO X NEOPATENTATI</button>
                                            </form><br />
                                        </footer>
                                    </div>
                                </div><!-- /posizione-->
                            </aside>
                            
                        </div>
                    </div>
                    
                    <div class="col-lg-8 col-sm-7 col-xs-12 pr-none">
                    <? define('FIRST', 0);
                        define('LIMIT', 10);?>
                        <input type="hidden" id="first" value="<?php echo FIRST+10; ?>" />
                        <input type="hidden" id="limit" value="<?php echo LIMIT; ?>" />

                        <div id="elencoauto">
                          <?
                          $elencoAuto = estraiVeicoli($prezzo, $carrozzeria, $cambio, $benzina, $diesel, $gpl, $metano, $elettrica, $ibrida, $marca, $modello, $neopatentati, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina, FIRST,LIMIT);
                          if (!$elencoAuto || $elencoAuto =='')
                            echo 'Nessun annuncio disponibile per i criteri di ricerca selezionati.';  
                          foreach ($elencoAuto as $veicolo) {
                          
                            if (costantiP::URL_REWRITE_ATTIVO)
                                    {
                                        $path = costantiP::BASE_URL.costantiP::LINGUA.'/'.normalizzaTesto($veicolo['make'].'/'.$veicolo['model'].'-'.$veicolo['version'].'_'.$veicolo['id']).'.htm';
                                    }
                                    else
                                    {
                                        $path = costantiP::BASE_URL.costantiP::LINGUA.'/dettaglio-auto.php?id='.$veicolo['id'];                                                
                                    }
                                                                     ?>
                                                
                          
                          
                            
                          
                          
                                
                          <div class="col-lg-12 col-sm-12 col-xs-12 mb-xl pr-none">
                            <div class="b-items__cars-one  " data--delay="0.5s">
                                    <div class="col-lg-8 col-sm-12 col-xs-12"  >
                                        <h3 class="mb-none"><?echo $veicolo['make'].' '.$veicolo['model']?></h3>
                                        <h4 class="mt-none" style="overflow: hidden;"><nobr><?echo $veicolo['version']?></nobr></h4>
                                        <div id="auto_<?echo $veicolo['id']?>" class="carousel slide"  data-ride="carousel" data-interval="false" >
              
            
                                              <!-- Wrapper for slides -->
                                              <div class="carousel-inner" role="listbox" >
                                                <div class="item active">
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
                                            <p class="icon-carinfo km mb-sm"><?echo number_format($veicolo['km'],0,',','.')?> Km</p>
                                            <p class="icon-carinfo data mb-sm"><?echo estraiDataAuto($veicolo['registration_date'])?></p>
                                            <p class="icon-carinfo alimentazione mb-sm"><?echo $veicolo['alimentazione']?></p>
                                            <? $cavalli = $veicolo['kwatt']*1000/735.49875 ?>
                                            <p class="icon-carinfo potenza mb-sm"><?echo $veicolo['kwatt']?> KW / <?echo round($cavalli,0)?> CV</p>
                                            <p class="icon-carinfo cambio mb-sm"><?echo $veicolo['gearbox']?></p>
                                            <p class="icon-carinfo colore mb-sm"><?echo $veicolo['colore']?></p>
                                            <p class="icon-carinfo interni"><?echo $veicolo['interni']?></p>
                                            
                                            <div class="b-items__cars-one-info-details">
                                            <a class="details" href="<?echo $path?>" >DETTAGLIO <span class="icon-plus"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?
                            
                          }
                            
                            ?>
                            <hr />
                            
                        </div>
                        <div id="loader" style="visibility: hidden;">Loading..</div>
                      
                        
                          
                        
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
{
    ?>
   <script src="../js/infscroll.js"></script>
     <script>
        $(document).ready(function() {
         
            $('#marca').change(function() {
         
                //recupero variabile "discriminante"
                var marca = $("#marca").val();
                
                //chiamata ajax
                $.ajax({
         
                type: "POST",
         
                url: "select-modello.php",
         
                data: "marca=" + marca,
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
         
        });//FINE DOM
        </script>
  
    <?
    
}



        
?>
