<?

/*include('include_dir.php');
include('veicolo.php');*/



/**
 * Ricerca
 * 
 * @package 
 * @author LiveLong
 * @copyright 2019
 * @version $Id$
 * @access public
 */
class Ricerca{
    
        public function __construct() {
            //echo "myClass init'ed successfuly!!!";
        }    
    
    public $parametri;
    public $query;
   
    
    
    /*Questo metodo crea la condizione WEHRE per QUERY SQL. Richiede In ingresso un array così strutturato:
    
        $parametri[$i] = array(        
            'field' = 'make',
            'value'= '125',
            'operator' = '='       
        )
        
    Se si necessita di un range (ad esempio prezzo) il parametro va impostato in questa maniera:
    
        $parametri[$i] = array(        
            'field' = 'prezzo',   
            'value'= 'range',       
        )
    
    Una volta che il metodo ricosce 'range' come valore, va a cercare i valori nei due parametri successivi, in quest'ordine:
    
        $parametri[$i+1] = array (        
            'field'  = 'prezzoDa', ()OPZIONALE
            'value' = ' 1000 '      
        )
        
        $parametri[$i+2] = array (        
            'field'  = 'prezzoA',  ->OPZIONALE
            'value' = ' 5000 '      
        )   
    */
    public function createSqlWhereFromArray($parametri){
        
        
        $p = $parametri;
        $where = ' WHERE ';
        $where_vuoto = ' WHERE ';        
        $and='';
        $n = count($parametri);
        
        for($i=0; $i <= $n; $i++)
        {   
            
            echo '----$i -------'.$i.'------';
            if(isset($p[$i]))
            {   
                if($i>0)$and= ' AND ';
                
                echo '+++++++FIELD+++++'.$p[$i]['field'].'+++++++VALUE+++++'.$p[$i]['value'];
                
                if($p[$i]['value'] == 'range')
                {   
                    $field = $p[$i]['field'];
                    $da=(array_key_exists('da', $p[$i]))? $p[$i]['da'] : null;
                    $a =(array_key_exists('a', $p[$i]))?  $p[$i]['a'] : null;
                    
                    
                    
                    echo '**********Da query:*****   '.$da.' **************a query *******'.$a.'**********';
                    
                    if(isset($da) && !isset($a))
                    {
                        $where.=$and.$field.' >= "'.$da.'"';
                    }
                        elseif(!isset($da) && isset($a))
                        {
                            $where.=$and.$field.' <= "'.$a.'"';
                        } 
                            else
                                $where.=$and.$field.' BETWEEN "'.$da.'" AND "'.$a.'"';                
                
                }
                    elseif($p[$i]['value'] == 'pool'){
                        
                        if(isset($p[$i]['pool'])){                    
                            $where.=$and.$p[$i]['field'].' IN '.$p[$i]['pool'];                 
                        }
                    }
                
                        else
                            $where.=$and.$p[$i]['field'].' = "'.$p[$i]['value'].'"';           
            };                     
        }
        
        if($where_vuoto == $where)return '';
        else 
            return $where;        
    }
    
