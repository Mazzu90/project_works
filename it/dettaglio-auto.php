
+<?

if (!(isset($lInclude)&&($lInclude)))
{
    include('include_dir.php');
    include($percorsoLingua.'include/include.php');
    
    $grafica=new Tgrafica(false,false);
    //$idVeicolo = isset($_GET['id'])?$_GET['id']:0;
    
}
$idVeicolo = isset($_GET['id'])?$_GET['id']:-1;
if (
        (costantiP::URL_REWRITE_ATTIVO) /*verifico che nel file /it/include_cliente/const_cliente la costante URL_REWRITE_ATTIVO sia a true e quindi l'url rewrite sia attivo*/
        &&
        /*verifico che la variabile di controllo di provenienza dalla pagina seo_gatewqay esista; se esiste vuol dire che arrivo dalla seo gateway, in caso contrario*/
        (
            (!isset($lUrlRewrite))   
            ||
            /*verifico che sia anche valorizzata a true*/
            (!$lUrlRewrite)
        )
    )
{
    
    /*
    questo controllo serve per verificare che la pagina contenuto venga chiamata solo dalla pagina seo_gateway;
    se si tutto ok, se no devo redirigere l'utente all'url riscritto corretto.
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
                    where veicoli.id = '.$idVeicolo;
    $rs = mysql_query($sql);
    if (mysql_num_rows($rs)>0)
    {
        $row=mysql_fetch_array($rs);
        $titoloCategoria=normalizzaTesto($row['titoloCategoria']);
        $titoloContenuto=normalizzaTesto($row['modelloContenuto']).'-'.normalizzaTesto($row['versioneContenuto']);
        $titoloMarca=normalizzaTesto($row['marcaContenuto']);
        //$url = costantiP::BASE_URL.costantiP::LINGUA.'/'.$titoloCategoria.'/'.$titoloContenuto.'_'.$idVeicolo.'.htm';
        $url = costantiP::BASE_URL.costantiP::LINGUA.'/'.$titoloMarca.'/'.$titoloContenuto.'_'.$id.'.htm';
        header ('HTTP/1.1 301 Moved Permanently');
        header('location: '.$url);
    }
}


$sql = 'select 
                    veicoli.*,
                    categorie.titolo_categoria as nomeCategoria
                    from 
                        veicoli 
                    inner join 
                        categorie 
                    on categorie.id = veicoli.id_categoria
                    where 
                        veicoli.id = '.$idVeicolo;

if (!getRecord($sql,$row))
        {
            //header('location: 404.php');
        }
        
$id_ga = $row['id_ga'] ;      

$grafica->titolo=$row['titolo_veicolo'].' usata - Brescia - AUTOUNICA srl';
$grafica->description=$row['titolo_veicolo'].' '.$row['version'].' usata in offerta - comprala da AUTOUNICA srl';
$grafica->keywords=$row['nomeCategoria'].', '.$row['titolo_veicolo'].', '.$row['version'].', auto usate, veicoli usati, vendita auto usate Brescia';

$grafica->codicePagina=costantiP::CP_TUTTELEAUTO;
$grafica->codiceBody='page1';









$grafica->paint();
unset($grafica);

function corpo_pagina()
{global $idVeicolo;


$sql = 'select 
                    veicoli.*
                    from 
                        veicoli 
                   where 
                        veicoli.id = '.$idVeicolo;


if (!getRecord($sql,$row))
        {
            echo 'qualcosa non va';
        }


      
  $immaginiVeicolo = array();
                                    
                                        $sql = 'select immagini.* from immagini where immagini.id_veicolo = '.$idVeicolo;
                                        $result=mysql_query($sql);
                                        
                                           while ($rowImmagini=mysql_fetch_assoc($result)) {
                                                    $immagineVeicolo['id']=$rowImmagini['id'];
                                                    $immagineVeicolo['img']=$rowImmagini['img'];
                                                    $immagineVeicolo['imgHd']=$rowImmagini['img_hd'];
                                                    $immagineVeicolo['imgBig']=$rowImmagini['img_big'];
                                                    $immagineVeicolo['titolo']=$rowImmagini['titolo'];
                                                    $immaginiVeicolo[]=$immagineVeicolo; 
                                                }
                                            
                           
                                 
                      $numeroImmmagini= count($immaginiVeicolo);  
                      

              if (costantiP::URL_REWRITE_ATTIVO)
                        {
                            $path = costantiP::BASE_URL.costantiP::LINGUA.'/'.normalizzaTesto($row['make']).'/'.normalizzaTesto($row['model']).'-'.normalizzaTesto($row['version']).'_'.$row['id'].'.htm';
                            $pathGalleria= costantiP::BASE_URL.costantiP::LINGUA.'/galleria/'.normalizzaTesto($row['make']).'/'.normalizzaTesto($row['model']).'-'.normalizzaTesto($row['version']).'_'.$row['id'].'.htm';
                            $pathStampa = costantiP::BASE_URL.costantiP::LINGUA.'/print/'.normalizzaTesto($row['make']).'/'.normalizzaTesto($row['model']).'-'.normalizzaTesto($row['version']).'_'.$row['id'].'.htm';
                        }
                        else
                        {
                            $path = costantiP::BASE_URL.costantiP::LINGUA.'/dettaglio-auto.php?id='.$row['id'];   
                            $pathGalleria = costantiP::BASE_URL.costantiP::LINGUA.'/galleria-auto.php?id='.$row['id'];       
                            $pathStampa = costantiP::BASE_URL.costantiP::LINGUA.'/print.php?id='.$row['id'];                                            
                        }
                        
                  
                              
        
    ?>	
   
    	<section class="b-detail__main pb-none">
        	<div class="container">
                <div class="row">
                
                	<div class="col-xs-12 mb-xl pb-xl b-bottom">
						<div class="close-sheet">
                   			<a href="javascript:history.back()"><span>CHIUDI</span><img src="<?echo costantiP::BASE_URL?>images/icon-closesheet.png" style="margin-bottom:5px;" /></a>
						</div>
						
                   		<div class="print">
                   			<a href="<?echo $pathStampa?>" target="_blank"><img src="<?echo costantiP::BASE_URL?>images/icon-stampa.png" style="margin-bottom:5px;" /><span>STAMPA</span></a>
						</div>
						
                    </div>
                
                    <div class="col-md-8 col-xs-12">
                    	<h3 class="mb-none mt-none"><?echo  $row['make'].' '.$row['model']?></h3>
                        <h4 class="mt-none mb-none"><?echo $row['version']?></h4>
						<div class="plate"><span>TARGA:</span> <?echo $row['plate']?></div>
                    </div>
                    
                    <div class="col-md-4 col-xs-12">
						<div class="b-items__cars-one-info-header mb-xl"><span><sup>€</sup><?echo number_format($row['prezzo'],0,',','.')?></span></div>
                    </div>
                    
                	<div class="col-md-8 col-xs-12 ">
						<div class="realtaAutounica_detail"></div>  
                     	<a class="example-image-link" href="<?echo $immaginiVeicolo[0]['imgHd']?>" data-lightbox="example-set" data-title="<?echo $immaginiVeicolo[0]['titolo']?>">
                           <?
                                           $etichetta = false;
                                           
                                           switch ($row['alimentazione']) {
                                                                case 2:
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
                                                                case 1:
                                                                    $venduta = '';
                                                                    $imgOverlay = 'benzina200';
                                                                    $etichetta = true;
                                                                    break;
                                                            }
                                           
                                            
                                            if($row['neopatentati']==1)
                                                                {   
                                                                    $venduta = '';
                                                                    $imgOverlay = 'neopatentati200';
                                                                    $etichetta = true;
                                                                }
                                            
                                            if ($row['telaio']!='')
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
                                                <span class="<?echo $venduta?>"></span>
                                                <span class="etichettaCorner ml-md">
                                                <img src="../../images/<?echo $imgOverlay?>.png" class="img-responsive"/>
                                                </span>
                                                <?
                                             }
                                            ?>    
                                              
                         <img class="example-image img-responsive" src="<?echo $immaginiVeicolo[0]['imgBig']?>"  alt="<?echo $immaginiVeicolo[0]['titolo']?>" />
                     </a>
                    </div>
                    
                    <div class="col-md-4 col-xs-12 pr-xs pl-xs"> 
                        
                        <div class="col-xs-12  pl-none">
                            
                            <div class="b-items__cars-one-info2 visibile">
                                <p class="icon-carinfo2 km mb-xl"><?echo number_format($row['km'],0,',','.')?> Km</p>
                                <p class="icon-carinfo2 data mb-xl"><?echo estraiDataAuto($row['registration_date'])?></p>
                                <p class="icon-carinfo2 alimentazione mb-xl"><?echo fuelDecode($row['alimentazione'])?></p>
                                <? $cavalli = $row['kwatt']*1000/735.49875 ?>
                                <p class="icon-carinfo2 potenza mb-xl"><?echo $row['kwatt']?> KW / <?echo round($cavalli,0)?> CV</p>
                                <p class="icon-carinfo2 cambio mb-xl"><?echo $row['gearbox']?></p>
                                <p class="icon-carinfo2 colore mb-xl"><?echo $row['colore']?></p>
                                <p class="icon-carinfo2 interni"><?echo $row['interni']?></p>
                            </div>
                    
                        </div>  
                
                    </div>    
                </div> 
                   
                <div class="row mt-xl">
                    <div class="col-xs-12">       
                        <div class="b-detail__main-info-text">
                            <div class="b-detail__main-aside-about-form-links car_detail">
                               	<a href="#" class="j-tab m-active car_detail" data-to='#info1'><p>DESCRIZIONE</p></a>
                                <a href="#" class="j-tab car_detail" data-to='#info2'><p>ACCESSORI</p></a>
								<a href="#" class="j-tab car_detail" data-to='#info3'><p>DETTAGLI</p></a>
								<a href="<?echo $pathGalleria?>" class="photo"><img src="<?echo costantiP::BASE_URL?>images/icon-foto.svg"><p><span><?echo $numeroImmmagini?></span> FOTO</p>
								</a>
                            </div>
                            
                            <div id="info1" class="tab_dettagli_auto">
								<p class="desc"><?echo $row['additional_informations']?></p>
							</div>
                           
                            <div id="info2" class="tab_dettagli_auto">
                                <?$accessori = array();
                                    
                                        $sql = 'select optional.* from optional where optional.id_veicolo = '.$idVeicolo.' order by titolo asc';
                                        $result=mysql_query($sql);
                                        
                                           while ($rowOptional=mysql_fetch_assoc($result)) {
                                                    $optionalVeicolo['id']=$rowOptional['id'];
                                                    $optionalVeicolo['titolo']=$rowOptional['titolo'];
                                                    $accessori[]=$optionalVeicolo; 
                                                }
                                                
                                     $i=-1;
                                                 foreach ($accessori as $acc) {
                                                    $i++;
                                                    ?>
                                                            
         											<div class="optional"><?echo $acc['titolo']?> </div>
                                                            <?
                                                            }
                                               
                                                
                                ?> 
                            </div>
                            
                            <div id="info3" class="tab_dettagli_auto">
                            <p>
                            <div class="optional">
								<span class="dettagliTitolo">Immatricolazione</span>
								<span class="dettaglio"><?echo estraiDataAutoContratta($row['registration_date'])?></span>
							</div>
                            <div class="dettagli">
								<span class="dettagliTitolo">Carrozzeria</span>
                                <span class="dettaglio"><?echo $row['body']?></span>
							</div>
                            <div class="dettagli">
								<span class="dettagliTitolo">Omologazione</span>
                                <span class="dettaglio"><?echo emissionDecode($row['emission_class'])?></span>
							</div>
                            <div class="dettagli">
								<span class="dettagliTitolo">Cilindrata</span>
                                <span class="dettaglio"><?echo ($row['cc'])?> cc</span>
							</div>
                            <div class="dettagli">
								<span class="dettagliTitolo">Posti</span>
                                <span class="dettaglio"><?echo ($row['seats'])?></span>
							</div>
                            <div class="dettagli">
								<span class="dettagliTitolo">Porte</span>
                               	<span class="dettaglio"><?echo ($row['doors'])?></span>
							</div> 
                            <div class="dettagli">
								<span class="dettagliTitolo">Trazione</span>
                                <span class="dettaglio"><?echo ($row['traction'])?></span>
							</div> 
                           <div class="dettagli">
							   	<span class="dettagliTitolo">Emissioni</span>
                                <span class="dettaglio"><?echo ($row['emission_co2'])?> g/km</span>
						   </div>
                           <div class="dettagli">
							   <span class="dettagliTitolo">Consumi</span>
                               <span class="dettaglio">urbano: <?echo ($row['consumo_urbano'])?> l/100km<br />
                               						   extraurbano: <?echo ($row['consumo_extra'])?> l/100km<br />
                               						   misto: <?echo ($row['consumo_misto'])?> l/100km</span>
                         	</div> 
                            </p>
                            </div>
                        </div>
                 	</div>
				 </div>
      	
      			<div class="row">
                    <div class="col-xs-12 mt-md">
						<!--<video width="100%" controls>
							<source src="../../video/video-homepage.mp4" type="video/mp4" />
							<source src="../../video/video-homepage.webm" type="video/webm" />
							Il tuo browser non supporta i tag video. Cambia o aggiorna browser.
						</video>
                        -->
                         <?$video = array();
                                    
                                        $sql = 'select video.* from video where video.id_veicolo = '.$idVeicolo.' order by id asc';
                                        $result=mysql_query($sql);
                                        
                                           while ($rowVideo=mysql_fetch_assoc($result)) {
                                                    $optionalVideo['id']=$rowVideo['id'];
                                                    $optionalVideo['youtube_id']=$rowVideo['youtube_id'];
                                                    $video[]=$optionalVideo; 
                                                }
                                                foreach ($video as $vid) {
                                                    
                                                    ?>
                                                    <iframe width="750" height="500" src="https://www.youtube.com/embed/<?echo $vid['youtube_id']?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                            <?
                                                            }
                                               
                                                
                                ?> 
                        
					</div>
				</div>
       	
       			<div class="row">
       				<div class="col-xs-12 ">
                       
						<h2 class="s-title icon-testdrive">RICHIEDI UN TEST DRIVE / INFORMAZIONI PER LA TUA <span style="color:#90278c;"><?echo  $row['make'].' '.$row['model']?></span></h2>
                        <div class="b-contacts__form mt-md">
							<div id="messaggioResult"></div>
							<form id="contactForm" novalidate class="s-form">
                                <input type="hidden" name="modello" id="modello" value="<?echo  $row['make'].' '.$row['model'].''.$row['version']?>"/>
								<input type="text" placeholder="NOME E COGNOME *" value="" name="name" id="name" />
								<input type="text" placeholder="EMAIL *" value="" name="email" id="email" />
								<input type="text" placeholder="TELEFONO *" value="" name="telefono" id="telefono" />
								<textarea id="message" name="message" placeholder="GENTILE CLIENTE, SPECIFICHI QUI UN GOIRNO ED UN ORA IDEALE PER EFFETTUARE IL SUO TEST DRIVE"></textarea>
                                <div class="col-md-12 col-xs-12 p-none">
									<div class="col-md-7 col-xs-12 p-none">
										<p class="mb-xs">* Campi Obbligatori</p>
										<label class="check_privacy dark m-none"><p>Ho letto l'informativa sulla privacy<br>e acconsento al trattamento dei dati.</p>
										   <input type="checkbox"name="privacy" value="privacy">
										  <span class="checkmark"></span>
										</label>
									</div>
									<div class="col-md-5 col-xs-12 p-none">
										 <button type="submit" class="btn m-btn gradient f-right mt-sm mb-md">INVIA</button>
									</div>
								</div>
								 
							</form>
						</div>    
                        
                 	</div>
				</div>
			</div>
        </section>

		<section class="b-featured">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 mb-lg">
						<h2 class="title">TI POTREBBE INTERESSARE ANCHE</h2>
					</div>
                    
                    <?
                    $citycar = '';
                    if (($row['weight'] <= 1400) && ($row['cc'] <= 1600))
                        $citycar==1;
            
                    $elencoAutoSimili = estraiVeicoliSuggeriti($row['id'],$row['prezzo'], $row['prezzo'], $row['body'], $row['gearbox'], $row['alimentazione'], $citycar, $row['neopatentati'], '0', '3', '3','','', $debug='0');
                    stampaVeicoliSimili($elencoAutoSimili);        
                    
                    ?>
					
					
				</div>
			</div>	
		</section>



    			
			<section class="b-featured light_blue">
				<div class="container">
					<div class="col-md-6 col-xs-12">
						<img src="../../images/icon-tipiaceauto.png" class="img-responsive"/>
					</div>
					<div class="col-md-6 col-xs-12">
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

						<div class="col-md-6 col-xs-12">
							<input type="text" placeholder="NOME E COGNOME *" value="" name="name" id="name"  required="required"/>
						</div>

						<div class="col-md-6 col-xs-12">
							<input type="text" placeholder="TELEFONO *" value="" name="telefono" id="telefono"/>

							<div class="col-md-12 col-xs-12 p-none">
								<div class="col-md-7 col-xs-12 p-none">
									<p class="mb-xs" style="color: #FFF;">* Campi Obbligatori</p>
									<label class="check_privacy lightblue"><p>Ho letto l'informativa sulla privacy<br>e acconsento al trattamento dei dati.</p>
									   <input type="checkbox"name="privacy" value="privacy">
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
    
    /*boxFondoPagina();*/
}

