<?php 

include 'include/autoload.php';


use Config\Template\Menu;
use Config\Core\Entities\PageProperties;
use Config\Properties;

/*$properties = new PageProperties();

$properties->title = 'Auto usate - Brescia - AUTOUNICA srl';
$properties->description = 'Autovetture usate in offerta - comprale da AUTOUNICA srl';
$properties->keywords='auto usate, veicoli usati, vendita auto usate Brescia';
$properties->code=Properties::cp_tutteleauto;
$properties->codiceBody='page1';
$properties->name = 'RICERCA AUTO';
$properties->url = Properties::base_url.Properties::lingua.'ricerca.php';*/

?><link href="http://simone.clickitsolutions.it/css/master.css" rel="stylesheet"><?php 

$menu = new Menu();
$menu->stampaMenu(2);





?>