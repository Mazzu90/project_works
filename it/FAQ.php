<?

include('include_dir.php');

include($percorsoLingua.'include/include.php');



$grafica=new Tgrafica(false,false);

$grafica->titolo='Compro auto Brescia';

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
  
	<section class="b-pageHeader b-count__buy bg-light_blue pt-xxl">
		<div class="row p-none m-none">
	
			<div class="col-md-6 col-sm-9 col-xs-12">
					<img src="../images/icon-compriamo/icon-FAQ-white.svg" class="b-count__buy__img right">
			</div>
			
			<div class="b-count__buy__introduction col-md-6 col-sm-9 col-xs-12">
				<h1 class="mb-none">PAURA DELLE FREGATURE ?<br>
				CON LE NOSTRE FAQ<br>
				PUOI AVERE ANCORA PIÙ CERTEZZE.</h1>
				<h3 class="mt-sm">TUTTE LE RISPOSTE<br>
				ALLE TUE DOMANDE PIÙ FREQUENTI</h3>
			</div>
			
		</div>
	</section>
	
	<section class="b-contacts pb-none">
        <div class="container">
            <div class="row">
				<div class="col-md-12 faq">
					
					<a href="javascript:history.back()" target="_blank" class="btn m-btn back">
						<i class="icon-arrow-left icon icon-2x"></i>
						TORNA INDIETRO
					</a>
					
					<h2>È AUTOUNICA CHE COMPRA LA TUA AUTO? Sì!<br>
						LEGGI TUTTE LE DOMANDE E RISPOSTE PIÙ FREQUENTI.</h2>
					
					<h3 class="pb-none mb-xs">1 - Devo pagare una commissione anche se decido di non vendervi l’auto?</h3>
                	<h4 class="mt-none">No! Il servizio di valutazione della tua auto è gratuito,
