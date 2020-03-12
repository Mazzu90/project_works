<?
function CA_Encrypt($par,$prefix=true)
{
    return $par;
}
function __CA_Encrypt($par,$prefix=true)
{
	if ($prefix)
		$txt = "CA_" . $par;
	else
		$txt = $par;
	//srand((double)microtime()*1000000);
	srand( 1000000 );
	$encrypt_key = md5(rand(0,32000));
	$ctr=0;
	$tmp = "";
	for ($i=0;$i<strlen($txt);$i++)
	{
		if ($ctr==strlen($encrypt_key)) $ctr=0;
		$tmp.= substr($encrypt_key,$ctr,1) .
		(substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1));
		$ctr++;
	}
	return base64_encode(keyED($tmp,costanti::CA_EncKey));
}


function CA_EncryptForURL($txt)
{
    return $txt;

}
function __CA_EncryptForURL($txt)
{
	$txt = (string)$txt;
	//settype($txt,'string');
	return rawurlencode(CA_Encrypt($txt));
}
function CA_Decrypt($txt,$prefix=true)
{
    return $txt;

}
function __CA_Decrypt($txt,$prefix=true)
{
	settype($txt,'string');
	$txt = keyED(base64_decode($txt),costanti::CA_EncKey);
	$tmp = "";
	for ($i=0;$i<strlen($txt);$i++)
	{
	$md5 = substr($txt,$i,1);
	$i++;
	$tmp.= (substr($txt,$i,1) ^ $md5);
	}
	if ($prefix)
	{
		if (substr($tmp,0,3)=="CA_")
			return substr($tmp,3);
		else
		 	return "";
	}
	else
		return $tmp;
}

function keyED($txt,$encrypt_key)
{
	$encrypt_key = md5($encrypt_key);
	$ctr=0;
	$tmp = "";
	for ($i=0;$i<strlen($txt);$i++)
	{
	if ($ctr==strlen($encrypt_key)) $ctr=0;
	$tmp.= substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1);
	$ctr++;
	}
	return $tmp;
}

function odd($numero)
{
	return ($numero % 2 == 1);
}

function GetFieldValue( $sql, $fieldname )
{
	if (GetRecord($sql,$row))
		return $row[$fieldname];
	else
		return '';
}

function GetRecord( $sql , &$row)
{
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);
    return mysql_num_rows($rs)>0;
}

function blank_to_zero($x)
{
	if (trim($x)=="" || empty($x))
		return "0";
	else
		return $x;
}

function str_quoted($x)
{
	return "'" . str_replace ("'", "''", $x) . "'";
}
function stripcslashesandquote($x)
{
	return str_quoted(stripcslashes($x));
}

function ProssimoIdTabella($tabella)
{
	$sql='select id, contatore from contatori where tabella = '.stripcslashesandquote($tabella);
	$rs = mysql_query($sql);
	if (mysql_num_rows($rs)>0)
	{
		$row=mysql_fetch_array($rs);
		$contatore = $row['contatore']+1;
		$contatoreEffettivo = GetFieldValue('select max(id) as numero from '.$tabella, 'numero');
		if ($contatore<$contatoreEffettivo)
			$contatore = $contatoreEffettivo+1;
		$sql = 'update contatori set contatore = '.stripcslashesandquote($contatore).' where id = '.$row['id'];
		mysql_query($sql);
	}
	else
	{
		$contatore = GetFieldValue('select max(id) as numero from '.$tabella, 'numero')+1;
		$sql = 'insert into contatori (tabella, contatore) values ('.stripcslashesandquote($tabella).', '.$contatore.')';
		mysql_query($sql);  
	}
	return $contatore;
}

