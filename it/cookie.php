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
   
	<section class="b-cookie">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <h1>UTILIZZO DEI COOKIE</h1>
                  
                    <div id="mappasito">
            	<p class="justify">La presente Privacy Policy ha lo scopo di descrivere le modalità di gestione di questo sito, in riferimento al trattamento dei dati personali degli utenti/visitatori che lo consultano.
                    L’informativa è resa anche ai sensi dell’articolo 13 del D.Lgs. 196/03 – Codice in materia di protezione dei dati personali – a coloro che si collegano al sito di autounica.com all’indirizzo www.autounica.com e si ispira anche alla Raccomandazione n. 2/2001 che le autorità europee per la protezione dei dati personali, riunite nel Gruppo istituito dall’art. 29 della direttiva n. 95/46/CE, hanno adottato il 17 maggio 2001 per individuare alcuni requisiti minimi per la raccolta di dati personali on-line, e, in particolare, le modalità, i tempi e la natura delle informazioni che i titolari del trattamento devono fornire agli utenti quando questi si collegano a pagine web, indipendentemente dagli scopi del collegamento.
                    L’informativa è resa soltanto per il sito sopra menzionato e non anche per altri siti web eventualmente consultati dall’utente tramite appositi link.
                    Il sito sopra indicato è di proprietà e gestione di Auto Unica S.r.l. 
                    Si invitano gli utenti/visitatori a leggere attentamente la presente Privacy Policy prima di inoltrare qualsiasi tipo di informazione personale e/o compilare qualunque modulo elettronico presente sul sito stesso.
                    </p>
                      <h3 class="margintop30">TITOLARE E RESPONSABILE DEL TRATTAMENTO</h3>
                      <p class="justify">Il Titolare del trattamento è Auto Unica S.r.l. , con Sede legale in via Valcamonica 19/H - 25132 Brescia (BS) . 
                      Responsabili del trattamento dei dati personali sono i soggetti dell’Azienda incaricati di tale gestione.</p>
                      <h3 class="margintop30">LUOGO DI TRATTAMENTO DEI DATI</h3>
                      <p class="justify">I trattamenti connessi ai servizi web di questo sito hanno luogo presso la predetta sede e sono curati solo da personale tecnico dell’Ufficio incaricato del trattamento.</p>
                      <h3 class="margintop30">TIPOLOGIA DI DATI TRATTATI E FINALITÀ DEL TRATTAMENTO</h3>
                       <h4>1. Dati di navigazione</h4>
                      <p class="justify">II sistemi informatici e le procedure software preposte al funzionamento di questo sito web acquisiscono, nel corso del loro normale esercizio, alcuni dati personali la cui trasmissione è implicita nell’uso dei protocolli di comunicazione di Internet.
                    Si tratta di informazioni che non sono raccolte per essere associate a interessati identificati, ma che per loro stessa natura potrebbero, attraverso elaborazioni ed associazioni con dati detenuti da terzi, permettere di identificare gli utenti.
                    In questa categoria di dati rientrano gli indirizzi IP o i nomi a dominio dei computer utilizzati dagli utenti che si connettono al sito, gli indirizzi in notazione URI (Uniform Resource Identifier) delle risorse richieste, l’orario della richiesta, il metodo utilizzato nel sottoporre la richiesta al server, la dimensione del file ottenuto in risposta, il codice numerico indicante lo stato della risposta data dal server (buon fine, errore, ecc.) ed altri parametri relativi al sistema operativo e all’ambiente informatico dell’utente.
                    Questi dati sono utilizzati al solo fine di ricavare informazioni statistiche anonime sull’uso del sito e per controllarne il corretto funzionamento e vengono cancellati immediatamente dopo l’elaborazione. I dati potrebbero essere utilizzati per l’accertamento di responsabilità in caso di ipotetici reati informatici ai danni del sito: salva questa eventualità, allo stato i dati sui contatti web non persistono per più di sette giorni.</p>
                      <h4>2. Cookie</h4>
                      <p class="justify">Al fine di rendere i propri servizi il più possibile efficienti e semplici da utilizzare questo Sito fa uso di cookie. Pertanto, quando si visita il Sito, viene inserita una quantità minima di informazioni nel dispositivo dell’Utente, come piccoli file di testo chiamati “cookie”, che vengono salvati nella directory del browser Web dell’Utente e rinviati automaticamente al server ad ogni successivo accesso al sito. Esistono diversi tipi di cookie, ma sostanzialmente lo scopo principale di un cookie è quello di far funzionare più efficacemente il Sito e di abilitarne determinate funzionalità.
                    Non viene fatto uso di cookie per la trasmissione di informazioni di carattere personale.
                    L’uso di c.d. cookie di sessione (che non vengono memorizzati in modo persistente sul computer dell’utente e svaniscono con la chiusura del browser) è strettamente limitato alla trasmissione di identificativi di sessione necessari per consentire l’esplorazione sicura ed efficiente del sito.
                    I cookie di sessione utilizzati in questo sito evitano il ricorso ad altre tecniche informatiche potenzialmente pregiudizievoli per la riservatezza della navigazione degli utenti e non consentono l’acquisizione di dati personali identificativi dell’utente.
                    In questo sito vengono, altresì, impiegati cookie persistenti, ossia cookie che rimangono memorizzati sul disco rigido del computer fino alla loro scadenza o cancellazione da parte degli utenti/visitatori.
                    Tramite i cookie persistenti gli utenti/visitatori che accedono al sito (o eventuali altri utenti che impiegano il medesimo computer) vengono automaticamente riconosciuti ad ogni visita.
                    Gli utenti/visitatori possono impostare il browser del computer in modo tale che accetti/rifiuti tutti i cookie o visualizzi un avviso ogni qual volta viene proposto un cookie, per poter valutare se accettarlo o meno.
                    Per default quasi tutti i browser web sono impostati per accettare automaticamente i cookie. E’ comunque modificare la configurazione predefinita e disabilitare i cookie (cioè bloccarli in via definitiva), impostando un livello di protezione più elevato, ma segnaliamo che la disabilitazione compromette l’utilizzo del Servizio.
                    In ogni caso, è anche possibile di cancellare i cookie dal computer; la cancellazione dei cookie non preclude l’utilizzo del Servizio.
                    Il sito autounica.com consente la trasmissione di cookie di siti o di web server diversi (c.d. cookie di “terze parti”) che l’utente/visitatore potrebbe ricevere sul suo terminale: ciò accade perché sul sito possono essere presenti elementi come, ad esempio, immagini, mappe, suoni, specifici link a pagine web di altri domini che risiedono su server diversi da quello sul quale si trova la pagina richiesta. In altre parole, detti cookie sono impostati direttamente da gestori di siti web o server diversi dal nostro sito. autounica.com è estranea all’operatività dei “cookie di terze parti”, il cui funzionamento rientra nella responsabilità di tali terze parti.
                    Ai sensi dell’art. 122 secondo comma del D.lgs. 196/2003 il consenso all’utilizzo di tali cookie è espresso dall’interessato mediante il settaggio individuale che ha scelto liberamente per il browser utilizzato per la navigazione nel sito, ferma restando la facoltà dell’utente di comunicare in ogni momento al Titolare del trattamento la propria volontà in merito ad dati gestiti per il tramite dei cookie che il browser stesso abbia accettato.
                    </p>
                      <h4>2.1 Gestione dei Cookie</h4>
                      <p class="justify">Fatto salvo quanto esposto anteriormente, l’utente potrà configurare il proprio browser per accettare o rifiutare automaticamente tutti i cookie o per ricevere sullo schermo un avviso della trasmissione di ciascun cookie e decidere di volta in volta se installarlo o meno sull’hard disk. L’utente potrà anche revocare in qualsiasi momento il consenso accordato all’uso di cookie, configurando a tal fine il proprio browser. È necessario tener presente che la disattivazione potrebbe condizionare il corretto funzionamento di determinate sezioni del sito web. Invitiamo gli utenti a prendere visione delle istruzioni e dei manuali del browser utilizzato per ampliare queste informazioni:
                    Se si utilizza Microsoft Internet Explorer, selezionare Strumenti, Opzioni di Internet e quindi Privacy.
                    Se si utilizza Firefox per Mac, selezionare Preferenze, Privacy e accedere alla sezione Mostra i Cookie; per Windows selezionare Strumenti e poi Opzioni, accedere a Privacy e quindi dal menu a tendina delle Impostazioni Cronologia selezionare Utilizza impostazioni personalizzate.
                    Se si utilizza Safari, selezionare Privacy all’interno del menu Preferenze.
                    Se si utilizza Google Chrome, dal menu Strumenti selezionare Opzioni (Preferenze per Mac), accedere ad Avanzate quindi all’opzione Configurazione Contenuto della sezione Privacy e infine spuntare Cookie nel menu Configurazione del contenuto.
                    </p>
                      <h4>2.2 Google Analytics</h4>
                      <p>Questo sito web utilizza Google Analytics, un servizio di analisi web fornito da Google, Inc. (“Google”). Google Analytics utilizza dei “cookie”, che sono file di testo che vengono depositati sul Vostro computer per consentire al sito web di analizzare come gli utenti utilizzano il sito. Le informazioni generate dal cookie sull’utilizzo del sito web da parte Vostra (compreso il Vostro indirizzo IP) verranno trasmesse a, e depositate presso i server di Google negli Stati Uniti. Google utilizzerà queste informazioni allo scopo di tracciare e esaminare il Vostro utilizzo del sito web, compilare report sulle attività del sito web per gli operatori del sito web e fornire altri servizi relativi alle attività del sito web e all’utilizzo di Internet. Google può anche trasferire queste informazioni a terzi ove ciò sia imposto dalla legge o laddove tali terzi trattino le suddette informazioni per conto di Google. Google non assocerà il vostro indirizzo IP a nessun altro dato posseduto da Google. Potete rifiutarvi di usare i cookie selezionando l’impostazione appropriata sul vostro browser, ma ciò potrebbe impedirvi di utilizzare alcune funzionalità di questo sito web. Utilizzando il presente sito web, voi acconsentite al trattamento dei Vostri dati da parte di Google per le modalità e i fini sopraindicati”.</p>
                      <h3 class="margintop30">FACOLTATIVITÀ DEL CONFERIMENTO DEI DATI</h3>
                      <p class="justify">A parte quanto specificato per i dati di navigazione, l’utente è libero di fornire i dati personali riportati nei moduli di richiesta a autounica.com per chiedere approfondimenti, delucidazioni o altre comunicazioni.
                    Il loro mancato conferimento può comportare l’impossibilità di ottenere quanto richiesto e i dati saranno usati unicamente per espletare la richiesta di ricontatto o per rispondere ai quesiti posti.
                    Per completezza va ricordato che in alcuni casi (non oggetto dell’ordinaria gestione di questo sito) l’Autorità può richiedere notizie e informazioni ai sensi dell’articolo 157 del Codice in materia di protezione dei dati personali, ai fini del controllo sul trattamento dei dati personali. In questi casi la risposta è obbligatoria a pena di sanzione amministrativa.</p>
                      <h3 class="margintop30">MODALITÀ DEL TRATTAMENTO</h3>
                      <p class="justify">Il trattamento viene effettuato attraverso strumenti automatizzati (ad es. utilizzando procedure e supporti elettronici) e/o manualmente (ad es. su supporto cartaceo) per il tempo strettamente necessario a conseguire gli scopi per i quali i dati sono stati raccolti (rispondere alle richieste di ricontatto o di approfondimento) e comunque, in conformità alle disposizioni normative vigenti in materia.
                    Specifiche misure di sicurezza sono osservate per prevenire la perdita dei dati, usi illeciti o non corretti ed accessi non autorizzati.
                    I dati raccolti non saranno venduti e/o trasferiti a terzi.</p>
                      <h3 class="margintop30">DIRITTI DEGLI INTERESSATI</h3>
                      <p class="justify">I soggetti cui si riferiscono i dati personali hanno il diritto in qualunque momento di ottenere la conferma dell’esistenza o meno dei medesimi dati e di conoscerne il contenuto e l’origine, verificarne l’esattezza o chiederne l’integrazione o l’aggiornamento, oppure la rettificazione (art. 7 del D.Lgs 196/03).
                    Ai sensi del medesimo articolo si ha il diritto di chiedere la cancellazione, la trasformazione in forma anonima o il blocco dei dati trattati in violazione di legge, nonché di opporsi in ogni caso, per motivi legittimi, al loro trattamento.
                    Le richieste vanno rivolte a:
                    autounica.com, servizio privacy - Sede legale ia Valcamonica 19/H - 25132 Brescia (BS) - info @ autounica.com</p>
                     
                                </div><!--chiudi mappasito-->
                    
                  
                  
                  
                  
                  
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