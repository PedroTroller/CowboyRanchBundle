<?php

namespace Knp\CowboyRanchBundle;

interface Ranch {

    // int
    //private $maxCows;

    //public function __construct($max)
    //{
        //$this->maxCows = $max;
    //}

    // returns array(Cow)
    function getCows();

    // returns nothing
    function add(Cow $cow);

    // returns nothing
    function remove(Cow $cow);
}