function ProssimoContatore($parametro)
{
	$sql='select id, contatore from contatori where tabella = '.stripcslashesandquote($parametro);
	$rs = mysql_query($sql);
	if (mysql_num_rows($rs)>0)
	{
		$row=mysql_fetch_array($rs);
		$contatore = $row['contatore']+1;
		$contatoreEffettivo = 0;
		if ($contatore<$contatoreEffettivo)
			$contatore = $contatoreEffettivo;
		$sql = 'update contatori set contatore = '.stripcslashesandquote($contatore).' where id = '.$row['id'];
		mysql_query($sql);
	}
	else
	{
		$contatore = 1;
		$id = getfieldvalue('select max(id) as numero from contatori','numero')+1;
		$sql = 'insert into contatori (id, tabella, contatore) values ('.$id.', '.stripcslashesandquote($parametro).', '.$contatore.')';
		mysql_query($sql);
	}
	return $contatore;
}

function pad0($numero,$zeri)
{
    $x = $numero;
    $x .= 'temp';
    $x = substr($x,0,strlen($x)-4);
    while (strlen($x) <$zeri)
    {
        $x = '0'.$x;
    }
    return $x;
}

function padr($txt,$len,$carattere)
{
    $x = $txt;
    while (strlen($x) <$len)
    {
		$x=$x.$carattere;
    }
    return $x;
}

function dbdate2string($data,$cifre_anno=4)
{
	$giorno = 0;
	$anno = 0;
	$mese = 0;
	dbdate_decode($data,$giorno,$mese,$anno);
	if ($giorno >0)
		return FormatDate($giorno,$mese,$anno,'dd/mm/'.iif($cifre_anno==4,"yyyy","yy"));
	else
		return '';
}

function FormatDate($day,$month,$year,$format)
{
    $x = $format;
    $x =  str_replace ("dd", pad0($day,2), $x);

    $x =  str_replace ("mm", pad0($month,2), $x);
    $x =  str_replace ("yyyy", pad0($year,4), $x);
    $x =  str_replace ("d", pad0($day,1), $x);
    $x =  str_replace ("m", pad0($month,1), $x);
    return $x;
}

function iif($condizione,$r1,$r2)
{
	if ($condizione)
		return $r1;
	else
		return $r2;
}

function dbdate_decode($data,&$giorno,&$mese,&$anno)
{
	$data =substr($data,0,10);
	$data = str_replace('.','/' ,$data);
	$data = str_replace('-','/' ,$data);
	$data = str_replace(',','/' ,$data);
	$data = str_replace(':','/' ,$data);
	if ($data!='')
	{
		$aData=explode('/',$data);
		if (strlen($aData[0])==4)
		{
			$anno = $aData[0];
			$giorno = $aData[2];
		}
		else
		{
			$anno = $aData[2];
			$giorno = $aData[0];
		}
		$mese = $aData[1];
	}

    if ($data == '' || !checkdate( intval($mese), intval($giorno), intval($anno) ) /* by paolo */)
	{
		$anno   = "";
		$mese   = "";
		$giorno = "";
	}
}

function dbdate_encode($day,$month,$year )
{
	if ( checkdate( $month, $day, $year ) )
		return "'$year/".pad0($month,2)."/".pad0($day,2)."'";
	else
		return "null";
}

function itdate_decode($data, &$giorno_pronto, &$mese_pronto, &$anno_pronto)
{
	if ($data != "")
    {
		$giorno_pronto = substr($data, 0, 2);
		$mese_pronto = substr($data, 3, 2);
		$anno_pronto = substr($data, 6, 4);
    }
    if ($data == "" || ! checkdate( $mese_pronto, $giorno_pronto, $anno_pronto ) )
    {

			$anno_pronto = "";
			$mese_pronto = "";
			$giorno_pronto = "";
	}
}

function itdate2dbdate($data)
{
	/*
	esempio (ho ricevuto $data_scadenza)

	"update pippo set data = ".itdate2dbdate($data_scadenza)

	*/
	itdate_decode($data,$giorno,$mese,$anno);
		$giorno = (integer)$giorno;
		$mese = (integer)$mese;
		$anno = (integer)$anno;
	return dbdate_encode($giorno,$mese,$anno);
}

