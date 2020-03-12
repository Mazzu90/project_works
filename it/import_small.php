<?
include('include_dir.php');
include($percorsoLingua.'include/include.php');
require($percorso.'include/class.phpmailer.php');
require($percorso.'include/class.smtp.php');


$grafica=new Tgrafica(false,false);
$grafica->titolo='';
$grafica->keywords='';
$grafica->description='';
$grafica->codicePagina=costantiP::CP_HOMEPAGE;
$grafica->codiceBody='page1';

$pagina = isset($_GET['pagina'])?$_GET['pagina']:1;

$grafica->paint();
unset($grafica);

function corpo_pagina()
{
    $a=time();
    $b=date('G', $a);
    
    if ($b==15)
    {
        exportCSV();
        $export = $b.': eseguito export autovetture per Remarketing';
    }
    else
    {
        $export = $b.': export autovetture per Remarketing non eseguito. riprovare alle 12.00';
    }
    
    
    ?>
    <h2><?echo $export?> </h2><br /><br />
    <h2>Questa procedura aggiorna il DATABASE di autounica </h2><br /><br /> 
    <p>Questa procedura non importa le immagini ma solo i link riferiti a gestionale auto</p>
        <?
        $filename = "http://xml.gestionaleauto.com/scuderiasrl/export_gestionaleauto.php";
        $xml = simplexml_load_file($filename);
        /*
        echo "<h3>Stampa di debug delle auto presenti in ".$filename."(".count($xml->car).")</h3>";
        echo "<ul>";
        foreach($xml->car as $car)
        {
            echo '<li><a href="showarticle.php?id='.$car['id'].'">'.$car->model->make.' '.$car->model->model.'</a> <em>('.$car->subtitle.')</em></li>';
        }
        echo "</ul>";
        */
        //Scandisce le auto e le importa
        $annunciimportati = 0;
        $arrayAnnunciImportati = array();
        $arrayAnnunciImportatiMail = array();
        $arrayAnnunciImportatiVecchi = array();
        $arrayAnnunciImportatiVecchiError = array(); 
        $arrayAnnunciImportatiNuovi = array();
        $arrayAnnunciImportatiNuoviError = array();
        $lErrore = false;      
        foreach($xml->xpath("/export_gestionaleauto/car") as $car)
            { 
             
             echo "<br />Veicolo trovato da aggiornare: ".$car->model->make.' '.$car->model->model.' annunci '.$annunciimportati.'<br />';
            		
            
             //verifico se esiste già nel nostro DB
             $sql = "SELECT id, id_ga FROM veicoli WHERE id_ga = '".$car['id']."'";
             $result=mysql_query($sql);
             //echo $sql;
             //aggiornaNomiModelli();
             //aggiornaNomiMarca();
             
             $arrayAnnunciImportati[] = (string)$car['id'];
             
                    if(mysql_num_rows($result) > 0)
                    {
                    
                        $idMarca = aggiornaMarca($car->model->make);
                        $idModello = aggiornaModello($car->model->model,$idMarca);
                        
                        $registration_date = preparadata($car->registration_date);
                        $massaVeicolo = $car->model->weight+75/1000;
                        $neopatentati = 0;
                        // se la potenza è al massimo 70KW
                        if ($car->model->kwatt<71)
                        {
                            $massaVeicolo = $car->model->weight+75;
                            //echo '<br />massa'.($car->model->weight+75).' - '.$massaVeicolo.'<br />';
                            $massaVeicolo = $massaVeicolo/1000;
                            //echo $massaVeicolo.'<br />';
                            $rapportoPesoPotenza = $car->model->kwatt/$massaVeicolo;
                            //echo 'rapp peso potenza: '.$rapportoPesoPotenza.'<br />';
                            if ($rapportoPesoPotenza<=55)
                                $neopatentati = 1;
                        }
                        list($descrizione, $descrizione2) = explode("Oltre 60 fotografie dettagliate", $car->additional_informations);
            
                        echo "Questa vettura esiste già nel database,'".$car['id']."' aggiorno le informazioni - annunci $annunciimportati<br />";
                        
                        // aggiorno le info
                        $query="update veicoli set 
                        		id_marca='".$idMarca."',
                                id_modello='".$idModello."',
                                titolo_veicolo=".stripcslashesandquote($car->model->make.' '.$car->model->model).",
                                make='".$car->model->make."',
                                model=".stripcslashesandquote($car->model->model).",
                                version=".stripcslashesandquote($car->model->version).",
                                body='".$car->model->body."',
                                alimentazione = '".fuelEncode($car->model->fuel)."',
                                traction='".$car->model->traction."',
                                kwatt='".$car->model->kwatt."',
                                cc='".$car->model->cc."',
                                cylinders='".$car->model->cylinders."',
                                cvfiscali='".$car->model->cvfiscali."',
                                doors='".$car->model->doors."',
                                seats='".$car->model->seats."',
                                weight='".$car->model->weight."',
                                emission_class='".$car->model->emission_class."',
                                emission_co2='".$car->model->emission_co2."',
                                consumo_urbano='".$car->model->consumption->urban."',
                                consumo_extra='".$car->model->consumption->outer."',
                                consumo_misto='".$car->model->consumption->combined."',
                                colore='".$car->exterior->color." ".$car->exterior->paint."',
                                interni='".$car->interior->color." - ".$car->interior->make."',
                                km='".$car->km."',
                                registration_date='".$registration_date."',
                                gearbox='".$car->gearbox."',
                                gears_number='".$car->gears_number."',
                                plate='".$car->plate."',
                                telaio=".stripcslashesandquote($car->vin).",
                                additional_informations=".stripcslashesandquote($descrizione).",
                                id_categoria='4',
                                data_pubblicazione_inizio='".date("Y-m-d")."',
                                neopatentati=".$neopatentati.",
                                prezzo='".$car->customers_price."'
                                where id_ga = '".$car['id']."'";
                          //echo $query.'<br />';
                                   
                                $result=mysql_query($query);
            		            if(!$result) 
                                    {
                                        print mysql_error();
                                        echo $query;
                                        $annuncioError['id_ga']=$car['id'];
                                        $annuncioError['id_marca']=$idMarca;
                                        $annuncioError['id_modello']=$idModello;
                                        $annuncioError['titolo_veicolo']=$car->model->make.' '.$car->model->model;
                                        $annuncioError['version']=stripcslashesandquote($car->model->version);
                                        $arrayAnnunciImportatiVecchiError[]=$annuncioError;
                                        $lErrore = true; 
                                    }
                                else   
                               {
                                        $annuncioVecchio['id_ga']=$car['id'];
                                        $annuncioVecchio['id_marca']=$idMarca;
                                        $annuncioVecchio['id_modello']=$idModello;
                                        $annuncioVecchio['titolo_veicolo']=$car->model->make.' '.$car->model->model;
                                        $annuncioVecchio['version']=stripcslashesandquote($car->model->version);
                                        $arrayAnnunciImportatiVecchi[]=$annuncioVecchio; 
                                
// ++++++++++++++++++++++++++++++ Se l'aggiornamento del veicoloi è andato a buon fine aggiorno le foto ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ++++++++++++++++++++++++++++++ ossia le elimino tutte e le ricarico
                                
                                //QUI ELIMINO
                                $sql = "SELECT id, id_ga FROM veicoli WHERE id_ga = '".$car['id']."'";
                                $idVeicolo = GetFieldValue($sql,'id');
                                $sql  = "delete from immagini where id_veicolo = ".$idVeicolo ;
                                mysql_query($sql);    
            			
            			$numfoto=0;
            			foreach($car->images->image as $foto)
            			{
            				//$bodytag = str_replace("%body%", "black", "<body text='%body%'>");
                            $nomeOriginaleXML = explode('/', $foto->big);
                                $nomeOriginale = array_pop($nomeOriginaleXML);
                                //$imgSmall = str_replace("http://","https://",$foto->small);
                                $imgSmall = str_replace("http://","https://",$foto->small);
                                $imgMedium = str_replace("http://","https://",$foto->medium);
                                $imgLarge = str_replace("http://","https://",$foto->large);
                                $imgBig = str_replace("http://","https://",$foto->big);
                                $imgHd = str_replace("http://","https://",$foto->hd);
                                
                                if ($imgHd=='')
                                    $imgHd = $imgBig;
                                
                                $sql="insert 
                                            into 
                                        immagini 
                                            set 
                                            id_veicolo = ".$idVeicolo.",
                                            img_small = '".$imgSmall."', 
                                            img_medium = '".$imgMedium."', 
                                            img_large = '".$imgLarge."', 
                                            img_big = '".$imgBig."', 
                                            img_hd = '".$imgHd."',   
                                            nome_originale = '".$nomeOriginale."'";
                                            
                                $result=mysql_query ($sql) or die (mysql_error());
                                
                                /*if($numfoto==0)
                                {
                                    //qui imposto l'immagine principale
                                    $sql="update veicoli set img = '".$imgBig."' where id = ".$idVeicolo." order by ";
                                    $result=mysql_query ($sql) or die (mysql_error());
                                }
                                */
                            $numfoto++;
           				} // fine foreach
                        
                        
                        //qui imposto l'immagine principale
                        $sql="UPDATE veicoli SET img = (SELECT img_big FROM immagini WHERE id_veicolo = ".$idVeicolo." order by immagini.id ASC limit 1) WHERE id = ".$idVeicolo;
                        $result=mysql_query ($sql) or die (mysql_error());
                        
                        
                        
// ++++++++++++++++++++++++++++++ Se l'aggiornamento del veicoloi è andato a buon fine aggiorno i video +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ++++++++++++++++++++++++++++++ ossia li elimino tutti e li ricarico
                                 
                                //QUI ELIMINO
                                $sql = "SELECT id, id_ga FROM veicoli WHERE id_ga = '".$car['id']."'";
                                $idVeicolo = GetFieldValue($sql,'id');
                                $sql  = "delete from video where id_veicolo = ".$idVeicolo ;
                                mysql_query($sql);    
            			
                    			if (isset($car->videos)) {
                                    $numVideo=0;
                                    foreach($car->videos->video as $video)
                                			{
                                				    $sql="insert 
                                                                into 
                                                            video 
                                                                set 
                                                                id_veicolo = ".$idVeicolo.",
                                                                youtube_id = '".$video->youtube_id."'";
                                                                
                                                    $result=mysql_query ($sql) or die (mysql_error());
                                                    
                                                $numVideo++;
                               				} // fine foreach
                                }
   
// ++++++++++++++++++++++++++++++ IMPORTO OPTIONALS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ++++++++++++++++++++++++++++++ ELININO TUTTI GLI OPTIONALS E POI LI REINSERISCO
            			$sql  = "delete from optional where id_veicolo = ".$idVeicolo ;
                                mysql_query($sql); 
                        
                        
                        // Scarica gli eventuali optionals:
            			foreach($car->options->standard_option as $standard_option)
            			{
            				$sql="insert into optional set titolo = ".stripcslashesandquote($standard_option).", id_veicolo = ".$idVeicolo.", tipo_optional = 1";
                            $result=mysql_query ($sql) or die (mysql_error());
                        } // fine foreach
                        foreach($car->options->extra as $extra)
            			{
            				$sql="insert into optional set titolo = '".$extra."', id_veicolo = ".$idVeicolo.", tipo_optional = 2";
                                $result=mysql_query ($sql) or die (mysql_error());
                        } // fine foreach
                        
                       
            		}      
                                    
                                  
                                    
// ++++++++++++++++++++++++++++++ TERMINATO AGGIORNAMENTO DI QUESTO VEICOLO PROCEDO COL SUCCCESSIVO +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                              
                     $annunciimportati++;    
                    }
                    else
                    {
                    
                        
                    $idMarca = aggiornaMarca($car->model->make);
                    $idModello = aggiornaModello($car->model->model,$idMarca);    
                        
                        //importo il veicolo
                        $annunciimportati++;
            	    echo "<br />NUOVO VEICOLO trovato: ".$car->model->make.' '.$car->model->model.' annunci '.$annunciimportati.'<br />';
            		
                    $registration_date = preparadata($car->registration_date);
                    $massaVeicolo = $car->model->weight+75/1000;
                    $neopatentati = 0;
                    if ($car->model->kwatt<71)
                    {
                        $massaVeicolo = $car->model->weight+75/1000;
                        $rapportoPesoPotenza = $car->model->kwatt/$massaVeicolo;
                        if ($rapportoPesoPotenza<55)
                            $neopatentati = 1;
                    }
                    list($descrizione, $descrizione2) = explode("Oltre 60 fotografie dettagliate", $car->additional_informations);

                    
                    $query="insert into veicoli set 
            		titolo_veicolo=".stripcslashesandquote($car->model->make.' '.$car->model->model).",
                    id_marca='".$idMarca."',
                    id_modello='".$idModello."',
                    id_ga='".$car['id']."',
                    make='".$car->model->make."',
                    model=".stripcslashesandquote($car->model->model).",
                    version=".stripcslashesandquote($car->model->version).",
                    body='".$car->model->body."',
                    alimentazione = '".fuelEncode($car->model->fuel)."',
                    traction='".$car->model->traction."',
                    kwatt='".$car->model->kwatt."',
                    cc='".$car->model->cc."',
                    cylinders='".$car->model->cylinders."',
                    cvfiscali='".$car->model->cvfiscali."',
                    doors='".$car->model->doors."',
                    seats='".$car->model->seats."',
                    weight='".$car->model->weight."',
                    emission_class='".$car->model->emission_class."',
                    emission_co2='".$car->model->emission_co2."',
                    consumo_urbano='".$car->model->consumption->urban."',
                    consumo_extra='".$car->model->consumption->outer."',
                    consumo_misto='".$car->model->consumption->combined."',
                    colore='".$car->exterior->color." ".$car->exterior->paint."',
                    interni='".$car->interior->color." - ".$car->interior->make."',
                    km='".$car->km."',
                    registration_date='".$registration_date."',
                    gearbox='".$car->gearbox."',
                    gears_number='".$car->gears_number."',
                    telaio=".stripcslashesandquote($car->vin).",
                    plate='".$car->plate."',
                    additional_informations=".stripcslashesandquote($descrizione).",
                    id_categoria='4',
                    data_pubblicazione_inizio='".date("Y-m-d")."',
                    neopatentati=".$neopatentati.",
                    prezzo='".$car->customers_price."'";
                    
                    
                    //telaio=".stripcslashesandquote($car->vim).",
                    
            
            		// ... salva tutti i vari campi ...
            		echo $query.'<br />';	
            		$result=mysql_query($query);
            		if(!$result) 
                    {
                        print mysql_error();
                                        $annuncioError2['id_ga']=$car['id'];
                                        $annuncioError2['id_marca']=$idMarca;
                                        $annuncioError2['id_modello']=$idModello;
                                        $annuncioError2['titolo_veicolo']=$car->model->make.' '.$car->model->model;
                                        $annuncioError2['version']=stripcslashesandquote($car->model->version);
                                        $arrayAnnunciImportatiNuoviError[]=$annuncioError2;
                                        $lErrore = true; 
                    }
            		else
            		{
            		  
                                        $annuncioNuovo['id_ga']=$car['id'];
                                        $annuncioNuovo['id_marca']=$idMarca;
                                        $annuncioNuovo['id_modello']=$idModello;
                                        $annuncioNuovo['titolo_veicolo']=$car->model->make.' '.$car->model->model;
                                        $annuncioNuovo['version']=stripcslashesandquote($car->model->version);
                                        $arrayAnnunciImportatiNuovi[]=$annuncioNuovo; 
                     
            			//IMPORTO IMMAGINI
                        //$annunciimportati++;
            			$id=mysql_insert_id();
            	
            			// Scarica le eventuali foto (massimo 6):
            			$numfoto=0;
            			foreach($car->images->image as $foto)
            			{
            				
            				
            				
            					$nomeOriginaleXML = explode('/', $foto->big);
                                $nomeOriginale = array_pop($nomeOriginaleXML);
                                $imgSmall = str_replace("http://","https://",$foto->small);
                                $imgMedium = str_replace("http://","https://",$foto->medium);
                                $imgLarge = str_replace("http://","https://",$foto->large);
                                $imgBig = str_replace("http://","https://",$foto->big);
                                $imgHd = str_replace("http://","https://",$foto->hd);
                                
                                
                                if ($imgHd=='')
                                    $imgHd = $imgBig;
                                
                                $sql="insert 
                                            into 
                                        immagini 
                                            set 
                                            id_veicolo = ".$id.",
                                            img_small = '".$imgSmall."', 
                                            img_medium = '".$imgMedium."', 
                                            img_large = '".$imgLarge."', 
                                            img_big = '".$imgBig."', 
                                            img_hd = '".$imgHd."',   
                                            nome_originale = '".$nomeOriginale."'";
                                            
                                $result=mysql_query ($sql) or die (mysql_error());
                                
                                /*if($numfoto==1)
                                {
                                    $sql="update veicoli set img = '".$imgBig."' where id = ".$id;
                                    $result=mysql_query ($sql) or die (mysql_error());
                                }
                                */
            				
            					 
            				if($numfoto==100) break; // limita a X le immagini importate
                            $numfoto++;
            			} // fine foreach
                        
                        
                        //qui imposto l'immagine principale
                        $sql="UPDATE veicoli SET img = (SELECT img_big FROM immagini WHERE id_veicolo = ".$id." order by immagini.id ASC limit 1) WHERE id = ".$id;
                        $result=mysql_query ($sql) or die (mysql_error());
                        
                        
// ++++++++++++++++++++++++++++++ Se l'inserimento del veicolo è andato a buon fine inserisco i video +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                        
                                if (isset($car->videos)) {
                                    $numVideo=0;
                                    foreach($car->videos->video as $video)
                        			{
                				         $sql="insert 
                                                        into 
                                                    video 
                                                        set 
                                                        id_veicolo = ".$idVeicolo.",
                                                        youtube_id = '".$video->youtube_id."'";
                                                        
                                            $result=mysql_query ($sql) or die (mysql_error());
                                            
                                        $numVideo++;
                       				} // fine foreach
                                }
                        
                        
                        
                        
                        
                        
// ++++++++++++++++++++++++++++++ IMPORTO OPTIONALS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ++++++++++++++++++++++++++++++ $annunciimportati++;
            			// Scarica gli eventuali optionals:
            			foreach($car->options->standard_option as $standard_option)
            			{
            				$sql="insert into optional set titolo = ".stripcslashesandquote($standard_option).", id_veicolo = ".$id.", tipo_optional = 1";
                            $result=mysql_query ($sql) or die (mysql_error());
                        } // fine foreach
                        foreach($car->options->extra as $extra)
            			{
            				$sql="insert into optional set titolo = '".$extra."', id_veicolo = ".$id.", tipo_optional = 2";
                                $result=mysql_query ($sql) or die (mysql_error());
                        } // fine foreach
                        
                        
            		} // fine else
            	  
                        if($annunciimportati==1000) break; // limita a X gli annunci importati
                        
                    }
             
               
            } // fine foreach($xml->xpath("/listaagenzie/agenzia") as $agenzia)
            //print_r($arrayAnnunciImportati);
            
            
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        //+++++++++++++++++++++++ FACCIO PULIZIA SUL DATABASE ++++++++++++++++++++++++++++++++
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        
        $sql = "SELECT id, id_ga FROM veicoli";
        $result=mysql_query($sql);
        $conteggio = 0;
        if(mysql_num_rows($result) > 0)
        {
             while ($row=mysql_fetch_assoc($result)) {
                
                if(in_array($row['id_ga'], $arrayAnnunciImportati)) { 
                   echo "il veicolo ".$row['id_ga']." esiste e non va cancellato .".$conteggio."<br />";
                   $conteggio++;
                }
                else{
                    echo "il veicolo ".$row['id_ga']." non esiste e VA cancellato <br />";
                    
                    //cancello le immagini relative
                    $sql = "SELECT id FROM veicoli WHERE id_ga = '".$row['id_ga']."'";
                    $idVeicolo = GetFieldValue($sql,'id');
                    $sql  = "delete from immagini where id_veicolo = ".$idVeicolo ;
                    mysql_query($sql);
                    echo "---> immagini di ".$row['id_ga']." eliminate <br />";
                    
                    //ELININO TUTTI GLI OPTIONALS E POI LI REINSERISCO
          			$sql  = "delete from optional where id_veicolo = ".$idVeicolo ;
                    mysql_query($sql);
                    echo "---> optionals di ".$row['id_ga']." eliminati <br />";
                       
                    $sql  = "delete from veicoli where id_ga = ".$row['id_ga'] ;
                    mysql_query($sql);
                    echo '<br>'.$row['id_ga'].' cancellato<br />';
                }  
                
                
             }
        }
        
        
        
        ?> 
        
    



    <?
    //invio una mail di notifica solo se registro un errore,
    //TODO tracciare errori inserimento foto, optional, marche, modelli
    if($lErrore == true)
        invioMail($arrayAnnunciImportatiVecchi, $arrayAnnunciImportatiVecchiError, $arrayAnnunciImportatiNuovi, $arrayAnnunciImportatiNuoviError);
    
}

