<?php


namespace Config\Template;



class ResearchForm
{

    public $ciao;
/*
    function html(){

        ?>




        <section class="b-items">
        <div class="container">
        <div class="row b-bottom">

        <div class="b-search__main-type col-lg-3 col-xs-12 pl-none pr-no-phone">

        <div class="col-lg-12 col-sm-12 col-xs-12">

        <form method="GET" id="formRicerca">

        <!--FILTRO 1**************************************************************-->

        <aside class="b-items__aside">
            <h2 class="s-title"><i class="icon-magnifier icon icon-2x"></i> FILTRI</h2>
            <div class="accordion" id="refine">
                <div class="">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#refine" href="#refine-search1">
                            <button type="submit" class="btn m-btn filter mt-none mb-md">
                                DATI PRINCIPALI
                                <i class="icon-arrow-down icon icon-2x"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            <div id="refine-search1" class="accordion-body collapse in">

                <div class="b-items__aside-main">

                    <div class="b-items__aside-main-body">

                        <div class="b-items__aside-main-body-item">
                            <label>MARCA</label>
                            <div>

                                <select name="id_marca" class="m-select filter dark" id="id_marca">

                                    <?

                                    $query = 'SELECT  marca.id,
                                                                        marca.titolo
                                                                FROM
                                                                        marca
                                            		            WHERE 
                                                                        marca.id in (select distinct id_marca from veicoli where veicoli.pubblicato = 1)
                                                                ORDER BY titolo ASC
                                                         ';

                                    //echo $query;
                                    $result=mysql_query($query);

                                    $selectedMake = '';
                                    if ($marca == '')
                                    {
                                        $selectedMake = 'selected="selected"';
                                    }
                                    echo '<option value="" '.$selectedMake.'>Tutto</option>';


                                    while ($row=mysql_fetch_assoc($result)) {
                                        if ($marca == $row['id'])
                                        {
                                            $selectedMake = 'selected="selected"';
                                        }
                                        else
                                        {
                                            $selectedMake = '';
                                        }

                                        echo '<option value="'.$row['id'].'" '.$selectedMake.'>'.$row['titolo'].'</option>';
                                    }

                                    ?>

                                </select>
                                <i class="icon-arrow-down icon icon-2x"></i>
                            </div>
                        </div>

                        <div class="b-items__aside-main-body-item">
                            <label>MODELLO</label>
                            <div>
                                <select name="id_modello" class="m-select filter dark auto_submit_filter" id="modello2">
                                    <option value="-1">Scegli Modello...</option>
                                </select>
                                <i class="icon-arrow-down icon icon-2x"></i>
                            </div>
                        </div>


                        <div class="b-items__aside-main-body-item">
                            <label>CARROZZERIA</label>
                            <div>
                                <select name="body" class="m-select filter dark auto_submit_filter">

                                    <?
                                    $query = 'select distinct
                                                                        veicoli.body from 
                                                                            veicoli 
                                                                        where
                                                                            veicoli.pubblicato = 1 
                                                                        order by 
                                                                            veicoli.body asc';
                                    $result=mysql_query($query);
                                    $selectedBody = '';
                                    if ($carrozzeria == '')
                                    {
                                        $selectedBody = 'selected="selected"';
                                    }
                                    echo '<option value="" '.$selectedBody.'>Tutto</option>';
                                    while ($row=mysql_fetch_assoc($result)) {
                                        if ($carrozzeria == $row['body'])
                                        {
                                            $selectedBody = 'selected="selected"';
                                        }
                                        else
                                            $selectedBody = '';
                                        {
                                        }
                                        echo '<option value="'.$row['body'].'" '.$selectedBody.'>'.$row['body'].'</option>';
                                    }

                                    ?>

                                </select>
                                <i class="icon-arrow-down icon icon-2x"></i>
                            </div>
                        </div>

                        <div class="b-items__aside-main-body-item">
                            <label>Anno:</label>
                            <div class="col-xs-6 pr-none pl-none mb-xxl">
                                <select name="range[registration_date][min]" class="m-select filter dark auto_submit_filter" id="registration_dateDa">
                                    <?
                                    $selectedAnno = '';
                                    $anni = getArrayAnni();
                                    echo '<option value="" '.$selectedAnno.'>Da</option>';
                                    $da ='1-1';

                                    foreach ($anni as $anno) {


                                        if ($annoDa == $anno)
                                        {
                                            $selectedAnno = 'selected="selected"';
                                        }
                                        else
                                        {
                                            $selectedAnno = '';
                                        }
                                        echo '<option value="'.$anno.'-1-1"'.$selectedAnno.'>'.$anno.'</option>';

                                    }

                                    ?>
                                </select>
                                <i class="icon-arrow-down icon icon-2x"></i>
                            </div>

                            <div class="col-xs-6 pr-none pl-none mb-xxl">
                                <select name="range[registration_date][max]" class="m-select filter dark auto_submit_filter" id="registration_dateA">
                                    <?
                                    $selectedAnno = '';
                                    echo '<option value="'.$selectedAnno.'">A</option>';
                                    $a='31-12' ;

                                    foreach ($anni as $anno) {




                                        if ($annoA == $anno)
                                        {
                                            $selectedAnno = 'selected="selected"';
                                        }
                                        else
                                        {
                                            $selectedAnno = '';
                                        }
                                        echo '<option value="'.$anno.'-12-31" '.$selectedAnno.'>'.$anno.'</option>';

                                    }

                                    ?>
                                </select>
                                <i class="icon-arrow-down icon icon-2x"></i>
                            </div>

                        </div>

                        <div class="b-items__aside-main-body-item">
                            <label>Prezzo:</label>
                            <div class="col-xs-6 pr-none pl-none mb-xxl ">
                                <select name="range[prezzo][min]" class="m-select filter dark auto_submit_filter" id="prezzoDa">
                                    <?
                                    $selectedPrice = '';
                                    echo '<option value="" '.$selectedPrice.'>Da</option>';
                                    foreach ($prezziVeicoli as $prezzoV) {

                                        if ($prezzoV == $prezzoDa)
                                        {
                                            $selectedPrice = 'selected="selected"';
                                        }
                                        else
                                        {
                                            $selectedPrice = '';
                                        }
                                        echo '<option value="'.$prezzoV.'" '.$selectedPrice.'>'.$prezzoV.'</option>';

                                    }

                                    ?>
                                </select>
                                <i class="icon-arrow-down icon icon-2x"></i>
                            </div>

                            <div class="col-xs-6 pr-none pl-none mb-xxl">
                                <select name="range[<?php echo ComponentsMap::veicolo_idx ?>][prezzo][max]" class="m-select filter dark auto_submit_filter" id="prezzoA">
                                    <?
                                    $selectedPrice = '';
                                    echo '<option value="" '.$selectedPrice.'>A</option>';
                                    foreach ($prezziVeicoli as $prezzoV) {

                                        if ($prezzoV == $prezzoA)
                                        {
                                            $selectedPrice = 'selected="selected"';
                                        }
                                        else
                                        {
                                            $selectedPrice = '';
                                        }
                                        echo '<option value="'.$prezzoV.'" '.$selectedPrice.'>'.$prezzoV.'</option>';

                                    }

                                    ?>
                                </select>
                                <i class="icon-arrow-down icon icon-2x "></i>
                            </div>

                        </div>


                        <div class="accordion" id="refine">
                            <div class="">
                                <div class="accordion-heading">
                                    <label>RISPARMIO</label> <i class="icon-info icon"></i>
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#refine" href="#seleziona-occasioni">
                                        <button type="submit" class="btn m-btn filter blue mt-none mb-sm">
                                            SELEZIONA OCCASIONI
                                            <i class="icon-arrow-down icon icon-2x"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div id="seleziona-occasioni" class="accordion-body collapse out">
                            <div class="b-items__aside-main-body-item">
                                <label class="check_filter light_blue1 auto_submit_filter"><p>Risparmi Oltre � 2.000</p>
                                    <input type="checkbox" name="risparmia" value="2000">
                                    <span class="checkmark_filter"></span>
                                </label>
                                <label class="check_filter light_blue2 auto_submit_filter"><p>Risparmi Oltre � 5.000</p>
                                    <input type="checkbox" name="risparmia" value="5000">
                                    <span class="checkmark_filter"></span>
                                </label>
                                <label class="check_filter light_blue3 auto_submit_filter"><p>Risparmi Oltre � 9.000</p>
                                    <input type="checkbox" name="risparmia" value="9000">
                                    <span class="checkmark_filter"></span>
                                </label>
                            </div>
                        </div>


                        <div class="b-items__aside-main-body-item mt-lg">
                            <label>CARBURANTE</label>
                            <div>

                                <select name="1[alimentazione]" class="m-select filter dark auto_submit_filter" id="alimentazione">
                                    <?
                                    $selected = '';
                                    $selected = ($carburante==-1 ? 'selected="selected"' : '');?>
                                    <option value="-1" <?echo $selected?> >Tutto</option>
                                    <?$selected = ($carburante==1 ? 'selected="selected"' : '');?>
                                    <option value="1" <?echo $selected?> >Benzina</option>
                                    <?$selected = ($carburante==2 ? 'selected="selected"' : '');?>
                                    <option value="2" <?echo $selected?> >Diesel</option>
                                    <?$selected = ($carburante==3 ? 'selected="selected"' : '');?>
                                    <option value="3" <?echo $selected?> >Elettrica/Benzina</option>
                                    <?$selected = ($carburante==4 ? 'selected="selected"' : '');?>
                                    <option value="4" <?echo $selected?> >Benzina/GPL</option>
                                    <?$selected = ($carburante==5 ? 'selected="selected"' : '');?>
                                    <option value="5" <?echo $selected?> >Benzina/Metano</option>
                                    <?$selected = ($carburante==6 ? 'selected="selected"' : '');?>
                                    <option value="6" <?echo $selected?> >Elettrica</option>

                                </select>
                                <i class="icon-arrow-down icon icon-2x"></i>
                            </div>
                        </div>

                        <div class="b-items__aside-main-body-item">
                            <label>KILOMETRAGGIO</label>
                            <div class="col-xs-6 pr-none pl-none mb-xxl">
                                <input type="hidden" id ="km" name="km" value="range"/>
                                <select name="range[km][min]" class="m-select filter dark auto_submit_filter" id="kmDa">
                                    <?
                                    $selectedKm = '';
                                    echo '<option value="" '.$selectedKm.'>Da</option>';
                                    foreach ($kmVeicoli as $kmV) {

                                        if ($kmV == $kmDa)
                                        {
                                            $selectedKm = 'selected="selected"';
                                        }
                                        else
                                        {
                                            $selectedKm = '';
                                        }
                                        echo '<option value="'.$kmV.'" '.$selectedKm.'>'.$kmV.'</option>';

                                    }

                                    ?>
                                </select>
                                <i class="icon-arrow-down icon icon-2x"></i>
                            </div>

                            <div class="col-xs-6 pr-none pl-none mb-xxl">
                                <select name="range[km][max]" class="m-select filter dark auto_submit_filter" id="kmA">
                                    <?
                                    $selectedKm = '';
                                    echo '<option value="" '.$selectedKm.'>Da</option>';
                                    foreach ($kmVeicoli as $kmV) {

                                        if ($kmV == $kmA)
                                        {
                                            $selectedKm = 'selected="selected"';
                                        }
                                        else
                                        {
                                            $selectedKm = '';
                                        }
                                        echo '<option value="'.$kmV.'" '.$selectedKm.'>'.$kmV.'</option>';

                                    }

                                    ?>
                                </select>
                                <i class="icon-arrow-down icon icon-2x"></i>
                            </div>

                        </div>

                        <div class="b-items__aside-main-body-item">
                            <label>POTENZA</label>

                            <div class="col-xs-4 pr-none pl-none mb-sm">
                                <input type="hidden" value="range" id="kwatt" name="kwatt"/>
                                <select name="potenza" class="m-select filter dark" id="potenza">
                                    <?
                                    $selected = ($potenza=='KW' ? 'selected="selected"' : '');
                                    echo '<option value="KW" '.$selected.'>KW</option>';
                                    $selected = ($potenza=='CV' ? 'selected="selected"' : '');
                                    echo '<option value="CV" '.$selected.'>CV</option>';


                                    ?>
                                </select>
                                <i class="icon-arrow-down icon icon-2x"></i>
                            </div>

                            <div id="potenza2">
                                <div class="col-xs-4 pr-none pl-none mb-sm">
                                    <select name="range[kwatt][min]" class="m-select filter dark auto_submit_filter" id="kwattDa">
                                        <?
                                        $selectedPotDa = '';
                                        echo '<option value="" '.$selectedPotDa.'>Da</option>';
                                        foreach ($kWatt as $kW) {

                                            if($potenza=='CV')
                                                $kW = round($kW*1.35962);

                                            if ($kW == $potenzaDa)
                                            {
                                                $selectedPotDa = 'selected="selected"';
                                            }
                                            else
                                            {
                                                $selectedPotDa = '';
                                            }
                                            echo '<option value="'.$kW.'" '.$selectedPotDa.'>'.$kW.'</option>';
                                        }

                                        ?>
                                    </select>
                                    <i class="icon-arrow-down icon icon-2x"></i>
                                </div>

                                <div class="col-xs-4 pr-none pl-none mb-sm">
                                    <select name="range[kwatt][max]" class="m-select filter dark auto_submit_filter" id="kwattA">
                                        <?
                                        $selectedPotA = '';
                                        echo '<option value="" '.$selectedPotA.'>A</option>';
                                        foreach ($kWatt as $kW) {

                                            if($potenza=='CV')
                                                $kW = round($kW*1.35962);

                                            if ($kW == $potenzaA)
                                            {
                                                $selectedPotA = 'selected="selected"';
                                            }
                                            else
                                            {
                                                $selectedPotA = '';
                                            }
                                            echo '<option value="'.$kW.'" '.$selectedPotA.'>'.$kW.'</option>';
                                        }

                                        ?>
                                    </select>
                                    <i class="icon-arrow-down icon icon-2x"></i>
                                </div>
                            </div><!-- ptenze -->

                        </div>

                        <div class="b-items__aside-main-body-item" style="clear: left;">
                            <?
                            if ($neopatentati!='')
                                $checkedNP = 'checked="checked"';
                            ?>
                            <label class="check_filter green auto_submit_filter"><p>NEOPATENTATI</p>
                                <input type="checkbox" name="neopatentati" value="1" <?echo $checkedNP ?>/>
                                <span class="checkmark_filter"></span>
                            </label>
                        </div>

                        <div class="b-items__aside-main-body-item mt-lg">
                            <label>CAMBIO</label>
                            <div>
                                <select name="gearbox" class="m-select filter dark auto_submit_filter" id="gearbox">
                                    <option value="-1">Tutto</option>
                                    <?
                                    $selectedCambio = ($cambio=='Automatico' ? 'selected="selected"' : '');
                                    echo '<option value="Automatico" '.$selectedCambio.'>Automatico</option>';
                                    $selectedCambio = ($cambio=='Manuale' ? 'selected="selected"' : '');
                                    echo '<option value="Manuale" '.$selectedCambio.'>Manuale</option>';
                                    $selectedCambio = ($cambio=='Sequenziale' ? 'selected="selected"' : '');
                                    echo '<option value="Sequenziale" '.$selectedCambio.'>Sequenziale</option>';
                                    ?>

                                </select>
                                <i class="icon-arrow-down icon icon-2x"></i>
                            </div>
                        </div>

                        <div class="b-items__aside-main-body-item">
                            <label style="margin-bottom: 0px;">N. PORTE</label>



                            <div class="col-xs-3 pl-none pr-none mb-xxl ">
                                <input id="type1" class="auto_submit_filter" type="radio" value="" name="pool[doors]"  <?echo $checkedPorte1?>/>
                                <label for="type1" class="b-search__main-type-svg"></label>
                                <h6><label for="type1">TUTTO</label></h6>
                            </div>

                            <div class="col-xs-3 pl-none pr-none mb-xxl">
                                <input id="type2" class="auto_submit_filter" type="radio" name="pool[doors]" value='("2","3")' <?echo $checkedPorte2?> />
                                <label for="type2" class="b-search__main-type-svg"></label>
                                <h6><label for="type2">2/3</label></h6>
                            </div>

                            <div class="col-xs-3 pl-none pr-none mb-xxl">
                                <input id="type3" class="auto_submit_filter" type="radio" name="pool[doors]" value='("4","5")' <?echo $checkedPorte3?> />
                                <label for="type3" class="b-search__main-type-svg"></label>
                                <h6><label for="type3">4/5</label></h6>
                            </div>

                            <div class="col-xs-3 pl-none pr-none mb-xxl">
                                <input id="type4" class="auto_submit_filter" type="radio" name="pool[doors]" value='("6","7")' <?echo $checkedPorte4?> />
                                <label for="type4" class="b-search__main-type-svg"></label>
                                <h6><label for="type4">6/7</label></h6>
                            </div>
                        </div>

                        <div class="b-items__aside-main-body-item">
                            <label>N. POSTI</label>
                            <div class="col-xs-6 pr-none pl-none mb-xxl">

                                <select name="range[seats][min]" class="m-select filter dark auto_submit_filter" id="seatsDa">
                                    <?
                                    $selectedPostoDa = '';
                                    echo '<option value="" '.$selectedPostoDa.'>Da</option>';
                                    foreach ($postiSedere as $posto) {

                                        if ($posto == $nPostiDa)
                                        {
                                            $selectedPostoDa = 'selected="selected"';
                                        }
                                        else
                                        {
                                            $selectedPostoDa = '';
                                        }
                                        echo '<option value="'.$posto.'" '.$selectedPostoDa.'>'.$posto.'</option>';

                                    }

                                    ?>
                                </select>
                                <i class="icon-arrow-down icon icon-2x"></i>
                            </div>

                            <div class="col-xs-6 pr-none pl-none mb-xxl">
                                <select name="range[seats][max]" class="m-select filter dark auto_submit_filter" id="seatsA">
                                    <?
                                    $selectedPostoA = '';
                                    echo '<option value="" '.$selectedPostoA.'>A</option>';
                                    foreach ($postiSedere as $posto) {

                                        if ($posto == $nPostiA)
                                        {
                                            $selectedPostoA = 'selected="selected"';
                                        }
                                        else
                                        {
                                            $selectedPostoA = '';
                                        }
                                        echo '<option value="'.$posto.'" '.$selectedPostoA.'>'.$posto.'</option>';

                                    }

                                    ?>
                                </select>
                                <i class="icon-arrow-down icon icon-2x"></i>
                            </div>

                        </div>

                    </div> <!--close b-items__aside-main-body-->
                </div> <!--b-items__aside-main-->
            </div> <!--close accordion-body-->
        </aside><!--close filter 1-->

        <!--FILTRO 2**************************************************************-->

        <aside class="b-items__aside">
            <div id="refine" class="accordion">
                <div class="">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#refine" href="#refine-search2">
                            <button type="submit" class="btn m-btn filter mt-none mb-md">
                                EQUIPAGGIAMENTO
                                <i class="icon-arrow-down icon icon-2x"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <?
            if ($abs == 'on' || $cruise == 'on' || $clima == 'on' || $fari == 'on')
            {
                $classeOptional = 'in';
            }
            else
            {
                $classeOptional = 'out';
            }


            ?>
            <div id="refine-search2" class="accordion-body collapse <?echo $classeOptional?>">
                <div class="b-items__aside-main">
                    <div class="b-items__aside-main-body">


                        <div class="b-items__aside-main-body-item">
                            <label class="check_filter default"><p>ABS</p>
                                <?
                                if ($abs=='on')
                                    $checkedABS = 'checked="checked'
                                ?>
                                <input type="checkbox" name="optional[titolo][]" class="auto_submit_filter" <?echo $checkedABS?> value='"ABS"'/>
                                <span class="checkmark_filter"></span>
                            </label>
                            <?
                            if ($cruise=='on')
                                $checkedCruise = 'checked="checked'
                            ?>
                            <label class="check_filter default"><p>Cruise Control</p>
                                <input type="checkbox" name="optional[titolo][]" class="auto_submit_filter" <?echo $checkedCruise?> value='"Cruise Control"'/>
                                <span class="checkmark_filter"></span>
                            </label>
                            <?
                            if ($clima=='on')
                                $checkedClima= 'checked="checked'
                            ?>
                            <label class="check_filter default"><p>Climatizzatore</p>
                                <input type="checkbox" name="optional[titolo][]" class="auto_submit_filter" <?echo $checkedClima?> value='"Climatizzatore"'/>
                                <span class="checkmark_filter"></span>
                            </label>
                            <?
                            if ($fari=='on')
                                $checkedFari = 'checked="checked'
                            ?>
                            <label class="check_filter default"><p>Fari LED</p>
                                <input type="checkbox" name="optional[titolo][]" class="auto_submit_filter" <?echo $checkedFari?> value='"Fari LED"'/>
                                <span class="checkmark_filter"></span>
                            </label>
                        </div>



                    </div> <!--close b-items__aside-main-body-->
                </div> <!--b-items__aside-main-->
            </div> <!--close accordion-body-->
        </aside><!--close filter 2-->




    <?php
    } */

