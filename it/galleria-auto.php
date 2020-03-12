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
        $titoloContenuto=normalizzaTesto($row['modelloContenuto'].'-'.$row['versioneContenuto']);
        $titoloMarca=normalizzaTesto($row['marcaContenuto']);
        //$url = costantiP::BASE_URL.costantiP::LINGUA.'/'.$titoloCategoria.'/'.$titoloContenuto.'_'.$idVeicolo.'.htm';
        $url = costantiP::BASE_URL.costantiP::LINGUA.'/galleria/'.$titoloMarca.'/'.$titoloContenuto.'_'.$id.'.htm';
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
        
        

$grafica->titolo=$row['titolo_veicolo'].' usata in vendita a Brescia da AUTOUNICA srl - Galleria immagini ';
$grafica->keywords=$row['nomeCategoria'].', '.$row['titolo_veicolo'].', '.$row['version'].', auto usate, veicoli usati, vendita auto usate Brescia, immagini, galleria immagini';
$grafica->description='Ampio showroom con oltre 200 vetture disponibili, galleria fotografica di '.$row['titolo_veicolo'].' '.$row['version'].' in vendita presso il nostro Showroom in via Valcamonica a Brescia';
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

if (costantiP::URL_REWRITE_ATTIVO)
        {
            $pathGalleria= costantiP::BASE_URL.costantiP::LINGUA.'/galleria/'.normalizzaTesto($row['make'].'/'.$row['model'].'-'.$row['version'].'_'.$row['id']).'.htm';
            $pathStampa = costantiP::BASE_URL.costantiP::LINGUA.'/print/'.normalizzaTesto($row['make'].'/'.$row['model'].'-'.$row['version'].'_'.$row['id']).'.htm';
            $path = costantiP::BASE_URL.costantiP::LINGUA.'/'.normalizzaTesto($row['make'].'/'.$row['model'].'-'.$row['version'].'_'.$row['id']).'.htm';
        }
        else
        {
            $pathGalleria = costantiP::BASE_URL.costantiP::LINGUA.'/galleria-auto.php?id='.$row['id'];       
            $pathStampa = costantiP::BASE_URL.costantiP::LINGUA.'/print.php?id='.$row['id'];
            $path = costantiP::BASE_URL.costantiP::LINGUA.'/dettaglio-auto.php?id='.$row['id'];                                            
        }        
        
    ?>	
   
    	<section class="b-detail__main pb-none">
        	<div class="container">
                <div class="row">
					
					<div class="col-xs-12 mb-xl pb-xl b-bottom">
						<h1 class="f-left m-none p-none">PHOTOGALLERY</h1>
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
						<header class="b-items__cars-one-info-header mb-xl"><span><sup>€</sup><?echo number_format($row['prezzo'],0,',','.')?></span></header>
                    </div>
					
                    <?
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
                                            
                           
                                 
                                    
                    
                    ?>
                
           		</div>
                
			 </div> <!--close container-->
                
                 <div class="row">
                  <?$i=0;
					 foreach ($immaginiVeicolo as $imgV) {
						  {
						?>
						   <div class="col-md-3">
						   <div class="realtaAutounica_detail"></div>  
						   <a href="<?echo $imgV['imgHd']?>"   class="b-detail__main-info-images-small-one" data-lightbox="example-set">
								<img class="img-responsive galleria" src="<?echo $imgV['imgBig']?>" alt="<?echo $imgV['titolo']?>"/>
							</a>
						   </div>
							<?
							}
							$i++;
							}
						?>
                 </div>
			
        </section>

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
{
    ?>
        <link rel="stylesheet" href="<?echo costantiP::BASE_URL?>css/lightbox.css" />
        <script type="text/javascript" src="<?echo costantiP::BASE_URL?>js/lightbox.js"></script>
        
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
                                         
                                        url: 'contatti_action.php',
                                         
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
        
    
    <?
}
        
?>