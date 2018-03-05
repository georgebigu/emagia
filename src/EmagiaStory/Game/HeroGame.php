<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: George
 * Date: 3/4/18
 * Time: 15:54
 */

namespace EmagiaStory\Game;
use EmagiaStory\Characters\Hero;
use EmagiaStory\Skills\MagicShield;
use EmagiaStory\Skills\RapidStrike;

/**
 * Class HeroGame
 *
 * Implements all the gameplay logic
 *
 * @package EmagiaStory\Game
 */
class HeroGame
{
    /** @var $hero */
    protected $hero;

    /** @var $wildBeast */
    protected $wildBeast;

    /** @var $winner */
    protected $winner;

    /** @var $firstAttacker */
    protected $firstAttacker;

    /** @var array $startAbilities */
    protected $startAbilities = [];

    /**
     * Start battle
     */
    public function startBattle()
    {
        try {
            $this->initGame();
        } catch (\Exception $e) {
            $this->log($e->getMessage());
        }
    }

    /**
     * Init Game
     */
    public function initGame()
    {
        $this->createHero();
    }

    /**
     * @return HeroGame
     */
    private function createHero(): HeroGame
    {
        try {
            $this->hero = new Hero();
            $rapidStrike = new RapidStrike('RapidStrike', HeroGameRules::HERO_SKILLS['RAPID_STRIKE']);
            $magicShield = new MagicShield('MagicShield', HeroGameRules::HERO_SKILLS['MAGIC_SHIELD']);

            $this->getStartAbilities(HeroGameRules::HERO_ABILITIES);

            $this->hero->setPlayerName(HeroGameRules::HERO_NAME)
                ->setHealth($this->startAbilities['health'])
                ->setStrength($this->startAbilities['strength'])
                ->setDefence($this->startAbilities['defence'])
                ->setSpeed($this->startAbilities['speed'])
                ->setLuck($this->startAbilities['luck'])
            ;

            $this->hero->addSkill($rapidStrike->useSkill())
                ->addSkill($magicShield->useSkill())
            ;

        } catch (\Exception $e) {
            $this->log($e->getMessage());
        }

        return $this;
    }

    /**
     * @param array $abilities
     * @throws \Exception
     */
    private function getStartAbilities(array $abilities)
    {
        try {
            $health = $this->getRandom($abilities['MIN_HEALTH'], $abilities['MAX_HEALTH'], 'HEALTH');
            $strength = $this->getRandom($abilities['MIN_STRENGTH'], $abilities['MAX_STRENGTH'], 'STRENGHT');
            $defence = $this->getRandom($abilities['MIN_DEFENCE'], $abilities['MAX_DEFENCE'], 'DEFENCE');
            $speed = $this->getRandom($abilities['MIN_SPEED'], $abilities['MAX_SPEED'], 'SPEED');
            $luck = $this->getRandom($abilities['MIN_LUCK'], $abilities['MAX_LUCK'], 'LUCK');

            $this->startAbilities['health'] = $health;
            $this->startAbilities['strength'] = $strength;
            $this->startAbilities['defence'] = $defence;
            $this->startAbilities['speed'] = $speed;
            $this->startAbilities['luck'] = $luck;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Return a random number
     *
     * @param int $min
     * @param int $max
     * @param string $ability
     *
     * @return int
     *
     * @throws \Exception
     */
    private function getRandom(int $min = 10, int $max = 0, string $ability): int
    {
       if ($min >= $max) {
           throw new \Exception('The values provided for: ' . $ability . 'are not correct!') ;
       }

       return mt_rand($min, $max);
    }

    /**
     * Prints a message
     *
     * @param string $message
     */
    private function log(string $message)
    {
        print_r($message);
    }
}