    public function createSelect($label, $selects_properties){//($label, $name, $id, $options = array()){

        $selects = count($selects_properties);
        $external_div_class = "b-items__aside-main-body-item";
        $bs_col = $selects > 0 ?  12/$selects : '';
        $internal_div_class = $selects > 1 ? 'col-xs-'.$bs_col.' pr-none pl-none mb-xxl' : '';
        $select_class = 'm-select filter dark';
        $arrow_html_element = 'i';
        $arrow_class = 'icon-arrow-down icon icon-2x';

        ?>

            <div class=" <?php echo $external_div_class ?>">
                <label><?php echo $label ?></label>

                <?php foreach($selects_properties as $select):  ?>

                    <div class="<?php echo $internal_div_class ?>">

                        <select name="<?php echo $select['name'] ?>" class="<?php echo $select_class ?>" id="<?php echo $select['id'] ?>">

                            <?php foreach ($select['options'] as $opt): ?>

                                <option value="<?php echo $opt->field_0 ?>"> <?php echo $opt->field_1 ?> </option>

                            <?php endforeach; ?>

                        </select>
                        <<?php echo $arrow_html_element ?> class="<?php echo $arrow_class ?>"></<?php echo $arrow_html_element ?> >
                    </div>

                <?php endforeach; ?>

            </div>

        <?php
    }

    public function createCheckBox(){

        $name = "optional['titolo][]";
        $value = '"ABS';
        $label = '"ABS"';

        ?>
        <div class="b-items__aside-main-body-item">

            <label class="check_filter default"><p>ABS</p>
                <input type="checkbox" name="optional[titolo][]" class="auto_submit_filter" value='"ABS"'/>
                <span class="checkmark_filter"></span>
            </label>

        </div>

        <?php


    }














}