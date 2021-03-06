<?

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
   
    	<section class="b-detail__main s-shadow">
        	<div class="container">
                <div class="row">
                	<div class="col-md-12 col-xs-12">
                    	<h3 class="mb-none mt-none">Torna all'elenco</h3>
                    </div>
                 </div>
          
                
                <div class="row">
                
                    	<div class="col-md-7 col-xs-12">
                    	<h3 class="mb-none mt-none"><?echo  $row['make'].' '.$row['model']?></h3>
                        <h4 class="mt-none"><?echo $row['version']?></h4>
                    </div>
                    <div class="col-md-5 col-xs-12">
                    	<div class="col-md-6 col-xs-6 p-none">
                        	<header class="s-lineTopLeft s-lineDownLeft pt-xs pb-xs">
                                <!-- <i class="fa fa-print fa-2x ml-sm mr-sm" style="margin-bottom:4px;"></i>-->
                                 <a href="<?echo $pathStampa?>" target="_blank"><img src="<?echo costantiP::BASE_URL?>images/stampa.png" style="margin-bottom:1px;" /><span>STAMPA</span></a>
                            </header>
                        </div>
                    	<div class="col-md-6 col-xs-6 p-none">
                        	<header class="b-items__cars-one-info-header s-lineTopLeft s-lineDownLeft mb-xl"><span><?echo number_format($row['prezzo'],0,',','.')?> €</span></header>
                        </div>
                    </div>
                    
                	<div class="col-md-7 col-xs-12 ">
                  
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
                    <div class="col-md-5 col-xs-12 pr-xs pl-xs"> 
                        <div class="col-md-6 col-xs-12">
                         <?
                         if($numeroImmmagini>1)
                         {
                            ?>
                             <a class="example-image-link  immaginiAdd" href="<?echo $immaginiVeicolo[1]['imgHd']?>" data-lightbox="example-set" data-title="<?echo $immaginiVeicolo[1]['titolo']?>">
                              <img class="example-image img-responsive mb-sm" src="<?echo $immaginiVeicolo[1]['imgBig']?>"  alt="<?echo $immaginiVeicolo[1]['titolo']?>" />
                          </a>
                            <?
                         }
                         ?>
                         
                        
                        
                          <?
                         if($numeroImmmagini>2)
                         {
                            ?>
                            <a class="example-image-link immaginiAdd" href="<?echo $immaginiVeicolo[2]['imgHd']?>" data-lightbox="example-set" data-title="<?echo $immaginiVeicolo[2]['titolo']?>">
                               <img class="example-image img-responsive mb-sm" src="<?echo $immaginiVeicolo[2]['imgBig']?>"  alt="<?echo $immaginiVeicolo[2]['titolo']?>" />
                          </a>
                            <?
                         }
                         ?>
                          
                          <?
                         if($numeroImmmagini>3)
                         {
                            ?>
                            <a class="example-image-link immaginiAdd" href="<?echo $immaginiVeicolo[3]['imgHd']?>" data-lightbox="example-set" data-title="<?echo $immaginiVeicolo[3]['titolo']?>">
                               <img class="example-image img-responsive" src="<?echo $immaginiVeicolo[3]['imgBig']?>"  alt="<?echo $immaginiVeicolo[3]['titolo']?>" />
                          </a>
                            <?
                         }
                         ?>
                          
                          <?$i=0;
                                                 foreach ($immaginiVeicolo as $imgV) {
                                                     if($i<4)
                                                            {
                                                                ?>
                                                                    <!-- BB -->             
                                                                <?
                                                            }
                                                         else
                                                             {
                                                    ?>
                                        <a href="<?echo $imgV['imgHd']?>" data-lightbox="example-set"></a>
                                                            <?
                                                            }
                                                            $i++;
                                                            }
                                                            ?>
                        </div> 
                        <div class="col-md-6 col-xs-12  pl-none">
                            
                            <div class="b-items__cars-one-info visibile">
                                <p class="icon-carinfo km mb-sm"><?echo number_format($row['km'],0,',','.')?> Km</p>
                                <p class="icon-carinfo data mb-sm"><?echo estraiDataAuto($row['registration_date'])?></p>
                                <p class="icon-carinfo alimentazione mb-sm"><?echo fuelDecode($row['alimentazione'])?></p>
                                <? $cavalli = $row['kwatt']*1000/735.49875 ?>
                                <p class="icon-carinfo potenza mb-sm"><?echo $row['kwatt']?> KW / <?echo round($cavalli,0)?> CV</p>
                                <p class="icon-carinfo cambio mb-sm"><?echo $row['gearbox']?></p>
                                <p class="icon-carinfo colore mb-sm"><?echo $row['colore']?></p>
                                <p class="icon-carinfo interni"><?echo $row['interni']?></p>
                                
                                <p class="mb-xs mt-md">TARGA</p>
                                <p class="s-lineTopLeft s-lineDownLeft pt-xs pb-xs"><?echo $row['plate']?></p>
                                <!--<p class="mb-xs mt-md">TELAIO</p>
                                <p class="s-lineTopLeft s-lineDownLeft  pt-xs pb-xs mb-none">xxxxx</p>-->
                            </div>
                    
                        </div>  
                
                    </div>    
                </div>      
                <div class="row pr-xs pl-sm mt-md" id="visualizzaGallery">
                	<div class="col-md-7 col-xs-12 pr-md pl-xs">
                        	<header class="s-lineTopLeft s-lineDownLeft pr-xs pl-xs">
                                <h2 class="s-title mb-xs mt-xs" ><a href="<?echo $pathGalleria?>" class="blu">VISUALIZZA ALTRE <?echo $numeroImmmagini?> FOTOGRAFIE</h2>
                                <span style="float: right;"><img src="<?echo costantiP::BASE_URL?>images/gallery.png" style="margin-top:8px;" /></span></a>
                            </header>
                    </div>
                </div>    
                    
                    
                <div class="row b-bottom mt-xl">
                	<div class="col-md-7 col-xs-12 ">
                    	<p style="text-align:justify">
                        <?echo $row['additional_informations']?>
                        </p>
                       
                        <h2 class="s-title icon-testdrive">PRENOTA UN TEST DRIVE</h2>
                        <div class="b-contacts__form mt-md">
							<div id="messaggioResult"></div>
							<form id="contactForm" novalidate class="s-form">
                                <input type="hidden" name="modello" id="modello" value="<?echo  $row['make'].' '.$row['model'].''.$row['version']?>"/>
								<input type="text" placeholder="NOME E COGNOME *" value="" name="name" id="name" />
								<input type="text" placeholder="EMAIL" value="" name="email" id="email" />
								<input type="text" placeholder="TELEFONO *" value="" name="telefono" id="telefono" />
								<textarea id="message" name="message" placeholder="GENTILE CLIENTE, SPECIFICHI QUI UN GOIRNO ED UN ORA IDEALE PER EFFETTUARE IL SUO TEST DRIVE"></textarea>
                                <div class="col-md-12 col-xs-12 p-none">
                                	<div class="col-md-7 col-xs-12 p-none">
                                    	<p class="mb-xs">* Campi Obbligatori</p>
                                        <input type="checkbox" name="privacy" value="privacy"/> <span class="privacy">Ho letto l'informativa sulla privacy e acconsento al trattamento dei dati.</span>
                                    </div>
                                    <div class="col-md-5 col-xs-12 p-none">
                                    	 <footer class="b-items__aside-main-footer pr-none">
                                            <button type="submit" class="btn m-btn f-right mt-sm mb-md">INVIA</button>
                                         </footer>
                                    </div>
                                </div>
								 
							</form>
						</div>    
                        
                 	</div>
                    <div class="col-md-5 col-xs-12">       
                        <div class="b-detail__main-info-text  " data--delay="0.5s">
                            <div class="b-detail__main-aside-about-form-links">
                                <a href="#" class="j-tab m-active" data-to='#info1'>ACCESSORI</a>
                                <a href="#" class="j-tab" data-to='#info2'>DETTAGLI</a>
                            </div>
                            <div id="info1">
                            <p>
                            
                            
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
                                
                             &nbsp;   
                            </p>    
                            </div>
                            <div id="info2">
                            <p>
                            <div class="dettagli"><span class="dettagliTitolo">Immatricolazione</span><br />
                               <?echo estraiDataAutoContratta($row['registration_date'])?></div>
                            <div class="dettagli"><span class="dettagliTitolo">Carrozzeria</span><br />
                               <?echo $row['body']?></div>
                            <div class="dettagli"><span class="dettagliTitolo">Omologazione</span><br />
                               <?echo emissionDecode($row['emission_class'])?></div>
                            <div class="dettagli"><span class="dettagliTitolo">Cilindrata</span><br />
                               <?echo ($row['cc'])?> cc</div>
                            <div class="dettagli"><span class="dettagliTitolo">Posti</span><br />
                               <?echo ($row['seats'])?></div>
                              <div class="dettagli"><span class="dettagliTitolo">Porte</span><br />
                               <?echo ($row['doors'])?></div> 
                            <div class="dettagli"><span class="dettagliTitolo">Trazione</span><br />
                               <?echo ($row['traction'])?></div> 
                           <div class="dettagli"><span class="dettagliTitolo">Emissioni</span><br />
                               <?echo ($row['emission_co2'])?> g/km</div>
                          <div class="dettagli"><span class="dettagliTitolo">Consumi</span><br />
                               urbano: <?echo ($row['consumo_urbano'])?> l/100km<br />
                               extraurbano: <?echo ($row['consumo_extra'])?> l/100km<br />
                               misto: <?echo ($row['consumo_misto'])?> l/100km<br />
                          </div>     
                               &nbsp;  
                                </p>
                            </div>
                        </div>
                 	</div>
				 </div> 
        	</div>
        </section>
        
    <?
    
    boxFondoPagina();
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