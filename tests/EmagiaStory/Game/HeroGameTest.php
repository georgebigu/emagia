<?php
/**
 * Created by PhpStorm.
 * User: George
 * Date: 3/12/18
 * Time: 22:49
 */

namespace Tests\EmagiaStory\Game;

use PHPUnit\Framework\TestCase;

/**
 * Class HeroGameTest
 * @package Tests\EmagiaStory\Game
 * */
class HeroGameTest extends TestCase
{
    /** @var $hero */
    protected $hero;

    /** @var $wildBeast */
    protected $wildBeast;

    /**
     * Set up test Characters
     */
    protected function setUp()
    {
        /* @var $hero \EmagiaStory\Characters\Hero|\PHPUnit_Framework_MockObject_MockObject */
        $hero = $this
            ->getMockBuilder('EmagiaStory\Characters\Hero')
            ->getMock()
        ;
        $hero
            ->setHealth(20)
            ->setStrength(30)
            ->setDefence(40)
            ->setSpeed(50)
            ->setLuck(60)
        ;
        $this->hero = $hero;

        /* @var $wildBeast \EmagiaStory\Characters\WildBeast|\PHPUnit_Framework_MockObject_MockObject */
        $wildBeast = $this
            ->getMockBuilder('EmagiaStory\Characters\WildBeast')
            ->getMock()
        ;
        $wildBeast
            ->setHealth(25)
            ->setStrength(23)
            ->setDefence(45)
            ->setSpeed(65)
            ->setLuck(35)
        ;
        $this->wildBeast = $wildBeast;
    }

    /**
     * Test for method that check that both player are alive
     */
    public function testPlayersAliveTrue()
    {
        /* @var $hero \EmagiaStory\Characters\Hero|\PHPUnit_Framework_MockObject_MockObject */
        $hero = $this->hero;
        self::assertTrue($hero->getHealth() > 0, 'Hero is still alive');

        /* @var $wildBeast \EmagiaStory\Characters\WildBeast|\PHPUnit_Framework_MockObject_MockObject */
        $wildBeast = $this->wildBeast;
        self::assertTrue($wildBeast->getHeath() > 0, 'WildBeast is still alive');
    }
}
