<?
namespace Config\Core\Query;
use Config\Utils\Util;

class Range extends QueryField{
    
    public function getWhereClause($and){

        var_dump($this);
        $and = ($and)? ' AND ' : '';
        
        if(Util::isValid($this->min) && Util::isValid($this->max))
            return $and.$this->table.'.'.$this->field." BETWEEN '".$this->min."' AND '".$this->max."'";             
        
        elseif(Util::isValid($this->min))
            return $and.$this->table.'.'.$this->field." > '".$this->min."'";
        
        elseif(Util::isValid($this->max))
            return $and.$this->table.'.'.$this->field." < '".$this->max."'";

        else
            return '';
    }

    
    public function setValueFromHttpRequest($obj_idx){
        
        if(isset($_REQUEST[$obj_idx]['range'][$this->field])):

            if(Util::isValid($_REQUEST[$obj_idx]['range'][$this->field]['min']))
                $this->min = $_REQUEST[$obj_idx]['range'][$this->field]['min'];

            if(Util::isValid($_REQUEST[$obj_idx]['range'][$this->field]['max']))
                $this->max = $_REQUEST[$obj_idx]['range'][$this->field]['max'];

        endif;
    }

    
    public function setFieldFromHttpRequestForJoinTable($objectName){
        
        if(isset($_REQUEST['join']['range'][$this->field])):

            if(Util::isValid($_REQUEST['join']['range'][$this->field]['min']))
                $this->min = mysql_real_escape_string($_REQUEST['join']['range'][$this->field]['min']);

            if(Util::isValid($_REQUEST['join']['range'][$this->field]['max']))
                $this->max = mysql_real_escape_string($_REQUEST['join']['range'][$this->field]['max']);

        endif;
    }
    
    

    
}  
