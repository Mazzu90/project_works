<?php 

namespace Config\Core\Properties;

use Config\Core\Entities\Debugger;

class ConnectionProperties{
    
    public $db_name;
    public $db_host; 
    public $db_password;
    public $db_user;
    public $db_encoding;

    private $debug;
    
    function __construct(){ 

        //$this->debug = new Debugger("CONNECTION PROPERTIES");
        $method = '__construct()';
        //$this->debug->construting();

        $this->db_name = false;
        $this->db_host = false;
        $this->db_password= false;
        $this->db_user = false;
        $this->db_encoding = false;

        //$this->debug->constructed();
    }    
}


?>