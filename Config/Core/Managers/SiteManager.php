<?php 

namespace Config\Core\Managers;

use Config\SiteMap;
use Config\Template\Navbar;
use Config\Template\Footer;
use Config\Core\Entities\Debugger;
use Config\Components\Veicolo;

class SiteManager{
    
    private $debug;
    public $navbar;
    public $footer;
    public $archive;
    public $available_pages;
    
    public $current_page;
    public static $current_idx;
    
    public static $numero_veicoli;
    
    public function __construct(){
        
        $method = '__construct()';
                
        $this->debug = new Debugger('SITE MANAGER');
        $this->debug->constructing();        
        
        if($_GET['pg']) $this->debug->generic('$_GET["pg"] = '.$_GET['pg']);
        
        $this->debug->tryingToSet('self::current_index', $method);
        self::$current_idx = (SiteMap::url_rewrite) ? RedirectManager::getPageIdx($_GET['pg'])  : $_GET['idx'];

        $this->debug->tryingToCreate('PAGE', $method, 'PAGEFACTORY::createPage()');
        $this->current_page = PageManager::getPage(self::$current_idx);
        
        $this->debug->tryingToConstruct('NAVBAR', $method);
        $this->navbar = new Navbar();
        
        $this->debug->tryingToConstruct('FOOTER', $method);
        $this->footer = new Footer();
        
        $this->debug->tryingToSet('numero_veicoli', $method);
        self::$numero_veicoli = Veicolo::getCount('id');
        
        $this->debug->constructed();               
    } 
    
}

?>