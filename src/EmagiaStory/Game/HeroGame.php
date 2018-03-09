<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: George
 * Date: 3/4/18
 * Time: 15:54
 */

namespace EmagiaStory\Game;

use EmagiaStory\Characters\CharactersAbstract;
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
    const MAX_BATTLE_ROUNDS = 20;

    /** @var Hero */
    protected $hero;

    /** @var WildBeast */
    protected $wildBeast;

    /** @var CharactersAbstract */
    protected $winner;

    /** @var $attacker */
    protected $attacker;

    /** @var array $startAbilities */
    protected $startAbilities = [];

    ##################
    # PUBLIC METHODS #
    ##################
    /**
     * Start battle
     */
    public function startBattle()
    {
        try {
            $this->initGame();
            $roundsPlayed = 1;

            while ($this->getPlayersAreAlive() && $roundsPlayed <= 20) {

                $this->log('Abilities after attack nr. : ' . $roundsPlayed . PHP_EOL);
                $this->log(PHP_EOL);

                switch ($this->attacker) {
                    case 'hero':
                        $this->heroAttacks();
                        $this->attacker = "wildBeast";
                        break;
                    case 'wildBeast':
                        $this->wildBeastAttacks();
                        $this->attacker = 'hero';
                        break;
                }

                $this->addHeroSpecialSkills();
                $roundsPlayed++;
            }

            $this->setWinner();
            $this->log('Winner is: ' . $this->winner->getPlayerName());

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

        $this->logInitGame();

    }

    ###################
    # PRIVATE METHODS #
    ###################

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

        $this->hero->setPlayerName(HeroGameRules::HERO_NAME);
        foreach ($this->startAbilities as $key => $value) {
            $methodName = 'set' . ucfirst($key);
            $this->hero->{$methodName}($value);
        }

        $this->addHeroSpecialSkills();

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
     * @return HeroGame
     */
    private function addHeroSpecialSkills(): HeroGame
    {
        $rapidStrike = new RapidStrike(SkillsAbstract::RAPID_STRIKE_CLASS, HeroGameRules::HERO_SKILLS['RAPID_STRIKE']);
        $magicShield = new MagicShield(SkillsAbstract::MAGIC_SHIELD_CLASS, HeroGameRules::HERO_SKILLS['MAGIC_SHIELD']);

        $this->hero->addSkill($rapidStrike->useSkill())
            ->addSkill($magicShield->useSkill())
        ;

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
            $this->attacker = 'hero';
        } elseif ($this->hero->getSpeed() < $this->wildBeast->getSpeed()) {
            $this->attacker = 'wildBeast';
        } elseif ($this->hero->getLuck() > $this->wildBeast->getLuck()) {
            $this->attacker = 'hero';
        } elseif ($this->hero->getLuck() < $this->wildBeast->getLuck()) {
            $this->attacker = 'wildBeast';
        } else {
            $this->initGame();
        }
    }

    /**
     * Returns first attacker name
     *
     * @param $type
     * @return string
     */
    private function getFirstAttackerName($type): string
    {
        if ($type == 'hero') {
            return $this->hero->getPlayerName();
        } else {
            return $this->wildBeast->getPlayerName();
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
     * Check if all characters are alive
     *
     * @return bool
     */
    private function getPlayersAreAlive()
    {
        if($this->hero->getHealth() > 0 && $this->wildBeast->getHealth() > 0) {
            return true;
        }

        return false;
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
     * Executes Hero attack
     *
     * @throws \Exception
     */
    private function heroAttacks()
    {
        $rapidStrike = $this->getHeroSkill(SkillsAbstract::RAPID_STRIKE_CLASS);
        $damage = $this->getDamage($this->hero, $this->wildBeast);

        if ($rapidStrike->getUseSkill()) {
            $damage = $rapidStrike->getSpecialDamage($damage);
        }

        $wildBeastHealth = $this->wildBeast->getHealth() - $damage;
        $this->wildBeast->setHealth($wildBeastHealth);

        $this->logUsedSkill($rapidStrike);
        $this->logPlayersSkills();
    }

    /**
     * Executes WildBeast attack
     *
     * @throws \Exception
     */
    public function wildBeastAttacks()
    {
        $magicShield = $this->getHeroSkill(SkillsAbstract::MAGIC_SHIELD_CLASS);
        $damage = $this->getDamage($this->wildBeast, $this->hero);

        if ($magicShield->getUseSkill()) {
            $damage = $magicShield->getSpecialDamage($damage);
        }

        $heroHealth = $this->hero->getHealth() - $damage;
        $this->hero->setHealth($heroHealth);

        $this->logUsedSkill($magicShield);
        $this->logPlayersSkills();
    }

    /**
     * Calculates damage
     *
     * @param CharactersAbstract $attacker
     * @param CharactersAbstract $defender
     * @return int
     */
    private function getDamage(CharactersAbstract $attacker, CharactersAbstract $defender): int
    {
        return $attacker->getStrength() - $defender->getDefence();
    }

    /**
     * Check if defender is lucky
     *
     * @param CharactersAbstract $attacker
     * @param CharactersAbstract $defender
     * @return bool
     */
//    private function isDefenderLucky(CharactersAbstract $attacker, CharactersAbstract $defender): bool
//    {
//        return $attacker->getLuck() < $defender->getLuck();
//    }

    /**
     * Return hero skill class
     *
     * @param string $skill
     * @return SkillsAbstract
     * @throws \Exception
     */
    private function getHeroSkill(string $skill): SkillsAbstract
    {
        $skillTypes = $this->hero->getSkillsTypes();

        if (empty($skill)) {
            throw new \Exception('Please provide a skill type');
        }

        if (!in_array($skill, $skillTypes)) {
            throw new \Exception('Wrong skill type provided!');
        }

        $skills = $this->hero->getSkills();

        return $skills[$skill];
    }

    /**
     * Set the winner of the game
     *
     * @return HeroGame
     */
    private function setWinner(): HeroGame
    {
        if ($this->hero->getHealth() > $this->wildBeast->getHealth()) {
            $this->winner = $this->hero;
        } else {
            $this->winner = $this->wildBeast;
        }

        return $this;
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
        $this->log($this->hero->getPlayerName() . ' abilities:' . PHP_EOL . PHP_EOL);
        $this->logUniqueAbilitiesValues($this->hero);
        $this->log(PHP_EOL);

        $this->log($this->wildBeast->getPlayerName() . ' abilities:' . PHP_EOL . PHP_EOL);
        $this->logUniqueAbilitiesValues($this->wildBeast);
        $this->log(PHP_EOL);
        $this->log('***********************' . PHP_EOL . PHP_EOL);
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

    /**
     * Log initial game settings
     *
     * @throws \Exception
     */
    private function logInitGame()
    {
        $firstAttackerName = $this->getFirstAttackerName($this->attacker);
        $this->log(PHP_EOL);
        $this->log('First attacker will be ' . $this->attacker . ' : ' . $firstAttackerName);
        $this->log(PHP_EOL);
        $this->log(PHP_EOL);
        $this->logPlayersSkills();
    }

    /**
     * @param $skill
     */
    private function logUsedSkill(SkillsAbstract $skill)
    {
        if ($skill->getUseSkill()) {
            $this->log('Hero uses ' . $skill->getType() . '!!!');
        } else {
            $this->log('Hero uses no skill !!!');
        }
        $this->log(PHP_EOL);
        $this->log(PHP_EOL);

    }
}