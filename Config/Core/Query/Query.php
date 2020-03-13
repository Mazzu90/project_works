<?

namespace Config\Core\Query;

use Config\ComponentsMap;
use Config\Utils\Connection;
use Config\Utils\Util;

class Query
{

    private static function getSelectReadyFields($obj)
    {
        $formatted_fields = array();
        if (isset($obj->show_fields)):
            print_r($obj->show_fields);
            foreach ($obj->show_fields as $prop)
                $formatted_fields[] = $obj->{$prop}->getFieldForSelect();
        else:
            echo '<br>$showFields not setted';
        endif;

        return $formatted_fields;
    }


    private static function getSelect($obj)
    {
        $select = ' SELECT';
        $select_fields = self::getSelectReadyFields($obj);

        foreach ($select_fields as $f):
            $select .= ' ' . $f . ',';
        endforeach;

        $select = rtrim($select, ',');
        $select .= ' FROM ' . $obj->table;

        return $select;
    }


    private static function getConditions($obj)
    {
        $where_fields = array_merge($obj->show_fields, $obj->search_fields);
        $and = false;
        $where = ' WHERE ';
        $join = '';

        foreach ($where_fields as $var):
            if ($obj->{$var} instanceOf QueryField):

                if ($where != ' WHERE ')
                    $and = true;

                $where .= $obj->{$var}->getCondition($and);

                if ($obj->{$var} instanceOf Join)
                    $join .= $obj->{$var}->getJoinCondition();

            endif;
        endforeach;

        if ($where === ' WHERE ') $where = '';
        return $join . $where;
    }


    private static function getOrderBy($obj)
    {
        if (Util::isValid($obj->query_parameters['order']))
            return ' ORDER BY ' . $obj->query_parameters['order'];
        else
            return '';

    }


    private static function getLimit($obj)
    {
        if (Util::isValid($obj->query_parameters['limit']))
            return ' LIMIT ' . $obj->query_parameters['limit'];
        else
            return '';
    }


    private static function getOffset($obj)
    {
        if (Util::isValid($obj->query_parameters['offset']))
            return ' OFFSET ' . $obj->query_parameters['offset'];
        else
            return '';
    }


    private static function getQuery($obj)
    {
        $query = self::getSelect($obj) . self::getConditions($obj) . self::getOrderBy($obj) . self::getLimit($obj) . self::getOffset($obj);
        echo $query;
        return $query;
    }


    private static function executeQuery($obj)
    {
        $connection = new Connection();
        $connection->open();
        $result = mysql_query(mysql_real_escape_string(self::getQuery($obj)));
        $connection->close();

        return $result;
    }


    public static function getList($obj)
    {
        $list = array();
        $result = self::executeQuery($obj);

        if ($obj->return_idx === ComponentsMap::return_single_field_idx):

            while ($row = mysql_fetch_array($result)):
                $list = $row[0];
            endwhile;

        elseif ($obj->return_idx === ComponentsMap::return_array_idx):

            while ($row = mysql_fetch_assoc($result)):

                $prepared_row = array();

                foreach ($row as $field)
                    $prepared_row[$field] = $row[$field];

                $list[] = $prepared_row;

            endwhile;

        else:

            $object_class = $obj->return_idx === ComponentsMap::return_dynamic_obj_idx ? 'Config\Components\Dynamic' : get_class($obj);

            while ($row = mysql_fetch_object($result, $object_class)):
                $list[] = $row;
            endwhile;

        endif;

        return $list;
    }


}
