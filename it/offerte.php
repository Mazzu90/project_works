<?
include('include_dir.php');
include($percorsoLingua.'include/include.php');

$grafica=new Tgrafica(false,false);
$grafica->titolo='';
$grafica->keywords='';
$grafica->description='';
$grafica->codicePagina=costantiP::CP_OFFERTE;
$grafica->codiceBody='page1';

$pagina = isset($_GET['pagina'])?$_GET['pagina']:1;

$grafica->paint();
unset ($dati);
unset($grafica);

function corpo_pagina()
{global $elencoConfigurazioniImmagini;
    ?>
       
                <?  
                $offerte = array();
                                $query = 'select
                                        * from news
                                        where 
                                           news.pubblicato = 1 
                                        order by 
                                            news.ordinamento asc, data_pubblicazione_inizio';
                                                   
                                        $result=mysql_query($query);
                                       	
                                        while ($row=mysql_fetch_assoc($result)) {
                                			$offerta['id']=$row['id'];
                                			$offerta['titolo']=$row['titolo'];
                                            $offerta['img']=$row['img'];
                                            $offerta['testo']=$row['testo'];
                                            $offerta['didascalia']=$row['didascalia'];
                                            $offerte[]=$offerta;
                                        }?>
                          
                                    
                                    
                                                        <?  foreach ($offerte as $off) {
                                                            ?>
                                                          
                                                            
                                                                <!-- offerta -->
                
                                                                <div class="thumbnail no-border no-padding thumbnail-car-card clearfix">
                                                                    <div class="media">
                                                                        <a class="media-link" data-gal="prettyPhoto" href="<?echo imgPubb($elencoConfigurazioniImmagini[IMG_RESIZE_DETTAGLIO_PRODOTTO], $off['img'], $ritorno=Timg::RESTITUISCI_URL_IMG);?>">
                                                                            <img src="<?echo imgPubb($elencoConfigurazioniImmagini[IMG_CROP_CATEGORIE_BOX], $off['img'], $ritorno=Timg::RESTITUISCI_URL_IMG);?>" alt=""/>
                                                                         
                                                                            <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="caption">
                                                                        
                                                                        <h4 class="caption-title"><a href="#"><?echo $off['titolo']?></a></h4>
                                                                        
                                                                        <div class="caption-text"><?echo $off['testo']?></div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <!-- /offerta -->
                                                            
                                                            
                                                            <?
                                                            }
                                                    ?>
                             

    <?
}

function HeaderAggiuntivi()
{
    ?>
     
    <?
    
}
        
?>