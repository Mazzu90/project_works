<?
include('include_dir.php');
include($percorsoLingua.'include/include.php');

session_start();
isset($_SESSION['marca'])?$_SESSION['marca']=$_SESSION['marca']:'';
isset($_SESSION['modello'])?$_SESSION['modello']=$_SESSION['modello']:'';
isset($_SESSION['prezzo'])?$_SESSION['prezzo']=$_SESSION['prezzo']:'';
isset($_SESSION['carrozzeria'])?$_SESSION['carrozzeria']=$_SESSION['carrozzeria']:'';
isset($_SESSION['cambio'])?$_SESSION['cambio']=$_SESSION['cambio']:'';
isset($_SESSION['benzina'])?$_SESSION['benzina']=$_SESSION['benzina']:'';
isset($_SESSION['diesel'])?$_SESSION['diesel']=$_SESSION['diesel']:'';
isset($_SESSION['gpl'])?$_SESSION['gpl']=$_SESSION['gpl']:'';
isset($_SESSION['metano'])?$_SESSION['metano']=$_SESSION['metano']:'';
isset($_SESSION['elettrica'])?$_SESSION['elettrica']=$_SESSION['elettrica']:'';
isset($_SESSION['ibrida'])?$_SESSION['ibrida']=$_SESSION['ibrida']:'';

$grafica=new Tgrafica(false,false);
$pagina = isset($_GET['pagina'])?$_GET['pagina']:1;
$nContenutiDaEstrarre = 0;
$numeroRecordPerPagina = 10; 

//$start = $_POST['start'];
//$limit2 = $_POST['limit'];
//echo '<hr>'.$start;
//echo $limit2.'<hr />';
$start = isset($_GET['start'])?$_GET['start']:'';
$limit2 = isset($_GET['limit'])?$_GET['limit']:'';

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
//$grafica->paint();
//unset($grafica);

//global $prezzo, $carrozzeria, $cambio, $benzina, $diesel, $gpl, $metano, $elettrica, $ibrida, $marca, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina ;
//$elencoAuto = estraiVeicoli2($prezzo, $carrozzeria, $cambio, $benzina, $diesel, $gpl, $metano, $elettrica, $ibrida, $marca, $modello, $neopatentati, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina, $start, $limit2);

//estraiVeicoli2($prezzo, $carrozzeria, $cambio, $benzina, $diesel, $gpl, $metano, $elettrica, $ibrida, $marca, $modello, $neopatentati, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina, $start, $limit2);
list($elencoAuto, $nRecord) = estraiVeicoli2($prezzo, $prezzoDa, $prezzoA, $carrozzeria, $cambio, $benzina, $diesel, $gpl, $metano, $elettrica, $ibrida, $marca, $modello, $neopatentati, $citycar, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina, $start,$limit2);
 

    /*
    echo $prezzo.'<br />';
    echo $carrozzeria.'<br />';
    echo $cambio.'<br />';
    echo $benzina.'<br />';
    echo $diesel.'<br />';
    echo $gpl.'<br />';
    echo $metano.'<br />';
    echo $elettrica.'<br />';
    echo $ibrida.'<br />'; 
    echo $marca.' parametro<br />';
    echo $_SESSION['marca'].' session<br />';
   */
    ?>

                        <?
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
                                
                          <div class="col-lg-12 col-sm-12 col-xs-12 mb-xl pr-none post-id" id="<?echo $veicolo['id']?>">
                            <div class="b-items__cars-one  " data--delay="0.5s">
                                    <div class="col-lg-8 col-sm-12 col-xs-12">
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

                                                               case 20000000:
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
                                                                case 1000000000:
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
                                                
                                             if ($etichetta)
                                             {
                                                ?>
                                                <!--  linguetta in overlay -->
                                                 <a  href="<?echo $path?>" class="<?echo $venduta?>">
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
                                                                $immagineVeicolo['titolo']=$rowImmagini['titolo'];
                                                                $immagineVeicolo['imgBig']=$rowImmagini['img_big'];
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
                                            </div><!--

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
                                                <a class="details" href="<?echo $path?>">DETTAGLIO <span class="icon-plus"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                           
                            <?                           
                          }                           
                            
                          ?>
                        <div class="pagina" id="<?php echo $pagina+1 ?>"></div> 
                        