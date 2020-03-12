<?
header('HTTP/1.0 403 Forbidden');
include('include_dir.php');
include($percorsoLingua.'include/include.php');

$grafica=new Tgrafica(false,false);
$grafica->titolo='Pagina 403 '.costantiP::TITOLO_GENERALE;
$grafica->codicePagina=costantiP::CP_HOMEPAGE;

$grafica->paint();
//unset ($dati);
unset($grafica);


function corpo_pagina()
{
    ?>	
        <div class="indent-left">
            <div class="wrapper" style="text-align: center; height:400px">

                <h2>OPS!! mi spiace non puoi accedere.</h2>
                <?/*<h3>posso suggerirti di ripartire da questo elenco?</h3>*/?>
               
            </div>
        </div>
    <?
}

function headerAggiuntivi()
{
    ?><?
}
?>