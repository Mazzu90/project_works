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

$start = $_POST['start'];
$limit2 = $_POST['limit'];
//echo '<hr>'.$start;
//echo $limit2.'<hr />';

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

//$grafica->paint();
//unset($grafica);

//global $prezzo, $carrozzeria, $cambio, $benzina, $diesel, $gpl, $metano, $elettrica, $ibrida, $marca, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina ;
    
$elencoAuto = estraiVeicoli($prezzo, $carrozzeria, $cambio, $benzina, $diesel, $gpl, $metano, $elettrica, $ibrida, $marca, $modello, $neopatentati, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina, $start, $limit2);

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
                                        $path = costantiP::BASE_URL.costantiP::LINGUA.'/'.normalizzaTesto($veicolo['make'].'/'.$veicolo['model'].'-'.$veicolo['version'].'_'.$veicolo['id']).'.htm';
                                    }
                                    else
                                    {
                                        $path = costantiP::BASE_URL.costantiP::LINGUA.'/dettaglio-auto.php?id='.$veicolo['id'];                                                
                                    }
                            ?>
                                
                          <div class="col-lg-12 col-sm-12 col-xs-12 mb-xl pr-none">
                            <div class="b-items__cars-one  " data--delay="0.5s">
                                    <div class="col-lg-8 col-sm-12 col-xs-12">
                                        <h3 class="mb-none"><?echo $veicolo['make'].' '.$veicolo['model']?></h3>
                                        <h4 class="mt-none"><?echo $veicolo['version']?></h4>
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

