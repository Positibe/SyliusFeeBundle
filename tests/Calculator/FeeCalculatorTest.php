<?php
/**
 * This file is part of the PositibeLabs Projects.
 *
 * (c) Pedro Carlos Abreu <pcabreus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);


namespace Tests\Sylius\Feeplugin\Calculator;


use PHPUnit\Framework\TestCase;
use Positibe\Sylius\FeePlugin\Calculator\FeeCalculator;
use Positibe\Sylius\FeePlugin\Entity\Fee;

/**
 * Class FeeCalculatortest
 * @package Tests\Sylius\Feeplugin\Calculator
 *
 * @author Pedro Carlos Abreu <pcabreus@gmail.com>
 */
class FeeCalculatorTest extends TestCase
{
    /** @var FeeCalculator */
    private $calculator;

    protected function setUp()
    {
        parent::setUp();
        $this->calculator = new FeeCalculator();
    }

    function testNotPercent()
    {
        $fee = new Fee();
        $fee->setAmount(10000); // $100.00
        $amount = $this->calculator->calculate($fee, 0);

        $this->assertEquals(10000, $amount);
    }

    function testNotPercentWithMultiplied()
    {
        $fee = new Fee();
        $fee->setAmount(10000); // $100.00
        $fee->setMultiplied(true);

        $amount = $this->calculator->calculate($fee, 0, 3);

        $this->assertEquals(30000, $amount);
    }

    function test10Percent()
    {
        $fee = new Fee();
        $fee->setPercent(true); //Percent on true

        $fee->setAmount(0); // 0%
        $amount = $this->calculator->calculate($fee, 100);
        $this->assertEquals(0, $amount);


        $fee->setAmount(10000); // %100
        $amount = $this->calculator->calculate($fee, 100);
        $this->assertEquals(100, $amount);

        $fee->setAmount(10000); // %100
        $fee->setMultiplied(true); //Set multiple passed 3 as multiply
        $amount = $this->calculator->calculate($fee, 100, 3);
        $this->assertEquals(300, $amount);


    }
}