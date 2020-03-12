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
        
        

$grafica->titolo='AUTOUNICA srl - Vendita di auto usate a Brescia - '.$row['nomeCategoria'].' - '.$row['titolo_veicolo'];
$grafica->keywords=$row['nomeCategoria'].', '.$row['titolo_veicolo'].', '.$row['version'].', auto usate, veicoli usati, vendita auto usate Brescia';
$grafica->description='Ampio showroom con oltre 200 vetture disponibili, vendita di '.$row['titolo_veicolo'].' '.$row['version'];
$grafica->codicePagina=costantiP::CP_STAMPA;
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
    ?>	
   
    	<section class="s-shadow ">
        	<div class="container pt-xs">
                
                <div class="row">
                <div >
                    <div class="b-nav__logo" style="float: left; width: 50%"></div>
                    
                
                    <div style="text-align: right; float: left; width: 25%" >
                        AUTOUNICA Srl<br />
                                Via Valcamonica, 19/H, 25132 Brescia<br />
                                Tel. +39 030 2410251
                    </div>
                    <div style="text-align: right; float: left; width: 25%">
                        <a href="#" onclick="window.print();return false;"><img src="<?echo costantiP::BASE_URL?>images/stampa.png" style="margin-bottom:1px;" /><span>STAMPA</span></a>
                    </div>
                  </div>   
                    
                	<div class="col-md-12 col-xs-12">
                    	<h3 class="mb-none mt-none"><?echo  $row['make'].' '.$row['model']?></h3>
                        <h4 class="mt-none"><?echo $row['version']?> - <span><?echo $row['prezzo']?> €</span></h4>
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
                                            
                           
                                 
                      $numeroImmmagini= count($immaginiVeicolo);              
                    
                    ?>
                    <div  id="immaginePrincipale">
					   <img class="example-image img-responsive" src="<?echo $immaginiVeicolo[0]['imgBig']?>"  alt="<?echo $immaginiVeicolo[0]['titolo']?>" />
                    </div>
                        <?
                          if (costantiP::URL_REWRITE_ATTIVO)
                                    {
                                        $path = costantiP::BASE_URL.costantiP::LINGUA.'/galleria/'.normalizzaTesto($row['make'].'/'.$row['model'].'-'.$row['version'].'_'.$row['id']).'.htm';
                                    }
                                    else
                                    {
                                        $path = costantiP::BASE_URL.costantiP::LINGUA.'/galleria-auto.php?id='.$row['id'];                                                
                                    }
                        
                        ?>
                        
                        
                	</div>
                    
                    <div class="row mt-xl" id="infoGenerali">
                    	 
                            <div  style="width: 30%; float: left">
                           <h4>Informzioni generali</h4>
                                KM percorsi: <?echo number_format($row['km'],0,',','.')?> Km<br />
                                Immatricolazione: <?echo estraiDataAuto($row['registration_date'])?><br />
                                Alimentazione: <?echo fuelDecode($row['alimentazione'])?><br />
                                <? $cavalli = $row['kwatt']*1000/735.49875 ?>
                                Potenza: <?echo $row['kwatt']?> KW / <?echo round($cavalli,0)?> CV<br />
                                Cambio:<?echo $row['gearbox']?><br />
                                Colore: <?echo $row['colore']?><br />
                                Interni: <?echo $row['interni']?><br />
                                TARGA: <?echo $row['plate']?><br />
                                <!--<p class="mb-xs mt-md">TELAIO</p>
                                <p class="s-lineTopLeft s-lineDownLeft  pt-xs pb-xs mb-none">xxxxx</p>-->
                            </div>
                            <div class="" style="width: 65%; float: left">
                            <h4>Descrizione</h4>
                            	<p style="text-align:justify">
                                <?echo $row['additional_informations']?>
                                </p>
                            </div>
                    	
                    </div> 
           		
               
                <div class="row">
                            <div style="width: 30%; float: left">
                             <h4>Dettagli</h4>
                                    <p>
                                    <span class="dettagliTitolo">Immatricolazione:</span> <?echo estraiDataAutoContratta($row['registration_date'])?>
                                    <br />
                                   <span class="dettagliTitolo">Carrozzeria</span>: <?echo $row['body']?>
                                   <br />
                                    <span class="dettagliTitolo">Omologazione</span><br />
                                       <?echo emissionDecode($row['emission_class'])?>
                                    <span class="dettagliTitolo">Cilindrata</span>
                                       <?echo ($row['cc'])?> cc<br />
                                    <span class="dettagliTitolo">Posti</span>
                                       <?echo ($row['seats'])?><br />
                                   <span class="dettagliTitolo">Porte</span>
                                       <?echo ($row['doors'])?><br />
                                    <span class="dettagliTitolo">Trazione</span>
                                       <?echo ($row['traction'])?> <br />
                                  <span class="dettagliTitolo">Emissioni</span>
                                       <?echo ($row['emission_co2'])?> g/km<br />
                                 <span class="dettagliTitolo">Consumi</span><br />
                                       urbano: <?echo ($row['consumo_urbano'])?> l/100km<br />
                                       extraurbano: <?echo ($row['consumo_extra'])?> l/100km<br />
                                       misto: <?echo ($row['consumo_misto'])?> l/100km<br />
                                     
                                       &nbsp;  
                                        </p>
                                <h4>Contatti</h4>
                                <p>
                                AUTOUNICA Srl<br />
                                Via Valcamonica, 19/H<br />
                                25132 Brescia<br />
                                Tel. +39 030 2410251
                                </p>
                                <h4>Orari</h4>
                                <p>
                                Lunedì - Sabato<br />
                                09.00 - 12.30<br />
                                14.30 - 20.00 <br />
                                </p>        
                          
                        </div>      
                        <div style="width: 60%; float: left">
                                    <h4>Accessori</h4>
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
                          
                            
                    
				    </div> 
                 </div>
        	
        </section>
        
    <?
    
    
}

function HeaderAggiuntivi()
{
    ?>
        <link href="<?echo costantiP::BASE_URL?>css/print.css" media="print" rel="stylesheet">
  
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