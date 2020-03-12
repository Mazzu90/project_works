<?
include('include_dir.php');
include($percorsoLingua.'include/include.php');

$grafica=new Tgrafica(false,false);
$grafica->titolo='';
$grafica->keywords='';
$grafica->description='';
$grafica->codicePagina=costantiP::CP_NESSUNO;
$grafica->codiceBody='page1';

$pagina = isset($_GET['pagina'])?$_GET['pagina']:1;

$grafica->paint();
unset($grafica);

function corpo_pagina()
{
    ?>

	<section class="b-privacy">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
					<h1>PRIVACY POLICY</h1>
					
                    <h2 class="s-title">Informativa (ai sensi del D. lgs. N. 196 del 30 Giugno 2003)</h2>
                    <p class="justify"> l Sistema www.autounica.com prevede l'inserimento da parte del Cliente di alcuni dati personali, utilizzati da AutoUnica ai fini della gestione gestione operativa dei servizi e di informazioni commerciali ai clienti.
					Il titolare del trattamento è AutoUnica .
					<br /><br />
					Responsabili del trattamento dei dati personali sono i funzionari e i soggetti elencati nel prospetto disponibile presso gli uffici di AutoUnica, in relazione al rispettivo settore di competenza.
					<br /><br />
					Informiamo il Cliente che i dati raccolti verranno trattati ai sensi e nel rispetto di quanto previsto dal D. lgs. 196/03 (“Codice in materia di protezione dei dati personali”) e verranno elaborati mediante strumenti (automatizzati e manuali) idonei a garantirne la sicurezza e la riservatezza. I dati raccolti verranno comunicati ai soggetti ai quali il trasferimento dei dati stessi risulti necessario, funzionale e strumentale alla gestione operativa dell'acquisto, ed ad informare i clienti delle azioni promozionali previste dell'azienda titolare del trattamento o di aziende partner. I dati raccolti non saranno oggetto di diffusione da parte di AutoUnica.
					<br /><br />
					Ai sensi dell'art. 7 del D. lgs. 196/2003 i soggetti cui si riferiscono i dati personali hanno il diritto in qualunque momento di ottenere la conferma dell'esistenza o meno dei medesimi dati, di conoscerne il contenuto e l'origine, verificarne l'esattezza o chiederne l'integrazione, l'aggiornamento o la rettificazione, chiederne la cancellazione, la trasformazione in forma anonima o il blocco dei dati trattati in violazione di legge, nonché di opporsi in ogni caso, per motivi legittimi, al loro trattamento.
					<br /><br />
					Le richieste in questione vanno rivolte al titolare del trattamento via email all'indizzo info@autounica.com, o via raccomandata a AutoUnica.</p>
                   </div>
             </div> 
        </div>
    </section>
  
  

    <?
}

function HeaderAggiuntivi()
{
    ?>
    	
       
     
    <?
    
}
        
?>