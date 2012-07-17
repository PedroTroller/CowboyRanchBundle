<?php

namespace Knp\CowboyRanchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\CowboyRanchBundle\Cow as CowInterface;

/**
* @ORM\Entity
* @ORM\Table(name="cow")
*/
class Cow implements CowInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="cow_name")
     */
    private $name;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    
}