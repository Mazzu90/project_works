<?

// Tutte le funzioni che servono per la connessione al database

	$Connessione='';
	$db='';

function Connetti($redirect_if_error=true)
{
	global $Connessione,$db;
	//connessione al server
	$Connessione = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
    //mysql_query("SET CHARACTER SET 'utf8'");

	//connessione al database
	if ($Connessione)
		$db = @mysql_select_db(DB_NAME, $Connessione);
	return $db;
}

function Disconnetti()
{
	global $Connessione;
	mysql_close($Connessione);
	return true;
}
?>
