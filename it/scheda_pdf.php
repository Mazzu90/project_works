<?


/*****************************************************************
INCLUSIONI
*****************************************************************/
set_time_limit ( 240 );
/*$percorso='../';
include('include_dir.php');
include('include/include.php');
*/
//include($percorso.'include/include.php');
//include($percorso.'include/class.immagini.php');



if (!(isset($lInclude)&&($lInclude)))
{
    include('include_dir.php');
    include($percorsoLingua.'include/include.php');
    
    $grafica=new Tgrafica(false,false);
    //$idVeicolo = isset($_GET['id'])?$_GET['id']:0;
    
}

require_once($percorso.'tcpdf/config/lang/ita.php');
//require_once($percorso.'tcpdf_6/config/tcpdf_config.php');
require_once($percorso.'tcpdf/tcpdf.php');
// Extend the TCPDF class to create custom Header and Footer

//$grafica=new Tgrafica(false);

$idVeicolo = isset($_GET['id'])?$_GET['id']:-1;

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
                veicoli.make as marcaContenuto,
                veicoli.model as modelloContenuto,
                veicoli.version as versioneContenuto,
                categorie.url as titoloCategoria
            from
                veicoli
                    inner join categorie
                        on veicoli.id_categoria = categorie.id 
                    where veicoli.id = '.$idVeicolo;
    $rs = mysql_query($sql);
    if (mysql_num_rows($rs)>0)
    {
        $row=mysql_fetch_array($rs);
        $titoloCategoria=normalizzaTesto($row['titoloCategoria']);
        $titoloContenuto=normalizzaTesto($row['modelloContenuto'].'-'.$row['versioneContenuto']);
        $titoloMarca=normalizzaTesto($row['marcaContenuto']);
        //$url = costantiP::BASE_URL.costantiP::LINGUA.'/'.$titoloCategoria.'/'.$titoloContenuto.'_'.$idVeicolo.'.htm';
        $url = costantiP::BASE_URL.costantiP::LINGUA.'/print/'.$titoloMarca.'/'.$titoloContenuto.'_'.$idVeicolo.'.htm';
        header ('HTTP/1.1 301 Moved Permanently');
        header('location: '.$url);
    }
}


$sql = 'select 
                    veicoli.*,
                    categorie.titolo_categoria as nomeCategoria
                    from 
                        veicoli 
                    inner join 
                        categorie 
                    on categorie.id = veicoli.id_categoria
                    where 
                        veicoli.id = '.$idVeicolo;

if (!getRecord($sql,$row))
        {
            //header('location: 404.php');
        }
        
        

$grafica->titolo='AUTOUNICA srl - Vendita di auto usate a Brescia - '.$row['nomeCategoria'].' - '.$row['titolo_veicolo'];
$grafica->keywords=$row['nomeCategoria'].', '.$row['titolo_veicolo'].', '.$row['version'].', auto usate, veicoli usati, vendita auto usate Brescia';
$grafica->description='Ampio showroom con oltre 200 vetture disponibili, vendita di '.$row['titolo_veicolo'].' '.$row['version'];
$grafica->codicePagina=costantiP::CP_STAMPA;
$grafica->codiceBody='page1';



        
/*****************************************************************
RECUPERO VALORI DAI PARAMETRI
*****************************************************************/


$pdf=iniziaPDFA4();
  
    


preparaDati($pdf);
//Change To Avoid the PDF Error
  ob_end_clean();
$pdf->Output('scheda.pdf', 'I');
unset($pdf);
unset($grafica);

function preparaDati(&$pdf)
{$pdf->AddPage();
            //$pdf->SetFont('verdanab', '', 11);
            $pdf->SetFont('helvetica', '', 9);
            stampaScheda($pdf);
      
    
     
}

