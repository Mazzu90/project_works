<?


namespace Config\Core\Query;
use Config\Core\Query\QueryField;

use Config\Utils\Util;
use Config\Utils\Data;

class Basic extends QueryField{
    
    public $value;
    
    public function getCondition($and){
        
        $and = ($and)? ' AND ' : '';
        if(Util::isValid($this->value))return $and.$this->table.'.'.$this->field." = '".$this->value."'";
        else return '';        
    }
    
    public function setFieldsFromHttpRequest($obj_idx){

        if(isset($_REQUEST[$obj_idx][$this->field])){
            if(Util::isValid($_REQUEST[$obj_idx][$this->field])) $this->value = $_REQUEST[$obj_idx][$this->field];
        }        
    }   

    public function setFieldsFromHttpRequestForJoinTable(){        
        
        if(isset($_REQUEST['join'][$this->field])){
            if(Util::isValid($_REQUEST['join'][$this->field])) $this->value = $_REQUEST['join'][$this->field];      
        }        
    }
}

?>