<?
include('include_dir.php');
include($percorsoLingua.'include/include.php');

$grafica=new Tgrafica(false,false);
$grafica->titolo='Compro auto Brescia';
$grafica->keywords='compro auto Brescia, compro auto, compro auto usate, compro auto usate Brescia';
$grafica->description='compro auto usate a Brescia con pagamento immediato in contanti. AUTOUNICA srl via valcamonica 19/h brescia.';
$grafica->codicePagina=costantiP::CP_COMPRIAMO;
$grafica->codiceBody='page1';

$pagina = isset($_GET['pagina'])?$_GET['pagina']:1;

$grafica->paint();
unset($grafica);



function corpo_pagina()

{
    $nuovoId = ProssimoIdTabella('comproauto');
    $immaginiCliente = pad0($nuovoId,'8');
  
     
    ?>

    <?selezionaOccasione()?>
	
  
	<section class="b-pageHeader b-count__buy bg-light_blue pt-xxl">
		<div class="row p-none m-none">
	
			<div class="col-md-6 col-sm-12">
					<img src="#" class="compriamo_img">
			</div>
			
			<div class="b-count__buy__introduction col-md-6 col-sm-12">
				<h1 class="mb-none">LOREM IPSUM!<br>DOLOR SIT AMET</h1>
				<h3 class="mt-sm">ADIPISCING ELIT<br>SED DO EIUSMOD TEMPOR INCIDIDUNT.</h3>
				<p>LOREM IPSUM.<br>
				DOLOR SIT AMET.<br>
				ADIPISCING ELIT SED DO.</p>
			</div>
			
		</div>
	</section>
	
	<section class="b-contacts">
        <div class="container">
            <div class="row">
				
				<div class="col-md-12">
					<h2 class="pb-none mb-none">LOREM IPSUM DOLOR SIT AMET? CONSECTETUR!<br>
						ADIPISCING ELIT <span>SED DO EIUSMOD TEMPOR.</span></h2>
                	<h3 class="mt-none">*La valutazione è gratuita. Nessun obbligo contrattuale.</h3>
				</div>
				
				<form id="contactForm"  novalidate class="s-form" >
					
					<div class="col-md-6 col-xs-12">
						<div class="b-contacts__form mt-md">
							<div id="success"></div>
							<input type="text" placeholder="MARCA MODELLO *" value="" name="marca" id="marca" />
							<label>TAGLIANDI*:</label>
							
                            <input type="radio" class="tagliandiR" name="tagliandi" value="sempre" /><span class="tagliandi">SEMPRE</span>
                            <input type="radio" class="tagliandiR" name="tagliandi" value="1volta" /><span class="tagliandi">UNA VOLTA ALL'ANNO</span>
                            <input type="radio" class="tagliandiR" name="tagliandi" value="mai" /><span class="tagliandi">MAI</span>
                            
                            
							<input type="text" placeholder="NOTA INTEGRATIVA" value="" name="nota" id="nota" />
							<textarea id="difetti" name="difetti" placeholder="EVENTUALI DIFETTI / PREGI"></textarea>
							<div class="col-md-12 col-xs-12 p-none">
									 
								
								<a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/FAQ.php"><div class="btn m-btn gradient f-left" style="padding: 5px 10px 5px 20px;">FAQ <span class="fa fa-search" style="margin-left: 0px;"></span></div></a>
							</div>
						</div>
					</div>

					<div class="col-md-6 col-xs-12">
						<div class="b-contacts__form mt-md">
                        
                            
							<input type="text" placeholder="NOME E COGNOME *" value="" name="nome" id="nome" />
							<input type="text" placeholder="EMAIL" value="" name="email" id="email" />
							<input type="text" placeholder="TELEFONO *" value="" name="phone" id="phone" />
                            
                            <input type="hidden" id="immaginiCliente" name="immaginiCliente" value="<?echo $immaginiCliente?>" />
                            <div id="dropFiles" class="dropzone"></div>
							
							
							<div class="col-md-12 p-none">
								<div class="col-md-8 col-xs-12 p-none mt-lg">
									<label class="check_privacy dark m-none">
										<p>Ho letto l'informativa sulla privacy<br>e acconsento al trattamento dei dati.</p>
										<input type="checkbox" name="privacy" value="privacy">
										<span class="checkmark"></span>
									</label>
									
								</div>
								<div class="col-md-4 col-xs-12 p-none">
									 <footer class="b-items__aside-main-footer pr-none">
										<button type="submit" class="btn m-btn m-btm-azzurro f-right mt-lg mb-md">INVIA</button>
									 </footer>
								</div>
							</div>
						</div>
					</div>
				</form>
				<br clear="all">
				
        	</div>
        </div>
    </section>

	<section class="b-count__service pt-none">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-xs-12 mb-xlg">
					<div class="b-count__service__item">
						<img src="../images/icon-compriamo/icon-pagamento.svg" class="box_icon_width_small">
						<h2></h2>
						<h5>il Pagamento<br>è immediato</h5>
					</div>
				</div>
				<div class="col-sm-3 col-xs-12 mb-xlg">
					<div class="b-count__service__item j-last">
						<img src="../images/icon-compriamo/icon-passaggio.svg" class="box_icon_width_small">
						<h2></h2>
						<h5>il Passaggio<br>lo paghiamo noi</h5>
					</div>
				</div>
				<div class="col-sm-3 col-xs-12 mb-xlg">
					<div class="b-count__service__item j-last">
						<img src="../images/icon-compriamo/icon-crash.svg" class="box_icon_width_small">
						<h2></h2>
						<h5>NO<br>Auto incidentate</h5>
					</div>
				</div>
				<div class="col-sm-3 col-xs-12 mb-xlg">
					<div class="b-count__service__item j-last">
						<img src="../images/icon-compriamo/icon-iloveitaly.svg" class="box_icon_width_small">
						<h2></h2>
						<h5>NO<br>Auto con targa estero</h5>
					</div>
				</div>
			</div>
		</div>
	</section><!--b-count-->

	<section class="b-count__service bg-grey p-none m-none">
		<div class="row p-none m-none">
			<div id="box_img1" class="col-md-6 col-sm-12 p-none m-none left" style="background: #666 url(../images/servizi/permutausato.jpg) center center no-repeat; background-size: cover;"></div>
			
			<div id="box_text1" class="col-md-6 col-sm-12 b-count__service__text right">
				<div class="b-count__service__icon mobile-none"><img src="../images/icon-servizi/icon-servizi-permuta.svg"></div>
				<h1 class="mt-none mb-none">PERMUTA DEL TUO USATO</h1>
				<h3 class="mt-none">SENZA PENSIERI</h3>
				<p>La tua Auto usata è il mezzo migliore per comprare quella "nuova".<br>
Vieni a trovarci o scrivi nella sezione "compriamo la tua auto",<br>
sarà per noi un piacere valutarla anche per un pagamento immediato,<br>
ed il passaggio di proprietà è a carico nostro!</p>
			</div>
		</div>
	</section>
	
	<section class="b-count__buy">
		<div class="row p-none m-none">
	
			<div class="col-md-6 col-sm-12 left">
				<img src="../images/icon-compriamo/icon-FAQ.svg" class="faq_img right">
			</div>
			
			<div class="b-count__buy__introduction b-count__buy__text col-md-6 col-sm-12 right">
				<h1 class="mb-none">PAURA DELLE FREGATURE ?<br>
				CON LE NOSTRE FAQ<br>
				PUOI AVERE ANCORA PIÙ CERTEZZE.</h1>
				<br clear="all">
				<a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/FAQ.php"><div class="btn m-btn grey">VISUALIZZA DOMANDE E RISPOSTE</div></a>
			</div>
			
		</div>
	</section>

	<section class="b-count__buy bg-light_blue">
		<div class="row p-none m-none">
	
			<div class="col-md-6 col-sm-12 right">
				<img src="../images/icon-compriamo/icon-valutazione.svg" class="valutazione_img left">
			</div>
			
			<div class="b-count__buy__introduction b-count__buy__text2 col-md-6 col-sm-12 left">
				<h1 class="mb-none">VUOI UNA VALUTAZIONE<br>
				DELLA TUA AUTO DI PERSONA?</h1>
				<h3 class="mt-sm">CI FA PIACERE! IL TEAM AUTOUNICA<br>
È PRONTO A RICEVERTI PER VEDERE E VALUTARE<br>
LA TUA AUTO DAL VIVO! CONTATTACI</h3>
				<br clear="all">
				<a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/contatti.php" class="btn m-btn white">CONTATTI / ORARI</a>
			</div>
			
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
      <!--Contact form--> 
		<script type="text/javascript" src="/js/jquery.validate.min.js"></script>
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
                                nome: {
                                    required: true,
                                    minlength: 3
                                },
                                marca: {
                                    required: true,
                                    minlength: 3
                                },
                                cognome: {
                                    required: true,
                                    minlength: 3
                                },
                                phone: {
                                    required: true,
                                    minlength: 7
                                },
                                message: {
                                    required: true,
                                },
                                privacy: {
                                      required: true,
                                    }
            
                            },
                            messages: {
                                nome: {
                                    required: "Inserisci il tuo nome",
                                    minlength: "Il nome deve essere di almeno 3 caratteri"
                                },
                                phone: {
                                    required: "Inserisci il tuo numero di telefono",
                                    minlength: "inserisci un numero valido"
                                },
                                marca: {
                                    required: "Inserisci marca e modello della tua vettura",
                                },
                                message: {
                                    required: "Inserisci il tuo messaggio"
                                },
                                email: "Inserisci una email valida",
                                privacy: "Accetta il trattamento della privacy<br />"
                            },
                             
                            submitHandler: function(form) {
                                //form.submit();
                                 var marca = $("#marca").val();
                                 var tagliandi = $(".tagliandiR:checked").val();
                                 var nota = $("#nota").val();
                                 var difetti = $("#difetti").val();
                                 var nome = $("#nome").val();
                                 var email = $("#email").val();
                                 var phone = $("#phone").val();
                                 var immaginiCliente = $("#immaginiCliente").val();
                                 
                                
                                        $.ajax({
                                         
                                        type: 'POST',
                                         
                                        url: 'comproautobrescia_action.php',
                                         
                                        data: 'nome='+nome+'&nota='+nota+'&difetti='+difetti+'&phone='+phone+'&email='+email+'&marca='+marca+'&tagliandi='+tagliandi+'&immaginiCliente='+immaginiCliente,
                                         
                                        cache: false,
                                         
                                        success: function(result){
                                        $("#messaggioResult").html(result);
                                        $("#contactForm").trigger('reset'); //jquery
                                        $("#contactForm").hide; //jquery
                                        JS_ClearDropZone();
                                        
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
		
        
   	
	<link rel="stylesheet" href="<?echo costantiP::BASE_URL?>css/OLD/dropzone.css" />
    <script type="text/javascript" src="<?echo costantiP::BASE_URL?>js/dropzone.js"></script>
    
    <!-- Custom jQuery -->
    <script language="javascript">
		$(document).ready(function (){
			var altezza1 =$('#box_text1').innerHeight();
			$('#box_img1').height(altezza1);
           
            Dropzone.autoDiscover = false;
             var mb = $('#immaginiCliente').val();
             $("div#dropFiles").dropzone({
                    url: "contact_me.php",
                    maxFilesize: 2, // MB
                    maxFiles: 20,
                    thumbnailWidth: 80,
                    thumbnailHeight: 80,
                    thumbnailMethod: "crop",
                    dictDefaultMessage: "Trascina qui le tue fotografie oppure clicca per caricarle<br />MAX UPLOAD 20 fotografie",
                    dictFileTooBig:"Il file è troppo grosso. La dimensione massima è di 2MB per immagine",
                    dictInvalidFileType:"Sono valide solo immagini JPG e PNG",
                    dictRemoveFile:"Rimuovi",
                    acceptedFiles: "image/jpeg,image/png,image/gif",
                    addRemoveLinks: true,
                    renameFile: function (file) {
                        return mb + '_' + new Date().getTime() + '-' + file.name;
                    }
                    
                    });
                    
            
           
 
            
		});
            
            function JS_ClearDropZone() {
            alert('sdasd');
            var myDropzone = Dropzone.forElement("#dropFiles");
                myDropzone.removeAllFiles();
                $(".dz-message").removeClass("hidden");
      
        }
    </script>
    

    <?
    
}       
?>