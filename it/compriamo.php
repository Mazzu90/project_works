<?
include('include_dir.php');
include($percorsoLingua.'include/include.php');

$grafica=new Tgrafica(false,false);
$grafica->titolo='compro auto brescia';
$grafica->keywords='compro auto Brescia, compro auto, compro auto usate, compro auto usate Brescia';
$grafica->description='compro auto usate a Brescia con pagamento immediato in contanti. AUTOUNICA srl via valcamonica 19/h brescia.';
$grafica->codicePagina=costantiP::CP_COMPRIAMO;
$grafica->codiceBody='page1';

$pagina = isset($_GET['pagina'])?$_GET['pagina']:1;

$grafica->paint();
unset($grafica);

function corpo_pagina()
{
    ?>
    
	<nav class="" id="headerSearchMenu"> 
    	<div class="container">
    		<div class="row">
				<h2 class="center">SELEZIONA LA TUA OCCASIONE</h2>
				<div class="col-xs-12" align="center">
					<button type="submit" class="btn m-btn search mt-none" id="nResultVetture"></button>
				</div>
			</div>
		</div>
	</nav>
  
	<section class="b-contacts s-shadow">
        <div class="container">
            <div class="row">
            
                <div class="col-md-6 col-xs-12">
                    <h2 class="s-title">Acquisto auto usate Brescia, compro con pagamento immediato</h2>
                    
                    <p>Acquistiamo auto usate a Brescia, presso la nostra sede, previa valutazione gratuita di ogni singolo mezzo proposto, delle sue condizioni generali e delle possibilità di rivendita sul mercato a seconda delle richieste del momento, che ci rivolgono i nostri clienti. </p>
                         <h2 class="s-title">Informazioni da conoscere; acquisto auto usate Brescia</h2>
                         <p> Compriamo auto usate con pagamento immediato, tramite un assegno circolare o un bonifico bancario a favore dell’intestatario dell’autovettura, unicamente dopo aver analizzato tutte le condizioni utili alla commercializzazione del mezzo proposto, chiarendo che:
                                <br />
come operatori del settore, sosteniamo le spese di ripristino del mezzo, utili a garantire una commercializzazione coperta da garanzia legale per 12 mesi, come da codice del consumo, oltre a quelle legate al passaggio di proprietà, pertanto la nostra quotazione, sarà in ogni caso inferiore a quella che vi farebbe un privato, quindi sarebbe opportuno ricevere delle richieste, SOLAMENTE quando sei consapevole del fatto che il valore che ti proporremo, potrà essere simile o più basso delle stime riportate all'interno del periodico Quattroruote per ogni singolo modello elencato nell'apposita sezione. </p>
                    <h2 class="s-title"> NON COMPRIAMO AUTO USATE CON PAGAMENTO IMMEDIATO NEI SEGUENTI CASI:</h2>
                    <p><ul>
                    <li>Auto con più di 150.000km</li>
                    <li>Auto più vecchie di 10 anni</li>
                    <li>Auto incidentate o fortemente danneggiate</li>
                    <li>Auto non attualmente targate italiane</li>
                    </ul>
                    

    
    
    
    

                    </p>                    
                </div>
            
            
                <div class="col-md-6 col-xs-12">
                    <h2 class="s-title">Contattaci</h2>
                    <p>Per qualsiasi informazione o richiesta puoi scriverci utilizzando il form qui sotto.</p>
                    <div class="b-contacts__form mt-md">
                        <div id="success"></div>
                        <form id="contactForm" novalidate class="s-form">
                            <input type="text" placeholder="NOME E COGNOME *" value="" name="user-name" id="user-name" />
                            <input type="text" placeholder="EMAIL" value="" name="user-email" id="user-email" />
                            <input type="text" placeholder="TELEFONO *" value="" name="user-phone" id="user-phone" />
                            <textarea id="user-message" name="user-message" placeholder="MESSAGGIO"></textarea>
                            
                            <div class="col-md-12 col-xs-12 p-none">
                                <div class="col-md-7 col-xs-12 p-none">
                                    <p class="mb-xs">* Campi Obbligatori</p>
                                    <input type="checkbox" name="privacy" value="privacy"/> <span class="privacy">Ho letto l'informativa sulla privacy e acconsento al trattamento dei dati.</span>
                                </div>
                                <div class="col-md-5 col-xs-12 p-none">
                                     <footer class="b-items__aside-main-footer pr-none">
                                        <button type="submit" class="btn m-btn f-right mt-sm mb-md">INVIA</button>
                                     </footer>
                                </div>
                                
                                
                                
                            </div>
                             
                        </form>
                    </div>    
                    
                </div>
              
             </div> 
        </div>
    </section>

    <?
}

function HeaderAggiuntivi()
{
    ?>
    	
        <!--Contact form--> 
		<script src="assets/contact/jqBootstrapValidation.js"></script> 
		<script src="assets/contact/contact_me.js"></script>
        
     
    <?
    
}
        
?>