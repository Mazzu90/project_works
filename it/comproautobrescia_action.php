<?
include('include_dir.php');
include($percorsoLingua.'include/include.php');
require($percorso.'include/class.phpmailer2.php');
require($percorso.'include/class.smtp.php');

$grafica=new Tgrafica(false,false);
$grafica->titolo=costantiP::TITOLO_GENERALE;
$grafica->codicePagina=costantiP::CP_CONTATTI;

$campo='marca';
$dati[$campo]=isset($_POST[$campo])?$_POST[$campo]:'';
$campo='nome';
$dati[$campo]=isset($_POST[$campo])?$_POST[$campo]:'';
$campo='email';
$dati[$campo]=isset($_POST[$campo])?$_POST[$campo]:'';
$campo='phone';
$dati[$campo]=isset($_POST[$campo])?$_POST[$campo]:'';
$campo='nota';
$dati[$campo]=isset($_POST[$campo])?$_POST[$campo]:'';
$campo='difetti';
$dati[$campo]=isset($_POST[$campo])?$_POST[$campo]:'';
$campo='immaginiCliente';
$dati[$campo]=isset($_POST[$campo])?$_POST[$campo]:'';
$campo='tagliandi';
$dati[$campo]=isset($_POST[$campo])?$_POST[$campo]:'';


//$grafica->paint();
$carImages = array();
$carImages = get_car_iamges($dati['immaginiCliente']);

  
unset($grafica);



  
				$lMessaggioOk=true;
			
				if (checkMail($dati['email']))
						{
							$lMessaggioOk=true;
						}
				 else
						{
							$lMessaggioOk=false;
						}
				 
				if  ( (trim($dati['nome'])=='') || (trim($dati['email'])=='') )
						{
							$lMessaggioOk==false;
						}
				
				
				if ($lMessaggioOk)
							MessaggioOk();
					else
							MessaggioNotOk();



function MessaggioNotOk()
{global $dati, $carImages;
?>	

    <h3>Messaggio non inviato!</h3>
    Al fine di completare la procedura di invio del messaggio è necessario compilare correttamente tutti i campi del modulo.
    
    

<?
}

function MessaggioOk()
{global $dati, $carImages;
    
    $pretesto  = '============ DETTAGLI CLIENTE ============'.chr(10);
    $pretesto .= 'Mittente: '.$dati['nome'].chr(10);
    $pretesto .= 'Email: '.$dati['email'].chr(10);
    $pretesto .= 'Telefono: '.$dati['phone'].chr(10);
    $pretesto .= '==========================='.chr(10);
   
    $messaggio = '============ DETTAGLI AUTO ============'.chr(10);
    $messaggio .= 'Modello auto: '.$dati['marca'].chr(10);
    $messaggio .= 'Tagliandi: '.$dati['tagliandi'].chr(10);
    $messaggio .= 'Nota: '.$dati['nota'].chr(10);
    $messaggio .= 'Difetti/Pregi: '.$dati['difetti'].''.chr(10);
    $messaggio .= '======================================'.chr(10);
    
    $stringacar = '';
    foreach ($carImages as $car)
    {
        $stringacar .= $car.chr(10);
    }
    
    $immaginiAllegate  = '============ IMMAGINI ============'.chr(10);
    $immaginiAllegate .= $stringacar;
    $immaginiAllegate .= '=================================='.chr(10).chr(10);
    
    $messaggioEmail = $pretesto.chr(10).chr(10).$messaggio.chr(10).$immaginiAllegate.chr(10);

    $mittente = $dati['email'];

    $mail = new PHPMailer();
    foreach ($carImages as $car)
    {
        $mail->addAttachment($car);
    }
    
    //COMMENTO LE 2 RIGHE PER FAR FUNZIONARE MODULO SU ARUBA
    $mail->IsSMTP();             	// set mailer to use SMTP
    $mail->Host = costanti::SMTP_HOST;  	// specify main and backup server
    $mail->SMTPAuth = true;     	// turn on SMTP authentication
    $mail->Username = costanti::SMTP_USER;  	// SMTP username
    $mail->Password = costanti::SMTP_PWD; 	// SMTP password

    $mail->From = $mittente;
    $mail->FromName = "Richiesta dal modulo compriamo la tua auto";
    $mail->AddAddress(costantiP::EMAIL, costantiP::EMAIL);
    //$mail->AddAddress('albini@clickitsolutions.it', 'albini@clickitsolutions.it');
    $mail->AddBCC('albini@clickitsolutions.it', 'albini@clickitsolutions.it');
    $mail->AddReplyTo($mittente, $mittente);

    $mail->WordWrap = 80;                                 // set word wrap to 50 characters
    $mail->IsHTML(false);                                  // set email format to HTML
    $mail->Subject = "Richiesta dal modulo compriamo la tua auto";
    $mail->Body    = $messaggioEmail;
    if($mail->Send())
    {
        ?>
        <div class="text">
            <h3>La tua richiesta è stata inviata correttamete.</h3>
            
            Mittente: <b><i><?=htmlspecialchars($dati['email'])?> <?=htmlspecialchars($dati['nome'])?></i></b>
            <br />
            E-mail: <b><i><?=htmlspecialchars($dati['email'])?></i></b>
            <br clear="all"/><br />
            
            </p>
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

function checkMail($toCheck){
    $find = "/^[a-zA-Z0-9-_.]+@[a-zA-Z0-9-_.]+.[a-zA-Z]{2,4}$/";
    if(!preg_match($find, trim($toCheck))){
        return false;
    }else{
        return true;
    }
}


function get_car_iamges($immaginiCliente) {
    $files = glob("uploads/".$immaginiCliente."_*.*");
    return $files;
}
?>