function CheckITDate($cData)
{
	return CheckITDate2($cData,$Giorno,$Mese,$Anno);
}

function CheckITDate2($cData,&$Giorno,&$Mese,&$Anno)
{
	$risultato = false;
	if (strlen($cData)==10)
	{
		$nSlash=0;
		for ($i=0;$i<10;$i++)
			if (($cData[$i]=='/')||($cData[$i]=='-'))
				$nSlash++;

		if ($nSlash==2)
			if  (
				(($cData[2]=='/')||($cData[2]=='-')) &&
				(($cData[5]=='/')||($cData[5]=='-'))
				)
				if  (
					(is_numeric(substr($cData,0,2))) &&
					(is_numeric(substr($cData,3,2))) &&
					(is_numeric(substr($cData,6,4)))
					)
					if  (
						((integer)substr($cData,0,2)<32) &&
						((integer)substr($cData,3,2)<13)
						)
					{
						$risultato = checkdate ( (integer)substr($cData,3,2) , (integer)substr($cData,0,2) , (integer)substr($cData,6,4));
						$Giorno = (integer)substr($cData,0,2);
						$Mese = (integer)substr($cData,3,2);
						$Anno = (integer)substr($cData,6,4);
					}
	}
	return $risultato;
}

function CheckITOra($cOre)
{
	/*
		questa funzione verifica che la stringa passata come parametro sia
		formalmente valida per identificare un'ora.

		il formato ora accettato è hh:nn

		la punteggiatura di separazione delle ore con i minuti può essere "." "," ":"
	*/
	$risultato = false;
	$cOre=str_replace('.',':' ,$cOre);
	$cOre=str_replace(',',':' ,$cOre);
	if (strlen($cOre)==5)
	{
		$lOre=false;
		$aOre=explode(':',$cOre);
		if (count($aOre)==2)
		{
			if (is_numeric($aOre[0]))
				if ( ($aOre[0]>=0) &&  ($aOre[0]<24) )
					$lOre=true;

			$lMinuti=false;
			if ($lOre)
				if (is_numeric($aOre[1]))
					if ( ($aOre[1]>=0) && ($aOre[1]<60) )
						$lMinuti = true;

			if ($lOre && $lMinuti)
				$risultato = true;
		}
	}
	return $risultato;
}

function minuti2ore($TotMinuti)
{
 	$minuti = $TotMinuti%60;
 	$ore = ($TotMinuti-$minuti)/60;

 	if ($minuti<10)
 		$minuti = '0'.$minuti;

 	if ($ore<10)
 		$ore = '0'.$ore;

	return $ore.':'.$minuti;
}

function ore2minuti($cOre)
{
	$cOre=str_replace('.',':' ,$cOre);
	$cOre=str_replace(',',':' ,$cOre);
	$aOre=explode(':',$cOre);
	$minuti = ($aOre[0]*60)+$aOre[1];
	return $minuti;
}

function minuti2ore2($TotMinuti,&$ore,&$minuti)
{
 	$minuti = $TotMinuti%60;
 	$ore = ($TotMinuti-$minuti)/60;

 	if ($minuti<10)
 		$minuti = '0'.$minuti;

 	if ($ore<10)
 		$ore = '0'.$ore;
}

function CambiaParametroQueryString( $parametro,$valore, $post=false, $url='' )
{
	global $_GET,$_SERVER, $_POST;

	$chiavi = array_keys($_GET);
	$qs = '';
	$sost = false;
	for ($i=0;$i<sizeof($chiavi);$i++)
	{
		if ($qs=='')
				$qs .= '?';
			else
				$qs .= '&';

		if (strtoupper($chiavi[$i]) != strtoupper($parametro) )
		{
			$qs .= $chiavi[$i].'='.stripcslashes($_GET[$chiavi[$i]]);
		}
		else
		{
			$qs .= $parametro.'='.$valore;
			$sost = true;
		}
	}
	if (!$sost)
	{
		if ($qs=='')
			$qs .= '?';
		else
			$qs .= '&';

		$qs .= $parametro.'='.$valore;
	}

	if ($post)
	{
		$campo = array_keys($_POST);
		for ($i=0;$i<sizeof($_POST);$i++)
		{
			if ($qs=='')
				$qs .= '?';
			else
				$qs .= '&';
			$qs .= $campo[$i] . '=' . $_POST[$campo[$i]];
		}
	}

	if ($url != "")
		return $url.$qs;
	else
		return $_SERVER["PHP_SELF"].$qs;
}

