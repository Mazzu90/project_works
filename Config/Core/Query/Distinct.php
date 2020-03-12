<?php

namespace Config\Core\Query;

use Config\Core\Query\QueryField;
use Config\Utils\Util;

class Distinct extends QueryField {



    public function getFieldForSelect(){

        return ' DISTINCT '.$this->table.'.'.$this->field.$this->alias;
    }

    public function getCondition($and)
    {
        $and = ($and)? ' AND ' : '';
        if(Util::isValid($this->value))return $and.$this->table.'.'.$this->field." = '".$this->value."'";
        else return '';
    }

    public function setFieldsFromHttpRequest($obj_idx)
    {
        if(isset($_REQUEST[$obj_idx][$this->field])){
            if(Util::isValid($_REQUEST[$obj_idx][$this->field])) $this->value = $_REQUEST[$obj_idx][$this->field];
        }
    }
}