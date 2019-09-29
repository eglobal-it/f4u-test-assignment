<?php
namespace App\Tests;

use Codeception\Actor;
use Faker\Factory;
use Faker\Generator;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 * @SuppressWarnings(PHPMD)
*/
class ApiTester extends Actor
{
    use _generated\ApiTesterActions;

    /**
     * @var Generator
     */
   private $faker;

    /**
     * @return Generator
     */
    public function getFaker(): Generator
    {
        if ($this->faker === null) {
            $this->faker = Factory::create();
        }

        return $this->faker;
    }
}
