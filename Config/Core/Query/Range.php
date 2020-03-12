<?
namespace Config\Core\Query;
use Config\Core\Query\QueryField;
use Config\Utils\Util;
use Config\Utils\Data;

class Range extends QueryField{
    
    public function getCondition($and){
        
        $and = ($and)? ' AND ' : '';
        
        if(Util::isValid($this->min) && Util::isValid($this->max)){
            
            return $and.$this->table.'.'.$this->field." BETWEEN '".$this->min."' AND '".$this->max."'";             
        
        }elseif(Util::isValid($this->min)){
            
            return $and.$this->table.'.'.$this->field." > '".$this->min."'";
        
        }elseif(Util::isValid($this->max)){
            
            return $and.$this->table.'.'.$this->field." < '".$this->max."'";
        }
        else 
            return '';
    }
    
    public function setFieldsFromHttpRequest($obj_idx){
        
        if(isset($_REQUEST[$obj_idx]['range'][$this->field])){
            if(Util::isValid($_REQUEST[$obj_idx]['range'][$this->field]['min'])) $this->min = $_REQUEST[$obj_idx]['range'][$this->field]['min'];
            if(Util::isValid($_REQUEST[$obj_idx]['range'][$this->field]['max'])) $this->max = $_REQUEST[$obj_idx]['range'][$this->field]['max'];
        }
    }

    
    public function setFieldsFromHttpRequestForJoinTable($objectName){        
        
        if(isset($_REQUEST['join']['range'][$this->field])){
            if(Util::isValid($_REQUEST['join']['range'][$this->field]['min'])) $this->min = $_REQUEST['join']['range'][$this->field]['min'];      
            if(Util::isValid($_REQUEST['join']['range'][$this->field]['max'])) $this->max = $_REQUEST['join']['range'][$this->field]['max'];
        }        
    }
    
    

    
}  
?> 