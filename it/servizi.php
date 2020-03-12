<?
include('include_dir.php');
include($percorsoLingua.'include/include.php');

$grafica=new Tgrafica(false,false);
$grafica->titolo='Vendita auto usate Brescia - AUTOUNICA srl';
$grafica->keywords='vendita auto Brescia, vendita auto, vendita auto usate, vendita auto usate Brescia';
$grafica->description='vendita auto usate a Brescia. AUTOUNICA srl via valcamonica 19/h Brescia.';
$grafica->codicePagina=costantiP::CP_SERVIZI;
$grafica->codiceBody='page1';

$pagina = isset($_GET['pagina'])?$_GET['pagina']:1;

$grafica->paint();
unset($grafica);

function corpo_pagina()
{
    ?>
    
    <?selezionaOccasione()?>

	
	<section class="b-pageHeader b-count__service pt-xxxxxl">
		<div class="row p-none m-none">
	
			<div class="col-md-6 col-sm-12">
					<img src="../images/icon-servizi/icon-servizi.svg" class="servizi_img">
			</div>
			
			<div class="b-count__service__introduction col-md-6 col-sm-12">
				<h1 class="mt-none mb-none">LOREM IPSUM</h1>
				<h3 class="mt-none">DOLOR SIT AMET CONSECTETUR</h3>
				<p>Lorem ipsum dolor sit amet, ad quot melius splendide cum, cu eos voluptaria complectitur.
				    Usu deserunt mnesarchum et, mea cu docendi democritum. <br>
					Vis ad eros omnis praesent, omnium aeterno expetendis id per.
				<br><br>
				 Lorem ipsum dolor sit amet, ad quot melius splendide cum, cu eos voluptaria complectitur. Usu deserunt mnesarchum et, mea cu docendi democritum. Vis ad eros omnis praesent, omnium aeterno expetendis id per.</p>
			</div>
			
		</div>
	</section>
		
	<section id="garanzia" class="b-count__service bg-light_blue m-none">
		<div class="row p-none m-none">
			<div class="col-md-6 col-sm-12">
				<img src="#" class="officina_img">	
			</div>
			<div class="col-md-6 col-sm-12 b-count__service__text pt-sm pb-sm white">
				<h1 class="mt-none mb-none">LOREM IPSUM</h1>
				<h3 class="mt-none">DOLOR SIT AMET CONSECTETUR</h3>
				<p>Lorem ipsum dolor sit amet, ad quot melius splendide cum, cu eos voluptaria complectitur. Dicunt inimicus eu sed. Eam hinc regione omittam ea,<br>
                Lorem ipsum dolor sit amet, ad quot melius splendide cum.<br>
                Lorem ipsum dolor sit amet, ad quot melius splendide cum, cu eos voluptaria complectitur. Usu deserunt mnesarchum et, mea cu docendi democritum. Vis ad eros omnis praesent, omnium aeterno expetendis id per. Alia recusabo cu nec, mei eu aperiri dolorum. No clita nominavi euripidis quo.</p>
				<br clear="all">
				<img src="../images/icon-servizi/icon-servizi-garanzia-white.svg" class="mobile-none" style="width: 20%;">
				<a href="../pdf/AUTOSICURA_Garanzia_36Mesi_Autounica.pdf" target="_blank" class="btn m-btn white">LEGGI TUTTI I VANTAGGI</a>
			</div>
		</div>
	</section>
	
	<section class="b-count__service bg-grey p-none m-none">
		<div class="row p-none m-none">
			<div id="box_img1" class="col-md-6 col-sm-12 p-none m-none left" style="background: #666 url(../images/servizi/keys.jpg) center center no-repeat; background-size: cover;"></div>
			
			<div id="box_text1" class="col-md-6 col-sm-12 b-count__service__text right">
				<div class="b-count__service__icon mobile-none">
					<img src="#">
				</div>
				<h1 class="mt-none mb-none">LOREM IPSUM</h1>
				<h3 class="mt-none">DOLOR SIT AMET CONSECTETUR</h3>
				<p>Nam ei agam ornatus oporteat, consul dolores percipit ius cu.<br>
				Est cetero abhorreant cu. Nibh prompta facilis nam ex. No sit nisl elaboraret delicatissimi,<br>
				no utinam scripserit mel. Id cum libris elaboraret.</p>
				<br clear="all">
				<a href="#" target="_blank" class="btn m-btn grey">SCOPRI DI PIù</a>
			</div>
		</div>
	</section>
	
	<section class="b-count__service m-none">
		<div class="row p-none m-none">
			<div class="col-md-6 col-sm-12">
				<img src="#" class="officina_img">	
			</div>
			<div class="col-md-6 col-sm-12 b-count__service__text pt-sm pb-sm">
				<h1 class="mt-none mb-none">LOREM IPSUM</h1>
				<h3 class="mt-none">DOLOR SIT AMET CONSECTETUR</h3>
				<p>Ut tollit postulant intellegebat nec. Convenire partiendo no pri,<br>
                   aeque accumsan mea at, his eu veritus omnesque recusabo.<br>
                   Omnesque ponderum delicata ex sit.</p>
				<br clear="all">
				<a href="#" target="_blank" class="btn m-btn grey">LEGGI TUTTI I VANTAGGI</a>
			</div>
		</div>
	</section>
		
	<section id="assicurazione" class="b-count__service bg-grey p-none m-none">
		<div class="row p-none m-none">
			<div id="box_img2" class="col-md-6 col-sm-12 p-none m-none left" style="background: #666 url(../images/servizi/assicurazione.jpg) center center no-repeat; background-size: cover;"></div>
			
			<div id="box_text2" class="col-md-6 col-sm-12 b-count__service__text right">
				<div class="b-count__service__icon mobile-none">
					<img src="#">
				</div>
				<h1 class="mt-none mb-none">LOREM IPSUM</h1>
				<h3 class="mt-none">DOLOR SIT AMET CONSECTETUR</h3>
				<p>Dicunt inimicus eu sed. Eam hinc regione omittam ea, euismod voluptatum ei.<br>
                   Quo laoreet conceptam ad. Nibh libris ius te, qui regione saperet an.<br>
                   Ex vero causae mei. Postea dolorem prodesset ad per,<br>
                   ne soluta oportere sed, alterum salutandi his et.</p>
			</div>
			
		</div>
	</section>
		
	<section class="b-count__service p-none m-none">
		<div class="row p-none m-none">
			<div id="box_img3" class="col-md-6 col-sm-12 p-none m-none right" style="background: #666 url(../images/servizi/finanziamento.jpg) center center no-repeat; background-size: cover;"></div>
			<div id="box_text3" class="col-md-6 col-sm-12 b-count__service__text2 left">
				<div class="b-count__service__icon mobile-none">
					<img src="../images/icon-servizi/icon-servizi-finanzia.svg">
				</div>
				<h1 class="mt-none mb-none">LOREM IPSUM</h1>
				<h3 class="mt-none">DOLOR SIT AMET CONSECTETUR</h3>
				<p>Dicunt inimicus eu sed. Eam hinc regione omittam ea, euismod voluptatum ei.<br>
                   Ut tollit postulant intellegebat nec. Convenire partiendo no pri,<br>
                   quo laoreet conceptam ad. Nibh libris ius te, qui regione saperet an,<br>
                   ne soluta oportere sed, alterum salutandi his et.</p>
			</div>
		</div>
	</section>
		
	<section class="b-count__service bg-grey p-none m-none">
		<div class="row p-none m-none">
			<div id="box_img4" class="col-md-6 col-sm-12 p-none m-none left" style="background: #666 url(../images/servizi/permutausato.jpg) center center no-repeat; background-size: cover;"></div>
			
			<div id="box_text4" class="col-md-6 col-sm-12 b-count__service__text right">
				<div class="b-count__service__icon mobile-none">
					<img src="../images/icon-servizi/icon-servizi-permuta.svg">
				</div>
				<h1 class="mt-none mb-none">LOREM IPSUM</h1>
				<h3 class="mt-none">DOLOR SIT AMET CONSECTETUR</h3>
				<p>Lorem ipsum dolor sit amet, ad quot melius splendide cum, cu eos voluptaria complectitur.<br>
                   ad eros omnis praesent, omnium aeterno expetendis id per. Alia recusabo cu nec,<br>
                   quo laoreet conceptam ad. Nibh libris ius te, qui regione saperet an,<br>
                   ne soluta oportere sed, alterum salutandi his et.</p>
			</div>
		</div>
	</section>
	
	<section class="b-count__service p-none m-none">
		<div class="row p-none m-none">
			<div id="box_img5" class="col-md-6 col-sm-12 p-none m-none right" style="background: #666 url(../images/servizi/pratiche.jpg) center center no-repeat; background-size: cover;"></div>
			
			<div id="box_text5" class="col-md-6 col-sm-12 b-count__service__text2 left">
				<div class="b-count__service__icon mobile-none">
					<img src="../images/icon-servizi/icon-servizi-pratiche-passaggio.svg">
				</div>
				<h1 class="mt-none mb-none">LOREM IPSUM</h1>
				<h3 class="mt-none">DOLOR SIT AMET CONSECTETUR</h3>
				<p>Lorem ipsum dolor sit amet, ad quot melius splendide cum,<br>
                   ne soluta oportere sed, alterum salutandi his et<br>
                   quo laoreet conceptam ad.</p>
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