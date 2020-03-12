<?



if (!(isset($lInclude)&&($lInclude)))

{

    include('include_dir.php');

    include($percorsoLingua.'include/include.php');

    

    $grafica=new Tgrafica(false,false);

    //$idVeicolo = isset($_GET['id'])?$_GET['id']:0;

    

}

$idMarca = isset($_GET['urlCA'])?$_GET['urlCA']:-1;

$idModello = isset($_GET['urlCO'])?$_GET['urlCO']:-1;



if (

        (costantiP::URL_REWRITE_ATTIVO) /*verifico che nel file /it/include_cliente/const_cliente la costante URL_REWRITE_ATTIVO sia a true e quindi l'url rewrite sia attivo*/

        &&

        /*verifico che la variabile di controllo di provenienza dalla pagina seo_gatewqay esista; se esiste vuol dire che arrivo dalla seo gateway, in caso contrario*/

        (

            (!isset($lUrlRewrite))   

            ||

            /*verifico che sia anche valorizzata a true*/

            (!$lUrlRewrite)

        )

    )

{

    

    /*

    questo controllo serve per verificare che la pagina contenuto venga chiamata solo dalla pagina seo_gateway;

    se si tutto ok, se no devo redirigere l'utente all'url riscritto corretto.

    */

     $sql = 'select 

                modelli.id AS id_modello,

                modelli.titolo AS titolo_modello,

                modelli.titolo_normalizzato AS titolo_modello_normalizzato ,

                marca.id AS id_marca,

                marca.titolo AS titolo_marca,

                marca.titolo_normalizzato AS titolo_marca_normalizzato

            from

                modelli

            inner join marca

            on modelli.id_categoria = marca.id

             where modelli.titolo_normalizzato = "'.$idModello.'"';

             

   $rs = mysql_query($sql);

    if (mysql_num_rows($rs)>0)

    {

        $url = costantiP::BASE_URL.costantiP::LINGUA.'/'.$row['titolo_marca_normalizzato'].'/'.$row['titolo_modello_normalizzato'].'/';

        header ('HTTP/1.1 301 Moved Permanently');

        header('location: '.$url);

    }

}





   $sql = 'select 

                modelli.id AS id_modello,

                modelli.titolo AS titolo_modello,

                modelli.titolo_normalizzato AS titolo_modello_normalizzato ,

                marca.id AS id_marca,

                marca.titolo AS titolo_marca,

                marca.titolo_normalizzato AS titolo_marca_normalizzato,

                modelli.testo

            from

                modelli

            inner join marca

            on modelli.id_categoria = marca.id

             where modelli.titolo_normalizzato = "'.$idModello.'"';

    

    if (!GetRecord( $sql , $rowMarca))

    {

        $url = costantiP::BASE_URL.costantiP::LINGUA.'/ricerca.php';

        header('location: '.$url);

    };

        



$grafica->titolo=$rowMarca['titolo_marca'].' '.$rowMarca['titolo_modello'].' usata - Brescia - AUTOUNICA srl';

$grafica->keywords=$rowMarca['titolo_marca'].' '.$rowMarca['titolo_modello'].', auto usate, veicoli usati, vendita auto usate Brescia';

//$grafica->description='Ampio showroom con oltre 200 vetture disponibili, '.$rowMarca['titolo_marca'].' '.$rowMarca['titolo_modello'].' in vendita presso il nostro Showroom in via Valcamonica a Brescia';

$grafica->description=$rowMarca['titolo_marca'].' '.$rowMarca['titolo_modello']." usata in vendita presso il nostro Showroom in via Valcamonica a Brescia scopri i modelli disponibili";

$grafica->codicePagina=costantiP::CP_TUTTELEAUTO;

$grafica->codiceBody='page1';









$marca = $rowMarca['id_marca'];

$modello = $rowMarca['id_modello'];









$grafica->paint();

unset($grafica);



function corpo_pagina()

