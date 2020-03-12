<?php

/*

 INIZIO SVILUPPO:   10/05/2011
 * 
 * 
 * 
 * VERSIONE 0.1.1 teo
 * modificata la pagina include/img_funzioni.php per utilizzare la nuova classe di resize immagini.

versione 0.1.2 valerio
 * inclusa la funzionalità di crop delle thumb
 
versione 0.1.3 valerio / teo
- cambiata la classe Tnews per includere nella classe il metodo stampaDato.
    L'utilizzo di questa classe ora deve essere fatto con una classe ereditata che specifica il metodo. maggiori info vedi ( ./include/class.news.php) 
- aggiunto il parametro lfoto nella classe Tnews ( ./include/class.news.php)che definisce se per la news in oggetto esiste una fotografia associata.
- nella gestioen categorie prodotti aggiunta la specifica categoria di sistema.

versione 0.1.4 valerio / teo 27/06/2011
modificata la funzione ./aps/include/funzioni.php 
    function selectTipologie($idTipologiaPadre, $idGalleryDefault)
in modo che lavori correttamente anche nel caso abbiamo una sola tipologia di gallery (normalmente gallery pubbliche).


VERSIONE 1.0.1 04/11/2011 valerio
 
 * MODIFICHE APS
 * aggiornata la gestione delle versioni sia nell'area privata che nell'area pubblica
 * creato il modulo 
 * 
 * MODIFICHE AREA PUBBLICA
 * - creata la classe class.news.php sullo stile eventi


 */

class versione
{
    /*in questa pagina vengono gestite le versioni sia dell'area privata
     * che dell'area pubblica. 
     * La versione dell'area pubblica cambia quando vengono variate le classi di gestione
     * dei dati (le pagine interne alla cartella include) oppure viene cambiata l'impostazione
     * dei nomi dei div nel file css
     */
    
    //la versione aumenta quando il cambio è sostanziale (aggiunta di moduli ad esempio)
    CONST VERSIONE_APS = 2;
    
    //la sotto versione aumenta quando viene cambiato il database e quindi ci deve essere un file
    // nella cartella script sql che si chiama script_[VERSIONE-SOTTOVERSIONE].sql
    CONST SOTTOVERSIONE_APS = 0;
    
    //il rilascio aumenta per ogni minima variazione
    CONST RILASCIO_APS = 1;

    //varia quando vengono aggiunti nuovi moduli o una classe viene riscritta da zero
    CONST VERSIONE_AREA_PUBBLICA = 2;
    
    //cambia quando una classe viene modificata
    CONST SOTTOVERSIONE_AREA_PUBBLICA = 0;
    

    CONST DATA_RILASCIO = '2011/11/04';
    
}

?>
