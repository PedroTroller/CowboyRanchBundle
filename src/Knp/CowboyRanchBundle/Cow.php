<?php

namespace Knp\CowboyRanchBundle;

interface Cow {

    // int unique ID
    function getId();

    // returns string
    function getName();
}