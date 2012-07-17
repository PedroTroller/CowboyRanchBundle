<?php

namespace Knp\CowboyRanchBundle\Form\Model;

use Knp\CowboyRanchBundle\Entity\Cow;
use Symfony\Component\Validator\Constraints as Assert;

class CowAdd
{
    /**
     * @Assert\NotBlank
     * @Assert\MaxLength(limit=255)
     */
    public $name;
    
    private $cow;
    
    public function __construct()
    {
    }

}