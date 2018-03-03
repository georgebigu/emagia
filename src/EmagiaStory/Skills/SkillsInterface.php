<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: George
 * Date: 3/3/18
 * Time: 19:39
 */

/**
 * Interface SkillInterface
 * @package EmagiaStory\Skills
 */
namespace EmagiaStory\Skills;

interface SkillsInterface
{
    public function getSpecialDamage(float $damage): float;
}