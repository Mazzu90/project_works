<?
namespace Config\Core\Entities;

use Config\Core\Query\Query;
use Config\Core\Query\Basic;
use Config\Core\Query\Range;
use Config\Core\Query\Pool;
use Config\Core\Query\QueryField;
use Config\ComponentsMap;


abstract class Component{
    
    protected $query;
    private $debug;
    public $etichette;
    
    public function __construct($constructor_idx = -1){
        
        $this->debug = new Debugger("COMPONENT");
        $method = '__construct()';
        $this->debug->constructing();

        $reflection_class = new \ReflectionClass($this);
        $this->class = $reflection_class->getName();
        $class_no_namespace = $reflection_class->getShortName();

        $this->idx = constant('Config\ComponentsMap::'.strtolower($class_no_namespace).'_idx');

        $this->debug->generic("idx: ".$this->idx);

        if(isset(ComponentsMap::$components_warehouse[$class_no_namespace])):

            if($constructor_idx != ComponentsMap::custom_var_idx):

                $this->debug->generic("constructor_idx != ComponentsMap::custom_var_idx");
                foreach(ComponentsMap::$components_warehouse[$class_no_namespace] as $var => $value):
                    $this->{$var} = $value;
                endforeach;

            else:

                if(isset(ComponentsMap::$components_warehouse[$class_no_namespace]['table']))
                    $this->table = ComponentsMap::$components_warehouse[$class_no_namespace]['table'];

            endif;
        endif;

        $this->setPropertiesFromHttpRequest();

        $this->debug->constructed();
    }  
    
    protected function setPropertiesFromHttpRequest()
    {
        $method = 'setPropertiesFromHttpRequest()';
        $this->debug->tryingToSet('properties', $method);
        $properties = $this->getAllFields();
        
        foreach($properties as $prop):      

            $this->debug->tryingToSet('This->prop', $method);
            if(!(isset($this->{$prop}))  || ($this->{$prop} instanceOf QueryField)):
                if(!isset($this->{$prop})):
                 
                    if(isset($_REQUEST[$this->idx]['range'][$prop]))
                        $this->{$prop} = new Range($this->table, $prop);
                    elseif(isset($_REQUEST[$this->idx]['pool'][$prop]))
                        $this->{$prop} = new Pool($this->table, $prop);
                    else
                        $this->{$prop} = new Basic($this->table, $prop);
                endif;

                $this->debug->tryingToSet('This->prop from request', $method);
                $this->{$prop}->setFieldsFromHttpRequest($this->idx);

            endif;

            $this->debug->generic("setted");

        endforeach;
    }
    
    public function getAllFields(){
        
        return  array_merge($this->show_fields, $this->search_fields);
    }
    
    protected function setQuery($return_idx){

        $method = 'setQuery()';

        $this->debug->tryingToConstruct('Query', $method);
        $this->query = new Query($this, $return_idx);
    }


    /**
     * @param int $return_idx
     * @return list
     */
    public function getList($return_idx = ComponentsMap::return_current_obj_idx){
        $method = 'getList()';

        $this->debug->tryingToCreate('Query', $method, 'setQuery()');
        $this->setQuery($return_idx);

        $this->debug->tryingToCreate('List', $method, 'getObjectList', 'QUERY');
        $list = $this->query->getObjectList();
        //print_r($list);
        $this->debug->generic('list Created [list:'.count($list).']');

        return $list;
    }

    public static function getNewInstance(){
        
        return 'ciao';
        //return new self::$class;
    }    
    
    public function getShowFields(){

        $method = 'getShowFields()';

        $this->debug->tryingToSet('formatted_Fields', $method);
        $formatted_fields = array();

        print_r($this->show_fields);

        if(isset($this->show_fields)):            
            
            foreach($this->show_fields as $s)              
                $formatted_fields[] = $this->{$s}->getFieldForSelect();
        
        else:            
            echo '<br>$selectFields not setted';        
        endif;
        
        return $formatted_fields;        
    }
    
    protected function setDefaultVars(){

        $method = 'setDefaultVars()';

        $this->debug->tryingToSet('fields', $method);
        $fields = $this->getAllFields();
        
        foreach($fields as $f):
            $this->{$f} = false;        
        endforeach;        
    }
    

}


?>