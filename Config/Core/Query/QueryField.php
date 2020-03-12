<?

namespace Config\Core\Query;

use Config\Utils\Util;
use Config\Utils\Data;
use Config\Core\Entities\Debugger;

abstract class QueryField{
    
    public $table;
    public $field;
    public $alias;
    
    private $debug;
    
    public function __construct($table, $field_name, $alias = false){
        
        $this->debug = new Debugger("QUERY FIELD");
        $method = '__construct()';
        $this->debug->constructing();

        $this->debug->generic($field_name);
        $this->field = $field_name;
        $this->table = $table;
        $this->alias = ($alias) ? ' AS '.$alias : '';
        
        if($this instanceof Range):
            $this->min = false;
            $this->max = false;
        else:   
            $this->value = false;
        endif;      
        
        $this->debug->constructed();
    }
    
    abstract public function getCondition($and);       
    abstract public function setFieldsFromHttpRequest($obj_idx);
    
    public function getFieldForSelect(){
        
        return $this->table.'.'.$this->field.$this->alias;
    }
    
    public function unsetField($var = 'value'){
        
        if(isset($this->{$var}) && $this->{$var} != false){
            $this->{$var} = false;
            return true; 
        }
             
        return false;             
    }
}

?>