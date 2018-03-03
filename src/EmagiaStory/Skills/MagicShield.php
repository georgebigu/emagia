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

    public function getSpecialDamage(float $damage): float
    {
        // TODO: Implement getSpecialDamage() method.
    }
}