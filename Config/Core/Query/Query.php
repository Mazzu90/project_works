<?

namespace Config\Core\Query;

use Config\ComponentsMap;
use Config\Core\Query\Basic;
use Config\Core\Query\Join;
use Config\Core\Query\Pool;
use Config\Core\Query\Range;
use Config\Core\Query\PatternMatch;
use Config\Core\Query\QueryField;
use Config\Core\Query\Count;
use Config\Core\Distinct;
use Config\Utils\Util;
use Config\Utils\Data;
use Config\Utils\Connection;
use Config\Core\Entities\Debugger;


class Query{
    
    public $type;
    public $conditioning_fields;
    public $select_fields;
    public $select = ' SELECT ';
    public $where = ' WHERE ';
    public $limit;
    public $join = '';
    public $orderBy;
    public $offset;  
    public $object;
    public $connection;
    public $object_class;
    public $return_idx;
    
    private $debug;
    
    public function __construct($obj, $return_idx) {
        
        $this->debug = new Debugger("QUERY");
        $method= '__construct()';
        $this->debug->constructing();
               
        $this->debug->tryingToSet('this->table(prop)', $method);
        $this->table = $obj->table;
        
        $this->debug->tryingToSet('this->searchFields', $method);
        $this->conditioning_fields = $obj->getAllFields();
        
        $this->debug->tryingToSet('this->selectFields', $method);
        $this->select_fields = $obj->getShowFields();
        
        $this->debug->tryingToSet('this->select', $method);
        $this->select = $this->setSelect();
        
        $this->debug->tryingToSet('this->object', $method);
        $this->object = $obj; 
        
        $this->debug->tryingToSet('this->objectClass', $method);
        $this->object_class = $return_idx === ComponentsMap::return_dynamic_obj_idx ? 'Config\Components\Dynamic' : $obj->class;
        
        $this->debug->tryingToCreate('Conditions', $method, 'setConditions()');
        $this->setConditions($obj);

        $this->return_idx = $return_idx;

        $this->connection = new Connection();
        
        $this->connection->open();  

        
        $this->debug->constructed();       
    }   
    
    public function __destruct(){
        $this->connection->close();
    }

    public function chooseClass($obj){

        foreach ($obj->show_fields as $field):
            if($obj->{$field} instanceof Distinct || $obj->{$field} instanceof Count)
                return 'Config\Components\Dynamic';
        endforeach;

        return $this->object->class;
    }
    
    public function setConditions($obj){
        
        $method = 'setConditions()';
        $this->debug->tryingToCreate('Where', $method, $method);
        $and = false;
        
        foreach($this->conditioning_fields as $var):
            
            $this->debug->generic("checking: ".$var);

            if($obj->{$var} instanceOf QueryField):
                $this->debug->generic($var." instanceOf QueryField");

                if($this->where != ' WHERE ') 
                    $and = true;

                $this->debug->generic('Where:'.$this->where );
                $this->where .= $obj->{$var}->getCondition($and);
                
                if($obj->{$var} instanceOf Join)
                    $this->join .= $obj->{$var}->getJoinCondition();
            
            endif;   
        
        endforeach;
        
        $this->debug->generic("where: ".$this->where);
        if ($this->where == ' WHERE ') $this->where = '';        
    }
    
    public function setSelect(){
        
        $method = 'setSelect()';
        $this->debug->tryingToSet("select", $method);
        $select = ' SELECT';
        
        foreach($this->select_fields as $f):
            $select .= ' '.$f.',';
            $this->debug->generic($select);       
        endforeach;
        
        $select = rtrim($select, ',');
        $select.= ' FROM '.$this->table;
        
        $this->debug->generic($select);      
        
        return $select; 
    } 
    
    public function getLimit(){
        
        if(Util::isValid($this->object->query_limit))
            return ' LIMIT '.$this->object->query_limit;
        else 
            return '';
    }
    
    public function getOffset(){
        
        if(Util::isValid($this->object->query_offset))
            return ' OFFSET '.$this->object->query_offset;
        else 
            return '';
    }
    
    public function getOrderBy(){
        if (Util::isValid($this->object->query_orderBy))
            return ' ORDER BY '.$this->object->query_orderBy;
        else    
            return '';
        
    }
    public function getQuery(){
        
        $method = 'getQuery()';
        $this->debug->tryingToSet('query', $method); 
        
        return $this->select.$this->join.$this->where.$this->getOrderBy().$this->getLimit().$this->getOffset();
    }
    
    
    public function executeQuery(){

        $method = 'executeQuery()';

        $this->debug->tryingToCreate('Query', $method, 'getQuery()');
        $this->debug->generic('Query: '.$this->getQuery());
        $this->debug->tryingToSet("result", $method);
        $result= mysql_query($this->getQuery());
        //var_dump($result);
        return $result;
    }
    
    public function getObjectList(){
        $method = 'getObjectList()';

        $list = array();

        $this->debug->tryingToCreate("result", $method, 'executeQuery()');
        $result = $this->executeQuery();

        $this->debug->generic("this->object->class: ".$this->object_class);

        if($this->return_idx === ComponentsMap::return_single_field_idx):

            while($row = mysql_fetch_array($result)):
                $this->debug->tryingToSet('list[]', $method);
                $list = $row[0];
                $this->debug->generic('list[] setted');
            endwhile;

        else:

            while($row = mysql_fetch_object($result, $this->object_class)):
                $this->debug->tryingToSet('objectList[]', $method);
                $list[] = $row;
                $this->debug->generic('objectList[] setted');
            endwhile;

        endif;

        $this->debug->generic("listing complete");
        //print_r($objectList);
        $this->__destruct();
        
        return $list;
    }
    
}