function NomeMese($i,$lingua='it')
{
	switch($i)
	{
		case 1:
                        switch($lingua)
                        {
                            case 'it':
                                return 'Gennaio';
                                break;
                            case 'en':
                                return 'Jennuary';
                                break;
                        }
                        break;
		case 2:
                        switch($lingua)
                        {
                            case 'it':
                                return 'Febbraio';
                                break;
                            case 'en':
                                return 'February';
                                break;
                        }
                        break;
		case 3:
                        switch($lingua)
                        {
                            case 'it':
                                return 'Marzo';
                                break;
                            case 'en':
                                return 'March';
                                break;
                        }
                        break;
		case 4:
                        switch($lingua)
                        {
                            case 'it':
                                return 'Aprile';
                                break;
                            case 'en':
                                return 'April';
                                break;
                        }
                        break;
		case 5:
                        switch($lingua)
                        {
                            case 'it':
                                return 'Maggio';
                                break;
                            case 'en':
                                return 'May';
                                break;
                        }
                        break;
		case 6:
                        switch($lingua)
                        {
                            case 'it':
                                return 'Giugno';
                                break;
                            case 'en':
                                return 'June';
                                break;
                        }
                        break;
		case 7:
                        switch($lingua)
                        {
                            case 'it':
                                return 'Luglio';
                                break;
                            case 'en':
                                return 'July';
                                break;
                        }
                        break;
		case 8:
                        switch($lingua)
                        {
                            case 'it':
                                return 'Agosto';
                                break;
                            case 'en':
                                return 'August';
                                break;
                        }
                        break;
		case 9:
                        switch($lingua)
                        {
                            case 'it':
                                return 'Settembre';
                                break;
                            case 'en':
                                return 'September';
                                break;
                        }
                        break;
		case 10:
                        switch($lingua)
                        {
                            case 'it':
                                return 'Ottobre';
                                break;
                            case 'en':
                                return 'October';
                                break;
                        }
                        break;
		case 11:
                        switch($lingua)
                        {
                            case 'it':
                                return 'Novembre';
                                break;
                            case 'en':
                                return 'November';
                                break;
                        }
                        break;
		case 12:
                        switch($lingua)
                        {
                            case 'it':
                                return 'Dicembre';
                                break;
                            case 'en':
                                return 'Dicember';
                                break;
                        }
                        break;
		default:
			return 'Valore non ammesso';
			break;
	}
}