//CATALOGO A4 PORTRAIT
function stampaScheda(&$pdf)
{global $idVeicolo;

    $sql = 'select 
                    veicoli.*
                    from 
                        veicoli 
                   where 
                        veicoli.id = '.$idVeicolo;
    if (!getRecord($sql,$row))
        {
            echo 'qualcosa non va';
        }                    
    $immaginiVeicolo = array();
                                    
    $sql = 'select immagini.* from immagini where immagini.id_veicolo = '.$idVeicolo;
    $result=mysql_query($sql);
    
       while ($rowImmagini=mysql_fetch_assoc($result)) {
                $immagineVeicolo['id']=$rowImmagini['id'];
                $immagineVeicolo['img']=$rowImmagini['img'];
                $immagineVeicolo['imgHd']=$rowImmagini['img_hd'];
                $immagineVeicolo['imgBig']=$rowImmagini['img_big'];
                $immagineVeicolo['titolo']=$rowImmagini['titolo'];
                $immaginiVeicolo[]=$immagineVeicolo; 
            }
                                            
    $numeroImmmagini= count($immaginiVeicolo);
    $cavalli = $row['kwatt']*1000/735.49875;
                            
    $s = '<div class="col-md-7 col-xs-12">
                    	<strong>'.  $row['make'].' '.$row['model'].'</strong><br />
                        <strong>'. $row['version'].'</strong><br />
                    </div>';
    $s .= '<table cellpadding="4" cellspacing="6" width="750" border="0" bgcolor="#fff">
  <tr>
  <td width="350" align="center"><img class="example-image img-responsive" src="'.$immaginiVeicolo[0]['imgBig'].'"  /></td>
  <td width="250" align="left" ><h4>Informzioni generali</h4>
                                <strong>KM percorsi</strong>: '. number_format($row['km'],0,',','.').' Km<br />
                                <strong>Immatricolazione</strong>: '. estraiDataAuto($row['registration_date']).'<br />
                                <strong>Alimentazione</strong>: '. fuelDecode($row['alimentazione']).'<br />
                                <strong>Potenza</strong>: '. $row['kwatt'].' KW / '. round($cavalli,0).' CV<br />
                                <strong>Cambio</strong>: '. $row['gearbox'].'<br />
                                <strong>Colore</strong>: '. $row['colore'].'<br />
                                <strong>Interni</strong>: '. $row['interni'].'<br />
                                <strong>Targa</strong>: '. $row['plate'].'<br />
                                <br />
                                <strong>Prezzo</strong>: '. number_format($row['prezzo'],0,',','.').' €<br />
  
  </td>

 </tr>
 <tr><td colspan="2">'. $row['additional_informations'].'</td></tr></table>
 
 <table cellpadding="4" cellspacing="6" width="750" border="0" bgcolor="#fff">
     <tr nobr="tr">
         <td width="200">
         <strong>Dettagli</strong><p>
                                    <strong>Immatricolazione:</strong> '. estraiDataAutoContratta($row['registration_date']).'
                                    <br />
                                   <strong>Carrozzeria</strong>: '. $row['body'].'
                                   <br />
                                    <strong>Omologazione:</strong> '. emissionDecode($row['emission_class']).'
                                    <br />
                                    <strong>Cilindrata:</strong> '. ($row['cc']).' cc
                                    <br />
                                    <strong>Posti:</strong> '. ($row['seats']).'
                                    <br />
                                   <strong>Porte:</strong> '. ($row['doors']).'
                                   <br />
                                    <strong>Trazione:</strong> '.($row['traction']).'
                                    <br />
                                  <strong>Emissioni:</strong> '. ($row['emission_co2']).' g/km
                                  <br />
                                 <strong>Consumi</strong>
                                 <br />
                                       urbano: '. ($row['consumo_urbano']).' l/100km<br />
                                       extraurbano:'. ($row['consumo_extra']).' l/100km<br />
                                       misto: '. ($row['consumo_misto']).' l/100km<br />
                                     
                                       &nbsp;  
                                        </p>
         </td>
         <td width="400">
         <strong>Accessori</strong><p>
                 <table>';
                 $accessori = array();
                                            
                                                $sql = 'select optional.* from optional where optional.id_veicolo = '.$idVeicolo.' order by titolo asc';
                                                $result=mysql_query($sql);
                                                $optional = '';
                                                   while ($rowOptional=mysql_fetch_assoc($result)) {
                                                            $optionalVeicolo['id']=$rowOptional['id'];
                                                            $optionalVeicolo['titolo']=$rowOptional['titolo'];
                                                            $accessori[]=$optionalVeicolo; 
                                                        }
                                                        
                                             $risultato = count($accessori);
                                             $i=0;
                                                         foreach ($accessori as $acc) {
                                                            
                                                            if($i==0)
                                                                $optional .= '<tr>';
                                                                
                                                            $optional .= '<td>'.$acc['titolo'].'</td>';
                                                            $i++;
                                                           
                                                           if($i!=$risultato)
                                                               {
                                                                if(($i%2)==0)
                                                                $optional .= '</tr><tr>';
                                                               }
                                                               else
                                                               {
                                                                if(($risultato%2)==0)
                                                                    $optional .= '</tr></table>';
                                                                else
                                                                    $optional .= '<td></td></tr></table>';
                                                                
                                                                
                                                               }
                                                           
                                                             }
                                                       
                                                        
                                        
                                        
                                      
                                    $s .= $optional.'';
                 
                 
                 $s .='
         </p></td>
     </tr>
 </table>';
 $pdf->writeHTML($s, true, 0, true, 0);
}



