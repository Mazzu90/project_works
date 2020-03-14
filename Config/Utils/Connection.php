<?php 

namespace Config\Utils;

use Config\Properties;

class Connection{
    

    private $connection;
    
    public function __construct(){

        $this->db_host = Properties::db_host;
        $this->db_name = Properties::db_name;
        $this->db_user = Properties::db_user;
        $this->db_password = Properties::db_password;
        $this->db_encoding = Properties::db_encoding;
        $this->open();
    }
    
    function __destruct(){        
        
        $this->close();
    }
    
    public function open(){       
        //connessione al server
        $this->connection = @mysql_connect($this->db_host, $this->db_user, $this->db_password);
        //connessione al database
        if ($this->connection):        
            @mysql_select_db($this->db_name, $this->connection);
            @mysql_query('SET NAMES \'' . $this->db_encoding . '\'', $this->connection);
        endif;
    }
    
    public function close(){
        
        if (isset($this->connection)):
            @mysql_close($this->connection);
            unset($this->connection);
        endif;
    }   
    
}


?>