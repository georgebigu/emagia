<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: George
 * Date: 3/3/18
 * Time: 18:02
 */

namespace EmagiaStory\Characters;
use EmagiaStory\Skills\SkillsAbstract;

/**
 * Class Hero
 */
class Hero extends CharactersAbstract
{
    /** @var array $skills */
    protected $skills = [];

    /** @var array $skillsTypes */
    protected $skillsTypes = [
        'MagicShield',
        'RapidStrike',
    ];

    /******************/
    /* PUBLIC METHODS */
    /******************/

    /**
     * Add skill to Hero
     *
     * @param SkillsAbstract $skill
     * @return Hero
     */
    public function addSkill(SkillsAbstract $skill): Hero
    {
        foreach ($this->skillsTypes as $skillType) {
            if (!$this->skillIsSet($skill, $skillType)) {
                $this->skills[$skillType] = $skill;
            }
        }

        return $this;
    }

    /**
     * Remove skill from Hero
     *
     * @param SkillsAbstract $skill
     * @return Hero
     */
    public function removeSkill(SkillsAbstract $skill): Hero
    {
        foreach ($this->skillsTypes as $skillType) {
            if ($this->skillIsSet($skill, $skillType)) {
                unset($this->skills[$skillType]);
            }
        }


    }

    /*******************/
    /* PRIVATE METHODS */
    /*******************/

    /**
     * Checks if a skill is already added for Hero
     *
     * @param SkillsAbstract $skill
     * @param string $skillType
     * @return bool
     */
    private function skillIsSet(SkillsAbstract $skill, string $skillType)
    {
        if (isset($this->skills[$skillType]) &&
            $this->skills[$skillType] instanceof $skill) {
            return true;
        }

        return false;
    }
}