<?

define('NUMERI_IN_MENO',4);
define('NUMERI_IN_PIU',5);
define('NUMERO_ELEMENTI_PER_PAGINA',10);
function generaPaginazione(
                            $numeroRecord,
                            $paginaCorrente,
                            &$minimo,
                            &$massimo,
                            &$primo,
                            &$ultimo,
                            &$numeroTotalePagine
                            )
{
    
    $numeroTotalePagine = intval($numeroRecord / NUMERO_ELEMENTI_PER_PAGINA);
    if ( ($numeroTotalePagine * NUMERO_ELEMENTI_PER_PAGINA) < $numeroRecord )
        $numeroTotalePagine++;
       
 
    $minimo = $paginaCorrente - NUMERI_IN_MENO;
    $massimo = $paginaCorrente + NUMERI_IN_PIU;
    
    /*
    verifico se il minimo è sceso sotto il numero 1 ed in caso lo riporto al numero 1 
    e le pagine eliminate le aggiungo al massimo per mantenere i 10 elementi di paginazione
    */
    
    if ($minimo<1)
    {
        $minimo = 1;
        
        $totalePagineTemporaneo = $massimo - $minimo;
        $differenzaMinimo = (NUMERI_IN_MENO+NUMERI_IN_PIU)-$totalePagineTemporaneo;
        $massimo+=$differenzaMinimo;
    } 
    
    /*
    verifico che il numero massimo non sia superiore del massimo delle pagine disponibili
    */
    if ($massimo>$numeroTotalePagine)
    {
        $differenzaMassimo = $massimo - $numeroTotalePagine;
        
        $massimo = $numeroTotalePagine;
        $minimo -= $differenzaMassimo;
        
        //ricontrollo che il minimo non sia andato sotto il valore 1 ed in caso lo forzo a 1
        if ($minimo < 1)
            $minimo = 1;
    }
    
    $primo = ($minimo>1);
    $ultimo = ($massimo<$numeroTotalePagine);
        
    
}
?>