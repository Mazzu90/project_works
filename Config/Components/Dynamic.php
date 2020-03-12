<?php


namespace Config\Components;

use Config\Core\Entities\Debugger;

class Dynamic
{
    private $debug;
    public function __construct(){

        $this->debug = new Debugger("DYNAMIC");
        $this->debug->constructing();
        $this->debug->constructed();
    }

}