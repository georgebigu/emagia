<?php
/**
 * Created by PhpStorm.
 * User: George
 * Date: 3/12/18
 * Time: 22:53
 */

namespace Tests\EmagiaStory\Skills;

use PHPUnit\Framework\TestCase;

/**
 * Class SkillsTest
 * @package Tests\EmagiaStory\Skills
 */
class SkillsTest extends TestCase
{
    /**
     * Test useSkill method when chance to use is 100%
     */
    public function testUseSkillTrue() {
        /* @var $skill \EmagiaStory\Skills\SkillsAbstract|\PHPUnit_Framework_MockObject_MockObject */
        $skill = $this
            ->getMockBuilder('EmagiaStory\Skills\SkillsAbstract')
            ->setConstructorArgs(['skill', 100])
            ->getMockForAbstractClass()
        ;

        $skill->useSkill();
        $result = $skill->getUseSkill();

        $this->assertEquals(true, $result);
    }

    /**
     * Test useSkill method when chance to use is 0%
     */
    public function testUseSkillFalse() {
        /* @var $skill \EmagiaStory\Skills\SkillsAbstract|\PHPUnit_Framework_MockObject_MockObject */
        $skill = $this
            ->getMockBuilder('EmagiaStory\Skills\SkillsAbstract')
            ->setConstructorArgs(['skill', 0])
            ->getMockForAbstractClass()
        ;

        $skill->useSkill();
        $result = $skill->getUseSkill();

        $this->assertEquals(false, $result);
    }
}
