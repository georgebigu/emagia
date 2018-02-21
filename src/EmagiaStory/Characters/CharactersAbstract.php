<?php
/**
 * Created by PhpStorm.
 * User: Mac
 * Date: 2/21/18
 * Time: 23:31
 */

namespace EmagiaStory\Characters;

/**
 * Class Character
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

    /**
     * @return string
     */
    public function getPlayerName(): string
    {
        return $this->playerName;
    }

    /**
     * @param string $playerName
     */
    public function setPlayerName(string $playerName)
    {
        $this->playerName = $playerName;
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
     */
    public function setHealth(int $health)
    {
        $this->health = $health;
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
     */
    public function setStrength(int $strength)
    {
        $this->strength = $strength;
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
     */
    public function setDefence(int $defence)
    {
        $this->defence = $defence;
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
     */
    public function setSpeed(int $speed)
    {
        $this->speed = $speed;
    }

    /**
     * @return mixed
     */
    public function getLuck()
    {
        return $this->luck;
    }

    /**
     * @param mixed $luck
     */
    public function setLuck($luck)
    {
        $this->luck = $luck;
    }

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

}