function HeaderAggiuntivi()
{
    ?>
   
  
    <?
    
}

function aggiornaMarca($marca)
{
        $arrayMarca = array();
        
       //AGGIORNO LE TABELLE MARCHE e MODELLI se necessario ed estraggo gli ID che mi servono per inserire il veicolo nel DB
        $sql = "SELECT id, titolo FROM marca WHERE titolo = '".$marca."'";
        
        $nuovoId = -1; //se id = -1 la marca esiste già nel database
        
        if (!GetFieldValue($sql,'titolo'))
            {
               $nuovoId = ProssimoIdTabella('marca');
               $titoloMarca=normalizzaTesto($marca);
               $query="insert into marca set id = ".$nuovoId.", titolo = '".$marca."',titolo_normalizzato = '".$titoloMarca."'";
               mysql_query($query); 
               
               $arrayMarca1['id']=$nuovoId; 
               $arrayMarca1['titolo']=$marca; 
               $arrayMarca[]=$arrayMarca1;
               
               echo 'ID nuova categoria creata:'.$nuovoId.' - '.$marca.'<br />';
            }
        else
            {//
                $nuovoId =  GetFieldValue($sql,'id');
                echo 'Questa categoria esiste:'.$nuovoId.' - '.$marca.'<br />';
            }
        
        
        return $nuovoId;
}
 