    public function createWhereArrayFromHttpRequest(){
        
        // = isset($_POST)? '_POST' : isset($_GET)? '_GET' : false;
        
        //if($request==false)return false;
        
        $where = array();
        $i=0;     
        
        print_r($_GET);   
        foreach($_GET as $key => $value){
          
            //preg_match_all("/(\d+)/", $value,$match );
            //if($value != '' || is_numeric($value) && $value > 0 || strlen($value)>0 || $value != null || $value != false || $match != '-1' || $match != '');  
            if(!empty($_GET[$key]) && ( $value>0 && is_numeric($value))  )
            { 
                if($key == 'limit')continue;
                if($key == 'offset')continue;
                if($key == 'order')continue;
                if($key == 'start')continue;
                if($key == 'pagina')continue;                       
                
                $substr_da = (substr($key, -2) == 'Da')? true : false;
                $substr_a = (substr($key, -1) == 'A')? true : false;
                echo "da: ".var_export($substr_da)." a : ".var_export($substr_a);
                
                if($substr_a || $substr_da)
                {   
                    echo('        --------key--------       '.$key.'   ----------     value -----------    '.$value);
                    $key= ($substr_da)? substr($key, 0, -2) : ($substr_a) ? substr($key, 0, -2) : '' ;
                  
                    
                    $da=(isset($_GET[($key.'Da')]) && $_GET[($key.'Da')]>0)?: false;
                    $a= (isset($_GET[($key.'A')]) && $_GET[($key.'A')]>0)?: false;
                      echo 'KEY: '.$key.'  DA:'.var_export($da).' A: '.var_export($a);
                     
                    if(isset($_GET[($key.'Da')]) && $_GET[($key.'Da')]>0 && $key == 'registration_date') $_GET[($key.'Da')] = $_GET[($key.'Da')].'-1-1';   
                    if(isset($_GET[($key.'A')]) && $_GET[($key.'A')]>0 && $key == 'registration_date') $_GET[($key.'A')] = $_GET[($key.'A')].'-12-31';
                      
                    if($da != false && $a != false){                    
                        $where[$i]= array('field'=>$key, 'value'=>'range', 'da'=>$_GET[($key.'Da')], 'a'=>$_GET[($key.'A')]);
                        unset($_GET[($key.'Da')]);
                        unset($_GET[($key.'A')]);
                    }
                        elseif($da != false){
                            
                            echo ('$da!=false');
                            $where[$i]= array('field'=>$key, 'value'=>'range', 'da'=>$_GET[($key.'Da')]);
                            unset($_GET[($key.'Da')]);
                        }
                            elseif($a != false){
                                $where[$i]= array('field'=>$key, 'value'=>'range', 'a'=>$_GET[($key.'A')]);
                                unset($_GET[($key.'A')]);
                            }               
                }
                
                else
                {
                    if($key == 'gearbox'){
                        switch($value){
                            case 1: $value='Automatico';
                                    break;
                            case 2: $value='Manuale';
                                    break;
                            case 3: $value='Sequenziale';
                                    break;
                            default:break;
                            
                        }
                    }
                    $where[$i] = array("field" => $key, "value" => $value); 
                } 
            }  
            
            if(!empty($where[$i]))$i++;       
        }
        
        //var_dump($where);
        return $where;       
    }    
    
    /*
    
    ESEMPIO ARRAY 
    
    $parametri = array(
        
        'table' => 'ciao',
        'fields' => array(        
            'id',
            'make',
            ...       
            ), 
        'where' => array(        
            0 => array(            
                name => 'registration_date',
                value => ' 2000 ',
                operator => '<'           
            ),
        'limit' => 10;
        'offset' => 30;
        'order by' => 'prezzo DESC';
        'join' => array(
            'type' => 'INNER'; (LEFT/RIGHT/FULL)       
            'table' => 'img';
            'condition' => 'id_oggetto = x';  
            )             
        )    
    )   
    */
    
    function createSelectQuery($parametri = false){
        
        $p = (!'$parametri')?: $this->parametri;
        
        //SE MANCA LA TABELLA LA FUNZIONE SI INTERROMPE
        
        if(array_key_exists('table', $p) && $p['table'] != '') $t = $p['table'];
            else return false;
        
        $query = ' SELECT ';       
        
        //SETTO I CAMPI 
        
        $fields = '';        
        if(array_key_exists('fields', $p))
        {  
            $f = $p['fields'];
            $n = count($f);   
            
            for($i=0; $i<$n; $i++)
            {                
                $fields .=' '. $t.'.'.$f[$i].' ';
                if($i<$n-1)$fields.=',';                
            }
         } 
         else 
            $fields = ' * ';
        
        $from = ' FROM '.$t;
        
        $w = (array_key_exists('where', $p))? $p['where']: '';
        $where=$this->createSqlWhereFromArray($w);
        
        
        $join = '';
        /*if ((array_key_exists('join', $p))){
            
            foreach($p['join'] as  $j){
                $join .= ' '.$j['type'].' JOIN '.$j['table'].' AS '.$j['as'].' ON ('.$j['condition'].')';
            }
        }*/
        
        
        $limit=' limit 10 ';//(array_key_exists('limit', $p))?' LIMIT '.$p['limit'] :'';
        
        $offset=(array_key_exists('offset', $p))? ' OFFSET '.$p['offset'] :'';
        
        $order = (array_key_exists('order', $p))? ' ORDER BY '.$p['order'] : '';
        
        $query .= $fields .= $from .= $join .= $where .= $order .= $limit .= $offset;
        
        $this->query = $query;
        return $query;      
    }
    
