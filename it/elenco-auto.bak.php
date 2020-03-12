<?
include('include_dir.php');
include($percorsoLingua.'include/include.php');

$grafica=new Tgrafica(false,false);
$grafica->titolo='';
$grafica->keywords='';
$grafica->description='';
$grafica->codicePagina=costantiP::CP_TUTTELEAUTO;
$grafica->codiceBody='page1';

$pagina = isset($_GET['pagina'])?$_GET['pagina']:1;

$grafica->paint();
unset($grafica);

function corpo_pagina()
{
    
    $elencoAuto = array();
                            $query = 'select 
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
                                            veicoli.pubblicato = 1 
                                        order by 
                                            veicoli.prezzo asc';
                            
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
    
    ?>
    
		
        

		<section class="b-items s-shadow">
			<div class="container">
				<div class="row b-bottom">
                	
                    <div class="col-lg-4 col-sm-5 col-xs-12 pl-none">
                    	<div class="col-lg-12 col-sm-12 col-xs-12">
                            <aside class="b-items__aside">
                                <h2 class="s-title">TROVA LA TUA AUTO</h2>
                                <div class="b-items__aside-main">
                                    <form>
                                        <div class="b-items__aside-main-body">
                                            <div class="b-items__aside-main-body-item">
                                                <label>FASCIA DI PREZZO</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-12 pl-none pr-xs">
                                                    <a href="#" class="btn m-btn filter   mt-none" data--delay="0.5s">fino a 5.000 €</a>
                                                </div>
                                                <div class="col-lg-6 col-sm-6 col-xs-12 pl-xs pr-none">
                                                    <a href="#" class="btn m-btn filter   mt-none" data--delay="0.5s">da 5.000 € a 10.000 €</a>
                                                </div>
                                                <div class="col-lg-6 col-sm-6 col-xs-12 pl-none pr-xs">
                                                    <a href="#" class="btn m-btn filter   mt-none mb-xlg" data--delay="0.5s">da 10.000 € a 15.000 €</a>
                                                </div>
                                                <div class="col-lg-6 col-sm-6 col-xs-12 pl-xs pr-none">
                                                    <a href="#" class="btn m-btn filter   mt-none mb-xlg" data--delay="0.5s">oltre i 15.000 €</a>
                                                </div>
                                            </div>
                                            <div class="b-items__aside-main-body-item">
                                                <label>CARROZZERIA</label>
                                                <div>
                                                    <select name="select1" class="m-select filter">
                                                    
                                                        <?
                                                            $query = 'select distinct
                                        veicoli.body from 
                                            veicoli 
                                        where
                                            veicoli.pubblicato = 1 
                                        order by 
                                            veicoli.body asc';
                            
                            $result=mysql_query($query);
                           	
                            while ($row=mysql_fetch_assoc($result)) {
                                echo '<option value="'.$row['body'].'" selected="">'.$row['body'].'</option>';
                    		 }
                                                        
                                                        ?>
                                                    
                                                    </select>
                                                    <span class="fa fa-angle-down fa-4x"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="b-items__aside-main-body-item">
                                                <label>TIPOLOGIA DI CAMBIO</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-12 pl-none pr-none">
                                                    <div class="col-lg-6 col-sm-6 col-xs-12 pl-none">
                                                        <a href="#" class="btn m-btn filter   mt-none mb-xlg" data--delay="0.5s">A</a>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-12 pl-none">
                                                        <a href="#" class="btn m-btn filter   mt-none mb-xlg" data--delay="0.5s">M</a>
                                                    </div>	
                                                </div>
                                            </div>
                                            <br clear="all">
                                             <div class="b-items__aside-main-body-item">
                                                <label>ALIMENTAZIONE</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-12 pl-none pr-none">
                                                    <div class="col-lg-6 col-sm-6 col-xs-12 pl-none">
                                                        <a href="#" class="btn m-btn filter   mt-none" data--delay="0.5s">BENZINA</a>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-12 pl-none">
                                                        <a href="#" class="btn m-btn filter   mt-none" data--delay="0.5s">DIESEL</a>
                                                    </div>	
                                                </div>
                                                <div class="col-lg-6 col-sm-6 col-xs-12 pl-none pr-none">
                                                    <div class="col-lg-6 col-sm-6 col-xs-12 pl-none">
                                                        <a href="#" class="btn m-btn filter   mt-none" data--delay="0.5s">GPL</a>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-12 pl-none pr-none">
                                                        <a href="#" class="btn m-btn filter   mt-none" data--delay="0.5s">METANO</a>
                                                    </div>		
                                                </div>
                                                <div class="col-lg-6 col-sm-6 col-xs-12 pl-none pr-none">
                                                    <div class="col-lg-6 col-sm-6 col-xs-12 pl-none">
                                                        <a href="#" class="btn m-btn filter   mt-none mb-xlg" data--delay="0.5s">ELETTR.</a>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-12 pl-none">
                                                        <a href="#" class="btn m-btn filter   mt-none mb-xlg" data--delay="0.5s">IBRIDA</a>
                                                    </div>		
                                                </div>
                                            </div>
                                            <br clear="all">
                                            <div class="b-items__aside-main-body-item">
                                                <label>MARCA</label>
                                                <div>
                                                    <select name="select1" class="m-select filter">
                                                        <option value="" selected="">AUDI</option>
                                                        <option value="" selected="">ASTON MARTIN</option>
                                                        <option value="" selected="">BMW</option>
                                                        <option value="" selected="">CITROEN</option>
                                                        <option value="" selected="">FERRARI</option>
                                                        <option value="" selected="">FIAT</option>
                                                        <option value="" selected="">FORD</option>
                                                        <option value="" selected="">MERCEDES</option>
                                                        <option value="" selected="">OPEL</option>
                                                        <option value="" selected="">PORSCHE</option>
                                                        <option value="" selected="">SEAT</option>
                                                    </select>
                                                    <span class="fa fa-angle-down fa-4x"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <footer class="b-items__aside-main-footer">
                                            <button type="submit" class="btn m-btn f-right mt-none mb-md">CERCA</button><br />
                                            <br clear="all">
                                            <a class="f-right" href=""><span class="icon-aperta-quadra"></span>RICERCA AVANZATA<span class="icon-plus"></span><span class="icon-chiusa-quadra"></span></a>
                                            <br>
                                            <button type="submit" class="btn m-btn m-btm-gradient2 f-right mt-md">AUTO X NEOPATENTATI</button><br />
                                        </footer>
                                    </form>
                                </div>
                            </aside>
                        </div>
                    </div>
                    
                    <div class="col-lg-8 col-sm-7 col-xs-12 pr-none">
                        
                          <?
                          foreach ($elencoAuto as $veicolo) {
                            ?>
                                
                                    <div class="col-lg-12 col-sm-12 col-xs-12 mb-xl pr-none">
                            <div class="b-items__cars-one  " data--delay="0.5s">
                                    <div class="col-lg-8 col-sm-8 col-xs-12">
                                        <h3 class="mb-none"><?echo $veicolo['make'].''.$veicolo['model']?></h3>
                                        <h4 class="mt-none"><?echo $veicolo['version']?></h4>
                                        <img src="<?echo costanti::IMG_PERCORSO_BASE.costanti::IMG_PERCORSO_ORIGINALE.$veicolo['img']?>" alt='auto01' class="img-responsive"/>
                                        
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
                            
                                                    </div>
                                                </div>
                                            </div>
                                        </section><!--b-modal-->
    
                                        <a data-toggle="modal" data-target="#myModal<?echo $veicolo['id']?>" href="#" class="b-items__cars-one-img-video"><span class="fa fa-search fa-2x"></span></a>
                                        
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-xs-12">
                                        <header class="b-items__cars-one-info-header s-lineTopLeft s-lineDownLeft mb-xl"><span><?echo $veicolo['prezzo']?> €</span></header>
                                        <div class="b-items__cars-one-info">
                                            <p class="icon-carinfo km mb-sm"><?echo $veicolo['km']?> Km</p>
                                            <p class="icon-carinfo data mb-sm"><?echo estraiDataAuto($veicolo['registration_date'])?></p>
                                            <p class="icon-carinfo alimentazione mb-sm"><?echo $veicolo['alimentazione']?></p>
                                            <? $cavalli = $veicolo['kwatt']*1000/735.49875 ?>
                                            <p class="icon-carinfo potenza mb-sm"><?echo $veicolo['kwatt']?> KW / <?echo round($cavalli,0)?> CV</p>
                                            <p class="icon-carinfo cambio mb-sm"><?echo $veicolo['gearbox']?></p>
                                            <p class="icon-carinfo colore mb-sm"><?echo $veicolo['colore']?></p>
                                            <p class="icon-carinfo interni"><?echo $veicolo['interni']?></p>
                                            
                                            <div class="b-items__cars-one-info-details">
                                                <a class="details" href="dettaglio-auto.php?id=<?echo $veicolo['id']?>">DETTAGLIO <span class="icon-plus"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?
                            
                          }
                            
                            
                            
                            
                            
                            ?>
                        
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-xl pr-none">
                            <div class="b-items__cars-one  " data--delay="0.5s">
                                    <div class="col-lg-8 col-sm-8 col-xs-12">
                                        <h3 class="mb-none">Audi TT 3.0 V6 T Quattro</h3>
                                        <h4 class="mt-none">Advanced S-line</h4>
                                        <img src="../images/auto01.jpg" alt='auto01' class="img-responsive"/>
                                        
                                        <section class="b-modal">
                                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Audi TT 3.0 V6 T Quattro Advanced S-line</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="../images/auto01.jpg" alt='auto01' class="img-responsive"/>
                                                        </div>
                            
                                                    </div>
                                                </div>
                                            </div>
                                        </section><!--b-modal-->
    
                                        <a data-toggle="modal" data-target="#myModal" href="#" class="b-items__cars-one-img-video"><span class="fa fa-search fa-2x"></span></a>
                                        
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-xs-12">
                                        <header class="b-items__cars-one-info-header s-lineTopLeft s-lineDownLeft mb-xl"><span>43.000 €</span></header>
                                        <div class="b-items__cars-one-info">
                                            <p class="icon-carinfo km mb-sm">106.000 Km</p>
                                            <p class="icon-carinfo data mb-sm">Novembre 2014</p>
                                            <p class="icon-carinfo alimentazione mb-sm">Benzina</p>
                                            <p class="icon-carinfo potenza mb-sm">180 KW / 245 CV</p>
                                            <p class="icon-carinfo cambio mb-sm">Automatico</p>
                                            <p class="icon-carinfo colore mb-sm">Bianco metallizato</p>
                                            <p class="icon-carinfo interni">Pelle nera</p>
                                            
                                            <div class="b-items__cars-one-info-details">
                                                <a class="details" href="dettaglio-auto.php">DETTAGLIO <span class="icon-plus"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-xl pr-none">
                            	<div class="b-items__cars-one  " data--delay="0.5s">
                                    <div class="col-lg-8 col-sm-8 col-xs-12">
                                        <h3 class="mb-none">Jeep Wrangler 2.8 CRD</h3>
                                        <h4 class="mt-none">Unlimited</h4>
                                        <img src="../images/auto02.jpg" alt='auto02' class="img-responsive"/>
                                        
                                        <section class="b-modal">
                                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Jeep Wrangler 2.8 CRD Unlimited</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="../images/auto02.jpg" alt='auto02' class="img-responsive"/>
                                                        </div>
                            
                                                    </div>
                                                </div>
                                            </div>
                                        </section><!--b-modal-->
    
                                        <a data-toggle="modal" data-target="#myModal" href="#" class="b-items__cars-one-img-video"><span class="fa fa-search fa-2x"></span></a>
                                        
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-xs-12">
                                        <header class="b-items__cars-one-info-header s-lineTopLeft s-lineDownLeft mb-xl"><span>29.000 €</span></header>
                                        <div class="b-items__cars-one-info">
                                            <p class="icon-carinfo km mb-sm">70.000 Km</p>
                                            <p class="icon-carinfo data mb-sm">Marzo 2013</p>
                                            <p class="icon-carinfo alimentazione mb-sm">Diesel</p>
                                            <p class="icon-carinfo potenza mb-sm">120 KW / 180 CV</p>
                                            <p class="icon-carinfo cambio mb-sm">Manuale</p>
                                            <p class="icon-carinfo colore mb-sm">Grigio metallizato</p>
                                            <p class="icon-carinfo interni">Alcantara grigio</p>
                                            
                                            <div class="b-items__cars-one-info-details">
                                                <a class="details" href="dettaglio-auto.php">DETTAGLIO <span class="icon-plus"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-xl pr-none">
							<div class="b-items__cars-one  " data--delay="0.5s">
								<div class="col-lg-8 col-sm-8 col-xs-12">
                                    <h3 class="mb-none">Mini Cooper S 1.5 D</h3>
                                    <h4 class="mt-none">Cooper</h4>
									<img src="../images/auto03.jpg" alt='auto03' class="img-responsive"/>
                                    
                                    <section class="b-modal">
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">Mini Cooper S 1.5 D Cooper</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="../images/auto03.jpg" alt='auto03' class="img-responsive"/>
                                                    </div>
                        
                                                </div>
                                            </div>
                                        </div>
                                    </section><!--b-modal-->

                                    <a data-toggle="modal" data-target="#myModal" href="#" class="b-items__cars-one-img-video"><span class="fa fa-search fa-2x"></span></a>
                                    
								</div>
								<div class="col-lg-4 col-sm-4 col-xs-12">
									<header class="b-items__cars-one-info-header s-lineTopLeft s-lineDownLeft mb-xl"><span>18.500 €</span></header>
                                    <div class="b-items__cars-one-info">
                                        <p class="icon-carinfo km mb-sm">70.000 Km</p>
                                        <p class="icon-carinfo data mb-sm">Marzo 2013</p>
                                        <p class="icon-carinfo alimentazione mb-sm">Diesel</p>
                                        <p class="icon-carinfo potenza mb-sm">120 KW / 180 CV</p>
                                        <p class="icon-carinfo cambio mb-sm">Manuale</p>
                                        <p class="icon-carinfo colore mb-sm">Grigio metallizato</p>
                                        <p class="icon-carinfo interni">Alcantara grigio</p>
                                        
                                        <div class="b-items__cars-one-info-details">
											<a class="details" href="dettaglio-auto.php">DETTAGLIO <span class="icon-plus"></span></a>
                                        </div>
                                	</div>
								</div>
                            </div>
						</div>
                    </div>
                    <!--<div class="b-items__pagination  " data--delay="0.5s">
                        <div class="b-items__pagination-main">
                            <a href="#" class="m-left"><span class="fa fa-angle-left"></span></a>
                            <span class="m-active"><a href="#">1</a></span>
                            <span><a href="#">2</a></span>
                            <span><a href="#">3</a></span>
                            <span><a href="#">4</a></span>
                            <a href="#" class="m-right"><span class="fa fa-angle-right"></span></a>    
                        </div>
                    </div>-->
					</div>
				</div>
			</div>
		</section><!--b-items-->
        
        <section class="b-featured caffe">
			<div class="container">
				<h1 class="mb-none mt-none" data--delay="0.3s">LA TUA AUTO,</h1>
                <h1 class="mb-none mt-none" data--delay="0.3s">UNA SCELTA IMPORTANTE</h1>
                <h3 class="mb-none mt-none" data--delay="0.3s">BEVIAMO UN CAFFÈ INSIEME E RAGIONIAMOCI</h3>
                <br><br>
                <div class="link"><a href="">SCOPRI DI PIù ></a></div>
			</div>
		</section><!--b-featured-->
        
        <section class="b-featured autenticita">
			<div class="container">
				<h1 class="mb-none mt-none" data--delay="0.3s">UNA STORIA AUTENTICA</h1>
                <h1 class="mb-none mt-none" data--delay="0.3s">DA RACCONTARE</h1>
                <h3 class="mb-none mt-none" data--delay="0.3s">LA CERTIFICAZIONE KILOMETRICA AUTOUNICA</h3>
                <br><br>
                <div class="link"><a href="">SCOPRI DI PIù ></a></div>
			</div>
		</section><!--b-featured-->


    <?
}

function HeaderAggiuntivi()
{
    ?>
   
  
    <?
    
}
        
?>
