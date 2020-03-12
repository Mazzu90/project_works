<?php 

namespace Config\Template;

use Config\Info;
use Config\Core\Managers\PageManager;
use Config\Core\Entities\Debugger;

class Footer{    
    
    function __construct(){
        $method = '__construct()';
        
        $this->debug = new Debugger('FOOTER');
        
        $this->debug->constructing();
        $this->footer_elements = PageManager::$footer_elements;
        $this->debug->constructed();        
    }
    
    private $footer_elements;
    private $debug;
    
    public function prepareList()
    {   
        $list = array();
        $i = 0;
        $sublist = 0;
        $max_sublist_element= 4; 
         
        foreach($this->footer_elements as $element):
        
            if($i == $max_sublist_element):
                $i = 0;
                $sublist++;
            endif;
        
            $list[$sublist][] = $element;        
            
            $i++;
        endforeach;
        
        
        $this->debug->tryingToCreate('navbar_elements', 'getCurrentNavbar()');
        
        foreach($list as $sublist):
        ?>
        
			<div class="col-md-2 col-sm-3 col-xs-6 mobile-none">
				<div class="b-footer__company mt-md">  
            		
            		<?php
                        
                        for($i=0; $i <= PageManager::$last_idx; $i++):
                
                             if(isset($sublist[$i])):                
                                $page = $sublist[$i];
                                ?>
                                    <a href="<?php echo $page->url ?>" ><?php echo $page->name ?></a>
                            		<br/>
                            	<?php                
                            endif;
                        
                        endfor;
                               
                    ?>
                    
				</div>  
			</div> 
        
        <?php
        endforeach; 
        
        $this->debug->created();   
    }
    
    function preFooter()
	{	
		?>
			<section class="b-count__service pt-none">
				<div class="row">
					<div class="col-md-2 col-sm-4 col-xs-12 mb-xxl">
                        <div class="b-count__service__item j-last">
                            <img src="images/icon-home/icon-200auto.svg" class="box_icon_width_small">
                            <h2>piÃƒÂ¹ di 200 auto</h2>
                            <h5>Auto Usate, sempre disponibili<br>e in pronta consegna</h5>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-12 mb-xxl">
                        <div class="b-count__service__item">
                        	<img src="images/icon-home/icon-garanzia.svg" class="box_icon_width_small">
                            <h2>garanzia</h2>
                            <h5>Estensione fino a 36 mesi<br>con copertura al 100% del danno.</h5>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-12 mb-xxl">
                        <div class="b-count__service__item j-last">
                            <img src="images/icon-home/icon-compriamo.svg" class="box_icon_width_small">
                            <h2>compriamo auto</h2>
                            <h5>Il pagamento ÃƒÂ¨ immediato ed<br>il passaggio di proprietÃƒÂ  lo paghiamo noi.</h5>
                        </div>
                    </div>
					<div class="col-md-2 col-sm-4 col-xs-12 mb-xxl">
                        <div class="b-count__service__item j-last">
                            <img src="images/icon-home/icon-certificazione.svg" class="box_icon_width_small">
                            <h2>km certificati</h2>
                            <h5>Kilometri Certificati Sempre.<br>Kilometri effettivi garantiti 12 mesi.</h5>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-12 mb-xxl">
                        <div class="b-count__service__item j-last">
                            <img src="images/icon-home/icon-finanziamenti.svg" class="box_icon_width_small">
                            <h2>finanziamenti</h2>
                            <h5>I nostri finanziamenti sono<br>a tasso agevolato su misura per te.</h5>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-12 mb-xxl">
                        <div class="b-count__service__item j-last">
                            <img src="images/icon-home/icon-assicurazione.svg" class="box_icon_width_small">
                            <h2>assicurazione</h2>
                            <h5>Autosicura e l'Assicurazione furto/incendio<br>assorbita nel finanziamento.</h5>
                        </div>
                    </div>
				</div>
			
		</section><!--b-count-->
		<?
	}   
    
    public function show(){
    
        $this->preFooter();
    
        ?>        
        
        <footer class="b-footer">
            
            <a id="to-top" href="#this-is-top">
            	<img src="/images/top.png"/>
            </a>
            
            <div class="container">        
                
                <div class="row pb-md">
                	
                	<div class="col-md-4 col-xs-6">
                		<div class="b-footer__company">
                			<div class="b-nav__logo_footer">
                				<h4 class="ml-xlgggg pt-xs"><a href="idx.php">AUTOMOTIVE</a></h4>
                			</div>
                		</div>
                	</div>
                	
                	<div class="col-md-2 col-sm-3 col-xs-6">
                		<div class="b-footer__content-orari mt-md">
                			<p>ORARI<br>LUNED&iacute; - SABATO<br>09:00 - 12:30<br>14:30 - 20:00
                		</div>
                	</div>
                    <?php
                        
                        $this->prepareList();
                	?>
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
                        		<p>Copyright © 2016 Automotive S.r.l. Tutti i diritti riservati.</p>
                        	</nav>
                    	</div>
                    	
                	</div>
            	</div>
            	        
        	</div>
        	
        </footer><!--b-footer-->
         
        
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
                
                
                
               /* function nVeicoli()
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
                }*/
                </script>


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
         if( document.cookie.idxOf("eucookie") ===-1 ){
                $("#eucookielaw").show();
                }
                
                $("#removecookie").click(function () {
                SetCookie('eucookie','eucookie',365*10)
                $("#eucookielaw").remove();
                });
            </script> 
    <?php }        
        
    }
 }   
?>