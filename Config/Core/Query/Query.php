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
            foreach ($obj->show_fields as $prop):
                    $formatted_fields[] = $obj->{$prop}->getFieldForSelect();
            endforeach;
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


    private static function getClauses($obj)
    {
        if($obj->filter):
            $join = '';
            $where = ' WHERE ';
            $and = false;
            $filters = array_merge($obj->show_fields, $obj->search_fields);

            foreach ($filters as $var):
                if ($obj->{$var} instanceOf QueryField):
                    if ($obj->{$var} instanceOf Join):
                        $join .= $obj->{$var}->getJoinClause();
                    endif;
                    if ($where != ' WHERE '):
                        $and = true;
                    endif;
                    $where .= $obj->{$var}->getWhereClause($and);
                endif;
            endforeach;
            if ($where === ' WHERE ') $where = '';
            return $join . $where;
        else:
            return '';
        endif;
    }


    private static function getOrderBy($obj)
    {
        if (Util::isValid($obj->query_settings['order']))
            return ' ORDER BY ' . $obj->query_settingss['order'];
        else
            return '';
    }


    private static function getLimit($obj)
    {
        if (Util::isValid($obj->query_settings['limit']))
            return ' LIMIT ' . $obj->query_settings['limit'];
        else
            return '';
    }


    private static function getOffset($obj)
    {
        if (Util::isValid($obj->query_settings['offset']))
            return ' OFFSET ' . $obj->query_settings['offset'];
        else
            return '';
    }


    private static function getQuery($obj)
    {
        $query = self::getSelect($obj) . self::getClauses($obj) . self::getOrderBy($obj) . self::getLimit($obj) . self::getOffset($obj);
        echo $query;
        return $query;
    }


    private static function executeQuery($obj)
    {
        $connection = new Connection();
        $result = mysql_query(self::getQuery($obj));
        $connection->__destruct();
        return $result;
    }


    public static function getList($obj)
    {
        $list = array();
        $result = self::executeQuery($obj);

        switch ($obj->return_idx):

            case ComponentsMap::return_assoc_array_idx:
                while ($row = mysql_fetch_assoc($result)):
                    $list[] = $row;
                endwhile;
                break;

            case ComponentsMap::return_num_array_idx:
                while ($row = mysql_fetch_row($result)):
                    $list[] = $row;
                endwhile;
                break;

            case ComponentsMap::return_both_array_idx:
                while ($row = mysql_fetch_array($result)):
                    $list[] = $row;
                endwhile;
                break;

            case ComponentsMap::return_dynamic_obj_idx:
                while ($row = mysql_fetch_object($result, 'Config\Components\Dynamic')):
                    $list[] = $row;
                endwhile;
                break;

            case ComponentsMap::return_single_field_idx:
                while ($row = mysql_fetch_row($result)):
                    $list = $row[0];
                endwhile;
                break;

            default:
                while ($row = mysql_fetch_object($result, get_class($obj))):
                    $list[] = $row;
                endwhile;
                break;

        endswitch;
        return $list;
    }


}