//-----------------------


function iniziaPDFA4()
{
   $orientamento = 'P';
   $formato = 'A4';
  $intestazione = '';
        
        
        class MYPDF extends TCPDF {
        
            //Page header
            public function Header() {
                
                // Logo
                //$this->SetLineStyle(array('width' => 0.1 / $this->getScaleFactor(), 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 255, 255)));
                // Logo
                $image_file = K_PATH_IMAGES.'logo.jpg';
                $this->Image($image_file, 15, 1, 40, '', 'JPG', '', 'T', false, 300, '', false, false, '0', false, false, false);
                //      Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false, $alt=false, $altimgs=array()) {
		
                // Set font
                //$this->SetFont('verdana', '', 15);
                // Title
                //$this->Cell(0, 15, '<< '.$titoloCatalogo.' >>', 0, false, 'R', 0, '', 0, false, 'M', 'M');
                // Page number
                //$this->Cell(0, 10, '- '.$this->getAliasNumPage().' -', 0, false, 'R', 0, '', 0, false, 'M', 'M');
                
        		//$this->Cell(0, 15, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'M', 'M');
        		
            }
            // Page footer
                public function Footer() {
                    // Position at 15 mm from bottom
                    $this->SetY(-15);
                    // Set font
                    $this->SetFont('helvetica', 'I', 8);
                    // Page number
                    $this->Cell(0, 10, 'AUTOUNICA Srl', 0, false, 'C', 0, '', 0, false, 'T', 'M');
                    $this->SetY(-12);
                    $this->Cell(0, 10, 'Via Valcamonica, 19/H - 25132 Brescia - 030 2410251 ', 0, false, 'C', 0, '', 0, false, 'T', 'M');
                }
        
        }
        
        
      
        
  
        $pdf = new MYPDF($orientamento, PDF_UNIT, $formato, true, 'Latin1', false); 
		//$pdf = new TCPDF($orientamento, PDF_UNIT, $formato, true, 'Latin1', false); 
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Click IT Solutions');
		$pdf->SetTitle('Catalogo virtuale');
		$pdf->SetSubject('Veschetti Gioielli');
		$pdf->SetKeywords('Stampa catalogo prodotti ');
        
        
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);
        
        
        
		// set default header data
    		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		//set margins
		if ( $intestazione == 2 ) //non stampare l'intestazione
            $pdf->SetMargins(PDF_MARGIN_LEFT, 2, PDF_MARGIN_RIGHT);
        else
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		//set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 
		//set some language-dependent strings
		//$pdf->setLanguageArray($l); 
		// ---------------------------------------------------------
		// set font
		//$pdf->SetFont('dejavusans', '', 9);
		return $pdf;
}
?>