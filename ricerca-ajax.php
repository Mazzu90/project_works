<?php


//include 'include/autoload.php';
?><link href="http://simone.clickitsolutions.it/css/master.css" rel="stylesheet"><?php 

use Config\Entities\HtmlGenerator;
use Config\Components\Veicolo;
use Config\Components\Immagine;

use Config\ComponentsMap;
//use Config\Template\Menu;
//use Config\Pages\Home;

//new it\Tgrafica(false, false);

//$menu = new Menu(1);

//$menu->show();

//$index = new Home();

//echo 'ciao';

//$veicolo = new Veicolo();


//$veicolo->getList();

$generator = new HtmlGenerator();
$generator->stampaLista(new Veicolo());
?>                    