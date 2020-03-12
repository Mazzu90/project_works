<?php 

namespace Config\Core\Factories;

use Config\Core\Entities\Debugger;

class PageFactory {
    
    private  static $debug;
    
    public static function createPage($properties){
        
        self::$debug = new Debugger('PAGE FACTORY');
        $method = 'createPage()';
        self::$debug->creating($method);
        
        $obj = $properties->class;
        
        $folder = $_SERVER['DOCUMENT_ROOT'];               
        $namespace = 'Config\Pages';
        $obj_class = str_replace($namespace, '', $obj);
        $filename = str_replace('\\', '/', $folder.$namespace.$obj_class.'.php');
        
        self::$debug->generic('filename: '.$filename);
        self::$debug->generic('class :'.$obj_class);
        
        if(!file_exists($filename)):
            self::$debug->generic('FILE TEST DOESNT EXISTS');
            self::createPageFile($filename, $obj_class, $namespace);
        else:
            self::$debug->generic( 'TEST FILE EXISTS');
        endif;
        //var_dump($properties);
        //var_dump($object);
    
        self::$debug->tryingToConstruct('PAGE ');
        return new $obj($properties);        
    }
    
    
    static private function createPageFile($filename, $obj_class, $namespace){    
        
        $method = 'createPageFile()';
        
        $obj_class = str_replace('\\', '', $obj_class);  
        
        self::$debug->tryingToCreate('FILE', $method);
        
        self::$debug->generic($filename);
        
        $text =
'%s             
                
namespace '.$namespace.';                    

use Config\Core\Entities\Debugger; 
use Config\Core\Entities\Page;                     

class '.$obj_class.' extends Page{                                   
    
    public function show(){
        %s = "show()";
     
        %s->debug->generic("AUTO-GENERATED");                                     
    }
}
?>' ; 
              
        $handle =  fopen($filename, "a");             
        fprintf($handle, $text, '<?php', '$method' ,'$this');             
    }
    
}



?>