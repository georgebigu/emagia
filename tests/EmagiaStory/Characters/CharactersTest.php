<?php
/**
 * Created by PhpStorm.
 * User: George
 * Date: 3/13/18
 * Time: 23:49
 */

namespace Tests\EmagiaStory\Characters;

use PHPUnit\Framework\TestCase;

/**
 * Class CharactersTest
 * @package Tests\EmagiaStory\Characters
 */
class CharactersTest extends TestCase
{
    /** @var $character */
    protected $character;

    /**
     * Set up test Character
     */
    protected function setUp()
    {
        /* @var $character \EmagiaStory\Characters\CharactersAbstract|\PHPUnit_Framework_MockObject_MockObject */
        $character = $this
            ->getMockBuilder('EmagiaStory\Characters\CharactersAbstract')
            ->getMockForAbstractClass()
        ;

        $character->setHealth(70);
        $character->setStrength(80);
        $character->setDefence(75);
        $character->setSpeed(85);
        $character->setLuck(40);

        $this->character = $character;
    }

    /**
     * Test Health get/set methods
     */
    public function testGetSetHealth()
    {
        /* @var $character \EmagiaStory\Characters\CharactersAbstract|\PHPUnit_Framework_MockObject_MockObject */
        $character = $this->character;
        self::assertEquals(70, $character->getHealth());
        $character->setHealth(20);
        self::assertEquals(20, $character->getHealth());
    }

    /**
     * Test Strength get/set methods
     */
    public function testGetSetStrength()
    {
        /* @var $character \EmagiaStory\Characters\CharactersAbstract|\PHPUnit_Framework_MockObject_MockObject */
        $character = $this->character;
        self::assertEquals(80, $character->getStrength());
        $character->setStrength(30);
        self::assertEquals(30, $character->getStrength());
    }

    /**
     * Test Defence get/set methods
     */
    public function testGetSetDefence()
    {
        /* @var $character \EmagiaStory\Characters\CharactersAbstract|\PHPUnit_Framework_MockObject_MockObject */
        $character = $this->character;
        self::assertEquals(75, $character->getDefence());
        $character->setDefence(35);
        self::assertEquals(35, $character->getDefence());
    }

    /**
     * Test Speed get/set methods
     */
    public function testGetSetSpeed()
    {
        /* @var $character \EmagiaStory\Characters\CharactersAbstract|\PHPUnit_Framework_MockObject_MockObject */
        $character = $this->character;
        self::assertEquals(85, $character->getSpeed());
        $character->setSpeed(55);
        self::assertEquals(55, $character->getSpeed());
    }

    /**
     * Test Luck get/set methods
     */
    public function testGetSetLuck()
    {
        /* @var $character \EmagiaStory\Characters\CharactersAbstract|\PHPUnit_Framework_MockObject_MockObject */
        $character = $this->character;
        self::assertEquals(40, $character->getLuck());
        $character->setLuck(55);
        self::assertEquals(55, $character->getLuck());
    }
}