function HTML2Testo($s,$lAccento=true)
{
  if ($lAccento)
  {
  $search = array ("'<script[^>]*?>.*?</script>'si",  // Rimozione del javascript
                 "'<[\/\!]*?[^<>]*?>'si",          // Rimozione dei tag HTML
                 "'([\r\n])[\s]+'",                // Rimozione degli spazi bianchi
                 "'&(quot|#34);'i",                // Sostituzione delle entità HTML
                 "'&(amp|#38);'i",
                 "'&(lt|#60);'i",
                 "'&(gt|#62);'i",
                 "'&(agrave|);'i",
                 "'&(egrave|);'i",
                 "'&(igrave|);'i",
                 "'&(ograve|);'i",
                 "'&(ugrave|);'i",
                 "'&(nbsp|#160);'i",
                 "'&(iexcl|#161);'i",
                 "'&(cent|#162);'i",
                 "'&(pound|#163);'i",
                 "'&(copy|#169);'i",
                 "'&#(\d+);'e");                    // Valuta come codice PHP
  }
  else
  {
  $search = array ("'<script[^>]*?>.*?</script>'si",  // Rimozione del javascript
                 "'<[\/\!]*?[^<>]*?>'si",          // Rimozione dei tag HTML
                 "'([\r\n])[\s]+'",                // Rimozione degli spazi bianchi
                 "'&(quot|#34);'i",                // Sostituzione delle entità HTML
                 "'&(amp|#38);'i",
                 "'&(lt|#60);'i",
                 "'&(gt|#62);'i",
                 "'&(agrave|);'i",
                 "'&(egrave|);'i",
                 "'&(igrave|);'i",
                 "'&(ograve|);'i",
                 "'&(ugrave|);'i",
                 "'à'i",
                 "'è'i",
                 "'é'i",
                 "'ì'i",
                 "'ò'i",
                 "'ù'i",
                 "'&(nbsp|#160);'i",
                 "'&(iexcl|#161);'i",
                 "'&(cent|#162);'i",
                 "'&(pound|#163);'i",
                 "'&(copy|#169);'i",
                 "'&#(\d+);'e");                    // Valuta come codice PHP
  }
/*
                 "'&agrave;'à",
                 "'&egrave;'è",
                 "'&igrave;'ì",
                 "'&ograve;'ò",
                 "'&ugrave;'ù",

*/
if ($lAccento)
{
$replace = array ("",
                 "",
                 "\\1",
                 "\"",
                 "&",
                 "<",
                 ">",
                 "à",
                 "è",
                 "ì",
                 "ò",
                 "ù",
                 " ",
                 chr(161),
                 chr(162),
                 chr(163),
                 chr(169),
                 "chr(\\1)");
}
else
{
	$replace = array ("",
	                 "",
	                 "\\1",
	                 "\"",
	                 "&",
	                 "<",
	                 ">",
	                 "a'",
	                 "e'",
	                 "i'",
	                 "o'",
	                 "u'",
	                 "a'",
	                 "e'",
	                 "e'",
	                 "i'",
	                 "o'",
	                 "u'",
	                 " ",
	                 chr(161),
	                 chr(162),
	                 chr(163),
	                 chr(169),
	                 "chr(\\1)");
}
return preg_replace($search, $replace, $s);
}

function ultimoGiornoMese($mese, $anno)
{
	if ($mese==12)
	{
		//risolvo il problema di dicembre che diventa gennaio
		$mese=1;
		$anno++;
	}
	return date('d',mktime(0, 0, 0, ++$mese, 0, $anno));

}

function convertiCaratteriStampabili($s)
{
	$s = str_replace('à','&agrave;',$s);
	$s = str_replace('è','&egrave;',$s);
	$s = str_replace('é','&egrave;',$s);
	$s = str_replace('ì','&igrave;',$s);
	$s = str_replace('ò','&ograve;',$s);
	$s = str_replace('ù','&ugrave;',$s);
	$s = str_replace('“','&quot;',$s);
	$s = str_replace('”','&quot;',$s);
	$s = str_replace('°','&deg;',$s);
	$s = str_replace("’","'",$s);
	$s = str_replace("…","...",$s);
	$s = str_replace("À","A'",$s);
	$s = str_replace("È","E'",$s);
	$s = str_replace("–","-",$s);
	$s = str_replace("­","",$s);
	return $s;
}