non hai nessun obbligo nei confronti di Autounica.</h4>
					<br>
					<h3 class="pb-none mb-xs">2 - Come funziona la quotazione online sul vostro sito?</h3>
                	<h4 class="mt-none">Basta inserire i dati della propria auto nei campi richiesti tramite pochi semplici passaggi.<br>
					Dopodiché, nel giro di circa 24 ore dall'invio, verrai ricontattato telefonicamente o via mail per completare la valutazione.</h4>
					<br>
					<h3 class="pb-none mb-xs">3 - In che modo posso vendere la mia auto dopo aver ricevuto la vostra valutazione?</h3>
					<h4 class="mt-none">Si fissa un appuntamento presso la nostra sede, puoi <a style="text-decoration: underline;" href="<?echo costantiP::BASE_URL.costantip::LINGUA?>/contatti.php">chiamare o scrivere</a>. Lo Staff Commerciale di Autounica è a tua disposizione dal lunedì al sabato.</h4>
					<br>
					<h3 class="pb-none mb-xs">4 - Esiste un limite massimo di kilometri per vendervi la mia auto?</h3>
					<h4 class="mt-none">No, non ci sono limiti di kilometri.</h4>
					<br>
					<h3 class="pb-none mb-xs">5 - Esiste un limite di età dell'auto per vendere ad Autounica?</h3>
					<h4 class="mt-none">No, non ci sono limiti di età.</h4>
					<br>
					<h3 class="pb-none mb-xs">6 - Se la mia auto è fortemente danneggiata la comprate comunque?</h3>
					<h4 class="mt-none">No, non compriamo auto incidentate o fortemente danneggiate.</h4>
					<br>
					<h3 class="pb-none mb-xs">7 - Se la mia auto è targata nella Comunità Europea o altri Stati la potete comprare?</h3>
					<h4 class="mt-none">No, non compriamo auto che non siano targate Italia.</h4>
					<br>
					<h3 class="pb-none mb-xs">8 - Come devo fotografare la mia auto al meglio per pemettervi una corretta valutazione?</h3>
					<h4 class="mt-none">E' semplice,  ti consigliamo di fare le fotografie durante il giorno per avere una buona luce, e se possibile di posizionare la tua auto su sfondo neutro (per esempio con un muro chiaro alle sue spalle). Prima di tutto fotografa tutti e quattro i lati dell’auto (anteriore / posteriore / lato destro / lato sinistro), poi gli interni (sedili, cruscotto, zona cambio, etc...) ed infine eventuali difetti estetici dati da usura del tempo (per esempio un pomolo del cambio usurato o un graffio su una portiera).</h4>
					<br>
					<h3 class="pb-none mb-xs">9 - Come avviene il pagamento immediato?</h3>
					<h4 class="mt-none">In Autounica il pagamento è immediato ed avviene tramite bonifico bancario o assegno circolare intestato sempre all'intestatario dell'autovettura.</h4>
					<br>
					<h3 class="pb-none mb-xs">10 - È possibile vendere anche la mia moto?</h3>
					<h4 class="mt-none">Si è possibile (le regole di compra/vendita sono le stesse dell’auto)</h4>
					<br>
					<h3 class="pb-none mb-xs">11 - Come avviene il passaggio di proprietà?</h3>
					<h4 class="mt-none">Andremo insieme nella nostra agenzia di pratiche auto (accanto alla nostra sede Autounica in via Valcamonica 19/H Brescia), è necessaria la presenza dell’intestatario dell’auto/moto (la persona il cui nome è riportato sul libretto del mezzo in vendita), per compilare tutti i moduli e concludere seduta stante l’atto di vendita.</h4>
					<br>
					<h3 class="pb-none mb-xs">12 - Chi paga il passaggio di proprietà?</h3>
					<h4 class="mt-none">Il passaggio di proprietà di un’auto venduta ad Autounica è sempre a carico di Autounica.</h4>
					<br>
					<h3 class="pb-none mb-xs">13 - Quanto tempo serve per espletare tutte le pratiche per effettuare la vendita?</h3>
					<h4 class="mt-none">Solitamente bastano 15 minuti circa dall’arrivo in salone.</h4>
					<br>
					<h3 class="pb-none mb-xs">14 - Posso venire quando voglio per vendere la mia auto/moto?</h3>
					<h4 class="mt-none">Abbiamo orari/giorni di apertura al pubblico, lo puoi vedere nella sezione Contatti, ti consigliamo però per accelerare le pratiche e non avere intoppi, di chiamare o scrivere una mail per fissare un appuntamento in sede.</h4>
					<br>
					<h3 class="pb-none mb-xs">15 - Che documenti sono necessari per vendere la mia auto/moto?</h3>
					<h4 class="mt-none">Per vendere la tua auto/moto devi avere con te:
					- Carta d’identità<br>
					- Codice Fiscale (eventuale permesso di soggiorno) dell’intestatario/i della macchina/moto<br>
					- libretto di circolazione originale<br>
					- certificato di proprietà in originale oppure la ricevuta telematica<br>
					- chiavi e doppie chiavi<br>
					- ricevuta di pagamento dell'ultimo bollo</h4>
					<br>
					<h3 class="pb-none mb-xs">16 - L’auto/moto è intestata ad una azienda (es. Srl, Snc, Sas, etc…)</h3>
					<h4 class="mt-none">Per poterla vendere oltre a tutti i documenti (come elencati nel punto 15) devi presentare:<br>
					- visura camerale aggiornata (valida se emessa entro i 6 mesi)<br>
					- Carta d’identità del legale rappresentate dell’azienda<br>
					- Fattura di vendita dell’importo pattuito intestata a: Auto Unica Srl - via Valcamonica 19/H - 25132 Brescia - P.Iva 03697460982</h4>
					<br>
					<h3 class="pb-none mb-xs">17. L’auto/moto è intestata ad un Leasing che sto ancora pagando.</h3>
					<h4 class="mt-none">Per poterla vendere, dovrai farti mandare dalla Società di Leasing il conteggio di estinzione anticipata aggiornato, poi noi provvederemo a pagare il Leasing ed eventualmente la differenza che ti spetta rispetto al valore dell’auto. (Esempio: valore auto € 22.000, riscatto Leasing € 20.000, pagheremo € 20.000 al Leasing ed € 2.000 alla persona o azienda locatario…)</h4>
					<br>
					<h3 class="pb-none mb-xs"><span>18 - L’auto/moto è intestata ad una persona deceduta, cosa faccio?</h3>
					<h4 class="mt-none">Chiamaci o scrivici, ti mettiamo in contatto diretto con gli esperti della nostra agenzia di pratiche auto per risolvere il tuo caso.</h4>
					<br>
					<h3 class="pb-none mb-xs">19 - La mia auto/moto è cointestata a più persone, come mi devo comportare?</h3>
					<h4 class="mt-none">Tutte le persone proprietarie dell’auto/moto (cointestatari) con i rispettivi documenti di identità, devono recarsi a firmare nell’agenzia di pratiche auto per poter effettuare il passaggio (non si possono fare deleghe).</h4>
					<br>
					<h3 class="pb-none mb-xs">20 - Ho perso il certificato di proprietà (oppure ce l’ho ma è illeggibile) cosa faccio?</h3>
					<h4 class="mt-none">Possiamo richiedere un duplicato alla nostra agenzia di pratiche auto, il costo del duplicato (solitamente pari ad € 40 ) è a carico del proprietario dell’auto/moto. Ricordati che se l’hai perso, devi prima fare la denuncia di smarrimento alle forze dell’ordine</h4>
					<br>
					<h3 class="pb-none mb-xs">21 - Come farò a disdire l’assicurazione della mia vecchia auto/moto una volta venduta?</h3>
					<h4 class="mt-none">L’agenzia di pratiche auto rilascia a passaggio avvenuto, l’atto di vendita. Questo documento va consegnato al proprio assicuratore per effettuare l’annullamento della polizza in corso.</h4>
					<br>
					<h3 class="pb-none mb-xs">22 - Posso ricevere il pagamento in anticipo senza aver consegnato l’auto/moto ad Autounica?</h3>
					<h4 class="mt-none">No, il pagamento avviene contestualmente alla consegna della macchina ad Autounica, subito dopo aver firmato il passaggio a favore di Autounica.</h4>
					<br>
					<h3 class="pb-none mb-xs">23 - Se l’auto/moto dovesse avere un fermo amministrativo posso venderla ad Autounica?</h3>
					<h4 class="mt-none">Devi pagare prima il fermo amministravo, e solo successivamente puoi venderla. Venderla con il fermo amministrativo in corso non è possibile.</h4>
					
					<br>
					
					<h2>VUOI ACQUISTARE UN’AUTO USATA IN AUTOUNICA? Sì!<br>
						LEGGI TUTTE LE DOMANDE E RISPOSTE PIÙ FREQUENTI.</h2>


					<h3 class="pb-none mb-xs">1 - Tutti possono comprare un’Auto da Autounica?</h3>
					<h4 class="mt-none">Si chiunque può acquistare una macchina da Autounica, l’unico requisito fondamentale è aver compiuto 18 anni.</h4>
					<br>
					<h3 class="pb-none mb-xs">2 - Dove posso vedere fisicamente le Auto che sono pubblicate sul sito?</h3>
					<h4 class="mt-none">Tutte le Auto presenti sul sito sono visibili fisicamente presso la nostra grande sede in via Valcamonica 19/H - 25132 Brescia.</h4>
					<br>
					<h3 class="pb-none mb-xs">3 - Posso vedere le Auto dal vivo solo a Brescia o avete altre sedi?</h3>
					<h4 class="mt-none">L’unica grande sede è in via Valcamonica 19/H - 25132 Brescia.</h4>
					<br>
					<h3 class="pb-none mb-xs">4 - Tutte le Auto che vedo pubblicate sul sito sono realmente disponibili?</h3>
					<h4 class="mt-none">Si, tutte le Auto che vedi sul sito sono disponibili in tempo reale per la vendita ad eccezione solo di quelle che riportano l’apposito tag “venduta”.</h4>
					<br>
					<h3 class="pb-none mb-xs">5 - Le Auto in vendita sono in Pronta Consegna?</h3>
					<h4 class="mt-none">Sì, tutte le Auto in vendita sono sempre in Pronta Consegna. Bastano davvero poche ore per acquistare la tua nuova Auto usata.</h4>
					<br>
					<h3 class="pb-none mb-xs">6 - È possibile provare le Auto esposte/in vendita?</h3>
					<h4 class="mt-none">Sì, il nostro Staff è sempre disponibile per accompagnarti in una prova su strada. Chiamaci per fissare il tuo Test Drive.</h4>
					<br>
					<h3 class="pb-none mb-xs">7 - Chi è il venditore/proprietario delle Auto che vedo sul sito di Autounica?</h3>
					<h4 class="mt-none">Tutte le Auto sono di proprietà esclusiva di Auto Unica Srl.</h4>
					<br>
					<h3 class="pb-none mb-xs">8 - Posso avere la fattura del mio acquisto?</h3>
					<h4 class="mt-none">Tutte le Auto vengono sempre fatturate al nuovo proprietario, essendo Auto usate possono essere fatturate in due modi, a regime del margine (senza Iva) oppure con Iva esposta (aliquota del 22% compresa nel prezzo di vendita).</h4>
					<br>
					<h3 class="pb-none mb-xs">9 - È possibile permutare la mia vecchia Auto per comprarne una nuova?</h3>
					<h4 class="mt-none">Sì certo, valutiamo il tuo usato tramite il modulo nella sezione Compriamo la tua Auto, oppure se preferisci dal vivo presso la nostra sede contattandoci per fissare un appuntamento. Il valore del tuo usato viene poi scontato da quello dell’Auto alla quale sei interessato.</h4>
					<br>
					<h3 class="pb-none mb-xs">10 - In che modo posso pagare l’Auto che voglio acquistare?</h3>
					<h4 class="mt-none">In Autounica hai tante opzioni per pagare la tua nuova Auto usata:<br>
					- Bonifico Bancario<br>
					- Assegno Circolare intestato ad Auto Unica Srl<br>
					- Finanziamento Autounica<br>
					- Contanti (fino al limite di legge)</h4>
					<br>
					<h3 class="pb-none mb-xs">11 - Quali documenti servono per la richiesta di finanziamento?</h3>
					<h4 class="mt-none">- Carta d’identità<br>
					- Tessera sanitaria<br>
					- Eventuale permesso di soggiorno per Extra UE)<br>
					- Ultime 3 buste paga (per i lavoratori dipendenti)<br>
					- Modello Unico e Visura Camerale (per i lavoratori autonomi)<br>
					- Codice IBAN sulla quale verrà appoggiato il RID Bancario</h4>
					<br>
					<h3 class="pb-none mb-xs">12 - In quanto tempo arriva l’esito della pratica di finanziamento?</h3>
					<h4 class="mt-none">Solitamente l’esito del finanziamento richiesto arriva entro le 24 ore successive all’invio di tutti i documenti necessari.</h4>
					<br>
					<h3 class="pb-none mb-xs">13 - Posso richiedere un finanziamento senza venire fisicamente in sede Autounica?</h3>
					<h4 class="mt-none">No, per richiedere un finanziamento bisogna firmare dei moduli per la Privacy fisicamente presso i nostri uffici. Il nostro personale procederà con l’identificazione della persona e successivamente con l’inoltro della pratica alla finanziaria.</h4>
					<br>
					<h3 class="pb-none mb-xs">14 - Quanto costa il passaggio di proprietà?</h3>
					<h4 class="mt-none">Il costo del passaggio di proprietà non è fisso, ma varia in base ai KW di potenza dell’Auto e dalla provincia di residenza del nuovo proprietario.</h4>
					<br>
					<h3 class="pb-none mb-xs">15 - Il prezzo del passaggio di proprietà della mia vecchia Auto che darò in permuta chi lo pagherà?</h3>
					<h4 class="mt-none">Il mini passaggio (legge Dini) è sempre a carico di Autounica.</h4>
					<br>
					<h3 class="pb-none mb-xs">16 - Il passaggio di proprietà a mio favore viene effettuato quando?</h3>
					<h4 class="mt-none">Ricevuto il saldo dell’Auto che hai acquistato, attiviamo subito il passaggio di proprietà (che solitamente completiamo in poche ore).</h4>
					<br>
					<h3 class="pb-none mb-xs">17 - Quali documenti sono necessari per effettuare il passaggio di proprietà?</h3>
					<h4 class="mt-none">Per poter effettuare il passaggio di proprietà devi avere con te:<br>
					- Carta d’identità<br>
					- Codice Fiscale (eventuale permesso di soggiorno per Extra UE)</h4>
					<br>
					<h3 class="pb-none mb-xs">18 - Posso cointestare l’Auto a più persone?</h3>
					<h4 class="mt-none">Sì, in questo caso servono i documenti (vedi punto 14) di tutte le persone a cui vuoi intestare l’Auto.</h4>
					<br>
					<h3 class="pb-none mb-xs">19 - Nel prezzo di vendita è compreso il passaggio di proprietà?</h3>
					<h4 class="mt-none">No, i prezzi esposti non comprendono mai il costo del passaggio di proprietà che è sempre a carico del nuovo proprietario.</h4>
					<br>
					<h3 class="pb-none mb-xs">20 - Nel prezzo di vendita è compresa la Garanzia?</h3>
					<h4 class="mt-none">Sì, nel prezzo di vendita delle Auto è compresa la Garanzia di Conformità per 12 mesi. Se vuoi, puoi estendere la Garanzia fino a 36 mesi (kilometraggio illimitato e copertura dei danni al 100%, manodopera e Auto sostitutiva compresa).</h4>
					<br>
					<h3 class="pb-none mb-xs">21 - Posso prenotare l’Auto ancor prima di averla vista dal vivo, per non rischiare di perdere l’occasione?</h3>
					<h4 class="mt-none">Sì, contattaci subito, il nostro Staff ti guiderà per effettuare un bonifico di acconto per riservarti la tua Auto ed assicurarti l’occasione.</h4>
					<br>
					<h3 class="pb-none mb-xs">22 - Quanto tempo ci vuole per la consegna della mia nuova Auto usata?</h3>
					<h4 class="mt-none">Solitamente bastano 15 minuti circa dall’arrivo in salone.</h4>
					
					<br>

					<h2>AUTOSERVICE, L’OFFICINA DI AUTOUNICA PER L’ASSISTENZA DELLA TUA AUTO.<br>
						LEGGI TUTTE LE DOMANDE E RISPOSTE PIÙ FREQUENTI.</h2>


					<h3 class="pb-none mb-xs">1 - Posso finanziare gli interventi che deve effettuare la mia Auto in Autoservice?</h3>
					<h4 class="mt-none">Sì, è possibile finanziare l’importo fino ad un massimo di € 3.000 in 36 rate.</h4>
					<br>
					<h3 class="pb-none mb-xs">2 - In quanto tempo la finanziaria comunica l’esito del finanziamento?</h3>
					<h4 class="mt-none">Nella maggior parte dei casi, grazie al dialogo digitale diretto con la nostra finanziaria, riusciamo a dare l’esito in tempo reale, è comunque certo che in qualsiasi casistica possiamo garantire un esito entro le 24 ore dalla domanda.</h4>
					<br>
					<h3 class="pb-none mb-xs">3 - Abito lontano dalla vostra sede, posso aspettare presso la vostra officina Autoservice durante lo svolgimento del tagliando/cambio gomme/etc…?</h3>
					<h4 class="mt-none">Sì, abbiamo una sala d’attesa climatizzata dove puoi comodamente aspettare l’esecuzione del tagliando.
					In sala d’attesa trovi sempre una rassegna stampa, snack e bevande calde, accesso Wi-fi gratuito, prese d’alimentazione per i tuoi device.
					È fondamentale in questo caso contattarci almeno 1 giorno prima per organizzare la messa in opera del tuo tagliando e ridurre al massimo i tempi d’attesa.</h4>
					<br>
					<h3 class="pb-none mb-xs">4 - Posso usufruire di una auto sostitutiva?</h3>
					<h4 class="mt-none">Sì abbiamo 5 Auto sostitutive sono ad uso gratuito per i clienti Autounica che hanno stipulato la garanzia estesa. Se non ha questa garanzia, non preoccuparti, puoi comunque avere la tua Auto sostituiva pagando solo 20 euro+iva al giorno.</h4>
					<br>
					<h3 class="pb-none mb-xs">5 - Noleggiate le Auto sostitutive anche a chi non si serve presso Autoservice?</h3>
					<h4 class="mt-none">No, le Auto sostitutive sono a disposizione esclusivamente dei clienti Autoservice.</h4>
					<br>
					<h3 class="pb-none mb-xs">6 - Posso contare su Autoservice anche per eventuali problemi meccanici oltre che per la semplice manutenzione/tagliandistica?</h3>
					<h4 class="mt-none">Sì, la nostra officina Autoservice è specializzata nella risoluzione di qualsiasi problema meccanico ed elettronico di auto e moto; abbiamo a disposizione tutta la strumentazione necessaria e l’esperienza professionale per garantire la risoluzione di ogni problema.</h4>
					<br>
					<h3 class="pb-none mb-xs">7 - Fate anche le revisioni ministeriali periodiche obbligatorie?</h3>
					<h4 class="mt-none">No, le revisioni ministeriali devono essere effettuate presso Centri di Revisione autorizzati; Autoservice garantisce questo servizio attraverso il Centro di Revisione Partner situato a pochi metri dalla nostra sede.</h4>
					
				</div>
				
				
				
        	</div>
        </div>
    </section>

	<section class="b-featured preFooter">
		<div class="container">
			<div class="col-xs-12">
				<h2 class="title">PERCHè SCEGLIERE AUTOUNICA</h2>
			</div>
		</div>	
	</section>

	<? preFooter() ?>


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

        

function scriptFooterAggiuntivi()
{
    ?>
   	

    <?
    
}       
?>