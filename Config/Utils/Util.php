<?
namespace Config\Utils;
use Config\Properties;
use DateTime;
use Config\Core\Entities\Debugger;

class Util{   
    
    private $debug;

    public function getObjectVar($object = false)
    {
        if ($object == false) {
            $grafica = new Tgrafica(false, false);
            $object = new $grafica->classeRiferimento();
        }

        $objectVars = get_object_vars($object);
        foreach ($objectVars as $key => $value) {
            $keys[] = $key;
        }

        return $keys;
    }

    public function createSessionVariablesFromObject($object = false)
    {
        if ($object == false) {
            $object = Tgrafica::getOggetto();
        }

        $variabiliOggetto = Util::getObjectVar($object);

        foreach ($variabiliOggetto as $var) {
            $_SESSION[$var] = (isset($_GET[$var])) ?: (isset($_POST[$var])) ?: '';
        }
    }

    public static function isValid($value)
    {
        
        if (isset($value) && $value  != false && (((int) $value > 0) || !is_numeric($value) && $value != ''))
            return true;

        return false;
    }

    
    public function openConnection(){
        
        $encoding='utf8';
        
        //connessione al server
        $this->Connessione = @mysql_connect(Properties::db_host, Properties::db_user, Properties::db_password);
        //connessione al database
        if ($this->Connessione)
        {
            $this->db = @mysql_select_db(Properties::db_name, $this->Connessione);
            @mysql_query('SET NAMES \'' . $encoding . '\'',$Connessione);
        }
    }
    
    public function closeConnection(){
        
        if (isset($this->Connessione))
            @mysql_close($this->Connessione);
    }
    
    static function validateDbDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    
    static function prepareDate($data, $nGiorno='1')
    {        
        if(self::validateDbDate($data)):
            
            //dbdate_decode($data,$giorno,$mese,$anno);
        
            $w=date('w',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));
            $D=date('d',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));
            $m=date('m',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));
            $Y=date('Y',mktime(0,0,0,$mese,$giorno+($nGiorno-1),$anno));
            
            //$arr_set=array("Domenica","Luned�","Marted�","Mercoled�","Gioved�","Venerd�","Sabato");
            $arr_mesi=array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");
            
            //$w = $arr_set[$w];
            $m = $arr_mesi[(int)($m-1)];
            
            $data = $m." ".$Y;
   
        else:
       
            //DATA NON VALIDA
            $data = "non disponibile";
        
        endif;            
            
        return $data;            
    }
    
    static function getYear($data)
    {
        if(self::validateDbDate($data)):
            dbdate_decode($data,$giorno,$mese,$anno);
            $Y=date('Y',mktime(0,0,0,$mese,$giorno,$anno));
        endif;
            
        return $Y;            
    }
    
    
}

?>