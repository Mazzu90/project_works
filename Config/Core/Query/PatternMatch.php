<?
namespace Config\Core\Query;
use Config\Core\Query\QueryField;
use Config\Utils\Util;
use Config\Utils\Data;

class PatternMatch extends QueryField{
	
    public $field;
    public $value;
    public $type = 'any'; // start, end, every
    
    public function getWhereClause($and){
        
        $value = $this::setValueFromMatchType();
        $and = ($and)? ' AND ' : '';
        if(Util::isValid($this->value)):
            return $and.$this->table.'.'.$this->field." LIKE '".str_replace('"', '', $value)."'";
        endif; 
        
        return '';        
    }
    
    public function setValueFromMatchType(){
        
        if(isset($this->type) && isset($this->value)){
            switch($this->type){
                
                case 'end':
                    return '%'.$this->value;
                case 'start':
                    return  $this->value.'%';

                default:
                    return '%'.$this->value.'%';    
            }
        }else
            return  '';        
    }
    
    public function setValueFromHttpRequest($obj_idx){
        
        if(isset($_REQUEST[$obj_idx][$this->field])){
            if(Util::isValid($_REQUEST[$obj_idx]['match'][$this->field])) $this->value =$_REQUEST[$obj_idx]['match'][$this->field];
        }        
    }

    public function setFieldFromHttpRequestForJoinTable($obj){
        
        if(isset($_REQUEST['join'][$this->field])){
            if(Util::isValid($_REQUEST['join'][$this->field])) $this->value = $_REQUEST['join'][$this->field];      
        }        
    }   
}

?>