<?php

namespace Config\Core\Query;

use Config\Utils\Util;

class Distinct extends QueryField {

    public function getDotNotation(){

        return ' DISTINCT '.$this->table.'.'.$this->field.$this->alias;
    }

    public function getWhereClause($and)
    {
        $and = ($and)? ' AND ' : '';
        if(Util::isValid($this->value))return $and.$this->table.'.'.$this->field." = '".$this->value."'";
        else return '';
    }

}