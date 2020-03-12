<?php

namespace Config\Template;

use Config\Core\Managers\SiteManager;
use Config\Core\Managers\PageManager;
use Config\Core\Entities\Debugger;
use Config\SiteMap;


class Navbar{    
    
    private $debug;
    
    private $navbar_elements;
    private $footer_elemets;
    private $navbar_background;

    
    public function __construct(){        
       
       $method_name = '__construct()'; 
       
       $this->debug = new Debugger('Navbar');    
       $this->debug->constructing();
       
       $this->debug->tryingToSet('navbar_elements', $method_name );
       $this->navbar_elements = PageManager::$navbar_elements;
       
       $this->debug->tryingToSet('navbar_background', $method_name ); 
       $this->navbar_background = (SiteManager::$current_idx != SiteMap::home_idx) ? 'bg-blue' : '';       
       
       $this->debug->constructed();
    }

    
    public function prepareList(){
    
        $this->debug->tryingToCreate('navbar_elements', 'getCurrentNavbar()');
        //<span class="fa fa-caret-down"/> DROPDOWN
        $list = $this->navbar_elements;    
        
        foreach($list as $page):
            
            $current = ($page->idx == SiteManager::$current_idx) ? 'current' : '';
            ?>
                <li class="<?php echo $current ?>"><a href="<?php echo $page->url ?>"><?php echo $page->name ?></a></li>
            <?php     
        endforeach;
        
        $this->debug->created();   
    }
    
    public function show(){       
    ?>   
        
        <nav class="b-nav <?php echo $this->navbar_background ?>" id="headerMenu">
        	<div class="row">
        		<div class="col-md-1 col-xs-12 pr-none ml-md">
        			<a href="/it/">
        				<div class="b-nav__logo">
        				</div>
    				</a>
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
        						
        						<?php $this->prepareList() ?>        					      						  
        						
    							<li class="icon no-phone">
    								<a href="tel:+39 123 4567 890">
    									<i class="icon-phone icon icon-2x"></i>
    									<span>123 4567 890</span>
									</a>
								</li>
    							
    							<div class="nav_mobile_box privacy only-mobile">
    								<p>
    									<a href="#">Privacy Policy</a> / <a href="#">Utilizzo dei Cookie</a>
    								</p>
    							</div>
    							
    							<div class="nav_mobile_box tel only-mobile">
    								<a href="tel:+39 123 4567 890">
    									<i class="icon-phone icon icon-4x"></i>
										<span>CLICCA E CHIAMA</span>
										<p class="tel">123 4567 890</p>
    								</a>
    							</div>
    							
    							<div class="nav_mobile_box map only-mobile">
    								<a href="#">
    									<i class="fa fa-map-marker fa-4x map"></i>
    									<span>PORTAMI QUI</span>
    									<p>Via Valcamonica, 19/H<br>25135 Brescia</p>
									</a>
								</div>
    							    							
    						</ul>
    					</div>
    				</div>
    			</div>
    		</div>
    	</nav><!--b-nav-->       
        
    <?php 
    }
    

    
}

?>