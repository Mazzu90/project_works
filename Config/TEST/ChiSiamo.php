<?php
                   
                    
 
                    namespace Config\TEST; 
 
                    
 
                    use Config\Core\Entities\Debugger; 
 
                    use Config\Core\Entities\Page; 

                    

                    class ChiSiamo extends Page{ 

                    

                        private $debug;

                        public function show(){

                            $method = 'show';

                            $this->debug->generic('AUTO - GENERATED');
                           
                        }
                    }
                    ?> 
                    