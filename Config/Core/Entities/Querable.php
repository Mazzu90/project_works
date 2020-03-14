<?
namespace Config\Core\Entities;

use Config\Core\Query\Count;
use Config\Core\Query\Distinct;
use Config\Core\Query\Query;
use Config\Core\Query\Basic;
use Config\Core\Query\Range;
use Config\Core\Query\Pool;
use Config\Core\Query\QueryField;
use Config\ComponentsMap;


/**
 * Class Querable
 * @package Config\Core\Entities
 */
abstract class Querable{

    private static $class;

    private static function getNewInstance()
    {
        $full_path_class = get_called_class();
        $obj = new $full_path_class;
        $obj->class = end(explode('\\', $full_path_class));
        self::$class = $obj->class; 
        $obj->table = self::getTable();
        $obj->idx = constant('Config\ComponentsMap::'.strtolower($obj->class).'_idx');

        return $obj;
    }


    public static function getList()
    {
        $obj = self::getNewInstance();
        $obj->show_fields = self::getShowFields();
        $obj->search_fields = self::getSearchFields();
        $obj = self::setFieldsFromRequest($obj);
        $obj->query_settings = self::getQuerySettings();
        $obj->return_idx = ComponentsMap::return_current_obj_idx;
        $obj->filter = true;

        return Query::getList($obj);
    }


    public static function getListBy($field, $value)
    {
        $obj = self::getNewInstance();

        $obj->show_fields = self::getShowFields();
        $obj->search_fields = self::getSearchFields();
        $obj = self::setBlankQuerable($obj);
        $obj->{$field}->value = $value;
        $obj->return_idx = ComponentsMap::return_current_obj_idx;

        return Query::getList($obj);
    }


    public static function getDistinct($fields, $order_by = false)
    {
        $obj = self::getNewInstance();

        if(is_array($fields)):
            $count = count($fields);
            for($i = 0; $i < $count; $i++):
                if($i === 0):
                    $obj->{$fields[$i]} = new Distinct($obj->table, $fields[$i]);
                else:
                    $obj->{$fields[$i]} = new Basic($obj->table, $fields[$i]);
                endif;
                $obj->show_fields[] = $fields[$i];
            endfor;
        else:
            $obj->{$fields} = new Distinct($obj->table, $fields);
            $obj->show_fields[] = $fields;
        endif;

        $obj->return_idx = ComponentsMap::return_num_array_idx;

        if($order_by)
            $obj->query_parameters['order'] = $order_by;

        return Query::getList($obj);
    }


    public static function getCount($field)
    {
        $obj = self::getNewInstance();

        $alias = 'count_'.$field;
        $obj->{$alias} = new Count($obj->table, 'id', $alias);
        $obj->show_fields[] = $alias;
        $obj->return_idx = ComponentsMap::return_single_field_idx;

        return Query::getList($obj);
    }


    protected static function setFieldsFromRequest($obj)
    {
        $properties = array_merge($obj->show_fields, $obj->search_fields);

        foreach($properties as $prop):
            if(!(isset($obj->{$prop}))  || ($obj->{$prop} instanceOf QueryField)):
                if(isset($_REQUEST[$obj->idx]['range'][$prop])):
                    $obj->{$prop} = new Range($obj->table, $prop);
                    $obj->{$prop}->setValueFromHttpRequest($obj->idx);
                elseif(isset($_REQUEST[$obj->idx]['pool'][$prop])):
                    $obj->{$prop} = new Pool($obj->table, $prop);
                    $obj->{$prop}->setValueFromHttpRequest($obj->idx);
                else:
                    $obj->{$prop} = new Basic($obj->table, $prop);
                    $obj->{$prop}->setValueFromHttpRequest($obj->idx);
                endif;
            endif;
        endforeach;

        return $obj;
    }

    protected static function setBlankQuerable($obj)
    {
        $properties = array_merge($obj->show_fields, $obj->search_fields);

        foreach($properties as $prop):
            if(!(isset($obj->{$prop}))  || ($obj->{$prop} instanceOf QueryField))
                    $obj->{$prop} = new Basic($obj->table, $prop);
        endforeach;

        return $obj;
    }


    /**
     * @return strin With the name of the class, it must be implemented in the Components::Map $components array
     */
    protected static function getTable()
    {
        if(isset(ComponentsMap::$components[self::$class]['table']))
            return  ComponentsMap::$components[self::$class]['table'];
    }


    protected static function getQuerySettings()
    {
        if(isset(ComponentsMap::$components[self::$class]['query_parameters']))
            return  ComponentsMap::$components[self::$class]['query_parameters'];
    }


    protected static function getShowFields()
    {
        if(isset(ComponentsMap::$components[self::$class]['show_fields']))
           return ComponentsMap::$components[self::$class]['show_fields'];
    }


    protected static function getSearchFields()
    {
        if(isset(ComponentsMap::$components[self::$class]['search_fields']))
            return ComponentsMap::$components[self::$class]['search_fields'];
    }



}
