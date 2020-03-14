<?php

namespace Config\Components;

use Config\Core\Entities\Debugger;
use Config\Core\Entities\Querable;
use Config\Properties;
use Config\Utils\Util;


class Veicolo extends Querable
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

    public function __construct()//$constructor_idx = -1, $extra_param = false)
    {   
        $method = ('__construct()');
        $this->debug = new Debugger('VEICOLO');
        $this->debug->constructing();
        $this->debug->constructed();           
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