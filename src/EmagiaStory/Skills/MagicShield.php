<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: George
 * Date: 3/3/18
 * Time: 18:57
 */

namespace EmagiaStory\Skills;

/**
 * Class MagicShield
 *
 * Limits the damage made by the enemy to half
 *
 * @package EmagiaStory\Skills
 */
class MagicShield extends SkillsAbstract implements SkillsInterface
{
    /**
     * MagicShield constructor
     * @param string $type
     * @param int $chance
     */
    public function __construct(string $type, int $chance)
    {
        parent::__construct($type, $chance);
    }

    /**
     * Limits the damage inflicted to the player to half
     *
     * @param int $damage
     * @return int
     */
    public function getSpecialDamage(int $damage): int
    {
        return $damage / 2;
    }
}