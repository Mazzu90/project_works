<?

class Tgrafica
{
    private $connessione;
    private $db;
    private $ErrDB;

    public $titolo;
    public $description;
    public $keywords;
    public $codiceBody;
    public $login;
    public $lMenu = true;
    public $codicePagina;
    public $FunzioneCorpo='';
    public $classeRiferimento='Veicolo';

    function __construct($autopaint = true, $verificaLogin = true)
    {
       $encoding='utf8';
        

      //connessione al server
	   $this->Connessione = @mysql_connect(costanti::DB_HOST, costanti::DB_USER, costanti::DB_PASSWORD);

      	//connessione al database
    	if ($this->Connessione)
            {
    		$this->db = @mysql_select_db(costanti::DB_NAME, $this->Connessione);
                @mysql_query('SET NAMES \'' . $encoding . '\'',$Connessione);
            }
    
            if ($autopaint)
                $this->Paint();
    }

    function __destruct()
    {
        if (isset($this->Connessione))
            @mysql_close($this->Connessione);
            
        if (isset($this->db))            
            unset($this->db);
        if (isset($this->Connessione))            
            unset($this->Connessione);
    }

    function Paint()
    {
        
        if ($this->FunzioneCorpo == '') 
            $this->StampaCorpo();
        else
        {
            $FunzioneAlternativa = $this->FunzioneCorpo;
            $FunzioneAlternativa();
        }
    }

    function StampaCorpo($CodErrore = -2)
    {
    ?>
    <!doctype html>
    <html >

         <head>
            <?//$this->scriptGoogleTag()?>
            <?$this->HeaderStandard(); ?>
           
        </head>
        
        <body class="m-index m-detail">
           
            <!--header -->
            <? if($this->codicePagina!=costantiP::CP_STAMPA)
                  $this-> headerHTML() ?>
            <!--header end-->
            
            <!--content -->
      		<? corpo_pagina() ?>
            <!--content end -->
            
            <!--footer -->
           	<? $this->Footer() ?>
            <!--footer end-->
            
            <!-- script footer -->
            <? $this->ScriptFooter();
            if (function_exists('scriptFooterAggiuntivi'))
            scriptFooterAggiuntivi();
            
            //$this->scriptMonitoraggioGoogle()?>
            <!-- script footer end -->
        
        </body>
        </html>
	<?
    }
	
    
    
    function HeaderStandard()
    {
    ?>
        <!-- Basic -->
        <title><?=$this->titolo?> </title>
       
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="icon" type="image/png" href="<?echo costantiP::BASE_URL?>images/iconAutoUnica.png" />
        
        <meta name="description" content="<?=$this->description?>" />
        <meta name="keywords" content="<?=$this->keywords?>" />
        <meta name="content-language" content="<?=costantiP::LINGUA?>" />
        
        <link href="<?echo costantiP::BASE_URL?>css/master.css" rel="stylesheet">
        
        
        <?
        if (function_exists('HeaderSeoAggiuntivi'))
            HeaderSeoAggiuntivi();
        ?>
        
        
        <!-- CSS -->
        
        
        <!-- CSS -->
        
        
              
    <?
        if (function_exists('headerAggiuntivi'))
            HeaderAggiuntivi();
    }
	
	function headerHTML()
    {
        ?>
        	
            <?
				if ($this->codicePagina==costantiP::CP_HOMEPAGE)
				{
			?>
            	
			<nav class="b-nav" id="headerMenu">
				<div class="row">
					<div class="col-md-1 col-xs-12 pr-none ml-md">
						<a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/index.php"><div class="b-nav__logo"></div></a>
					</div>

					<div class="col-md-10 col-xs-12 pl-none f-right mr-md">
						<div class="b-nav__list">
							<div class="navbar-header">
								
								<button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="navbar-toggle pull-left">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								
							</div>
							<div class="navbar-main-slide side-collapse in" id="nav">
								<ul class="navbar-nav-menu">

									<? $menuAttivo=($this->codicePagina==costantiP::CP_CHISIAMO)?' current ':'' ?>
									<li class="<?=$menuAttivo?>"><a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/chisiamo.php">Chi Siamo</a></li>
									
									<? $menuAttivo=($this->codicePagina==costantiP::CP_SERVIZI)?' current ':'' ?>
									<li class="<?=$menuAttivo?> dropdown"><a class="dropdown-toggle" href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/servizi.php">Servizi <!--<span class="fa fa-caret-down"></span>--></a>
										<!--<ul class="dropdown-menu h-nav">
											<li><a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/servizi.php">ESTENSIONE DI GARANZIA</a></li>
											<li><a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/servizi.php">AUTO SOSTITUTIVA</a></li>
											<li><a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/servizi.php">PACCHETTI ALL INCLUSIVE</a></li>
										</ul>-->
									</li>
									
									<? $menuAttivo=($this->codicePagina==costantiP::CP_OFFICINA)?' current ':'' ?>
									<li class="<?=$menuAttivo?> dropdown"><a class="dropdown-toggle" href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/officina.php">Officina <!--<span class="fa fa-caret-down"></span>--></a>
										<!--<ul class="dropdown-menu h-nav">
											<li><a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/officina.php">ANALISI</a></li>
											<li><a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/officina.php">GARANZIA</a></li>
											<li><a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/officina.php">PREPARAZIONE AUTO</a></li>
										</ul>-->
									</li>
									
									<? $menuAttivo=($this->codicePagina==costantiP::CP_COMPRIAMO)?' current ':'' ?>
									<li class="<?=$menuAttivo?>"><a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/comproautobrescia.php">Compriamo la tua auto</a></li>

									<? $menuAttivo=($this->codicePagina==costantiP::CP_MARCHI)?' current ':'' ?>
									<li class="<?=$menuAttivo?>"><a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/autovetture.php">Marchi</a></li>

									<? $menuAttivo=($this->codicePagina==costantiP::CP_CONTATTI)?' current ':'' ?>
									<li class="<?=$menuAttivo?>"><a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/contatti.php">Contatti</a></li>

									<? $menuAttivo=($this->codicePagina==costantiP::CP_TUTTELEAUTO)?' current ':'' ?>
									<li class="icon <?=$menuAttivo?> no-phone"><a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/ricerca.php"><i class="icon-magnifier icon icon-2x"></i><span>Ricerca Auto</span></a></li>

									<li class="icon no-phone"><a href="tel:+39 123 4567 890"><i class="icon-phone icon icon-2x"></i><span>123 4567 890</span></a></li>
									
									<div class="nav_mobile_box privacy only-mobile"><p><a href="#">Privacy Policy</a> / <a href="#">Utilizzo dei Cookie</a></p></div>
									
									<div class="nav_mobile_box tel only-mobile"><a href="tel:+39 123 4567 890"><i class="icon-phone icon icon-4x"></i><span>CLICCA E CHIAMA</span><p class="tel">123 4567 890</p></a></div>
									
									<div class="nav_mobile_box map only-mobile"><a href="#"><i class="fa fa-map-marker fa-4x map"></i><span>PORTAMI QUI</span><p>Via Valcamonica, 19/H<br>25135 Brescia</p></a></div>
									
									
								</ul>
							</div>
						</div>
					</div>
				</div>
			</nav><!--b-nav-->
            
            <?
				}
				else{
			?>

			<nav class="b-nav bg-blue" id="headerMenu">
				<div class="row">
					<div class="col-md-1 col-xs-12 pr-none ml-md">
						<a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/index.php"><div class="b-nav__logo white"></div></a>
					</div>

					<div class="col-md-10 col-xs-12 pl-none f-right mr-md">
						<div class="b-nav__list">
							<div class="navbar-header">
								
								<button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="navbar-toggle pull-left">
									<span class="icon-bar white"></span>
									<span class="icon-bar white"></span>
									<span class="icon-bar white"></span>
								</button>
								
							</div>
							<div class="navbar-main-slide side-collapse in" id="nav">
								<ul class="navbar-nav-menu">

									<? $menuAttivo=($this->codicePagina==costantiP::CP_CHISIAMO)?' current ':'' ?>
									<li class="<?=$menuAttivo?>"><a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/chisiamo.php">Chi Siamo</a></li>
									
									<? $menuAttivo=($this->codicePagina==costantiP::CP_SERVIZI)?' current ':'' ?>
									<li class="<?=$menuAttivo?> dropdown"><a class="dropdown-toggle" href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/servizi.php">Servizi <!--<span class="fa fa-caret-down"></span>--></a>
										<!--<ul class="dropdown-menu h-nav">
											<li><a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/servizi.php">ESTENSIONE DI GARANZIA</a></li>
											<li><a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/servizi.php">AUTO SOSTITUTIVA</a></li>
											<li><a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/servizi.php">PACCHETTI ALL INCLUSIVE</a></li>
										</ul>-->
									</li>
									
									<? $menuAttivo=($this->codicePagina==costantiP::CP_OFFICINA)?' current ':'' ?>
									<li class="<?=$menuAttivo?> dropdown"><a class="dropdown-toggle" href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/officina.php">Officina <!--<span class="fa fa-caret-down"></span>--></a>
										<!--<ul class="dropdown-menu h-nav">
											<li><a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/officina.php">ANALISI</a></li>
											<li><a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/officina.php">GARANZIA</a></li>
											<li><a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/officina.php">PREPARAZIONE AUTO</a></li>
										</ul>-->
									</li>
									
									<? $menuAttivo=($this->codicePagina==costantiP::CP_COMPRIAMO)?' current ':'' ?>
									<li class="<?=$menuAttivo?>"><a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/comproautobrescia.php">Compriamo la tua auto</a></li>

									<? $menuAttivo=($this->codicePagina==costantiP::CP_MARCHI)?' current ':'' ?>
									<li class="<?=$menuAttivo?>"><a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/autovetture.php">Marchi</a></li>

									<? $menuAttivo=($this->codicePagina==costantiP::CP_CONTATTI)?' current ':'' ?>
									<li class="<?=$menuAttivo?>"><a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/contatti.php">Contatti</a></li>

									<? $menuAttivo=($this->codicePagina==costantiP::CP_TUTTELEAUTO)?' current ':'' ?>
									<li class="icon <?=$menuAttivo?> no-phone"><a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/ricerca.php"><i class="icon-magnifier icon icon-2x"></i><span>Ricerca Auto</span></a></li>

									<li class="icon no-phone"><a href="tel:+39 030 1234567"><i class="icon-phone icon icon-2x"></i><span>030 1234567</span></a></li>
									
									<div class="nav_mobile_box privacy only-mobile"><p><a href="#">Privacy Policy</a> / <a href="#">Utilizzo dei Cookie</a></p></div>
									
									<div class="nav_mobile_box tel only-mobile"><a href="tel:+39 030 1234567"><i class="icon-phone icon icon-4x"></i><span>CLICCA E CHIAMA</span><p class="tel">030 1234567</p></a></div>
									
									<div class="nav_mobile_box map only-mobile"><a href="#"><i class="fa fa-map-marker fa-4x map"></i><span>PORTAMI QUI</span><p>Lorem ipsum dolor<br>25135 Brescia</p></a></div>
									
								</ul>
							</div>
						</div>
					</div>
				</div>
			</nav><!--b-nav-->


			
            
             <?
               }
             ?>
            

        <?    
    }
    