function aggiornaModello($modello,$idCategoria)
{
        $arrayModelli = array();
    //AGGIORNO LE TABELLE MARCHE e MODELLI se necessario ed estraggo gli ID che mi servono per inserire il veicolo nel DB
        $sql = "SELECT id, titolo FROM modelli WHERE titolo = ".stripcslashesandquote($modello);
        $nuovoId = -1; //se id = -1 la marca esiste già nel database
        
        if (!GetFieldValue($sql,'titolo'))
            {
               $nuovoId = ProssimoIdTabella('modelli');
               $titoloModello=normalizzaTesto($modello);
               $query="insert into modelli set id = ".$nuovoId.", id_categoria = ".$idCategoria.", titolo = ".stripcslashesandquote($modello).",titolo_normalizzato = '".$titoloModello."'";
               mysql_query($query); 
               
               $arrayModello['id']=$nuovoId; 
               $arrayModello['titolo']=$modello; 
               $arrayModelli[]=$arrayModello;
               
               echo 'ID nuovo modello creato:'.$nuovoId.' - '.$modello.'<br />';   
            }
        else
            {
                $nuovoId =  GetFieldValue($sql,'id');
                echo 'Questo modello esiste:'.$nuovoId.' - '.$modello.'<br />';   
            }    
            
       
       return $nuovoId;
  
}
function aggiornaNomiModelli()
{
    
    //AGGIORNO LE TABELLE MARCHE e MODELLI se necessario ed estraggo gli ID che mi servono per inserire il veicolo nel DB
        $sql = "SELECT * FROM modelli WHERE titolo_normalizzato = ''";
        $result=mysql_query($sql);
        $conteggio = 0;
        if(mysql_num_rows($result) > 0)
        {
             while ($row=mysql_fetch_assoc($result)) {
                $titoloModello=normalizzaTesto($row['titolo']);
                $sql="update modelli set titolo_normalizzato = '".$titoloModello."' where id = ".$row['id'];
                $result=mysql_query ($sql) or die (mysql_error());  
                
             }
        }
                
  
}

