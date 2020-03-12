<?
include('include_dir.php');
include($percorsoLingua.'include/include.php');

$grafica=new Tgrafica(false,false);
$grafica->titolo='Vendita auto usate Brescia - AUTOUNICA srl';
$grafica->keywords='vendita auto Brescia, vendita auto, vendita auto usate, vendita auto usate Brescia';
$grafica->description='vendita auto usate a Brescia. AUTOUNICA srl via valcamonica 19/h Brescia.';
$grafica->codicePagina=costantiP::CP_OFFICINA;
$grafica->codiceBody='page1';

$pagina = isset($_GET['pagina'])?$_GET['pagina']:1;

$grafica->paint();
unset($grafica);

function corpo_pagina()
{
    ?>
    
    <?selezionaOccasione()?>
    
    <section class="b-pageHeader slide">
		<div id="slide" class="carousel slide carousel-fade no-phone" data-ride="carousel" data-interval="false">
			<div class="carousel-inner" role="listbox" >
                <div class="item active">
                	<img src="../images/officina/officinaslide01s.jpg" class="img-responsive"/>
				</div>
				<div class="item">
                	<img src="../images/officina/officinaslide02s.jpg" class="img-responsive"/>
				</div>
				<div class="item">
                	<img src="../images/officina/officinaslide03s.jpg" class="img-responsive"/>
				</div>
				<div class="item">
                	<img src="../images/officina/officinaslide04s.jpg" class="img-responsive"/>
				</div>
			</div>
			
			<!-- Left and right controls -->
			<a class="left carousel-control" href="#slide" role="button" data-slide="prev">
				<span class="fa m-control-left" aria-hidden="true" ></span>
				<span class="sr-only">Previous</span>
			</a>

			<a class="right carousel-control" href="#slide" role="button" data-slide="next">
				<span class="fa m-control-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
    </section>
    
	
	<section class="b-count__service">
		<div class="row p-none m-none">
	
			<div class="col-md-6 col-sm-12">
					<img src="#" class="officina_img">
			</div>
			
			<div class="b-count__service__introduction col-md-6 col-sm-12">
				<h1 class="mt-none mb-none">LOREM IPSUM DOLOR</h1>
				<h3 class="mt-none">LOREM IPSUM DOLOR SIT AMET</h3>
				<p>Lorem ipsum dolor sit amet.<br>
                   Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br><br>
                   Mi bibendum neque egestas congue quisque egestas.
                   Massa enim nec dui nunc mattis enim ut tellus elementum. Cras adipiscing enim eu turpis egestas pretium aenean pharetra magna. Suspendisse interdum consectetur libero id faucibus.</p>
				<br clear="all">
				<a href="../images/officina/officina01.jpg" data-lightbox="example-set"><div class="btn m-btn grey">GALLERY</div></a>
				<a href="../images/officina/officina02.jpg" data-lightbox="example-set"></a>
				<a href="../images/officina/officina03.jpg" data-lightbox="example-set"></a>
				<a href="../images/officina/officina04.jpg" data-lightbox="example-set"></a>
			</div>
			
		</div>
	</section>
		
	<section class="b-count__service bg-grey p-none m-none">
		<div class="row p-none m-none">
			
			<div id="box_img1" class="col-md-6 col-sm-12 p-none m-none left" style="background: #666 url(../images/officina/controllo.jpg) center center no-repeat; background-size: cover;"></div>
			
			<div id="box_text1" class="col-md-6 col-sm-12 b-count__service__text right">
				<div class="b-count__service__icon mobile-none"><img src="../images/icon-officina/icon-officina-analisi.svg"></div>
				<h1 class="mt-none mb-none">LOREM</h1>
				<h3 class="mt-none">UT ENIM AD MINIM VENIAM</h3>
				<p>Lorem ipsum dolor sit amet:<br>
                   - consectetur adipiscing elit<br>
                   - sed do eiusmod tempor incididunt<br>
                   - egestas pretium aenean pharetra magna<br>
                   - adipiscing enim eu turpis egestas pretium aenean </p>
			</div>
		</div>
	</section>


		
	<section class="b-count__service bg-grey p-none m-none">
		<div class="row p-none m-none">
			
			<div id="box_img2" class="col-md-6 col-sm-12 p-none m-none right" style="background: #666 url(../images/officina/motore.jpg) center center no-repeat; background-size: cover;"></div>
			
			<div id="box_text2" class="col-md-6 col-sm-12 b-count__service__text2 left">
				<div class="b-count__service__icon mobile-none"><img src="../images/icon-officina/icon-officina-consegna.svg"></div>
				<h1 class="mt-none mb-none">EXCEPTEUR SINT</h1>
				<h3 class="mt-none">DUIS AUTE IRURE DOLOR IN REPREHENDERIT</h3>
				<p>Posuere urna nec tincidunt praesent semper feugiat <br>
                   incidunt praesent semper feugiat in tellus integer feugiat <br>
                   scelerisque varius morbi enim. Felis eget velit aliquet sagittis id. </p>
			</div>
		</div>
	</section>


		
	<section class="b-count__service bg-grey p-none m-none">
		<div class="row p-none m-none">
			
			<div id="box_img3" class="col-md-6 col-sm-12 p-none m-none left" style="background: #666 url(../images/officina/meccanico.jpg) center center no-repeat; background-size: cover;"></div>
			
			<div id="box_text3" class="col-md-6 col-sm-12 b-count__service__text right">
				<div class="b-count__service__icon mobile-none"><img src="../images/icon-officina/icon-officina-garanzia.svg"></div>
				<h1 class="mt-none mb-none">LOREM</h1>
				<h3 class="mt-none">EXCEPTEUR SINT OCCAECAT</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod <br>
                   tempor incididunt ut labore et dolore magna aliqua. Mi bibendum neque <br>
                   egestas congue quisque egestas.<br>
                   Lorem ipsum dolor sit amet, consectetur adipiscing.</p>
				<br clear="all">
				<a href="#" target="_blank" class="btn m-btn white">SCOPRI COME</a>
			</div>
		</div>
	</section>


		
	<section class="b-count__service bg-grey p-none m-none">
		<div class="row p-none m-none">
			
			<div id="box_img4" class="col-md-6 col-sm-12 p-none m-none right" style="background: #666 url(../images/officina/pneumatici.jpg) center top no-repeat; background-size: cover;"></div>
			
			<div id="box_text4" class="col-md-6 col-sm-12 b-count__service__text2 no-icon left">
				<h1 class="mt-none mb-none">LOREM IPSUM</h1>
				<h3 class="mt-none">EXCEPTEUR SINT OCAECAT</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>
                   Massa enim nec dui nunc mattis enim ut tellus elementum cras adipiscing<br>
                   enim eu turpis egestas pretium aenean pharetra magna.</p>
			</div>
		</div>
	</section>


	
	<section class="b-count__service bg-grey p-none m-none">
		<div class="row p-none m-none">
			<div id="box_img5" class="col-md-6 col-sm-12 p-none m-none left" style="background: #666 url(../images/officina/pulizia.jpg) center center no-repeat; background-size: cover;"></div>
			<div id="box_text5" class="col-md-6 col-sm-12 b-count__service__text no-icon right">
				<h1 class="mt-none mb-none">LOREM IPSUM</h1>
				<h3 class="mt-none">SED DO EIUSMOD TEMPOR INCIDIDUNT</h3>
				<p>Posuere urna nec tincidunt praesent semper feugiat. In tellus integer feugiat<br>
                   varius morbi enim. Felis eget velit aliquet sagittis id. Viverra nibh cras pulvinar.<br>
                   Mauris ultrices eros in cursus turpis massa tincidunt dui ut. Ut aliquam<br>
                   purus sit amet luctus venenatis lectus magna.</p>
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
    ?>
        <link rel="stylesheet" href="/css/lightbox.css" />
    <script type="text/javascript" src="/js/lightbox.js"></script>
    
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
			var altezza5 =$('#box_text5').innerHeight();
			$('#box_img5').height(altezza5);
			var altezza6 =$('#box_text6').innerHeight();
			$('#box_img6').height(altezza6);
			var altezza7 =$('#box_text7').innerHeight();
			$('#box_img7').height(altezza7);
			var altezza8 =$('#box_text8').innerHeight();
			$('#box_img8').height(altezza8);
			var altezza9 =$('#box_text9').innerHeight();
			$('#box_img9').height(altezza9);
		});
		
		$('.carousel').carousel({
             	interval: 5000
         		})
        
        $(function() {                       //run when the DOM is ready
              $(".b-search-item-custom").click(function() {
                $('.b-search-item-custom.active').removeClass('active');//use a class, since your ID gets mangled
                $(this).addClass("active");      //add the class to the clicked element
              });
            });
		
		$('.percentage').easyPieChart({
		  animate: 1000,
		  lineWidth: 2,
			barColor: '#666',
			scaleColor: '#FFFFFF',
			size: 300,
		  onStep: function(value) {
			this.$el.find('span').text(Math.round(value));
		  },
		  onStop: function(value, to) {
			this.$el.find('span').text(Math.round(to));
		  }
		});
            
    </script>

    <?
    
}       
?>