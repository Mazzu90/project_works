<?php 
header('Content-Type: text/xml');//lasciare in alto
echo '<?xml version="1.0" encoding="UTF-8" ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" >';//lasciarlo in alto altrimenti da errore
$data_oggi = (date('Y-m-d'));

/*****************************************************************
INCLUSIONI
*****************************************************************/
set_time_limit ( 240 );

if (!(isset($lInclude)&&($lInclude)))
{
    include('include_dir.php');
    include($percorsoLingua.'include/include.php');
    $grafica=new Tgrafica(false,false);
}

?>
<url>
    <loc><?echo costantiP::BASE_URL?></loc>
    <lastmod><?php echo $data_oggi ?></lastmod>
</url>
<url>
    <loc><?echo costantiP::BASE_URL.costantiP::LINGUA?>/azienda.php</loc>
    <lastmod><?php echo $data_oggi ?></lastmod>
</url>
<url>
    <loc><?echo costantiP::BASE_URL.costantiP::LINGUA?>/esposizione.php</loc>
    <lastmod><?php echo $data_oggi ?></lastmod>
</url>
<url>
    <loc><?echo costantiP::BASE_URL.costantiP::LINGUA?>/compriamo.php</loc>
    <lastmod><?php echo $data_oggi ?></lastmod>
</url>
<url>
    <loc><?echo costantiP::BASE_URL.costantiP::LINGUA?>/ricerca.php</loc>
    <lastmod><?php echo $data_oggi ?></lastmod>
</url>
<url>
    <loc><?echo costantiP::BASE_URL.costantiP::LINGUA?>/contatti.php</loc>
    <lastmod><?php echo $data_oggi ?></lastmod>
</url>
<url>
    <loc><?echo costantiP::BASE_URL.costantiP::LINGUA?>/autovetture.php</loc>
    <lastmod><?php echo $data_oggi ?></lastmod>
</url>
<?
$marche = array();
        $sql = 'SELECT  marca.id,
                            marca.titolo,
                            marca.titolo_normalizzato
                    FROM
                            marca
                    WHERE 
                            marca.id in (select distinct id_marca from veicoli)
                    ORDER BY titolo ASC';
            
            $result=mysql_query($sql);

            while ($row=mysql_fetch_assoc($result)) {
                    $marca['id']=$row['id'];
                    $marca['titolo']=$row['titolo'];
                    $marca['titolo_normalizzato']=$row['titolo_normalizzato'];
                    $marche[]=$marca; 
                    }

            foreach ($marche as $imgV) {
                echo '<url>'.chr(13).'<loc>'.costantiP::BASE_URL.costantiP::LINGUA.'/'.$imgV['titolo_normalizzato'].'/</loc>'.chr(13);
                echo '<lastmod>'.$data_oggi.'</lastmod>'.chr(13).'</url>'.chr(13);

                 $modelli = array();

                 $sql = 'SELECT  
                            modelli.id,
                            modelli.titolo,
                            modelli.titolo_normalizzato                            
                    FROM
                            modelli
                    WHERE 
                            modelli.id in (select distinct id_modello from veicoli where id_marca = '.$imgV['id'].')
                    ORDER BY titolo ASC';
                    
                     $result=mysql_query($sql);

                                        

                        $result=mysql_query($sql);

                                        

                       while ($row=mysql_fetch_assoc($result)) {

                                $modello['id']=$row['id'];
                                $modello['titolo']=$row['titolo'];
                                $modello['titolo_normalizzato']=$row['titolo_normalizzato'];
                                $modello['numeroVeicoli']= estraiNumeroVetture($modello['id'],$imgV['id']);
                                $modelli[]=$modello; 

                            }
                        
                        
                        
                        foreach ($modelli as $imgM) {
                            echo '<url>'.chr(13).'<loc>'.costantiP::BASE_URL.costantiP::LINGUA.'/'.$imgV['titolo_normalizzato'].'/'.$imgM['titolo_normalizzato'].'/</loc>'.chr(13);
                            echo '<lastmod>'.$data_oggi.'</lastmod>'.chr(13).'</url>'.chr(13);
                            }
              }    

            

?>






</urlset>

<?
function estraiNumeroVetture($idModello,$idMarca)
{
    $sql = 'SELECT  
                count(id) as numeroVeicoli
            FROM
                veicoli
            WHERE 
                veicoli.id_modello = '.$idModello.' and veicoli.id_marca = '.$idMarca;                    
                         
            $result=mysql_query($sql);
            $data = mysql_fetch_assoc($result);
            
            return $data['numeroVeicoli'];            
}

?>