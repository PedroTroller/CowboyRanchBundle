<?php

namespace Knp\CowboyRanchBundle\Ranch;

use Knp\CowboyRanchBundle\Ranch as RanchInterface;
use Knp\CowboyRanchBundle\Entity\Cow;
use Knp\CowboyRanchBundle\Cow as CowInterface;
use Symfony\Bundle\DoctrineBundle\Registry;

/**
 * @author Pierre PLAZANET <pierre.plazanet@knplabs.com>
 **/

class DoctrineRanch implements RanchInterface
{
    private $doctrine;
    private $limit;

    public function __construct(Registry $doctrine, $limit = 10)
    {
        $this->doctrine = $doctrine;
        $this->limit = $limit;
    }

    public function getCows()
    {
        //debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10);
        return $this->doctrine->getRepository('Knp\CowboyRanchBundle\Entity\Cow')->findAll();
    }

    public function getCow($id)
    {
        return $this->doctrine->getRepository('Knp\CowboyRanchBundle\Entity\Cow')->find($id);
    }

    public function add(CowInterface $cow)
    {
        if($this->countCows() < $this->limit){
            $em = $this->doctrine->getEntityManager();
            $em->persist($cow);
            $em->flush();
        }else{
            throw new \LogicException('The limit of cow on the ranch is reached');
        }
    }

    public function remove(CowInterface $cow)
    {
        $em = $this->doctrine->getEntityManager();
        $em->remove($cow);
        $em->flush();
    }

    protected function countCows()
    {
        return count($this->getCows());
    }

}