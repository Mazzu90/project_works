<?
include('include_dir.php');
include($percorsoLingua.'include/include.php');

$grafica=new Tgrafica(false,false);
$grafica->titolo='';
$grafica->keywords='';
$grafica->description='';
$grafica->codicePagina=costantiP::CP_HOMEPAGE;
$grafica->codiceBody='page1';

//$grafica->paint();

$b = date('G', 132170400);
    $a=time();
    $b=date('G', $a);
    echo $b;
    if ($b==10)
    {
        exportCSV();
        echo 'eseguito export';
    }
    else
    {
        echo 'non è mezzogiorno';
    }

unset($grafica);

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
  		immagini.img_hd,
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
            $veicoli[$i]['titolo']=troncaTesto ($row['marcaTitolo'].' '.$row['modelloTitolo'].' '.$row['version'],25);
            $veicoli[$i]['url']= costantiP::BASE_URL.costantiP::LINGUA.'/'.normalizzaTesto($row['make'].'/'.$row['model'].'-'.$row['version'].'_'.$row['id']).'.htm';
            $veicoli[$i]['imgUrl']= $row['img_hd'];
            $veicoli[$i]['subtitle']= 'Da Autounica a Brescia';
            $veicoli[$i]['description']= utf8_decode(troncaTesto ($row['additional_informations']));
            $veicoli[$i]['category']= $row['make'];
            $veicoli[$i]['price']= '€ '.number_format($row['prezzo'],0,',','.');
            $cavalli = $row['kwatt']*1000/735.49875;
            //$valore = number_format($row['km'],0,',','.').' Km; ';
            //$valore = $valore.estraiDataAuto($row['registration_date']).'; ';
            //$valore = $valore.fuelDecode($row['alimentazione']).'; ';
            $veicoli[$i]['keywords']= escapeStringCSV(number_format($row['km'],0,',','.').' Km; '.estraiDataAuto($row['registration_date']).'; '.fuelDecode($row['alimentazione']).'; '.$row['kwatt'].'KW / '.round($cavalli,0).'CV; '.$row['gearbox'].'; '.$row['colore'].'; '.$row['interni']);
            $veicoli[$i]['address']= '- Brescia, BS - Via Valcamonica, 19/h - 45,5471165 ,10,1638985';
            $i++;
    	}
        
        $output='';
    
        $fp = fopen('../google/google_autounica2.csv', 'w');
        
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
        fputcsv($fp, $line, ";");
    }
    //fputcsv($fp, $array_to_csv,',');
    $i=1;
    foreach ($veicoli as $term) {
			     
                fputcsv($fp, $term, ";");
               
			}
            
            
     fclose($fp);
    return $output;
	      
}


function exportCSV2()
{
        
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
  		immagini.img_hd,
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
            $veicoli[$i]['titolo']=troncaTesto ($row['marcaTitolo'].' '.$row['modelloTitolo'].' '.$row['version'],25);
            $veicoli[$i]['url']= costantiP::BASE_URL.costantiP::LINGUA.'/'.normalizzaTesto($row['make'].'/'.$row['model'].'-'.$row['version'].'_'.$row['id']).'.htm';
            $veicoli[$i]['imgUrl']= $row['img_hd'];
            $veicoli[$i]['subtitle']= 'Da Autounica a Brescia';
            $veicoli[$i]['description']= utf8_decode(troncaTesto ($row['additional_informations']));
            $veicoli[$i]['category']= $row['make'];
            $veicoli[$i]['price']= '€ '.number_format($row['prezzo'],0,',','.');
            $cavalli = $row['kwatt']*1000/735.49875;
            //$valore = number_format($row['km'],0,',','.').' Km; ';
            //$valore = $valore.estraiDataAuto($row['registration_date']).'; ';
            //$valore = $valore.fuelDecode($row['alimentazione']).'; ';
            $veicoli[$i]['keywords']= number_format($row['km'],0,',','.').' Km; '.estraiDataAuto($row['registration_date']).'; '.fuelDecode($row['alimentazione']).'; '.$row['kwatt'].'KW / '.round($cavalli,0).'CV; '.$row['gearbox'].'; '.$row['colore'].'; '.$row['interni'];
            $veicoli[$i]['address']= '- Brescia, BS - Via Valcamonica, 19/h - 45,5471165 ,10,1638985';
            $i++;
    	}
        
        $output='';
    
        
         $array_to_csv = Array(
            Array('ID',
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
    $csv = '';
   $csv = "ID;Item title;Final URL;Image URL;Item subtitle;Item description;Item category;Price;Contextual keywords;Item address"."\n"; 
   
   foreach ($veicoli as $record){
    $csv.= $record['id_ga'].';'.$record['titolo'].';'.$record['url'].';'.$record['imgUrl'].';'.$record['subtitle'].';'.$record['description'].';'.$record['category'].';'.$record['price'].';'.$record['keywords'].';'.$record['address']."\n"; //Append data to csv
    }
    
    $csv_handler = fopen ('../archivio_img/veicoli.csv','w');
        fwrite ($csv_handler,$csv);
        fclose ($csv_handler);        
    //echo 'Data saved to veicoli.csv'; 
	      
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
      
?>
