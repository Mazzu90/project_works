<?
include('include_dir.php');
include($percorsoLingua.'include/include.php');

$grafica=new Tgrafica(false,false);

//se ho ricevuto qualcosa in post imposto la sessione con quel valore e la relativa variabile che userò per la query
isset($_GET['prezzo'])?$prezzo=$_GET['prezzo']:$prezzo='';
isset($_GET['carrozzeria'])?$carrozzeria=$_GET['carrozzeria']:$carrozzeria='';
isset($_GET['cambio'])?$cambio=$_GET['cambio']:$cambio='';
isset($_GET['benzina'])?$benzina=$_GET['benzina']:$benzina='';
isset($_GET['diesel'])?$diesel=$_GET['diesel']:$diesel='';
isset($_GET['gpl'])?$gpl=$_GET['gpl']:$gpl='';
isset($_GET['metano'])?$metano=$_GET['metano']:$metano='';
isset($_GET['elettrica'])?$elettrica=$_GET['elettrica']:$elettrica='';
isset($_GET['ibrida'])?$ibrida=$_GET['ibrida']:$ibrida='';
isset($_GET['marca'])?$marca=$_GET['marca']:$marca='';
isset($_GET['modello'])?$modello=$_GET['modello']:$modello='';
isset($_GET['neopatentati'])?$neopatentati=$_GET['neopatentati']:$neopatentati='';

//$grafica->paint();

//unset($grafica);
$nVeicoli = estraiVeicoliNumero($prezzo, $carrozzeria, $cambio, $benzina, $diesel, $gpl, $metano, $elettrica, $ibrida, $marca, $modello, $neopatentati);

return $nVeicoli;


function estraiVeicoliNumero($prezzo, $carrozzeria, $cambio, $benzina, $diesel, $gpl, $metano, $elettrica, $ibrida, $marca, $modello, $neopatentati)
{
    $where='';
    
    if ($prezzo>0)
    {
        
        switch ($prezzo) {
            case 1:
                $where=' and prezzo < 5000';
                break;
            case 2:
                $where=' and prezzo BETWEEN 5000 AND 10000';
                break;
            case 3:
                $where=' and prezzo BETWEEN 10000 AND 15000';
                break;
            case 4:
                $where=' and prezzo BETWEEN 15000 AND 20000';
                break;
            case 5:
                $where=' and prezzo > 20000';
                break;
        }
    }
    
    if ($carrozzeria!='')
        $where .=' and body = "'.$carrozzeria.'"';
    
    if ($cambio!='')
            {
            switch ($cambio) {
                case 1:
                    $where .=' and gearbox = "Automatico"';
                    break;
                case 2:
                    $where .=' and gearbox = "Manuale"';
                    break;
            }
        }     
    
   
    if ($benzina==true || $diesel==true || $gpl==true ||  $metano==true ||  $elettrica==true ||  $ibrida==true)
        {
            $where2 =' alimentazione = -1';
            if ($benzina==true)
                $where2 .=' or alimentazione = 1';
            if ($diesel==true)
                $where2 .=' or alimentazione = 2';
            if ($gpl==true)
                $where2 .=' or alimentazione = 4';
            if ($metano==true)
                $where2 .=' or alimentazione = 5';
            if ($elettrica==true)
                $where2 .=' or alimentazione = 6';
            if ($ibrida==true)
                $where2 .=' or alimentazione = 3';
           $where .= ' and ('.$where2.')';
        }
        
      if ($marca!='')
        $where .=' and id_marca = "'.$marca.'"';  
        
       if ($modello=='-1')
        $modello = ''; 
      if ($modello!='')
        $where .=' and id_modello = "'.$modello.'"';  
          
      if ($neopatentati==1)
            $where = 'and neopatentati = 1';
      
      /*paginazione*/
      $limit='';
      /*  
        if ($nContenutiDaEstrarre>0)
            $limit = ' limit 0,'.$nContenutiDaEstrarre;
        else
        {
            if ($pagina>0)
                $limit=' limit '.(($pagina-1)*$numeroRecordPerPagina).','.$numeroRecordPerPagina;
                //$limit=' limit '.(($this->pagina-1)*costantiP::NUMERO_RECORD_PAGINA_SMALL).','.costantiP::NUMERO_RECORD_PAGINA_SMALL;
        }    
      */  
        //$limit = 'limit '.$start.', '.$limit2; 
      
        $sql = 'select                         
                    count(*) as numero
                from 
                    veicoli
                 where
                   veicoli.pubblicato = 1 '.$where;
       
       
       $numero = GetFieldValue($sql, 'numero');
       
       
        $sql = 'select                         
                    count(*) as numero
                from 
                    veicoli
                 where
                   veicoli.pubblicato = 1 ';
       
       
       $numeroTotale = GetFieldValue($sql, 'numero');
       
       if ($numero==$numeroTotale)
       {
            echo ' VEDI TUTTE LE '.$numero.' AUTO';
       }
       else
       {
            if ($numero>0)
           {
            echo $numero.' AUTO';
           }
           else
           {
            echo 'VISUALIZZA RISULTATI';
           }
       }
       
       
       
       }
?>