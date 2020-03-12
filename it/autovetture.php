<?
include('include_dir.php');
include($percorsoLingua.'include/include.php');

$grafica=new Tgrafica(false,false);
$grafica->titolo='';
$grafica->keywords='';
$grafica->description='';
$grafica->codicePagina=costantiP::CP_MARCHI;
$grafica->codiceBody='page1';
$pagina = isset($_GET['pagina'])?$_GET['pagina']:1;
$grafica->paint();

unset($grafica);

function corpo_pagina()
{
    ?>
		
	<?selezionaOccasione()?>
		
		<section class="b-pageHeader b-count pt-xxxxxl">
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
                    	<a href="<?echo costantiP::BASE_URL?>it/ricerca.php?gpl=true&metano=true&elettrica=true&ibrida=true">
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

    	<section class="b-detail__main p-none">
        	<div class="container">
                <div class="row">
					<div class="col-md-12">
						<h1>LE AUTO DI AUTOMOTIVE</h1>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.
							<br>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Erat velit scelerisque in dictum non consectetur a.<br>
							Tortor aliquam nulla facilisi cras fermentum odio eu feugiat pretium.<br>
							IN MOLTI VENDONO AUTO, NOI SELEZIONIAMO OCCASIONI.</p>
					</div>	
				</div>
                <!--
                <div class="row">
					
					<div class="b-detail__main-aside-about-form-links">
						<a href="#" class="j-tab marchi" data-to='#abarth'><img src="../images/loghi_auto/ABARTH.png"> ABARTH (12) <i class="icon-arrow-down icon"></i></a>
						<a href="#" class="j-tab marchi" data-to='#alfaromeo'><img src="../images/loghi_auto/ALFAROMEO.png"> ALFA ROMEO (9) <i class="icon-arrow-down icon"></i></a>
						<a href="#" class="j-tab marchi" data-to='#info3'><img src="../images/loghi_auto/ASTONMARTIN.png"> ASTON MARTIN (1) <i class="icon-arrow-down icon"></i></a>
						<a href="#" class="j-tab marchi" data-to='#info4'><img src="../images/loghi_auto/AUDI.png"> AUDI (20) <i class="icon-arrow-down icon"></i></a>
					</div>

					<div id="abarth" class="tab_marchi">
						<ul>
							<li><a href="#">114 (0)</a></li>
							<li><a href="#">116 (2)</a></li>
							<li><a href="#">118 (3)</a></li>
							<li><a href="#">120 (0)</a></li>
							<li><a href="#">123 (0)</a></li>
							<li><a href="#">125 (0)</a></li>
							<li><a href="#">130 (0)</a></li>
							<li><a href="#">135 (0)</a></li>
							<li><a href="#">140 (0)</a></li>
							<li><a href="#">214 (0)</a></li>
						</ul>
					</div>

					<div id="alfaromeo" class="tab_marchi">
						<ul>
							<li><a href="#">111 (0)</a></li>
							<li><a href="#">116 (2)</a></li>
							<li><a href="#">118 (3)</a></li>
							<li><a href="#">120 (0)</a></li>
							<li><a href="#">123 (0)</a></li>
							<li><a href="#">125 (0)</a></li>
							<li><a href="#">130 (0)</a></li>
							<li><a href="#">135 (0)</a></li>
							<li><a href="#">140 (0)</a></li>
							<li><a href="#">214 (0)</a></li>
						</ul>
					</div>
					
					<div id="info3" class="tab_marchi">
						<ul>
							<li><a href="#">112 (0)</a></li>
							<li><a href="#">116 (2)</a></li>
							<li><a href="#">118 (3)</a></li>
							<li><a href="#">120 (0)</a></li>
							<li><a href="#">123 (0)</a></li>
							<li><a href="#">125 (0)</a></li>
							<li><a href="#">130 (0)</a></li>
							<li><a href="#">135 (0)</a></li>
							<li><a href="#">140 (0)</a></li>
							<li><a href="#">214 (0)</a></li>
						</ul>
					</div>	
					
					<div id="info4" class="tab_marchi">
						<ul>
							<li><a href="#">116 (0)</a></li>
							<li><a href="#">116 (2)</a></li>
							<li><a href="#">118 (3)</a></li>
							<li><a href="#">120 (0)</a></li>
							<li><a href="#">123 (0)</a></li>
							<li><a href="#">125 (0)</a></li>
							<li><a href="#">130 (0)</a></li>
							<li><a href="#">135 (0)</a></li>
							<li><a href="#">140 (0)</a></li>
							<li><a href="#">214 (0)</a></li>
						</ul>
					</div>	

				</div>
                
                
                
                <div class="row">
					
					<div class="b-detail__main-aside-about-form-links">
						<a href="#" class="j-tab marchi" data-to='#bentley'><img src="../images/loghi_auto/BENTLEY.png"> BENTLEY (12) <i class="icon-arrow-down icon"></i></a>
						<a href="#" class="j-tab marchi" data-to='#bmw'><img src="../images/loghi_auto/BMW.png"> BMW (9) <i class="icon-arrow-down icon"></i></a>
						<a href="#" class="j-tab marchi" data-to='#chevrolet'><img src="../images/loghi_auto/CHEVROLET.png"> CHEVROLET (1) <i class="icon-arrow-down icon"></i></a>
						<a href="#" class="j-tab marchi" data-to='#chrysler'><img src="../images/loghi_auto/CHRYSLER.png"> CHRYSLER (20) <i class="icon-arrow-down icon"></i></a>
					</div>

					<div id="bentley" class="tab_marchi">
						<ul>
							<li><a href="#">114 (0)</a></li>
							<li><a href="#">116 (2)</a></li>
							<li><a href="#">118 (3)</a></li>
							<li><a href="#">120 (0)</a></li>
							<li><a href="#">123 (0)</a></li>
							<li><a href="#">125 (0)</a></li>
							<li><a href="#">130 (0)</a></li>
							<li><a href="#">135 (0)</a></li>
							<li><a href="#">140 (0)</a></li>
							<li><a href="#">214 (0)</a></li>
						</ul>
					</div>

					<div id="bmw" class="tab_marchi">
						<ul>
							<li><a href="#">111 (0)</a></li>
							<li><a href="#">116 (2)</a></li>
							<li><a href="#">118 (3)</a></li>
							<li><a href="#">120 (0)</a></li>
							<li><a href="#">123 (0)</a></li>
							<li><a href="#">125 (0)</a></li>
							<li><a href="#">130 (0)</a></li>
							<li><a href="#">135 (0)</a></li>
							<li><a href="#">140 (0)</a></li>
							<li><a href="#">214 (0)</a></li>
						</ul>
					</div>
					
					<div id="chevrolet" class="tab_marchi">
						<ul>
							<li><a href="#">112 (0)</a></li>
							<li><a href="#">116 (2)</a></li>
							<li><a href="#">118 (3)</a></li>
							<li><a href="#">120 (0)</a></li>
							<li><a href="#">123 (0)</a></li>
							<li><a href="#">125 (0)</a></li>
							<li><a href="#">130 (0)</a></li>
							<li><a href="#">135 (0)</a></li>
							<li><a href="#">140 (0)</a></li>
							<li><a href="#">214 (0)</a></li>
						</ul>
					</div>	
					
					<div id="chrysler" class="tab_marchi">
						<ul>
							<li><a href="#">116 (0)</a></li>
							<li><a href="#">116 (2)</a></li>
							<li><a href="#">118 (3)</a></li>
							<li><a href="#">120 (0)</a></li>
							<li><a href="#">123 (0)</a></li>
							<li><a href="#">125 (0)</a></li>
							<li><a href="#">130 (0)</a></li>
							<li><a href="#">135 (0)</a></li>
							<li><a href="#">140 (0)</a></li>
							<li><a href="#">214 (0)</a></li>
						</ul>
					</div>	

				</div>
				-->
                <?
                $sql = 'select                         
                    count(*) as numero
                from 
                    veicoli
                 where
                   veicoli.pubblicato = 1 ';
       
                $numero = GetFieldValue($sql, 'numero');
                stampaMarchi($numero);
                ?>
                
			
                </div >
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

function estraiNumeroVetture($idModello,$idMarca)
{

    $sql = 'SELECT  
                count(id) as numeroVeicoli
            FROM
                veicoli
            WHERE 
                veicoli.id_modello = '.$idModello.' and veicoli.id_marca = '.$idMarca;                    
            $result=mysql_query($sql);
            $data = mysql_fetch_assoc($result);
            return $data['numeroVeicoli'];            

}

function estraiNumeroVettureMarca($idMarca)
{

    $sql = 'SELECT  
                count(id) as numeroVeicoli
            FROM
                veicoli
            WHERE 
                veicoli.id_marca = '.$idMarca;   
                                 
            $result=mysql_query($sql);
            $data = mysql_fetch_assoc($result);
            return $data['numeroVeicoli'];            

}

function stampaMarchi($nMarchi, $start='1', $nXriga='4')
{
    $marche = array();
            $sql = 'SELECT  marca.id,
                            marca.titolo,
                            marca.titolo_normalizzato
                    FROM
                            marca
		            WHERE 
                            1=1 
                    ORDER BY titolo ASC
                    limit '.$start.','.$nXriga;
             
                   // marca.id in (select distinct id_marca from veicoli)

            $result=mysql_query($sql);

           	while ($row=mysql_fetch_assoc($result)) {
                    $marca['id']=$row['id'];
                    $marca['titolo']=$row['titolo'];

                    if  ($row['titolo_normalizzato']==''){
                                $row['titolo_normalizzato']=normalizzaTesto($row['titolo']);
                                $query="update marca set titolo_normalizzato = '".$row['titolo_normalizzato']."' where id = ".$row['id'];
                                mysql_query($query); 
                            }

                    $marca['titolo_normalizzato']=$row['titolo_normalizzato'];
                    $marca['numeroVetture']=estraiNumeroVettureMarca($row['id']);
                    $marche[]=$marca; 
                }
                
          echo '<div class="row">';
              echo '<div class="b-detail__main-aside-about-form-links marchi">';
                  foreach ($marche as $imgV) {
                    	$immagine= strtoupper(str_replace(' ', '', $imgV['titolo']));
                       
                        if (file_exists('../images/loghi_auto/'.$immagine.'.png') )
                        {
                            $immagine = '<img src="'.costantiP::BASE_URL.'images/loghi_auto/'.$immagine.'.png">';
                        }
                          
                         
                        echo '<a href="#" class="j-tab marchi" data-to="#'.$imgV['titolo_normalizzato'].'">'.$immagine .'<p>'.$imgV['titolo'].' ('.$imgV['numeroVetture'].') </p><i class="icon-arrow-down icon"></i></a>';
        			}
              echo '</div>';   //fine link
              
              foreach ($marche as $imgV) {
                    	stampaModelli($imgV);
                        }
          echo '</div>';   //fine row 4 marche
          
          $start = $start + $nXriga;
          
          if ($start<=$nMarchi)
            stampaMarchi($nMarchi, $start, $nXriga);
}

function stampaModelli($imgV)
    {
        $modelli = array();
                 $sql = 'SELECT  
                            modelli.id,
                            modelli.titolo,
                            modelli.titolo_normalizzato                            
                    FROM
                            modelli
		            WHERE 
                            modelli.id_categoria = '.$imgV['id'].'
                    ORDER BY titolo ASC
                    ';

                    //modelli.id in (select distinct id_modello from veicoli where id_marca = '.$imgV['id'].')
                   //modelli.id_categoria = '.$imgV['id'].'
                     $result=mysql_query($sql);
                        $result=mysql_query($sql);
                       while ($row=mysql_fetch_assoc($result)) {

                                $modello['id']=$row['id'];
                                $modello['titolo']=$row['titolo'];
                                $modello['titolo_normalizzato']=$row['titolo_normalizzato'];
                                $modello['numeroVeicoli']= estraiNumeroVetture($modello['id'],$imgV['id']);
                                $modelli[]=$modello; 
                            }
                        echo '<div id="'.$imgV['titolo_normalizzato'].'" class="tab_marchi">';
                        //echo '<ul>';
                        foreach ($modelli as $imgM) {
                            echo '<div class="col-md-3"><a href="'.costantiP::BASE_URL.costantiP::LINGUA.'/'.$imgV['titolo_normalizzato'].'/'.$imgM['titolo_normalizzato'].'/">'.$imgM['titolo'].' ('.$imgM['numeroVeicoli'].')</a></div>';
                            }
                      
                      //echo '</ul>';
                      echo '</div>';
                      	
    }
?>