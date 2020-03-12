<?php 

include_once $_SERVER['DOCUMENT_ROOT'].'Config/Properties.php';
use Config\Properties;

spl_autoload_register(function($className) {

    
    $file = $_SERVER['DOCUMENT_ROOT'].$className . '.php';
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
    if(Properties::debug_level>2)echo '<br>Autoload: '.$file;
    if (file_exists($file)) 
    {
        if(Properties::debug_level>2) ECHO '<br>Autoload: FILE EXISTS';
        include_once $file;
    }
})

?>