function HeaderAggiuntivi()
{
    ?>
        <link href="<?echo costantiP::BASE_URL?>css/print.css" media="print" rel="stylesheet">
  
    <?
    
}

function scriptFooterAggiuntivi()
{global $idVeicolo, $id_ga;

    ?>
        


        
        <link rel="stylesheet" href="<?echo costantiP::BASE_URL?>css/lightbox.css" />
        <script type="text/javascript" src="<?echo costantiP::BASE_URL?>js/lightbox.js"></script>
        <script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion_async.js" charset="utf-8"></script>
        <script type="text/javascript" src="<?echo costantiP::BASE_URL?>js/jquery.validate.min.js"></script>
         <script>
            (function($,W,D)
            {
                var JQUERY4U = {};
            
                JQUERY4U.UTIL =
                {
                    setupFormValidation: function()
                    {
                        //form validation rules
                        $("#contactForm").validate({
                            rules: {
                                name: "required",
                                cognome: "required",
                                email: {
                                    required: true,
                                    email: true
                                },
                                name: {
                                    required: true,
                                    minlength: 3
                                },
                                cognome: {
                                    required: true,
                                    minlength: 3
                                },
                                message: {
                                    required: true,
                                },
                                privacy: {
                                      required: true,
                                    }
            
                            },
                            messages: {
                                name: {
                                    required: "Inserisci il tuo nome",
                                    minlength: "Il nome deve essere di almeno 3 caratteri"
                                },
                                cognome: {
                                    required: "Inserisci il tuo cognome",
                                    minlength: "Il cognome deve essere di almeno 3 caratteri"
                                },
                                message: {
                                    required: "Inserisci il tuo messaggio"
                                },
                                email: "Inserisci una email valida",
                                privacy: "Accetta il trattamento della privacy<br />"
                            },
                             
                            submitHandler: function(form) {
                                //form.submit();
                                 var nome = $("#name").val();
                                 var cognome = $("#cognome").val();
                                 var email = $("#email").val();
                                 var telefono = $("#telefono").val();
                                 var messaggio = $("#message").val();
                                 var modello = $("#modello").val();
                                
                                 
                                
                                        $.ajax({
                                         
                                        type: 'POST',
                                         
                                        url: 'http://www.autounica.com/it/contatti_action.php',
                                         
                                        data: 'nome='+nome+'&cognome='+cognome+'&email='+email+'&telefono='+telefono+'&modello='+modello+'&messaggio='+messaggio,
                                         
                                        cache: false,
                                         
                                        success: function(result){
                                        $("#messaggioResult").html(result);
                                        $("#contactForm").trigger('reset'); //jquery
                                        $("#contactForm").hide; //jquery
                                        }
                                        
                                        });
                                
                                
                                
                            }
                        });
                    }
                }
            
                //when the dom has loaded setup form validation rules
                $(D).ready(function($) {
                    JQUERY4U.UTIL.setupFormValidation();
                });
            
            })(jQuery, window, document);
        
         </script>
         
         <script type="text/javascript">
            var google_tag_params = {
            dynx_itemid: "<?echo $id_ga?>",
            };
            </script>
        
    
    <?
}
        
?>