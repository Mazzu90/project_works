<?

namespace Config\Utils;

//use DateTime;

class Data extends \DateTime{ 
    
    static function validateDbDate($date, $format = 'Y-m-d') {       
       
            echo '<br>Problema';
            $foo = new \DateTime();
        
            var_dump($foo);
            
            $class_methods = get_class_methods(new \DateTime());

            
            foreach ($class_methods as $method_name) {
                echo "$method_name\n";
            }
            
        echo 'created';
        //print_r(\DateTime::getTimestamp());
        print_r(\DateTime::getLastErrors());
        //$d = $foo::getTimestamp();
        try {
            $date = new \DateTime('2000-01-01');
            echo 'ok';
            
            //echo $date::getTimezone();
            echo 'ok2';
        } catch (Exception $e) {
            echo $e->getMessage();
            exit(1);
        }
        
        //$d = self::createFromFormat($format, $date);
        echo $d;
        return $d && $d->format($format) == $date;
        
    }    
    
    function stampaData($data,$nGiorno)
    {
        dbdate_decode($data,$giorno,$mese,$anno);
        $w=date('w',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));
        $D=date('d',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));
        $m=date('m',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));
        $Y=date('Y',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));      
       
        $arr_set=array("Domenica","LunedÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","MartedÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","MercoledÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","GiovedÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","VenerdÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","Sabato");
        $arr_mesi=array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");
        $w = $arr_set[$w];
        $m = $arr_mesi[(int)($m-1)];
        
        $data = "".$w."&nbsp;".$D."&nbsp;".$m."&nbsp;".$Y.""; 
        return $data;
    }
    
    
    function stampaDataContratta($data,$nGiorno)
    {
        dbdate_decode($data,$giorno,$mese,$anno);
        $w=date('w',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));
        $D=date('d',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));
        $m=date('m',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));
        $Y=date('Y',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));      
       
        $arr_set=array("Domenica","LunedÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","MartedÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","MercoledÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","GiovedÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","VenerdÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","Sabato");
        $arr_mesi=array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");
        $w = $arr_set[$w];
        $m = $arr_mesi[(int)($m-1)];
        
        //$data = "".$w."&nbsp;".$D."&nbsp;".$m."&nbsp;".$Y."";
        $data = "".$D." ".$m."";
        return $data;
    }
    
    function estraiMese($data,$nGiorno)
    {
        dbdate_decode($data,$giorno,$mese,$anno);
        $w=date('w',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));
        $D=date('d',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));
        $m=date('m',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));
        $Y=date('Y',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));      
       
        $arr_set=array("Domenica","LunedÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","MartedÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","MercoledÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","GiovedÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","VenerdÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","Sabato");
        $arr_mesi=array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");
        $w = $arr_set[$w];
        $m = $arr_mesi[(int)($m-1)];
        
        $data = "".$m." ".$Y."";
        return $data;
    }
    
    function estraiDataNews($data,$nGiorno)
    {
        if ($data=='')
            $data = date('Y-m-d');
        
        dbdate_decode($data,$giorno,$mese,$anno);
        $w=date('w',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));
        $D=date('d',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));
        $m=date('m',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));
        $Y=date('Y',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));      
       
        $arr_set=array("Domenica","LunedÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","MartedÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","MercoledÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","GiovedÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","VenerdÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","Sabato");
        $arr_mesi=array("GEN","FEB","MAR","APR","MAG","GIU","LUG","AGO","SET","OTT","NOV","DIC");
        $w = $arr_set[$w];
        $m = $arr_mesi[(int)($m-1)];
        
        $data = "<strong>".$D."</strong><label><span class=\"yellow\">".$m."<br />".$Y."</span></label>";
        return $data;
    }
    
    function preparadata($data)
    {
        list($mese, $anno) = explode("/", $data);
        //$data = '01-'.$mese.'-'.$anno;
        $data = $anno.'-'.$mese.'-01';
        return $data;
    }
    
    function estraiDataAuto($data, $nGiorno='1')
    {
        /*if ($data=='')
            $data = date('m/Y');
            
        list($mese, $anno) = explode("/", $data);
            
        $arr_mesi=array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");
        $m = $arr_mesi[(int)($mese-1)];
        
        $data = "".$m." ".$anno."";
        return $data;
        */
        if ($data=='')
            $data = date('Y-m-d');
        
        $dataCheck=explode("-",$data); 
        if(checkdate($dataCheck[1],$dataCheck[2],$dataCheck[0]))
        {
                //DATA VALIDA
                //dbdate_decode($data,$giorno,$mese,$anno);
       
                    $w=date('w',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));
                    $D=date('d',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));
                    $m=date('m',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));
                    $Y=date('Y',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));      
                   
                    $arr_set=array("Domenica","LunedÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","MartedÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","MercoledÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","GiovedÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","VenerdÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","Sabato");
                    $arr_mesi=array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");
                    
                    $w = $arr_set[$w];
                    $m = $arr_mesi[(int)($m-1)];
                    
                    $data = $m." ".$Y;
                
                 
            }
            else
            {
               //DATA NON VALIDA 
                $data = "non disponibile";
            } 
        
        
        return $data;
       
    }
    
    function estraiDataAutoContratta($data, $nGiorno='1')
    {
        /*if ($data=='')
            $data = date('m/Y');
            
        list($mese, $anno) = explode("/", $data);
            
        $arr_mesi=array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");
        $m = $arr_mesi[(int)($mese-1)];
        
        $data = "".$m." ".$anno."";
        return $data;
        */
        if ($data=='')
            $data = date('Y-m-d');
        
        $dataCheck=explode("-",$data); 
        if(checkdate($dataCheck[1],$dataCheck[2],$dataCheck[0]))
        {
                //DATA VALIDA
                //dbdate_decode($data,$giorno,$mese,$anno);
       
                    $w=date('w',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));
                    $D=date('d',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));
                    $m=date('m',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));
                    $Y=date('Y',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));      
                   
                    $arr_set=array("Domenica","LunedÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","MartedÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","MercoledÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","GiovedÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","VenerdÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬","Sabato");
                    $arr_mesi=array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");
                    
                    $w = $arr_set[$w];
                    //$m = $arr_mesi[(int)($m-1)];
                    
                    $data = $m." / ".$Y;
                
                 
            }
            else
            {
               //DATA NON VALIDA 
                $data = "non disponibile";
            } 
        
        
        return $data;
       
    }
    
    static function getYear($data)
    {
        echo'<br>   qui?';
        if(self::validateDbDate($data)):
            
            //dbdate_decode($data,$giorno,$mese,$anno);
            $Y=date('Y',mktime(0,0,0,$mese,$giorno,$anno));
        endif;
        
        return $Y;
    }
    
        
    
    
    
    
}





?>