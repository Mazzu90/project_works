<?
include('include_dir.php');
include('include/include.php');

$grafica=new Tgrafica(false,false);
$grafica->titolo='Vendita auto usate Brescia - AUTOUNICA srl';
$grafica->keywords='vendita auto Brescia, vendita auto, vendita auto usate, vendita auto usate Brescia';
$grafica->description='vendita auto usate a Brescia. AUTOUNICA srl via valcamonica 19/h Brescia.';
$grafica->codicePagina=costantiP::CP_CHISIAMO;
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
                	<img src="../images/chisiamo/carslide05s.jpg" class="img-responsive"/>
				</div>
				<div class="item">
                	<img src="../images/chisiamo/carslide02s.jpg" class="img-responsive"/>
				</div>
				<div class="item">
                	<img src="../images/chisiamo/carslide03s.jpg" class="img-responsive"/>
				</div>
				<div class="item">
                	<img src="../images/chisiamo/carslide04s.jpg" class="img-responsive"/>
				</div>
				<div class="item">
                	<img src="../images/chisiamo/carslide01s.jpg" class="img-responsive"/>
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
    
	
	<section class="b-count__service pt-xxl  m-none">
		<div class="row p-none m-none">
	
			<!--<div class="col-md-6 col-sm-9 col-xs-12 no-phone">
				<div class="chart">
					<div class="percentage" data-percent="80">
					  <div class="value">4800</div>
					  <div class="value_text_bottom">MQ</div>
					</div>
				  </div>
				  
				  <div class="chart">
					<div class="percentage" data-percent="80">
				  	  <div class="value_text_top">+DI</div>
					  <div class="value">200</div>
					  <div class="value_text_bottom">AUTO</div>
					</div>
				  </div>
			</div>-->
			
			<div class="col-md-6 col-sm-12">
					<img src="../images/icon-chisiamo/icon-chisiamo.svg" class="chisiamo_img">
			</div>
			
			<div class="b-count__service__introduction col-md-6 col-sm-12">
				<h1 class="mt-none mb-none">AUTOMOTIVE</h1>
				<h3 class="mt-none">UN’AZIENDA, UNA GRANDE FAMIGLIA.</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,<br>
					sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Erat velit scelerisque in dictum non consectetur a.
					<br>
					Tortor aliquam nulla facilisi cras fermentum odio eu feugiat pretium. Malesuada bibendum arcu vitae elementum curabitur vitae nunc.
					<br>
					Ultrices sagittis orci a scelerisque purus semper eget duis. Molestie at elementum eu facilisis. Nibh cras pulvinar mattis nunc sed blandit libero. </p>
				<br clear="all">
				<a href="../images/chisiamo/officina02.jpg" data-lightbox="example-set"><div class="btn m-btn grey">GALLERY</div></a>
				<a href="../images/chisiamo/officinaslide01.jpg" data-lightbox="example-set"></a>
				<a href="../images/chisiamo/officinaslide03.jpg" data-lightbox="example-set"></a>
				<a href="../images/chisiamo/pneumatici.jpg" data-lightbox="example-set"></a>
				<a href="../images/chisiamo/certificazione.jpg" data-lightbox="example-set"></a>
			</div>
			
		</div>
	</section>

		
	<section class="b-count__service bg-grey p-none m-none">
		<div class="row p-none m-none">
			<div id="box_img1" class="col-md-6 col-sm-12 p-none m-none left" style="background: url(../images/chisiamo/persona.jpg) center top no-repeat; background-size: cover;"></div>
			
			<div id="box_text1" class="col-md-6 col-sm-12 b-count__service__text right">
				<div class="b-count__service__icon mobile-none"><img src="#"></div>
				<h1 class="mt-none mb-none">LOREM IPSUM</h1>
				<h3 class="mt-none">LOREM IPSUM DOLOR SIT AMET</h3>
				<p>“Lorem ipsum dolor sit,<br>
                   consectetur adipiscing elit sed do eiusmod ”.<br><br>
                   [ Cit. Lorem ipsum ]</p>
			</div>
		</div>
	</section>
		
	<section class="b-count__service bg-grey p-none m-none">
		<div class="row p-none m-none">
			<div id="box_img2" class="col-md-6 col-sm-12 p-none m-none right" style="background: #666 url(../images/chisiamo/persona01.jpg) center top no-repeat; background-size: cover;"></div>
			<div id="box_text2" class="col-md-6 col-sm-12 b-count__service__text2 no-icon left">
				<h1 class="mt-none mb-none">LOREM IPSUM</h1>
				<h3 class="mt-none">LOREM IPSUM DOLOR SIT AMET</h3>
				<p>“Lorem ipsum dolor sit amet, consectetur adipiscing elit, <br>
                   sed do eiusmod tempor incididunt ut labore”.<br><br>
                   [ Cit. Lorem ipsum ]</p>
			</div>
		</div>
	</section>
		
	<section class="b-count__service bg-grey p-none m-none">
		<div class="row p-none m-none">
			<div id="box_img3" class="col-md-6 col-sm-12 p-none m-none left" style="background: #666 url(../images/chisiamo/persona02.jpg) center top no-repeat; background-size: cover;"></div>
			<div id="box_text3" class="col-md-6 col-sm-12 b-count__service__text no-icon right">
				<h1 class="mt-none mb-none">LOREM IPSUM</h1>
				<h3 class="mt-none">LOREM IPSUM DOLOR SIT AMET</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing.
                   Ultrices sagittis orci a scelerisque purus semper eget duis. Molestie at.</p>
			</div>
		</div>
	</section>
		
	<section class="b-count__service bg-grey p-none m-none">
		<div class="row p-none m-none">
			<div id="box_img4" class="col-md-6 col-sm-12 p-none m-none right" style="background: #666 url(../images/chisiamo/persona03.jpg) center top no-repeat; background-size: cover;"></div>
			<div id="box_text4" class="col-md-6 col-sm-12 b-count__service__text2 no-icon left">
				<h1 class="mt-none mb-none">LOREM IPSUM</h1>
				<h3 class="mt-none">LOREM IPSUM DOLOR SIT AMET</h3>
				<p>Lorem ipsum dolor sit amet, consectetur,<br>
                  sed do eiusmod tempor incididunt. <br><br>
                   [ Cit. Lorem ipsum ]</p>
			</div>
		</div>
	</section>
	
	<section class="b-count__service bg-grey p-none m-none">
		<div class="row p-none m-none">
			<div id="box_img5" class="col-md-6 col-sm-12 p-none m-none left" style="background: #666 url(../images/chisiamo/persona05.jpg) center top no-repeat; background-size: cover;"></div>
			<div id="box_text5" class="col-md-6 col-sm-12 b-count__service__text no-icon right">
				<h1 class="mt-none mb-none">LOREM IPSUM</h1>
				<h3 class="mt-none">LOREM IPSUM DOLOR SIT AMET</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,<br>
                   ed do eiusmod tempor incididunt. <br>
                   Erat velit scelerisque in dictum non consectetur a.</p>
			</div>
		</div>
	</section>
		
	<section class="b-count__service bg-grey p-none m-none">
		<div class="row p-none m-none">
			<div id="box_img6" class="col-md-6 col-sm-12 p-none m-none right" style="background: #666 url(../images/chisiamo/persona06.jpg) center top no-repeat; background-size: cover;"></div>
			<div id="box_text6" class="col-md-6 col-sm-12 b-count__service__text2 no-icon left">
				<h1 class="mt-none mb-none">LOREM IPSUM</h1>
				<h3 class="mt-none">LOREM IPSUM DOLOR SIT AMET</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit<br>
                   sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <br>
                   Erat velit scelerisque in dictum non consectetur a.</p>
			</div>
		</div>
	</section>
			
	<section class="b-count__service bg-grey p-none m-none">
		<div class="row p-none m-none">
			<div id="box_img7" class="col-md-6 col-sm-12 p-none m-none left" style="background: #666 url(../images/chisiamo/officina02.jpg) center top no-repeat; background-size: cover;"></div>
			<div id="box_text7" class="col-md-6 col-sm-12 b-count__service__text no-icon right">
				<h1 class="mt-none mb-none">LOREM IPSUM</h1>
				<h3 class="mt-none">LOREM IPSUM DOLOR SIT AMET</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.<br>
                   [ Cit. Lorem ipsum ]</p>
				<br clear="all">
				<a href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/officina.php"><div class="btn m-btn grey">ENTRA NELLA NOSTRA OFFICINA</div></a>
			</div>
		</div>
	</section>		
			
  	<section class="b-count__service bg-grey p-none m-none">
		<div class="row p-none m-none">
			<div id="box_img8" class="col-md-6 col-sm-12 p-none m-none right" style="background: #666 url(../images/chisiamo/officina01.jpg) center top no-repeat; background-size: cover;"></div>
			<div id="box_text8" class="col-md-6 col-sm-12 b-count__service__text2 no-icon left">
				<h1 class="mt-none mb-none">LOREM IPSUM</h1>
				<h3 class="mt-none">LOREM IPSUM DOLOR SIT AMET</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod,<br>
                   Malesuada bibendum arcu vitae elementum curabitur vitae nunc.</p>
			</div>
	</section>

	<section class="b-count__service bg-grey p-none m-none">
		<div class="row p-none m-none">
			<div id="box_img9" class="col-md-6 col-sm-12 p-none m-none left" style="background: #666 url(../images/chisiamo/officina03.jpg) center top no-repeat; background-size: cover;"></div>
			<div id="box_text9" class="col-md-6 col-sm-12 b-count__service__text no-icon right">
				<h1 class="mt-none mb-none">LOREM IPSUM</h1>
				<h3 class="mt-none">LOREM IPSUM DOLOR SIT AMET</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>
                   Erat velit scelerisque in dictum.<br>
                   Tortor aliquam nulla facilisi cras fermentum.</p>
			</div>
		</div>
	</section>
		
	<section class="b-count__service bg-grey p-none m-none">
		<div class="row p-none m-none">
			<div id="box_img10" class="col-md-6 col-sm-12 p-none m-none right" style="background: #666 url(../images/chisiamo/officina04.jpg) center top no-repeat; background-size: cover;"></div>
			<div id="box_text10" class="col-md-6 col-sm-12 b-count__service__text2 no-icon left">
				<h1 class="mt-none mb-none">LOREM IPSUM</h1>
				<h3 class="mt-none">LOREM IPSUM DOLOR SIT AMET</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor,<br>
				incididunt ut labore et dolore magna aliqua.<br>
				Erat velit scelerisque in dictum non consectetur a<br>
				Tortor aliquam nulla facilisi cras fermentum odio eu feugiat pretium.</p>
			</div>
	</section>

	<section class="b-count__service bg-grey p-none m-none">
		<div class="row p-none m-none">
			<div id="box_img11" class="col-md-6 col-sm-12 p-none m-none left" style="background: #666 url(../images/chisiamo/photographer.jpg) center top no-repeat; background-size: cover;"></div>
			<div id="box_text11" class="col-md-6 col-sm-12 b-count__service__text no-icon right">
				<h1 class="mt-none mb-none">LOREM IPSUM</h1>
				<h3 class="mt-none">LOREM IPSUM DOLOR SIT AMET</h3>
				<p>Lorem ipsum dolor sit amet,<br>
				   sed do eiusmod tempor incididunt ut labore,<br>
				   Erat velit scelerisque in dictum non consectetur.</p>
			</div>
		</div>
	</section>
		
	<section class="b-count__service bg-grey p-none m-none">
		<div class="row p-none m-none">
			<div id="box_img12" class="col-md-6 col-sm-12 p-none m-none right" style="background: #666 url(../images/chisiamo/boss.jpg) center center no-repeat; background-size: cover;"></div>
			<div id="box_text12" class="col-md-6 col-sm-12 b-count__service__text2 no-icon left">
				<h1 class="mt-none mb-none">LOREM IPSUM</h1>
				<h3 class="mt-none">LOREM IPSUM DOLOR SIT AMET</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod <br>
                   tempor incididunt ut labore et dolore magna aliqua. Erat velit scelerisque <br>
                   in dictum non consectetur a. Tortor aliquam nulla facilisi cras fermentum <br>
                   odio eu feugiat pretium. Malesuada bibendum arcu vitae elementum curabitur.<br>
                   Ultrices sagittis orci a scelerisque purus semper eget duis. Molestie at<br>
                   at elementum eu facilisis. Egestas egestas fringilla.<br><br>
                   [ Cit. Lorem ipsum ]</p>
			</div>
	</section>
		
	<section class="b-featured preFooter">
		<div class="container">
			<div class="col-xs-12">
				<h2 class="title">PERCHè SCEGLIERE AUTOMOTIVE</h2>
			</div>
		</div>	
	</section>
    
    <?


   $ricerca = new Ricerca();
   
   $ricerca->parametri = array(        
            
            'table' => 'veicoli',
            //'fields' => array('id','make','registration_date','prezzo'), 
            
            //'where' => array(   0 => array('field' => 'prezzo',    'value' => 'range', 'da'=> '1000'),                                                               
            //                    1 => array('field' => 'make',      'value' => '30000')
            //                ),
            
            'limit' => '1',
            //'offset' => '30',
            'order' => 'prezzo DESC',
            'class'=> 'Veicolo'                       
    );    
      
   $result = $ricerca->estraiDati();
   
   //$result2 = mysql_fetch_assoc($result);
   
   
   $result2 = mysql_query('Select * from veicoli limit 1');
   
   $g = new Tgrafica(false, false);
   
  $result3 = mysql_fetch_assoc($result2);
   var_dump($result3);  

    Util::createSessionVariablesFromObject();
   
   echo 'SESSIONE ID = '.$_SESSION['make'];
   
   $veicolo = new Veicolo();
   //$veicolo->createVeicoloFromHttpRequest();
    
 ?>
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
			var altezza10 =$('#box_text10').innerHeight();
			$('#box_img10').height(altezza10);
			var altezza11 =$('#box_text11').innerHeight();
			$('#box_img11').height(altezza11);
			var altezza12 =$('#box_text12').innerHeight();
			$('#box_img12').height(altezza12); 
            
             $('.carousel').carousel({
             	interval: 5000
         		})
            
            
            
		});
        
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