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

    ?>

    
	<nav class="" id="headerSearchMenu"> 
    	<div class="container">
    		<div class="row">
				<h2 class="center">SELEZIONA LA TUA OCCASIONE</h2>
				<div class="col-xs-12" align="center">
					<button type="submit" class="btn m-btn search mt-none" id="nResultVetture"></button>
				</div>
			</div>
		</div>
	</nav>
  
	<section class="b-pageHeader b-count__buy bg-light_blue pt-xxl">
		<div class="row p-none m-none">
	
			<div class="col-md-6 col-sm-12">
					<img src="../images/icon-compriamo/icon-compriamo.svg" class="compriamo_img">
			</div>
			
			<div class="b-count__buy__introduction col-md-6 col-sm-12">
				<h1 class="mb-none">LA TUA AUTO VALE!<br>NOI LA COMPRIAMO</h1>
				<h3 class="mt-sm">IL PAGAMENTO è IMMEDIATO<br>IL PASSAGGIO DI PROPRIETà LO PAGHIAMO NOI.</h3>
				<p>VERTIà AUTOUNICA.<br>
				NON COMPRIAMO AUTO INCIDENTATE.<br>
				NON TARGATE ITALIA, SENZA KILOMETRI CERTIFICATI.</p>
			</div>
			
		</div>
	</section>
	
	<section class="b-contacts">
        <div class="container">
            <div class="row">
				
				<div class="col-md-12">
					<h2 class="pb-none mb-none">VUOI SAPERE QUANTO VALE LA TUA AUTO OGGI? È FACILE!<br>
						COMPILA QUESTI CAMPI* <span>TI RISPONDEREMO ENTRO 24 ORE.</span></h2>
                	<h3 class="mt-none">*La valutazione è gratuita. Nessun obbligo contrattuale.</h3>
				</div>
				
				<form id="compro_auto"  novalidate class="s-form dropzone" enctype="multipart/form-data" method="post" action="contact_me.php">
					
					<div class="col-md-6 col-xs-12">
						<div class="b-contacts__form mt-md">
							<div id="success"></div>
							<input type="text" placeholder="MARCA MODELLO *" value="" name="marca" id="marca" />
							<label>TAGLIANDI:</label>
							<input type="checkbox" name="tagliandi" value="sempre"/><span class="tagliandi">SEMPRE</span>
							<input type="checkbox" name="tagliandi" value="1volta"/><span class="tagliandi">UNA VOLTA ALL'ANNO</span>
							<input type="checkbox" name="tagliandi" value="mai"/><span class="tagliandi">MAI</span>
							<input type="text" placeholder="NOTA INTEGRATIVA" value="" name="nota" id="nota" />
							<textarea id="user-message" name="user-message" placeholder="EVENTUALI DIFETTI / PREGI"></textarea>
							<div class="col-md-12 col-xs-12 p-none">
									 
								
								<a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/FAQ.php"><div class="btn m-btn gradient f-left" style="padding: 5px 10px 5px 20px;">FAQ <span class="fa fa-search" style="margin-left: 0px;"></span></div></a>
							</div>
						</div>
					</div>

					<div class="col-md-6 col-xs-12">
						<div class="b-contacts__form mt-md">
                        
                            
							<input type="text" placeholder="NOME E COGNOME *" value="" name="user-name" id="user-name" />
							<input type="text" placeholder="EMAIL" value="" name="user-email" id="user-email" />
							<input type="text" placeholder="TELEFONO *" value="" name="user-phone" id="user-phone" />
                            -
                           <!-- <article>
                              <div id="holder">
                              </div> 
                              <p id="upload" class="hidden"><label>Drag & drop not supported, but you can still upload via this input field:<br><input id="photos" name="photos[]" type="file" multiple="multiple"></label></p>
                              <p id="filereader">File API & FileReader API not supported</p>
                              <p id="formdata">XHR2's FormData is not supported</p>
                              <p id="progress">XHR2's upload progress isn't supported</p>
                              <p>Upload progress: <progress id="uploadprogress" max="100" value="0">0</progress></p>
                              <p>Drag an image from your desktop on to the drop zone above to see the browser both render the preview, but also upload automatically to this server.</p>
                            </article>
-->
                            -
                            <input type="file" name="file" />
                            -
							
							
							<div class="col-md-12 p-none">
								<div class="col-md-8 col-xs-12 p-none">
									<input type="checkbox" name="privacy" value="privacy"/> <span class="privacy">Ho letto l'informativa sulla privacy
e acconsento al trattamento dei dati.</span>
								</div>
								<div class="col-md-4 col-xs-12 p-none">
									 <footer class="b-items__aside-main-footer pr-none">
										<button type="submit" class="btn m-btn m-btm-azzurro f-right mt-sm mb-md">INVIA</button>
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
			<div id="box_img1" class="col-md-6 col-sm-12 p-none m-none left" style="background: #666 url(../images/servizi/permuta-tuo-usato.jpg) center center no-repeat; background-size: cover;"></div>
			
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
				<div class="btn m-btn white">CONTATTI / ORARI</div>
			</div>
			
		</div>
	</section>

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
		<script src="<?echo costantiP::BASE_URL?>assets/contact/jqBootstrapValidation.js"></script> 
		
        
   	
	<link rel="stylesheet" href="<?echo costantiP::BASE_URL?>css/OLD/dropzone.css" />
    <script type="text/javascript" src="<?echo costantiP::BASE_URL?>js/dropzone.js"></script>
    
    <!-- Custom jQuery -->
    <script language="javascript">
		$(document).ready(function (){
			var altezza1 =$('#box_text1').innerHeight();
			$('#box_img1').height(altezza1);
		});
		
    </script>
    
   

    <?
    
}       
?>