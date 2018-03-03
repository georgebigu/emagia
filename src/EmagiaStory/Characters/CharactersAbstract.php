<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: George
 * Date: 2/21/18
 * Time: 23:31
 */

namespace EmagiaStory\Characters;

/**
 * Class CharacterAbstract
 * @package EmagiaStory\Character
 */
abstract class CharactersAbstract
{
    /** @var $playerName string */
    protected $playerName;

    /** @var $health int */
    protected $health;

    /** @var $strength int */
    protected $strength;

    /** @var $defence int */
    protected $defence;

    /** @var $speed int */
    protected $speed;

    /** @var $luck */
    protected $luck;

    /**
     * CharactersAbstract constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getPlayerName(): string
    {
        return $this->playerName;
    }

    /**
     * @param string $playerName
     * @return CharactersAbstract
     */
    public function setPlayerName(string $playerName): CharactersAbstract
    {
        $this->playerName = $playerName;

        return $this;
    }

    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * @param int $health
     * @return CharactersAbstract
     */
    public function setHealth(int $health): CharactersAbstract
    {
        $this->health = $health;

        return $this;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * @param int $strength
     * @return CharactersAbstract
     */
    public function setStrength(int $strength): CharactersAbstract
    {
        $this->strength = $strength;

        return $this;
    }

    /**
     * @return int
     */
    public function getDefence(): int
    {
        return $this->defence;
    }

    /**
     * @param int $defence
     * @return CharactersAbstract
     */
    public function setDefence(int $defence): CharactersAbstract
    {
        $this->defence = $defence;

        return $this;
    }

    /**
     * @return int
     */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * @param int $speed
     * @return CharactersAbstract
     */
    public function setSpeed(int $speed): CharactersAbstract
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLuck(): int
    {
        return $this->luck;
    }

    /**
     * @param mixed $luck
     * @return CharactersAbstract
     */
    public function setLuck(int $luck): CharactersAbstract
    {
        $this->luck = $luck;

        return $this;
    }
}