function normalizzaTesto($testo)
{
	$testo = str_replace("-",' ' ,$testo);
    $testo=trim($testo);
	$testo = str_replace("à",'a' ,$testo);
	$testo = str_replace("è",'e' ,$testo);
	$testo = str_replace("ì",'i' ,$testo);
	$testo = str_replace("ò",'o' ,$testo);
	$testo = str_replace("ù",'u' ,$testo);

	$testo = str_replace("á",'a' ,$testo);
	$testo = str_replace("é",'e' ,$testo);
	$testo = str_replace("í",'i' ,$testo);
	$testo = str_replace("ó",'o' ,$testo);
	$testo = str_replace("ú",'u' ,$testo);

	$testo = str_replace("ä",'a' ,$testo);
	$testo = str_replace("ë",'e' ,$testo);
	$testo = str_replace("ï",'i' ,$testo);
	$testo = str_replace("ö",'o' ,$testo);
	$testo = str_replace("ü",'u' ,$testo);
    
    $testo = str_replace("È",'e' ,$testo);    

	$testo = str_replace("°",'' ,$testo);
    $testo = str_replace("+",'' ,$testo);
    $testo = str_replace("'",'-' ,$testo);
	$testo = str_replace("’",'-' ,$testo);
	$testo = str_replace("–",'-' ,$testo);
	$testo = str_replace('"',' ' ,$testo);
	$testo = str_replace('“',' ' ,$testo);
	$testo = str_replace('”',' ' ,$testo);
	$testo = str_replace('?',' ' ,$testo);
	$testo = str_replace('!',' ' ,$testo);
	$testo = str_replace('(',' ' ,$testo);
	$testo = str_replace(')',' ' ,$testo);
	$testo = str_replace('.','-' ,$testo);
    $testo = str_replace(':','' ,$testo);
    $testo = str_replace('&','-' ,$testo);
	$testo = str_replace(',','-' ,$testo);
	$testo = str_replace(' ','-' ,$testo);
	$testo = str_replace('--','-' ,$testo);
	$testo = str_replace('--','-' ,$testo);
    $testo = str_replace('/','' ,$testo);
    $testo = str_replace('#','' ,$testo);
    return strtolower($testo);
}
function rn2br($s)
{
	return str_replace(chr(13),'<br>' ,$s );
}

function selectTipologie($idTipologiaPadre, $idGalleryDefault)
{

    //$sql = 'select id, titolo from tipologie where id_tipologia = '.$idTipologiaPadre.' order by titolo';
     $sql = 'select id, titolo_it from tipologie where id_tipologia = '.$idTipologiaPadre.' and id not in ('.costanti::TIPOLOGIE_GALLERY_SISTEMA_SQL.') order by titolo_it';
     
     $rsGallerie = mysql_query($sql);
    if (mysql_num_rows($rsGallerie)>1)
    {
        //stampiamo l'elenco delle tipologie news
        $Elementi = array();
          $Elementi[]= array('Nessuna Gallery associata',0);
           $Elementi[]= array('Tutte le tipologie',-1);
        while($rowGallerie=  mysql_fetch_array($rsGallerie))
            $Elementi[]= array($rowGallerie['titolo_it'],$rowGallerie['id']);

        ?><div class="form-label">Tipologie gallerie:</div>
        <div class="form-select">
        <?
        //$pagina = "'".costanti::BASE_URL."include/ajax_tipologie.php?idGalleryDefault=".$idGalleryDefault."&id_tipologia=3001'";
        $pagina = "'".costanti::BASE_URL."include/ajax_tipologie.php?idGalleryDefault=".$idGalleryDefault."&id_tipologia_gallery='+document.getElementById('id_tipologia_gallery').value";
        $onchange = "getDataAjax(".$pagina.")";
        
        $sql = 'select id_tipologia from gallery where id='.$idGalleryDefault;
             $idTipologiadefault = GetFieldValue($sql, 'id_tipologia');
    
        HTML_Select($Elementi,'id_tipologia_gallery',$idTipologiadefault,$onchange);
        ?></div>
        <div id="divdataajax"></div>
        
        <script type="text/javascript"><?=$onchange?></script>
        <?
        
    }
    else 
    
    {
        $rowGallerie=mysql_fetch_array($rsGallerie);
        $pagina = "'".costanti::BASE_URL."include/ajax_tipologie.php?lAddNessuna=1&idGalleryDefault=".$idGalleryDefault."&id_tipologia_gallery='+document.getElementById('id_tipologia_gallery').value";
        $onchange = "getDataAjax(".$pagina.")";
        
        ?>
        <input type="hidden" name="id_tipologia_gallery" id="id_tipologia_gallery" value="<?=$rowGallerie['id']?>" />
        <div id="divdataajax"></div>
        <script type="text/javascript"><?=$onchange?></script>
        <?
    }
}
        
    