    function estraiDati($query=false){
        
        if(!$this->query) $this->createSelectQuery();
        $q=(!$query)? $this->query : $query;
        
        //$q= 'SELECT veicoli.id , veicoli.make , veicoli.model , veicoli.version , veicoli.img , veicoli.km , veicoli.registration_date , veicoli.alimentazione , veicoli.kwatt , veicoli.gearbox , veicoli.colore , veicoli.interni , veicoli.telaio , veicoli.prezzo , veicoli.neopatentati FROM veicoli WHERE id_marca="243"';
        
        
        echo ('***estrai dati***'.$q);//$this->query);
        
        $grafica = new Tgrafica(false, false);
        $result= mysql_query($q);
        $fields = $this->parametri['fields'];
        
        //echo("***RESULTQUERY****");
        $result2= mysql_fetch_assoc($result);
        //var_dump($result2);
        
        
        if(array_key_exists('class', $this->parametri))
        {   
            echo 'oggetto!!! count:'.mysql_num_rows($result);
            $dati=array();
            $classe = $this->parametri['class'];
           // echo 'classe:+++++++++++++++++++++++++++ '.$this->parametri['class']; 
           // var_dump($this->parametri);
            
            if (mysql_num_rows($result)==1)
            {                
                $oggetto = new $classe;
                foreach($fields as $f)
                {
                    $oggetto->{$f} = $result2[$f];                            
                }
                
                $dati[]=$oggetto;
            }else
            {                          
                while ($row=mysql_fetch_assoc($result))
                { 
                    //echo'WHILE';
                    $oggetto = new $classe;
                    foreach($fields as $f)
                    {
                        $oggetto->{$f} = $row[$f];                            
                    }
                    
                    $dati[] =$oggetto;
                }          
            }
        }
        else
        {      
            echo 'array!!!';  
            while ($row=mysql_fetch_assoc($result))
            {   
                
    			foreach($fields as  $f) 
                {           
                    $dato[$f]=$row[$f];
                }
                
                $dati[]=$dato;
           } 
        }
       
       $this->parametri = false;
       $this->query = false;
       return $dati;  
    }



