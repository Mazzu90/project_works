<?
include('include_dir.php');
include($percorsoLingua.'include/include.php');

$grafica=new Tgrafica(false,false);
$grafica->titolo='';
$grafica->keywords='';
$grafica->description='';
$grafica->codicePagina=costantiP::CP_CONTATTI;
$grafica->codiceBody='page1';

$pagina = isset($_GET['pagina'])?$_GET['pagina']:1;

$grafica->paint();
unset($grafica);

function corpo_pagina()
{
    ?>

	<?selezionaOccasione()?>

	<section class="b-pageHeader b-count__service bg-light_blue pt-xxxxxl">
		<div class="row p-none m-none">
	
			<div class="col-md-6 col-sm-12">
					<img src="../../images/icon-tipiaceauto.png" class="faq_img"/>
			</div>
			
			<div class="b-count__service__introduction col-md-6 col-sm-12 white">
				<h1 class="mt-none mb-none">CONTATTI & SUPPORTO<br>FANNO SEMPRE COMODO</h1>
				<h3>Il Servizio Clienti di AUTOMOTIVE<br>
				è a tua disposizione, approfittane!<br>
				Possiamo rispondere ad ogni domanda<br>
				ed assisterti nel processo d’acquisto.</h3>
			</div>
			
		</div>
	</section>

	<section class="b-count__service">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-xs-12 mb-xlg">
					<div class="b-count__service__item">
						<img src="../images/icon-contatti/icon-indirizzo.svg" class="box_icon_width_small">
						<h2></h2>
						<h5>Lorem ipsum dolor<br>25132 Brescia</h5>
					</div>
				</div>
				<div class="col-sm-3 col-xs-12 mb-xlg">
					<div class="b-count__service__item j-last">
						<img src="../images/icon-contatti/icon-orari-showroom.svg" class="box_icon_width_small">
						<h2></h2>
						<h5>Lunedì - Sabato<br>09.00 - 12.30<br>14.30 - 20.00</h5>
					</div>
				</div>
				<div class="col-sm-3 col-xs-12 mb-xlg">
					<div class="b-count__service__item j-last">
						<img src="../images/icon-contatti/icon-telefono.svg" class="box_icon_width_small">
						<h2></h2>
						<h5><a href="tel:+390302410251">+39 030 1234567</a></h5>
					</div>
				</div>
				<div class="col-sm-3 col-xs-12 mb-xlg">
					<div class="b-count__service__item j-last">
						<img src="../images/icon-contatti/icon-email.svg" class="box_icon_width_small">
						<h2></h2>
						<h5><a href="malto:info@autounica.com">info@automotive.com</a></h5>
					</div>
				</div>
			</div>
		</div>
	</section><!--b-count-->
    
    <div id="google-map"></div><!--b-map-->
	
	<section class="b-count__service">
		<div class="row p-none m-none">
	
			<div class="col-md-6 col-sm-12">
				<img src=".#" class="officina_img">
			</div>
			
			<div class="b-count__service__introduction col-md-6 col-sm-12">
				<h1 class="mb-none">LOREM IPSUM<br>ADIPISCING ELIT?</h1>
				<h4 class="" style="line-height: 1.5;">QUIS NOSTRUD EXERCITATIO ULLAMCO LABORIS<br>
				NISI UT ALIQUIP EX<br>
				DUIS AUTE IRURE DOLOR IN REPREHENDERIT<br>
				IN VOLUPTATE VELIT ESSE CILLUM DOLORE<br>
				EU FUGIAT NULLA PARIATUR.</h4>
			</div>
			
		</div>
	</section>

	<section class="b-count__service bg-grey p-none m-none">
			<div class="row p-none m-none">
				<div id="box_img1" class="col-md-6 col-sm-12 p-none m-none left" style="background: url(../images/officina/officina01.jpg) center center no-repeat; background-size: cover;"></div>
				<div id="box_text1" class="col-md-6 col-sm-12 b-count__service__text right">
					<div class="b-count__service__icon mobile-none"><img src="../images/icon-contatti/icon-orari-officina.svg"></div>
					<h3 class="mt-none mb-none">PRENOTA UN CONTROLLO GENERALE GRATUITO<br>NELLA NOSTRA NUOVA OFFICINA</h3>
					<p>Lunedì - Venerdì<br>
					08.00 - 12.30 / 13.30 - 18.00<br>
					Sabato<br>
					08.00 - 12.30</p>
					<br clear="all">
					<a href="tel:+390302410251"><div class="btn m-btn grey">CHIAMA ORA</div></a>
				</div>
			</div>
		</section>

	<section class="b-contacts">
        <div class="container">
            <div class="row">
				
				<div class="col-md-12">
					<h2 class="s-title">LOREM IPSUM? DOLOR SIT AMET!<br>
					UT ENIM AD MINIM VENIAM, QUIS NOSTRUD<br>
					<span class="violet">TI RISPONDEREMO ENTRO 24 ORE.</span></h2>
					<div class="b-contacts__form mt-md">
						<div id="messaggioResult"></div>

						<form id="contactForm"  class="s-form">
							
							<div class="col-md-6 col-xs-12 p-none">
								<input type="text" placeholder="NOME E COGNOME *" value="" name="name" id="name"  required="required"/>
								<input type="text" placeholder="EMAIL *" value="" name="email" id="email"  required="required"/>
								<input type="text" placeholder="TELEFONO *" value="" name="telefono" id="telefono"  required="required"/>
							</div>

							<div class="col-md-6 col-xs-12">
								
								<textarea id="user-message" name="user-message" placeholder="MESSAGGIO..."></textarea>
								
								<div class="col-md-12 col-xs-12 p-none">
									<div class="col-md-7 col-xs-12 p-none">
										<p class="mb-xs">* Campi Obbligatori</p>
										<label class="check_privacy dark m-none"><p>Ho letto l'informativa sulla privacy<br>e acconsento al trattamento dei dati.</p>
											<input type="checkbox"name="privacy" value="privacy">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="col-md-5 col-xs-12 p-none">
									<button type="submit" class="btn m-btn lightblue f-right mt-sm mb-md">INVIA</button>
									</div>
								</div>
							</div>
							
						</form>
					</div>  
				</div>
                
             </div> 
        </div>
    </section>

	<section class="b-count__service bg-light_blue p-none m-none">
		<div class="row p-none m-none">
			<div class="col-md-6 col-sm-12 pt-xxxl pb-xxl right">
				<img src="../images/icon-contatti/lavora-con-noi.svg" class="lavoraconnoi_img left"/>
			</div>
			<div class="col-md-6 col-sm-12 b-count__service__text2 left white">
				<div class="b-count__service__icon mobile-none">
					<img src="#">
				</div>
				<h1 class="mt-none mb-none">VUOI FAR PARTE DEL NOSTRO TEAM?</h1>
				<h3 class="mt-none">SIAMO SEMPRE ALLA RICERCA!<br>
				SE SEI UN ENTUSIASTA CHE GUARDA AL FUTURO,</h3>
				<br clear="all">
				<a href="mailto:leonardo.rossi@autounica.com" class="btn m-btn white">INVIA IL TUO CV</a>
			</div>
		</div>
	</section>

	<section class="b-featured preFooter">
		<div class="container">
			<div class="col-xs-12">
				<h2 class="title">PERCHè SCEGLIERE AUTOMOTIVE</h2>
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
    ?>  <script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion_async.js" charset="utf-8"></script>
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
                                 
                                
                                        $.ajax({
                                         
                                        type: 'POST',
                                         
                                        url: 'contatti_action.php',
                                         
                                        data: 'nome='+nome+'&cognome='+cognome+'&email='+email+'&telefono='+telefono+'&messaggio='+messaggio,
                                         
                                        cache: false,
                                         
                                        success: function(result){
                                        $("#messaggioResult").html(result);
                                        $("#contactForm").trigger('reset'); //jquery
                                        $("#contactForm").hide; //jquery
                                        window.google_trackConversion({
                                              google_conversion_id: 922484431, 
                                              google_conversion_label: "wAWgCJTwhW4Qz_3vtwM",
                                              google_remarketing_only: false
                                            })
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


		<!-- Custom jQuery -->
		<script language="javascript">
			$(document).ready(function (){
				var altezza1 =$('#box_text1').innerHeight();
				$('#box_img1').height(altezza1);
			});
		</script>

		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0N5pbJN10Y1oYFRd0MJ_v2g8W2QT74JE"></script>
		<script>
			function LoadMap(propertes) {
				var defaultLat = 45.498529;
				var defaultLng = 10.220689;
				var mapOptions = {
					center: new google.maps.LatLng(defaultLat, defaultLng),
					zoom: 10,
					scrollwheel: false,
					styles: [{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#d3d3d3"}]},{"featureType":"transit","stylers":[{"color":"#808080"},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#b3b3b3"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"weight":1.8}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"color":"#d7d7d7"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ebebeb"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"color":"#a7a7a7"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#efefef"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#696969"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#737373"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#d6d6d6"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#dadada"}]}]
				};
				var map = new google.maps.Map(document.getElementById("google-map"), mapOptions);
				var infoWindow = new google.maps.InfoWindow();
				var myLatlng = new google.maps.LatLng(45.498529, 10.220689);

				var image = '../images/icon-map.png'
				var marker = new google.maps.Marker({
					position: myLatlng,
					map: map,
					icon: image
				});
				(function (marker) {
					google.maps.event.addListener(marker, "click", function (e) {
						infoWindow.setContent("" +
							"<div class='map-properties contact-map-content'>" +
							"<div class='map-content'>" +
							"<h4>AUTOMOTIVE</h4><p class='address'>Lorem ipsum dolor - 25123 Brescia</p>" +
							"<i class='fa fa-phone'></i> +39 030 1234567<br>" +
							"<i class='fa fa-envelope'></i> info@automotive.com" +
							"</div>" +
							"</div>");
						infoWindow.open(map, marker);
					});
				})(marker);
			}
			LoadMap();
		</script>
        
    
    <?
}
        
?>