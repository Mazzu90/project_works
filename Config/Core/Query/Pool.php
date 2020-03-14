<?
namespace Config\Core\Query;
use Config\Core\Query\QueryField;
use Config\Utils\Util;
use Config\Utils\Data;

class Pool extends QueryField{
    
    public $field;
    public $value;
    
    public function getWhereClause($and){
        
        $and = ($and)? ' AND ' : '';
        if(Util::isValid($this->value))return $and.$this->table.'.'.$this->field.' IN '.$this->value;
        else return '';        
    }
    
    public function setValueFromHttpRequest($obj_idx){

        if(isset($_REQUEST[$obj_idx]['pool'][$this->field])){
            if(Util::isValid($_REQUEST[$obj_idx]['pool'][$this->field])) $this->value = $_REQUEST[$obj_idx]['pool'][$this->field];
        }     
    }
    
    public function setFieldFromHttpRequestForJoinTable(){
        
        if(isset($_REQUEST['join']['pool'][$this->field])){
            if(Util::isValid($_REQUEST['join']['pool'][$this->field])) $this->value = $_REQUEST['join']['pool'][$this->field];      
        }        
    }
      
}

?>