<?
/*if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
    if(!headers_sent()) {
        header("Status: 301 Moved Permanently");
        header(sprintf(
            'Location: https://%s%s',
            $_SERVER['HTTP_HOST'],
            $_SERVER['REQUEST_URI']
        ));
        exit();
    }
}*/
include('include_dir.php');
include($percorsoLingua.'include/include.php');

$grafica=new Tgrafica(false,false);
$grafica->titolo='SIMONE autovetture - oltre 200 auto usate';
$grafica->keywords='vetture usate, compravendita auto usate, veicoli aziendali, km0';
$grafica->description='Presso il nostro Autosalone puoi trovare un\'esposizione aperta al pubblico dove visionare, in una struttura di oltre 2.000 mq coperti, oltre 200 autovetture usate';
$grafica->codicePagina=costantiP::CP_HOMEPAGE;
$grafica->codiceBody='page1';

$pagina = isset($_GET['pagina'])?$_GET['pagina']:1;

$grafica->paint();
unset($grafica);

function corpo_pagina()
{global $elencoConfigurazioniImmagini;
    
    $elencoAutoVetrina = array();
                             $sql = 'select                         
                                    count(*) as numero
                                from 
                                    veicoli
                                 where
                                   veicoli.pubblicato = 1 and vetrina = 1';
                            
                            $numero = GetFieldValue($sql, 'numero');
                            
                            if ($numero>0)
                                {
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
                                            veicoli.pubblicato = 1 and vetrina = 1
                                        order by 
                                            veicoli.ordinamento asc";
                                }
                            else
                                {
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
                                            veicoli.pubblicato = 1 and prezzo > 15000
                                        order by 
                                            rand() limit 4";
                                }
    
                           
                            $result=mysql_query($query);
                            $veicolo = new Veicolo();
                           	
                            while ($row=mysql_fetch_assoc($result)) {
                    			$vettura['id']=$row['id'];
                    			$vettura['make']=$row['make'];
                                $vettura['model']=$row['model'];
                                $vettura['version']=$row['version'];
                                $vettura['img']=$row['img'];
                                $vettura['km']=$row['km'];
                                $vettura['registration_date']=$row['registration_date'];
                                $vettura['alimentazione']=$veicolo->fuelDecode($row['alimentazione']);
                                $vettura['kwatt']=$row['kwatt'];
                                $vettura['gearbox']=$row['gearbox'];
                                $vettura['colore']=$row['colore'];
                                $vettura['interni']=$row['interni'];
                                $vettura['prezzo']=$row['prezzo'];
                                $elencoAutoVetrina[]=$vettura;
                               
                            }
    
    if( count($elencoAutoVetrina)<1)
    {
        ?>
    <?
    }
    else
    {
        ?>
       
     
     
		<section class="masthead side-collapse-container" style="background: #112e50;">
			<video class="masthead-video" autoplay loop muted>
				<!--
                <source src="https://files.brumbrum.it/asset_sito/hp/video/video-hp.mp4" type="video/mp4">
				<source src="https://files.brumbrum.it/asset_sito/hp/video/hp-video.webm" type="video/webm">
				<source data-src="https://files.brumbrum.it/asset_sito/hp/video/hp-video.ogg" src="" type="video/ogg">
                -->
                <source src="<?echo costantiP::BASE_URL?>video/autovetture_video_HP.mp4" type="video/mp4">
				<source src="<?echo costantiP::BASE_URL?>video/autovetture_video_HP.webm" type="video/webm">
				<source data-src="<?echo costantiP::BASE_URL?>video/autovetture_video_HP.ogg" src="" type="video/ogg">
			</video>	
		</section>
		
		<div class="click-scroll-body mobile-none">
			<div class="click-scroll-body-content"></div>
		</div>
	
		
       <div class="b-search">
			<div class="container">
				<form class="b-search__main" id="ricerca" action="ricerca.php" method="GET">
					<div class="col-xs-12 col-md-12 b-search__main-title" style="padding: 0px;">
						<h2 class="mobile-none">TROVARE LA TUA AUTO è SEMPLICISSIMO</h2>
						<h2 class="only-mobile">TROVARE<br>LA TUA AUTO<br>è SEMPLICISSIMO</h2>
					</div>
                   	
                     <div class="row mobile-none prezzi">
                        <div class="col-xs-12 col-md-1"></div>
                        	
                        	<div class="col-xs-6 col-md-2">
                        		<div class="b-search-item-custom caption1 filtro" data-id="1">
                        			<div class="b-search-value">
										<div class="b-search-item-custom-value"><span>da €.</span><br>0</div>
										<div class="b-search-item-custom-divider"></div>
										<div class="b-search-item-custom-value"><span>a €.</span><br>5<sup>.000</sup></div>
									</div>
								</div>
						    </div>
                       
                       		<div class="col-xs-6 col-md-2">
                       			<div class="b-search-item-custom caption1 filtro" data-id="2">
                       				<div class="b-search-value">
										<div class="b-search-item-custom-value"><span>da €.</span><br>5<sup>.000</sup></div>
										<div class="b-search-item-custom-divider"></div>
										<div class="b-search-item-custom-value"><span>a €.</span><br>10<sup>.000</sup></div>
									</div>
								</div>
						    </div>
                       		
                       		<div class="col-xs-6 col-md-2">
                       			<div class="b-search-item-custom caption1 filtro" data-id="3">
                       				<div class="b-search-value">
										<div class="b-search-item-custom-value"><span>da €.</span><br>10<sup>.000</sup></div>
										<div class="b-search-item-custom-divider"></div>
										<div class="b-search-item-custom-value"><span>a €.</span><br>15<sup>.000</sup></div>
									</div>
								</div>
						    </div>
                       
                       		<div class="col-xs-6 col-md-2">
                       			<div class="b-search-item-custom caption1 filtro" data-id="4">
                       				<div class="b-search-value">
										<div class="b-search-item-custom-value"><span>da €.</span><br>15<sup>.000</sup></div>
										<div class="b-search-item-custom-divider"></div>
										<div class="b-search-item-custom-value"><span>a €.</span><br>20<sup>.000</sup></div>
									</div>
								</div>
						    </div>
                       
                       		<div class="col-xs-6 col-md-2">
                       			<div class="b-search-item-custom caption1 filtro" data-id="5">
                       				<div class="b-search-value">
										<div class="b-search-item-custom-value2"><span>oltre</span><br>20<sup>.000</sup></div>
									</div>
								</div>
						    </div>
                       
                       		<div class="col-xs-12 col-md-1"></div>
                        
                  	</div>
                    
                    <div class="row mobile-none">
                        <div class="col-xs-12 col-md-1"></div>
                        
                        <div class="col-xs-12 col-md-5 b-items__aside-main-body-item">
                            <div>
                                
                                <select name="marca" id="marca" class="m-select filter selezione">
                                                    
                                                      

                                              <?
                                                      $query = 'SELECT  marca.id,
                                                                        marca.titolo
                                                                FROM
                                                                        marca
                                            		            WHERE 
                                                                        marca.id in (select distinct id_marca from veicoli where veicoli.pubblicato = 1)
                                                                ORDER BY titolo ASC
                                                         ';

                                                        //echo $query;
                                                        $result=mysql_query($query);

                                                        $selectedMake = '';
                                                            if ($marca == '')
                                                                {
                                                                    $selectedMake = 'selected="selected"';
                                                                }
                                                            echo '<option value="" '.$selectedMake.'>Marca</option>';


                                                        while ($row=mysql_fetch_assoc($result)) {
                                                            if ($marca == $row['id'])
                                                                    {
                                                                        $selectedMake = 'selected="selected"';
                                                                    }
                                                                    else
                                                                    {
                                                                        $selectedMake = '';
                                                                    }

                                                            echo '<option value="'.$row['id'].'" '.$selectedMake.'>'.$row['titolo'].'</option>';
                                                		 }

                                                ?>
                                </select>
                                
                                <span class="fa fa-angle-down fa-4x"></span>
                            </div>
                        </div>
						
						<div class="col-xs-12 col-md-5 b-items__aside-main-body-item">
                            <div>
                                
                                <select name="modello" class="m-select filter" id="modello2">
                                    <option value="-1">Scegli Modello...</option>
                                </select>
                                
                                <span class="fa fa-angle-down fa-4x"></span>
                            </div>
                        </div>
						
					</div>
                  	
					<div class="row">
						<div class=" col-xs-12 col-md-12 mobile-none">
							<button type="submit" class="btn m-btn search mt-none" id="nResult">VEDI TUTTE LE AUTO</button>
							<p class="search"><a href="#" id="resetBtn">[ RESET FILTRI ]</a></p>
						</div>
					</div>
                    
                   
					
				</form>
				
			</div>
		</div><!--b-search-->

                    <div class="col-xs-10 b-search__vedi_auto_mobile only-mobile">
            			<button type="submit" class="btn m-btn search mt-none" id="submitMobile">VEDI TUTTE LE AUTO</button>
            			<p class="phone"><i class="fa fa-phone"></i> 123 4567 890</p>
            		</div>
		

        <?
    }                                            
                            ?>

        <section class="b-count mt-xlgg">
			<div class="container">
				<div class="row">
                
                    
						<div class="col-md-3 col-sm-6 col-xs-6">
							<a href="<?echo costantiP::BASE_URL?>it/ricerca.php?neopatentati=1">
                                <div class="b-count__item_custom caption2">
    								<h2>AUTO PER<br />NEOPATENTATI</h2>
    								<i class="fontello-plus icon-4x"></i>
    								<img src="<?echo costantiP::BASE_URL?>images/icon-home/icon-neopatentati.svg" />
    							</div>
                            </a>
						</div>
					
					
                    <div class="col-md-3 col-sm-6 col-xs-6">
                            <a href="<?echo costantiP::BASE_URL?>it/ricerca.php?citycar=1">
    							<div class="b-count__item_custom caption2">
    								<h2>CITYCAR<br><span>.</span></h2>
    								<i class="fontello-plus icon-4x"></i>
    								<img src="<?echo costantiP::BASE_URL?>images/icon-home/icon-citycar.svg">
    							</div>
                            </a>
                    </div>
					
                    <div class="col-md-3 col-sm-6 col-xs-6">
                    	<a href="<?echo costantiP::BASE_URL?>it/ricerca.php?ecologic=1">
                            <div class="b-count__item_custom caption2">
								<h2>AUTO<br>ECOLOGICHE</h2>
								<i class="fontello-plus icon-4x"></i>
								<img src="<?echo costantiP::BASE_URL?>images/icon-home/icon-ecologiche.svg">
							</div>
                        </a>
                    </div>
					
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <a href="<?echo costantiP::BASE_URL?>it/ricerca.php?carrozzeria=Fuoristrada">
							<div class="b-count__item_custom caption2 j-last">
								<h2>SUV E<br>FUORISTRADA</h2>
								<i class="fontello-plus icon-4x"></i>
								<img src="<?echo costantiP::BASE_URL?>images/icon-home/icon-suv.svg">
							</div>
                        </a>
                    </div>
				
				</div>
			</div>
		</section><!--b-count-->
      
      	
		<section class="b-count__service bg-grey p-none m-none">
			<div class="row p-none m-none">
				<div id="box_img1" class="col-md-6 col-sm-12 p-none m-none left" style="background: url(../images/home/certificazione.jpg) center center no-repeat; background-size: cover;"></div>
				<div id="box_text1" class="col-md-6 col-sm-12 b-count__service__text right">
					<div class="b-count__service__icon mobile-none"><img src="#"></div>
					<h1 class="mt-none mb-none">I NOSTRI KILOMETRI</h1>
					<h3 class="mt-none">SONO CERTIFICATI, SEMPRE.</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Cursus mattis molestie a iaculis at. Cursus mattis molestie a iaculis at erat pellentesque adipiscing. Vel elit scelerisque mauris pellentesque pulvinar pellentesque habitant. Adipiscing elit duis tristique sollicitudin nibh sit amet commodo. At tellus at urna condimentum mattis pellentesque id nibh. Nulla facilisi nullam vehicula ipsum a arcu cursus vitae.</p><!--
					<br clear="all">
					<div class="btn m-btn grey">SCOPRI DI PIù</div>-->
				</div>
			</div>
		</section>
	
		<section class="b-count__service bg-light_blue p-none m-none">
			<div class="row p-none m-none">
				<div id="box_img2" class="col-md-6 col-sm-12 p-none m-none right" style="background: url(#) center center no-repeat; background-size: 80%;"></div>
				<div id="box_text2" class="col-md-6 col-sm-12 b-count__service__text2 no-icon left">
					<h1 class="mt-none mb-none">ESTENSIONE</h1>
					<h3 class="mt-none">DI GARANZIA.</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br>
					Cursus mattis molestie a iaculis at.<br>
					Cursus mattis molestie a iaculis at erat pellentesque adipiscing.</p>
					<br clear="all">
					<a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/servizi.php#garanzia" class="btn m-btn white">SCOPRI COME</a>
				</div>
			</div>
		</section>

		<section class="b-count__service bg-grey p-none m-none">
			<div class="row p-none m-none">
				<div id="box_img3" class="col-md-6 col-sm-12 p-none m-none left" style="background: url(../images/home/service.jpg) center center no-repeat; background-size: cover;"></div>
				<div id="box_text3" class="col-md-6 col-sm-12 b-count__service__text right">
					<div class="b-count__service__icon mobile-none"><img src="../images/icon-home/icon-garanzia.svg"></div>
					<h1 class="mt-none mb-none">IL SERVICE</h1>
					<h3 class="mt-none">UNICO DI autovetture.</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor<br>
					tempor incididunt ut labore et dolore magna aliqua.<br>
					Cursus mattis molestie a iaculis at. </p>
					<br clear="all">
					<a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/officina.php" class="btn m-btn grey">SCOPRI DI PIù</a>
				</div>
			</div>
		</section>
      

		<section class="b-count__service p-none m-none">
			<div class="row p-none m-none">
				<div id="box_img4" class="col-md-6 col-sm-12 p-none m-none right" style="background: url(../images/home/carcloseup.jpg) center center no-repeat; background-size: cover;"></div>
				<div id="box_text4" class="col-md-6 col-sm-12 b-count__service__text2 no-icon left">
					<h1 class="mt-none mb-none">ASSICURATI</h1>
					<h3 class="mt-none">LA GUIDA.</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod<br>
					tempor incididunt ut labore et dolore magna aliqua.<br>
					Cursus mattis molestie a iaculis at erat pellentesque adipiscing,<br>
					vel elit scelerisque mauris pellentesque pulvinar pellentesque habitant.</p>
					<br clear="all">
					<a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/servizi.php#assicurazione" class="btn m-btn grey">SCOPRI DI PIù</a>
				</div>
			</div>
		</section>
		
		
		
		
		<section class="b-featured preFooter">
			<div class="container">
				<div class="col-xs-12">
					<h2 class="title">PERCHè SCEGLIERE automotive</h2>
				</div>
				<div class="col-md-12 pt-none pb-none center no-phone">
					<p class="entry">Automobili Usate a Brescia</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Cursus mattis molestie a iaculis at. Cursus mattis molestie a iaculis at erat pellentesque adipiscing.
                    <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/bmw/">BMW usate</a>,  
                    <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/audi/">AUDI usate</a>, 
                    <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/mercedes-benz/">MERCEDES usate</a>, 
                    <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/fiat/">FIAT usate</a>, 
                    <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/alfa-romeo/">ALFA ROMEO usate</a>, 
                    <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/smart/">SMART usate</a>, 
                    <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/mini/">MINI usate</a>, 
                    <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/land-rover/">LAND ROVER usate</a>, 
                    <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/jeep/">JEEP usate</a>, 
                    <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/ford/">FORD usate</a>, 
                    <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/toyota/">TOYOTA usate</a>, 
                    <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/citroen/">CITROEN usate</a>, 
                    <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/peugeot/">PEUGEOT usate</a>, 
                    <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/hyundai/">HYUNDAI usate</a>, 
                    <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/lancia/">LANCIA usate</a>, 
                    <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/kia/">KIA usate</a>, 
                    <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/nissan/">NISSAN usate</a>, 
                    <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/opel/">OPEL usate</a>, 
                    <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/renault/">RENAULT usate</a>, 
                    <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/seat/">SEAT usate</a>, 
                    <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/volkswagen/">VOLKSWAGEN usate</a>, 
                    <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/volvo/">VOLVO usate</a>, e tutte le <a href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/autovetture.php">auto usate disponibili</a>.</p>
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
    <link href="../assets/covervid/css/covervid.css" rel="stylesheet" type="text/css">
    <script src="../assets/covervid/js/covervid.js" type="text/javascript"></script>
    <script src="../assets/covervid/js/scripts.js" type="text/javascript"></script>
    
    
    <!-- Call CoverVid -->
	<script type="text/javascript">
		// If using jQuery
			// $('.masthead-video').coverVid(1920, 1080);
		// If not using jQuery (Native Javascript)
			coverVid(document.querySelector('.masthead-video'), 640, 360);
	</script>
    
    
    <!-- Custom jQuery -->
    <script language="javascript">
		$(document).ready(function (){
			var altezza1 =$('#box_text1').innerHeight();
			$('#box_img1').height(altezza1);
			var altezza2 =$('#box_text2').innerHeight();
			$('#box_img2').height(altezza2);
			var altezza3 =$('#box_text3').innerHeight();
			$('#box_img3').height(altezza3);
			var altezza4 =$('#box_text4').innerHeight();
			$('#box_img4').height(altezza4);
            
          /* $(".filtro").click(function (){
            
            
            alert (fasciaPrezzo);
            
            //alert (fasciaPrezzo);
            nVeicoli();
            });*/
          
          // calcolo veicoli 
          nVeicoli();
          
          //RESET FILTRI RICERCA  
          $('#resetBtn').on('click', function(e){
                e.preventDefault();
                $('.b-search-item-custom.active').removeClass('active');//use a class, since your ID gets mangled
                document.forms[0].reset();
                //aggiorno il conto dei veicoli
                nVeicoli();
            });
            
          
          //SUBMIT MOBILE
          $('#submitMobile').on('click', function(e){
                $( "#ricerca" ).submit();
            });
           
		});
        
        //SELEZIONO MODELLO E AGGIORNO NUMERO VEICOLI DISPONIBILI
        $('#modello2').change(function() {
                    nVeicoli();
                 });  
        
        
        
        
        //APPLICO CLASSI COLORE AI FILTRI
        $(function() {                       //run when the DOM is ready
              $(".b-search-item-custom").click(function() {
                $('.b-search-item-custom.active').removeClass('active');//use a class, since your ID gets mangled
                $(this).addClass("active");      //add the class to the clicked element
                nVeicoli();
              });
            });
            
            
            submitMobile
            
        $('#marca').change(function() {

                        //recupero variabile "discriminante"
                        var marca = $("#marca").val();
                        var modello = '';
                        
                        //chiamata ajax
        
                        $.ajax({
                        type: "POST",
                        url: "select-modello.php",
                        data: "marca=" + marca +"&modello=" +modello,
                        dataType: "html",
        
                        success: function(msg)
                        {
                            $("#modello2").html(msg);//stampa i risultati dentro la seconda select
                        },
                        error: function()
                        {
                        alert("Chiamata fallita, si prega di riprovare..."); //sempre meglio impostare una callback in caso di fallimento
                        }
                    });
                    //aggiorno il conto dei veicoli
                        nVeicoli();
                 });  
        
        
        
        
        function nVeicoli()
        {
            var marca = $("#marca").val();
            var modello = $("#modello2").val();
            var prezzo = $('.prezzi .active').data("id");
            
            $( "#prezzo2" ).remove();
            var input = $("<input>")
               .attr("type", "hidden")
               .attr("id", "prezzo2")
               .attr("name", "prezzo").val(prezzo);
               $('.b-search__main').append($(input));

            $.ajax({
                     
                    type: "GET",
             
                    url: "ajax-veicoli.php",
                    data: "marca="+marca+"&modello="+modello+"&prezzo="+prezzo,
                    dataType: "html",
                    
                    success: function(msg)
                    {
                        $("#nResult").html(msg);//stampa i risultati dentro la seconda select
                    },
                    error: function()
                    {
                    //alert("Chiamata fallita, si prega di riprovare..."); //sempre meglio impostare una callback in caso di fallimento
                    }
                });
        }
        
        function ricerca()
        {
            var marca = $("#marca").val();
            var modello = $("#modello2").val();
            var prezzo = $('.prezzi .active').data("id");
            
            $.ajax({
                     
                    type: "GET",
             
                    url: "ricerca.php",
                    data: "marca="+marca+"&modello="+modello+"&prezzo="+prezzo,
                    dataType: "html",
                    
                    success: function(msg)
                    {
                        $("#nResult").html(msg);//stampa i risultati dentro la seconda select
                    },
                    error: function()
                    {
                    //alert("Chiamata fallita, si prega di riprovare..."); //sempre meglio impostare una callback in caso di fallimento
                    }
                });
        }
        
        
            
    </script>

    <?
    
}       
?>
