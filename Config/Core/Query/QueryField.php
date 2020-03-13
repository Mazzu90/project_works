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

        $reflection_class = new \ReflectionClass($this);
        $this->class = $reflection_class->getName();
        $class_no_namespace = $reflection_class->getShortName();

        $this->debug = new Debugger("QUERY FIELD/$class_no_namespace");
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
    
    public function getFieldForSelect(){

        return $this->table.'.'.$this->field.$this->alias;
    }

    public function setValueFromHttpRequest($obj_idx){

        if(isset($_REQUEST[$obj_idx][$this->field])){
            if(Util::isValid($_REQUEST[$obj_idx][$this->field])) $this->value = $_REQUEST[$obj_idx][$this->field];
        }
    }

    public function setFieldFromHttpRequestForJoinTable($obj_idx){

        if(isset($_REQUEST['join'][$this->field])){
            if(Util::isValid($_REQUEST[$obj_idx]['join'][$this->field])) $this->value = $_REQUEST[$obj_idx]['join'][$this->field];
        }
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