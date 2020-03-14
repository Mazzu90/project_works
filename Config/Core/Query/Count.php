<?php

namespace Config\Core\Query;

use Config\Core\Query\QueryField;
use Config\Utils\Util;

class Count extends QueryField{    
    
    public function getDotNotation(){

        return ' COUNT('.$this->field.')'.$this->alias;   
    }
    
    public function getWhereClause($and){
        
        $and = ($and)? ' AND ' : '';
        if(Util::isValid($this->value))return $and.$this->table.'.'.$this->field." = '".$this->value."'";
        else return '';        
    }


    public function setFieldFromHttpRequestForJoinTable(){
        
        if(isset($_REQUEST['join'][$this->field])){
            if(Util::isValid($_REQUEST[]['join'][$this->field])) $this->value = $_REQUEST['join'][$this->field];
        }        
    }   
    
    
    
}


?>