<?
include('include_dir.php');
include($percorsoLingua.'include/include.php');

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
    ?>
    importo vetture<br /><br /> 
   
        <?
        $filename = "http://xml.gestionaleauto.com/autounica/export_gestionaleauto.php";
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
                
        foreach($xml->xpath("/export_gestionaleauto/car") as $car)
            { 
             
             
             //verifico se esiste già nel nostro DB
             $sql = "SELECT id_ga FROM veicoli WHERE id_ga = '".$car['id']."'";
             $result=mysql_query($sql);
             echo $sql;
             $arrayAnnunciImportati[] = (string)$car['id'];
                    if(mysql_num_rows($result) > 0)
                    {
                        $annunciimportati++;
                        echo "Trovato un record,'".$car['id']."' non faccio nulla - annunci $annunciimportati<br />";
                        
                    }
                    else
                    {
                        //importo il veicolo
                        $annunciimportati++;
            	    print "<br />AUTO: ".$car->model->make.' '.$car->model->model.' annunci '.$annunciimportati.'<br />';
            		
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
            		titolo_veicolo='".$car->model->make.' '.$car->model->model."',
                    id_ga='".$car['id']."',
                    make='".$car->model->make."',
                    model='".$car->model->model."',
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
                    additional_informations=".stripcslashesandquote($descrizione).",
                    id_categoria='4',
                    data_pubblicazione_inizio='".date("Y-m-d")."',
                    neopatentati=".$neopatentati.",
                    prezzo='".$car->customers_price."'";
                    
                   
                    
            
            		// ... salva tutti i vari campi ...
            		//echo $query.'<br />';	
            		$result=mysql_query($query);
            		if(!$result) print mysql_error();
            		else
            		{
            			//IMPORTO IMMAGINI
                        //$annunciimportati++;
            			$id=mysql_insert_id();
            	
            			// Scarica le eventuali foto (massimo 6):
            			$numfoto=0;
            			foreach($car->images->image as $foto)
            			{
            				$numfoto++;
            				$nomefile=$id."_".$numfoto.".jpg";
            				
            				//scarica su disco la foto				  
            				$copy = copy($foto->big, "../archivio_img/img_o/".$nomefile);
            				if($copy) 
            				{
            					$nomeOriginaleXML = explode('/', $foto->big);
                                $nomeOriginale = array_pop($nomeOriginaleXML);
                                $sql="insert into immagini set img = '".$nomefile."', id_veicolo = ".$id.", nome_originale = '".$nomeOriginale."'";
                                $result=mysql_query ($sql) or die (mysql_error());
                                
                                if($numfoto==1)
                                {
                                    $sql="update veicoli set img = '".$nomefile."' where id = ".$id;
                                    $result=mysql_query ($sql) or die (mysql_error());
                                }
                                
            				}
            				else print "Errore su annuncio ID=".$id." copiando il file: ".$nomefile;
            					 
            				if($numfoto==100) break; // limita a X le immagini importate
            			} // fine foreach
                        
                        //IMPORTO OPTIONALS
                        //$annunciimportati++;
            			// Scarica gli eventuali optionals:
            			foreach($car->options->standard_option as $standard_option)
            			{
            				$sql="insert into optional set titolo = ".stripcslashesandquote($standard_option).", id_veicolo = ".$id.", tipo_optional = 1";
                            echo $sql.'<br />';
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
            print_r($arrayAnnunciImportati);
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        //+++++++++++++++++++++++ FACCIO PULIZIA SUL DATABASE ++++++++++++++++++++++++++++++++
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        
        $sql = "SELECT id, id_ga FROM veicoli";
        $result=mysql_query($sql);
        if(mysql_num_rows($result) > 0)
        {
             while ($row=mysql_fetch_assoc($result)) {
                
                if(in_array($row['id_ga'], $arrayAnnunciImportati)) { 
                   echo "ok";
                }
                else{
                    echo '<h1>cancello tutti i file che ho nel DB ma non appartengono alla lista di quelli che sto importando</h1>';
                    $sqlIMG = "SELECT img FROM immagini where id_veicolo=".$row['id'];
                     
                    $result=mysql_query($sqlIMG);
                        while ($rowIMG=mysql_fetch_assoc($result)) {
                            global $elencoConfigurazioniImmagini;
    
                            
                                $nomeFileTemp=costanti::IMG_PERCORSO_BASE.costanti::IMG_PERCORSO_ORIGINALE.$rowIMG['img'];
                                //echo $nomeFileTemp;
                                if (is_file($nomeFileTemp) && file_exists($nomeFileTemp))
                                    unlink($nomeFileTemp);
                        
                                foreach($elencoConfigurazioniImmagini as $elemento)
                                {
                                    $nomeFileTemp=costanti::IMG_PERCORSO_BASE.$elemento->dirSalvataggio.'/'.$elemento->prefissoFileDestinazione.'_'.$rowIMG['img'];
                                    if (is_file($nomeFileTemp) && file_exists($nomeFileTemp))
                                        unlink($nomeFileTemp);
                                }
                                
                            
                        }
                    
                    echo '<br>'.$row['id_ga'].' non è in array e va cancellato';
                    $sql  = "delete from veicoli where id_ga = ".$row['id_ga'] ;
                    mysql_query($sql);
                }  
                
                
             }
        }
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        //+++++++++++++++++++++++ FACCIO PULIZIA DELLA CARTELLA IMMAGINI +++++++++++++++++++++
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        echo '<h1>Elimino i file inutili</h1>';
        $directory = '../archivio_img/img_o/';
        
        function dir_list($directory = FALSE) {
          $dirs= array();
          $files = array();
          if ($handle = opendir("./" . $directory))
          {
            while ($file = readdir($handle))
            {
              if (is_dir("./{$directory}/{$file}"))
              {
                if ($file != "." & $file != "..") $dirs[] = $file;
              }
              else
              {
                if ($file != "." & $file != "..") $files[] = $file;
                $sqlIMG = "SELECT id FROM immagini where img=".$file;
                $result=mysql_query($sqlIMG);
                    if(mysql_num_rows($result)<1)
                    {
                        //elimino il file presente nella cartella ma non nel DB
                        unlink($directory.$file);
                        
                    }
                
                
              }
            }
          }
          closedir($handle);
        
          reset($dirs);
          sort($dirs);
          reset($dirs);
        
          reset($files);
          sort($files);
          reset($files);
        
          echo "<strong>Cartelle:</strong>\n<ul>";
          while(list($key, $value) = each($dirs))
          {
            $d++;
            echo "<li><a href=\"{$value}\">{$value}/</a>\n";
          }
          echo "</ul>\n";
          echo "<strong>Files:</strong>\n<ul>";
          while(list($key, $value) = each($files))
          {
            $f++;
            echo "<li><a href=\"{$directory}{$value}\">{$value}</a>\n";
          }
          echo "</ul>\n";
          if (!$d) $d = "0";
          if (!$f) $f = "0";
          echo "Sono presenti <strong>{$d}</strong> cartelle e <strong>{$f}</strong> file(s).</strong>\n";
        }
        //dir_list($directory);
        
        
        ?> 
        
    



    <?
}

function HeaderAggiuntivi()
{
    ?>
   
  
    <?
    
}
        
?>
