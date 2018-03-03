<?php
/**
 * Created by PhpStorm.
 * User: George
 * Date: 2/23/18
 * Time: 08:55
 */

namespace EmagiaStory\Game;

/**
 * Class HeroGameRules
 *
 * These class will be used to set
 * the characters default skills and properties
 *
 * @package EmagiaStory
 */
class HeroGameRules
{

//defined const this way is not supported by PHPStorm

//    define('CARS', [
//        'mercedes',
//        'bmw',
//        'audi'
//    ]);


    /* Hero default settings */
    const HERO_NAME = 'ORDERUS';
    const HERO_SKILLS = [
        'MIN_HEALTH'    => 70,
        'MAX_HEALTH'    => 100,
        'MIN_STRENGTH'  => 70,
        'MAX_STRENGTH'  => 100,
        'MIN_DEFENCE'   => 45,
        'MAX_DEFENCE'   => 55,
        'MIN_SPEED'     => 40,
        'MAX_SPEED'     => 50,
        'MIN_LUCK'      => 10,
        'MAX_LUCK'      => 30,
        'RAPID_STRIKE'  => 10,
        'MAGIC_SHIELD'  => 20,
    ];

    /* Wild beast default settings */
    const WILD_BEASTS_NAMES = [
        'LUNA FANG',
        'MAD HUNTER',
        'FARREL',
        'MUMMY CLAWS'
    ];
    const WILD_BEAST_SKILLS = [
        'MIN_HEALTH'    => 60,
        'MAX_HEALTH'    => 90,
        'MIN_STRENGTH'  => 60,
        'MAX_STRENGTH'  => 90,
        'MIN_DEFENCE'   => 40,
        'MAX_DEFENCE'   => 60,
        'MIN_SPEED'     => 40,
        'MAX_SPEED'     => 60,
        'MIN_LUCK'      => 25,
        'MAX_LUCK'      => 40,
    ];

}