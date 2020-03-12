<?php

namespace Config\Components;

use Config\Core\Entities\Component;
use Config\Core\Entities\Debugger;
use Config\Core\Query\Pool;
use Config\Core\Query\Basic;
use Config\Core\Query\Count;
use Config\Core\Query\Distinct;
use Config\Utils\Util;
use Config\Utils\Data;
use Config\Properties;
use Config\ComponentsMap;


class Veicolo extends Component
{    
    
    private $debug;

    //USO INTERNO
    private $fuelIndex = array(
        1 => 'Benzina',
        2 => 'Diesel',
        3 => 'Elettrica/Benzina',
        4 => 'Benzina/GPL',
        5 => 'Benzina/Metano',
        6 => 'Elettrica'
    );
    
    //USO INTERNO
    private $bodyIndex = array(
        1 => '2/3-Porte',
        2 => '4/5-Porte',
        3 => 'XXXXX',
        4 => 'WWWWW',
        5 => 'Cabrio',
        6 => 'Coupè',
        7 => 'FFFFF',
        8 => 'DDDDD',
        9 => 'ZZZZZZ',
        10 => 'Fuoristrada',
        11 => 'Station Wagon',
        12 => 'Transporter',
        13 => 'Monovolume'
    );

    public function __construct($constructor_idx = -1, $extra_param = false)
    {   
        $method = ('__construct()');
        $this->debug = new Debugger('VEICOLO');
        $this->debug->constructing();

        $this->debug->generic("IDX: ".$constructor_idx);

        switch ($constructor_idx):

            case ComponentsMap::search_idx :

                parent::__construct();
                $this->id = new Pool($this->getTable(), 'id');
                $this->id->value = $this::getIdPoolByOptionals();
                break;

            case ComponentsMap::count_search_idx :

                parent::__construct(ComponentsMap::custom_var_idx);


                $alias = 'count_'.$extra_param;
                $this->{$alias} = new Count($this->table, 'id', $alias);
                $this->show_fields[] = $alias;
                break;

            case ComponentsMap::distinct_search_idx:

                parent::__construct(ComponentsMap::custom_var_idx);

                if(is_array($extra_param)):

                    $count = count($extra_param);

                    for($i = 0; $i < $count; $i++):

                        $alias = "field_$i";

                        if($i === 0):
                            $this->{$alias} = new Distinct($this->table, $extra_param[$i], $alias);
                        else:
                            $this->{$alias} = new Basic($this->table, $extra_param[$i], $alias);
                        endif;

                        $this->show_fields[] = $alias;

                    endfor;

                else:

                    $this->{$extra_param} = new Distinct($this->table, $extra_param);
                    $this->show_fields[] = $extra_param;

                endif;

                break;

            default:

                $this->debug->tryingToConstruct('Component', $method );
                parent::__construct();

            break;

        endswitch;

        echo 'var to unset: '.print_r($this->suggested_unset_order);
        $this->debug->constructed();           
    }


    public static function getDistinct($fields, $orderBy = false){

        $return_idx = is_array($fields) ? ComponentsMap::return_dynamic_obj_idx : ComponentsMap::return_single_idx;
        $veicolo = new Veicolo(ComponentsMap::distinct_search_idx, $fields);
        if($orderBy)
            $veicolo->query_orderBy = $orderBy;
        $list = $veicolo->getList($return_idx);
        return $list;
    }


    public static function getCount($field){

        $veicolo = new Veicolo(ComponentsMap::count_search_idx, $field);
        return $veicolo->getList(ComponentsMap::return_single_field_idx);

    }

    //USO INTERNO
    public function fuelEncode($fuel)
    {
        return array_search($fuel, $this->fuelIndex);
    }
    
    //USO INTERNO
    public function fuelDecode($codiceFuel)
    {
        // echo '<br/> fuel index:'.$this->fuelIndex[$codiceFuel];
        return $this->fuelIndex[$codiceFuel];
    }
    
    //USO INTERNO
    public function bodyEncode($fuel)
    {
        return array_search($fuel, $this->bodyIndex);
    }
    
    //USO INTERNO
    public function bodyDecode($codiceBody)
    {
        return $this->bodyIndex[$codiceBody];
    }
    