function verifica_email($em){
  //pulisco la stringa
  $em = filter_var($em, FILTER_SANITIZE_EMAIL);
  //verifico e ritorno
  $em =  filter_var($em, FILTER_VALIDATE_EMAIL);
  if($em == false){
		return false;
	}else{
		return true;
	}
}

function decodificaLingua($codiceStringaLingua)
{
    $lingua='';
    switch($codiceStringaLingua)
    {
        case 'it':
            $lingua='italiana';
            break;
        case 'en':
            $lingua='inglese';
            break;
        case 'es':
            $lingua='spagnola';
            break;
        case 'fr':
            $lingua='francese';
            break;
        case 'de':
            $lingua='tedesca';
            break;
        case 'ru':
            $lingua='russo ';
            break;
    }
    return $lingua;
}

define ('NUMERO_RECORD_PAGINA', 2);

function paginaz($nRecord, $pagina, $prefissoPagina='', $numeroRecordPerPagina )
{

    $stringa = '';
    $nPagineInMeno=1;
    $nPagineInPiu=1;
    
    //creo il numero delle pagine totali in base a quanti immobili voglio per pagina
                $nPagine = (int)($nRecord / $numeroRecordPerPagina);
                
                if ( ($nPagine*$numeroRecordPerPagina) < $nRecord)
                               $nPagine++; //quindi 12
    
    //calcolo quante pagine ci devono essere prima e dopo quella selezionata
    $min = ( ($pagina - $nPagineInMeno) >= 1  )?($pagina - $nPagineInMeno):1;
    $max = ( ($pagina+$nPagineInPiu)<=$nPagine )?$pagina+$nPagineInPiu:$nPagine;
    
    
    if (($min==1) && ($max==$nPagine))
    {
        //non dobbiamo fare assolutamente nulla!!!!
    }
    else
    {
        if ( ($min==1) && $max<$nPagine)
        {
            $max = $min + $nPagineInMeno + $nPagineInPiu;
            $max=($max>$nPagine)?$nPagine:$max;
        }   
        
        if ( ($min>=1) && $max==$nPagine)
        {
            $min = $max - $nPagineInMeno - $nPagineInPiu;
            $min=($min<1)?1:$min;
        }   
         
    }  
    
    ?>
    
    <?
    //se non sono alla prima pagina metto il VAI ALL'INIZIO
    if ($min>1)
    {
        $url= CambiaParametroQueryString('pagina',$prefissoPagina.'1');
        //$stringa.= '<a href="'.$url.'"> pp</a> ... ';
        //$stringa.= '<a href="'.$url.'"><div class="paginazione-successivo marginleft">&laquo</div></a>';
        //$stringa.= '<a href="'.$url.'"><div class="paginazione-successivo marginleft">&laquo</div></a>';
        $stringa.= '<a href="'.$url.'" class="m-left"><span class="fa fa-angle-left"></span></a>';
    }
    
    
    //ciclo per creazione apgine comprese tra $min e $max
    for ($i=$min;$i<=$max;$i++)
    {
        if ($i==($pagina))
            //$stringa.= '<div class="paginazione-indica">'.$i.'</div> ';
            $stringa.= '<span class="m-active"><a href="#">'.$i.'</a></span>';
        else
        {
            $url= CambiaParametroQueryString('pagina',$prefissoPagina.$i);
            //$stringa.= '<a href="'.$url.'">'.$i.'</a> ';
            //$stringa.= '<a href="'.$url.'"><div class="paginazione-successivo">'.$i.'</div></a>';
            $stringa.= '<span><a href="'.$url.'">'.$i.'</a></span>';
            
        }
    }

    //se non sono all'ultima pagina metto il VAI ALLA FINE
    if ($max<$nPagine)
    {
        $url= CambiaParametroQueryString('pagina',$prefissoPagina.$nPagine);
        
        //$stringa.= ' ... <a href="'.$url.'">dd</a> ';
        //$stringa.= '<a href="'.$url.'"><div class="paginazione-successivo">&raquo</div></a>';
        $stringa.= '<a href="'.$url.'" class="m-right"><span class="fa fa-angle-right"></span></a>';    
    }
    
    if ($nPagine >1)
        return '<div class="b-items__pagination-main">'.$stringa.'</div>';
    else
        return '';
}


