<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: George
 * Date: 2/22/18
 * Time: 00:06
 */

namespace EmagiaStory\Skills;

/**
 * Class SkillsAbstract
 * @package EmagiaStory\Skills
 */
abstract class SkillsAbstract
{
    /** @var $chance */
    protected $chance;

    /** @var $type */
    protected $type;

    /** @var $useSkill */
    protected $useSkill;

    /**
     * SkillsAbstract constructor
     * @param string $type
     * @param int $chance
     */
    public function __construct(string $type, int $chance)
    {
        $this->type = $type;
        $this->chance = $chance;
    }

    /**
     * @return mixed
     */
    public function getChance(): int
    {
        return $this->chance;
    }

    /**
     * @return mixed
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getUseSkill(): bool
    {
        return $this->useSkill;
    }

    /**
     * @param mixed $useSkill
     * @return SkillsAbstract
     */
    public function useSkill(): SkillsAbstract
    {
        $rand = mt_rand(0, 100);
        $useSkill = $rand < $this->chance;
        $this->useSkill = $useSkill;

        return $this;
    }
}