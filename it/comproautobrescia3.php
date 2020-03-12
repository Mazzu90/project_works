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
    $immaginiCliente = pad0($nuovoId,'8')
    
    ?>
    	<section class="b-contacts">
        <div class="container">
            <div class="row">
				
				<div class="col-md-12">
					<h2 class="pb-none mb-none">VUOI SAPERE QUANTO VALE LA TUA AUTO OGGI? È FACILE!<br>
						COMPILA QUESTI CAMPI* <span>TI RISPONDEREMO ENTRO 24 ORE.</span></h2>
                	<h3 class="mt-none">*La valutazione è gratuita. Nessun obbligo contrattuale.</h3>
				</div>
				
				<form id="compro_auto"  novalidate class="s-form" enctype="multipart/form-data" method="post" action="contact_me.php">
					
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
                            
                            <div id="dropFiles" class="dropzone"></div>
                            
							
							
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
    
    
    
    
    
    
    
    <br /><br /><br /><br /><br /><br />

    <form action="contact_me.php" class="dropzoneAAAA" id="dropzoneAA"></form> 
    <input type="hidden" id="immaginiCliente" value="<?echo $immaginiCliente?>" />
<br /><br /><br /><br /><br /><br /><br /><br /><br />

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
         
         
         
         /*
          // Disabling autoDiscover, otherwise Dropzone will try to attach twice.
            Dropzone.autoDiscover = false;
            // or disable for specific dropzone:
            // Dropzone.options.myDropzone = false;
            
            $(function() {
              // Now that the DOM is fully loaded, create the dropzone, and setup the
              // event listeners
              var myDropzone = new Dropzone(".dropzone");
              myDropzone.on("addedfile", function(file) {
                // Maybe display some more file information on your page 
                alert('aaaa');
               file.name = new Date().getTime() + '_' + file.name;
                
                 
                 
              });
            })
        */
      
        
    </script>
    
   
    

    <?
    
}       
?>