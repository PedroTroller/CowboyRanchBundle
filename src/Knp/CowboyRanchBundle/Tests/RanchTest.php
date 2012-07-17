<?php

namespace Knp\CowboyRanchBundle\Tests;

use Knp\CowboyRanchBundle\Entity\Cow;
use Knp\CowboyRanchBundle\Ranch\DoctrineRanch;

/**
 * @author Pierre PLAZANET <pierre.plazanet@knplabs.com>
 **/

class RanchTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function should_add_cow_when_limit_not_reached()
    {
        $cow = new Cow();
        $cow->setName("NAME");

        $ranch = $this->getDoctrineRanchMock(2, 0, 1, 0, 1);

        $ranch->add($cow);

    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function should_not_add_cow_when_limit_not_reached()
    {
        $cow = new Cow();
        $cow->setName("NAME");

        $ranch = $this->getDoctrineRanchMock(2, 2, 0, 0, 0);

        $ranch->add($cow);
    }

    /**
     * @test
     */
    public function should_remove_cow()
    {
        $cow = new Cow();
        $cow->setName("NAME");

        $ranch = $this->getDoctrineRanchMock(2, 0, 1, 1, 2);

        $ranch->add($cow);
        $ranch->remove($cow);

    }

    private function getRegistryMock($emMock)
    {
        $mock = $this->getMockBuilder('Symfony\Bundle\DoctrineBundle\Registry')
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $mock
            ->expects($this->any())
            ->method('getEntityManager')
            ->will($this->returnValue($emMock))
        ;

        return $mock;
    }

    private function getEntityManagerMock($callsPersist, $callsRemove, $callsFlush)
    {
        $mock = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $mock
            ->expects($this->exactly($callsPersist))
            ->method('persist')
            ->will($this->returnValue(null))
        ;
        $mock
            ->expects($this->exactly($callsRemove))
            ->method('remove')
            ->will($this->returnValue(null))
        ;
        $mock
            ->expects($this->exactly($callsFlush))
            ->method('flush')
            ->will($this->returnValue(null))
        ;

        return $mock;
    }

    private function getDoctrineRanchMock($limit, $count, $callsPersist, $callsRemove, $callsFlush)
    {
        $mock = $this->getMockBuilder('Knp\CowboyRanchBundle\Ranch\DoctrineRanch')
            ->setConstructorArgs(array($this->getRegistryMock($this->getEntityManagerMock($callsPersist, $callsRemove, $callsFlush)), $limit))
            ->setMethods(array('countCows'))
            ->getMock()
        ;

        $mock
            ->expects($this->any())
            ->method('countCows')
            ->will($this->returnValue($count))
        ;

        return $mock;
    }

}