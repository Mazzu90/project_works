<?

namespace Config\Entities;
use Config\Core\Entities\Querable;
use Config\Utils\Util;
use Config\Utils\Data;

class Optional extends Querable{

    public $selectFields = array('id_veicolo');
    public $additionalSearchFields = array('titolo0', 'titolo1','titolo2', 'titolo3');

    public static function getClass() {

        return __NAMESPACE__.'\Optional';
    }

    public static function getTable() {
        return 'optional';
    }

    
    public function __construct($search = false){       
        
        if($search):
            
            $this->id_veicolo = new Basic('optional', 'id_veicolo');
            
            for($i=0; $i<=3; $i++)
                $this->{'titolo'.$i} = new Basic('optional', 'titolo');
                
            if(isset($_REQUEST['optional']['titolo'])):
                
                $numOptionalSettati = isset($_REQUEST['optional']['titolo'])? count($_REQUEST['optional']['titolo']): 0;
                
                echo('isset optional!');                
                
                for($i = 0; $i<$numOptionalSettati; $i++):
                    
                    if($i == 0):
                        $this->titolo0 = new PatternMatch('optional', 'titolo');
                        $this->titolo0->value = $_REQUEST['optional']['titolo'][0];
                        continue;
                    endif;
                    
                    $this->{'titolo'.$i} = new Join();
                    $this->{'titolo'.$i}->joinTable = ' optional AS o'.$i.' ';
                    $this->{'titolo'.$i}->internalKey = 'optional.id_veicolo' ;
                    $this->{'titolo'.$i}->foreignKey = 'o'.$i.'.id_veicolo' ;
                    $this->{'titolo'.$i}->field = new PatternMatch('o'.$i, 'titolo');
                    $this->{'titolo'.$i}->field->value = $_REQUEST['optional']['titolo'][$i];
                    
                endfor;
            endif;
        endif;   
    }
}

?>