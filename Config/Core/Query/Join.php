<?php

namespace Config\Core\Query;
use Config\Core\Query\QueryField;
use Config\Utils\Util;
use Config\Utils\Data;
class Join extends QueryField {
    
    public $type = ' INNER ';
    public $table;
    public $joinTable;
    public $internalKey =  ' id ';
    public $foreignKey;
    public $field;
    public $value;
    public $selectFields;
    
    
    public function __construct(){
        
    }
    
    public function getJoinCondition(){
        
        return $this->type.' JOIN '.$this->joinTable.' ON '.$this->internalKey.' = '.$this->foreignKey;
    }
    
    public function getCondition($and){
              
        return $this->field->getCondition($and);
    }
    
    public function getFieldForSelect(){
        
        return $this->field->getFieldForSelect();
    }
    
    public function setFieldsFromHttpRequest($obj_idx){

        $this->field->setFieldsFromHttpRequestForJoinTable();        
    }

    public function setFieldsFromHttpRequestForJoinTable(){        
        
        $this->field->setFieldsFromHttpRequestForJoinTable();    
    }
    
}

?>