    function getDataFromObject($object){

        $where = array();
        $join = '';
        $i=0;     
          echo('------------------------------$object-------------------------------------------------------------'); 
        
        
        
        $o=clone($object);
        //print_r($o);
        $vars = Util::getObjectVar($o);
           
        //echo('------------------------------$vars-------------------------------------------------------------');   
           
        //print_r($vars);   
           
        foreach($vars as $var)
        {   //$string = (isset($o->{$var}) && $o->$var!= '')? $o->{$var}: 'unset';  
            //echo '         ['.$var.' : '.$string.' ]';
            //echo 'reg_D: '.$o->registration_dateDa;
            if( substr($var,-2) == 'Da'|| substr($var,-1) =='A' || substr($var, -4) == 'pool' || substr($var, -5) == 'multi' || substr($var, -5) == 'param' ) {
                    //echo ' <-skip ';
                    continue;
                
                }           
            if( isset($o->{$var}) && ( (int)$o->{$var} > 0) || !is_numeric($o->{$var}) && $o->{$var} != '' )//
            {                
                //echo ' enter  ';
                
                if($o->{$var} == 'range')
                {
                    
                    //echo 'ramge';
                    $da=(isset($o->{$var.'Da'}) && $o->{$var.'Da'} >0 )? $o->{$var.'Da'} : false;
                    $a= (isset($o->{$var.'A'})  && $o->{$var.'A'}  >0 )? $o->{$var.'A'}  : false;
                    //$var= isset($da)? substr($var, 0, -2) : isset($a) ? substr($var, 0, -1) : '' ;
                    
                    if($da != false && $a != false)
                    {                    
                        $where[$i]= array('field'=>$var, 'value'=>'range', 'da'=>$da, 'a'=>$a );
                        /*unset($o->{$var.'Da'});
                        //echo 'unsetted: '.$var.'Da';*/
                        unset($o->{$var.'A'});                        
                        
                    } 
                        elseif($da != false)
                        {                            
                            //echo ('$da!=false');
                            $where[$i]= array('field'=>$var, 'value'=>'range', 'da'=>$da);
                            unset($o->{$var.'Da'});
                            //echo 'unsetted: '.$var.'Da';;
                        }
                            elseif($a != false)
                            {
                                $where[$i]= array('field'=>$var, 'value'=>'range', 'a'=>$a);
                                unset($o->{$var.'A'});
                       
                            }  
                            
                                               
                }
                    
                    
                    elseif($o->{$var} == 'pool')
                    {
                        
                        if(isset($o->{$var.'_pool'}) && $o->{$var.'_pool'} != '')
                            $where[$i]=array('field'=>$var, 'value'=>'pool', 'pool'=>$o->{$var.'_pool'});
                            unset($o->{$var.'_pool'});                        
                    }
                        
                        elseif($o->{$var} == 'multi-ext')
                        {
                           /* echo'--------------MULTI--------';
                            var_dump($o->{$var.'_multi'});
                           if(isset($o->{$var.'_multi'}) && $o->{$var.'_multi'} != ''){                            
                               
                               $condition = (isset($o->{$var.'_param'})) ? $o->{$var.'_param'}['extra_conditions'] : '';
                               $i=0;
                               
                               foreach($o->{$var.'_multi'} as $opt){
                                
                                    
                                    $and= ($condition != '' && $i==0) ? ' AND ' : '';
                                    $or=($i>0)? ' OR ' : '';  
                                    $condition.=  $and.$or.' '.$var.'.'.$o->{$var.'_param'}['column'].'  =  '.$opt ;
                                    $i++;
                                
                               }  */                
                                    
                                            
                            
                           if(isset($o->{$var.'_multi'}) && $o->{$var.'_multi'} != '')
                           {                                 
                                $i = 0 ;
                                foreach($o->{$var.'_multi'} as $value)
                                {   
                                    $condition='';
                                    $objTab = $o->getTable();
                                    $joinTab = $var.++$i;  
                                    $joinTabColumn =$o->{$var.'_param'}['column'];             
                                    
                                    if(isset($o->{$var.'_param'}))
                                    {                                    
                                        $objTabField = $o->{$var.'_param'}['extra_conditions']['obj-field'];
                                        $joinTabField = $o->{$var.'_param'}['extra_conditions']['join-field'];                                    
                                        $condition  .=  $objTab.'.'.$objTabField.' = '.$joinTab.'.'.$joinTabField;
                                    }                                    
                                   
                                    $and = ($condition != '')? ' AND ' : '';
                                    $condition.=  $and.' '.$joinTab.'.'.$joinTabColumn.'  =  '.$value ;  
                                    $join[] = array('type'=>' INNER ', 'table'=>$var, 'as'=>$joinTab , 'condition'=>$condition);
                                }                                   
                            }                             
                        }     
                        
                                            
                            else
                            {            
                                if(isset($o->{$var}))$where[$i] = array("field" => $var, "value" => $o->{$var}); 
                            }   
                    
            }
                      
            
            if(!empty($where[$i]))$i++;       
        }       
        
        var_dump($where);
        $this->parametri['fields'] = Util::getObjectVar(new Veicolo); 
        $this->parametri['table'] = $o->getTable();
        $this->parametri['where'] = $where;
        $this->parametri['order'] = 'prezzo ASC';
        //$this->parametri['limit'] = '10';
        $this->parametri['class'] = 'Veicolo';
        $this->parametri['join'] = $join;
        
        $elenco = $this->estraiDati();
        
        echo('Numero veicoli: '.count($elenco));
        
        return $elenco;    
    }    
}
 
?>