function aggiornaNomiMarca()
{
    
    //AGGIORNO LE TABELLE MARCHE e MODELLI se necessario ed estraggo gli ID che mi servono per inserire il veicolo nel DB
        $sql = "SELECT * FROM marca WHERE titolo_normalizzato = ''";
        $result=mysql_query($sql);
        $conteggio = 0;
        if(mysql_num_rows($result) > 0)
        {
             while ($row=mysql_fetch_assoc($result)) {
                $titoloModello=normalizzaTesto($row['titolo']);
                $sql="update marca set titolo_normalizzato = '".$titoloModello."' where id = ".$row['id'];
                $result=mysql_query ($sql) or die (mysql_error());  
                
             }
        }
                
  
}

function exportCSV()
{
        /*
        header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        header('Content-disposition: attachment; filename=veicoli.csv');
        */
        //echo "\xEF\xBB\xBF"; // UTF-8 BOM
	    
        $query="SELECT 
  		veicoli.id,
        veicoli.id_ga,
        veicoli.make,
        veicoli.model,
        veicoli.version,
        veicoli.additional_informations,
        veicoli.prezzo,
        veicoli.registration_date,
        veicoli.colore,
        veicoli.interni,
        veicoli.gearbox,
        veicoli.km,
        veicoli.cc,
        veicoli.kwatt,
        veicoli.alimentazione,
  		immagini.img_big,
  		marca.titolo AS marcaTitolo,
        modelli.titolo AS modelloTitolo
         FROM veicoli
        	inner join `marca` 
                on veicoli.id_marca = marca.id
            inner join modelli
                on veicoli.id_modello = modelli.id
            inner join immagini
                on immagini.id_veicolo = veicoli.id
         group by veicoli.id";
       
	   $result=mysql_query($query);
       
       $veicoli = array();
        $i = 1;
        while ($row=mysql_fetch_assoc($result)) {
    		$veicoli[$i]['id_ga']=$row['id_ga'];
            $titolo = troncaTesto ($row['marcaTitolo'].' '.$row['modelloTitolo'].' '.$row['version'],25);
            $titolo = ucwords(strtolower($titolo));//solo iniziale maiuscola
            $veicoli[$i]['titolo']=$titolo;//
            $veicoli[$i]['url']= costantiP::BASE_URL.costantiP::LINGUA.'/'.normalizzaTesto($row['make']).'/'.normalizzaTesto($row['model']).'-'.normalizzaTesto($row['version']).'_'.$row['id'].'.htm';
            $veicoli[$i]['imgUrl']= $row['img_big'];
            $veicoli[$i]['subtitle']= 'Da Autounica a Brescia';
            $veicoli[$i]['description']= $titolo;//
            $veicoli[$i]['category']= ucwords(strtolower($row['make'])); //solo iniziale maiuscola
            $veicoli[$i]['price']= number_format($row['prezzo'],0,',',',').' EUR';
            $cavalli = $row['kwatt']*1000/735.49875;
            //$valore = number_format($row['km'],0,',','.').' Km; ';
            //$valore = $valore.estraiDataAuto($row['registration_date']).'; ';
            //$valore = $valore.fuelDecode($row['alimentazione']).'; ';
            $veicoli[$i]['keywords']= escapeStringCSV(number_format($row['km'],0,',','.').' Km; '.estraiDataAuto($row['registration_date']).'; '.fuelDecode($row['alimentazione']).'; '.$row['kwatt'].'KW / '.round($cavalli,0).'CV; '.$row['gearbox'].'; '.$row['colore'].'; '.$row['interni']);
            $veicoli[$i]['address']= '- Brescia, BS - Via Valcamonica, 19/h - 45,5471165 ,10,1638985';
            $i++;
    	}
        
        $output='';
    
        $fp = fopen('../google/google_autounica.csv', 'w');
        
         $array_to_csv = Array(
            Array(' ID',
                'Item title',
                'Final URL',
                'Image URL',
                'Item subtitle',
                'Item description',
                'Item category',
                'Price',
                'Contextual keywords',
                'Item address',
            )
        );
    
    foreach ($array_to_csv as $line) {
        /** default php csv handler **/
        fputcsv($fp, $line, ",");
    }
    //fputcsv($fp, $array_to_csv,',');
    $i=1;
    foreach ($veicoli as $term) {
			     
                fputcsv($fp, $term, ",");
               
			}
            
            
     fclose($fp);
    return $output;
	      
}


