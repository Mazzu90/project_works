<?php 

spl_autoload_register(function($className) {
    $file = $_SERVER['DOCUMENT_ROOT'].$className.'.php';
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
    echo '<br>Autoload:'.$file;
    if (file_exists($file)) 
    {
        ECHO '<br> Autoload: FILE EXISTS';
        include_once $file;
    }elseif(file_exists(strtolower($file))){
        include_once $file;
    }
})

?>