     function Footer()
    {
        ?>
        <!-- FOOTER -->
        
        <footer class="b-footer">
			<a id="to-top" href="#this-is-top"><img src="<?echo costantiP::BASE_URL?>images/top.png"></a>
			<div class="container">
            
				<div class="row pb-md">
					<div class="col-md-4 col-xs-6">
						<div class="b-footer__company">
							<div class="b-nav__logo_footer">
								<h4 class="ml-xlgggg pt-xs
										   "><a href="index.php">AUTOMOTIVE</a></h4>
							</div>
							
						</div>
					</div>
                    <div class="col-md-2 col-sm-3 col-xs-6">
                    	<div class="b-footer__content-orari mt-md">
                        	<p>ORARI<br>LUNED&iacute; - SABATO<br>09:00 - 12:30<br>14:30 - 20:00
						</div>
					</div>
                   
                    <div class="col-md-2 col-sm-3 col-xs-6 mobile-none">
                    	<div class="b-footer__company mt-md">
                            <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/chisiamo.php">CHI SIAMO</a>
							<br>
                            <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/servizi.php">SERVIZI</a>
                            <br>
                            <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/servizi.php#garanzia">ESTENSIONE DI GARANZIA</a>
                            <br>
                            <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/officina.php">OFFICINA</a>
                            <br>
                            
						</div>
					</div>
                   
                    <div class="col-md-2 col-sm-3 col-xs-6 mobile-none">
                    	<div class="b-footer__company mt-md black">
                            <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/comproautobrescia.php">COMPRIAMO LA TUA AUTO</a>
                            <br />
                            <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/autovetture.php">MARCHI</a>
                            <br />
                            <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/contatti.php">CONTATTI</a>
                            <br />
                            <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/ricerca.php">RICERCA AUTO</a>
                    	</div>
					</div>
                    
					<div class="col-md-2 col-sm-3 col-xs-6 mobile-none">
						<div class="b-footer__company mt-md black">
                        	<a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/privacy.php">Privacy Policy</a>
                        	<br>
                        	<a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/cookie.php">Utilizzo dei Cookie</a>
                        	<br>
                        	<a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/FAQ.php">FAQ</a>
						</div>
					</div>
              	</div>
				
				<div class="row mt-xl">
					<div class="nav_mobile_box tel_footer only-mobile">
						<a href="tel:+39 030 1234567"><i class="icon-phone icon icon-4x"></i><span>CLICCA E CHIAMA</span><p class="tel">030 1234567</p></a>
					</div>
				</div>
				
                
            	<div class="row mt-xl">
					<div class="col-md-12">
                    	<div class="col-md-2 col-xs-12 pl-none pr-none b-footer__content-social">
							<a href="#" target="_blank"><i class="fa fa-facebook fa-3x"></i></a>
							<a href="#" target="_blank"><i class="fa fa-instagram fa-3x"></i></a>
							<a href="#" target="_blank"><i class="fa fa-google-plus fa-3x"></i></a>
						</div>	
					
						<div class="col-md-4 col-xs-12 pl-none pr-none b-footer__content-social mobile-none">
                      		<a href="https://www.google.it/maps/place/AUTOUNICA/@45.5470249,10.1616282,16z/data=!4m13!1m7!3m6!1s0x478176c7ea0fbec7:0x4f2c1365d658e69f!2sVia+Valcamonica,+19,+25132+Brescia+BS!3b1!8m2!3d45.5466946!4d10.1667193!3m4!1s0x0:0xec4e9ec3c46050a!8m2!3d45.5471169!4d10.1660872" target="_blank"><i class="fa fa-map-marker fa-3x map"></i></a>
							<div class="b-footer__content-address">
                      			<p>PORTAMI QUI<br>Lorem ipsum dolor<br>25132 Brescia</p>
							</div>	
                        </div>
						
						<div class="col-md-6 col-sm-3 col-xs-12 pl-none pr-xlg b-footer__content-social map only-mobile">
                      		<a href="https://www.google.it/maps/place/AUTOUNICA/@45.5470249,10.1616282,16z/data=!4m13!1m7!3m6!1s0x478176c7ea0fbec7:0x4f2c1365d658e69f!2sVia+Valcamonica,+19,+25132+Brescia+BS!3b1!8m2!3d45.5466946!4d10.1667193!3m4!1s0x0:0xec4e9ec3c46050a!8m2!3d45.5471169!4d10.1660872" target="_blank"><i class="fa fa-map-marker fa-3x map"></i></a>
							<br clear="all">
							<div class="b-footer__content-address">
                      			<p>PORTAMI QUI<br>Lorem ipsum dolor<br>25132 Brescia</p>
							</div>	
                        </div> 
					
                        <div class="col-md-6 col-sm-12 col-xs-12 pl-none pr-none">   
                            <nav class="b-footer__content-copy">
								<p>Copyright Â© 2016 Automotive S.r.l. Tutti i diritti riservati.</p>
                            </nav>
                      	</div>
					</div>
				</div>	
                
			</div>
		</footer><!--b-footer-->
        
        <!--Main-->   
		<script src="<?echo costantiP::BASE_URL?>js/jquery-1.11.3.min.js"></script>
        <script src="<?echo costantiP::BASE_URL?>js/jquery-ui.min.js"></script>
        <script src="<?echo costantiP::BASE_URL?>js/bootstrap.min.js"></script>
		<script src="<?echo costantiP::BASE_URL?>js/modernizr.custom.js"></script>
        
        <script>
		$(window).scroll(function() {
			if ($(this).scrollTop() > 1){  
				$('#headerMenu').addClass("sticky");
				$('.b-nav__logo').addClass("sticky");
				$('.b-nav__list').addClass("sticky");
				$('.navbar-toggle').addClass("sticky");
				$('#headerSearchMenu').addClass("sticky");
				$('.navbar-nav-menu').addClass("sticky");
			}
			else{
				$('#headerMenu').removeClass("sticky");
				$('.b-nav__logo').removeClass("sticky");
				$('.b-nav__list').removeClass("sticky");
				$('.navbar-toggle').removeClass("sticky");
				$('#headerSearchMenu').removeClass("sticky");
				$('.navbar-nav-menu').removeClass("sticky");
			}
		});
		
		$(document).ready(function() {   
            var sideslider = $('[data-toggle=collapse-side]');
            var sel = sideslider.attr('data-target');
            var sel2 = sideslider.attr('data-target-2');
            sideslider.click(function(event){
                $(sel).toggleClass('in');
                $(sel2).toggleClass('out');
            });
            
            // calcolo N veicoli 
            nVeicoli();
        });
		
        
        
		function nVeicoli()
                {
                    $.ajax({
                             
                            type: "GET",
                     
                            url: "ajax-veicoli.php",
                            data: "",
                            dataType: "html",
                            
                            success: function(msg)
                            {
                                $("#nResultVetture").html(msg);//stampa i risultati dentro la seconda select
                            },
                            error: function()
                            {
                            //alert("Chiamata fallita, si prega di riprovare..."); //sempre meglio impostare una callback in caso di fallimento
                            }
                        });
                }
        </script>
        
		<script src="<?echo costantiP::BASE_URL?>assets/rendro-easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
		<script src="<?echo costantiP::BASE_URL?>js/waypoints.min.js"></script>
		<script src="<?echo costantiP::BASE_URL?>js/jquery.easypiechart.min.js"></script>
		<script src="<?echo costantiP::BASE_URL?>js/classie.js"></script>
		
		<!--Chosen Select Costumize-->
		<script src="<?echo costantiP::BASE_URL?>js/chosen.jquery.min.js"></script>
		<script>
			var config = {
			  '.chosen-select'           : {},
			  '.chosen-select-deselect'  : { allow_single_deselect: true },
			  '.chosen-select-no-single' : { disable_search_threshold: 10 },
			  '.chosen-select-no-results': { no_results_text: 'Oops, nothing found!' },
			  '.chosen-select-rtl'       : { rtl: true },
			  '.chosen-select-width'     : { width: '95%' }
			}
			for (var selector in config) {
			  $(selector).chosen(config[selector]);
			}
		</script>


		<!--Owl Carousel-->
		<script src="<?echo costantiP::BASE_URL?>assets/owl-carousel/owl.carousel.min.js"></script>
		<!--bxSlider-->
		<script src="<?echo costantiP::BASE_URL?>assets/bxslider/jquery.bxslider.js"></script>
		<!-- jQuery UI Slider -->
		<script src="<?echo costantiP::BASE_URL?>assets/slider/jquery.ui-slider.js"></script>

		<!--Theme-->
		<script src="<?echo costantiP::BASE_URL?>js/jquery.smooth-scroll.js"></script>
		<script src="<?echo costantiP::BASE_URL?>js/wow.min.js"></script>
		<script src="<?echo costantiP::BASE_URL?>js/jquery.placeholder.min.js"></script>
		<script src="<?echo costantiP::BASE_URL?>js/theme.js"></script>
        
   
        
      <?php
                if(!isset($_COOKIE['eucookie']))
                { ?>
                <div id="eucookielaw" >
                    <p>Questo sito utilizza i "cookie" per facilitare la tua esperienza di navigazione.
                    <a id="removecookie"><strong>Accetta e continua</strong></a> - 
                    <a id="more" href="privacy-policy.php"><strong>Privacy Policy</strong></a>
                    </p>
                </div>
                
            <?php } ?>
            
            
            
            <?php
            if(!isset($_COOKIE['eucookie']))
            { ?>
            <script type="text/javascript">
            function SetCookie(c_name,value,expiredays)
            {
            var exdate=new Date()
            exdate.setDate(exdate.getDate()+expiredays)
            document.cookie=c_name+ "=" +escape(value)+";path=/"+((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
            }
            </script>
            
            <script type="text/javascript">
             if( document.cookie.indexOf("eucookie") ===-1 ){
                    $("#eucookielaw").show();
                    }
                    
                    $("#removecookie").click(function () {
                    SetCookie('eucookie','eucookie',365*10)
                    $("#eucookielaw").remove();
                    });
                </script>
        <?php } ?>  
            
        <!-- /FOOTER -->
        <?
    } 
    
    function ScriptFooter()
    {
        ?>
                
              
        <?
    }


    function codiciMonitoraggioGoogle()
    {
            //analyitcs
        ?>
            
                <!-- Google Tag Manager (noscript) -->
                <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NSRLH26"
                height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
                <!-- End Google Tag Manager (noscript) -->
                
            <script>
                  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
                
                  ga('create', '<?=costanti::CODICE_ANALYTICS?>', 'auto');
                  ga('send', 'pageview');
                
                </script>
        <?
            //monitoraggio web 
        ?>
            <meta name="google-site-verification" content="XXXX" />
        <?
        
    }
    
    function scriptMonitoraggioGoogle()
    {
        ?>
        
            <!-- Google Code per il tag di remarketing -->
            <!--------------------------------------------------
            I tag di remarketing possono non essere associati a informazioni di identificazione personale o inseriti in pagine relative a categorie sensibili. 
            Ulteriori informazioni e istruzioni su come impostare il tag sono disponibili alla pagina: http://google.com/ads/remarketingsetup
            --------------------------------------------------->
            <script type="text/javascript">
            /* <![CDATA[ */
            var google_conversion_id = 922484431;
            var google_custom_params = window.google_tag_params;
            var google_remarketing_only = true;
            /* ]]> */
            </script>
            <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
            
            <div style="display:inline;">
            	<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/922484431/?guid=ON&amp;script=0"/>
            </div>
        	
        <?
    }
    
    function scriptGoogleTag()
    {
        ?>
        
            <!-- Google Tag Manager -->
                <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer','GTM-NSRLH26');</script>
                <!-- End Google Tag Manager -->
               
                

        
        <?
    }

}



function selezionaOccasione()
{
    ?>
    <nav class="" id="headerSearchMenu"> 
    	<div class="container">
    		<div class="row">
				<h2 class="center">SELEZIONA LA TUA OCCASIONE</h2>
				
                <div class="col-xs-12" align="center">
					<form action="ricerca.php">
                        <button type="submit" class="btn m-btn search mt-none" id="nResultVetture"></button>
                    </form>
                    
				</div>
			</div>
		</div>
	</nav>
    <?
}

function moduloContatti($testoMessaggio)
{ 
    ?>	
    
    
			<div id="box-contatti">
            <h1>Richiedi informazioni</h1>
             <div class="form">
                    <form id="ContactForm" method="POST" action="contatti_action.php">
                    
                        <p><b>Nome e Cognome:</b></p>
                        <input class="input-text" type="text" name="nome" id="nome"/>
                        
                        <p><b>Email:</b></p>
                        <input class="input-text" type="text" name="email" id="email"/>
                        
                        <p><b>Telefono:</b></p>
                        <input class="input-text" type="text" name="telefono" id="telefono"  />
                        
                        <p><b>Messaggio:</b></p>
                        <textarea name="messaggio" id="messaggio" cols="30" rows="10" class="input-text" style="height:150px">Buongiorno, vi scrivo per chiedervi maggiori informazioni in merito alle calzature: <?=chr(13).chr(13).$testoMessaggio.chr(13).chr(13)?>Cordialmente</textarea>
				
                        <br clear="all" />
                        <br clear="all" />
                        <br clear="all" />
        
                        
                        <p><a id="inline" href="#privacy">Leggi informativa sulla Privacy</a></p>
                        
                        
                        <div style="display:none"><div id="privacy"><h3>Informativa sulla Privacy</h3><p>Ai sensi del D. Lgs. 196/03, i dati raccolti verranno utilizzati esclusivamente per informare periodicamente in merito alle attivitÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â  ed alle iniziative di <b><?=costantiP::RAGIONE_SOCIALE?></b> e non verranno diffusi a terzi.
                        <br /><br />
                        Il conferimento dei dati ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¨ facoltativo, tuttavia senza riferimenti personali non sarÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â  possibile fornire i servizi richiesti. L'interessato puÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â² esercitare i diritti di cui all'art. 7 del D. Lgs. 196/03. Il titolare del trattamento dati ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¨ <b><?=costantiP::RAGIONE_SOCIALE?></b></p></div></div>
        
                        <p style="margin-top:7px;"><input name="" type="checkbox" value="" checked /> Acconsento</p>
                        
                        <script type="text/javascript">
                        document.getElementById('nome').value=contattiNome;
                        </script>
                        
                        
                        <a href="#" class="link1" onClick="spedisci()"><div class="button"><span>Invia richiesta</span></div></a>
                    
                    </form>
                </div> <!--close box form-->
                </div>
    
    
    <?
    
    
}




function estraiVeicoli($prezzo, $carrozzeria, $cambio, $benzina, $diesel, $gpl, $metano, $elettrica, $ibrida, $marca, $modello, $neopatentati, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina,  $start, $limit2)
{
    $where='';
    
    if ($prezzo>0)
    {
        
        switch ($prezzo) {
            case 1:
                $where=' and prezzo < 5000';
                break;
            case 2:
                $where=' and prezzo BETWEEN 5000 AND 10000';
                break;
            case 3:
                $where=' and prezzo BETWEEN 10000 AND 15000';
                break;
            case 4:
                $where=' and prezzo > 15000';
                break;
        }
    }
    
    if ($carrozzeria!='')
        $where .=' and body = "'.$carrozzeria.'"';
    
    if ($cambio!='')
            {
            switch ($cambio) {
                case 1:
                    $where .=' and gearbox = "Automatico"';
                    break;
                case 2:
                    $where .=' and gearbox = "Manuale"';
                    break;
            }
        }     
    
   
    if ($benzina==true || $diesel==true || $gpl==true ||  $metano==true ||  $elettrica==true ||  $ibrida==true)
        {
            $where2 =' alimentazione = -1';
            if ($benzina==true)
                $where2 .=' or alimentazione = 1';
            if ($diesel==true)
                $where2 .=' or alimentazione = 2';
            if ($gpl==true)
                $where2 .=' or alimentazione = 4';
            if ($metano==true)
                $where2 .=' or alimentazione = 5';
            if ($elettrica==true)
                $where2 .=' or alimentazione = 6';
            if ($ibrida==true)
                $where2 .=' or alimentazione = 3';
           $where .= ' and ('.$where2.')';
        }
        
      if ($marca!='')
        $where .=' and make = "'.$marca.'"';  
        
       if ($modello=='-1')
        $modello = ''; 
      if ($modello!='')
        $where .=' and model = "'.$modello.'"';  
          
      if ($neopatentati==1)
            $where = 'and neopatentati = 1';
      
      /*paginazione*/
      $limit='';
        
        /*if ($nContenutiDaEstrarre>0)
            $limit = ' limit 0,'.$nContenutiDaEstrarre;
        else
        {
            if ($pagina>0)
                $limit=' limit '.(($pagina-1)*$numeroRecordPerPagina).','.$numeroRecordPerPagina;
                //$limit=' limit '.(($this->pagina-1)*costantiP::NUMERO_RECORD_PAGINA_SMALL).','.costantiP::NUMERO_RECORD_PAGINA_SMALL;
        }    
        */
        $limit = 'limit '.$start.', '.$limit2; 
       
        $sql = 'select                         
                    count(*) as numero
                from 
                    veicoli
                 where
                   veicoli.pubblicato = 1 '.$where;
        echo $sql;
       $numero = GetFieldValue($sql, 'numero');
       //$stringaPaginazione =  paginaz($numero,$pagina,'',$numeroRecordPerPagina);
        
      
      /* fine paginazione*/
      
      
        
      $elencoAuto = array();
                            $query = "select 
                                        veicoli.id, 
                                        veicoli.make,
                                        veicoli.model,
                                        veicoli.version,
                                        veicoli.img,
                                        veicoli.km,  
                                        veicoli.registration_date, 
                                        veicoli.alimentazione, 
                                        veicoli.kwatt, 
                                        veicoli.gearbox, 
                                        veicoli.colore, 
                                        veicoli.interni, 
                                        veicoli.prezzo
                                        from 
                                            veicoli 
                                        where
                                            veicoli.pubblicato = 1 $where
                                        order by 
                                            veicoli.prezzo desc $limit";
                            //echo $query;                
                            $result=mysql_query($query);
                           	
                            while ($row=mysql_fetch_assoc($result)) {
                    			$vettura['id']=$row['id'];
                    			$vettura['make']=$row['make'];
                                $vettura['model']=$row['model'];
                                $vettura['version']=$row['version'];
                                $vettura['img']=$row['img'];
                                $vettura['km']=$row['km'];
                                $vettura['registration_date']=$row['registration_date'];
                                $vettura['alimentazione']=fuelDecode($row['alimentazione']);
                                $vettura['kwatt']=$row['kwatt'];
                                $vettura['gearbox']=$row['gearbox'];
                                $vettura['colore']=$row['colore'];
                                $vettura['interni']=$row['interni'];
                                $vettura['prezzo']=$row['prezzo'];
                                $elencoAuto[]=$vettura;
                               
                            }
    
    return $elencoAuto;
}


//NUOVA FUNZIONE DI ESTRAZIONE DEI VEICOLI
//qui usiamo idMarca e idModello incrociando le rispettive tabelle senza piÃ¹ fare la ricerca testuale
function estraiVeicoli2($prezzo, $prezzoDa, $prezzoA, $carrozzeria, $cambio, $benzina, $diesel, $gpl, $metano, $elettrica, $ibrida, $marca, $modello, $neopatentati, $citycar, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina,  $start, $limit2,$debug='0')
{
    $where='';
    
    /*if ($prezzo>0)
    {
        
        switch ($prezzo) {
            case 1:
                $where=' and prezzo < 5000';
                break;
            case 2:
                $where=' and prezzo BETWEEN 5000 AND 10000';
                break;
            case 3:
                $where=' and prezzo BETWEEN 10000 AND 15000';
                break;
            case 4:
                $where=' and prezzo > 15000';
                break;
        }
    }*/
    
    if ($prezzoDa>0 && $prezzoA>0)
    {
       $where .=' and prezzo BETWEEN '.$prezzoDa.' AND '.$prezzoA;
    }
    
    if ($prezzoA>0 && $prezzoDa=='')
    {
       $where .=' and prezzo <= '.$prezzoA;
    }
    
    if ($prezzoDa>0 && $prezzoA=='')
    {
       $where .=' and prezzo >= '.$prezzoDa;
    }
    
    if ($carrozzeria!='')
        $where .=' and body = "'.$carrozzeria.'"';
    
    if ($cambio!='')
            {
            switch ($cambio) {
                case 1:
                    $where .=' and gearbox = "Automatico"';
                    break;
                case 2:
                    $where .=' and gearbox = "Manuale"';
                    break;
            }
        }     
    
   
    if ($benzina==true || $diesel==true || $gpl==true ||  $metano==true ||  $elettrica==true ||  $ibrida==true)
        {
            $where2 =' alimentazione = -1';
            if ($benzina==true)
                $where2 .=' or alimentazione = 1';
            if ($diesel==true)
                $where2 .=' or alimentazione = 2';
            if ($gpl==true)
                $where2 .=' or alimentazione = 4';
            if ($metano==true)
                $where2 .=' or alimentazione = 5';
            if ($elettrica==true)
                $where2 .=' or alimentazione = 6';
            if ($ibrida==true)
                $where2 .=' or alimentazione = 3';
           $where .= ' and ('.$where2.')';
        }
        
      if ($marca!='')
        $where .=' and id_marca = "'.$marca.'"';  
        
       if ($modello=='-1')
        $modello = ''; 
      if ($modello!='')
        $where .=' and id_modello = "'.$modello.'"';  
          
      if ($neopatentati==1)
            $where = 'and neopatentati = 1';
      
      if ($citycar==1)
            $where = 'and weight <= 1400 and cc <= 1600';
      
      /*paginazione*/
      $limit='';
        
        if ($nContenutiDaEstrarre>0)
            $limit = ' limit 0,'.$nContenutiDaEstrarre;
        else
        {
            if ($pagina>0)
                $limit=' limit '.(($pagina-1)*$numeroRecordPerPagina).','.$numeroRecordPerPagina;
                //$limit=' limit '.(($this->pagina-1)*costantiP::NUMERO_RECORD_PAGINA_SMALL).','.costantiP::NUMERO_RECORD_PAGINA_SMALL;
        }    
        
        //$limit = 'limit '.$start.', '.$limit2; 
      
        $sql = 'select                         
                    count(*) as numero
                from 
                    veicoli
                 where
                   veicoli.pubblicato = 1 '.$where;
       
       $numero = GetFieldValue($sql, 'numero');
       //$stringaPaginazione =  paginaz($numero,$pagina,'',$numeroRecordPerPagina);
        
      
      /* fine paginazione*/
      
      
        
      $elencoAuto = array();
                            $query = "select 
                                        veicoli.id, 
                                        veicoli.make,
                                        veicoli.model,
                                        veicoli.version,
                                        veicoli.img,
                                        veicoli.km,  
                                        veicoli.registration_date, 
                                        veicoli.alimentazione, 
                                        veicoli.kwatt, 
                                        veicoli.gearbox, 
                                        veicoli.colore, 
                                        veicoli.interni,
                                        veicoli.telaio,
                                        veicoli.neopatentati, 
                                        veicoli.prezzo
                                        from 
                                            veicoli 
                                        where
                                            veicoli.pubblicato = 1 $where
                                        order by 
                                            veicoli.prezzo desc $limit";
                            
                            //if($debug==1)
                                //echo $query;                
                            
                            $result=mysql_query($query);
                           	
                            while ($row=mysql_fetch_assoc($result)) {
                    			$vettura['id']=$row['id'];
                    			$vettura['make']=$row['make'];
                                $vettura['model']=$row['model'];
                                $vettura['version']=$row['version'];
                                $vettura['img']=$row['img'];
                                $vettura['km']=$row['km'];
                                $vettura['registration_date']=$row['registration_date'];
                                $vettura['alimentazione']=fuelDecode($row['alimentazione']);
                                $vettura['alimentazioneCodice']=$row['alimentazione'];
                                $vettura['kwatt']=$row['kwatt'];
                                $vettura['gearbox']=$row['gearbox'];
                                $vettura['colore']=$row['colore'];
                                $vettura['interni']=$row['interni'];
                                $vettura['telaio']=$row['telaio'];
                                $vettura['prezzo']=$row['prezzo'];
                                $vettura['neopatentati']=$row['neopatentati'];
                                $elencoAuto[]=$vettura;
                               
                            }
    
    return array($elencoAuto,$numero);
}

function estraiVeicoli_2018($marca, $modello, $carrozzeria, $annoA, $annoDa, $prezzoDa,  $prezzoA, $carburante, $kmDa, $kmA, $potenza, $potenzaDa, $potenzaA, $neopatentati, $cambio, $nPorte, $nPostiDa, $nPostiA, $abs, $cruise, $clima, $fari, $classeEmissioni, $citycar,  $ecologic, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina,$start, $limit, $debug='0')
{
    $where='';
    $join='';
    
    if ($marca!='')
        $where .=' and id_marca = "'.$marca.'"';  
        
       if ($modello=='-1')
        $modello = ''; 
      if ($modello!='')
        $where .=' and id_modello = "'.$modello.'"';  
        
    if ($carrozzeria!='')
        $where .=' and body = "'.$carrozzeria.'"';
        
        
    if ($annoDa>0 && $annoA>0)
    {
       $where .=' and registration_date BETWEEN "'.$annoDa.'-01-01" AND "'.$annoA.'-12-31"';
    }
    
    if ($annoA>0 && $annoDa=='')
    {
       $where .=' and registration_date <= "'.$annoA.'-12-31"';
    }
    
    if ($annoDa>0 && $annoA=='')
    {
       $where .=' and registration_date >= "'.$annoDa.'-01-01"';
    }
    
    /*if ($prezzo>0)
    {
        
        switch ($prezzo) {
            case 1:
                $where=' and prezzo < 5000';
                break;
            case 2:
                $where=' and prezzo BETWEEN 5000 AND 10000';
                break;
            case 3:
                $where=' and prezzo BETWEEN 10000 AND 15000';
                break;
            case 4:
                $where=' and prezzo > 15000';
                break;
        }
    }*/
    
    if ($prezzoDa>0 && $prezzoA>0)
    {
       $where .=' and prezzo BETWEEN '.$prezzoDa.' AND '.$prezzoA;
    }
    
    if ($prezzoA>0 && $prezzoDa=='')
    {
       $where .=' and prezzo <= '.$prezzoA;
    }
    
    if ($prezzoDa>0 && $prezzoA=='')
    {
       $where .=' and prezzo >= '.$prezzoDa;
    }
    
    //+++++++++++++++ CARBURANTE ++++++++++++++++++++++++
    if ($carburante>0)
            {
                $where .=' and alimentazione = '.$carburante;
            }  
    
    //+++++++++++++++ KM ++++++++++++++++++++++++    
    if ($kmDa>0 && $kmA>0)
    {
       $where .=' and km BETWEEN '.$kmDa.' AND '.$kmA;
    }
    
    if ($kmA>0 && $kmDa=='')
    {
       $where .=' and km <= '.$kmA;
    }
    
    if ($kmDa>0 && $kmA=='')
    {
       $where .=' and km >= '.$kmDa;
    }
    //+++++++++++++++ POTENZA ++++++++++++++++++++++++  
      if ($potenza!='')
            {
            switch ($potenza) {
                case 'KW':
                    //silence is golden
                    break;
                case 'CV':
                    $potenzaDa = round($potenzaDa/1.35962);
                    $potenzaA = round($potenzaA/1.35962);
                    break;
            }
            
            if ($potenzaDa>0 && $potenzaA>0)
                {
                   $where .=' and kwatt BETWEEN '.$potenzaDa.' AND '.$kmA;
                }
                
                if ($potenzaA>0 && $potenzaDa=='')
                {
                   $where .=' and kwatt <= '.$potenzaA;
                }
                
                if ($potenzaDa>0 && $potenzaA=='')
                {
                   $where .=' and kwatt >= '.$potenzaDa;
                }
        }   
    //+++++++++++++++ NEOPATENTATI ++++++++++++++++++++++++  
     if ($neopatentati!='')
            $where .= 'and neopatentati = 1';
      
    //+++++++++++++++ CITYCAR ++++++++++++++++++++++++  
    if ($citycar==1)
            $where .= 'and weight <= 1400 and cc <= 1600';
    //+++++++++++++++ NEOPATENATI ++++++++++++++++++++++++          
            
    if ($cambio!='')
            {
            switch ($cambio) {
                case 1:
                    $where .=' and gearbox = "Automatico"';
                    break;
                case 2:
                    $where .=' and gearbox = "Manuale"';
                    break;
                case 3:
                    $where .=' and gearbox = "Sequenziale"';
                    break;
            }
        }     
      
 
      //++++++++++++++ nPorte +++++++++++++++++++++++++++
        if ($nPorte > 1)
            {
                switch ($nPorte) {
                        case 2:
                            $where .=' and doors IN ("2","3")';
                            break;
                        case 3:
                            $where .=' and doors IN ("4","5")';
                            break;
                        case 4:
                            $where .=' and doors > "6" ';
                            break;
                    }
            }   
     
      //+++++++++++++++ ECOLOGIC ++++++++++++++++++++++++  
    if ($ecologic==1)
            $where = 'and alimentazione IN ("3","4","5","6")';
      
      //+++++++++++++++ POSTI ++++++++++++++++++++++++    
            if ($nPostiDa>0 && $nPostiA>0)
            {
               $where .=' and seats BETWEEN '.$nPostiDa.' AND '.$nPostiA;
            }
            
            if ($nPostiA>0 && $nPostiDa=='')
            {
               $where .=' and seats <= '.$nPostiA;
            }
            
            if ($nPostiDa>0 && $nPostiA=='')
            {
               $where .=' and seats >= '.$nPostiDa;
            }
       
       $arrayEquipaggiamenti = array();
       //+++++++++++++++ ABS ++++++++++++++++++++++++    
        if ($abs!='')
            {
                $select = "SELECT id_veicolo FROM optional WHERE titolo LIKE '%ABS'";
                $result=mysql_query($select);                
                $absArray = array();
                while(($row =  mysql_fetch_assoc($result))) {
                        $absArray[] = $row['id_veicolo'];
                    }
                if( is_array($absArray) )
                    $arrayEquipaggiamenti = $absArray;
            }
            
        //+++++++++++++++ CRUISE ++++++++++++++++++++++++    
        if ($cruise!='')
            {
                $select = "SELECT id_veicolo FROM optional WHERE titolo LIKE '%Cruise Control'";
                $result=mysql_query($select);                
                $cruiseArray = array();
                while(($row =  mysql_fetch_assoc($result))) {
                        $cruiseArray[] = $row['id_veicolo'];
                        }
                if( is_array($cruiseArray) && !empty($arrayEquipaggiamenti) )
                    {
                        $arrayEquipaggiamenti = doppi($cruiseArray,$arrayEquipaggiamenti);
                    }
                else
                    {
                        $arrayEquipaggiamenti = $cruiseArray;
                    } 
             }
            
      //+++++++++++++++ CLIMA ++++++++++++++++++++++++    
        if ($clima!='')
            {
                $select = "SELECT id_veicolo FROM optional WHERE titolo LIKE '%Climatizzatore'";
                $result=mysql_query($select);                
                $climaArray = array();
                while(($row =  mysql_fetch_assoc($result))) {
                        $climaArray[] = $row['id_veicolo'];
                        }
                
                if( is_array($climaArray) && !empty($arrayEquipaggiamenti) )
                    {
                        $arrayEquipaggiamenti = doppi($climaArray,$arrayEquipaggiamenti);
                    }
                else
                    {
                        $arrayEquipaggiamenti = $climaArray;
                    }        
                        
            }
            
//++++++++++++++++++++ FARI LED ++++++++++++++++++++++++    
        if ($fari!='')
            {
               
                $select = "SELECT id_veicolo FROM optional WHERE titolo LIKE '%Fari LED'";
                $result=mysql_query($select);                
                $fariArray = array();
                while(($row =  mysql_fetch_assoc($result))) {
                        $fariArray[] = $row['id_veicolo'];
                        }
                if( is_array($fariArray) && !empty($arrayEquipaggiamenti) )
                    {
                        $arrayEquipaggiamenti = doppi($fariArray,$arrayEquipaggiamenti);
                    }
                else
                    {
                        $arrayEquipaggiamenti = $fariArray;
                    } 
                
            }
       
//++++++++++++++++++++ ARRAY EQUIPAGGIAMENTI ++++++++++++++++++++++++   
       if (!empty($arrayEquipaggiamenti))
       {
        $string = implode(',',$arrayEquipaggiamenti);
        $where .= ' and veicoli.id IN ('.$string.')';
       }
       
 //++++++++++++++++++++ CLASSE EMISSIONI ++++++++++++++++++++++++           
        if ($classeEmissioni!='')
            $where .= ' and emission_class = "'.$classeEmissioni.'"';
        
              
      /*paginazione*/
      //$limit='';
        
        /*if ($nContenutiDaEstrarre>0)
            $limit = ' limit 0,'.$nContenutiDaEstrarre;
        else
        {
            if ($pagina>0)
                $limit=' limit '.(($pagina-1)*$numeroRecordPerPagina).','.$numeroRecordPerPagina;
                //$limit=' limit '.(($this->pagina-1)*costantiP::NUMERO_RECORD_PAGINA_SMALL).','.costantiP::NUMERO_RECORD_PAGINA_SMALL;
        }    
        */

        
        $limit = 'limit '.$start.', '.$limit; 
      
        $sql = 'select                         
                    count(*) as numero
                from 
                    veicoli
                    '.$join.'
                 where
                   veicoli.pubblicato = 1 '.$where;
       
       $numero = GetFieldValue($sql, 'numero');
       //$stringaPaginazione =  paginaz($numero,$pagina,'',$numeroRecordPerPagina);
        
      
      /* fine paginazione*/
      
      
        
      $elencoAuto = array();
                            $query = "select 
                                        veicoli.id, 
                                        veicoli.make,
                                        veicoli.model,
                                        veicoli.version,
                                        veicoli.img,
                                        veicoli.km,  
                                        veicoli.registration_date, 
                                        veicoli.alimentazione, 
                                        veicoli.kwatt, 
                                        veicoli.gearbox, 
                                        veicoli.colore, 
                                        veicoli.interni,
                                        veicoli.telaio,
                                        veicoli.neopatentati, 
                                        veicoli.prezzo
                                        from 
                                            veicoli 
                                        $join 
                                        where
                                            veicoli.pubblicato = 1 $where
                                        order by 
                                            veicoli.prezzo desc $limit";
                            
                            //if($debug==1)
                                //echo $query;                
                            
                            $result=mysql_query($query);
                           	
                            while ($row=mysql_fetch_assoc($result)) {
                    			$vettura['id']=$row['id'];
                    			$vettura['make']=$row['make'];
                                $vettura['model']=$row['model'];
                                $vettura['version']=$row['version'];
                                $vettura['img']=$row['img'];
                                $vettura['km']=$row['km'];
                                $vettura['registration_date']=$row['registration_date'];
                                $vettura['alimentazione']=fuelDecode($row['alimentazione']);
                                $vettura['alimentazioneCodice']=$row['alimentazione'];
                                $vettura['kwatt']=$row['kwatt'];
                                $vettura['gearbox']=$row['gearbox'];
                                $vettura['colore']=$row['colore'];
                                $vettura['interni']=$row['interni'];
                                $vettura['telaio']=$row['telaio'];
                                $vettura['prezzo']=$row['prezzo'];
                                $vettura['neopatentati']=$row['neopatentati'];
                                $elencoAuto[]=$vettura;
                               
                            }
    
    return array($elencoAuto,$numero);
}














//NUOVA FUNZIONE DI ESTRAZIONE DEI VEICOLI
//qui usiamo idMarca e idModello incrociando le rispettive tabelle senza piÃ¹ fare la ricerca testuale
//function estraiVeicoliSimili($prezzo, $prezzoDa, $prezzoA, $carrozzeria, $cambio, $benzina, $diesel, $gpl, $metano, $elettrica, $ibrida, $marca, $modello, $neopatentati, $citycar, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina,  $start, $limit2,$debug='0')
function estraiVeicoliSimili($prezzoDa, $prezzoA, $carrozzeria, $cambio, $carburante, $citycar, $neopatentati, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina,$start,$limit, $debug='0')                   
{
    $where='';
    
    /*if ($prezzo>0)
    {
        
        switch ($prezzo) {
            case 1:
                $where=' and prezzo < 10000'; //alzo range prezzo
                break;
            case 2:
                $where=' and prezzo BETWEEN 5000 AND 15000'; //alzo range prezzo
                break;
            case 3:
                $where=' and prezzo BETWEEN 10000 AND 20000'; //alzo range prezzo
                break;
            case 4:
                $where=' and prezzo > 10000'; //abbasso range prezzo
                break;
        }
    }*/
    
    if ($prezzoA>0)
    {
        $prezzoA = $prezzoA*1.3;
        $where .=' and prezzo <= '.$prezzoA; //alzo range prezzo
    }
    
    
    if ($carrozzeria!='')
        $where .=' and body = "'.$carrozzeria.'"';
    
    if ($cambio!='')
            {
            switch ($cambio) {
                case 1:
                    $where .=' and gearbox = "Automatico"';
                    break;
                case 2:
                    $where .=' and gearbox = "Manuale"';
                    break;
                case 3:
                    $where .=' and gearbox = "Sequenziale"';
                    break;
            }
        }     
    
   
    if ($carburante>0)
            {
                $where .=' and alimentazione = '.$carburante;
            }  
        
      /*
      if ($marca!='')
        $where .=' and id_marca = "'.$marca.'"';  
       
       if ($modello=='-1')
        $modello = ''; 
      if ($modello!='')
        $where .=' and id_modello = "'.$modello.'"';  
      */     
      if ($neopatentati==1)
            $where = 'and neopatentati = 1';
      
      if ($citycar==1)
            $where = 'and weight <= 1400 and cc <= 1600';
      
      
      /*paginazione*/
      $limit='';
        
        if ($nContenutiDaEstrarre>0)
            $limit = ' limit 0,'.$nContenutiDaEstrarre;
        else
        {
            if ($pagina>0)
                $limit=' limit '.(($pagina-1)*$numeroRecordPerPagina).','.$numeroRecordPerPagina;
                //$limit=' limit '.(($this->pagina-1)*costantiP::NUMERO_RECORD_PAGINA_SMALL).','.costantiP::NUMERO_RECORD_PAGINA_SMALL;
        }    
        
        //$limit = 'limit '.$start.', '.$limit2; 
      
        $sql = 'select                         
                    count(*) as numero
                from 
                    veicoli
                 where
                   veicoli.pubblicato = 1 '.$where;
       
       
       $numero = GetFieldValue($sql, 'numero');
       //$stringaPaginazione =  paginaz($numero,$pagina,'',$numeroRecordPerPagina);
        
      
      /* fine paginazione*/
      
      
        
      $elencoAuto = array();
                            $query = "select 
                                        veicoli.id, 
                                        veicoli.make,
                                        veicoli.model,
                                        veicoli.version,
                                        veicoli.img,
                                        veicoli.km,  
                                        veicoli.registration_date, 
                                        veicoli.alimentazione, 
                                        veicoli.kwatt, 
                                        veicoli.gearbox, 
                                        veicoli.colore, 
                                        veicoli.interni,
                                        veicoli.telaio,
                                        veicoli.neopatentati, 
                                        veicoli.prezzo
                                        from 
                                            veicoli 
                                        where
                                            veicoli.pubblicato = 1 $where
                                        order by 
                                            veicoli.prezzo desc $limit";
                            
                            //if($debug==1)
                                //echo $query;                
                            
                            $result=mysql_query($query);
                           	
                            while ($row=mysql_fetch_assoc($result)) {
                    			$vettura['id']=$row['id'];
                    			$vettura['make']=$row['make'];
                                $vettura['model']=$row['model'];
                                $vettura['version']=$row['version'];
                                $vettura['img']=$row['img'];
                                $vettura['km']=$row['km'];
                                $vettura['registration_date']=$row['registration_date'];
                                $vettura['alimentazione']=fuelDecode($row['alimentazione']);
                                $vettura['alimentazioneCodice']=$row['alimentazione'];
                                $vettura['kwatt']=$row['kwatt'];
                                $vettura['gearbox']=$row['gearbox'];
                                $vettura['colore']=$row['colore'];
                                $vettura['interni']=$row['interni'];
                                $vettura['telaio']=$row['telaio'];
                                $vettura['prezzo']=$row['prezzo'];
                                $vettura['neopatentati']=$row['neopatentati'];
                                $elencoAuto[]=$vettura;
                               
                            }
    
    return $elencoAuto;
}

function estraiVeicoliSuggeriti($idVeicolo, $prezzoDa, $prezzoA, $carrozzeria, $cambio, $carburante, $citycar, $neopatentati, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina,$start,$limit, $debug='0')                   
{
    $where='';
    
    /*if ($prezzo>0)
    {
        
        switch ($prezzo) {
            case 1:
                $where=' and prezzo < 10000'; //alzo range prezzo
                break;
            case 2:
                $where=' and prezzo BETWEEN 5000 AND 15000'; //alzo range prezzo
                break;
            case 3:
                $where=' and prezzo BETWEEN 10000 AND 20000'; //alzo range prezzo
                break;
            case 4:
                $where=' and prezzo > 10000'; //abbasso range prezzo
                break;
        }
    }*/
    if ($prezzoDa>0)
    {
        $prezzoDa = $prezzoDa*0.8;
        $prezzoA = $prezzoA*1.3;
        $where .=' and prezzo BETWEEN '.$prezzoDa.' AND '.$prezzoA; //alzo range prezzo
    }
    
    
    
    
    
    if ($carrozzeria!='')
        $where .=' and body = "'.$carrozzeria.'"';
    
    if ($cambio!='')
            {
            switch ($cambio) {
                case 1:
                    $where .=' and gearbox = "Automatico"';
                    break;
                case 2:
                    $where .=' and gearbox = "Manuale"';
                    break;
                case 3:
                    $where .=' and gearbox = "Sequenziale"';
                    break;
            }
        }     
    
   
    if ($carburante>0)
            {
                $where .=' and alimentazione = '.$carburante;
            }  
        
      /*
      if ($marca!='')
        $where .=' and id_marca = "'.$marca.'"';  
       
       if ($modello=='-1')
        $modello = ''; 
      if ($modello!='')
        $where .=' and id_modello = "'.$modello.'"';  
      */     
      if ($neopatentati==1)
            $where = 'and neopatentati = 1';
      
      if ($citycar==1)
            $where = 'and weight <= 1400 and cc <= 1600';
      
      $where .=' and id != '.$idVeicolo;
      
      /*paginazione*/
      $limit='';
        
        if ($nContenutiDaEstrarre>0)
            $limit = ' limit 0,'.$nContenutiDaEstrarre;
        else
        {
            if ($pagina>0)
                $limit=' limit '.(($pagina-1)*$numeroRecordPerPagina).','.$numeroRecordPerPagina;
                //$limit=' limit '.(($this->pagina-1)*costantiP::NUMERO_RECORD_PAGINA_SMALL).','.costantiP::NUMERO_RECORD_PAGINA_SMALL;
        }    
        
        //$limit = 'limit '.$start.', '.$limit2; 
      
      $elencoAuto = array();
                            $query = "select 
                                        veicoli.id, 
                                        veicoli.make,
                                        veicoli.model,
                                        veicoli.version,
                                        veicoli.img,
                                        veicoli.km,  
                                        veicoli.registration_date, 
                                        veicoli.alimentazione, 
                                        veicoli.kwatt, 
                                        veicoli.gearbox, 
                                        veicoli.colore, 
                                        veicoli.interni,
                                        veicoli.telaio,
                                        veicoli.neopatentati, 
                                        veicoli.prezzo
                                        from 
                                            veicoli 
                                        where
                                            veicoli.pubblicato = 1 $where
                                        order by 
                                            rand() $limit";
                            
                            //if($debug==1)
                                //echo $query;                
                            
                            $result=mysql_query($query);
                           	
                            while ($row=mysql_fetch_assoc($result)) {
                    			$vettura['id']=$row['id'];
                    			$vettura['make']=$row['make'];
                                $vettura['model']=$row['model'];
                                $vettura['version']=$row['version'];
                                $vettura['img']=$row['img'];
                                $vettura['km']=$row['km'];
                                $vettura['registration_date']=$row['registration_date'];
                                $vettura['alimentazione']=fuelDecode($row['alimentazione']);
                                $vettura['alimentazioneCodice']=$row['alimentazione'];
                                $vettura['kwatt']=$row['kwatt'];
                                $vettura['gearbox']=$row['gearbox'];
                                $vettura['colore']=$row['colore'];
                                $vettura['interni']=$row['interni'];
                                $vettura['telaio']=$row['telaio'];
                                $vettura['prezzo']=$row['prezzo'];
                                $vettura['neopatentati']=$row['neopatentati'];
                                $elencoAuto[]=$vettura;
                               
                            }
    
    return $elencoAuto;
}


function boxFondoPagina()
{
    $box = array('1','2','3','4','5','6');
    $box2 = array_rand($box, 2);
    shuffle($box2);
    foreach($box2 as $value)
    {
        switch ($value){
            
            case 0:
            ?>
             <section class="b-featured assicurati">
    			<div class="container">
    				<h1 class="mb-none mt-none" data--delay="0.3s">ASSICURATI</h1>
                    <h1 class="mb-none mt-none" data--delay="0.3s">LA GUIDA</h1>
                    <h3 class="mb-none mt-none" data--delay="0.3s">LA NOSTRA ASSICURAZIONE</h3>
                    <br /><br />
                    <!--<div class="link"><a href="">SCOPRI DI PIÃƒÂ¹ ></a></div>-->
        			</div>
    		</section><!--b-featured-->
            <?
            break;
            case 1:
            ?>
             <section class="b-featured passioni">
    			<div class="container">
    				<h1 class="mb-none mt-none" data--delay="0.3s">CONTINUA</h1>
                    <h1 class="mb-none mt-none" data--delay="0.3s">LE TUE PASSIONI</h1>
                    <h3 class="mb-none mt-none" data--delay="0.3s">I NOSTRI FINANZIAMENTI A TASSO AGEVOLATO</h3>
                    <br /><br />
                    <!--<div class="link"><a href="">SCOPRI DI PIÃƒÂ¹ ></a></div>-->
    			</div>
    		</section><!--b-featured-->
            <?
            break;
            case 2:
            ?>
             <section class="b-featured serenita">
    			<div class="container">
    				<h1 class="mb-none mt-none" data--delay="0.3s">IL 100% DELLA</h1>
                    <h1 class="mb-none mt-none" data--delay="0.3s">TUA SERENITA'Â </h1>
                    <h3 class="mb-none mt-none" data--delay="0.3s">CON L'ESTENSIONE DI GARANZIA</h3>
                    <br /><br />
                    <!--<div class="link"><a href="">SCOPRI DI PIÃƒÂ¹ ></a></div>-->
    			</div>
    		</section><!--b-featured-->
            <?
            break;
            case 3:
            ?>
             <section class="b-featured caffe">
    			<div class="container">
    				<h1 class="mb-none mt-none" data--delay="0.3s">LA TUA AUTO,</h1>
                    <h1 class="mb-none mt-none" data--delay="0.3s">UNA SCELTA IMPORTANTE</h1>
                    <h3 class="mb-none mt-none" data--delay="0.3s">BEVIAMO UN CAFFÃˆ INSIEME E RAGIONIAMOCI</h3>
                    <br /><br />
                    <!--<div class="link"><a href="">SCOPRI DI PIÃƒÂ¹ ></a></div>-->
    			</div>
    		</section><!--b-featured-->
            <?
            break;
            case 4:
            ?>
             <section class="b-featured autenticita">
    			<div class="container">
    				<h1 class="mb-none mt-none" data--delay="0.3s">UNA STORIA AUTENTICA</h1>
                    <h1 class="mb-none mt-none" data--delay="0.3s">DA RACCONTARE</h1>
                    <h3 class="mb-none mt-none" data--delay="0.3s">LA CERTIFICAZIONE KILOMETRICA AUTOUNICA</h3>
                    <br /><br />
                    <!--<div class="link"><a href="">SCOPRI DI PIÃƒÂ¹ ></a></div>-->
    			</div>
    		</section><!--b-featured-->
            <?
            break;
            case 5:
            ?>
             <section class="b-featured viaggia">
    			<div class="container">
    				<h1 class="mb-none mt-none" data--delay="0.3s">UNA STORIA AUTENTICA</h1>
                    <h1 class="mb-none mt-none" data--delay="0.3s">DA RACCONTARE</h1>
                    <h3 class="mb-none mt-none" data--delay="0.3s">LA CERTIFICAZIONE KILOMETRICA AUTOMOTIVE</h3>
                    <br /><br />
                    <!--<div class="link"><a href="">SCOPRI DI PIÃƒÂ¹ ></a></div>-->
    			</div>
    		</section><!--b-featured-->
            <?
            break;
        }
    }
    
    ?>
    
    
    <?
}

function getArrayAnni()
{
    $sql = 'select MIN(registration_date) from veicoli';
    $annoDa = getFieldValue($sql,'MIN(registration_date)');
    $annoDa = estraiAnno($annoDa);
    echo $annoDa;
    
    $sql2 = 'select MAX(registration_date) from veicoli';
    $annoA = getFieldValue($sql2,'MAX(registration_date)');
    $annoA = estraiAnno($annoA);
    
    $anni = array();
    for($i=$annoDa;$i<=$annoA;$i++)
    {
        $anni[] = $i;
    }
    //$anni = array($annoDa,$annoA);

    return $anni;
}

function preFooter()
	{	
		?>
			<section class="b-count__service pt-none">
				<div class="row">
					<div class="col-md-2 col-sm-4 col-xs-12 mb-xxl">
                        <div class="b-count__service__item j-last">
                            <img src="<?echo costantiP::BASE_URL?>images/icon-home/icon-200auto.svg" class="box_icon_width_small">
                            <h2>piÃ¹ di 200 auto</h2>
                            <h5>Auto Usate, sempre disponibili<br>e in pronta consegna</h5>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-12 mb-xxl">
                        <div class="b-count__service__item">
                        	<img src="<?echo costantiP::BASE_URL?>images/icon-home/icon-garanzia.svg" class="box_icon_width_small">
                            <h2>garanzia</h2>
                            <h5>Estensione fino a 36 mesi<br>con copertura al 100% del danno.</h5>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-12 mb-xxl">
                        <div class="b-count__service__item j-last">
                            <img src="<?echo costantiP::BASE_URL?>images/icon-home/icon-compriamo.svg" class="box_icon_width_small">
                            <h2>compriamo auto</h2>
                            <h5>Il pagamento Ã¨ immediato ed<br>il passaggio di proprietÃ  lo paghiamo noi.</h5>
                        </div>
                    </div>
					<div class="col-md-2 col-sm-4 col-xs-12 mb-xxl">
                        <div class="b-count__service__item j-last">
                            <img src="<?echo costantiP::BASE_URL?>images/icon-home/icon-certificazione.svg" class="box_icon_width_small">
                            <h2>km certificati</h2>
                            <h5>Kilometri Certificati Sempre.<br>Kilometri effettivi garantiti 12 mesi.</h5>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-12 mb-xxl">
                        <div class="b-count__service__item j-last">
                            <img src="<?echo costantiP::BASE_URL?>images/icon-home/icon-finanziamenti.svg" class="box_icon_width_small">
                            <h2>finanziamenti</h2>
                            <h5>I nostri finanziamenti sono<br>a tasso agevolato su misura per te.</h5>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-12 mb-xxl">
                        <div class="b-count__service__item j-last">
                            <img src="<?echo costantiP::BASE_URL?>images/icon-home/icon-assicurazione.svg" class="box_icon_width_small">
                            <h2>assicurazione</h2>
                            <h5>Autosicura e l'Assicurazione furto/incendio<br>assorbita nel finanziamento.</h5>
                        </div>
                    </div>
				</div>
			
		</section><!--b-count-->
		<?
	}
function doppi($a_1, $a_2){
    $a_1 =array_unique($a_1);
    $a_2 =array_unique($a_2);
    $ar = array_intersect($a_1, $a_2);
    $ar = array_values($ar);//riordina gli indici da 0 in poi
    return $ar;
}

function rimuoviFiltri($a_1, $a_2)
{
    $a_1 =array_unique($a_1);
    $a_2 =array_unique($a_2);
    $ar = array_intersect($a_1, $a_2);
    $ar = array_values($ar);//riordina gli indici da 0 in poi
    return $ar;
}

function stampaVeicoliSimili($elencoAuto)
{
    
    foreach ($elencoAuto as $veicolo) 
    {
        if (costantiP::URL_REWRITE_ATTIVO)
                        {
                            $path = costantiP::BASE_URL.costantiP::LINGUA.'/'.normalizzaTesto($veicolo['make']).'/'.normalizzaTesto($veicolo['model']).'-'.normalizzaTesto($veicolo['version']).'_'.$veicolo['id'].'.htm';
                        }
                        else
                        {
                            $path = costantiP::BASE_URL.costantiP::LINGUA.'/dettaglio-auto.php?id='.$veicolo['id'];   
                        }
        ?>
         	<div class="col-md-4 col-sm-4 col-xs-12 mb-lg">
				<a href="<?echo $path?>"><img class="example-image img-responsive" src="<?echo $veicolo['img']?>"  alt="<?echo $veicolo['titolo']?>" /></a>
						<div class="col-xs-6 p-none mt-sm">
							<a href="<?echo $path?>"><h4 class="mb-none mt-none black"><?echo  $veicolo['make'].' '.$veicolo['model']?></h4>
                        	<h5 class="mt-none mb-none"><?echo $veicolo['version']?></h5></a>
						</div>
						<div class="col-xs-6 p-none">
							<a href="<?echo $path?>"><div class="b-items__cars-one-info-header"><span class="p-none"><sup>â‚¬</sup><?echo number_format($veicolo['prezzo'],0,',','.')?></span></div></a>
						</div>
						<div class="col-xs-12 s-lineDown mt-sm"></div>
					</div>
            <?
    }
    
    
}

function linguette($marca, $modello, $carrozzeria, $annoA, $annoDa, $prezzoDa, $prezzoA, $carburante, $kmDa, $kmA, $potenza, $potenzaDa, $potenzaA, $neopatentati, $cambio, $nPorte, $nPostiDa, $nPostiA, $abs, $cruise, $clima, $fari, $classeEmissioni, $citycar,  $ecologic)
{
    $linguetta = '';
    if($marca!='')
        {
            $sql = 'select titolo from marca where id ='.$marca;
            $nomeMarca = getFieldValue($sql,'titolo');
            $linguetta .= ' <li>'.$nomeMarca.'<a href="#"><i class="fa fa-close"></i></a></li>';
        }
    if($modello>'0')
        {
            $sql = 'select titolo from modelli where id ='.$modello;
            $nomeModello = getFieldValue($sql,'titolo');
            $linguetta .= ' <li>'.$nomeModello.'<a href="#"><i class="fa fa-close"></i></a></li>';
        }
    ?>
  	<ul>
								<?echo$linguetta?>
								<li class="remove"><a href="<?costantiP::BASE_URL?>ricerca.php?r=1">Rimuovi filtri</a></li>
							</ul>
                            <!-- 
                            
                            <ul>
								<li>MERCEDES-BENZ <a href="#"><i class="fa fa-close"></i></a></li>
								<li>ANNO DA 2017 <a href="#"><i class="fa fa-close"></i></a></li>
								<li>N. PORTE 4/5 <a href="#"><i class="fa fa-close"></i></a></li>
								<li class="remove"><a href="<?costantiP::BASE_URL?>ricerca.php?r=1">Rimuovi filtri</a></li>
							</ul>
                            -->  
    <?
}

function stampaSchedaVeicolo($veicolo)
{
    
        if (costantiP::URL_REWRITE_ATTIVO)
                                    {
                                        $path = costantiP::BASE_URL.costantiP::LINGUA.'/'.normalizzaTesto($veicolo['make']).'/'.normalizzaTesto($veicolo['model']).'-'.normalizzaTesto($veicolo['version']).'_'.$veicolo['id'].'.htm';
                                    }
                                    else
                                    {
                                        $path = costantiP::BASE_URL.costantiP::LINGUA.'/dettaglio-auto.php?id='.$veicolo['id'];                                
                                    }

                        ?> 
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-xl pr-none pl-none">
                            <div class="b-items__cars-one  " data--delay="0.5s">
                                    <div class="col-lg-8 col-sm-12 col-xs-12"  >
										<a href="<?echo $path?>">
                                        	<h3 class="mb-none"><?echo $veicolo['make'].' '.$veicolo['model']?></h3>
                                        	<h4 class="mt-none"><?echo $veicolo['version']?></h4>
										</a>
                                        <div id="auto_<?echo $veicolo['id']?>" class="carousel slide"  data-ride="carousel" data-interval="false" >

              

            

                                              <!-- Wrapper for slides -->

                                              <div class="carousel-inner" role="listbox" >
												<div class="realtaAutounica"></div>
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

                                                                case 200000000:
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

                                                                case 10000000: 
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

                                                        ?>

                                            <?

                                            

                                             if ($etichetta)
                                             {

                                                ?>
                                                <!--  linguetta in overlay -->
                                                <a href="<?echo $path?>" class="<?echo $venduta?>">
                                                	<span class="<?echo $venduta?>"></span>
                                                </a>

                                                <span class="etichettaCorner m-premium">
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
                                                                $immagineVeicolo['imgBig']=$rowImmagini['img_big'];
                                                                $immagineVeicolo['titolo']=$rowImmagini['titolo'];
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

                                            </div>

                                        <!--
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
                                                    <script type="text/javascript">		
                                                    	//$(document).ready(function(){ $('#features').jshowoff({ speed:1000, links: false, controls: true }); });
                                                        $(document).ready(function(){ $('#auto_<?echo $veicolo['id']?>').jshowoff({ 
                                    					cssClass: 'thumbFeatures',
                                    					effect: 'fade'
                                    				}); });
                                                    </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>

                                        <a data-toggle="modal" data-target="#myModal<?echo $veicolo['id']?>" href="#" class="b-items__cars-one-img-video"><span class="fa fa-search fa-2x"></span></a>

                                        <!--b-modal-->

                                    </div>

                                    <div class="col-lg-4 col-sm-12 col-xs-12 mt-elenco-auto">

                                        <header class="b-items__cars-one-info-header s-lineTopLeft s-lineDownLeft mb-elenco-auto">
											<div class="risparmio" style="position: absolute; text-align: left; color:#87d0ef;">
												Risparmi<br>
												â‚¬9.500
											</div>
											<span><sup>â‚¬</sup><?echo number_format($veicolo['prezzo'],0,',','.')?></span>
										</header>

                                        <div class="b-items__cars-one-info">

                                            <p class="icon-carinfo km larg50"><?echo number_format($veicolo['km'],0,',','.')?> Km</p>
                                            <p class="icon-carinfo data larg50"><?echo estraiDataAuto($veicolo['registration_date'])?></p>
                                            <p class="icon-carinfo alimentazione larg50"><?echo $veicolo['alimentazione']?></p>
                                            <? $cavalli = $veicolo['kwatt']*1000/735.49875 ?>
                                            <p class="icon-carinfo potenza larg50"><?echo $veicolo['kwatt']?> KW / <?echo round($cavalli,0)?> CV</p>
                                            <p class="icon-carinfo cambio hidd larg50"><?echo $veicolo['gearbox']?></p>
                                            <p class="icon-carinfo colore hidd larg50"><?echo $veicolo['colore']?></p>
                                            <p class="icon-carinfo interni mb-none hidd larg50"><?echo $veicolo['interni']?></p>

                                        </div>
                                        
                                        <button type="submit" onclick="window.location='<?echo $path?>'" class="btn m-btn lightblue mt-md" style="width: 100%;">SCOPRI DI PIÃ¹ </button>

                                    </div>
                                </div>
                            </div>
    
    
    <?
    
}
?>