function troncaTesto($testo, $caratteri=25) 
{ 
    if (strlen($testo) <= $caratteri) 
        return $testo;
         
    $nuovo = wordwrap($testo, $caratteri, "|"); 
    $nuovotesto=explode("|",$nuovo); 
    return $nuovotesto[0]; 
} 

function escapeStringCSV($source, $sep=';', $source_encoding='utf-8', $encoding="windows-1251//TRANSLIT"){

    $str = ($source_encoding!=$encoding ? iconv($source_encoding, $encoding, $source) :  $source);

    if(preg_match('/[\r\n"'.preg_quote($sep, '/').']/', $str)){
        return '"'.str_replace('"', '""', $str).'"';
    } else 
        return $str;
}

function invioMail($arrayAnnunciImportatiVecchi, $arrayAnnunciImportatiVecchiError, $arrayAnnunciImportatiNuovi, $arrayAnnunciImportatiNuoviError)
{
    $messaggio = '';
    $messaggio .= '<strong>Annunci aggiornati</strong><br />'; 
    if (count($arrayAnnunciImportatiVecchi)>0)
        {
            foreach ($arrayAnnunciImportatiVecchi as $annuncioVecchio) {
            $messaggio .= $annuncioVecchio['id_ga'].' - '.$annuncioVecchio['id_marca'].' - '.$annuncioVecchio['id_modello'].' - '.$annuncioVecchio['titolo_veicolo'].' '.$annuncioVecchio['version'].'<br /><br />';
                   }
        }
    else
        {
            $messaggio .= 'Nessun annuncio da aggiornare'; //IMPOSSIBILE!
        }
    
    $messaggio .= '<br /><strong>Nuovi Annunci inseriti</strong><br />';
    if (count($arrayAnnunciImportatiNuovi)>0)
        {
            foreach ($arrayAnnunciImportatiNuovi as $annuncioNuovo) {
            $messaggio .= $annuncioNuovo['id_ga'].' - '.$annuncioNuovo['id_marca'].' - '.$annuncioNuovo['id_modello'].' - '.$annuncioNuovo['titolo_veicolo'].' '.$annuncioNuovo['version'].'<br />';
                   }
        }
    else
        {
            $messaggio .= 'Nessun nuovo annuncio da inserire<br />';
        }
    
     $messaggio .= '<br /><strong>Errori Annunci in aggiornamento</strong><br />';
     if (count($arrayAnnunciImportatiVecchiError)>0)
        {
            foreach ($arrayAnnunciImportatiVecchiError as $annuncioError1) {
            $messaggio .= $annuncioError1['id_ga'].' - '.$annuncioError1['id_marca'].' - '.$annuncioError1['id_modello'].' - '.$annuncioError1['titolo_veicolo'].' '.$annuncioError1['version'].'<br />';
                   }
        }
    else
        {
            $messaggio .= 'Nessun errore rilevato<br />';
        }
     
    
    $messaggio .= '<br /><strong>Errori Annunci nuovi in inserimento</strong><br />';
     if (count($arrayAnnunciImportatiNuoviError)>0)
        {
            foreach ($arrayAnnunciImportatiNuoviError as $annuncioError2) {
            $messaggio .= $annuncioError2['id_ga'].' - '.$annuncioError2['id_marca'].' - '.$annuncioError2['id_modello'].' - '.$annuncioError2['titolo_veicolo'].' '.$annuncioError2['version'].'<br />';
                   }
        }
    else
        {
            $messaggio .= 'Nessun errore rilevato<br />';
        }
    
    

        $pretesto = '===========================<br />';
        $pretesto .= 'Aggiornamento vetture del : '.date('Y-m-d H:i:s').'<br />';
        $pretesto .= '===========================<br /><br />';
       
    
        $messaggioEmail = $pretesto.'<br /><br />'.$messaggio.'<br /><br />';
    
        $mittente = 'info@autounica.com';
    
        $mail = new PHPMailer();
        //COMMENTO LE 2 RIGHE PER FAR FUNZIONARE MODULO SU ARUBA
        //$mail->IsSMTP();             	// set mailer to use SMTP
        //$mail->Host = costanti::SMTP_HOST;  	// specify main and backup server
        $mail->SMTPAuth = true;     	// turn on SMTP authentication
        $mail->Username = costanti::SMTP_USER;  	// SMTP username
        $mail->Password = costanti::SMTP_PWD; 	// SMTP password
    
        $mail->From = $mittente;
        $mail->FromName = "autoAggiornamento web autounica";
        //$mail->AddAddress(costantiP::EMAIL, costantiP::EMAIL);
        $mail->AddAddress('albini@clickitsolutions.it', 'albini@clickitsolutions.it');
        $mail->AddAddress('leonardorossi92@libero.it', 'leonardorossi92@libero.it');
        $mail->AddAddress('leonardo.rossi@autounica.com', 'leonardo.rossi@autounica.com');
        $mail->AddReplyTo($mittente, $mittente);
    
        $mail->WordWrap = 80;                                 // set word wrap to 50 characters
        $mail->IsHTML(true);                                  // set email format to HTML
        $mail->Subject = 'Aggiornamento vetture del : '.date('Y-m-d H:i:s');
        $mail->Body    = $messaggioEmail;
        if($mail->Send())
        {
            ?>
            <div class="text">
                EMAIL INVIATA
            </div>
            
            
    
            <?
        }
        else
        {
            ?>
            
            <div class="text">
                <h3>Errore durante l'invio del messaggio!</h3>
                Vi preghiamo di segnalare il problema inviando una mail all'indirizzo <a href="mailto:info@clickitsolutions.it" class="txt-normale">info@clickitsolutions.it</a>
                <a href="#" onclick="history.back();"><div class="button"><span>Ritorna alla pagina contatti</span></div></a>
            </div>
    
            <?
            echo "descrizione dell'errore ".$mail->ErrorInfo;
        }
        unset($mail);

}
?>