{global $rowMarca,$prezzo, $carrozzeria, $cambio, $benzina, $diesel, $gpl, $metano, $elettrica, $ibrida, $marca, $modello, $neopatentati, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina ;

 

        $checkedPrezzo1='';

        $checkedPrezzo2='';

        $checkedPrezzo3='';

        $checkedPrezzo4='';

    //preparo i bottoni attivi o meno  

       if ($prezzo>0)

    {

        

        

        switch ($prezzo) {

            case 1:

                $checkedPrezzo1='checked="checked"';

                break;

            case 2:

                $checkedPrezzo2='checked="checked"';

                break;

            case 3:

                $checkedPrezzo3='checked="checked"';

                break;

            case 4:

                $checkedPrezzo4='checked="checked"';

                break;

        }

    }

    

    $checkedCambio1='';

    $checkedCambio2='';

    if ($cambio!='')

            {

            

            

            switch ($cambio) {

                case 1:

                    $checkedCambio1='checked="checked"';

                    break;

                case 2:

                    $checkedCambio2='checked="checked"';

                    break;

            }

        }     

    

    $checkedBenzina='';

    if ($benzina==true)

        $checkedBenzina ='checked="checked"';

    $checkedDiesel = '';

    if ($diesel==true)

        $checkedDiesel ='checked="checked"';

    $checkedGpl='';

    if ($gpl==true)

        $checkedGpl ='checked="checked"';

    $checkeMetano = '';

    if ($metano==true)

        $checkeMetano ='checked="checked"';

    $checkedElettrica='';

    if ($elettrica==true)

        $checkedElettrica ='checked="checked"';

    $checkedIbrida = '';

    if ($ibrida==true)

        $checkedIbrida ='checked="checked"';



      

                            

    

    ?>



		<section class="b-items b-search s-shadow">

			<div class="container">

				<div class="row b-bottom">

                	

                    <div class="b-search__main-type col-lg-4 col-sm-5 col-xs-12 pl-none">

                    	<div class="col-lg-12 col-sm-12 col-xs-12">

                     

                            <div class="accordion" id="refine">

                                <div class="visible-phone">

                                    <div class="accordion-heading">

                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#refine" href="#refine-search">

                                            <legend>

                                                <h3>Mostra filtri</h3>

                                            </legend>

                                        </a>

                                    </div>

                                </div>

                            </div>

                            <div id="refine-search" class="accordion-body collapse in">

                     

                            <aside class="b-items__aside">

                               <div id="posizione">

                                <h2 class="s-title">TROVA LA TUA AUTO</h2>

                                <div class="b-items__aside-main">

                                    <form class="b-search__main" action="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/ricerca.php" method="GET">

                                        <div class="b-items__aside-main-body">

                                            <div class="b-items__aside-main-body-item">

                                                <label>FASCIA DI PREZZO</label>

                                                <div class="col-lg-6 col-sm-6 col-xs-12 pl-none pr-xs">

                                                    <input id="type1" type="radio" name="prezzo" value="1" <?echo $checkedPrezzo1?> />

                                                    <label for="type1" class="b-search__main-type-svg"></label>

                                                    <h5><label for="type1">fino a 5.000 €</label></h5>

                                                </div>

                                                <div class="col-lg-6 col-sm-6 col-xs-12 pl-xs pr-none">

                                                	<input id="type2" type="radio" name="prezzo" value="2" <?echo $checkedPrezzo2?>/>

                                                    <label for="type2" class="b-search__main-type-svg"></label>

                                                    <h5><label for="type2">da 5.000 € a 10.000 €</label></h5>

                                                </div>

                                                <div class="col-lg-6 col-sm-6 col-xs-12 pl-none pr-xs">

                                                	<input id="type3" type="radio" name="prezzo" value="3" <?echo $checkedPrezzo3?>/>

                                                    <label for="type3" class="b-search__main-type-svg"></label>

                                                    <h5><label for="type3">da 10.000 € a 15.000 €</label></h5>

                                                </div>

                                                <div class="col-lg-6 col-sm-6 col-xs-12 pl-xs pr-none">

                                                	<input id="type4" type="radio" name="prezzo" value="4" <?echo $checkedPrezzo4?>/>

                                                    <label for="type4" class="b-search__main-type-svg"></label>

                                                    <h5><label for="type4">oltre i 15.000 €</label></h5>

                                                </div>        

                                            </div>

                                            

                                            <br clear="all"><br>

                                            

                                            <div class="b-items__aside-main-body-item">

                                                <label>MARCA</label>

                                                <div>

                                                    <select name="marca" class="m-select filter" id="marca">

                                                

                                                 <?

                                                      $query = 'SELECT  marca.id,

                                                                        marca.titolo

                                                                FROM

                                                                        marca

                                            		            WHERE 

                                                                        marca.id in (select distinct id_marca from veicoli where veicoli.pubblicato = 1)

                                                                ORDER BY titolo ASC

                                                         ';

                                                        

                                                        $result=mysql_query($query);

                                                        

                                                        $selectedMake = '';

                                                            if ($marca == '')

                                                                {

                                                                    $selectedMake = 'selected="selected"';

                                                                }

                                                            echo '<option value="" '.$selectedMake.'>Tutto</option>';

                                                       	

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

                                            

                                            <div class="b-items__aside-main-body-item">

                                                <label>MODELLO</label>

                                                

                                                <div>

                                                    <select name="modello" class="m-select filter" id="modello2">

                                                    <option value="-1">Scegli Modello...</option>

                                                    </select>

                                                    <span class="fa fa-angle-down fa-4x"></span>

                                                </div>

                                             </div>

                                            

                                            

                                            <div class="b-items__aside-main-body-item">

                                                <label>CARROZZERIA</label>

                                                <div>

                                                    <select name="carrozzeria" class="m-select filter">

                                                    

                                                        <?

                                                            $query = 'select distinct

                                        veicoli.body from 

                                            veicoli 

                                        where

                                            veicoli.pubblicato = 1 

                                        order by 

                                            veicoli.body asc';

                            

                            $result=mysql_query($query);

                           	$selectedBody = '';

                            if ($carrozzeria == '')

                                {

                                    $selectedBody = 'selected="selected"';

                                }

                            echo '<option value="" '.$selectedBody.'>Tutto</option>';

                            

                            while ($row=mysql_fetch_assoc($result)) {

                                if ($carrozzeria == $row['body'])

                                {

                                    $selectedBody = 'selected="selected"';

                                }

                                else

                                {

                                    $selectedBody = '';

                                }

                                    

                                echo '<option value="'.$row['body'].'" '.$selectedBody.'>'.$row['body'].'</option>';

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

                                                        <input id="type5" type="radio" name="cambio" value="1" <?echo $checkedCambio1?>/>

                                                        <label for="type5" class="b-search__main-type-svg"></label>

                                                        <h5><label for="type5">A</label></h5>

                                                    </div>

                                                    <div class="col-lg-6 col-sm-6 col-xs-12 pl-none">

                                                        <input id="type6" type="radio" name="cambio" value="2" <?echo $checkedCambio2?> />

                                                        <label for="type6" class="b-search__main-type-svg"></label>

                                                        <h5><label for="type6">M</label></h5>

                                                    </div>	

                                                </div>

                                            </div>

                                            

                                            <br clear="all"><br>

                                           

                                             <div class="b-items__aside-main-body-item">

                                                <label>ALIMENTAZIONE</label>

                                                <div class="col-lg-6 col-sm-6 col-xs-12 pl-none pr-none">

                                                    <div class="col-lg-6 col-sm-6 col-xs-12 pl-none">

                                                        <input id="type7" type="checkbox" name="benzina" value="true" <?echo $checkedBenzina?> />

                                                        <label for="type7" class="b-search__main-type-svg"></label>

                                                        <h5><label for="type7">BENZINA</label></h5>

                                                    </div>

                                                    <div class="col-lg-6 col-sm-6 col-xs-12 pl-none">

                                                        <input id="type8" type="checkbox" name="diesel" value="true" <?echo $checkedDiesel?> />

                                                        <label for="type8" class="b-search__main-type-svg"></label>

                                                        <h5><label for="type8">DIESEL</label></h5>

                                                    </div>

                                                </div>

                                                <div class="col-lg-6 col-sm-6 col-xs-12 pl-none pr-none">

                                                    <div class="col-lg-6 col-sm-6 col-xs-12 pl-none">

                                                        <input id="type9" type="checkbox" name="gpl" value="true" <?echo $checkedGpl?> />

                                                        <label for="type9" class="b-search__main-type-svg"></label>

                                                        <h5><label for="type9">GPL</label></h5>

                                                    </div>

                                                    <div class="col-lg-6 col-sm-6 col-xs-12 pl-none pr-none">

                                                        <input id="type10" type="checkbox" name="metano" value="true" <?echo $checkeMetano?> />

                                                        <label for="type10" class="b-search__main-type-svg"></label>

                                                        <h5><label for="type10">METANO</label></h5>

                                                    </div>

                                                </div>

                                                <div class="col-lg-6 col-sm-6 col-xs-12 pl-none pr-none">

                                                    <div class="col-lg-6 col-sm-6 col-xs-12 pl-none">

                                                        <input id="type11" type="checkbox" name="elettrica" value="true" <?echo $checkedElettrica?> />

                                                        <label for="type11" class="b-search__main-type-svg"></label>

                                                        <h5><label for="type11">ELETTR.</label></h5>

                                                    </div>

                                                    <div class="col-lg-6 col-sm-6 col-xs-12 pl-none">

                                                        <input id="type12" type="checkbox" name="ibrida" value="true" <?echo $checkedIbrida?> />

                                                        <label for="type12" class="b-search__main-type-svg"></label>

                                                        <h5><label for="type12">IBRIDA</label></h5>

                                                    </div>		

                                                </div>

                                            </div>

                                            

                                            

                                            

                                        </div>

                                        

                                         <br clear="all"><br>

                                        <footer class="b-items__aside-main-footer">

                                            <a class="f-left mt-sm reset" href="<?echo costantiP::BASE_URL.costantiP::LINGUA?>/ricerca.php?r=1"><span class="icon-aperta-quadra"></span>RESET FILTRI<span class="icon-chiusa-quadra"></span></a>

                                            

                                            <button type="submit" class="btn m-btn f-right mt-none mb-md">CERCA</button><br />

                                            </form>

                                            

                                            <form class="b-search__main" action="ricerca.php" method="POST">

                                                <input type="hidden" id="neopantentati" name="neopatentati" value="1" />

                                                <button type="submit" class="btn m-btn m-btm-gradient2 f-right mt-md">AUTO X NEOPATENTATI</button>

                                            </form><br />

                                        </footer>

                                    </div>

                                </div><!-- /posizione-->

                            </aside>

                            </div> <!-- /accordion -->

                        </div>

                    </div>

                    

                    <div class="col-lg-8 col-sm-7 col-xs-12 pr-none">

                    <? define('FIRST', 0);

                        define('LIMIT', 10);?>

                        <input type="hidden" id="first" value="<?php echo FIRST+10; ?>" />

                        <input type="hidden" id="limit" value="<?php echo LIMIT; ?>" />



                        <div id="elencoauto">

                        <div class="col-lg-12 col-sm-12 col-xs-12 mb-xl pr-none pl-xlg">

                                <h2 class="mt-none"><?echo $rowMarca['titolo_marca'].' '.$rowMarca['titolo_modello']?></h2>

                                <?echo $rowMarca['testo']?>

                        </div>

                          <?

                          //estraggo le auto del modello richiesto

                          $elencoAuto = estraiVeicoli2($prezzo, $carrozzeria, $cambio, $benzina, $diesel, $gpl, $metano, $elettrica, $ibrida, $marca, $modello, $neopatentati, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina, FIRST,LIMIT);

                          

                          

                          

                          //verifico se ho auto di quel modello altrimenti estraggo auto della stessa marca ma di modello differente

                          if (!$elencoAuto || $elencoAuto =='')

                              {

                                /*

                                // ESTRAGGO TUTTE LE AUTO DISPONIBILI PER LA STESSA MARCA

                                $testoAlt = '<div class="col-lg-12 col-sm-12 col-xs-12 mb-xl pr-none pl-xlg">';

                                $testoAlt .= '<h2>Nessun annuncio disponibile per i criteri di ricerca selezionati. Ecco altre proposte '.$rowMarca['titolo_marca'].'</h2>';  

                                $testoAlt .= '</div>';

                                $modello = '';

                                $elencoAuto = estraiVeicoli2($prezzo, $carrozzeria, $cambio, $benzina, $diesel, $gpl, $metano, $elettrica, $ibrida, $marca, $modello, $neopatentati, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina, FIRST,LIMIT);

                                

                                if (!$elencoAuto || $elencoAuto =='')

                                          {

                                            $testoAlt =  '<div class="col-lg-12 col-sm-12 col-xs-12 mb-xl pr-none pl-xlg">';

                                            $testoAlt .=  '<h2>Ci dispiace. In questo momento nessun annuncio risponde ai tuoi criteri di ricerca. Ecco altre proposte dal nostro autosalone</h2>';  

                                            $testoAlt .=  '</div>';

                                            $modello = '';

                                            $marca = '';

                                            $elencoAuto = estraiVeicoli2($prezzo, $carrozzeria, $cambio, $benzina, $diesel, $gpl, $metano, $elettrica, $ibrida, $marca, $modello, $neopatentati, $pagina, $nContenutiDaEstrarre, $numeroRecordPerPagina, FIRST,LIMIT);

                                          } 

                                      

                                echo $testoAlt; 

                                */

                                

                               //VERIFICO SE CI SONO AUTO DELLA STESSA MARCA

                               

                                $sql = "SELECT COUNT(*) AS count FROM veicoli where id_marca = ".$marca;

                                        $result = mysql_query($sql);

                                        $row = mysql_fetch_assoc($result);

                                        $count = $row['count'];

                                        

                                        

                                        if ($count>0)

                                            {//SE ci sono vetture 

                                                $testoAlt = '<div class="col-lg-12 col-sm-12 col-xs-12 mb-xl pr-none pl-xlg">';

                                                $testoAlt .= '<h2>Nessun annuncio disponibile per i criteri di ricerca selezionati.</h2>';  

                                                $testoAlt .= '<br /><h4><a href="'.costantiP::BASE_URL.costantiP::LINGUA.'/ricerca.php?marca='.$marca.'">Visualizza le altre <strong>'.$count.'</strong> '.$rowMarca['titolo_marca'].' attualmente disponibili nel nostro autosalone.</a></h4>';

                                                $testoAlt .=  '</div>';

                                            }

                                        else

                                            {

                                             

                                                $sql = "SELECT COUNT(*) AS count FROM veicoli";

                                        

                                                $result = mysql_query($sql);

                                                $row = mysql_fetch_assoc($result);

                                                $count = $row['count'];

                                                

                                                $testoAlt =  '<div class="col-lg-12 col-sm-12 col-xs-12 mb-xl pr-none pl-xlg">';

                                                $testoAlt .=  '<h2>Ci dispiace. In questo momento nessun annuncio risponde ai tuoi criteri di ricerca.</h2>'; 

                                                $testoAlt .= '<br /><h4><a href="'.costantiP::BASE_URL.costantiP::LINGUA.'/ricerca.php">Visualizza le altre <strong>'.$count.'</strong> proposte attualmente disponibili nel nostro autosalone</a></h4>';

                                                $testoAlt .=  '</div>';

                                                 

                                            }

                                        

                                        echo $testoAlt;         

                              }

                          

                          

                          ?>

                          <input type="hidden" id="id_marca" value="<?php echo $marca; ?>" />

                          <input type="hidden" id="id_modello" value="<?php echo $modello; ?>" />    

                          <?  

                            

                          foreach ($elencoAuto as $veicolo) {

                          

                            if (costantiP::URL_REWRITE_ATTIVO)

                                    {

                                        $path = costantiP::BASE_URL.costantiP::LINGUA.'/'.normalizzaTesto($veicolo['make']).'/'.normalizzaTesto($veicolo['model']).'-'.normalizzaTesto($veicolo['version']).'_'.$veicolo['id'].'.htm';

                                    }

                                    else

                                    {

                                        $path = costantiP::BASE_URL.costantiP::LINGUA.'/dettaglio-auto.php?id='.$veicolo['id'];                                                

                                    }

                                                                     ?>

                                                

                          

                          

                            

                          

                          

                                

                          <div class="col-lg-12 col-sm-12 col-xs-12 mb-xl pr-none">

                            <div class="b-items__cars-one  " data--delay="0.5s">

                                    <div class="col-lg-8 col-sm-12 col-xs-12"  >

                                        <h3 class="mb-none"><?echo $veicolo['make'].' '.$veicolo['model']?></h3>

                                        <h4 class="mt-none" style="overflow: hidden;"><nobr><?echo $veicolo['version']?></nobr></h4>

                                        <div id="auto_<?echo $veicolo['id']?>" class="carousel slide"  data-ride="carousel" data-interval="false" >

              

            

                                              <!-- Wrapper for slides -->

                                              <div class="carousel-inner" role="listbox" >

                                                <div class="item active">

                                                

                                                   <?      /*

                                                        1 - benzina

                                                        2 - diesel

                                                        3 - ibrida

                                                        4 - gpl

                                                        5 - metano

                                                        6 - elettrica

                                                        */

                                           $etichetta = false;

                                           

                                           switch ($veicolo['alimentazioneCodice']) {

                                                                case 20000000:

                                                                    $venduta = '';

                                                                    $imgOverlay = 'diesel200';

                                                                    $etichetta = true;

                                                                    break;

                                                                case 3:

                                                                    $venduta = '';

                                                                    $imgOverlay = 'ibrida200';

                                                                    $etichetta = true;

                                                                    break;

                                                                case 4:

                                                                    $venduta = '';

                                                                    $imgOverlay = 'gpl200';

                                                                    $etichetta = true;

                                                                    break;

                                                                case 5:

                                                                    $venduta = '';

                                                                    $imgOverlay = 'metano200';

                                                                    $etichetta = true;

                                                                    break;

                                                                case 6:

                                                                    $venduta = '';

                                                                    $imgOverlay = 'elettrica200';

                                                                    $etichetta = true;

                                                                    break;

                                                                case 10000000:

                                                                    $venduta = '';

                                                                    $imgOverlay = 'benzina200';

                                                                    $etichetta = true;

                                                                    break;

                                                            }

                                           

                                            

                                            if($veicolo['neopatentati']==1)

                                                                {   

                                                                    $venduta = '';

                                                                    $imgOverlay = 'neopatentati200';

                                                                    $etichetta = true;

                                                                }

                                            

                                            if ($veicolo['telaio']!='')

                                                                {   

                                                                    $venduta = 'venduta';

                                                                    $imgOverlay = 'venduta200';

                                                                    $etichetta = true;

                                                                }

                                                        ?>

                                            

                                            <?

                                            

                                             if ($etichetta)

                                             {

                                                ?>

                                                <!--  linguetta in overlay -->

                                                <a  href="<?echo $path?>" class="<?echo $venduta?>">

                                                <span class="<?echo $venduta?>"></span>

                                                  </a>

                                                  

                                                <span class="etichettaCorner  m-premium">

                                                <img src="<?echo costantiP::BASE_URL?>images/<?echo $imgOverlay?>.png" class="img-responsive"/>

                                                </span>

                                                <?

                                             }

                                            ?> 

                                                

                                                

                                                <!-- immagine principale-->

                                                 <a class="details" href="<?echo $path?>">

                                                  <img src="<?echo $veicolo['img']?>" alt='auto01' class="img-responsive"/>

                                                 </a>       

                                                </div>

                                            <?

                                                    $sql = 'select immagini.* from immagini where immagini.id_veicolo = '.$veicolo['id'].' limit 1,3';

                                                    

                                                     $immaginiVeicolo = '';

                                                     $result=mysql_query($sql);

                                        

                                                       while ($rowImmagini=mysql_fetch_assoc($result)) {

                                                                $immagineVeicolo['id']=$rowImmagini['id'];

                                                                $immagineVeicolo['img']=$rowImmagini['img'];

                                                                $immagineVeicolo['imgBig']=$rowImmagini['img_big'];

                                                                $immagineVeicolo['titolo']=$rowImmagini['titolo'];

                                                                $immaginiVeicolo[]=$immagineVeicolo; 

                                                            }

                                  

                                            foreach ($immaginiVeicolo as $imgV) {

                                                ?>    

                                               <div class="item">

                                                <a class="details" href="<?echo $path?>">

                                                 <img src="<?echo $imgV['imgBig']?>" alt='<?echo $imgV['titolo']?>' class="img-responsive"/>

                                                 </a>

                                               </div>

                                            

                                            <? 

                                                }

                                            ?>

                                             <div class="item">

                                                   <a class="details" href="<?echo $path?>">

                                                   <img src="../images/scopri.png" class="img-responsive"/>

                                                   

                                                   </a>

                                               </div>

                                             </div>

                                              <!-- Left and right controls -->

                                              <a class="left carousel-control" href="#auto_<?echo $veicolo['id']?>" role="button" data-slide="prev">

                                                <span class="fa m-control-left" aria-hidden="true" ></span>

                                                <span class="sr-only">Previous</span>

                                              </a>

                                              <a class="right carousel-control" href="#auto_<?echo $veicolo['id']?>" role="button" data-slide="next">

                                                <span class="fa m-control-right" aria-hidden="true"></span>

                                                <span class="sr-only">Next</span>

                                              </a>

                                            </div>

                                        

                                        <!--

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

                                                    <script type="text/javascript">		

                                                    	//$(document).ready(function(){ $('#features').jshowoff({ speed:1000, links: false, controls: true }); });

                                                        $(document).ready(function(){ $('#auto_<?echo $veicolo['id']?>').jshowoff({ 

                                    					cssClass: 'thumbFeatures',

                                    					effect: 'fade'

                                    				}); });

                                                      

                                                    </script>

                                                    </div>

                                                </div>

                                            </div>

                                        </section>

    

                                        <a data-toggle="modal" data-target="#myModal<?echo $veicolo['id']?>" href="#" class="b-items__cars-one-img-video"><span class="fa fa-search fa-2x"></span></a>

                                        <!--b-modal-->

                                    </div>

                                    <div class="col-lg-4 col-sm-12 col-xs-12 mt-elenco-auto">

                                        <header class="b-items__cars-one-info-header s-lineTopLeft s-lineDownLeft mb-elenco-auto"><span><?echo number_format($veicolo['prezzo'],0,',','.')?> €</span></header>

                                        <div class="b-items__cars-one-info">

                                            <p class="icon-carinfo km mb-sm"><?echo number_format($veicolo['km'],0,',','.')?> Km</p>

                                            <p class="icon-carinfo data mb-sm"><?echo estraiDataAuto($veicolo['registration_date'])?></p>

                                            <p class="icon-carinfo alimentazione mb-sm"><?echo $veicolo['alimentazione']?></p>

                                            <? $cavalli = $veicolo['kwatt']*1000/735.49875 ?>

                                            <p class="icon-carinfo potenza mb-sm"><?echo $veicolo['kwatt']?> KW / <?echo round($cavalli,0)?> CV</p>

                                            <p class="icon-carinfo cambio mb-sm"><?echo $veicolo['gearbox']?></p>

                                            <p class="icon-carinfo colore mb-sm"><?echo $veicolo['colore']?></p>

                                            <p class="icon-carinfo interni"><?echo $veicolo['interni']?></p>

                                            

                                            <div class="b-items__cars-one-info-details">

                                            <a class="details" href="<?echo $path?>" >DETTAGLIO <span class="icon-plus"></span></a>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            

                            <?

                            

                          }

                            

                            ?>

                            <hr />

                            

                        </div>

                        <div id="loader" style="visibility: hidden;">Loading..</div>

                      

                        

                          

                        

                    </div>

                    

                   

                   

                    <br /><br />

					</div>

				</div>

			</div>

		</section><!--b-items-->

        





    <?

}



function HeaderAggiuntivi()

{

    ?>

  

  

    <?

    

}

function scriptFooterAggiuntivi()

{global $modello;

    ?>

   <script src="<?echo costantiP::BASE_URL?>js/infscroll2.js"></script>

     <script>

        $(document).ready(function() {

         

            //recupero variabile "discriminante"

                var marca = $("#marca").val();

                var modello = <?echo $modello?>;

                

                //chiamata ajax

                $.ajax({

         

                type: "POST",

         

                url: "<?echo costantiP::BASE_URL.costantiP::LINGUA?>/select-modello.php",

         

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

          

            //al cambio di valore della select attivo questa procedura

            

            $('#marca').change(function() {

         

                //recupero variabile "discriminante"

                var marca = $("#marca").val();

                var modello = '';

                

                //chiamata ajax

                $.ajax({

         

                type: "POST",

         

                url: "<?echo costantiP::BASE_URL.costantiP::LINGUA?>/select-modello.php",

         

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

         });   

         

         $(window).bind('load', function() {

            if ($(this).width() < 767) {

                $('#refine-search').removeClass('in');

                $('#refine-search').addClass('out');

                $('#refine').addClass('show');

             } else {

                $('#refine-search').removeClass('out');

                $('#refine-search').addClass('in');

                $('#refine').addClass('hidden');

            }

        });

         

        });//FINE DOM

        </script>

  

    <?

}