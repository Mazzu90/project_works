<?


namespace Config\Core\Query;

use Config\Utils\Util;

class Basic extends QueryField{
    
    public $value;
    
    public function getWhereClause($and){

        $and = ($and)? ' AND ' : '';
        if(Util::isValid($this->value))return $and.$this->table.'.'.$this->field." = '".$this->value."'";
        else return '';        
    }

}

?>