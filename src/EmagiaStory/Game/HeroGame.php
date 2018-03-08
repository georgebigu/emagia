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
use EmagiaStory\Characters\WildBeast;
use EmagiaStory\Skills\MagicShield;
use EmagiaStory\Skills\RapidStrike;
use EmagiaStory\Skills\SkillsAbstract;


/**
 * Class HeroGame
 *
 * Implements all the gameplay logic
 *
 * @package EmagiaStory\Game
 */
class HeroGame
{
    /** @var Hero */
    protected $hero;

    /** @var WildBeast */
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
     *
     * @throws \Exception
     */
    public function initGame()
    {
        $this->createHero()
            ->createWildBeast()
            ->firstAttacker()
        ;

        $this->logPlayersSkills();

    }

    /**
     * Create Hero player
     *
     * @return HeroGame
     * @throws \Exception
     */
    private function createHero(): HeroGame
    {
        $this->hero = new Hero();
        $this->getStartAbilities(HeroGameRules::HERO_ABILITIES);
        $rapidStrike = new RapidStrike(SkillsAbstract::RAPID_STRIKE_CLASS, HeroGameRules::HERO_SKILLS['RAPID_STRIKE']);
        $magicShield = new MagicShield(SkillsAbstract::MAGIC_SHIELD_CLASS, HeroGameRules::HERO_SKILLS['MAGIC_SHIELD']);

        $this->hero->setPlayerName(HeroGameRules::HERO_NAME);
        foreach ($this->startAbilities as $key => $value) {
            $methodName = 'set' . ucfirst($key);
            $this->hero->{$methodName}($value);
        }
        $this->hero->addSkill($rapidStrike->useSkill())
            ->addSkill($magicShield->useSkill())
        ;

        return $this;
    }

    /**
     * Create Wild Beast player
     *
     * @return HeroGame
     * @throws \Exception
     */
    private function createWildBeast(): HeroGame
    {
        $this->wildBeast = new WildBeast();
        $this->getStartAbilities(HeroGameRules::WILD_BEAST_ABILITIES);

        $randKey = array_rand(HeroGameRules::WILD_BEASTS_NAMES, 1);
        $this->wildBeast->setPlayerName(HeroGameRules::WILD_BEASTS_NAMES[$randKey]);
        foreach ($this->startAbilities as $key => $value) {
            $methodName = 'set' . ucfirst($key);
            $this->wildBeast->{$methodName}($value);
        }

        return $this;
    }

    /**
     * Decide which character will attack first
     *
     * @throws \Exception
     */
    private function firstAttacker()
    {
        if ($this->hero->getSpeed() > $this->wildBeast->getSpeed()) {
            $this->firstAttacker = 'hero';
        } elseif ($this->hero->getSpeed() < $this->wildBeast->getSpeed()) {
            $this->firstAttacker = 'wildBeast';
        } elseif ($this->hero->getLuck() > $this->wildBeast->getLuck()) {
            $this->firstAttacker = 'hero';
        } elseif ($this->hero->getLuck() < $this->wildBeast->getLuck()) {
            $this->firstAttacker = 'wildBeast';
        } else {
            $this->initGame();
        }
    }

    /**
     * @param array $abilities
     * @throws \Exception
     */
    private function getStartAbilities(array $abilities)
    {
        $uniqueAbilities = $this->getUniqueAbilities($abilities);

        foreach ($uniqueAbilities as $ability) {
            $this->startAbilities[strtolower($ability)] = $this->getRandom(
                $abilities['MIN_'. $ability],
                $abilities['MAX_'. $ability],
                $ability);
        }
    }

    /**
     * Return an unique list of abilities
     *
     * @param array $abilities
     * @return array
     * @throws \Exception
     */
    private function getUniqueAbilities(array $abilities): array
    {
        $result = [];
        foreach ($abilities as $key => $value) {
            if (($pos = strpos($key, "_")) !== FALSE) {
                $result[] = substr($key, $pos + 1);
            } else {
                throw new \Exception('One ability constant does not have the right key format');
            }
        }

        return array_unique($result);
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

    /**
     * Log players sets of abilities
     *
     * @throws \Exception
     */
    private function logPlayersSkills()
    {
        $this->log('Hero Game start skills:' . PHP_EOL);
        $this->logUniqueAbilitiesValues($this->hero);
        $this->log('***********************' . PHP_EOL . PHP_EOL);

        $this->log('WildBeast start skills:' . PHP_EOL);
        $this->logUniqueAbilitiesValues($this->wildBeast);
        $this->log('***********************' . PHP_EOL);
    }

    /**
     * Log player individual abilities values
     *
     * @param $player
     * @throws \Exception
     */
    private function logUniqueAbilitiesValues($player)
    {
        $uniqueAbilities = $this->getUniqueAbilities(HeroGameRules::HERO_ABILITIES);

        foreach ($uniqueAbilities as $ability) {
            $methodName = 'get' . ucfirst(strtolower($ability));
            $this->log($ability . " : " . $player->{$methodName}() . PHP_EOL);
        }
    }
}