    //RICHIESTO DA HTMLGENERATOR
    public function prepareFields()
    {        
        $undefined = '--';
        
        $this->print_titolo = ($this->make && $this->model) ? $this->make.' '.$this->model : $undefined;
        $this->print_sottotitolo = ($this->version) ?: $undefined;
        $this->print_id = ($this->id) ?: $undefined;
        //$this->print_anno = (substr($this->registration_date, 0, 2)>0) ? Data::getYear($this->registration_date) : $undefined;
        $this->print_anno = (substr($this->registration_date, 0, 2)>0) ? 'ciao' : $undefined;
        $this->print_registration_date= (substr($this->registration_date, 0, 2)>0) ? Util::prepareDate($this->registration_date) : $undefined;
        $this->print_gearbox = ($this->gearbox)?: $undefined;
        $this->print_colore = ($this->colore)?: $undefined;
        $this->print_solo_kw = ($this->kwatt)? $this->kwatt.'kW' : $undefined;
        $this->print_kwatt= ($this->kwatt && $this->kwatt>0)? $this->kwatt.'kW ('.number_format(($this->kwatt*1.35962),0,",",".").' CV)' : $undefined;
        $this->print_emission_class = ($this->emission_class)? 'Euro '.$this->emission_class : $undefined;
        $this->print_img = ($this->img!='')? $this->img : Properties::base_url.'images/slide_home/slide01.jpg';
        $this->print_km = ($this->km > 0) ? number_format($this->km, 0, ",", ".").' km' : $undefined;
        $this->print_alimentazione = ($this->alimentazione) ? $this->fuelDecode($this->alimentazione) : $undefined;
        $this->print_prezzo = ($this->prezzo > 0) ? number_format($this->prezzo,0,',','.') : $undefined;
        $this->print_interni = ($this->interni) ?: $undefined;        
        $this->print_url = $this->setUrl();
    } 
    
    //USO INTERNO
    private function getIdPoolByOptionals()
    {
        if (isset($_REQUEST['optional'])) :
            $optional = new Optional(true);
            $result = $optional->getList();
            $idPool = array();
            foreach ($result as $opt) :
                $idPool[] = $opt->id_veicolo;
            endforeach;
            $idPoolString = '(' . implode(', ', $idPool) . ' )';
            if ($idPoolString != '( )') :
                return $idPoolString;
            else :
                return NULL;
            endif;                        
        endif;
        return NULL;
    }
    
    //RICHIESTO DA HTMLGENERATOR
    public function getSuggestedList($elencoAuto = array())
    {
        if (Util::isValid($this->prezzo->min))
            $this->prezzo->min *= 0.50;
        if (Util::isValid($this->prezzo->max))
            $this->prezzo->max *= 1.50;

        /*$varToUnset = array(
            0 => 'id_modello',
            1 => 'id_marca',
            2 => 'id',
            3 => 'registration_date',
            4 => 'km',
            5 => 'alimentazione'
        );*/

        $varToUnset = $this->suggested_unset_order;

        $rangeParam = 'min';
        $try = false;        
        $i = 0;
        
        while (count($elencoAuto) < 1) :
            if ($i < count($varToUnset)) :
                if (isset($this->{$varToUnset[$i]})) :
                    echo '<br/> trying to unset Field: ' . $varToUnset[$i] . '<br>';
                    if ($this->{$varToUnset[$i]} instanceof Range) :
                        $try = $this->{$varToUnset[$i]}->unsetField($rangeParam);
                       /* $i = ($rangeParam == 'min') ? $i : $i + 1;
                        $rangeParam = ($rangeParam == 'min') ? 'max' : 'min';*/
                        if($rangeParam == 'max'):
                            $rangeParam = 'min';
                            //$i++;
                        else:
                            $rangeParam = 'max';                       
                        endif;                       
                    else :
                        $try = $this->{$varToUnset[$i]}->unsetField();
                        //$i ++;
                    endif;
                else :
                    //$i ++;
                endif;
            else :
                $this->__construct();
                $try = true;
            endif;
            if ($try) :
                $elencoAuto = $this->getList();            
            endif;            
            $i++; 
            $try = false;           
        endwhile;

        return $elencoAuto;                                            
    }
    
    public function getListImmagini(){

        $method = 'getListImmagini()';

        $this->debug->tryingToConstruct('Immagine', $method);
        $immagine = new Immagine($this);
        $this->debug->tryingToSet('List', $method);
        $list = $immagine->getList();
        $this->debug->generic('List Immagini Created [list:'.count($list).']');

        return '$list';
    }
    


    
    
    
}

?>