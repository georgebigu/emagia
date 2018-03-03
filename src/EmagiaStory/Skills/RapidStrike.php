<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: George
 * Date: 3/3/18
 * Time: 19:33
 */

namespace EmagiaStory\Skills;

/**
 * Class RapidStrike
 *
 * Gives the hero the ability to strike twice
 *
 * @package EmagiaStory\Skills
 */
class RapidStrike extends SkillsAbstract implements SkillsInterface
{
    /**
     * RapidStrike constructor
     * @param string $type
     * @param int $chance
     */
    public function __construct(string $type, int $chance)
    {
        parent::__construct($type, $chance);
    }

    public function getSpecialDamage(float $damage): float
    {
        // TODO: Implement getSpecialDamage() method.
    }

}