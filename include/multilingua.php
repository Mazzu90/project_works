<?
//In questo modo itero il file delle traduzioni cercando il testo tradotto passato, altrimenti stampo la parola passata
//echo traduci('benvenuti',)

//In questo modo chiedo di stampare la costante specifica definita nel file delle traduzioni
//echo traduci('','DESCRIZIONE_AZIENDA')

function traduci($contenuto,$nomeContenuto='')
{
    global $lingua, $traduzioni, $traduzioniCostanti;
    
    //iumposto la lingua in uso
    $lingua = costantiP::LINGUA;
    
    if (costantiP::LINGUA==costanti::LINGUA_MADRE)
    {
        $fileTraduzioni=decodificaLinguaTraduzione($lingua);
        require_once('../lingue/'.$fileTraduzioni);
        $risultato = '';
        
            if ($nomeContenuto!='')
            {
                //costante
                //$testoTradotto =  
                   foreach($traduzioniCostanti as $traduzione)
                    if ($traduzione[0]==$nomeContenuto)
                        $risultato=$traduzione[1];
                   
            }
            else
            {
                
                $risultato = $contenuto;
                
            }
        
    }
    else
    {
        $fileTraduzioni=decodificaLinguaTraduzione($lingua);
        require_once('../lingue/'.$fileTraduzioni);
        $risultato = '';
        
            if ($nomeContenuto!='')
            {
                //costante
                //$testoTradotto =  
                   foreach($traduzioniCostanti as $traduzione)
                    if ($traduzione[0]==$nomeContenuto)
                        $risultato=$traduzione[1];
                   
            }
            else
            {
                //testo
                   //in_array
                   foreach($traduzioni as $traduzione)
                    if ($traduzione[0]==$contenuto)
                        $risultato=$traduzione[1];
                
            }
    }
    
    
    
    return ($risultato!='')?$risultato:$contenuto;
}

function decodificaLinguaTraduzione($lingua)
{
    $risultato = '';
    switch($lingua)
    {
        case 'it':
        $risultato = 'italiano.php'; //mi serve per le costanti
        break;
        case 'fr':
        $risultato = 'francese.php';
        break;
        case 'en':
        $risultato = 'inglese.php';
        break;
        case 'es':
        $risultato = 'spagnolo.php';
        break;
        case 'de':
        $risultato = 'tedesco.php';
        break;

    }
    return $risultato;
}

?>