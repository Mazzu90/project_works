<?php 

namespace Config\Components;

use Config\Utils\Util;
use Config\Utils\Data;
use Config\Components\Etichetta;
use Config\Core\Entities\Debugger;

class HtmlGenerator{

    private $debug;

    public function __construct(){

        $this->debug = new Debugger('HTML GENERATOR');
        $method = '__construct()';
        $this->debug->constructing();


        $this->debug->constructed();
    }
    
    public function stampaEtichetta($obj)
    {     
        $etichetta = Etichetta::getEtichetta($obj);
        
        if($etichetta): 
        ?>                         
            <a href="<?php echo $obj->print_url?>" class="<?php $etichetta->venduta?>"> 
            	<spanclass="<?php echo $etichetta->venduta?>"></span>
            </a> 
        	<span class="etichettaCorner m-premium"> 
        		<img src="<?php echo $etichetta->file_name?>"class="img-responsive" />
            </span>
                        
    	<?php 
    	endif;
    }
    
    public function stampaImmagini($obj)
    {
        $method = 'stampaImmagini()';

        $this->debug->tryingToSet("list", $method);
        $list = $obj->getListImmagini();
        $this->debug->generic('list : Created!');
        $n_immagini = count($list);


        if($n_immagini>0):
            $this->debug->generic('numero immagini:'.$n_immagini);
            foreach ($list as $img):
            ?>
                <div class="item">
                    <a class="details" href="<?php echo $obj->print_url?>">
                    <img src="<?php echo $img->img_big ?>" alt='<?php echo $img->titolo?>'class="img-responsive" />
                    </a>
                </div>
            <?php
            endforeach;
       	endif;
    }
    
    public function stampaScheda($obj)
    {
        $method = 'stampaScheda()';
        $this->debug->tryingToCreate('SchedaVeicolo', $method)

        ?>        
        <div class="col-lg-12 col-sm-12 col-xs-12 mb-xl pr-none pl-none">
        	<div class="b-items__cars-one  " data--delay="0.5s">
        		<div class="col-lg-8 col-sm-12 col-xs-12">
        			<a href="<?php echo $obj->print_url?>">
        				<h3 class="mb-none"><?php echo $obj->print_titolo?></h3>
        				<h4 class="mt-none"><?php echo $obj->print_sottotitolo?></h4>
        			</a>
        			<div id="auto_<?php echo $obj->print_id?>" class="carousel slide" data-ride="carousel" data-interval="false"> 
        
        				<!-- Wrapper for slides -->
        
    					<div class="carousel-inner" role="listbox">
        					<div class="realtaAutounica"></div>
        					<div class="item active">
            				<?php

                            $this->debug->tryingToCreate("Etichetta", $method, 'stampaEtichetta()');
                            $this->stampaEtichetta($obj);

                            ?>
                                                            <!-- immagine principale-->
    						<a class="details" href="<?php echo $obj->print_url?>"> 
    						<img src="<?php echo $obj->print_img?>" alt='auto01' class="img-responsive" />
    						</a>        
    					</div>        
            
            			<?php

                        $this->debug->tryingToCreate("Immagini", $method, 'stampaImmagini()');
                        $this->stampaimmagini($obj);
                        ?>
            
        				<div class="item">
        					<a class="details" href="<?php echo $obj->print_url?>"> 
        						<img src="../images/scopri.png" class="img-responsive" />
        					</a>
        				</div>
        
    				</div>        
        				<!-- Left and right controls -->
        				<a class="left carousel-control" href="#auto_<?php echo $obj->print_id?>"
        					role="button" data-slide="prev"> <span class="fa m-control-left"
        					aria-hidden="true"></span> <span class="sr-only">Previous</span>
        				</a> <a class="right carousel-control"
        					href="#auto_<?php echo $obj->print_id?>" role="button" data-slide="next"> <span
        					class="fa m-control-right" aria-hidden="true"></span> <span
        					class="sr-only">Next</span>
        				</a>        
        			</div>        
        		</div>
        
        		<div class="col-lg-4 col-sm-12 col-xs-12 mt-elenco-auto">
        
        			<header
        				class="b-items__cars-one-info-header s-lineTopLeft s-lineDownLeft mb-elenco-auto">
        				<div class="risparmio"
        					style="position: absolute; text-align: left; color: #87d0ef;">
        					Risparmi<br> �9.500
        				</div>
        				<span><?php echo $obj->print_prezzo?></span>
        			</header>
        
    			<div class="b-items__cars-one-info">
                                                    
                        <p class="icon-carinfo km larg50"><?php echo$obj->print_km?></p>
        				<p class="icon-carinfo data larg50"><?php echo $obj->print_registration_date?></p>
        				<p class="icon-carinfo alimentazione larg50"><?php echo $obj->print_alimentazione?></p>                                       
        				<p	class="icon-carinfo potenza larg50"><?php echo $obj->print_kwatt?></p>
        				<p class="icon-carinfo cambio hidd larg50"><?php echo $obj->print_gearbox?></p>
        				<p class="icon-carinfo colore hidd larg50"><?php echo $obj->print_colore?></p>
        				<p class="icon-carinfo interni mb-none hidd larg50"><?php echo $obj->print_interni?></p>
        
        			</div>
        
        			<button type="submit" onclick="window.location='<?php echo $obj->print_url?>'"class="btn m-btn lightblue mt-md" style="width: 100%;">SCOPRI DI PIU</button>
      
        		</div>
        	</div>
        </div>

	<?php
    }
    
    public function stampaLista($obj)
    {  
        $method = 'stampaLista()';
        $this->debug->tryingToCreate('ListOfObjectToPrint', $method);
        $list = $obj::getList();
        //var_dump($list);
        $this->debug->tryingToCreate('ListOfObjectToPrint', $method);
        $list = (count($list) > 0) ? $list : $obj->getSuggestedList();
        
        foreach($list as $element):
            var_dump($element);
            $element->prepareFields();
            echo '$fields settes';
            $this->stampaScheda($element);        
        
        endforeach;    
    }
    
    
    
    
}

?>