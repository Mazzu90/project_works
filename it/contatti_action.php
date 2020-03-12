<?
include('include_dir.php');
include($percorsoLingua.'include/include.php');
require($percorso.'include/class.phpmailer.php');
require($percorso.'include/class.smtp.php');

$grafica=new Tgrafica(false,false);
$grafica->titolo=costantiP::TITOLO_GENERALE;
$grafica->codicePagina=costantiP::CP_CONTATTI;

isset($_POST['nome'])?$nome=$_POST['nome']:$nome='';
isset($_POST['email'])?$email=$_POST['email']:$email='';
isset($_POST['telefono'])?$telefono=$_POST['telefono']:$telefono='';
isset($_POST['mobile'])?$mobile=$_POST['mobile']:$mobile='';
isset($_POST['modello'])?$oggetto=$_POST['modello']:$oggetto='Richiesta informazioni';
isset($_POST['messaggio'])?$messaggio=$_POST['messaggio']:$messaggio='';


//$grafica->paint();

        
unset($grafica);


/*function corpo_pagina()
{*/
    global $nome, $mobile, $cognome, $email, $telefono, $oggetto, $messaggio, $tipoVeicolo, $nGiorni, $weekend, $km;

    ?>
	
    	<p>
			<?
				$lMessaggioOk=true;
			
				if (checkMail($email))
						{
							$lMessaggioOk=true;
						}
				 else
						{
							$lMessaggioOk=false;
						}
				 
				if  ( (trim($nome)=='') || (trim($email)=='') || (trim($messaggio)=='') )
						{
							$lMessaggioOk==false;
						}
				
				
				if ($lMessaggioOk)
							MessaggioOk();
					else
							MessaggioNotOk();
			?>
		</p>
    
	<?
//}

function MessaggioNotOk()
{global $nome, $cognome, $email, $telefono, $oggetto, $messaggio;
?>	

    <h3>Messaggio non inviato!</h3>
    Al fine di completare la procedura di invio del messaggio è necessario compilare correttamente tutti i campi del modulo.
    <br clear="all" /><br />
    <?echo $nome.' '.$cognome.' '.$email.' '. $telefono.' '. $oggetto.' '.$messaggio;?>

<?
}

function MessaggioOk()
{
    global $nome, $mobile, $cognome, $email, $telefono, $oggetto, $messaggio, $tipoVeicolo, $nGiorni, $weekend, $km;
    
    $pretesto = '==========================='.chr(10);
    $pretesto .= 'Mittente: '.$nome.chr(10);
    $pretesto .= 'Email: '.$email.chr(10);
    $pretesto .= 'Telefono: '.$telefono.chr(10);
    $pretesto .= '==========================='.chr(10).chr(10);
   

    $messaggioEmail = $pretesto.$oggetto.chr(10).chr(10).$messaggio.chr(10).chr(10);

    $mittente = $email;

    $mail = new PHPMailer();
    //COMMENTO LE 2 RIGHE PER FAR FUNZIONARE MODULO SU ARUBA
    //$mail->IsSMTP();             	// set mailer to use SMTP
    //$mail->Host = costanti::SMTP_HOST;  	// specify main and backup server
    $mail->SMTPAuth = true;     	// turn on SMTP authentication
    $mail->Username = costanti::SMTP_USER;  	// SMTP username
    $mail->Password = costanti::SMTP_PWD; 	// SMTP password

    $mail->From = $mittente;
    $mail->FromName = "Richiesta dal modulo contatti AUTOUNICA";
    $mail->AddAddress(costantiP::EMAIL, costantiP::EMAIL);
    //$mail->AddAddress('albini@clickitsolutions.it', 'albini@clickitsolutions.it');
    $mail->AddReplyTo($mittente, $mittente);

    $mail->WordWrap = 80;                                 // set word wrap to 50 characters
    $mail->IsHTML(false);                                  // set email format to HTML
    $mail->Subject = $oggetto;
    $mail->Body    = $messaggioEmail;
    if($mail->Send())
    {
        ?>
        <div class="text">
            <h3>La tua richiesta è stata inviata correttamete.</h3>
            
            Mittente: <b><i><?=htmlspecialchars($nome)?> <?=htmlspecialchars($cognome)?></i></b>
            <br />
            E-mail: <b><i><?=htmlspecialchars($email)?></i></b>
            <br />
            Messaggio: <b><i><?=  str_replace(chr(10), '<br />', htmlspecialchars($messaggio)) ?></i></b>
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
?>