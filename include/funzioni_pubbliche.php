<?
function genera_link(   $lingua,
                        $lContenuto,
                        $id,
                        $lTitle=true,
                        $class=''
                        )
{
    if ($lContenuto)
    {
        
        $sql = 'select 
                    contenuti.titolo_'.strtolower($lingua).' as titolo,
                    contenuti.title_html_'.strtolower($lingua).' as titoloHTML,                    
                    contenuti.desc_breve_'.strtolower($lingua).' as descBreve,                    
                    contenuti.description_'.strtolower($lingua).' as description,                    
                    contenuti.url_'.strtolower($lingua).' as urlContenuto
                from
                    contenuti
                where
                    id='.$id;
        if ($getRecord($sql,$row))
        {
            $url=$row['url'];
            $title='';
        }
        else
        {
            
        }
    }   
    else
    {
        
    } 
}


?>