function paginazione($nRecord, $pagina, $prefissoPagina='', $numeroRecordPerPagina )
{

    $stringa = '';
    $nPagineInMeno=1000;
    $nPagineInPiu=1000;
    
    //creo il numero delle pagine totali in base a quanti immobili voglio per pagina
                $nPagine = (int)($nRecord / $numeroRecordPerPagina);
               
                
                if ( ($nPagine*$numeroRecordPerPagina) < $nRecord)
                               $nPagine++; //quindi 12
    
    //calcolo quante pagine ci devono essere prima e dopo quella selezionata
    $min = ( ($pagina - $nPagineInMeno) >= 1  )?($pagina - $nPagineInMeno):1;
    $max = ( ($pagina+$nPagineInPiu)<=$nPagine )?$pagina+$nPagineInPiu:$nPagine;
    
    
    if (($min==1) && ($max==$nPagine))
    {
        //non dobbiamo fare assolutamente nulla!!!!
    }
    else
    {
        if ( ($min==1) && $max<$nPagine)
        {
            $max = $min + $nPagineInMeno + $nPagineInPiu;
            $max=($max>$nPagine)?$nPagine:$max;
        }   
        
        if ( ($min>=1) && $max==$nPagine)
        {
            $min = $max - $nPagineInMeno - $nPagineInPiu;
            $min=($min<1)?1:$min;
        }   
         
    }  
    
    ?>
    
    <?
    //se non sono alla prima pagina metto il VAI ALL'INIZIO
   /* if ($min>1)
    {
        $url= CambiaParametroQueryString('pagina',$prefissoPagina.'1');
        //$stringa.= '<a href="'.$url.'"> pp</a> ... ';
        //$stringa.= '<a href="'.$url.'"><div class="paginazione-successivo marginleft">&laquo</div></a>';
        //$stringa.= '<a href="'.$url.'"><div class="paginazione-successivo marginleft">&laquo</div></a>';
        $stringa.= '<a href="'.$url.'" class="m-left"></a><br />';
    }*/
    
    
    //ciclo per creazione apgine comprese tra $min e $max
    for ($i=$min;$i<=$max;$i++)
    {
        if ($i==($pagina+1))
            //$stringa.= '<div class="paginazione-indica">'.$i.'</div> ';
            $stringa.= '<li class="next"><a href="#">'.$i.'</a></li>';
        else
        {
            $url= CambiaParametroQueryString('pagina',$prefissoPagina.$i);
            //$stringa.= '<a href="'.$url.'">'.$i.'</a> ';
            //$stringa.= '<a href="'.$url.'"><div class="paginazione-successivo">'.$i.'</div></a>';
            $stringa.= '<li class=""><a href="'.$url.'">'.$i.'</a></li />';
            
        }
    }

    //se non sono all'ultima pagina metto il VAI ALLA FINE
   /* if ($max<$nPagine)
    {
        $url= CambiaParametroQueryString('pagina',$prefissoPagina.$nPagine);
        //$stringa.= ' ... <a href="'.$url.'">dd</a> ';
        //$stringa.= '<a href="'.$url.'"><div class="paginazione-successivo">&raquo</div></a>';
        $stringa.= '<a href="'.$url.'" class=""></a>';    
    }*/
    
    if ($nPagine >1)
        return '<ul id="pagination">'.$stringa.'</ul>';
    else
        return 'aaaa';
}
?>
