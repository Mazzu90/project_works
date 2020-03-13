<?php

namespace Config\Core\Query;

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

}