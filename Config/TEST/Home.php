<?php
                   
                    
 
                    namespace ciao Config\TEST; 
 
                    
 
                    use Config\Core\Entities\Debugger; 
 
                    use Config\Core\Entities\Page; 

                    

                    class Home extends Page{ 

                    

                        private $debug;

                        public function show(){

                            $method = 'show';

                            $this->debug->generic('AUTO - GENERATED');
                           
                        }
                    }
                    ?> 
                    